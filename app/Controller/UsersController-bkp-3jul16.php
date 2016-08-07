<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('SmtpTransport', 'Network/Email');
App::import('Vendor', 'PHPMailer', array('file' => 'PHPMailer'.DS.'class.phpmailer.php'));
App::import('Vendor', 'PHPMailer', array('file' => 'PHPMailer'.DS.'class.PHPMailerAutoload.php'));


/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public function new_homepage() {
        $this->layout = null;
        $this->loadModel('Service');
        $services = $this->Service->find('all', array(
            'conditions' => array('Service.is_active' => 1),
            'fields' => array('Service.id', 'Service.title', 'Service.logo', 'Service.avg_rating', 'Service.description'),
            'order' => array('Service.id' => 'DESC'),
            'recursive' => -1,
            'limit' => 4
        ));

        $this->loadModel('Review');
        $reviews = $this->Review->find('all', array('conditions' => array('Review.is_verified' => 1, 'Review.rating >=' => 3), 'fields' => array('Review.rating', 'Review.review', 'User.avatar', 'Service.title', 'User.salutation', 'User.first_name', 'User.last_name'), 'order' => 'Review.id DESC', 'limit' => 6));
        Configure::load('feish');
        //debug($reviews);die;
        $salutations = Configure::read('feish.salutations');
//        echo '<pre>';print_r($services);die;
        $this->set(compact('services', 'reviews', 'salutations'));
    }

    public function test() {
        $this->layout = null;
    }
	public function myfaq() {
         $this->layout = 'front_layout';
    }

    /**
     * index method
     *
     * @return void
     */
    public function index($user_type = null) {
        $this->User->recursive = 0;

        if (!empty($user_type)) {
            $this->paginate = array(
                'conditions' => array('User.user_type' => $user_type),
                'order' => 'User.id DESC',
                'limit' => 20
            );
        } else {

            $this->paginate = array(
                'conditions' => array('User.user_type' => array(4, 5)),
                'order' => 'User.id DESC',
                'limit' => 20);
        }

        $users = $this->Paginator->paginate();
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $user_types = Configure::read('feish.user_types');
        $this->set(compact('users', 'yes_no', 'user_type', 'user_types'));
    }

    public function homepage() {
        $this->layout = null;
        $user_dr = $this->User->find('count', array('conditions' => array('user_type' => 2)));
//        $log = $this->User->getDataSource()->getLog(false, false);
//        debug($log); die;
        $user_pt = $this->User->find('count', array('conditions' => array('user_type' => array(4,5))));
        $rss = new DOMDocument();
        $rss->load('http://rss.medicalnewstoday.com/cardiovascular-cardiology.xml');
        $feed = array();
        foreach ($rss->getElementsByTagName('item') as $key => $node) {
            $item = array(
                'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
                'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
                'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
            );
            array_push($feed, $item);
            if ($key == 30) {
                break;
            }
        }

        $rss2 = new DOMDocument();
        $rss2->load('http://rss.medicalnewstoday.com/cardiovascular-cardiology.xml');
        $feed2 = array();
        foreach ($rss2->getElementsByTagName('item') as $key2 => $node2) {
            $item2 = array(
                'id' => $key2+1,
                'title' => $node2->getElementsByTagName('title')->item(0)->nodeValue,
                'desc' => $node2->getElementsByTagName('description')->item(0)->nodeValue,
                'link' => $node2->getElementsByTagName('link')->item(0)->nodeValue,
                'date' => $node2->getElementsByTagName('pubDate')->item(0)->nodeValue,
            );
            array_push($feed2, $item2);
            if ($key2 == 4) {
                break;
            }
        }
        //debug($feed);
        $this->set(compact('user_dr', 'user_pt', 'feed', 'feed2'));
    }

    public function doctors_dashboard() {
        
        $this->loadModel('Service');
        $services = $this->Service->find('list', array('conditions' => array('Service.user_id' => $this->Auth->user('id')), 'fields' => array('id', 'id')));
        $this->loadModel('Appointment');

        $booked_and_con_appointments = $this->Appointment->find('all', array(
            'conditions' => array('Appointment.status' => array(0, 1), 'Appointment.doctor_id' => $this->Auth->user('id'), 'DATE(Appointment.appointed_timing)' => date('Y-m-d')),
            'fields' => array('Appointment.id', 'Appointment.appointed_timing', 'Appointment.scheduled_date', 'Appointment.status', 'Service.title', 'User.salutation', 'User.first_name', 'User.last_name', 'Doctor.salutation', 'Doctor.first_name', 'Doctor.last_name'),
            'order' => 'Appointment.appointed_timing DESC'
        ));
        $reschedule_apt = $this->Appointment->find('all', array(
            'conditions' => array('Appointment.status' => array(2), 'Appointment.doctor_id' => $this->Auth->user('id'), 'DATE(Appointment.scheduled_date)' => date('Y-m-d')),
            'fields' => array('Appointment.id', 'Appointment.appointed_timing', 'Appointment.scheduled_date', 'Appointment.status', 'Service.title', 'User.salutation', 'User.first_name', 'User.last_name', 'Doctor.salutation', 'Doctor.first_name', 'Doctor.last_name'),
            'order' => 'Appointment.appointed_timing DESC'
        ));
        $appointments = array_merge($reschedule_apt, $booked_and_con_appointments);
        $all_appointments = $this->Appointment->find('all', array(
            'conditions' => array('Appointment.doctor_id' => $this->Auth->user('id')),
            'fields' => array('Appointment.id', 'Appointment.status', 'Appointment.scheduled_date', 'Appointment.appointed_timing', 'Service.title', 'User.salutation', 'User.first_name', 'User.last_name', 'Doctor.salutation', 'Doctor.first_name', 'Doctor.last_name')
        ));

//        debug($all_appointments);die;

        $this->loadModel('PatientPackageLog');
        $patients = $this->PatientPackageLog->find('all', array('conditions' => array('PatientPackageLog.service_id' => $services, 'PatientPackageLog.remaining_visits NOT' => 0), 'fields' => array('User.id', 'User.salutation', 'User.first_name', 'User.last_name')));
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $patient_list = array();

        foreach ($patients as $pa) {
            $patient_list[$pa['User']['id']] = $salutations[$pa['User']['salutation']] . ". " . $pa['User']['first_name'] . " " . $pa['User']['last_name'];
        }
        $total_patients = $this->PatientPackageLog->find('count', array('conditions' => array('PatientPackageLog.service_id' => $services)));
        $this->loadModel('Communication');

        $messages = $this->Communication->find('all', array('conditions' =>
            array('Communication.parent_id' => 0, 'FIND_IN_SET(' . $this->Auth->user('id') . ',Communication.reciever_user_id)'),
            'fields' => array('Communication.id', 'Communication.subject', 'Communication.viewed_users', 'Communication.created', 'Communication.is_attachment', 'User.id', 'User.salutation', 'User.first_name', 'User.last_name', 'Reciever.salutation', 'Reciever.first_name', 'Reciever.last_name'), 'recursive' => 0, 'limit' => 25, 'order' => 'Communication.id DESC'));
        $new_messages = 0;
        foreach ($messages as $key => $message) {
            // debug($this->Auth->user('id'));
            // debug($message);
            $messages[$key]['Communication']['new_count'] = 0;
            if (!empty($message['Communication']['viewed_users'])):
                $view_flag = 1;
                $is_viewed = json_decode($message['Communication']['viewed_users'], true);
                //  debug($is_viewed);die;
                if (array_key_exists($this->Auth->user('id'), $is_viewed)) {
                    $view_flag = $is_viewed[$this->Auth->user('id')];
                }
                if ($view_flag == 0):
                    $messages[$key]['Communication']['new_count']+=1;
                    $new_messages++;
                endif;
            endif;

            $is_new = $this->Communication->find('all', array('conditions' => array('Communication.parent_id' => $message['Communication']['id']), 'Order' => 'Communication.created ASC', 'fields' => array('Communication.viewed_users', 'Communication.message', 'Communication.subject', 'Communication.created', 'Communication.is_attachment', 'User.salutation', 'User.first_name', 'User.last_name')));
            // debug($is_new);
            foreach ($is_new as $key2 => $new) {
                $view_flag = 1;
                if (!empty($new['Communication']['viewed_users'])):
                    $is_viewed = json_decode($new['Communication']['viewed_users'], true);
                    // debug($is_viewed);die;
                    if (array_key_exists($this->Auth->user('id'), $is_viewed)) :
                        $view_flag = $is_viewed[$this->Auth->user('id')];
                    endif;
                    if ($view_flag == 0):
                        $messages[$key]['Communication']['new_count']+=1;
                        $new_messages++;
                    endif;
                endif;
                $messages[$key]['Communication']['message'] = $new['Communication']['message'];
                $messages[$key]['Communication']['subject'] = $new['Communication']['subject'];
                $messages[$key]['Communication']['created'] = $new['Communication']['created'];
                $messages[$key]['Communication']['is_attachment'] = $new['Communication']['is_attachment'];

                $messages[$key]['User']['first_name'] = $new['User']['first_name'];
                $messages[$key]['User']['last_name'] = $new['User']['last_name'];
                $messages[$key]['User']['salutation'] = $new['User']['salutation'];
            }
            // debug($messages);die;
        }

        // $new_messages = $this->Communication->find('count', array('conditions' => array('Communication.is_viewed' => 0, 'Communication.parent_id' => 0, 'FIND_IN_SET(' . $this->Auth->user('id') . ',Communication.reciever_user_id)')));
        $this->loadModel('DoctorPackage');
        $this->loadModel('DoctorPlanDetail');
        $plan_ids = $this->DoctorPlanDetail->find('list', array('conditions' => array('DoctorPlanDetail.user_id' => $this->Auth->user('id'), 'is_deleted' => 0), 'fields' => array('DoctorPlanDetail.doctor_package_id')));
        if (empty($plan_ids)) {
            return $this->redirect(array('controller' => 'doctor_packages', 'action' => 'doctor_plans'));
        }

        $this->set(compact('new', 'new_messages', 'appointments', 'patient_list', 'salutations', 'all_appointments', 'services', 'total_patients', 'messages'));
    }

    public function change_status($id = null, $user_type = null) {
        $data = $this->User->find('first', array('conditions' => array('User.id' => $id), 'fields' => array('is_active', 'user_type')));
        $status = 0;
        if ($data['User']['is_active'] == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $user_types = $data['User']['user_type'];
        if ($user_types == 2) {
            $user_name = 'Doctor';
        } else if ($user_types == 3) {
            $user_name = 'Assistant';
        } else if ($user_types == 4 || $user_types == 5) {
            $user_name = 'Patient';
        }
        if ($this->User->updateAll(array('User.is_active' => $status), array('User.id' => $id))) {
            if ($status == 0) {
                $this->Session->setFlash(__('The ' . $user_name . ' has been Deactivated.'), 'success');
            } else {
                $this->Session->setFlash(__('The ' . $user_name . ' has been Activated.'), 'success');
            }
        } else {
            if ($status == 0) {
                $this->Session->setFlash(__('The ' . $user_name . ' could not be Deactivated.Please Try again'), 'error');
            } else {
                $this->Session->setFlash(__('The ' . $user_name . ' could not be Activated..Please Try again'), 'error');
            }
        }
        if (!empty($redirect)) {
            return $this->redirect(array('action' => $redirect));
        }
        return $this->redirect(array('action' => 'index', $user_type));
    }

    public function doctor_change_status($id = null, $user_type = null) {

        $data = $this->User->find('first', array('conditions' => array('User.id' => $id), 'fields' => array('is_active')));
        $status = 0;
        if ($data['User']['is_active'] == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        if ($this->User->updateAll(array('User.is_active' => $status), array('User.id' => $id))) {
            if ($status == 0) {
                $this->Session->setFlash(__('The Patient has been Deactivated.'), 'success');
            } else {
                $this->Session->setFlash(__('The Patient has been Activated.'), 'success');
            }
        } else {
            if ($status == 0) {
                $this->Session->setFlash(__('The Patient could not be Deactivated.Please Try again'), 'error');
            } else {
                $this->Session->setFlash(__('The Patient could not be Activated..Please Try again'), 'error');
            }
        }
        if (!empty($redirect)) {
            return $this->redirect(array('action' => $redirect));
        }
        return $this->redirect(array('action' => 'patients_index_for_doctor'));
    }

    public function assistant_change_status($id = null, $user_type = null) {

        $data = $this->User->find('first', array('conditions' => array('User.id' => $id), 'fields' => array('is_active')));
        $status = 0;
        if ($data['User']['is_active'] == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        if ($this->User->updateAll(array('User.is_active' => $status), array('User.id' => $id))) {
            if ($status == 0) {
                $this->Session->setFlash(__('The Patient has been Deactivated.'), 'success');
            } else {
                $this->Session->setFlash(__('The Patient has been Activated.'), 'success');
            }
        } else {
            if ($status == 0) {
                $this->Session->setFlash(__('The Patient could not be Deactivated.Please Try again'), 'error');
            } else {
                $this->Session->setFlash(__('The Patient could not be Activated..Please Try again'), 'error');
            }
        }
        if (!empty($redirect)) {
            return $this->redirect(array('action' => $redirect));
        }
        return $this->redirect(array('action' => 'patients_index_for_assistant'));
    }

    public function dashboard() {
        
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null, $user_type = null) {

        $login_userId = $this->Auth->user('id');

//        if (!$this->User->exists($id)) {
//            throw new NotFoundException(__('Invalid user'));
//        }

        $this->loadModel('DoctorPackage');
        if ($this->request->is(array('post', 'put'))) {
            if ($id != "") {
                $this->User->id = $id;
            } else {
                $this->User->id = $login_userId;
            }
//            $this->User->id = $login_userId;
            if (isset($this->request->data['User']['avatar_img']['name']) && !empty($this->request->data['User']['avatar_img']['name'])) {
                $this->request->data['User']['avatar'] = $this->User->uploadMainImage($this->request->data['User']['avatar_img'], 'user_avtar');
            }
            $this->request->data['User']['birth_date'] = date('Y-m-d', strtotime(str_replace('-', ' ', $this->request->data['User']['birth_date'])));
            if ($this->User->save($this->request->data)) {
                if ($id == "") {
                    $this->Session->write('Auth', $this->User->read(null, $this->Auth->User('id')));
                }
                $this->Session->setFlash(__('The user has been updated.'), 'success');
                return $this->redirect(array('action' => 'view', $id, $user_type));
            } else {
                $this->Session->setFlash(__('The user could not be updated. Please, try again.'));
            }
        } else {
            if ($id != "") {
                $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));
            } else {
                $user = $this->User->find('first', array('conditions' => array('User.id' => $login_userId)));
                $this->request->data = $user;
            }
        }
//        debug($user);die;
        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $login_userId),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');

        $this->set(compact('user', 'last_login', 'salutations', 'user_plan_details'));
    }

    public function admin_patient_view($id = null) {

        $login_userId = $this->Auth->user('id');

        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        $this->loadModel('DoctorPackage');
        $this->loadModel('User');
        $this->loadModel('IdentityType');

        if ($this->request->is(array('post', 'put'))) {

            $this->User->id = $id;
            if (isset($this->request->data['User']['avatar_img']['name']) && !empty($this->request->data['User']['avatar_img']['name'])) {
                $this->request->data['User']['avatar'] = $this->User->uploadMainImage($this->request->data['User']['avatar_img'], 'user_avtar');
            }

            $save_data = array();
            $new_data = array();
            foreach ($this->request->data['User']['identity_details'] as $key => $value) {
                $new_data[$value['identity_id']] = $value['identity'];
            }

            $this->request->data['User']['identity'] = json_encode($new_data);

            if ($this->User->save($this->request->data)) {
//                $this->Session->write('Auth', $this->User->read(null, $id));
                $this->Session->setFlash(__('The user has been updated.'), 'success');
                return $this->redirect(array('action' => 'admin_patient_view', $id));
            } else {
                $this->Session->setFlash(__('The user could not be updated. Please, try again.'));
            }
        } else {
            if ($id != "") {
                $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));
                $identity_types = $this->IdentityType->find('list');
            } else {
                $user = $this->User->find('first', array('conditions' => array('User.id' => $login_userId)));
                $this->request->data = $user;
            }
        }


        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $login_userId),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');

        $this->set(compact('user', 'last_login', 'salutations', 'user_plan_details', 'identity_types'));
    }

    public function assistant_view($id = null, $user_type = null) {

        $login_userId = $this->Auth->user('id');

//        if (!$this->User->exists($id)) {
//            throw new NotFoundException(__('Invalid user'));
//        }
        $this->loadModel('DoctorPackage');
        if ($this->request->is(array('post', 'put'))) {

            $this->User->id = $login_userId;
            if (isset($this->request->data['User']['avatar_img']['name']) && !empty($this->request->data['User']['avatar_img']['name'])) {
                $this->request->data['User']['avatar'] = $this->User->uploadMainImage($this->request->data['User']['avatar_img'], 'user_avtar');
            }

            if ($this->User->save($this->request->data)) {
                $this->Session->write('Auth', $this->User->read(null, $this->Auth->User('id')));
                $this->Session->setFlash(__('The user has been updated.'), 'success');
                return $this->redirect(array('action' => 'assistant_view', $id, $user_type));
            } else {
                $this->Session->setFlash(__('The user could not be updated. Please, try again.'));
                return $this->redirect(array('action' => 'assistant_view', $id, $user_type));
            }
        } else {
            $user = $this->User->find('first', array('conditions' => array('User.id' => $login_userId)));
            $this->request->data = $user;
        }

        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $login_userId),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');

        $this->set(compact('user', 'last_login', 'salutations', 'user_plan_details'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
    }

    public function login_redirect() {
        $role = Authcomponent::user('user_type');
        Configure::load('roles_config');
        $role_data = Configure::read("roles");
        //debug($role_data[intval($role)]);die;
        $this->redirect($role_data[intval($role)]);
    }

    public function sign_up() {
        if ($this->Auth->user()) {
            $this->login_redirect();
        }
        $this->layout = 'front_layout';
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        if ($this->request->is('post')) {

            $this->request->data['User']['ip_address'] = $this->request->clientIp();
            $this->request->data['User']['is_verified'] = 0;
            $this->request->data['User']['birth_date'] = date('Y-m-d', strtotime(str_replace('-', '/', $this->request->data['User']['birth_date'])));
            $password = $this->request->data['User']['password'];
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $registerd_id = $this->User->id;
                $registration_no = substr(str_shuffle(str_repeat('0', 5)), 0, 5) . $registerd_id;

                $this->User->updateAll(array('User.registration_no' => "'" . $registration_no . "'"), array('User.id' => $registerd_id));

                $fetch_data = $this->User->find('first', array('conditions' => array('User.id' => $registerd_id)));
                $created_date = date('d-m-Y h:i:s A', strtotime($fetch_data['User']['created']));
                $verify_link = Router::url('/', true) . 'users/verify_account/' . base64_encode($registerd_id);
                $email = new CakeEmail();
                $email->config('verify_account');
                $email->from(array('support@feish.online' => 'Feish Team'));
                $email->to($fetch_data['User']['email']);
                $email->viewVars(compact('fetch_data', 'verify_link', 'salutations', 'registration_no', 'password'));
                $email->subject('Verify Account');
                $email->send();
                $number = $fetch_data['User']['mobile'];
                if ($fetch_data['User']['user_type'] == 2) {
//                    $message = "Dear " . ucfirst($fetch_data['User']['first_name']) . " " . ucfirst($fetch_data['User']['last_name']) . " your registration number: DOC-" . $registration_no . ". Please check mail to verify your account. Please call on +919953333592 for assistance.";
                    $message = "Dear " . $salutations[$fetch_data['User']['salutation']] . ". " . $fetch_data['User']['first_name'] . " " . $fetch_data['User']['last_name'] . ". Please login to the website feish.online to verify the details.Please call on +919953333592 for assistance.";
                } elseif ($fetch_data['User']['user_type'] == 4) {
                    $message = "Dear " . $salutations[$fetch_data['User']['salutation']] . ". " . $fetch_data['User']['first_name'] . ". Please login to the website feish.online to verify the details.Please call on +919953333592 for assistance.";
                } else {
                    $message = "";
                }
                $url = "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=feishtest&password=1198230549&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $curl_scraped_page = curl_exec($ch);
                curl_close($ch);


                /* sms text for admin */
                $number = '9953333592';
                if ($fetch_data['User']['user_type'] == 2) {
                    $message = "User " . ucfirst($fetch_data['User']['first_name']) . " " . ucfirst($fetch_data['User']['last_name']) . " has registered on " . $created_date . " Registration number: DOC-" . $registration_no . " : Please verify the details and approve";
                } elseif ($fetch_data['User']['user_type'] == 4) {
                    $message = "User " . ucfirst($fetch_data['User']['first_name']) . " " . ucfirst($fetch_data['User']['last_name']) . " has registered on " . $created_date . " Registration number: PA-" . $registration_no . " : Please verify the details and approve";
                } else {
                    $message = "";
                }
                $url = "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=feishtest&password=1198230549&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $curl_scraped_page = curl_exec($ch);
                curl_close($ch);
                /* end */


                $email = new CakeEmail();
                $email->config('new_registration');
                $email->to('subscribe@feish.online');
                $email->viewVars(compact('fetch_data', 'verify_link', 'salutations', 'registration_no', 'password'));
                $email->subject('New Registration');
                $email->send();
                $this->loadModel('Communication');
                $communication_data = array();
                $communication_data['Communication']['subject'] = 'New Registration';
                $communication_data['Communication']['message'] = 'New registration ' . $salutations[$fetch_data['User']['salutation']] . ". " . $fetch_data['User']['first_name'] . " " . $fetch_data['User']['last_name'] . ", registration number: REG-" . $registration_no;

                $communication_data['Communication']['parent_id'] = 0;
                $communication_data['Communication']['user_id'] = 0;
                $communication_data['Communication']['reciever_user_id'] = $fetch_data['User']['id'];
                //$communication_data['Communication']['service_id']=$fetch_data['PatientPackage']['service_id'];
                $this->Communication->save($communication_data);

                $this->Session->setFlash(__('Congratulations you have registered Successfully, Please check mail to verify account.'), 'success');
                return $this->redirect(array('action' => 'login'));
            } else {
                $this->Session->setFlash(__('Sorry,Registration failed ,Please try again .'), 'error');
            }
        }

        $this->set(compact('salutations'));
    }

    public function verify_account($id) {
        $de_id = base64_decode($id);
        $user = $this->User->find('first', array('conditions' => array('User.id' => $de_id), 'fields' => array('User.is_verified'), 'recursive' => -1));

        if (!empty($user)) {
            if ($user['User']['is_verified'] == 1) {
                $this->Session->setFlash(__('Already verified user'), 'error');
            } else {
                if ($this->User->updateAll(array('User.is_verified' => 1), array('User.id' => $de_id))) {
                    $this->Session->setFlash(__('Congratulations , Your account has been verified successfully'), 'success');
                } else {
                    $this->Session->setFlash(__('Sorry , Your account could not be verified, please try again'), 'error');
                }
            }
        } else {
            $this->Session->setFlash(__('Invalid User'), 'error');
        }

        return $this->redirect(array('action' => 'login'));
    }

    public function check_mobile() {
        $this->layout = null;
        if ($this->request->is('post')) {
            $result = $this->User->find('count', array('conditions' => array('User.mobile' => $this->request->data['mobile'])));
            $this->set(compact('result'));
            $this->render('filter');
        }
    }

    public function check_mail_id() {
        $this->layout = null;

        if ($this->request->is('post')) {
            $result = $this->User->find('count', array('conditions' => array('User.email' => $this->request->data['email_id'])));
            $this->set(compact('result'));
            $this->render('filter');
        }
    }

    public function login($redirect_to = null, $redirect_id = null) {
        if ($this->Auth->user()) {
            $this->login_redirect();
        }
        $this->layout = null;

        if ($this->request->is('post')) {

            $data = $this->request->data;
            $users = $this->User->find('first', array('conditions' => array('OR' => array('User.email' => $data['User']['email'], 'User.mobile' => $data['User']['email']), 'User.password' => AuthComponent::password($data['User']['password']))));
            $log = $this->User->getDataSource()->getLog(false, false);
//            debug($log); die;
//            debug($users); die;
            //$users = $this->User->find('first', array('conditions' => array('User.email' => $data['User']['email'], 'User.password' => $data['User']['password'])));
            if (!empty($users)) {
                if ($users['User']['user_type'] == 2) {
                    $this->loadModel('DoctorPlanDetail');
                    $exists_packege = $this->DoctorPlanDetail->find('count', array('conditions' => array('DoctorPlanDetail.user_id' => $users['User']['id'], 'DoctorPlanDetail.end_date >=' => date('Y-m-d'))));
                    $users['User']['active_package_count'] = $exists_packege;
                }
                if ($users['User']['is_verified'] == 1) {
                    if ($users['User']['is_active'] == 1) {
                        if ($this->Auth->login($users['User'])) {
                            //$this->response->enableCache();
                            $login_detail = array();
                            $login_detail['LoginDetail']['user_id'] = $this->Auth->user('id');
                            $login_detail['LoginDetail']['ip_address'] = $this->request->clientIp();
                            $this->loadModel('LoginDetail');
                            $this->LoginDetail->create();
                            $this->LoginDetail->save($login_detail);
                            if ($this->Auth->user('user_type') == 2) {
                                if ($this->Auth->user('active_package_count') == 0) {
                                    $this->Session->setFlash(__('You dont have active plan ,please purchase the plan'), 'error');
                                    $this->redirect(array('controller' => 'doctor_packages', 'action' => 'doctor_plans'));
                                }
                            }

                            $this->Session->setFlash(__('Login Successfuly'), 'success');
                            //$this->redirect(array('controller' => 'users', 'action' => 'index'));
                            if ($redirect_to == 1) {
                                $this->redirect(array('controller' => 'patient_packages', 'action' => 'view', $redirect_id));
                            }
                            $this->login_redirect();
                        } else {
                            $this->Session->setFlash(__('wrong email or passowrd'), 'error');
                        }
                    } else {
                        $this->Session->setFlash(__('Sorry,Your account is deactivated,Please contact admin.'), 'error');
                    }
                } else {
                    $this->Session->setFlash(__('Sorry,You are not verified,Please verify your account.'), 'error');
                }
            } else {
                $this->Session->setFlash(__('Wrong Email/Mobile or password'), 'error');
                $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
            //$this->redirect(array('controller' => 'users', 'action' => 'index'));
        }
    }

    public function logout() {

        $this->Auth->logout();
        $this->Session->destroy();

        $this->Session->setFlash('You are logged out!', 'success');

        return $this->redirect('/');
    }

    public function patient_details($id) {
        $this->loadModel('User');
        $this->loadModel('PatientHabit');
        $this->loadModel('Habit');

        $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $id),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');

        $options = array('conditions' => array('User.' . $this->PatientHabit->User->primaryKey => $id));
        $patient_habits = $this->PatientHabit->find('all', $options);

        $this->set(compact('user', 'last_login', 'salutations', 'patient_habits'));
    }

    public function patient_purchased_plan($id) {
        $this->loadModel('User');
        $this->loadModel('PatientHabit');
        $this->loadModel('Habit');

        $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $id),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');

        $options = array('conditions' => array('User.' . $this->PatientHabit->User->primaryKey => $id));
        $patient_habits = $this->PatientHabit->find('all', $options);

        $this->set(compact('user', 'last_login', 'salutations', 'patient_habits'));
    }

    public function patient_vital_signs($id) {
        $this->loadModel('User');
        $this->loadModel('PatientHabit');
        $this->loadModel('Habit');

        $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $id),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');

        $options = array('conditions' => array('User.' . $this->PatientHabit->User->primaryKey => $id));
        $patient_habits = $this->PatientHabit->find('all', $options);

        $this->set(compact('user', 'last_login', 'salutations', 'patient_habits'));
    }

    public function patient_test_results($id) {
        $this->loadModel('User');
        $this->loadModel('LabTestResult');

        $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $id),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $test_results_details = $this->LabTestResult->find('all', array('conditions' => array('LabTestResult.added_by' => $id)));

        $this->set(compact('user', 'last_login', 'salutations', 'test_results_details'));
    }

    public function patient_medical_history($id) {
        $this->loadModel('User');
        $this->loadModel('PatientHabit');
        $this->loadModel('Habit');

        $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $id),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');

        $options = array('conditions' => array('User.' . $this->PatientHabit->User->primaryKey => $id));
        $patient_habits = $this->PatientHabit->find('all', $options);

        $this->set(compact('user', 'last_login', 'salutations', 'patient_habits'));
    }

    public function patient_family_history($id) {
        $this->recursive = 0;
        $this->loadModel('User');
        $this->loadModel('FamilyHistory');

        $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $id),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');

        $users_family_history = $this->FamilyHistory->find('all', array('conditions' => array('FamilyHistory.added_by' => $id)));

