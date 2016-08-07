<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * DoctorPackages Controller
 *
 * @property DoctorPackage $DoctorPackage
 * @property PaginatorComponent $Paginator
 */
class DoctorPackagesController extends AppController {

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
    public function index_pkg() {


        Configure::load('feish');
        $keywords = Configure::read('feish.search_keywords');

        $this->DoctorPackage->recursive = 0;
        $this->set('doctorPackages', $this->Paginator->paginate());

        $this->loadModel('DoctorAssistant');
        $this->loadModel('DoctorPlanDetail');
        $this->loadModel('DoctorPackage');
        $login_userId = $this->Auth->user('id');
        $services = $this->DoctorAssistant->Service->find('list', array('conditions' => array('Service.user_id' => $login_userId)));
//        $plan_ids = $this->DoctorPlanDetail->find('list', array('conditions' => array('DoctorPlanDetail.user_id' => $login_userId, 'is_deleted' => 0), 'fields' => array('DoctorPlanDetail.doctor_package_id')));
        $plans = $this->DoctorPackage->find('all');
//        debug($plan_ids); die;
        $this->set(compact('services', 'plans', 'keywords'));
    }

    public function index() {
        $this->DoctorPackage->recursive = 0;
        $this->set('doctorPackages', $this->Paginator->paginate());

        $this->loadModel('DoctorAssistant');
        $this->loadModel('PatientPackage');
        $login_userId = $this->Auth->user('id');
        if ($login_userId == 1) {
            $services = $this->DoctorAssistant->Service->find('list');
            $plans = $this->PatientPackage->find('all', array('fields' => array('PatientPackage.id', 'PatientPackage.name', 'PatientPackage.plan_details', 'PatientPackage.price', 'PatientPackage.valid_visits', 'PatientPackage.validity', 'PatientPackage.service_id', 'PatientPackage.is_deleted')));
        } else {
            $services = $this->DoctorAssistant->Service->find('list', array('conditions' => array('Service.user_id' => $login_userId)));
            $plans = $this->PatientPackage->find('all', array('conditions' => array('PatientPackage.user_id' => $login_userId), 'fields' => array('PatientPackage.id', 'PatientPackage.name', 'PatientPackage.plan_details', 'PatientPackage.price', 'PatientPackage.valid_visits', 'PatientPackage.validity', 'PatientPackage.service_id', 'PatientPackage.is_deleted')));
        }
//        debug($plans);die;
        $this->set(compact('services', 'plans'));
    }

    public function doctor_plans() {
        Configure::load('feish');
        $this->DoctorPackage->recursive = 0;
        $this->set('doctorPackages', $this->Paginator->paginate());

        $this->loadModel('DoctorAssistant');
        $this->loadModel('DoctorPlanDetail');
        $this->loadModel('DoctorPackage');
        $login_userId = $this->Auth->user('id');
        $services = $this->DoctorAssistant->Service->find('list', array('conditions' => array('Service.user_id' => $login_userId)));
//        $plan_ids = $this->DoctorPlanDetail->find('list', array('conditions' => array('DoctorPlanDetail.user_id' => $login_userId, 'is_deleted' => 0), 'fields' => array('DoctorPlanDetail.doctor_package_id')));
        $plans = $this->DoctorPackage->find('all');
//        debug($plan_ids); die;
        $this->set(compact('services', 'plans'));
    }

