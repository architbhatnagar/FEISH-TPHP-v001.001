<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * DoctorAssistants Controller
 *
 * @property DoctorAssistant $DoctorAssistant
 * @property PaginatorComponent $Paginator
 */
class DoctorAssistantsController extends AppController {

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
    public function index($user_type = null) {
        //$this->layout = 'front_layout';
        $this->DoctorAssistant->recursive = 0;
        $login_userId = $this->Auth->user('id');
        $this->loadModel('User');

        if (!empty($user_type)) {

            $this->paginate = array(
                'conditions' => array('User.user_type' => $user_type, 'User.added_by_doctor_id' => $login_userId),
                'order' => 'User.id DESC',
                'group' => 'User.id',
                'limit' => 20
            );
        } else {
            $this->paginate = array(
                'order' => 'User.id DESC',
                'group' => 'User.id',
                'limit' => 20
            );
        }

        $users = $this->Paginator->paginate();
//        debug($users);die;
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $user_types = Configure::read('feish.user_types');
        $this->set(compact('users', 'yes_no', 'user_type', 'user_types'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->DoctorAssistant->exists($id)) {
            throw new NotFoundException(__('Invalid doctor assistant'));
        }
        $options = array('conditions' => array('DoctorAssistant.' . $this->DoctorAssistant->primaryKey => $id));
        $this->set('doctorAssistant', $this->DoctorAssistant->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {

        $login_userId = $this->Auth->user('id');
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        if ($this->request->is('post')) {
            $this->loadModel('User');

            $this->User->create();
            $request_data = $this->request->data;
            $service_id[] = $request_data['DoctorAssistant']['service_id'];
            $service_ids = $service_id[0];
            $this->request->data['DoctorAssistant']['added_by_doctor_id'] = $login_userId;
            $this->request->data['DoctorAssistant']['ip_address'] = $this->request->clientIp();
            $this->request->data['DoctorAssistant']['is_verified'] = 0;
            $password = $this->request->data['DoctorAssistant']['password'];

            if ($this->User->save($this->request->data['DoctorAssistant'])) {

                $last_insert_id = $this->User->id;
                $registerd_id = $last_insert_id;
                $registration_no = substr(str_shuffle(str_repeat('0123456789', 5)), 0, 7) . $registerd_id;

                $this->User->updateAll(array('User.registration_no' => "'" . $registration_no . "'"), array('User.id' => $registerd_id));

                if ($service_ids != "") {
                    foreach ($service_ids as $value) {
                        $this->DoctorAssistant->create();
                        $assitant_arr = array('user_id' => $last_insert_id, 'service_id' => $value, 'doctor_id' => $login_userId);
                        $this->DoctorAssistant->save($assitant_arr);
                    }

                    $this->Session->setFlash(__('The doctor assistant has been saved.'), 'success');
                    $fetch_data = $this->User->find('first', array('conditions' => array('User.id' => $registerd_id)));
                    $verify_link = Router::url('/', true) . 'users/verify_account/' . base64_encode($registerd_id);

                    $email = new CakeEmail();
                    $email->config('verify_account');
                    $email->to($fetch_data['User']['email']);
                    $email->viewVars(compact('fetch_data', 'verify_link', 'salutations', 'registration_no', 'password'));
                    $email->subject('Verify Account');
                    $email->send();

                    $email = new CakeEmail();
                    $email->config('new_registration');
                    $email->to('subscribe@feish.online');
                    $email->viewVars(compact('fetch_data', 'verify_link', 'salutations', 'registration_no', 'password'));
                    $email->subject('New Registration');
                    $email->send();

                    $number = $fetch_data['User']['mobile'];
                    $message = "Dear " . $salutations[$fetch_data['User']['salutation']].". ".$fetch_data['User']['first_name'] . ". Please login to the website feish.onlin to verify the details.Please call on 01204164011 for assistance.";
                    
//                    $message = "Dear " . ucfirst($fetch_data['User']['first_name']) . " " . ucfirst($fetch_data['User']['last_name']) . " your registration number:" . $registration_no . ". Please check mail to verify your account. Please call on 01204164011 for assistance.";
                    $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $curl_scraped_page = curl_exec($ch);
                    curl_close($ch);


                    /* sms text for admin */
                    $number = '9953333592';
                    $message = "User " . ucfirst($fetch_data['User']['first_name']) . " " . ucfirst($fetch_data['User']['last_name']) . " has registered on " . date('d-m-Y h:i:s A') . " Registration number: ASS-" . $registration_no . " : Please verify the details and approve";
                    $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                    $ch = curl_init($url);

                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $curl_scraped_page = curl_exec($ch);
                    curl_close($ch);
                    /* end */

                    return $this->redirect(array('controller' => 'doctor_assistants', 'action' => 'index', 3));
                } else {
                    $this->Session->setFlash(__('The doctor assistant could not be saved. Please, try again.'), 'error');
                }
            }
        }
        $users = $this->DoctorAssistant->User->find('list');
        $services = $this->DoctorAssistant->Service->find('list', array('conditions' => array('Service.user_id' => $this->Auth->user('id')), 'fields' => array('Service.id', 'Service.title')));
        $this->set(compact('users', 'services'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {

        $this->loadModel('User');
        $login_userId = $this->Auth->user('id');

        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid doctor assistant'));
        }

        $services_ids = $this->DoctorAssistant->find('list', array('conditions' => array('DoctorAssistant.user_id' => $id), 'fields' => array('service_id', 'service_id')));

        if ($this->request->is(array('post', 'put'))) {

            $posted_data = $this->request->data;
            $posted_servive_ids = $posted_data['User']['service_id'];

            $this->User->id = $id;
            if ($this->User->save($this->request->data['User'])) {
                $current_insert_id = array();
                /* Add new services */
                foreach ($posted_servive_ids as $value) {

                    $new_service_ids_arr['DoctorAssistant'] = array('user_id' => $id, 'service_id' => $value, 'doctor_id' => $login_userId);
                    $count = $this->DoctorAssistant->find('first', array('conditions' => array('DoctorAssistant.user_id' => $id, 'DoctorAssistant.service_id' => $value, 'DoctorAssistant.doctor_id' => $login_userId), 'fields' => array('DoctorAssistant.service_id')));
                    // debug($new_service_ids_arr  );die;
                    if (empty($count)) {
                        $this->DoctorAssistant->create();
                        $this->DoctorAssistant->save($new_service_ids_arr['DoctorAssistant']);
                        if ($this->DoctorAssistant->save($new_service_ids_arr['DoctorAssistant'])) {
                            array_push($current_insert_id, $value);
                        }
                    } else {
                        array_push($current_insert_id, $count['DoctorAssistant']['service_id']);
                    }
                }

                $condition = array('DoctorAssistant.service_id NOT' => $current_insert_id, 'doctor_id' => $login_userId);
                $this->DoctorAssistant->deleteAll($condition, false);

                $this->Session->setFlash(__('The doctor assistant has been updated successfully.'), 'success');
                return $this->redirect(array('controller' => 'doctor_assistants', 'action' => 'index', 3));
            } else {
                $this->Session->setFlash(__('The doctor assistant could not be saved. Please, try again.'), 'error');
            }
        } else {

            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $users = $this->request->data = $this->User->find('first', $options);
        }

        $services = $this->DoctorAssistant->Service->find('list', array('conditions' => array('Service.user_id' => $this->Auth->user('id')), 'fields' => array('Service.id', 'Service.title')));

        $this->set(compact('users', 'services', 'services_ids'));
    }

    public function change_status($id = null, $user_type = null) {

        $this->loadModel('User');
        $data = $this->User->find('first', array('conditions' => array('User.id' => $id), 'fields' => array('is_active')));

        $status = 0;
        if ($data['User']['is_active'] == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        if ($this->User->updateAll(array('User.is_active' => $status), array('User.id' => $id))) {
            if ($status == 0) {
                $this->Session->setFlash(__('The Assitant has been Deactivated.'), 'success');
            } else {
                $this->Session->setFlash(__('The Assitant has been Activated.'), 'success');
            }
        } else {
            if ($status == 0) {
                $this->Session->setFlash(__('The Assitant could not be Deactivated.Please Try again'), 'error');
            } else {
                $this->Session->setFlash(__('The Assitant could not be Activated..Please Try again'), 'error');
            }
        }
        return $this->redirect(array('action' => 'index', $user_type));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null, $user_type = null) {

        $this->loadModel('User');
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $data = $this->User->find('first', array('conditions' => array('User.id' => $id), 'fields' => array('is_deleted')));
        $status = 0;
        if ($data['User']['is_deleted'] == 0) {
            $status = 1;
        } else {
            $status = 0;
        }

        if ($this->User->updateAll(array('User.is_deleted' => $status), array('User.id' => $id))) {
            if ($status == 0) {
                $this->Session->setFlash(__('The Assitant has been restored.'), 'success');
            } else {
                $this->Session->setFlash(__('The Assitant has been deleted.'), 'success');
            }
        } else {
            if ($status == 0) {
                $this->Session->setFlash(__('The Assitant could not be restored.Please Try again'), 'error');
            } else {
                $this->Session->setFlash(__('The Assitant could not be deleted..Please Try again'), 'error');
            }
        }
        return $this->redirect(array('action' => 'index', $user_type));
    }

}