//        $this->FamilyHistory->recursive = 0;
//        $this->paginate = array(
//            'conditions' => array('FamilyHistory.added_by' => $id),
//            'order' => 'FamilyHistory.id DESC',
//            'limit' => 10
//        );
//        $users_family_history = $this->Paginator->paginate();
//        debug($users_family_history);die;
        $this->set(compact('user', 'last_login', 'salutations', 'users_family_history'));
    }

    public function patient_diet_plan($id) {
        $this->loadModel('User');
        $this->loadModel('DietPlan');

        $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $id),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');

        $diet_plan_arr = $this->DietPlan->find('all', array('conditions' => array('DietPlan.added_by' => $id)));
//        $this->paginate = array(
//            'conditions' => array('DietPlan.added_by' => $id),
//            'order' => 'DietPlan.id DESC',
//            'limit' => 10
//        );
//        $diet_plan_arr = $this->Paginator->paginate();

        $this->set(compact('user', 'last_login', 'salutations', 'diet_plan_arr'));
    }

    public function patient_treatments($id) {
        $this->loadModel('User');
        $this->loadModel('PatientHabit');
        $this->loadModel('Habit');

        $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $id),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');

        $options = array('conditions' => array('User.' . $this->PatientHabit->User->primaryKey => $id));
        $patient_habits = $this->PatientHabit->find('all', $options);

        $this->set(compact('user', 'last_login', 'salutations', 'patient_habits'));
    }

    public function patient_dashboard() {
        
    }

    public function admin_dashboard() {
        $user_condition = $users = array();
        $doctors_count = $patients_count = $ext_patients_count = $app_count = 0;
        $post_flag = false;
        $total_cost = $commission_total = 0.00;
        Configure::load('feish');
        $keywords = Configure::read('feish.search_keywords');
        $salutations = Configure::read('feish.salutations');
        $this->loadModel('Service');
        $this->loadModel('PatientPackageLog');
        $this->loadModel('Appointment');

        ////1.all counts to display////
        $services_counts = $this->Service->find('list', array('conditions' => array('Service.is_active' => 1)));
        $services_count = sizeof($services_counts);
        $all_counts = $this->User->find('all', array('recursive' => 0, 'group' => array('User.user_type'), 'fields' => array('User.user_type', 'count(User.id) as count')));
//        debug($all_counts); die;
        foreach ($all_counts as $value) {
            if ($value['User']['user_type'] == 2) {
                //dr'd count
                $doctors_count = $value[0]['count'];
            } else if ($value['User']['user_type'] == 4) {
                //patient's count
                $patients_count = $value[0]['count'];
            } else if ($value['User']['user_type'] == 5) {
                //external patient's count
                $ext_patients_count = $value[0]['count'];
            }
        }
        //// end 1 ////
        ////2.get today's appointment count////
        $appointments = $this->Appointment->find('all', array(
            'recursive' => -1,
            'conditions' => array(
                'OR' => array('date(Appointment.appointed_timing)' => date("Y-m-d"), 'date(Appointment.scheduled_date)' => date("Y-m-d")),
                'NOT' => array('Appointment.status' => 3)
            ),
            'fields' => array('count(Appointment.id) as app_count', 'date(Appointment.appointed_timing) as day')
                )
        );
//        $log = $this->PatientPackageLog->getDataSource()->getLog(false, false);
//        debug($log); die;
//        debug($appointments); die;
        $app_count = $appointments[0][0]['app_count'];
        //// end 2 ////
        ////3.get all data regarding to current Month////
        $start_dt = new DateTime('first day of this month');
        $f_date = $start_dt->format('Y-m-d H:i:s');
        $end_dt = new DateTime('last day of this month');
        $l_date = $end_dt->format('Y-m-d H:i:s');
        // get list of all active Doctors
        $conditions = array('PatientPackageLog.start_date >=' => $f_date, 'PatientPackageLog.start_date <=' => $l_date);

        // get sum of services bought, service list, no of visits by petients 
        $all_patients = $this->PatientPackageLog->find('all', array(
            'conditions' => $conditions,
            'group' => array('PatientPackageLog.service_id'),
            'fields' => array('count(PatientPackageLog.service_id) as patient_count', 'sum(PatientPackageLog.price) as total_cost', 'sum(PatientPackageLog.commission) as commission', 'PatientPackageLog.service_id', 'sum(PatientPackageLog.used_visits) as total_visits', 'PatientPackageLog.paid_flag')
                )
        );
//        debug($all_patients); die;
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

            foreach ($users as $value) {
                foreach ($all_patients as $costs) {
                    if ($costs['PatientPackageLog']['service_id'] == $value['Services'][0]['id']) {
                        $paid_flag[$value['User']['id']] = $costs['PatientPackageLog']['paid_flag'];
//                        debug($paid_flag); die;
                        $patient_count[$value['User']['id']] = $costs[0]['patient_count'];
                        if ($costs[0]['patient_count'] > 0) {
                            $save_prices[$value['User']['id']] = $costs[0]['total_cost'];
                            $total_commision[$value['User']['id']] = $costs[0]['commission'];
                            $doctor_income[$value['User']['id']] = $costs[0]['total_cost'] - $costs[0]['commission'];
                            $total_commision_per[$value['User']['id']] = round((round($costs[0]['commission'] * 100, 2)) / $costs[0]['total_cost'], 2);
                            $doctor_income_per[$value['User']['id']] = 100 - $total_commision_per[$value['User']['id']];
                        }
                    }
                }
            }
        }
        //// end 3 ////
