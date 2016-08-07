<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * PatientPackages Controller
 *
 * @property PatientPackage $PatientPackage
 * @property PaginatorComponent $Paginator
 */
class PatientPackagesController extends AppController {

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
        $this->PatientPackage->recursive = 0;
        $this->set('patientPackages', $this->Paginator->paginate());
    }

    public function listing() {
        $this->layout = 'front_layout';
        $this->PatientPackage->recursive = 0;
        $this->set('patientPackages', $this->Paginator->paginate());
        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
        $this->set(compact('yes_no'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null, $service_id = null) {
        $this->layout = 'front_layout';
        $purchased_flag = true;
        $this->loadModel('PatientPackageLog');
        Configure::load('feish');
        $plan_types = Configure::read('feish.plan_types');
        if (!$this->PatientPackage->exists($id)) {
            throw new NotFoundException(__('Invalid patient package'));
        }
        $options = array('conditions' => array('PatientPackage.' . $this->PatientPackage->primaryKey => $id));
        $patientPackage = $this->PatientPackage->find('first', $options);
        $patientPackagePlan = $this->PatientPackageLog->find('first', array('conditions' => array('PatientPackageLog.patient_package_id' => $id)));
        if(!empty($patientPackagePlan)) {
            if($patientPackagePlan['PatientPackageLog']['user_id'] == $this->Auth->user('id')) {
                if($patientPackagePlan['PatientPackageLog']['end_date'] > date('Y-m-d') || $patientPackagePlan['PatientPackageLog']['remaining_visits'] > 0){
                    $purchased_flag = false;
                    $this->Session->setFlash(_('You have already purchased this plan. Please purchase another plan.'), 'error');
                } else {
                    $purchased_flag = true;
                }
            }
        }
        $this->set(compact('plan_types', 'service_id','purchased_flag','patientPackage'));
    }

    public function pay_now($patient_package_id = null, $service_id = null) {
        $this->layout = null;
        // debug($this->Auth->user());
        $data = $this->Auth->user();
        //  debug($data);die;
        if (empty($data)) {
            $this->Session->setFlash(_('Please login to purchase a plan'), 'error');
            $this->redirect(array('controller' => 'users', 'action' => 'login', 1, $patient_package_id));
        } else {
            if ($this->Auth->user('user_type') != 4) {
                $this->Session->setFlash(_('Sorry, You are not patient.Please login as patient'), 'error');
                $this->redirect(array('controller' => 'services', 'action' => 'service_details', $service_id));
            }
        }

        $this->loadModel('PatientPackageLog');
        $exists_packege = $this->PatientPackageLog->find('count', array('conditions' => array('PatientPackageLog.user_id' => $this->Auth->user('id'), 'PatientPackageLog.patient_package_id' => $patient_package_id, 'PatientPackageLog.end_date >=' => date('Y-m-d'), 'PatientPackageLog.remaining_visits NOT' => 0)));
        if ($exists_packege > 0) {
            $this->Session->setFlash(_('You have already purchased this plan. You can not purchase it again.'), 'error');
            $this->redirect(array('controller' => 'services', 'action' => 'service_details', $service_id));
        }

        $fetch_data = $this->PatientPackage->find('first', array('conditions' => array('PatientPackage.id' => $patient_package_id)));
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
        $success_url = Router::url('/', true) . "patient_packages/pay_success";
        $fail_url = Router::url('/', true) . "patient_packages/pay_fail";

        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $posted['key'] = 'K97oTaDC';
        $posted['txnid'] = $txnid;
        $posted['amount'] = $fetch_data['PatientPackage']['price'];
        $posted['productinfo'] = 'testing';
        $posted['firstname'] = $this->Auth->user('first_name');
        $posted['phone'] = $this->Auth->User('mobile');
        $posted['surl'] = $success_url;
        $posted['furl'] = $fail_url;
        $posted['email'] = $this->Auth->User('email');
        $posted['service_provider'] = 'payu_paisa';
        $posted['udf1'] = $fetch_data['PatientPackage']['id'];
        $posted['udf2'] = $this->Auth->User('id');
        $posted['udf3'] = $service_id;
        $posted['hash'] = '';
        $current_transaction_ids['package_id'] = $fetch_data['PatientPackage']['id'];
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
        //debug($posted);die;
        $action = $PAYU_BASE_URL . '/_payment';
        $this->set(compact('hash', 'action', 'posted', 'MERCHANT_KEY', 'txnid'));

        $this->render('payu_form');
    }

    public function pay_success() {
        $this->layout = 'front_layout';

        if (isset($this->request->data) && !empty($this->request->data)) {
            if ($this->request->data['status'] == 'success' || $this->request->data['status'] == 'pending') {
                
                $save_data = array();
                $fetch_data = $this->PatientPackage->find('first', array('conditions' => array('PatientPackage.id' => $this->request->data['udf1'])));
                /*added by yogesh more for commission*/
                $this->loadModel('DoctorPlanDetail');
                $fetch_percentage_par_vists = $this->DoctorPlanDetail->find('first', array('conditions' => array('DoctorPlanDetail.user_id' => $fetch_data['PatientPackage']['user_id'],'DoctorPlanDetail.end_date >'=>date('Y-m-d'))));
//                $fetch_percentage_par_vists = $this->DoctorPlanDetail->find('first', array('conditions' => array('DoctorPlanDetail.user_id' => $fetch_data['PatientPackage']['user_id']),'order'=>'DoctorPlanDetail.id desc'));
                $percentage_per_visit = $fetch_percentage_par_vists['DoctorPlanDetail']['percentage_per_visit'];
                $commission = ($fetch_data['PatientPackage']['price']*$percentage_per_visit)/100;
                /*end*/
                $save_data['PatientPackageLog']['mode'] = $this->request->data['mode'];
                $save_data['PatientPackageLog']['status'] = $this->request->data['status'];
                $save_data['PatientPackageLog']['mihpayid'] = $this->request->data['mihpayid'];
                $save_data['PatientPackageLog']['user_id'] = $this->request->data['udf2'];
                $save_data['PatientPackageLog']['patient_package_id'] = $this->request->data['udf1'];
                $save_data['PatientPackageLog']['used_visits'] = 0;
                $save_data['PatientPackageLog']['remaining_visits'] = $fetch_data['PatientPackage']['valid_visits'];
                $save_data['PatientPackageLog']['start_date'] = date('Y-m-d');
                $save_data['PatientPackageLog']['end_date'] = date('Y-m-d', strtotime('+' . $fetch_data['PatientPackage']['validity'] . ' days'));
                $save_data['PatientPackageLog']['package_name'] = $fetch_data['PatientPackage']['name'];
                $save_data['PatientPackageLog']['validity'] = $fetch_data['PatientPackage']['validity'];
                $save_data['PatientPackageLog']['price'] = $fetch_data['PatientPackage']['price'];
                $save_data['PatientPackageLog']['commission'] = $commission;

                $save_data['PatientPackageLog']['valid_visits'] = $fetch_data['PatientPackage']['valid_visits'];
                $save_data['PatientPackageLog']['plan_type'] = $fetch_data['PatientPackage']['plan_type'];
                $save_data['PatientPackageLog']['plan_details'] = $fetch_data['PatientPackage']['plan_details'];
                $save_data['PatientPackageLog']['service_id'] = $fetch_data['PatientPackage']['service_id'];
                $this->loadModel('PatientPackageLog');
                Configure::load('feish');
//                debug($save_data);
                $salutations = Configure::read('feish.salutations');
                $this->PatientPackageLog->create();
                if ($this->PatientPackageLog->save($save_data)) {
                    $users=$this->Auth->user();
                    $users['active_package_count']=1;
                    $this->Auth->login($users);
                    $details_row = $this->PatientPackageLog->find('first', array('conditions' => array('PatientPackageLog.id' => $this->PatientPackageLog->id),
                        'fields' => array('PatientPackageLog.id', 'PatientPackageLog.patient_package_id', 'PatientPackageLog.package_name', 'PatientPackageLog.price', 'PatientPackageLog.created', 'User.salutation', 'User.id', 'User.mobile', 'User.first_name', 'User.last_name', 'User.email', 'Service.user_id', 'Service.address'),
                        //'recursive' => 2
                    ));
                    $doctor=$this->PatientPackage->User->find('first',array('conditions'=>array('User.id'=>$details_row['Service']['user_id']),'fields'=>array('User.first_name','User.last_name','User.salutation','User.email','User.mobile')));
                   
                    $details['doctor_name'] = $salutations[$doctor['User']['salutation']] . ". " . $doctor['User']['first_name'] . " " . $doctor['User']['last_name'];
                    $details['address'] = $details_row['Service']['address'];
                    $details['user_name'] = $salutations[$details_row['User']['salutation']] . ". " . $details_row['User']['first_name'] . " " . $details_row['User']['last_name'];

                    $details['id'] = $details_row['PatientPackageLog']['id'];
                    $details['patient_package_id'] = $details_row['PatientPackageLog']['patient_package_id'];
                    $details['created'] = $details_row['PatientPackageLog']['created'];
                    $details['package_name'] = $details_row['PatientPackageLog']['package_name'];
                    $details['price'] = $details_row['PatientPackageLog']['price'];
                        /* send mail patient */
                    $email = new CakeEmail();
                    $email->config('plan_purchased_mail_for_patient');
                    $email->to($details_row['User']['email']);
                    $email->viewVars(compact('details'));
                    $email->subject('Your purchased plan');
                    $email->send();

                    /* send mail doctor */
                    $email = new CakeEmail();
                    $email->config('plan_purchased_mail_for_patient_to_doctor');
                    $email->to($doctor['User']['email']);
                    $email->viewVars(compact('details'));
                    $email->subject('Patient purchased plan');
                    $email->send();

                    /* send mail to admin */
                    $email = new CakeEmail();
                    $email->config('plan_purchased_mail_for_patient_to_admin');
                    $email->to('siddiqui.azhar@gmail.com');
                    $email->viewVars(compact('details'));
                    $email->subject('Purchased Plan');
                    $email->send();

                    /* send sms to patient */
                    $number = $details_row['User']['mobile'];

                    $message = "Dear " .$details['user_name']. ", you have ordered a plan" . $details['package_name'] ." for ". $details['price'] ." on ". date('d-M-Y h:i:s A',strtotime($details['created'])) ." Please call on 9876765456 for help.";
                    $url = "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=feishtest&password=210295899&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                    $ch = curl_init($url);

                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $curl_scraped_page = curl_exec($ch);
                    curl_close($ch);
                    
                    /* send sms to doctor */
                    $number = $doctor['User']['mobile'];
                    $message = "Dear " . $details['user_name'] . " you have ordered a plan" . $details['package_name'] . " for ". $details['price'] ." on ". date('d-M-Y h:i:s A',strtotime($details['created'])) ." Please call on 9876765456 for help.";
                    $url = "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=feishtest&password=210295899&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                    $ch = curl_init($url);
                    
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $curl_scraped_page = curl_exec($ch);
                    curl_close($ch);
                    
                    /* send sms to admin */
                    $number = '9953333592';
                    $message = "An order for the purchase of plan is made on ".date('d-M-Y h:i:s A',strtotime($details['created'])) ." by" . $details['user_name'] . " to" . $details['doctor_name'];
                    $url = "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=feishtest&password=210295899&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                    $ch = curl_init($url);
                    
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $curl_scraped_page = curl_exec($ch);
                    curl_close($ch);

                    $this->loadModel('Communication');
                    $communication_data = array();
                    $communication_data['Communication']['subject'] = 'Patient Plan Purchased';
                    $communication_data['Communication']['message'] = 'Hello ' . $details['user_name'] . ', You have made a ordered for plan ' . $details['package_name'] . ' For  Rs:' . $details['price'] . 'On' . date('d-M-Y', strtotime($details['created'])) . 'Please call on 9876765456 or help@feish.com for help.';
                    $communication_data['Communication']['parent_id'] = 0;
                    $communication_data['Communication']['user_id'] = 0;
                    $communication_data['Communication']['reciever_user_id'] = $details_row['User']['id'] . "," . $fetch_data['Service']['user_id'];
                    $communication_data['Communication']['service_id'] = $fetch_data['PatientPackage']['service_id'];
                    $this->Communication->save($communication_data);
                }
            }
            $this->Session->setFlash('You have successfully purchased the plan.', 'success');
            $this->redirect(array('controller' => 'services', 'action' => 'service_details', $fetch_data['PatientPackage']['service_id']));
            //debug($this->request->data);
        }
    }

    public function pay_fail() {
        $this->layout = null;
        if (isset($this->request->data) && !empty($this->request->data)) {
            if ($this->request->data['status'] == 'fail') {

                $this->Session->setFlash('Error in transaction.please try again', 'error');
                $this->redirect(array('controller' => 'services', 'action' => 'service_details', $this->request->data['udf3']));
            }
            //debug($this->request->data);
        }
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->PatientPackage->create();
            if ($this->PatientPackage->save($this->request->data)) {
                $this->Session->setFlash(__('The patient package has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The patient package could not be saved. Please, try again.'));
            }
        }
        $services = $this->PatientPackage->Service->find('list');
        $users = $this->PatientPackage->User->find('list');
        $this->set(compact('services', 'users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->PatientPackage->exists($id)) {
            throw new NotFoundException(__('Invalid patient package'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->PatientPackage->save($this->request->data)) {
                $this->Session->setFlash(__('The patient package has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The patient package could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('PatientPackage.' . $this->PatientPackage->primaryKey => $id));
            $this->request->data = $this->PatientPackage->find('first', $options);
        }
        $services = $this->PatientPackage->Service->find('list');
        $users = $this->PatientPackage->User->find('list');
        $this->set(compact('services', 'users'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->PatientPackage->id = $id;
        if (!$this->PatientPackage->exists()) {
            throw new NotFoundException(__('Invalid patient package'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->PatientPackage->delete()) {
            $this->Session->setFlash(__('The patient package has been deleted.'));
        } else {
            $this->Session->setFlash(__('The patient package could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function beforeFilter() {
        $this->Auth->allow(array('pay_success', 'pay_now', 'view'));
    }

}
