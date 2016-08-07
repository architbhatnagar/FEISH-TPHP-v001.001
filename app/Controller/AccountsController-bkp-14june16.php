<?php

App::uses('AppController', 'Controller');

/**
 * Accounts Controller
 *
 * @property Account $Account
 * @property PaginatorComponent $Paginator
 */
class AccountsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        Configure::load('feish');
        $this->Account->recursive = 0;
        $this->paginate = array(
            'order' => 'Account.id DESC',
            'limit' => 20);
        $accounts = $this->Paginator->paginate();
//        debug($accounts); die;
        $this->set('accounts', $accounts);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Account->exists($id)) {
            throw new NotFoundException(__('Invalid account'));
        }
        $options = array('conditions' => array('Account.' . $this->Account->primaryKey => $id));
        $this->set('account', $this->Account->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Account->create();
            if ($this->Account->save($this->request->data)) {
                $this->Session->setFlash(__('The account has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The account could not be saved. Please, try again.'));
            }
        }
        $users = $this->Account->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Account->exists($id)) {
            throw new NotFoundException(__('Invalid account'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Account->save($this->request->data)) {
                $this->Session->setFlash(__('The account has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The account could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Account.' . $this->Account->primaryKey => $id));
            $this->request->data = $this->Account->find('first', $options);
        }
        $users = $this->Account->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Account->id = $id;
        if (!$this->Account->exists()) {
            throw new NotFoundException(__('Invalid account'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Account->delete()) {
            $this->Session->setFlash(__('The account has been deleted.'));
        } else {
            $this->Session->setFlash(__('The account could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function outstanding_invoice() {
        $dr_list = $user_condition = $users = array();
        $post_flag = false;
        $total_cost = $commission_total = 0.00;
        $this->loadModel('Service');
        $this->loadModel('PatientPackageLog');
        $this->loadModel('User');
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $conditions = array('PatientPackageLog.generate_invoice' => 0, 'PatientPackageLog.paid_flag' => 0);
       
        // get sum of services bought, service list, no of visits by petients 
        $all_patients = $this->PatientPackageLog->find('all', array(
            'conditions' => $conditions,
            'group' => array('PatientPackageLog.service_id'),
            'fields' => array('count(PatientPackageLog.service_id) as patient_count', 'sum(PatientPackageLog.price) as total_cost', 'sum(PatientPackageLog.commission) as commission', 'PatientPackageLog.service_id', 'sum(PatientPackageLog.used_visits) as total_visits')
                )
        );
//        debug($all_patients);  die;
//        $log = $this->PatientPackageLog->getDataSource()->getLog(false, false);
//        debug($log); die;
        if (!empty($all_patients)) {
            if (!isset($services_list)) {
                $services_list = array();
                foreach ($all_patients as $key => $value) {
                    array_push($services_list, $value['PatientPackageLog']['service_id']);
                }
            }
            // get all doctors of a specific service
            $users_list = $this->Service->find('list', array('conditions' => array('Service.id' => $services_list), 'fields' => array('Service.id', 'Service.user_id')));
            if (!empty($users_list)) {
                $user_condition = array('User.id' => $users_list, 'User.is_active' => 1);
            }

            $users = $this->User->find('all', array(
                'conditions' => $user_condition,
                'group' => array('User.id'),
                    )
            );

//            debug($users);
//            debug($all_patients);
//            die;
            $i = 0;
            foreach ($users as $value) {
                //            debug($value); die;
                foreach ($all_patients as $costs) {

                    if ($costs['PatientPackageLog']['service_id'] == $value['Services'][$i]['id']) {
                        $patient_count[$value['User']['id']] = $costs[0]['patient_count'];
                        if ($costs[0]['patient_count'] > 0) {
                            $save_prices[$value['User']['id']] = $costs[0]['total_cost'];
                            $total_commision[$value['User']['id']] = $costs[0]['commission'];
                            $doctor_income[$value['User']['id']] = $costs[0]['total_cost'] - $costs[0]['commission'];
                        } else {
                            $save_prices[$value['User']['id']] = 0.00;
                            $total_commision[$value['User']['id']] = 0.00;
                            $doctor_income[$value['User']['id']] = 0.00;
                        }
                    }
                }
            }

            $this->set(compact('start_dt', 'save_prices', 'total_commision', 'doctor_income', 'patient_count'));
        }
        $this->set(compact('users', 'dr_list', 'salutations', 'f_date', 'l_date'));
    }

    //function for managing accounts - adding/updating Dr's entries
    public function manage_accounts() {
        $this->loadModel('User');
        $this->loadModel('Service');
        $this->loadModel('PatientPackageLog');

        $conditions = array('PatientPackageLog.is_active' => 1, 'PatientPackageLog.paid_flag' => 0, 'PatientPackageLog.generate_invoice' => 0);
        //if post request
        if ($this->request->is('post')) {
            $user_data = $this->request->data;
            $services_list = $this->Service->find('list', array('conditions' => array('Service.user_id' => $user_data['userlist']), 'fields' => array('Service.id', 'Service.id')));
            $conditions['PatientPackageLog.service_id'] = $services_list;
        }
//        debug($conditions);  die;
//        $service_list = $this->Service->find('list', array('conditions' => array('Service.user_id' => $dr_id), 'fields' => array('Service.id', 'Service.id')));
        $plan_list = $this->PatientPackageLog->find('all', array(
            'conditions' => $conditions,
            'fields' => array('count(PatientPackageLog.id) as total_patients', 'Service.id', 'PatientPackageLog.id', 'PatientPackageLog.package_name', 'sum(PatientPackageLog.price) as total_cost', 'sum(PatientPackageLog.commission) as commission'),
            'group' => array('PatientPackageLog.service_id')
        ));

//        $log = $this->PatientPackageLog->getDataSource()->getLog(false, false);
//        debug($log); die;
//            debug($plan_list); die;
        foreach ($plan_list as $value) {
            $insert_flag = $flag = true;
            $get_data = $save_flag = array();
            $dr_details = $this->Service->find('first', array('conditions' => array('Service.id' => $value['Service']['id']), 'fields' => array('User.id')));
            $user_id = $dr_details['User']['id'];
            $conditions = array('Account.user_id' => $user_id);
            $get_data['user_id'] = $user_id;
            $get_data['patient_count'] = $value[0]['total_patients'];
            $get_data['total_cost'] = $value[0]['total_cost'];
            $get_data['commission'] = $value[0]['commission'];
            $get_data['dr_income_cost'] = number_format($value[0]['total_cost'] - $value[0]['commission'], 2, '.', '');
            $get_data['invoice_date'] = date('Y-m-d H:i:s');

            //if any upaid entry found, update ammounts else create new entry
            if ($this->Account->hasAny($conditions)) {
                $data = $this->Account->find('first', array('conditions' => $conditions, 'fields' => array('Account.id', 'Account.paid_flag')));
                //if payment has not maid - update existing record
                if ($data['Account']['paid_flag'] == 0) {
                    $insert_flag = false;
                    $this->Account->id = $data['Account']['id'];
                    if (!$this->Account->save($get_data)) {
                        $flag = false;
                    }
                }
            }
            //if dr_id doesn't exist or payment for that dr is done - insert new record
            if ($insert_flag) {
                $this->Account->create();
                if (!$this->Account->save($get_data)) {
                    $flag = false;
                }
            }
            if($flag) {
                $this->PatientPackageLog->updateAll(array('PatientPackageLog.generate_invoice' => 1), array('PatientPackageLog.service_id'=>$value['Service']['id']));
            }
        }
        
        if ($flag) {
            $this->Session->setFlash(__('Invoices have been generated.'),'success');
            return $this->redirect(array('action' => 'outstanding_invoice'));
        } else {
            $this->Session->setFlash(__('Invoices could not be generated. Please, try again.'),'error');
            return $this->redirect(array('action' => 'outstanding_invoice'));
        }
    }

    public function payment_process($id, $dr_id = null) {
        $this->loadModel('Service');
        $this->loadModel('PatientPackageLog');
        $sr_list = $this->Service->find('list', array('conditions' => array('Service.user_id' => $dr_id), 'fields' => array('Service.id','Service.id')));
        $this->PatientPackageLog->updateAll(array('PatientPackageLog.paid_flag' => 1), array('PatientPackageLog.service_id'=>$sr_list));
        $get_data['user_id'] = $dr_id;
        $get_data['paid_by'] = 1;
        $get_data['paid_flag'] = 1;
        $get_data['paid_on'] = date('Y-m-d H:i:s');
        $this->Account->id = $id;
        if ($this->Account->save($get_data)) {
            $this->Session->setFlash(__('Payment successful. Account has been updated.'), 'success');
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash(__('Payment failed. Account could not be updated. Please, try again.'));
        }
    }

}