//        debug($users); die;
        $this->set(compact('services_count', 'doctors_count', 'patients_count', 'ext_patients_count', 'users', 'salutations', 'save_prices', 'total_commision', 'total_commision_per', 'doctor_income', 'doctor_income_per', 'patient_count', 'all_patients', 'app_count', 'paid_flag'));
    }

    public function assistant_dashboard() {

        $this->loadModel('Service');
        $services = $this->Service->find('list', array('conditions' => array('Service.user_id' => $this->Auth->user('added_by_doctor_id')), 'fields' => array('id', 'id')));
        $this->loadModel('Appointment');
        //debug(date('Y-m-d'));die;

        $booked_and_con_appointments = $this->Appointment->find('all', array(
            'conditions' => array('Appointment.status' => array(0, 1), 'Appointment.doctor_id' => $this->Auth->user('added_by_doctor_id'), 'DATE(Appointment.appointed_timing)' => date('Y-m-d')),
            'fields' => array('Appointment.id', 'Appointment.appointed_timing', 'Appointment.scheduled_date', 'Appointment.status', 'Service.title', 'User.salutation', 'User.first_name', 'User.last_name', 'Doctor.salutation', 'Doctor.first_name', 'Doctor.last_name'),
            'order' => 'Appointment.appointed_timing DESC'
        ));
        $reschedule_apt = $this->Appointment->find('all', array(
            'conditions' => array('Appointment.status' => array(2), 'Appointment.doctor_id' => $this->Auth->user('added_by_doctor_id'), 'DATE(Appointment.scheduled_date)' => date('Y-m-d')),
            'fields' => array('Appointment.id', 'Appointment.appointed_timing', 'Appointment.scheduled_date', 'Appointment.status', 'Service.title', 'User.salutation', 'User.first_name', 'User.last_name', 'Doctor.salutation', 'Doctor.first_name', 'Doctor.last_name'),
            'order' => 'Appointment.appointed_timing DESC'
        ));
        $appointments = array_merge($reschedule_apt, $booked_and_con_appointments);

        $all_appointments = $this->Appointment->find('all', array(
            'conditions' => array('Appointment.doctor_id' => $this->Auth->user('added_by_doctor_id')),
            'fields' => array('Appointment.id', 'Appointment.appointed_timing', 'Appointment.status', 'Appointment.scheduled_date', 'Service.title', 'User.salutation', 'User.first_name', 'User.last_name', 'Doctor.salutation', 'Doctor.first_name', 'Doctor.last_name')
        ));
//        debug($all_appointments);die;
        $this->loadModel('Service');
        $services = $this->Service->find('list', array('conditions' => array('Service.user_id' => $this->Auth->user('added_by_doctor_id')), 'fields' => array('id', 'id')));
        // debug($services);die;
        $this->loadModel('PatientPackageLog');
        $patients = $this->PatientPackageLog->find('all', array('conditions' => array('PatientPackageLog.service_id' => $services, 'PatientPackageLog.remaining_visits NOT' => 0), 'fields' => array('User.id', 'User.salutation', 'User.first_name', 'User.last_name')));
        Configure::load('feish');

        $salutations = Configure::read('feish.salutations');
        $patient_list = array();
        foreach ($patients as $pa) {
            $patient_list[$pa['User']['id']] = $salutations[$pa['User']['salutation']] . ". " . $pa['User']['first_name'] . " " . $pa['User']['last_name'];
        }
        $this->set(compact('appointments', 'patient_list', 'salutations', 'all_appointments'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null, $user_type = null, $redirect = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $data = $this->User->find('first', array('conditions' => array('User.id' => $id), 'fields' => array('is_deleted', 'user_type')));
        $status = 0;
        if ($data['User']['is_deleted'] == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $user_types = $data['User']['user_type'];
        if ($user_types == 2) {
            $user_name = 'Doctor';
        } else if ($user_types == 3) {
            $user_name = 'Assistant';
        } else if ($user_types == 4 || $user_types == 5) {
            $user_name = 'Patient';
        }
        if ($this->User->updateAll(array('User.is_deleted' => $status), array('User.id' => $id))) {
            if ($status == 0) {
                $this->Session->setFlash(__('The ' . $user_name . ' has been restored.'), 'success');
            } else {
                $this->Session->setFlash(__('The ' . $user_name . ' has been deleted.'), 'success');
            }
        } else {
            if ($status == 0) {
                $this->Session->setFlash(__('The ' . $user_name . ' could not be restored.Please Try again'), 'error');
            } else {
                $this->Session->setFlash(__('The ' . $user_name . ' could not be deleted..Please Try again'), 'error');
            }
        }
        if (!empty($redirect)) {
            return $this->redirect(array('action' => $redirect));
        }
        return $this->redirect(array('action' => 'index', $user_type));
    }

    public function doctor_delete($id = null, $user_type = null, $redirect = null) {
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
                $this->Session->setFlash(__('The Patient has been restored.'), 'success');
            } else {
                $this->Session->setFlash(__('The Patient has been deleted.'), 'success');
            }
        } else {
            if ($status == 0) {
                $this->Session->setFlash(__('The Patient could not be restored.Please Try again'), 'error');
            } else {
                $this->Session->setFlash(__('The Patient could not be deleted..Please Try again'), 'error');
            }
        }
        if (!empty($redirect)) {
            return $this->redirect(array('action' => $redirect));
        }
        return $this->redirect(array('action' => 'patients_index_for_doctor'));
    }

    public function assistant_delete($id = null, $user_type = null, $redirect = null) {
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
                $this->Session->setFlash(__('The Patient has been restored.'), 'success');
            } else {
                $this->Session->setFlash(__('The Patient has been deleted.'), 'success');
            }
        } else {
            if ($status == 0) {
                $this->Session->setFlash(__('The Patient could not be restored.Please Try again'), 'error');
            } else {
                $this->Session->setFlash(__('The Patient could not be deleted..Please Try again'), 'error');
            }
        }
        if (!empty($redirect)) {
            return $this->redirect(array('action' => $redirect));
        }
        return $this->redirect(array('action' => 'patients_index_for_doctor'));
    }

    public function patients_index_for_doctor() {
        $flag = true;
        $this->loadModel('Appointment');
        $this->loadModel('Service');
        $this->loadModel('PatientPackageLog');
        $patients = $this->Appointment->find('list', array('conditions' => array('Appointment.doctor_id' => $this->Auth->user('id')), 'fields' => array('Appointment.user_id', 'Appointment.user_id')));
        $service = $this->Service->find('list', array('conditions' => array('Service.user_id' => $this->Auth->user('id')), 'fields' => array('Service.id', 'Service.id')));
        $purchased_plan_patients = $this->PatientPackageLog->find('list', array('conditions' => array('PatientPackageLog.service_id' => $service), 'fields' => array('PatientPackageLog.user_id', 'PatientPackageLog.user_id')));


        $total_patients = array_merge($patients, $purchased_plan_patients);
        $conditions = array('User.user_type' => array(4, 5), 'User.id' => $total_patients);

        if ($this->request->is('post')) {
            $data = $this->request->data;
            $like = '%' . $data['condition_like'] . '%';
            if ($data['column_name'] == 1) {
                $col_name = 'User.registration_no';
                $conditions[$col_name] = $data['condition_like'];
            } else if ($data['column_name'] == 2) {
                $conditions['OR'] = array('User.first_name LIKE' => $like, 'User.last_name LIKE' => $like);
            } else if ($data['column_name'] == 3) {
                $conditions['User.email LIKE'] = $like;
            } else if ($data['column_name'] == 4) {
                $patient_ids = $this->Appointment->find('list', array('conditions' => array('Appointment.id' => $data['condition_like'], 'Appointment.doctor_id' => $this->Auth->user('id')), 'fields' => array('Appointment.user_id', 'Appointment.user_id')));
            } else if ($data['column_name'] == 5) {
                $conditions['User.mobile LIKE'] = $like;
            }

            if (isset($patient_ids) && !empty($patient_ids)) {
                $conditions['User.id'] = $patient_ids;
            } else if (isset($patient_ids) && empty($patient_ids)) {
                $flag = false;
            }
//             
        }

        if ($flag) {
            $this->paginate = array(
                'conditions' => $conditions,
                'order' => 'User.id DESC',
                'limit' => 20
            );

            $users = $this->Paginator->paginate();
        } else {
            $users = array();
        }
//        debug($users);die;
        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
        $user_types = Configure::read('feish.user_types');
        $this->set(compact('users', 'yes_no', 'user_type', 'user_types'));
    }

    public function search_patients() {
        $flag = true;
        $this->loadModel('Appointment');
        $this->loadModel('Service');
        $this->loadModel('PatientPackageLog');
        $previous_url = $this->referer();
        $current_url = $this->here;

        $patients = $this->Appointment->find('list', array('conditions' => array('Appointment.doctor_id' => $this->Auth->user('id')), 'fields' => array('Appointment.user_id', 'Appointment.user_id')));
        $service = $this->Service->find('list', array('conditions' => array('Service.user_id' => $this->Auth->user('id')), 'fields' => array('Service.id', 'Service.id')));
        $purchased_plan_patients = $this->PatientPackageLog->find('list', array('conditions' => array('PatientPackageLog.service_id' => $service), 'fields' => array('PatientPackageLog.user_id', 'PatientPackageLog.user_id')));


        $total_patients = array_merge($patients, $purchased_plan_patients);
        $conditions = array('User.user_type' => array(4, 5), 'User.id' => $total_patients);

        if ($this->request->is('post')) {
            $data = $this->request->data;
            $like = '%' . $data['condition_like'] . '%';
            if ($data['column_name'] == 1) {
                $col_name = 'User.registration_no';
                $conditions[$col_name] = $data['condition_like'];
            } else if ($data['column_name'] == 2) {
                $conditions['OR'] = array('User.first_name LIKE' => $like, 'User.last_name LIKE' => $like);
            } else if ($data['column_name'] == 3) {
                $conditions['User.email LIKE'] = $like;
            } else if ($data['column_name'] == 4) {
                $patient_ids = $this->Appointment->find('list', array('conditions' => array('Appointment.id' => $data['condition_like'], 'Appointment.doctor_id' => $this->Auth->user('id')), 'fields' => array('Appointment.user_id', 'Appointment.user_id')));
            } else if ($data['column_name'] == 5) {
                $conditions['User.mobile LIKE'] = $like;
            }

            if (isset($patient_ids) && !empty($patient_ids)) {
                $conditions['User.id'] = $patient_ids;
            } else if (isset($patient_ids) && empty($patient_ids)) {
                $flag = false;
            }
//             
        }
        if ($flag) {
            $this->paginate = array(
                'conditions' => $conditions,
                'order' => 'User.id DESC',
                'limit' => 20
            );

            $users = $this->Paginator->paginate();
        } else {
            $users = array();
        }

        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
        $user_types = Configure::read('feish.user_types');
        $this->set(compact('users', 'yes_no', 'user_type', 'user_types', 'previous_url', 'current_url'));
    }

    public function patients_index_for_admin() {
        $flag = true;
        $this->loadModel('Appointment');
        $this->loadModel('Service');
        $this->loadModel('PatientPackageLog');
        $previous_url = $this->referer();
        $current_url = $this->here;

        $patients = $this->Appointment->find('list', array('fields' => array('Appointment.user_id', 'Appointment.user_id')));
        $service = $this->Service->find('list', array('fields' => array('Service.id', 'Service.id')));
        $purchased_plan_patients = $this->PatientPackageLog->find('list', array('conditions' => array('PatientPackageLog.service_id' => $service), 'fields' => array('PatientPackageLog.user_id', 'PatientPackageLog.user_id')));


        $total_patients = array_merge($patients, $purchased_plan_patients);
        $conditions = array('User.user_type' => array(4, 5), 'User.id' => $total_patients);

        if ($this->request->is('post')) {
            $data = $this->request->data;
            $like = '%' . $data['condition_like'] . '%';
            if ($data['column_name'] == 1) {
                $col_name = 'User.registration_no';
                $conditions[$col_name] = $data['condition_like'];
            } else if ($data['column_name'] == 2) {
                $conditions['OR'] = array('User.first_name LIKE' => $like, 'User.last_name LIKE' => $like);
            } else if ($data['column_name'] == 3) {
                $conditions['User.email LIKE'] = $like;
            } else if ($data['column_name'] == 4) {
                $patient_ids = $this->Appointment->find('list', array('conditions' => array('Appointment.id' => $data['condition_like']), 'fields' => array('Appointment.user_id', 'Appointment.user_id')));
            } else if ($data['column_name'] == 5) {
                $conditions['User.mobile LIKE'] = $like;
            }

            if (isset($patient_ids) && !empty($patient_ids)) {
                $conditions['User.id'] = $patient_ids;
            } else if (isset($patient_ids) && empty($patient_ids)) {
                $flag = false;
            }
//             
        }
        if ($flag) {
            $this->paginate = array(
                'conditions' => $conditions,
                'order' => 'User.id DESC',
                'limit' => 20
            );

            $users = $this->Paginator->paginate();
        } else {
            $users = array();
        }

        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
        $user_types = Configure::read('feish.user_types');
        $this->set(compact('users', 'yes_no', 'user_type', 'user_types', 'previous_url', 'current_url'));
    }

    public function patients_index_for_assistant() {
        $flag = true;
        $this->loadModel('Appointment');
        $this->loadModel('Service');
        $this->loadModel('PatientPackageLog');
        $this->loadModel('User');

        $doctor_id = $this->User->find('list', array('conditions' => array('User.id' => $this->Auth->user('id')), 'fields' => array('User.added_by_doctor_id', 'User.added_by_doctor_id')));

        $patients = $this->Appointment->find('list', array('conditions' => array('Appointment.doctor_id' => $doctor_id), 'fields' => array('Appointment.user_id', 'Appointment.user_id')));
//        debug($patients);die;
        $service = $this->Service->find('list', array('conditions' => array('Service.user_id' => $doctor_id), 'fields' => array('Service.id', 'Service.id')));
        $purchased_plan_patients = $this->PatientPackageLog->find('list', array('conditions' => array('PatientPackageLog.service_id' => $service), 'fields' => array('PatientPackageLog.user_id', 'PatientPackageLog.user_id')));

        $conditions = array('User.user_type' => array(4, 5));

        $total_patients = array_merge($patients, $purchased_plan_patients);
        $conditions['User.id'] = $total_patients;
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $like = '%' . $data['condition_like'] . '%';
            if ($data['column_name'] == 1) {
                $col_name = 'User.registration_no';
                $conditions[$col_name] = $data['condition_like'];
            } else if ($data['column_name'] == 2) {
                $conditions['OR'] = array('User.first_name LIKE' => $like, 'User.last_name LIKE' => $like);
            } else if ($data['column_name'] == 3) {
                $conditions['User.email LIKE'] = $like;
            } else if ($data['column_name'] == 4) {
                $patient_ids = $this->Appointment->find('list', array('conditions' => array('Appointment.id' => $data['condition_like'], 'Appointment.doctor_id' => $doctor_id), 'fields' => array('Appointment.user_id', 'Appointment.user_id')));
            } else if ($data['column_name'] == 5) {
                $conditions['User.mobile LIKE'] = $like;
            }

            if (isset($patient_ids) && !empty($patient_ids)) {
                $conditions['User.id'] = $patient_ids;
            } else if (isset($patient_ids) && empty($patient_ids)) {
                $flag = false;
            }
        }

        if ($flag) {
            $this->paginate = array(
                'conditions' => $conditions,
                'order' => 'User.id DESC',
                'limit' => 20
            );

            $users = $this->Paginator->paginate();
        } else {
            $users = array();
        }

        $user_type_id = $this->Auth->user('id');

