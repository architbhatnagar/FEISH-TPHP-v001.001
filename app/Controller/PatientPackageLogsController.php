<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * PatientPackageLogs Controller
 *
 * @property PatientPackageLog $PatientPackageLog
 * @property PaginatorComponent $Paginator
 */
class PatientPackageLogsController extends AppController {

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
        $this->PatientPackageLog->recursive = 0;
        $this->paginate = array(
            'conditions' => array('PatientPackage.user_id' => $this->Auth->user('added_by_doctor_id')),
            'order' => 'PatientPackageLog.end_date ASC',
            'limit' => 50
        );
        $patientPackageLogs = $this->Paginator->paginate();
        $this->set(compact('patientPackageLogs'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->PatientPackageLog->exists($id)) {
            throw new NotFoundException(__('Invalid patient package log'));
        }
        $options = array('conditions' => array('PatientPackageLog.' . $this->PatientPackageLog->primaryKey => $id));
        $this->set('patientPackageLog', $this->PatientPackageLog->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->PatientPackageLog->create();
            if ($this->PatientPackageLog->save($this->request->data)) {
                $this->Session->setFlash(__('The patient package log has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The patient package log could not be saved. Please, try again.'));
            }
        }
        $users = $this->PatientPackageLog->User->find('list');
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
        if (!$this->PatientPackageLog->exists($id)) {
            throw new NotFoundException(__('Invalid patient package log'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->PatientPackageLog->save($this->request->data)) {
                $this->Session->setFlash(__('The patient package log has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The patient package log could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('PatientPackageLog.' . $this->PatientPackageLog->primaryKey => $id));
            $this->request->data = $this->PatientPackageLog->find('first', $options);
        }
        $users = $this->PatientPackageLog->User->find('list');
        $this->set(compact('users'));
    }

    public function get_details() {
        $this->layout = null;
        if ($this->request->is('post')) {
            $fetch_data = $this->PatientPackageLog->find('first', array('conditions' => array('PatientPackageLog.id' => $this->request->data['id']),
                'fields' => array(
                    'id', 'PatientPackageLog.package_name', 'User.first_name', 'User.last_name', 'User.salutation', 'PatientPackageLog.price', 'PatientPackageLog.plan_type',
                    'PatientPackageLog.validity', 'PatientPackageLog.start_date', 'PatientPackageLog.end_date', 'User.email', 'User.mobile', 'Service.title'
            )));


            $result['PatientPackageLog'] = $fetch_data['PatientPackageLog'];
            $result['User'] = $fetch_data['User'];
            $result['Service']['title'] = $fetch_data['Service']['title'];
            Configure::load('feish');
            $salutations = Configure::read('feish.salutations');
            $plan_types = Configure::read('feish.plan_types');
            $result['User']['salutation'] = $salutations[$result['User']['salutation']];
            $result['PatientPackageLog']['plan_type'] = $plan_types[$result['PatientPackageLog']['plan_type']];
            $this->set(compact('result'));
            $this->render('filter');
        }
    }

    public function renew_plan($id = null) {
        $this->layout = null;
        $fetch_data = $this->PatientPackageLog->find('first', array('conditions' => array('PatientPackageLog.id' => $id),
            'fields' => array(
                'id', 'PatientPackageLog.package_name', 'User.first_name', 'User.last_name', 'User.salutation', 'User.email', 'PatientPackageLog.price', 'PatientPackageLog.plan_type',
                'PatientPackageLog.validity', 'PatientPackageLog.start_date', 'PatientPackageLog.end_date', 'User.email', 'User.mobile', 'Service.title'
        )));
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $fetch_data['User']['salutation'] = $salutations[$fetch_data['User']['salutation']];
        $user_data = array();
        // debug($fetch_data['User']['salutation']);
        $user_data['salutation'] = $fetch_data['User']['salutation'];
        $user_data['first_name'] = $fetch_data['User']['first_name'];
        $user_data['last_name'] = $fetch_data['User']['last_name'];
        $user_data['plan_name'] = $fetch_data['PatientPackageLog']['package_name'];
        $user_data['end_date'] = $fetch_data['PatientPackageLog']['end_date'];
        $email = new CakeEmail();
        $email->config('renew_plan');
        $email->to($fetch_data['User']['email']);
        $email->viewVars(compact('user_data', 'salutations'));
        $email->subject('Renew Plan');

        if ($email->send()):
            $this->Session->setFlash(__('The alert mail send successfully.'), 'success');
        else:
            $this->Session->setFlash(__('The alert mail could not be send, Please try again.'), 'error');
        endif;
        
        return $this->redirect(array('action' => 'index'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function get_user_services() {
        $this->layout = null;
        if ($this->request->is('post')) {
            $packages = $this->PatientPackageLog->find('list', array('conditions' => array('PatientPackageLog.user_id' => $this->request->data['user_id'], 'PatientPackageLog.is_active' => 1, 'PatientPackageLog.end_date >=' => date('Y-m-d')), 'fields' => array('PatientPackageLog.service_id', 'PatientPackageLog.service_id')));
            $services = $this->PatientPackageLog->Service->find('list', array('conditions' => array('Service.id' => $packages, 'Service.user_id' => $this->Auth->user('id')), 'fields' => array('Service.id', 'Service.title')));
            $result = $services;

            $this->set(compact('result'));
            $this->render('filter');
        }
    }

    public function get_user_services_ass_dashboard() {
        $this->layout = null;
        if ($this->request->is('post')) {
            $packages = $this->PatientPackageLog->find('list', array('conditions' => array('PatientPackageLog.user_id' => $this->request->data['user_id'], 'PatientPackageLog.is_active' => 1, 'PatientPackageLog.end_date >=' => date('Y-m-d')), 'fields' => array('PatientPackageLog.service_id', 'PatientPackageLog.service_id')));
            $services = $this->PatientPackageLog->Service->find('list', array('conditions' => array('Service.id' => $packages, 'Service.user_id' => $this->Auth->user('added_by_doctor_id')), 'fields' => array('Service.id', 'Service.title')));
            $result = $services;

            $this->set(compact('result'));
            $this->render('filter');
        }
    }

    public function delete($id = null) {
        $this->PatientPackageLog->id = $id;
        if (!$this->PatientPackageLog->exists()) {
            throw new NotFoundException(__('Invalid patient package log'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->PatientPackageLog->delete()) {
            $this->Session->setFlash(__('The patient package log has been deleted.'));
        } else {
            $this->Session->setFlash(__('The patient package log could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function invoice_report() {
        $dr_list = $user_condition = $users = array();
        $post_flag = false;
        $total_cost = $commission_total = 0.00;
        $this->loadModel('Service');
        $this->loadModel('User');
        $start_dt = new DateTime('first day of this month');
        $f_date = $start_dt->format('Y-m-d H:i:s');
        $end_dt = new DateTime('last day of this month');
        $l_date = $end_dt->format('Y-m-d H:i:s');
        // get list of all active Doctors
        $dr_list = $this->User->find('list', array('conditions' => array('User.user_type' => 2, 'User.is_active' => 1), 'fields' => array('User.id', 'User.full_name')));
        $conditions = array('PatientPackageLog.start_date >=' => $f_date, 'PatientPackageLog.start_date <=' => $l_date);

        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');

        //if post request
        if ($this->request->is('post')) {
            $conditions = array();
            $post_flag = true;
            $user_data = $this->request->data;
            if (!empty($user_data['PatientPackageLog']['from_date']) && !empty($user_data['PatientPackageLog']['to_date'])) {
                $f_date = $conditions['PatientPackageLog.start_date  >= '] = date("Y-m-d", strtotime(str_replace('/', '-', $user_data['PatientPackageLog']['from_date'])));
                $l_date = $conditions['PatientPackageLog.end_date <= '] = date("Y-m-d", strtotime(str_replace('/', '-', $user_data['PatientPackageLog']['to_date'])));
            }
            if (!empty($user_data['PatientPackageLog']['dr_name'])) {
                $services_list = $this->Service->find('list', array('conditions' => array('Service.user_id' => $user_data['PatientPackageLog']['dr_name']), 'fields' => array('Service.id', 'Service.id')));
                $conditions['PatientPackageLog.service_id'] = $services_list;
            } else {
                unset($conditions['PatientPackageLog.service_id']);
            }
            if ($user_data['PatientPackageLog']['from_date'] == '') {
                unset($conditions['PatientPackageLog.start_date  >= ']);
                $f_date = '';
            }
            if ($user_data['PatientPackageLog']['to_date'] == '') {
                unset($conditions['PatientPackageLog.print_page <= ']);
            }
        }
//        debug($conditions);  die;
//        $all_patients = $this->PatientPackageLog->find('all', array('conditions' => array('PatientPackageLog.start_date >=' => $f_date->format('Y-m-d H:i:s'), 'PatientPackageLog.start_date <=' => $l_date->format('Y-m-d H:i:s'))));
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
            $i=0;
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
                        
                    } else {
                        $patient_count[$value['User']['id']] = 0;
                        $save_prices[$value['User']['id']] = 0.00;
                        $total_commision[$value['User']['id']] = 0.00;
                        $doctor_income[$value['User']['id']] = 0.00;
                    }
                }
            }

//             debug($all_patients); die;
            $this->set(compact('start_dt', 'save_prices', 'total_commision', 'doctor_income', 'patient_count'));
        }
//        debug($users); die;
        $this->set(compact('users','dr_list','salutations','f_date','l_date'));
    }
    
//    public function invoice_report() {
//        $dr_list = $user_condition = $users = array();
//        $post_flag = false;
//        $total_cost = $commission_total = 0.00;
//        $this->loadModel('Service');
//        $this->loadModel('User');
//        $start_dt = new DateTime('first day of this month');
//        $f_date = $start_dt->format('Y-m-d H:i:s');
//        $end_dt = new DateTime('last day of this month');
//        $l_date = $end_dt->format('Y-m-d H:i:s');
//        // get list of all active Doctors
//        $dr_list = $this->User->find('list', array('conditions' => array('User.user_type' => 2, 'User.is_active' => 1), 'fields' => array('User.id', 'User.full_name')));
//        $conditions = array('PatientPackageLog.start_date >=' => $f_date, 'PatientPackageLog.end_date <=' => $l_date);
//        
//        Configure::load('feish');
//        $salutations = Configure::read('feish.salutations');
//
////        if ($this->request->is('post')) {
////            $conditions = array();
////            $post_flag = true;
////            $user_data = $this->request->data;
////            if (!empty($user_data['PatientPackageLog']['from_date']) && !empty($user_data['PatientPackageLog']['to_date'])) {
////                $f_date = $conditions['PatientPackageLog.start_date  >= '] = date("Y-m-d", strtotime(str_replace('/', '-', $user_data['PatientPackageLog']['from_date'])));
////                $l_date = $conditions['PatientPackageLog.end_date <= '] = date("Y-m-d", strtotime(str_replace('/', '-', $user_data['PatientPackageLog']['to_date'])));
////            }
////            if (!empty($user_data['PatientPackageLog']['dr_name'])) {
////                $services_list = $this->Service->find('list', array('conditions' => array('Service.user_id' => $user_data['PatientPackageLog']['dr_name']), 'fields' => array('Service.id', 'Service.id')));
////                $conditions['PatientPackageLog.service_id'] = $services_list;
////            } else {
////                unset($conditions['PatientPackageLog.service_id']);
////            }
////            if ($user_data['PatientPackageLog']['from_date'] == '') {
////                unset($conditions['PatientPackageLog.start_date  >= ']);
////                $f_date = '';
////            }
////            if ($user_data['PatientPackageLog']['to_date'] == '') {
////                unset($conditions['PatientPackageLog.print_page <= ']);
////            }
////        }
//
//        $all_patients = $this->PatientPackageLog->find('all', array(
//            'conditions' => $conditions,
//            'group' => array('PatientPackageLog.service_id'),
//            'fields' => array('count(PatientPackageLog.service_id) as patient_count', 'sum(PatientPackageLog.price) as total_cost', 'sum(PatientPackageLog.commission) as commission', 'PatientPackageLog.service_id', 'sum(PatientPackageLog.used_visits) as total_visits')
//                )
//        );
//        
////        debug($all_patients);die;
//
//        if (!empty($all_patients)) {
//            if (!isset($services_list)) {
//                $services_list = array();
//                foreach ($all_patients as $key => $value) {
//                    array_push($services_list, $value['PatientPackageLog']['service_id']);
//                }
//            }
//            // get all doctors of a specific service
//            $users_list = $this->Service->find('list', array('conditions' => array('Service.id' => $services_list), 'fields' => array('Service.id', 'Service.user_id')));
//            if (!empty($users_list)) {
//                $user_condition = array('User.id' => $users_list, 'User.is_active' => 1);
//            }
//
//            $users = $this->User->find('all', array(
//                'conditions' => $user_condition,
//                'group' => array('User.id'),
//                    )
//            );
//            
//            $i=0;
//            foreach ($users as $value) {
//                foreach ($all_patients as $costs) {
//                    
//                    if ($costs['PatientPackageLog']['service_id'] == $value['Services'][$i]['id']) {
//                        $patient_count[$value['User']['id']] = $costs[0]['patient_count'];
//                        if ($costs[0]['patient_count'] > 0) {
//                            $save_prices[$value['User']['id']] = $costs[0]['total_cost'];
//                            $total_commision[$value['User']['id']] = $costs[0]['commission'];
//                            $doctor_income[$value['User']['id']] = $costs[0]['total_cost'] - $costs[0]['commission'];
//                        } else {
//                            $save_prices[$value['User']['id']] = 0.00;
//                            $total_commision[$value['User']['id']] = 0.00;
//                            $doctor_income[$value['User']['id']] = 0.00;
//                        }
//                        
//                    }
//                }
//            }
//
//            $this->set(compact('start_dt', 'save_prices', 'total_commision', 'doctor_income', 'patient_count'));
//        }
//        $this->set(compact('users','dr_list','salutations','f_date','l_date'));
//    }

    public function beforeFilter() {

        // $this->Auth->allow(array('can_cancel_appointment', 'get_data', 'get_time_slots_update'));
    }

}