    public function add() {

        $this->loadModel('Service');
        $this->loadModel('PatientPackage');
        Configure::load('feish');
        $plan_types = Configure::read('feish.plan_types');
        $login_userId = $this->Auth->user('id');
        if ($login_userId == 1) {
            $services = $this->Service->find('list');
        } else {
            $services = $this->Service->find('all', array(
                        'recursive' => -1,
                        'fields' => array('Service.id', 'Service.title', 'Service.is_active'),
                        'conditions' => array('Service.user_id' => $login_userId)
                    )
            );
            $arr = array();
            $is_active = array('Inactive','Active');
            foreach($services as $key=>$val){
                $arr[$val['Service']['id']] = $val['Service']['title']." - (".$is_active[$val['Service']['is_active']].")";
            }
            $services = $arr;
        }
        $this->request->data['DoctorPackage']['user_id'] = $login_userId;

        if ($this->request->is('post')) {
            $this->PatientPackage->create();
            if ($this->PatientPackage->save($this->request->data['DoctorPackage'])) {
                $this->Session->setFlash(__('The doctor package has been saved.'), 'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The doctor package could not be saved. Please, try again.'), 'error');
            }
        }

        $this->set(compact('users', 'services', 'plan_types'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {

        $this->loadModel('PatientPackage');
        $this->loadModel('Service');
        $login_userId = $this->Auth->user('id');

        if (!$this->PatientPackage->exists($id)) {
            throw new NotFoundException(__('Invalid doctor package'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->PatientPackage->id = $id;
            if ($this->PatientPackage->save($this->request->data['DoctorPackage'])) {
                $this->Session->setFlash(__('The doctor package has been updated successfully.'), 'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The doctor package could not be updated. Please, try again.'), 'error');
            }
        } else {
            $options = array('conditions' => array('PatientPackage.' . $this->PatientPackage->primaryKey => $id));
            $doctor_plan = $this->request->data = $this->PatientPackage->find('first', $options);
            $doctor_patient_package = $doctor_plan['PatientPackage'];
            
            $services = $this->Service->find('all', array(
                        'recursive' => -1,
                        'fields' => array('Service.id', 'Service.title', 'Service.is_active'),
                        'conditions' => array('Service.user_id' => $login_userId)
                    )
            );
            $arr = array();
            $is_active = array('Inactive','Active');
            foreach($services as $key=>$val){
                $arr[$val['Service']['id']] = $val['Service']['title']." - (".$is_active[$val['Service']['is_active']].")";
            }
            $services = $arr;
        }
        $this->set(compact('doctor_patient_package', 'services'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->DoctorPackage->exists($id)) {
            throw new NotFoundException(__('Invalid doctor package'));
        }
        $options = array('conditions' => array('DoctorPackage.' . $this->DoctorPackage->primaryKey => $id));
        $this->set('doctorPackage', $this->DoctorPackage->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add_pkg() {

        if ($this->request->is('post')) {
            $this->DoctorPackage->create();
            if ($this->DoctorPackage->save($this->request->data['DoctorPackage'])) {
                $this->Session->setFlash(__('The doctor package has been saved.'), 'success');
                return $this->redirect(array('action' => 'index_pkg'));
            } else {
                $this->Session->setFlash(__('The doctor package could not be saved. Please, try again.'), 'error');
            }
        }
        Configure::load('feish');
        $plan_types = Configure::read('feish.plan_types');
        //debug($plan_types);die;
        $this->set(compact('users', 'services', 'plan_types'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit_pkg($id = null) {

        if (!$this->DoctorPackage->exists($id)) {
            throw new NotFoundException(__('Invalid doctor package'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->DoctorPackage->id = $id;
            if ($this->DoctorPackage->save($this->request->data['DoctorPackage'])) {
                $this->Session->setFlash(__('The doctor package has been updated successfully.'), 'success');
                return $this->redirect(array('action' => 'index_pkg'));
            } else {
                $this->Session->setFlash(__('The doctor package could not be updated. Please, try again.'), 'error');
            }
        } else {
            $options = array('conditions' => array('DoctorPackage.' . $this->DoctorPackage->primaryKey => $id));
            $doctor_plan = $this->request->data = $this->DoctorPackage->find('first', $options);
        }
        $this->set(compact('doctor_patient_package', 'services'));
    }

    public function view_paln_details() {

        $this->layout = null;
        $this->loadModel('PatientPackage');
        $this->loadModel('DoctorAssistant');
        $login_userId = $this->Auth->user('id');
        $id = $this->request->data['id'];

        if (!$this->PatientPackage->exists($id)) {
            throw new NotFoundException(__('Invalid doctor package'));
        }

        $options = array('conditions' => array('PatientPackage.' . $this->PatientPackage->primaryKey => $id));
        $doctor_plan = $this->request->data = $this->PatientPackage->find('first', $options);
//        debug($doctor_plan);die;
//        $doctor_patient_package = $doctor_plan['PatientPackage'];
        $doctor_patient_package = $doctor_plan;
        $services = $this->DoctorAssistant->Service->find('list', array('conditions' => array('Service.user_id' => $login_userId)));
        $this->set(compact('doctor_patient_package', 'services'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {

        $this->loadModel('PatientPackage');
        $this->loadModel('DoctorAssistant');
        $login_userId = $this->Auth->user('id');
        $this->PatientPackage->id = $id;
        if (!$this->PatientPackage->exists()) {
            throw new NotFoundException(__('Invalid plan'));
        }

        $data = $this->PatientPackage->find('first', array('conditions' => array('PatientPackage.id' => $id), 'fields' => array('is_deleted')));
        $status = 0;
        if ($data['PatientPackage']['is_deleted'] == 0) {
            $status = 1;
        } else {
            $status = 0;
        }

        if ($this->PatientPackage->updateAll(array('PatientPackage.is_deleted' => $status), array('PatientPackage.id' => $id))) {
            if ($status == 0) {
                $this->Session->setFlash(__('The Doctor service plan has been activate.'), 'success');
            } else {
                $this->Session->setFlash(__('The Doctor service plan has been deactivate.'), 'success');
            }
        } else {
            if ($status == 0) {
                $this->Session->setFlash(__('The Doctor could not be activate.Please Try again'), 'error');
            } else {
                $this->Session->setFlash(__('The Doctor could not be deactivate..Please Try again'), 'error');
            }
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function pay_now($doctor_package_id = null) {
        $this->loadModel('DoctorPlanDetail');
        $exists_packege = $this->DoctorPlanDetail->find('count', array('conditions' => array('DoctorPlanDetail.user_id' => $this->Auth->user('id'), 'DoctorPlanDetail.end_date >=' => date('Y-m-d'))));
        if ($exists_packege > 0) {
            $this->Session->setFlash(_('You  already have active plan. You can not purchase.'), 'error');
            $this->redirect(array('controller' => 'doctor_packages', 'action' => 'view', $doctor_package_id));
        }

        $this->layout = null;
        $fetch_data = $this->DoctorPackage->find('first', array('conditions' => array('DoctorPackage.id' => $doctor_package_id)));
        //  debug($fetch_data);die;
        $MERCHANT_KEY = "K97oTaDC";
        // Merchant Salt as provided by Payu
        $SALT = "wCA58bY37Q";
        // End point - change to https://secure.payu.in for LIVE mode
        $PAYU_BASE_URL = "https://test.payu.in";

        $action = '';

        $posted = array();
        /*    if (!empty($_POST)) {
          //print_r($_POST);
          foreach ($_POST as $key => $value) {
          $posted[$key] = $value;
          }
          } */
        $success_url = Router::url('/', true) . "doctor_packages/pay_success";
        $fail_url = Router::url('/', true) . "doctor_packages/pay_fail";

        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $posted['key'] = 'K97oTaDC';
        $posted['txnid'] = $txnid;
        $posted['amount'] = $fetch_data['DoctorPackage']['price'];
        $posted['productinfo'] = 'testing';
        $posted['firstname'] = $this->Auth->user('first_name');
        $posted['phone'] = $this->Auth->User('mobile');
        $posted['surl'] = $success_url;
        $posted['furl'] = $fail_url;
        $posted['email'] = $this->Auth->User('email');
        $posted['service_provider'] = 'payu_paisa';
        $posted['udf1'] = $fetch_data['DoctorPackage']['id'];
        $posted['udf2'] = $this->Auth->User('id');
        // $posted['udf3'] = $service_id;
        $posted['hash'] = '';
        $current_transaction_ids['package_id'] = $fetch_data['DoctorPackage']['id'];
        $current_transaction_ids['user_id'] = $this->Auth->User('id');

        if ($this->Session->check('current_transaction_ids')) {
            // $current_transaction_ids=$this->Session->read('current_transaction_ids');
            $this->Session->destroy('current_transaction_ids');
        }
        $this->Session->write('current_transaction_ids', $current_transaction_ids);

        /*
          $posted['key'] = 'K97oTaDC';
          $posted['txnid'] = $txnid;
          $posted['amount'] = '100';
          $posted['productinfo'] = 'testing';
          $posted['firstname'] = 'Sonali';
          $posted['phone'] ='7686574323';
          $posted['surl'] = 'http://localhost/feish/patient_packages/pay_success';
          $posted['furl'] = 'http://localhost/feish/patient_packages/pay_fail';
          $posted['email'] = 'sonaligosw1192@gmail.com';
          $posted['service_provider'] = 'payu_paisa';
          //$posted['udf1'] = '2';
          // $posted['udf2'] = '3';
          $posted['hash'] = ''; */

        $hash = '';

// Hash Sequence
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

        //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';
        foreach ($hashVarsSeq as $hash_var) {
            $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
            $hash_string .= '|';
        }

        $hash_string .= $SALT;


        $hash = strtolower(hash('sha512', $hash_string));
        $posted['hash'] = $hash;
//        debug($posted);die;
        $action = $PAYU_BASE_URL . '/_payment';
        $this->set(compact('hash', 'action', 'posted', 'MERCHANT_KEY', 'txnid'));
        $this->render('payu_form');
    }

    public function pay_success() {
        $this->layout = 'front_layout';

        if (isset($this->request->data) && !empty($this->request->data)) {
            if ($this->request->data['status'] == 'success') {
                $save_data = array();
                $fetch_data = $this->DoctorPackage->find('first', array('conditions' => array('DoctorPackage.id' => $this->request->data['udf1'])));
//                debug($fetch_data);die;
                $save_data['DoctorPlanDetail']['mode'] = $this->request->data['mode'];
                $save_data['DoctorPlanDetail']['status'] = $this->request->data['status'];
                $save_data['DoctorPlanDetail']['mihpayid'] = $this->request->data['mihpayid'];
                $save_data['DoctorPlanDetail']['user_id'] = $this->request->data['udf2'];
                $save_data['DoctorPlanDetail']['doctor_package_id'] = $this->request->data['udf1'];
                $save_data['DoctorPlanDetail']['start_date'] = date('Y-m-d');
                $days = $fetch_data['DoctorPackage']['validity'];
                $save_data['DoctorPlanDetail']['validity'] = $fetch_data['DoctorPackage']['validity'];
                $save_data['DoctorPlanDetail']['end_date'] = date('Y-m-d', strtotime('+' . $days . ' days'));
                $save_data['DoctorPlanDetail']['name'] = $fetch_data['DoctorPackage']['name'];
                $save_data['DoctorPlanDetail']['percentage_per_visit'] = $fetch_data['DoctorPackage']['percentage_per_visit'];
                $save_data['DoctorPlanDetail']['price'] = $fetch_data['DoctorPackage']['price'];

                $save_data['DoctorPlanDetail']['plan_details'] = $fetch_data['DoctorPackage']['plan_details'];
                $this->loadModel('DoctorPlanDetail');
                Configure::load('feish');
                $salutations = Configure::read('feish.salutations');
                $this->DoctorPlanDetail->create();
                if ($this->DoctorPlanDetail->save($save_data)) {
                    $details_row = $this->DoctorPlanDetail->find('first', array('conditions' => array('DoctorPlanDetail.id' => $this->DoctorPlanDetail->id),
                        'fields' => array('DoctorPlanDetail.id', 'DoctorPlanDetail.name', 'DoctorPlanDetail.price', 'DoctorPlanDetail.created', 'User.id', 'User.salutation', 'User.first_name', 'User.last_name', 'User.email', 'User.mobile'),
                    ));
//                    debug($details_row);die;
                    $details['user_name'] = $salutations[$details_row['User']['salutation']] . ". " . $details_row['User']['first_name'] . " " . $details_row['User']['last_name'];
                    $details['id'] = $details_row['DoctorPlanDetail']['id'];
                    $details['created'] = $details_row['DoctorPlanDetail']['created'];
                    $details['package_name'] = $details_row['DoctorPlanDetail']['name'];
                    $details['price'] = $details_row['DoctorPlanDetail']['price'];

                    /* start :: mail text for doctor */
                    $email = new CakeEmail();
                    $email->config('plan_purchased_mail');
                    $email->to($details_row['User']['email']);
                    $email->viewVars(compact('details'));
                    $email->subject('Your purchased plan');
                    $email->send();

                    /* start :: mail text for admin */
                    $email = new CakeEmail();
                    $email->config('plan_purchased_mail_admin');
                    $email->to('subscribe@feish.online');
                    $email->viewVars(compact('details'));
                    $email->subject('Purchased plan');
                    $email->send();
                    /* end */

                    /* send sms to doctor */
                    $number = $details_row['User']['mobile'];

                    $message = "Dear " . $details['user_name'] . ", you have ordered a plan" . $details['package_name'] . " for " . $details['price'] . " on " . date('d-m-Y h:i:s A', strtotime($details['created'])) . "Please call on 9876765456 or help@feish.com for help.";
                    $url = "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=feishtest&password=1198230549&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                    $ch = curl_init($url);

                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $curl_scraped_page = curl_exec($ch);
                    curl_close($ch);

                    /* send sms to admin */
                    $number = '9953333592';
                    $message = "Dear " . $details['user_name'] . " you have made a ordered a plan" . $details['package_name'] . "& " . $details['id'] . " for " . $details['price'] . " on " . date('d-m-Y h:i:s A', strtotime($details['created']));
                    $url = "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=feishtest&password=1198230549&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                    $ch = curl_init($url);

                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $curl_scraped_page = curl_exec($ch);
                    curl_close($ch);

                    $this->loadModel('Communication');
                    $communication_data = array();
                    $communication_data['Communication']['subject'] = 'Plan Purchased';
                    $communication_data['Communication']['message'] = 'Hello ' . $details['user_name'] . ', You have made a ordered for plan ' . $details['package_name'] . ' For  Rs:' . $details['price'] . 'On' . date('d-M-Y', strtotime($details['created'])) . 'Please call on 9876765456 or help@feish.com for help.';
                    $communication_data['Communication']['parent_id'] = 0;
                    $communication_data['Communication']['user_id'] = 0;
                    $communication_data['Communication']['reciever_user_id'] = $details_row['User']['id'];
                    // $communication_data['Communication']['service_id']=$fetch_data['PatientPackage']['service_id'];
                    $this->Communication->save($communication_data);
                }
            }
            $this->Session->setFlash('You have successfully purchased the plan.', 'success');
            $this->redirect(array('controller' => 'users', 'action' => 'doctors_dashboard'));
        }
    }

    public function pay_fail() {
        $this->layout = null;
        if (isset($this->request->data) && !empty($this->request->data)) {
            if ($this->request->data['status'] == 'fail') {

                $this->Session->setFlash('Error in transaction.please try again', 'error');
                $this->redirect(array('controller' => 'users', 'action' => 'doctors_dashboard'));
            }
            //debug($this->request->data);
        }
    }

}