//        $log = $this->User->getDataSource()->getLog(false, false);
//        debug($users); die;
        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
        $user_types = Configure::read('feish.user_types');
        $this->set(compact('users', 'yes_no', 'user_type_id', 'user_types'));
    }

    public function check_password() {
        $this->layout = null;
        if ($this->request->is('post')) {
            $data = $this->request->data;

            //debug(AuthComponent::password($this->request->data['password']));
            //debug($this->Auth->user('password'));
            $users = $this->User->find('count', array('conditions' => array('User.id' => $this->Auth->user('id'), 'User.password' => AuthComponent::password($this->request->data['password']))));
//            echo '<pre>';print_r($users);die;
            $result = 0;
            if ($users > 0) {
                $result = 1;
            }
            $this->set(compact('result'));
            $this->render('filter');
        }
    }

    public function account_setting() {
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $users = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'), 'User.password' => AuthComponent::password($data['User']['current_password']))));
            if (!empty($users)) {

                if ($this->request->is(array('post', 'put'))) {
                    $this->User->id = $this->Auth->user('id');
                    if ($this->User->save($this->request->data)) {

                        $email = new CakeEmail();
                        $email->config('change_password_patient');
                        $email->to($users['User']['email']);
                        $email->viewVars(compact('users', 'salutations'));
                        $email->subject('Change Password');
                        $email->send();

                        /* send email to admin */
                        $email1 = new CakeEmail();
                        $email1->config('change_password_patient_admin');
                        $email1->to('subscribe@feish.online');
                        $email1->viewVars(compact('users', 'salutations'));
                        $email1->subject('Change Password');
                        $email1->send();

                        /* send sms to doctor or assistant */
                        $number = $users['User']['mobile'];
                        $message = "You have changed the password on" . date('d-M-Y h:i A', strtotime($users['User']['modified'])) . " Please report on 9876765456 or help@feish.com if you haven't changed.";
                        $url = "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=feishtest&password=1198230549&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                        $ch = curl_init($url);

                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $curl_scraped_page = curl_exec($ch);
                        curl_close($ch);

                        /* send sms to admin */
                        $number = "9953333592";
                        $message = "User " . ucfirst($users['User']['first_name']) . " " . ucfirst($users['User']['last_name']) . " has changed the password on" . date('d-M-Y h:i A', strtotime($users['User']['modified']));
                        $url = "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=feishtest&password=1198230549&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                        $ch = curl_init($url);

                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $curl_scraped_page = curl_exec($ch);
                        curl_close($ch);

                        $this->Session->setFlash(__('Password updated Successfuly'), 'success');
                        $this->redirect(array('controller' => 'users', 'action' => 'account_setting'));
                    }
                }
            } else {
                $this->Session->setFlash(__('Please enter correct current password. '), 'error');
                $this->redirect(array('controller' => 'users', 'action' => 'account_setting'));
            }
        }
    }

    public function change_password() {

        $this->layout = 'front_layout';
        $this->loadModel('IdentityType');
        $this->loadModel('Ethnicity');
        $this->loadModel('Occupation');
        $this->loadModel('UserDetail');
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $options = array('conditions' => array('User.' . $this->User->primaryKey => Authcomponent::user('id')));
        $user = $this->User->find('first', $options);

        if (!empty($this->request->data['User']['current_password'])) {

            $this->request->data['User']['password'] = $this->request->data['User']['new_password'];
            $data = $this->request->data;

            $users = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'), 'User.password' => AuthComponent::password($data['User']['current_password']))));
//            debug($users);die;
            if (!empty($users)) {

                if ($this->request->is(array('post', 'put'))) {
                    $this->User->id = $this->Auth->user('id');
                    if ($this->User->save($this->request->data)) {

                        /* send email to patient */
                        $email = new CakeEmail();
                        $email->config('change_password_patient');
                        $email->to($users['User']['email']);
                        $email->viewVars(compact('users', 'salutations'));
                        $email->subject('Change Password');
                        $email->send();

                        /* send email to admin */
                        $email1 = new CakeEmail();
                        $email1->config('change_password_patient_admin');
                        $email1->to('subscribe@feish.online');
                        $email1->viewVars(compact('users', 'salutations'));
                        $email1->subject('Change Password');
                        $email1->send();

                        /* send sms to doctor or assistant */
                        $number = $users['User']['mobile'];
                        $message = "You have changed the password on" . date('d-M-Y h:i A', strtotime($users['User']['modified'])) . " Please report on 9876765456 or help@feish.com if you haven't changed.";
                        $url = "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=feishtest&password=1198230549&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                        $ch = curl_init($url);

                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $curl_scraped_page = curl_exec($ch);
                        curl_close($ch);

                        /* send sms to admin */
                        $number = "9953333592";
                        $message = "User " . ucfirst($users['User']['first_name']) . " " . ucfirst($users['User']['last_name']) . " has changed the password on" . date('d-M-Y h:i A', strtotime($users['User']['modified']));
                        $url = "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=feishtest&password=1198230549&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                        $ch = curl_init($url);

                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $curl_scraped_page = curl_exec($ch);
                        curl_close($ch);

                        $this->Session->setFlash(__('Password updated Successfuly'), 'success');
                        $this->redirect(array('controller' => 'patient_habits', 'action' => 'health_profile'));
                    }
                }
            } else {
                $this->Session->setFlash(__('Please enter correct current password. '), 'error');
                $this->redirect(array('controller' => 'patient_habits', 'action' => 'health_profile'));
            }
        }

        $this->request->data = $user;
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $gender = Configure::read('feish.gender');
        $marital_status = Configure::read('feish.marital_status');

        $ethnicity = $this->Ethnicity->find('list');
        $occupations = $this->Occupation->find('list');
        $identity_types = $this->IdentityType->find('list');
        $blood_groups = Configure::read('feish.blood_groups');
        $this->set(compact('user', 'salutations', 'gender', 'marital_status', 'occupations', 'ethnicity', 'identity_types', 'blood_groups'));
    }

    public function profile() {
        $this->layout = 'front_layout';
        $this->loadModel('IdentityType');
        $this->loadModel('Ethnicity');
        $this->loadModel('Occupation');
        $this->loadModel('UserDetail');
        $options = array('conditions' => array('User.' . $this->User->primaryKey => Authcomponent::user('id')));
        $user = $this->User->find('first', $options);

        /* if (!$this->User->exists($id)) {
          throw new NotFoundException(__('Invalid user'));
          } */
        if ($this->request->is(array('post', 'put'))) {

            $condtion = array('conditions' => array('User.' . $this->User->primaryKey => Authcomponent::user('id'), 'height' => $this->request->data['UserDetail'][0]['height'], 'weight' => $this->request->data['UserDetail'][0]['weight'], 'waist_size' => $this->request->data['UserDetail'][0]['waist_size']), 'order' => 'UserDetail.id DESC');
            $user_details_exists = $this->UserDetail->find('first', $condtion);

            if (!empty($user_details_exists['UserDetail'])) {
                $user_details_exists = $user_details_exists['UserDetail'];
                $this->UserDetail->id = $user_details_exists['id'];
                $this->UserDetail->save($user_details_exists);
            } else {
                $this->UserDetail->create();
                $new_user_details = array('user_id' => Authcomponent::user('id'), 'date_added' => date('Y-m-d h:i:s'), 'height' => $this->request->data['UserDetail'][0]['height'], 'weight' => $this->request->data['UserDetail'][0]['weight'], 'waist_size' => $this->request->data['UserDetail'][0]['waist_size']);
                $this->UserDetail->save($new_user_details);
            }

            $data = $this->request->data;
            $save_data = array();
            $new_data = array();
            foreach ($data['User']['identity_details'] as $key => $value) {
                $new_data[$value['identity_id']] = $value['identity'];
            }

            $avatar = $data['User']['avatar'];
            $avatar_name = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 7);
            $upload_path = APP . WEBROOT_DIR . '/img/user_avtar';
            $alias_name = $data['User']['hidden_img'];

            if ($avatar['error'] == UPLOAD_ERR_OK) {
                $ext = pathinfo($avatar["name"], PATHINFO_EXTENSION);
                if (strtolower($ext) == 'jpg' || strtolower($ext) == 'jpeg' || strtolower($ext) == 'png' || strtolower($ext) == 'bmp') {
                    if (move_uploaded_file($avatar['tmp_name'], $upload_path . DS . $avatar_name . "." . $ext)) {
                        $alias_name = $avatar_name . "." . $ext;
                    }
                }
            }
            $data['User']['avatar'] = @$alias_name;

            $user['User']['identity_id'] = (empty($user['User']['identity_id'])) ? '' : $user['User']['identity_id'];
            $identity_details = json_decode($user['User']['identity_id'], true);
//            $identity_details[$data['User']['identity']] = $data['User']['identity'];
//            debug($identity_details[$data['User']['identity']]);die;
//            $data['User']['identity'] = json_encode($identity_details);
//            $data['User']['identity'] = $data['User']['identity'];
            $data['User']['identity'] = json_encode($new_data);
            $data['User']['address'] = $data['User']['address'];

            $data['UserDetail'][0]['user_id'] = Authcomponent::user('id');
            $data['UserDetail'][0]['date_added'] = date('Y-m-d H:i:s');
            $data['User']['id'] = Authcomponent::user('id');

            unset($data['User']['hidden_img']);
            unset($data['User']['identity_type']);
            unset($data['User']['id_value']);

            $this->User->id = Authcomponent::user('id');
            $data['User']['birth_date'] = date('Y-m-d', strtotime(str_replace('-', '/', $data['User']['birth_date'])));
            if ($this->User->save($data)) {
//            if ($this->User->saveAssociated($data)) {
                $this->Session->write('Auth', $this->User->read(null, $this->Auth->User('id')));
                $this->Session->setFlash(__('The user profile has been updated.'), 'success');
                return $this->redirect(array('controller' => 'patient_habits', 'action' => 'health_profile'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
            }
        }
        $this->request->data = $user;
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $gender = Configure::read('feish.gender');
        $marital_status = Configure::read('feish.marital_status');

        $ethnicity = $this->Ethnicity->find('list');
        $occupations = $this->Occupation->find('list');
        $identity_types = $this->IdentityType->find('list');
        $blood_groups = Configure::read('feish.blood_groups');
        $this->set(compact('user', 'salutations', 'gender', 'marital_status', 'occupations', 'ethnicity', 'identity_types', 'blood_groups'));
    }

    public function forgot_password() {
        $this->layout = null;
        if ($this->request->is('post')) {
            // debug($this->request->data);die;
            $data = $this->request->data;
            if (empty($data['User']['email'])) {
                $this->Session->setFlash('Please enter correct email id.', 'error');
                $this->redirect($this->referer());
            }
            $user = $this->User->find('first', array('conditions' => array('User.email' => $data['User']['email']), 'recursive' => -1));

            if (empty($user)) {
                $this->Session->setFlash('This Email  is not associated with our site.', 'error');
                $this->redirect($this->referer());
            } else {
                if ($user['User']['is_active'] == 0) {
                    $this->Session->setFlash('This account is deactive.Please contact administrator', 'error');
                    $this->redirect($this->referer());
                } elseif ($user['User']['is_verified'] == 0) {
                    $this->Session->setFlash('This account is not verified.Please verify it.', 'error');
                    $this->redirect($this->referer());
                } else {
                    $new_pwd = substr(str_shuffle(str_repeat('ABCDEFGHJKLMNPQRSTUVWXYZ23456789', 5)), 0, 5);
                    $user['User']['password'] = $new_pwd;
                    Configure::load('feish');
                    $salutations = Configure::read('feish.salutations');


                    if ($this->User->save($user)) {
                        $email = new CakeEmail();
                        $email->config('forgot_password');
                        $email->viewVars(compact('user', 'salutations'));
                        $email->subject('Password Recovery On Feish');
                        $email->to($user['User']['email']);
                        $email->send();

                        /* send sms to doctor */
                        $number = $user['User']['mobile'];

                        $message = "You have requested forget password option on" . date('d-m-Y h:i:s A') . " Please report on 9876765456 or help@feish.com if you haven't changed";
                        $url = "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=feishtest&password=1198230549&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                        $ch = curl_init($url);

                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $curl_scraped_page = curl_exec($ch);
                        curl_close($ch);


                        $this->Session->setFlash('Your password has been reseted. Please check your mail.', 'success');
                        $this->redirect(array('action' => 'login'));
                    } else {
                        debug($this->User->validationErrors);
                        die;
                        $this->Session->setFlash('Oops something went wrong. Please try again.', 'error');
                    }
                }
            }
        }
    }

    public function check_user() {
        $this->layout = null;
        if ($this->request->is('post')) {
            $users = $this->User->find('first', array('conditions' => array('User.mobile' => $this->request->data['mobile'], 'User.user_type' => array(4, 5)), 'fields' => array('User.id', 'User.salutation', 'User.first_name', 'User.last_name', 'User.email', 'User.gender', 'User.user_type'), 'recursive' => -1));
            if (!empty($users)) {
                $result['status'] = 1;
                $result['User'] = $users['User'];
            } else {
                $result['status'] = 0;
            }
            $this->set(compact('result'));
            $this->render('filter');
        }
    }

    public function get_user_purchased_plan() {
        $this->layout = null;
        $this->loadModel('Appointment');
        $this->loadModel('PatientPackageLog');
        if ($this->request->is('post')) {
            $purchased_plan_list = $this->PatientPackageLog->find('list', array('conditions' => array('PatientPackageLog.user_id' => $this->request->data['user_id'], 'PatientPackageLog.is_active' => 1, 'PatientPackageLog.service_id' => $this->request->data['service_id']), 'fields' => array('PatientPackageLog.id', 'PatientPackageLog.package_name')));

            if (!empty($purchased_plan_list)) {
                $result = $purchased_plan_list;
            } else {
                
            }
            $this->set(compact('result'));
            $this->render('filter');
        }
    }

    public function terms_and_conditions() {
        $this->layout = 'front_layout';
    }
	public function user_faq($cat='individuals') {
        
        $this->layout = 'front_layout';

        $this->loadModel('Faq');

        $faqs= $this->Faq->find('all',array('conditions'=>array('categroy'=>$cat,'status'=>1)));
              
        $this->set('faqs',$faqs);

    }

    public function test_sms() {

        $message = "User Sonali has registered on 17-Mar-2016 11:30 AM. Registration number:REG-78678776 Please verify the details and approve.";
        $url = "http://bulksms.mysmsmantra.com:8080/WebSMS/SMSAPI.jsp?username=feishtest&password=1198230549&sendername=FEISHT&mobileno=9096805292&message=" . urlencode($message);

        $ch = curl_init($url);
        //debug($url);die;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch);
        echo $curl_scraped_page;
        die;
    }

    public function contact() {
        $this->layout = 'front_layout';

        if ($this->request->is('post')) {

            if (!empty($this->request->data['Contact']['email'])) {

                $email = new CakeEmail();
                $user_data = array();
                $user_data = $this->request->data;
                $email->config('contact_us');
                $email->to(' support@feish.online');
                $email->viewVars(compact('user_data'));
                $email->subject('Contact Us');
                $email->send();

                $this->Session->setFlash(__('Congratulations you have sent message Successfully.'), 'success');
                return $this->redirect(array('action' => 'dashboard'));
            } else {
                $this->Session->setFlash(__('Sorry,Registration failed ,Please try again .'), 'error');
            }
        }

        $this->set(compact('salutations'));
    }

    public function doctors_report() {

        Configure::load('feish');
        $keywords = Configure::read('feish.search_keywords');

        $f_date = new DateTime('first day of this month');
        $start_dt = $f_date->format('d/m/Y');
        $l_date = new DateTime('last day of this month');
        $conditions = array('User.created >= ' => $f_date->format('Y-m-d H:i:s'), 'User.created <= ' => $l_date->format('Y-m-d H:i:s'), 'User.user_type' => array(2));

        if ($this->request->is('post')) {
            $conditions = array();
            $user_data = $this->request->data;
            if (!empty($user_data['User']['from_date']) && !empty($user_data['User']['from_date']))
                $conditions = array('User.created >= ' => date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $user_data['User']['from_date']))), 'User.created <= ' => date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $user_data['User']['to_date']) . " 23:59:59")));
            if ($user_data['User']['from_date'] == '') {
                unset($conditions['User.created  >= ']);
            }
            if ($user_data['User']['to_date'] == '') {
                unset($conditions['User.created <= ']);
            }
            $conditions['User.user_type'] = array(2);
        }
        $this->paginate = array(
            'conditions' => $conditions,
            'order' => 'User.id DESC',
            'limit' => 20);
        $users = $this->Paginator->paginate();
//            debug($conditions); die;
//        $log = $this->User->getDataSource()->getLog(false, false);
//        debug($log); die;
        $this->set(compact('users', 'start_dt', 'keywords'));
    }

    public function view_invoice_report($user_id = null, $f_date, $l_date) {
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $this->loadModel('PatientPackageLog');

        $users = $this->User->find('first', array(
            'conditions' => array('User.id' => $user_id)
                )
        );
        $conditions = array('PatientPackageLog.service_id' => $users['Services'][0]['id'], 'PatientPackageLog.start_date >= ' => date("Y-m-d", strtotime($f_date)), 'PatientPackageLog.start_date <= ' => date("Y-m-d", strtotime($l_date)));
        if ($f_date == '0') {
            $f_date = 0;
            unset($conditions['PatientPackageLog.start_date >= ']);
        }
        if ($l_date == '0') {
            $l_date = date("d-m-Y");
            unset($conditions['PatientPackageLog.start_date <= ']);
        }

        $patient_details = $this->PatientPackageLog->find('all', array(
            'conditions' => $conditions
                )
        );
//        $log = $this->PatientPackageLog->getDataSource()->getLog(false, false);
//        debug($log); die;
        $this->set(compact('users', 'patient_details', 'salutations', 'f_date', 'l_date', 'user_id'));
    }

    public function print_invoice_report($user_id = null, $f_date, $l_date) {
        $this->layout = '';
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $this->loadModel('PatientPackageLog');

        $users = $this->User->find('first', array(
            'conditions' => array('User.id' => $user_id)
                )
        );
        $conditions = array('PatientPackageLog.service_id' => $users['Services'][0]['id'], 'PatientPackageLog.start_date >= ' => date("Y-m-d", strtotime($f_date)), 'PatientPackageLog.start_date <= ' => date("Y-m-d", strtotime($l_date)));
        if ($f_date == '0') {
            $f_date = 0;
            unset($conditions['PatientPackageLog.start_date >= ']);
        }
        if ($l_date == '0') {
            $l_date = date("d-m-Y");
            unset($conditions['PatientPackageLog.start_date <= ']);
        }

        $patient_details = $this->PatientPackageLog->find('all', array(
            'conditions' => $conditions
                )
        );
//        $log = $this->PatientPackageLog->getDataSource()->getLog(false, false);
//        debug($log); die;
        $this->set(compact('users', 'patient_details', 'salutations', 'f_date', 'l_date'));
    }

    //function for managing accounts - adding/updating Dr's entries
    public function manage_accounts($dr_id = null) {
        $this->loadModel('Account');
        $this->loadModel('Service');
        $this->loadModel('PatientPackageLog');
        $insert_flag = true;
        $get_data = array();
        $conditions = array('Account.user_id' => $dr_id);
        $service_list = $this->Service->find('list', array('conditions' => array('Service.user_id' => $dr_id), 'fields' => array('Service.id', 'Service.id')));
        $plan_list = $this->PatientPackageLog->find('all', array('conditions' => array('PatientPackageLog.service_id' => $service_list, 'PatientPackageLog.is_active' => 1), 'fields' => array('count(PatientPackageLog.id) as total_patients', 'Service.id', 'PatientPackageLog.id', 'PatientPackageLog.package_name', 'sum(PatientPackageLog.price) as total_cost', 'sum(PatientPackageLog.commission) as commission')));
//        $log = $this->PatientPackageLog->getDataSource()->getLog(false, false);
//        debug($log); die;
        $get_data['user_id'] = $dr_id;
        foreach ($plan_list as $value) {
            $get_data['patient_count'] = $value[0]['total_patients'];
            $get_data['total_cost'] = $value[0]['total_cost'];
            $get_data['commission'] = $value[0]['commission'];
            $get_data['dr_income_cost'] = number_format($value[0]['total_cost'] - $value[0]['commission'], 2, '.', '');
            $get_data['invoice_date'] = date('Y-m-d H:i:s');
        }
//        debug($get_data); die;
        //if any upaid entry found, update ammounts else create new entry
        if ($this->Account->hasAny($conditions)) {
            $data = $this->Account->find('first', array('conditions' => $conditions, 'fields' => array('Account.id', 'Account.paid_flag')));
//            debug($data); die;
            //if payment has not maid - update existing record
            if ($data['Account']['paid_flag'] == 0) {
                $insert_flag = false;
                $this->Account->id = $data['Account']['id'];
                if ($this->Account->save($get_data)) {
                    $this->Session->setFlash(__('The Account has been updated.'), 'success');
                    //                return $this->redirect(array('action' => 'view', $id, $user_type));
                } else {
                    $this->Session->setFlash(__('The Account could not be updated. Please, try again.'));
                }
            }
        }
        //if dr_id doesn't exist or payment for that dr is done - insert new record
        if ($insert_flag) {
            if ($this->Account->save($get_data)) {
                $this->Session->setFlash(__('New Doctor record in Account has been inserted.'), 'success');
//                return $this->redirect(array('action' => 'view', $id, $user_type));
            } else {
                $this->Session->setFlash(__('New Doctor record in Account could not be inserted. Please, try again.'));
            }
        }
    }

    /* ALTER TABLE `users` ADD `marital_status` INT NOT NULL AFTER `modified`, ADD `blood_group` INT NOT NULL AFTER `marital_status`, ADD `edu_qualification` VARCHAR(100) NOT NULL AFTER `blood_group`, ADD `occupation` INT NOT NULL AFTER `edu_qualification`, ADD `address` VARCHAR(500) NOT NULL AFTER `occupation`, ADD `ethnicity` INT NOT NULL AFTER `address`, ADD `identity` VARCHAR(500) NOT NULL AFTER `ethnicity`;
      ALTER TABLE `users` DROP `edu_qualification`; */
     public function news($id){

        $this->layout='front_layout';
    //    $this->autoRender = false; 

        $rss2 = new DOMDocument();
        $rss2->load('http://rss.medicalnewstoday.com/cardiovascular-cardiology.xml');
        $feed2 = array();
        foreach ($rss2->getElementsByTagName('item') as $key2 => $node2) { 

           

            $item2 = array(
                'id' => $key2+1,
                'title' => $node2->getElementsByTagName('title')->item(0)->nodeValue,
                'desc' => $node2->getElementsByTagName('description')->item(0)->nodeValue,
                'link' => $node2->getElementsByTagName('link')->item(0)->nodeValue,
                'date' => $node2->getElementsByTagName('pubDate')->item(0)->nodeValue,
            );

            array_push($feed2, $item2);

             if ($key2+1 == 5) {
                break;
            }
        
        }
      //  debug($feed2);
        $this->set('news',$feed2);
        $data=$feed2[$id-1];
      $this->set('news_id',$id);
      $this->set('data',$data);



      //  echo $id;

     } 

     public function ajaxNewsletter(){

        $this->autoRender=false;

        

        print_r($this->request->post);

          if ($this->request->is('ajax')) {
            // Use data from serialized form
            // print_r($this->request->data); // name, email, message
            // Render the contact-ajax-response view in the ajax layout
           echo $email=$this->request->data['emailid'];

            //$Email = new newsletter_sub();
           // $Email->from(array($email => 'Newsletter Subscription Request'))               
          //      ->send($email);


        }
     }
     
     
    public function test_email() {
        $email = new CakeEmail();
//        $email->SMTPDebug = 2; // Enables SMTP debug information - SHOULD NOT be active on production servers!
//        $email->SMTPAuth = false; // Enables SMTP authentication.
        $email->from(array('asmita.wazalwar@gmail.com' => 'My Site'));
        $email->config('smtptest');
        $email->to('asmita.wazalwar@codaemonsoftwares.com');
        $email->subject('About');
//        $email->send();
        try {
            $success = $email->send();
        } catch (SocketException $e) { // Exception would be too generic, so use SocketException here
            $errorMessage = $e->getMessage();
        }
        /*try{
            $mail = new PHPMailer(true);
//            $mail->IsSMTP(); // Using SMTP.
            $mail->CharSet = 'utf-8';
            $mail->SMTPDebug = 2; // Enables SMTP debug information - SHOULD NOT be active on production servers!
            $mail->SMTPAuth = false; // Enables SMTP authentication.
            $mail->Host = "smtp.sendgrid.net"; // SMTP server host.

            $mail->AddReplyTo('asmita.wazalwar@codaemonsoftwares.com', 'Me');
            $mail->SetFrom('support@feish.online', 'Feish Team');
            $mail->AddAddress('asmita.wazalwar@codaemonsoftwares.com', 'Me');
            $mail->Subject = 'PHPMailer Test Subject via smtp, basic with authentication';
            $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
            $mail->MsgHTML("Hi, this is an test email");
            $mail->Send();
        } catch (phpmailerException $e) {
            echo $e->errorMessage(); 
        } catch (Exception $e) {
            echo $e->getMessage(); 
        }*/
        die;
    }

    public function beforeFilter() {
        $this->Auth->allow(array('test_email', 'logout', 'forgot_password', 'login', 'add', 'index', 'homepage', 'sign_up', 'check_mail_id', 'check_mobile', 'verify_account', 'check_user', 'test', 'terms_and_conditions', 'user_faq','test_sms', 'new_homepage', 'contact','myfaq','news','ajaxNewsletter'));

        $action = $this->request->action;
        $front_actions = array('hompage', 'dashboard', 'profile');
        if (in_array($action, $front_actions)) {
            $this->layout = 'front_layout';
        }
    }

}
