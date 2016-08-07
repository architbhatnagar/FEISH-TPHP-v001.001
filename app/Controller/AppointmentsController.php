<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Appointments Controller
 *
 * @property Appointment $Appointment
 * @property PaginatorComponent $Paginator
 */
class AppointmentsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public function beforeFilter() {
        $action = $this->request->action;
        $front_actions = array('view_all', 'add_drugs_by_patient');
        if (in_array($action, $front_actions)) {
            $this->layout = 'front_layout';
        }
        $this->Auth->allow(array('can_cancel_appointment', 'get_data', 'get_time_slots_update'));
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() { 
        $doc_id = $this->Auth->user('id');
        $this->loadModel('Service');
        $this->loadModel('Appointment');
        $this->loadModel('PatientPackageLog');
        $this->loadModel('User');
        Configure::load('feish');
        $appointment_status = Configure::read('feish.appointment_status');
        $salutations = Configure::read('feish.salutations');

        $this->Appointment->recursive = 0;
        $this->paginate = array(
            'conditions' => array('Appointment.doctor_id' => $doc_id),
            'fields'=>array(
                'Appointment.id','Service.title','User.registration_no','Appointment.status','Appointment.scheduled_date',
                'Appointment.appointed_timing','User.id','Service.id','User.first_name','User.last_name'
            ),
            'order' => 'Appointment.id DESC',
            'limit' => 50
        );


        if ($this->request->is('post')) {
            $apt_data = $this->Appointment->find('first', array(
                'conditions' => array('Appointment.id' => $this->request->data['Appointment']['id']), 
                'fields' => array('Appointment.appointed_timing','Appointment.scheduled_date'), 
                'recursive' => -1
                )
            );
            
            if ((strtotime($apt_data['Appointment']['appointed_timing']) - time()) < 0 && $this->request->data['Appointment']['status']!=2) {
                $this->Session->setFlash(__('Appointment date expired.'), 'error');
                return $this->redirect(array('action' => 'index'));
            }
            $this->request->data['Appointment']['status_updated_by'] = $this->Auth->user('id');
            if ($this->request->data['Appointment']['status'] == 2) {
                $this->request->data['Appointment']['scheduled_date'] = date('Y-m-d H:i:s', strtotime($this->request->data['Appointment']['scheduled_date'] . " " . $this->request->data['Appointment']['scheduled_time']));
            }
            $this->Appointment->id = $this->request->data['Appointment']['id'];

            /*added by yogesh more on 20 april 2016*/
            if($apt_data['Appointment']['scheduled_date'] == null){
                $scheduled_date = NULL;
            }else{
                $scheduled_date = date('Y-m-d H:i:s',  strtotime($apt_data['Appointment']['scheduled_date']));
            }
//            debug($scheduled_date);
            if(empty($this->request->data['Appointment']['scheduled_date']) && $this->request->data['Appointment']['status'] == '3'){ 
                $this->request->data['Appointment']['scheduled_date'] = $scheduled_date;
            }
            else if($scheduled_date != null && ($this->request->data['Appointment']['status'] == '1' || $this->request->data['Appointment']['status'] == '0')) { 
                $this->request->data['Appointment']['scheduled_date'] = $scheduled_date;
            }
            
//            debug($this->request->data);die;
            /*end*/
            
            if ($this->Appointment->save($this->request->data)) {

                $appointment_data = $this->Appointment->find('first', array('conditions' => array('Appointment.id' => $this->Appointment->id), 'fields' => array('Appointment.appointed_timing', 'Appointment.status', 'Appointment.patient_package_log_id',
                        'Appointment.id', 'Appointment.status', 'Appointment.scheduled_date', 'Appointment.reason', 'User.id', 'User.salutation', 'User.first_name', 'User.mobile', 'User.last_name', 'Doctor.id', 'Doctor.salutation', 'User.registration_no', 'User.email', 'Doctor.mobile', 'Doctor.registration_no', 'Doctor.email', 'Doctor.first_name', 'Doctor.last_name', 'Service.title'
                )));
                if ($appointment_data['Appointment']['status'] != 3) {
                    if ($this->request->data['Appointment']['status'] == 3) {
                        $this->loadModel('PatientPackageLog');
                        $package = $this->PatientPackageLog->find('first', array('conditions' => array('PatientPackageLog.id' => $appointment_data['Appointment']['patient_package_log_id'])));
                        if (!empty($package)) {
                            $this->PatientPackageLog->updateAll(array('PatientPackageLog.remaining_visits' => ($package['PatientPackageLog']['remaining_visits'] + 1), 'PatientPackageLog.used_visits' => ($package['PatientPackageLog']['used_visits'] - 1)), array('PatientPackageLog.id' => $package['PatientPackageLog']['id']));
                        }
                    }
                }



                $number = $appointment_data['User']['mobile'];
                if ($appointment_data['Appointment']['status'] != 3):

                    if ($appointment_data['Appointment']['status'] == 2):
//                        ~~Appointment ID~~, is ~~status~~. Please login or check email for more information.
                        $message = "Your Appointment ID: APP-" . $appointment_data['Appointment']['id'] . " is" . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " Please check personal mails or login to check further.";

                    else:
//                        Your appointment ~~appoint ID~~ is scheduled at ~~date time~~ on ~~date~~.Please carry a valid ID and visit 30 minutes in advance.
                        $message = "Your appointment ID: APP-" . $appointment_data['Appointment']['id'] . " is scheduled at" . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . " on date.Please carry a valid ID and visit 30 minutes in advance.";
//                        $message = "Dear " . ucfirst($appointment_data['User']['first_name']) . " your appointment ID: APP-" . $appointment_data['Appointment']['id'] . " has been " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " by doctor " . $salutations[$appointment_data['Doctor']['salutation']] . ". " . ucfirst($appointment_data['Doctor']['first_name']) . " " . ucfirst($appointment_data['Doctor']['last_name']) . " on " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . " for your service " . $appointment_data['Service']['title'] . ".";

                    endif;
                else:
                    $message = "Your Appointment ID: APP-" . $appointment_data['Appointment']['id'] . " is" . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " Please login or check email for more information.";
                endif;
                //debug($message);die;
                $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $curl_scraped_page = curl_exec($ch);
                curl_close($ch);

                $number = $appointment_data['Doctor']['mobile'];
                //$number = '7219003017';
                if ($appointment_data['Appointment']['status'] != 3):

                    if ($appointment_data['Appointment']['status'] == 2):

//                        $message = "Dear " . ucfirst($appointment_data['Doctor']['first_name']) . " Your Have " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " appointment ID APP-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " on " . date('d-M-Y H:i A', strtotime($appointment_data['Appointment']['scheduled_date'])) . " for  service " . $appointment_data['Service']['title'] . ".";
                        $message = "Appoint ID APP-" . $appointment_data['Appointment']['id'] . " date Time is" . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . "on" . date('d-M-Y H:i A', strtotime($appointment_data['Appointment']['scheduled_date'])) . " Please login to approve and check further details ";
                    else:
                        $message = "Appoint ID APP-" . $appointment_data['Appointment']['id'] . " date Time is" . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . "on" . date('d-M-Y H:i A', strtotime($appointment_data['Appointment']['scheduled_date'])) . " Please login to approve and check further details ";
//                        $message = "Dear " . ucfirst($appointment_data['Doctor']['first_name']) . " Your Have " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " appointment ID APP-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " on " . date('d-M-Y H:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . " for  service " . $appointment_data['Service']['title'] . ".";
                    endif;
                else:
                    $message = "Appoint ID APP-" . $appointment_data['Appointment']['id'] . " date Time is" . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . "on" . date('d-M-Y H:i A', strtotime($appointment_data['Appointment']['scheduled_date'])) . " Please login to approve and check further details ";
//                    $message = "Dear " . ucfirst($appointment_data['Doctor']['first_name']) . " Your Have " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " appointment ID APP-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " scheduled on " . date('d-M-Y H:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . " for service " . $appointment_data['Service']['title'] . ".";
                endif;
                $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $curl_scraped_page = curl_exec($ch);
                curl_close($ch);


                $number = '9953333592';
                if ($appointment_data['Appointment']['status'] != 3):

                    if ($appointment_data['Appointment']['status'] == 2):
                        $message = "Dear admin ,The appointment ID: APT-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " has been " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " by doctor ID DOC-" . $appointment_data['Doctor']['registration_no'] . " scheduled on " . date('d-M-Y H:i A', strtotime($appointment_data['Appointment']['scheduled_date'])) . ".";
                    else:
                        $message = "Dear admin ,The appointment ID: APT-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " has been " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " by doctor ID DOC-" . $appointment_data['Doctor']['registration_no'] . " scheduled on " . date('d-M-Y H:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . ".";
                    endif;
                else:
                    $message = "Dear admin ,The appointment ID: APT-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " has been " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " by doctor ID DOC-" . $appointment_data['Doctor']['registration_no'] . " scheduled on " . date('d-M-Y H:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . ".";
                endif;
                //debug($message);die;
                $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $curl_scraped_page = curl_exec($ch);
                curl_close($ch);
                // die;
                $update_by = 2;
                $email = new CakeEmail();
                $email->config('appointment_status_patient');
                $email->to($appointment_data['User']['email']);
                $email->viewVars(compact('salutations', 'appointment_data', 'appointment_status', 'update_by'));
                $email->subject('APT-' . $appointment_data['Appointment']['id'] . "," . $appointment_status[$appointment_data['Appointment']['status']]);
                $email->send();

                //$number = $appointment_data['User']['mobile'];


                $email2 = new CakeEmail();
                $email2->config('appointment_status_doctor');
                $email2->to($appointment_data['Doctor']['email']);
                //$to=$salutations[$this->Auth->user('salutation')].". ".ucfirst($this->Auth->user('first_name'))." ".ucfirst($this->Auth->user('last_name'));
                $email2->viewVars(compact('salutations', 'appointment_data', 'appointment_status', 'update_by'));
                $email2->subject('APT-' . $appointment_data['Appointment']['id'] . "," . $appointment_status[$appointment_data['Appointment']['status']]);
                //debug( $email2->send());die;
                $email2->send();

                /* send mail patient to admin */
                $email = new CakeEmail();
                $email->config('appointment_status_admin');
                $email->to('admin@feish.online');
                $email->viewVars(compact('salutations', 'appointment_data', 'appointment_status', 'update_by'));
                $email->subject('APT-' . $appointment_data['Appointment']['id'] . "," . $appointment_status[$appointment_data['Appointment']['status']]);
                $email->send();
                $this->loadModel('Communication');
                $communication_data = array();
                if ($appointment_data['Appointment']['status'] != 3):

                    if ($appointment_data['Appointment']['status'] == 2):
                        $communication_data['Communication']['message'] = "The appointment ID: APT-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " has been " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " by doctor ID DOC-" . $appointment_data['Doctor']['registration_no'] . " scheduled on " . date('d-M-Y H:i A', strtotime($appointment_data['Appointment']['scheduled_date'])) . ".";
                    else:
                        $communication_data['Communication']['message'] = "The appointment ID: APT-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " has been " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " by doctor ID DOC-" . $appointment_data['Doctor']['registration_no'] . " scheduled on " . date('d-M-Y H:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . ".";
                    endif;
                else:
                    $communication_data['Communication']['message'] = "The appointment ID: APT-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " has been " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " by doctor ID DOC-" . $appointment_data['Doctor']['registration_no'] . " scheduled on " . date('d-M-Y H:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . ".";
                endif;
                // $communication_data['Communication']['message'] = "The appointment Id APT-".;
                $parent_id = $this->Communication->find('first', array('conditions' => array('Communication.appointment_id' => $this->request->data['Appointment']['id']), 'fields' => array('Communication.id'), 'recursive' => -1));
                $communication_data['Communication']['parent_id'] = $parent_id['Communication']['id'];
                $communication_data['Communication']['subject'] = 'APT-' . $appointment_data['Appointment']['id'] . "," . $appointment_status[$appointment_data['Appointment']['status']];
                $communication_data['Communication']['user_id'] = 0;
                $communication_data['Communication']['reciever_user_id'] = $appointment_data['User']['id'] . "," . $appointment_data['Doctor']['id'];
                $viewed_users = explode(',', $communication_data['Communication']['reciever_user_id']);
                //debug($viewed_users);
                foreach ($viewed_users as $user) {
                    $user_array[$user] = 0;
                }
                // debug($user_array);die;
                $communication_data['Communication']['viewed_users'] = json_encode($user_array);
                if ($this->Communication->save($communication_data)) {
                    // debug('done');die;
                } else {
                    
                }
                $this->Session->setFlash(__('Appointment updated successfully'), 'success');
            } else {
                $this->Session->setFlash(__('Appointment could not be updated. Please try again,'), 'error');
            }
            return $this->redirect(array('action' => 'index'));
        }

        $appointments = $this->Paginator->paginate();

//        $log = $this->Appointment->getDataSource()->getLog(false, false);
        $this->set('appointments', $appointments);
        $this->set('appointment_status', $appointment_status);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Appointment->exists($id)) {
            throw new NotFoundException(__('Invalid appointment'));
        }
        $options = array('conditions' => array('Appointment.' . $this->Appointment->primaryKey => $id));
        $this->set('appointment', $this->Appointment->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Appointment->create();
            if ($this->Appointment->save($this->request->data)) {
                $this->Session->setFlash(__('The appointment has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The appointment could not be saved. Please, try again.'));
            }
        }
        $users = $this->Appointment->User->find('list');
        $services = $this->Appointment->Service->find('list');
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
        if (!$this->Appointment->exists($id)) {
            throw new NotFoundException(__('Invalid appointment'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Appointment->save($this->request->data)) {
                $this->Session->setFlash(__('The appointment has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The appointment could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Appointment.' . $this->Appointment->primaryKey => $id));
            $this->request->data = $this->Appointment->find('first', $options);
        }
        $users = $this->Appointment->User->find('list');
        $services = $this->Appointment->Service->find('list');
        $this->set(compact('users', 'services'));
    }

    public function assistant_index() {
        Configure::load('feish');

        $user_types = Configure::read('feish.user_types');
        $appointment_status = Configure::read('feish.appointment_status');

        $salutations = Configure::read('feish.salutations');
        if ($this->request->is('post')) {


            $apt_data = $this->Appointment->find('first', array('conditions' => array('Appointment.id' => $this->request->data['Appointment']['id']), 'fields' => array('Appointment.appointed_timing'), 'recursive' => -1));

            if ((strtotime($apt_data['Appointment']['appointed_timing']) - time()) < 0) {
                $this->Session->setFlash(__('Appointment date expired.'), 'error');
                return $this->redirect(array('action' => 'assistant_index'));
            }
            $this->request->data['Appointment']['status_updated_by'] = $this->Auth->user('id');
            if ($this->request->data['Appointment']['status'] == 2) {
                if (empty($this->request->data['Appointment']['scheduled_date']) || empty($this->request->data['Appointment']['scheduled_time'])) {
                    $this->Session->setFlash(__('Please select date and time.'), 'error');
                    return $this->redirect(array('action' => 'assistant_index'));
                }
                $this->request->data['Appointment']['scheduled_date'] = date('Y-m-d H:i:s', strtotime($this->request->data['Appointment']['scheduled_date'] . " " . $this->request->data['Appointment']['scheduled_time']));
//                $this->request->data['Appointment']['actual_date'] = $this->request->data['Appointment']['scheduled_date'];
            }
            $this->Appointment->id = $this->request->data['Appointment']['id'];

            $booked_appointment_user_data = $this->Appointment->find('first', array('conditions' => array('Appointment.id' => $this->request->data['Appointment']['id'])));
            /* added by yogesh */


            /* end */


            $service_name = $booked_appointment_user_data['Service']['title'];
            $apt_data = $booked_appointment_user_data['Appointment']['scheduled_date'];

            $status = $this->request->data['Appointment']['status'];
            $fetch_data = $this->Appointment->User->find('first', array('conditions' => array('User.id' => $booked_appointment_user_data['User']['id'])));

            /* send mail patient to doctor */
            /*added by yogesh more on 20 April 2016*/
            if($booked_appointment_user_data['Appointment']['scheduled_date'] == null){
                $scheduled_date = NULL;
            }else{
                $scheduled_date = date('Y-m-d H:i:s',  strtotime($booked_appointment_user_data['Appointment']['scheduled_date']));
            }

            if(empty($this->request->data['Appointment']['scheduled_date']) && $this->request->data['Appointment']['status'] == '3'){ 
                $this->request->data['Appointment']['scheduled_date'] = $scheduled_date;
            }
            else if($scheduled_date != null && ($this->request->data['Appointment']['status'] == '1' || $this->request->data['Appointment']['status'] == '0')) { 
                $this->request->data['Appointment']['scheduled_date'] = $scheduled_date;
            }
            /*end*/

            if ($this->Appointment->save($this->request->data)) {


                if ($booked_appointment_user_data['Appointment']['status'] != 3) {
                    if ($this->request->data['Appointment']['status'] == 3) {
                        $this->loadModel('PatientPackageLog');
                        $package = $this->PatientPackageLog->find('first', array('conditions' => array('PatientPackageLog.id' => $booked_appointment_user_data['Appointment']['patient_package_log_id'])));
                        if (!empty($package)) {
                            $this->PatientPackageLog->updateAll(array('PatientPackageLog.remaining_visits' => ($package['PatientPackageLog']['remaining_visits'] + 1), 'PatientPackageLog.used_visits' => ($package['PatientPackageLog']['used_visits'] - 1)), array('PatientPackageLog.id' => $package['PatientPackageLog']['id']));
                        }
                    }
                }
                $appointment_data = $this->Appointment->find('first', array('conditions' => array('Appointment.id' => $this->Appointment->id), 'fields' => array('Appointment.appointed_timing', 'Appointment.status',
                        'Appointment.id', 'Appointment.status', 'Appointment.scheduled_date', 'Appointment.reason', 'User.id', 'User.salutation', 'User.first_name', 'User.mobile', 'User.last_name', 'Doctor.id', 'Doctor.salutation', 'User.registration_no', 'User.email', 'Doctor.mobile', 'Doctor.registration_no', 'Doctor.email', 'Doctor.first_name', 'Doctor.last_name', 'Service.title'
                )));


                $number = $appointment_data['User']['mobile'];
                //$number = '7219003017';
                if ($appointment_data['Appointment']['status'] != 3):

                    if ($appointment_data['Appointment']['status'] == 2):
                        $message = "Your Appointment ID: APP-" . $appointment_data['Appointment']['id'] . " is" . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " Please login or check email for more information.";
//                        $message = "Dear " . ucfirst($appointment_data['User']['first_name']) . " your appointment ID: APP-" . $appointment_data['Appointment']['id'] . " has been " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " by doctor " . $salutations[$appointment_data['Doctor']['salutation']] . ". " . ucfirst($appointment_data['Doctor']['first_name']) . " " . ucfirst($appointment_data['Doctor']['last_name']) . " on " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['scheduled_date'])) . " for your service " . $appointment_data['Service']['title'] . ".";

                    else:
                        $message = "Your appointment ID: APP-" . $appointment_data['Appointment']['id'] . " is scheduled at" . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . " on date.Please carry a valid ID and visit 30 minutes in advance.";

//                        $message = "Dear " . ucfirst($appointment_data['User']['first_name']) . " your appointment ID: APP-" . $appointment_data['Appointment']['id'] . " has been " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " by doctor " . $salutations[$appointment_data['Doctor']['salutation']] . ". " . ucfirst($appointment_data['Doctor']['first_name']) . " " . ucfirst($appointment_data['Doctor']['last_name']) . " on " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . " for your service " . $appointment_data['Service']['title'] . ".";

                    endif;
                else:
                    $message = "Your Appointment ID: APP-" . $appointment_data['Appointment']['id'] . " is" . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " Please login or check email for more information.";
//                    $message = "Dear " . ucfirst($appointment_data['Doctor']['first_name']) . " Your Have " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " appointment ID APP-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " scheduled on " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . " for service " . $appointment_data['Service']['title'] . ".";
                endif;
                //debug($message);die;
                $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $curl_scraped_page = curl_exec($ch);
                //debug($curl_scraped_page);die;
                curl_close($ch);

                $number = $appointment_data['Doctor']['mobile'];
                //$number = '7219003017';
                if ($appointment_data['Appointment']['status'] != 3):

                    if ($appointment_data['Appointment']['status'] == 2):
                        $message = "Appoint ID APP-" . $appointment_data['Appointment']['id'] . " date Time is" . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . "on" . date('d-M-Y H:i A', strtotime($appointment_data['Appointment']['scheduled_date'])) . " Please login to approve and check further details ";
//                        $message = "Dear " . ucfirst($appointment_data['Doctor']['first_name']) . " Your Have " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " appointment ID APP-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " on " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['scheduled_date'])) . " for  service " . $appointment_data['Service']['title'] . ".";
                    else:
                        $message = "Appoint ID APP-" . $appointment_data['Appointment']['id'] . " date Time is" . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . "on" . date('d-M-Y H:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . " Please login to approve and check further details ";
//                        $message = "Dear " . ucfirst($appointment_data['Doctor']['first_name']) . " Your Have " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " appointment ID APP-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " on " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . " for  service " . $appointment_data['Service']['title'] . ".";
                    endif;
                else:
                    $message = "Appoint ID APP-" . $appointment_data['Appointment']['id'] . " date Time is" . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . "on" . date('d-M-Y H:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . " Please login to approve and check further details ";
//                    $message = "Dear " . ucfirst($appointment_data['Doctor']['first_name']) . " Your Have " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " appointment ID APP-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " scheduled on " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . " for service " . $appointment_data['Service']['title'] . ".";
                endif;
                $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $curl_scraped_page = curl_exec($ch);
                curl_close($ch);


                $number = '9953333592';
                if ($appointment_data['Appointment']['status'] != 3):

                    if ($appointment_data['Appointment']['status'] == 2):
                        $message = "Dear admin ,The appointment ID: APT-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " has been " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " by doctor ID DOC-" . $appointment_data['Doctor']['registration_no'] . " scheduled on " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['scheduled_date'])) . ".";
                    else:
                        $message = "Dear admin ,The appointment ID: APT-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " has been " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " by doctor ID DOC-" . $appointment_data['Doctor']['registration_no'] . " scheduled on " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . ".";
                    endif;
                else:
                    $message = "Dear admin ,The appointment ID: APT-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " has been " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " by doctor ID DOC-" . $appointment_data['Doctor']['registration_no'] . " scheduled on " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . ".";
                endif;

                $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $curl_scraped_page = curl_exec($ch);
                curl_close($ch);
                //  die;
                $update_by = 3;
                $email = new CakeEmail();
                $email->config('appointment_status_patient');
                $email->to($appointment_data['User']['email']);
                $email->viewVars(compact('salutations', 'appointment_data', 'appointment_status', 'update_by'));
                $email->subject('APT-' . $appointment_data['Appointment']['id'] . "," . $appointment_status[$appointment_data['Appointment']['status']]);
                $email->send();

                //$number = $appointment_data['User']['mobile'];


                $email2 = new CakeEmail();
                $email2->config('appointment_status_doctor');
                $email2->to($appointment_data['Doctor']['email']);
                //$to=$salutations[$this->Auth->user('salutation')].". ".ucfirst($this->Auth->user('first_name'))." ".ucfirst($this->Auth->user('last_name'));
                $email2->viewVars(compact('salutations', 'appointment_data', 'appointment_status', 'update_by'));
                $email2->subject('APT-' . $appointment_data['Appointment']['id'] . "," . $appointment_status[$appointment_data['Appointment']['status']]);
                //debug( $email2->send());die;
                $email2->send();

                /* send mail patient to admin */
                $email = new CakeEmail();
                $email->config('appointment_status_admin');
                $email->to('admin@feish.online');
                $email->viewVars(compact('salutations', 'appointment_data', 'appointment_status', 'update_by'));
                $email->subject('APT-' . $appointment_data['Appointment']['id'] . "," . $appointment_status[$appointment_data['Appointment']['status']]);
                $email->send();
                $this->loadModel('Communication');
                $communication_data = array();
                $communication_data['Communication']['subject'] = 'APT-' . $appointment_data['Appointment']['id'] . "," . $appointment_status[$appointment_data['Appointment']['status']];
                if ($appointment_data['Appointment']['status'] != 3):

                    if ($appointment_data['Appointment']['status'] == 2):
                        $communication_data['Communication']['message'] = "The appointment ID: APT-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " has been " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " by doctor ID DOC-" . $appointment_data['Doctor']['registration_no'] . " scheduled on " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['scheduled_date'])) . ".";
                    else:
                        $communication_data['Communication']['message'] = "The appointment ID: APT-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " has been " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " by doctor ID DOC-" . $appointment_data['Doctor']['registration_no'] . " scheduled on " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . ".";
                    endif;
                else:
                    $communication_data['Communication']['message'] = "The appointment ID: APT-" . $appointment_data['Appointment']['id'] . " of patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . " ID PA-" . $appointment_data['User']['registration_no'] . " has been " . strtolower($appointment_status[$appointment_data['Appointment']['status']]) . " by doctor ID DOC-" . $appointment_data['Doctor']['registration_no'] . " scheduled on " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . ".";
                endif;
                // $communication_data['Communication']['message'] = "The appointment Id APT-".;
                $parent_id = $this->Communication->find('first', array('conditions' => array('Communication.appointment_id' => $this->request->data['Appointment']['id']), 'fields' => array('Communication.id'), 'recursive' => -1));

                $communication_data['Communication']['parent_id'] = $parent_id['Communication']['id'];
                $communication_data['Communication']['user_id'] = 0;
                $communication_data['Communication']['reciever_user_id'] = $appointment_data['User']['id'] . "," . $appointment_data['Doctor']['id'];
                $viewed_users = explode(',', $communication_data['Communication']['reciever_user_id']);
                //debug($viewed_users);
                foreach ($viewed_users as $user) {
                    $user_array[$user] = 0;
                }
                // debug($user_array);die;
                $communication_data['Communication']['viewed_users'] = json_encode($user_array);
                if ($this->Communication->save($communication_data)) {
                    
                }
                $this->Session->setFlash(__('Appointment updated successfully'), 'success');
            } else {
                $this->Session->setFlash(__('Appointment could not be updated. Please try again,'), 'error');
            }
            return $this->redirect(array('action' => 'assistant_index'));
        }

        $services = $this->Appointment->Service->find('list', array('conditions' => array('Service.user_id' => $this->Auth->user('added_by_doctor_id')), 'fields' => array('Service.id', 'Service.id')));
        $this->Appointment->recursive = 0;
        $this->paginate = array(
            //  'conditions' => array('User.user_type' => $user_type),
            'conditions' => array('Appointment.doctor_id' => $this->Auth->user('added_by_doctor_id'), 'OR' => array('Appointment.service_id' => $services, 'User.user_type' => 5)),
            'order' => 'Appointment.id DESC',
            'limit' => 20
        );
        $appointments = $this->Paginator->paginate();
//        debug($appointments);die;

        $this->set(compact('user_types', 'appointments', 'salutations', 'appointment_status'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function get_details() {
        $this->layout = 'blank';
        if ($this->request->is('post')) {
            $fetch_data = $this->Appointment->find('first', array('conditions' => array('Appointment.id' => $this->request->data['id']),
                'fields' => array('Appointment.id', 'Appointment.reason', 'Appointment.status', 'Appointment.scheduled_date', 'Appointment.appointed_timing', 'Service.title', 'User.salutation', 'User.first_name', 'User.last_name', 'Doctor.salutation', 'Doctor.first_name', 'Doctor.last_name')
            ));
            Configure::load('feish');
            $salutations = Configure::read('feish.salutations');
            $status = Configure::read('feish.appointment_status');
            $this->set(compact('fetch_data', 'salutations', 'status'));
        }
    }

    public function get_time_slots() {
        $this->layout = 'blank';
        if ($this->request->is('post')) {
            // debug($this->request->data);
            $weekday = date('w', strtotime($this->request->data['apt_date']));
            $this->loadModel('Service');
            $working_hours = array();
            if (!empty($this->request->data['patient_id']) && !empty($this->request->data['service_id'])) {
                $services = array($this->request->data['service_id'] => $this->request->data['service_id']);
            } elseif (empty($this->request->data['patient_id']) && empty($this->request->data['service_id'])) {
                $services = $this->Service->find('list', array('conditions' => array('Service.user_id' => $this->Auth->user('id'), 'Service.is_active' => 1, 'Service.is_deleted' => 0), 'fields' => array('Service.id', 'Service.id')));
            } elseif (!empty($this->request->data['patient_id']) && empty($this->request->data['service_id'])) {
                $services = $this->Service->find('list', array('conditions' => array('Service.user_id' => $this->Auth->user('id'), 'Service.is_active' => 1, 'Service.is_deleted' => 0), 'fields' => array('Service.id', 'Service.id')));
            }
            // debug($services);
            if (!empty($services)) {
                $this->loadModel('ServicesWorkingTiming');
                $timings = $this->ServicesWorkingTiming->find('all', array('conditions' => array('ServicesWorkingTiming.service_id' => $services, 'ServicesWorkingTiming.day_of_week' => $weekday), 'fields' => array('ServicesWorkingTiming.open_time', 'ServicesWorkingTiming.close_time'), 'recursive' => -1));
                // debug($timings);die;
                if (!empty($timings)) {
                    foreach ($timings as $value) {
                        $timing_slot = $this->appointment_timings(strtotime($value['ServicesWorkingTiming']['open_time']), strtotime($value['ServicesWorkingTiming']['close_time']), $this->Auth->user('consultation_time') * 60);
                        $working_hours = array_merge($working_hours, $timing_slot);
                    }
                }
            }

            $existing_apt = $this->Appointment->find('all', array('conditions' => array('Appointment.service_id' => $services, 'Appointment.status NOT' => 3, 'OR' => array('DATE(Appointment.appointed_timing)' => date('Y-m-d', strtotime($this->request->data['apt_date'])), 'DATE(Appointment.scheduled_date)' => date('Y-m-d', strtotime($this->request->data['apt_date'])))), 'fields' => array('Appointment.appointed_timing', 'Appointment.scheduled_date', 'Appointment.status')));
            $list_ex_apt = array();
            foreach ($existing_apt as $ex_apt) {
                if ($ex_apt['Appointment']['status'] == 2) {
                    $list_ex_apt[date('H:i:s', strtotime($ex_apt['Appointment']['scheduled_date']))] = date('h:i A', strtotime($ex_apt['Appointment']['scheduled_date']));
                } else {
                    $list_ex_apt[date('H:i:s', strtotime($ex_apt['Appointment']['appointed_timing']))] = date('h:i A', strtotime($ex_apt['Appointment']['appointed_timing']));
                }
            }
            $working_hours = array_diff($working_hours, $list_ex_apt);
            ksort($working_hours);

            $this->set(compact('working_hours'));
        }
    }

    public function get_time_slots_update() {
        $this->layout = 'blank';
        if ($this->request->is('post')) {
//             
            $weekday = date('w', strtotime($this->request->data['scheduled_date']));
            $appointment_data = $this->Appointment->find('first', array('conditions' => array('Appointment.id' => $this->request->data['apt_id']),
                'fields' => array(
                    'Appointment.id', 'Appointment.service_id', 'Appointment.doctor_id'
            )));
//            debug($appointment_data);die;
            $this->loadModel('Service');
            $working_hours = array();
            if (!empty($appointment_data['Appointment']['service_id'])) {
                $services = array($appointment_data['Appointment']['service_id'] => $appointment_data['Appointment']['service_id']);
            } elseif (empty($appointment_data['Appointment']['service_id'])) {
                $services = $this->Service->find('list', array('conditions' => array('Service.user_id' => $appointment_data['Appointment']['doctor_id'], 'Service.is_active' => 1, 'Service.is_deleted' => 0), 'fields' => array('Service.id', 'Service.id')));
            } elseif (empty($appointment_data['Appointment']['service_id'])) {
                $services = $this->Service->find('list', array('conditions' => array('Service.user_id' => $appointment_data['Appointment']['doctor_id'], 'Service.is_active' => 1, 'Service.is_deleted' => 0), 'fields' => array('Service.id', 'Service.id')));
            }
            
            
            if (!empty($services)) {
                $this->loadModel('ServicesWorkingTiming');
                $timings = $this->ServicesWorkingTiming->find('all', array('conditions' => array('ServicesWorkingTiming.service_id' => $services, 'ServicesWorkingTiming.day_of_week' => $weekday), 'fields' => array('ServicesWorkingTiming.open_time', 'ServicesWorkingTiming.close_time'), 'recursive' => -1));
                 
                if (!empty($timings)) {
                    foreach ($timings as $value) {
                        $timing_slot = $this->appointment_timings(strtotime($value['ServicesWorkingTiming']['open_time']), strtotime($value['ServicesWorkingTiming']['close_time']), $this->Auth->user('consultation_time') * 60);
                        $working_hours = array_merge($working_hours, $timing_slot);
                    }
                }
            }


            $existing_apt1 = $this->Appointment->find('all', array('conditions' => array('Appointment.service_id' => NULL, 'Appointment.status NOT' => 3, 'OR' => array('DATE(Appointment.appointed_timing)' => date('Y-m-d', strtotime($this->request->data['scheduled_date'])), 'DATE(Appointment.scheduled_date)' => date('Y-m-d', strtotime($this->request->data['scheduled_date'])))), 'fields' => array('Appointment.appointed_timing', 'Appointment.scheduled_date', 'Appointment.status')));
            $existing_apt2 = $this->Appointment->find('all', array('conditions' => array('Appointment.service_id' => $services, 'Appointment.status NOT' => 3, 'OR' => array('DATE(Appointment.appointed_timing)' => date('Y-m-d', strtotime($this->request->data['scheduled_date'])), 'DATE(Appointment.scheduled_date)' => date('Y-m-d', strtotime($this->request->data['scheduled_date'])))), 'fields' => array('Appointment.appointed_timing', 'Appointment.scheduled_date', 'Appointment.status')));
            $existing_apt = array_merge($existing_apt1,$existing_apt2);

            $list_ex_apt = array();
            foreach ($existing_apt as $ex_apt) {
                if ($ex_apt['Appointment']['status'] == 2) {
                    $list_ex_apt[date('H:i:s', strtotime($ex_apt['Appointment']['scheduled_date']))] = date('h:i A', strtotime($ex_apt['Appointment']['scheduled_date']));
                } else {
                    $list_ex_apt[date('H:i:s', strtotime($ex_apt['Appointment']['appointed_timing']))] = date('h:i A', strtotime($ex_apt['Appointment']['appointed_timing']));
                }
            }
            $working_hours = array_diff($working_hours, $list_ex_apt);
            ksort($working_hours);

            $this->set(compact('working_hours'));
        }
    }

    public function get_time_slots_ass_dashboard() {
        $this->layout = 'blank';
        if ($this->request->is('post')) {
            // debug($this->request->data);
            $weekday = date('w', strtotime($this->request->data['apt_date']));
            $this->loadModel('Service');
            $working_hours = array();
            if (!empty($this->request->data['patient_id']) && !empty($this->request->data['service_id'])) {
                $services = array($this->request->data['service_id'] => $this->request->data['service_id']);
            } elseif (empty($this->request->data['patient_id']) && empty($this->request->data['service_id'])) {
                $services = $this->Service->find('list', array('conditions' => array('Service.user_id' => $this->Auth->user('added_by_doctor_id'), 'Service.is_active' => 1, 'Service.is_deleted' => 0), 'fields' => array('Service.id', 'Service.id')));
            } elseif (!empty($this->request->data['patient_id']) && empty($this->request->data['service_id'])) {
                $services = $this->Service->find('list', array('conditions' => array('Service.user_id' => $this->Auth->user('added_by_doctor_id'), 'Service.is_active' => 1, 'Service.is_deleted' => 0), 'fields' => array('Service.id', 'Service.id')));
            }
            //debug($services);
            if (!empty($services)) {
                $this->loadModel('ServicesWorkingTiming');
                $timings = $this->ServicesWorkingTiming->find('all', array('conditions' => array('ServicesWorkingTiming.service_id' => $services, 'ServicesWorkingTiming.day_of_week' => $weekday), 'fields' => array('ServicesWorkingTiming.open_time', 'ServicesWorkingTiming.close_time'), 'recursive' => -1));
                // debug($timings);die;
                $this->loadModel('User');
                $doctor = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('added_by_doctor_id')), 'fields' => array('User.consultation_time')));
                //debug($doctor['User']['consultation_time']);die;
                if (!empty($timings)) {
                    foreach ($timings as $value) {
                        $timing_slot = $this->appointment_timings(strtotime($value['ServicesWorkingTiming']['open_time']), strtotime($value['ServicesWorkingTiming']['close_time']), $doctor['User']['consultation_time'] * 60);
                        $working_hours = array_merge($working_hours, $timing_slot);
                    }
                }
            }
            // debug($working_hours);

            $existing_apt = $this->Appointment->find('all', array('conditions' => array('Appointment.service_id' => $services, 'Appointment.status NOT' => 3, 'OR' => array('DATE(Appointment.appointed_timing)' => date('Y-m-d', strtotime($this->request->data['apt_date'])), 'DATE(Appointment.scheduled_date)' => date('Y-m-d', strtotime($this->request->data['apt_date'])))), 'fields' => array('Appointment.appointed_timing', 'Appointment.scheduled_date', 'Appointment.status')));
            $list_ex_apt = array();
            foreach ($existing_apt as $ex_apt) {
                if ($ex_apt['Appointment']['status'] == 2) {
                    $list_ex_apt[date('H:i:s', strtotime($ex_apt['Appointment']['scheduled_date']))] = date('h:i A', strtotime($ex_apt['Appointment']['scheduled_date']));
                } else {
                    $list_ex_apt[date('H:i:s', strtotime($ex_apt['Appointment']['appointed_timing']))] = date('h:i A', strtotime($ex_apt['Appointment']['appointed_timing']));
                }
            }
            //debug($list_ex_apt);die;
            $working_hours = array_diff($working_hours, $list_ex_apt);
            ksort($working_hours);
            $this->set(compact('working_hours'));
            $this->render('get_time_slots');
        }
    }

    public function get_time_slots_dtl() {
        $this->layout = 'blank';
        if ($this->request->is('post')) {
            //debug($this->request->data);die;
            $weekday = date('w', strtotime($this->request->data['apt_date']));
            $this->loadModel('PatientPackageLog');
            $service = $this->PatientPackageLog->find('first', array('conditions' => array('PatientPackageLog.service_id' => $this->request->data['service_id'], 'PatientPackageLog.end_date >=' => $this->request->data['apt_date']), 'fields' => array('PatientPackageLog.service_id', 'Service.user_id')));

            $working_hours = array();


            if (!empty($service)) {
                $this->loadModel('ServicesWorkingTiming');
                $timings = $this->ServicesWorkingTiming->find('all', array('conditions' => array('ServicesWorkingTiming.service_id' => $service['PatientPackageLog']['service_id'], 'ServicesWorkingTiming.day_of_week' => $weekday), 'fields' => array('ServicesWorkingTiming.open_time', 'ServicesWorkingTiming.close_time'), 'recursive' => -1));
                // debug($timings);die;
                $this->loadModel('User');
                $time_interval = $this->User->find('first', array('conditions' => array('User.id' => $service['Service']['user_id']), 'fields' => array('User.consultation_time')));

                //debug($doctor['User']['consultation_time']);die;
                if (!empty($timings)) {
                    foreach ($timings as $value) {
                        $timing_slot = $this->appointment_timings(strtotime($value['ServicesWorkingTiming']['open_time']), strtotime($value['ServicesWorkingTiming']['close_time']), $time_interval['User']['consultation_time'] * 60);
                        $working_hours = array_merge($working_hours, $timing_slot);
                    }
                }
            }
            // debug($working_hours);

            $existing_apt = $this->Appointment->find('all', array('conditions' => array('Appointment.service_id' => $service['PatientPackageLog']['service_id'], 'Appointment.status NOT' => 3, 'OR' => array('DATE(Appointment.appointed_timing)' => date('Y-m-d', strtotime($this->request->data['apt_date'])), 'DATE(Appointment.scheduled_date)' => date('Y-m-d', strtotime($this->request->data['apt_date'])))), 'fields' => array('Appointment.appointed_timing', 'Appointment.scheduled_date', 'Appointment.status')));
            $list_ex_apt = array();
            foreach ($existing_apt as $ex_apt) {
                if ($ex_apt['Appointment']['status'] == 2) {
                    $list_ex_apt[date('H:i:s', strtotime($ex_apt['Appointment']['scheduled_date']))] = date('h:i A', strtotime($ex_apt['Appointment']['scheduled_date']));
                } else {
                    $list_ex_apt[date('H:i:s', strtotime($ex_apt['Appointment']['appointed_timing']))] = date('h:i A', strtotime($ex_apt['Appointment']['appointed_timing']));
                }
            }
            //debug($list_ex_apt);die;
            $working_hours = array_diff($working_hours, $list_ex_apt);
            ksort($working_hours);

            //debug($working_hours);die;
            $this->set(compact('working_hours'));
            // $this->render('get_time_slots');
            //$this->render('get_time_slots');
        }
    }

    private function appointment_timings($start, $end, $interval, $format = '') {
        $times = array();
        if (empty($format)) {
            $format = 'h:i A';
        }
        $key_frmt = 'H:i:s';
        foreach (range($start, $end, $interval) as $increment) {
            $times[date($key_frmt, $increment)] = date($format, $increment);
        }
        return $times;
    }

    public function book_appointment() {
        $this->loadModel('Appointment');
        $this->loadModel('PatientPackageLog');
        $this->loadModel('User');
        Configure::load('feish');
        $appointment_status = Configure::read('feish.appointment_status');
        $salutations = Configure::read('feish.salutations');
        if ($this->request->is('post')) {


            if (!empty($this->request->data['Appointment']['time_slot'])) {
                $apt_data = array();
                $apt_data['Appointment']['appointed_timing'] = date('Y-m-d', strtotime($this->request->data['Appointment']['appointment_date'])) . " " . $this->request->data['Appointment']['time_slot'];

                if (isset($this->request->data['Appointment']['user_id']) && empty($this->request->data['Appointment']['user_id'])) {
                    $user_data = array();

                    $user_data['User']['salutation'] = $this->request->data['Appointment']['salutation'];
                    $user_data['User']['mobile'] = $this->request->data['Appointment']['mobile_no'];
                    $user_data['User']['first_name'] = $this->request->data['Appointment']['first_name'];
                    $user_data['User']['last_name'] = $this->request->data['Appointment']['last_name'];
                    $user_data['User']['gender'] = $this->request->data['Appointment']['gender'];
                    $user_data['User']['email'] = $this->request->data['Appointment']['email'];
                    $user_data['User']['ip_address'] = $this->request->clientIp();
                    $user_data['User']['is_verified'] = 0;
                    $user_data['User']['user_type'] = 5;
                    $user_data['User']['password'] = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 8)), 0, 7);

                    $this->loadModel('User');
                    $this->User->create();
                    if ($this->User->save($user_data)) {
                        $apt_data['Appointment']['user_id'] = $this->User->id;
                        $registration_no = substr(str_shuffle(str_repeat('0123456789', 5)), 0, 7) . $this->User->id;
                        $this->User->updateAll(array('User.registration_no' => "'" . $registration_no . "'"), array('User.id' => $this->User->id));
                    }
                } else {
                    $apt_data['Appointment']['user_id'] = $this->request->data['Appointment']['user_id'];
                    if (isset($this->request->data['Appointment']['service_id']) && !empty($this->request->data['Appointment']['service_id'])) {
                        $apt_data['Appointment']['service_id'] = $this->request->data['Appointment']['service_id'];
                    }
                }

                if ($this->request->data['Appointment']['user_id'] != "") {
                    $apt_data['Appointment']['user_id'] = $this->request->data['Appointment']['user_id'];
                } else {
                    $apt_data['Appointment']['user_id'] = $this->User->id;
                }


                $apt_data['Appointment']['status'] = 0;
                $apt_data['Appointment']['status_updated_by'] = $this->Auth->user('id');
                $apt_data['Appointment']['doctor_id'] = $this->Auth->user('id');
                $apt_data['Appointment']['patient_package_log_id'] = $this->request->data['Appointment']['plan_id'];

                /* start::added by yogesh */
                $plan_id = $this->request->data['Appointment']['plan_id'];
                if ($plan_id != 0 && $this->request->data['Appointment']['service_id'] != 0) {
                    $this->loadModel('PatientPackageLog');
                    $service = $this->PatientPackageLog->find('first', array('conditions' => array('PatientPackageLog.remaining_visits >' => 0, 'PatientPackageLog.user_id' => $this->request->data['Appointment']['user_id'], 'PatientPackageLog.id' => $plan_id, 'PatientPackageLog.end_date >=' => date('Y-m-d', strtotime($this->request->data['Appointment']['appointment_date']))), 'fields' => array('Service.id', 'Service.user_id')));

                    if (empty($service)) {
                        $this->Session->setFlash(__('You dont have valid plan to book this appointment'), 'error');
                        return $this->redirect(array('controller' => 'users', 'action' => 'doctors_dashboard'));
                    }
                }


                /* end */
                if ($this->Appointment->save($apt_data)) {

                    $appointment_data = $this->Appointment->find('first', array('conditions' => array('Appointment.id' => $this->Appointment->id), 'fields' => array('Appointment.appointed_timing', 'Appointment.status',
                            'Appointment.id', 'Appointment.status', 'Appointment.scheduled_date', 'Appointment.reason', 'User.id', 'User.salutation', 'User.first_name', 'User.mobile', 'User.last_name', 'Doctor.id', 'Doctor.salutation', 'User.registration_no', 'User.email', 'Doctor.mobile', 'Doctor.registration_no', 'Doctor.email', 'Doctor.first_name', 'Doctor.last_name', 'Service.title'
                    )));

                    $this->loadModel('PatientPackageLog');
                    $package = $this->PatientPackageLog->find('first', array('conditions' => array('PatientPackageLog.id' => $this->request->data['Appointment']['plan_id'])));
                    if (!empty($package)) {
                        $this->PatientPackageLog->updateAll(
                                array('PatientPackageLog.remaining_visits' => $package['PatientPackageLog']['remaining_visits'] - 1,
                            'PatientPackageLog.used_visits' => $package['PatientPackageLog']['used_visits'] + 1), array('PatientPackageLog.id' => $package['PatientPackageLog']['id']));
                    }


                    $this->loadModel('Communication');
                    $communication_data = array();
                    $communication_data['Communication']['subject'] = 'ID:APT-' . $appointment_data['Appointment']['id'] . ", New Booking";
                    $communication_data['Communication']['message'] = 'Booked new appointment of doctor' . $salutations[$this->Auth->user('salutation')] . ". " . $this->Auth->user('first_name') . " " . $this->Auth->user('last_name') . ", for user " . $salutations[$appointment_data['User']['salutation']] . " " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . "and doctor service:" . $appointment_data['Service']['title'];

                    $communication_data['Communication']['parent_id'] = 0;
                    $communication_data['Communication']['user_id'] = 0;
                    $communication_data['Communication']['reciever_user_id'] = $appointment_data['Doctor']['id'] . "," . $appointment_data['User']['id'];
                    $viewed_users = explode(',', $communication_data['Communication']['reciever_user_id']);
                    //debug($viewed_users);
                    foreach ($viewed_users as $user) {
                        $user_array[$user] = 0;
                    }
                    // debug($user_array);die;
                    $communication_data['Communication']['viewed_users'] = json_encode($user_array);
                    if (isset($this->request->data['Appointment']['service_id']) && !empty($this->request->data['Appointment']['service_id'])) {
                        $communication_data['Communication']['service_id'] = $this->request->data['Appointment']['service_id'];
                    }
                    $communication_data['Communication']['appointment_id'] = $appointment_data['Appointment']['id'];
                    $this->Communication->save($communication_data);

                    $email = new CakeEmail();
                    $email->config('doctor_book_appointment');
                    $email->to($appointment_data['User']['email']);
                    $email->viewVars(compact('salutations', 'appointment_data', 'appointment_status'));
                    $email->subject('APT-' . $appointment_data['Appointment']['id'] . ", New Booking");
                    $email->send();

                    $email1 = new CakeEmail();
                    $email1->config('doctor_book_appointment_doctor');
                    $email1->to($appointment_data['Doctor']['email']);
                    $email1->viewVars(compact('salutations', 'appointment_data', 'appointment_status'));
                    $email1->subject('APT-' . $appointment_data['Appointment']['id'] . ", New Booking");
                    $email1->send();

                    $email2 = new CakeEmail();
                    $email2->config('doctor_book_appointment_doctor_patient');
                    $email2->to('admin@feish.online');
                    $email2->viewVars(compact('salutations', 'appointment_data', 'appointment_status'));
                    $email2->subject('APT-' . $appointment_data['Appointment']['id'] . ", New Booking");
                    $email2->send();


                    $number = $appointment_data['User']['mobile'];
                    //$number = '7219003017';

                    $message = "Dear " . ucfirst($appointment_data['User']['first_name']) . " your appointment ID: APT-" . $appointment_data['Appointment']['id'] . " has been booked successfully. Alloted doctor for you is " . $salutations[$appointment_data['Doctor']['salutation']] . ". " . ucfirst($appointment_data['Doctor']['first_name']) . " " . ucfirst($appointment_data['Doctor']['last_name']) . ", appointment time is " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . " for your service " . $appointment_data['Service']['title'] . ".";

                    $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $curl_scraped_page = curl_exec($ch);
                    curl_close($ch);

                    $number = $appointment_data['Doctor']['mobile'];
                    //$number = '7219003017';
//                    debug($number);die;
                    $message = "Dear " . ucfirst($appointment_data['Doctor']['first_name']) . ", New appointment ID:" . $appointment_data['Appointment']['id'] . " has been booked for service " . $appointment_data['Service']['title'] . " by patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . "(ID: PA-" . $appointment_data['User']['registration_no'] . ").";

                    $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                    $ch = curl_init($url);

                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $curl_scraped_page = curl_exec($ch);
                    curl_close($ch);


                    $number = '9953333592';
                    $message = "Dear Admin, New appointment ID:" . $appointment_data['Appointment']['id'] . " has been booked for service " . $appointment_data['Service']['title'] . " by doctor " . $salutations[$appointment_data['Doctor']['salutation']] . ". " . ucfirst($appointment_data['Doctor']['first_name']) . " for patient " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . "(ID: PA-" . $appointment_data['User']['registration_no'] . ").";
//                    debug($message);die;
                    $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                    $ch = curl_init($url);

                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $curl_scraped_page = curl_exec($ch);
                    curl_close($ch);

                    $this->Session->setFlash(__('Appointment booked successfully'), 'success');
                } else {
                    $this->Session->setFlash(__('Appointment could not be saved, Please try Again'), 'error');
                }
                if (isset($this->request->data['Appointment']['redirect']) && !empty($this->request->data['Appointment']['redirect'])) {
                    return $this->redirect(array('controller' => 'users', 'action' => $this->request->data['Appointment']['redirect']));
                }
            } else {
                $this->Session->setFlash(__('Time slot not selected, Please select time slot'), 'error');
            }
            return $this->redirect(array('controller' => 'users', 'action' => 'doctors_dashboard'));
        }
    }

    public function book_appointment_by_ass() {
        $this->loadModel('PatientPackageLog');
        $this->loadModel('Appointment');
        Configure::load('feish');
        $appointment_status = Configure::read('feish.appointment_status');
        $salutations = Configure::read('feish.salutations');

        if ($this->request->is('post')) {

            if (!empty($this->request->data['Appointment']['time_slot'])) {
                $apt_data = array();
                $apt_data['Appointment']['appointed_timing'] = date('Y-m-d', strtotime($this->request->data['Appointment']['appointment_date'])) . " " . $this->request->data['Appointment']['time_slot'];

                if (isset($this->request->data['Appointment']['user_id']) && empty($this->request->data['Appointment']['user_id'])) {
                    $user_data = array();
                    $user_data['User']['salutation'] = $this->request->data['Appointment']['salutation'];
                    $user_data['User']['mobile'] = $this->request->data['Appointment']['mobile_no'];
                    $user_data['User']['first_name'] = $this->request->data['Appointment']['first_name'];
                    $user_data['User']['last_name'] = $this->request->data['Appointment']['last_name'];
                    $user_data['User']['gender'] = $this->request->data['Appointment']['gender'];
                    $user_data['User']['email'] = $this->request->data['Appointment']['email'];
                    $user_data['User']['ip_address'] = $this->request->clientIp();
                    $user_data['User']['is_verified'] = 0;
                    $user_data['User']['user_type'] = 5;
                    $user_data['User']['password'] = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 8)), 0, 7);
                    $this->loadModel('User');

                    $this->User->create();
                    if ($this->User->save($user_data)) {
                        $apt_data['Appointment']['user_id'] = $this->User->id;
                        $registration_no = substr(str_shuffle(str_repeat('0123456789', 5)), 0, 7) . $this->User->id;
                        $this->User->updateAll(array('User.registration_no' => "'" . $registration_no . "'"), array('User.id' => $this->User->id));
                    }
                } else {
                    $apt_data['Appointment']['user_id'] = $this->request->data['Appointment']['user_id'];
                    if (isset($this->request->data['Appointment']['service_id']) && !empty($this->request->data['Appointment']['service_id'])) {
                        $apt_data['Appointment']['service_id'] = $this->request->data['Appointment']['service_id'];
                    }
                }

                if ($this->request->data['Appointment']['user_id'] != "") {
                    $apt_data['Appointment']['user_id'] = $this->request->data['Appointment']['user_id'];
                } else {
                    $apt_data['Appointment']['user_id'] = $this->User->id;
                }

                $apt_data['Appointment']['status'] = 0;
                $apt_data['Appointment']['status_updated_by'] = $this->Auth->user('id');
                $apt_data['Appointment']['doctor_id'] = $this->Auth->user('added_by_doctor_id');
                $apt_data['Appointment']['patient_package_log_id'] = $this->request->data['Appointment']['plan_id'];

                /* start::added by yogesh */
                $plan_id = $this->request->data['Appointment']['plan_id'];
                if ($plan_id != 0 && $this->request->data['Appointment']['service_id'] != 0) {
                    $this->loadModel('PatientPackageLog');
                    $service = $this->PatientPackageLog->find('first', array('conditions' => array('PatientPackageLog.remaining_visits >' => 0, 'PatientPackageLog.user_id' => $this->request->data['Appointment']['user_id'], 'PatientPackageLog.id' => $plan_id, 'PatientPackageLog.end_date >=' => date('Y-m-d', strtotime($this->request->data['Appointment']['appointment_date']))), 'fields' => array('Service.id', 'Service.user_id')));

                    if (empty($service)) {
                        $this->Session->setFlash(__('You dont have valid plan to book this appointment'), 'error');
                        return $this->redirect(array('controller' => 'users', 'action' => 'assistant_dashboard'));
                    }
                }

                if ($this->Appointment->save($apt_data)) {

                    $appointment_data = $this->Appointment->find('first', array('conditions' => array('Appointment.id' => $this->Appointment->id), 'fields' => array('Appointment.appointed_timing', 'Appointment.status',
                            'Appointment.id', 'Appointment.status', 'Appointment.scheduled_date', 'Appointment.reason', 'User.id', 'User.salutation', 'User.first_name', 'User.mobile', 'User.last_name', 'Doctor.id', 'Doctor.salutation', 'User.registration_no', 'User.email', 'Doctor.mobile', 'Doctor.registration_no', 'Doctor.email', 'Doctor.first_name', 'Doctor.last_name', 'Service.title'
                    )));

                    $this->loadModel('PatientPackageLog');
                    $package = $this->PatientPackageLog->find('first', array('conditions' => array('PatientPackageLog.id' => $this->request->data['Appointment']['plan_id'])));
                    if (!empty($package)) {
                        $this->PatientPackageLog->updateAll(
                                array('PatientPackageLog.remaining_visits' => $package['PatientPackageLog']['remaining_visits'] - 1,
                            'PatientPackageLog.used_visits' => $package['PatientPackageLog']['used_visits'] + 1), array('PatientPackageLog.id' => $package['PatientPackageLog']['id']));
                    }

                    $this->loadModel('Communication');
                    $communication_data = array();
                    $communication_data['Communication']['subject'] = 'APT-' . $appointment_data['Appointment']['id'] . ', New Booking';
                    $communication_data['Communication']['message'] = 'Assistant Book new appointment of doctor' . $salutations[$appointment_data['Doctor']['salutation']] . ". " . $appointment_data['Doctor']['first_name'] . " " . $appointment_data['Doctor']['last_name'] . ", for user " . $salutations[$appointment_data['User']['salutation']] . " " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . "and doctor service:" . $appointment_data['Service']['title'];

                    $communication_data['Communication']['parent_id'] = 0;
                    $communication_data['Communication']['user_id'] = 0;
                    $communication_data['Communication']['reciever_user_id'] = $appointment_data['Doctor']['id'] . "," . $appointment_data['User']['id'];
                    $viewed_users = explode(',', $communication_data['Communication']['reciever_user_id']);
                    //debug($viewed_users);
                    foreach ($viewed_users as $user) {
                        $user_array[$user] = 0;
                    }
                    // debug($user_array);die;
                    $communication_data['Communication']['viewed_users'] = json_encode($user_array);
                    if (isset($this->request->data['Appointment']['service_id']) && !empty($this->request->data['Appointment']['service_id'])) {
                        $communication_data['Communication']['service_id'] = $this->request->data['Appointment']['service_id'];
                    }
                    $communication_data['Communication']['appointment_id'] = $appointment_data['Appointment']['id'];
                    $this->Communication->save($communication_data);

                    $email = new CakeEmail();
                    $email->config('assistant_book_appointment_patient');
                    $email->to($appointment_data['User']['email']);
                    $email->viewVars(compact('salutations', 'appointment_data', 'appointment_status'));
                    $email->subject('APT-' . $appointment_data['Appointment']['id'] . ", New Booking");
                    $email->send();

                    $email1 = new CakeEmail();
                    $email1->config('assistant_book_appointment_doctor');
                    $email1->to($appointment_data['Doctor']['email']);
                    $email1->viewVars(compact('salutations', 'appointment_data', 'appointment_status'));
                    $email1->subject('APT-' . $appointment_data['Appointment']['id'] . ", New Booking");
                    $email1->send();

                    $email2 = new CakeEmail();
                    $email2->config('assistant_book_appointment_doctor_patient');
                    $email2->to('admin@feish.online');
                    $email2->viewVars(compact('salutations', 'appointment_data', 'appointment_status'));
                    $email2->subject('APT-' . $appointment_data['Appointment']['id'] . ", New Booking");
                    $email2->send();

                    $number = $appointment_data['User']['mobile'];
                    //$number = '7219003017';
                    $message = "Dear " . ucfirst($appointment_data['User']['first_name']) . " your appointment ID: APT-" . $appointment_data['Appointment']['id'] . " has been booked successfully. Alloted doctor for you is " . $salutations[$appointment_data['Doctor']['salutation']] . ". " . ucfirst($appointment_data['Doctor']['first_name']) . " " . ucfirst($appointment_data['Doctor']['last_name']) . ", appointment time is " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . " for your service " . $appointment_data['Service']['title'] . ".";
//                    debug($message);die;
                    $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $curl_scraped_page = curl_exec($ch);
                    curl_close($ch);

                    $number = $appointment_data['Doctor']['mobile'];
                    //$number = '7219003017';
                    $message = "Dear " . ucfirst($appointment_data['Doctor']['first_name']) . ", New appointment ID:" . $appointment_data['Appointment']['id'] . " has been booked for service " . $appointment_data['Service']['title'] . " by patient " . $salutations[$appointment_data['User']['salutation']] . ". " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . "(ID: PA-" . $appointment_data['User']['registration_no'] . ").";
//                    debug($message);die;
                    $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                    $ch = curl_init($url);

                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $curl_scraped_page = curl_exec($ch);
                    curl_close($ch);


                    $number = '9953333592';
                    $message = "Dear Admin, New appointment ID:" . $appointment_data['Appointment']['id'] . " has been booked for service " . $appointment_data['Service']['title'] . " by doctor assistant " . $salutations[$this->Auth->user('salutation')] . ". " . ucfirst($this->Auth->user('first_name')) . " for patient " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']) . "(ID: PA-" . $appointment_data['User']['registration_no'] . "). and allotted doctor is " . $salutations[$appointment_data['Doctor']['salutation']] . " " . ucfirst($appointment_data['Doctor']['first_name']) . " " . ucfirst($appointment_data['Doctor']['last_name']);
//                    debug($message);die;
                    $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                    $ch = curl_init($url);

                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $curl_scraped_page = curl_exec($ch);
                    curl_close($ch);


                    $this->Session->setFlash(__('Appointment booked successfully'), 'success');
                } else {
                    $this->Session->setFlash(__('Appointment could not be saved, Please try Again'), 'error');
                }
            } else {
                $this->Session->setFlash(__('Time slot not selected, Please select time slot'), 'error');
            }
            return $this->redirect(array('controller' => 'users', 'action' => 'assistant_dashboard'));
        }
    }

    public function book_appointment_by_patient() {

        $this->loadModel('User');
        $this->loadModel('Service');
        $this->loadModel('Appointment');
        $this->loadModel('PatientPackageLog');
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');

        if ($this->request->is('post')) {
            //debug($this->request->data);

            if (empty($this->request->data['Appointment']['time_slot'])) {
                $this->Session->setFlash(__('Appointment time should not be empty.'), 'error');
                return $this->redirect(array('controller' => 'services', 'action' => 'service_details', $this->request->data['Appointment']['service_id']));
            }
            if (empty($this->request->data['Appointment']['plan_id'])) {
                $this->Session->setFlash(__('Please select Plan.'), 'error');
                return $this->redirect(array('controller' => 'services', 'action' => 'service_details', $this->request->data['Appointment']['service_id']));
            }

            $this->loadModel('PatientPackageLog');
            $service = $this->PatientPackageLog->find('first', array('conditions' => array('PatientPackageLog.remaining_visits >' => 0, 'PatientPackageLog.user_id' => $this->Auth->user('id'), 'PatientPackageLog.id' => $this->request->data['Appointment']['plan_id'], 'PatientPackageLog.end_date >=' => date('Y-m-d', strtotime($this->request->data['Appointment']['appointment_date']))), 'fields' => array('Service.id', 'Service.user_id')));
            if (empty($service)) {
                $this->Session->setFlash(__('You dont have valid plan to book this appointment'), 'error');
                return $this->redirect(array('controller' => 'services', 'action' => 'service_details', $this->request->data['Appointment']['service_id']));
            }

            $apt_data = array();
            $apt_data['Appointment']['user_id'] = $this->Auth->user('id');
            $apt_data['Appointment']['appointed_timing'] = date('Y-m-d', strtotime($this->request->data['Appointment']['appointment_date'])) . " " . $this->request->data['Appointment']['time_slot'];
//            $apt_data['Appointment']['actual_date'] = date('Y-m-d', strtotime($this->request->data['Appointment']['appointment_date'])) . " " . $this->request->data['Appointment']['time_slot'];
            $apt_data['Appointment']['patient_package_log_id'] = $this->request->data['Appointment']['plan_id'];
            $apt_data['Appointment']['service_id'] = $this->request->data['Appointment']['service_id'];
            $apt_data['Appointment']['doctor_id'] = $service['Service']['user_id'];
            $apt_data['Appointment']['status'] = 0;
            $apt_data['Appointment']['status_updated_by'] = $this->Auth->user('id');
            //$apt_data['Appointment']['plan_id'] = $this->request->data['Appointment']['plan_id'];
            $this->Appointment->create();
            if ($this->Appointment->save($apt_data)) {
                $appointment_data = $this->Appointment->find('first', array('conditions' => array('Appointment.id' => $this->Appointment->id), 'fields' => array('Appointment.appointed_timing', 'Appointment.status',
                        'Appointment.id', 'Appointment.service_id', 'Appointment.status', 'Appointment.scheduled_date', 'Appointment.reason', 'User.id', 'User.salutation', 'User.first_name', 'User.mobile', 'User.last_name', 'Doctor.id', 'Doctor.salutation', 'User.registration_no', 'User.email', 'Doctor.mobile', 'Doctor.registration_no', 'Doctor.email', 'Doctor.first_name', 'Doctor.last_name', 'Service.title'
                )));

                $this->loadModel('PatientPackageLog');
                $package = $this->PatientPackageLog->find('first', array('conditions' => array('PatientPackageLog.id' => $this->request->data['Appointment']['plan_id'])));
                if (!empty($package)) {
                    $this->PatientPackageLog->updateAll(
                            array('PatientPackageLog.remaining_visits' => $package['PatientPackageLog']['remaining_visits'] - 1,
                        'PatientPackageLog.used_visits' => $package['PatientPackageLog']['used_visits'] + 1), array('PatientPackageLog.id' => $package['PatientPackageLog']['id']));
                }

                $this->loadModel('Communication');
                $communication_data = array();
                $communication_data['Communication']['subject'] = 'APT-' . $appointment_data['Appointment']['id'] . ", New Booking";
                $communication_data['Communication']['message'] = 'Book New Appointment ' . $salutations[$this->Auth->user('salutation')] . ". " . $this->Auth->user('first_name') . " " . $this->Auth->user('last_name') . ", booked appointment doctor " . $salutations[$appointment_data['Doctor']['salutation']] . " " . ucfirst($appointment_data['Doctor']['first_name']) . " " . ucfirst($appointment_data['Doctor']['last_name']) . " service:" . $appointment_data['Service']['title'];

                $communication_data['Communication']['parent_id'] = 0;
                $communication_data['Communication']['user_id'] = 0;
                $communication_data['Communication']['reciever_user_id'] = $appointment_data['Doctor']['id'] . "," . $appointment_data['User']['id'];
                $viewed_users = explode(',', $communication_data['Communication']['reciever_user_id']);
                //debug($viewed_users);
                foreach ($viewed_users as $user) {
                    $user_array[$user] = 0;
                }
                // debug($user_array);die;
                $communication_data['Communication']['viewed_users'] = json_encode($user_array);
                $communication_data['Communication']['service_id'] = $appointment_data['Appointment']['service_id'];
                $communication_data['Communication']['appointment_id'] = $appointment_data['Appointment']['id'];
                if ($this->Communication->save($communication_data)) {
                    
                } else {
                    debug($this->Communication->validationErrors);
                    die;
                }
                $consultaion_link = Router::url('/', true) . 'appointments/view_all';
                $email = new CakeEmail();
                $email->config('book_appointment');
                $email->to($appointment_data['Doctor']['email']);
                $email->viewVars(compact('appointment_data', 'salutations'));
                $email->subject('APT-' . $appointment_data['Appointment']['id'] . ", New Booking");
                $email->send();

                $email2 = new CakeEmail();
                $email2->config('patient_book_appointment');
                $email2->to($this->Auth->user('email'));
                $email2->viewVars(compact('appointment_data', 'salutations', 'consultaion_link'));
                $email2->subject('APT-' . $appointment_data['Appointment']['id'] . ", New Booking");
                $email2->send();

                /* send mail patient to admin */
                $email1 = new CakeEmail();
                $email1->config('book_appointment');
                $email1->to('admin@feish.online');
                $email1->viewVars(compact('appointment_data', 'salutations'));
                $email1->subject('APT-' . $appointment_data['Appointment']['id'] . ", New Booking");
                $email1->send();


                $number = $appointment_data['User']['mobile'];
                //$number = '7219003017';
                $message = "Appoint ID " . $appointment_data['Appointment']['id'] . " , date Time is booked on " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . " Please check personal mails or login to check further.";
                //debug($message);die;
                $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $curl_scraped_page = curl_exec($ch);
                curl_close($ch);

                $number = $appointment_data['Doctor']['mobile'];
                //$number = '7219003017';
                $message = "Appoint ID " . $appointment_data['Appointment']['id'] . " , date Time is booked on " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . " Please login to approve and check further details.";

                $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $curl_scraped_page = curl_exec($ch);
                curl_close($ch);


                $number = '9953333592';
                $message = "Appoint ID " . $appointment_data['Appointment']['id'] . ", date Time is booked on " . date('d-M-Y h:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) . " Please login to approve and check further details.";
                //debug($message);die;
                $url = "http://bulksms.mysmsmantra.com/WebSMS/SMSAPI.jsp?username=feishtest&password=327407481&sendername=FEISHT&mobileno=" . $number . "&message=" . urlencode($message);
                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $curl_scraped_page = curl_exec($ch);
                curl_close($ch);

                $this->Session->setFlash(__('Appointment booked successfully'), 'success');
            } else {
                $this->Session->setFlash(__('Appointment could not be saved, Please try Again'), 'error');
            }

            return $this->redirect(array('controller' => 'services', 'action' => 'service_details', $this->request->data['Appointment']['service_id']));
        }
    }

    public function delete($id = null) {
        $this->Appointment->id = $id;
        if (!$this->Appointment->exists()) {
            throw new NotFoundException(__('Invalid appointment'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Appointment->delete()) {
            $this->Session->setFlash(__('The appointment has been deleted.'));
        } else {
            $this->Session->setFlash(__('The appointment could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    /**
     * add_encounter method
     *
     * @return void
     */
    public function add_encounter($appId = null) {

        $this->loadModel('SoapNote');
        $where = array('feilds' => array('SoapNote.id'), 'conditions' => array('SoapNote.appointment_id' => $appId));
        $allData = $this->SoapNote->find('first', $where);
        if (!empty($allData)) {
            $id = $allData['SoapNote']['id'];
            if ($this->SoapNote->exists($id)) {
                $this->SoapNote->id = $id;
            }
        } else {
            $this->SoapNote->create();
        }
        $postResult = $this->request->is(array('post', 'put'));
//        debug($this->request->data);die;
        if ($postResult) {
            $saveData = $this->request->data;
            $saveData['SoapNote']['appointment_id'] = $appId;
            if ($this->SoapNote->save($saveData)) {
//                $log = $this->SoapNote->getDataSource()->getLog(false, false);
//                debug($log);die;
                $this->Session->setFlash(__('The appointment has been saved.'), 'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The appointment could not be saved. Please, try again.'), 'error');
            }
        }
        $options = array('conditions' => array('SoapNote.appointment_id' => $appId));
        $soapNote = $this->SoapNote->find('first', $options);
        $this->request->data = $soapNote;
        $this->set(compact('appId'));
    }

    /**
     * add_drugs method
     *
     * @return void
     */
    public function view_soap_report_details($appointment_id) {

        $user_id = Authcomponent::user('id');
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $this->loadModel('SoapNote');
        $this->loadModel('Appointment');

        if (!empty($appointment_id)) {

            $data = $this->request->data;
            $users_soap_history = $this->SoapNote->find('first', array('conditions' => array('SoapNote.appointment_id' => $appointment_id)));
            $users_details = $this->Appointment->find('first', array('conditions' => array('Appointment.id' => $appointment_id)));
        }
//        debug($users_details);die;
        $this->set(compact('users_soap_history', 'users_details', 'salutations'));
    }

    public function view_drugs_report_details($appointment_id) {

        $user_id = Authcomponent::user('id');
        $this->loadModel('Prescription');

        if (!empty($appointment_id)) {

            $data = $this->request->data;
            $users_drugs_history = $this->Prescription->find('all', array('conditions' => array('Prescription.appointment_id' => $appointment_id)));
        }
//        debug($users_drugs_history);
//        die;
        $this->set(compact('users_soap_history', 'users_drugs_history'));
    }

    public function add_drugs($appId) {
        $this->loadModel('Prescription');
        $doc_id = $this->Auth->user('id');
        $services = $this->Appointment->find('first', array(
            'conditions' => array('Appointment.id' => $appId),
            'fields' => array('Appointment.id', 'Service.id', 'User.id', 'User.first_name', 'User.last_name')
        ));
        if ($this->request->is('post')) {
            $saveData = $this->request->data;

            ////save all drugs
            foreach ($saveData['Prescription'] as $key => $value) {
                if ($key == 0) {
                    $thtd = $value['things_to_do'];
                }
                ////implode checkbox values with ","
                If (isset($value["medicine_time"])) {
                    $value['medicine_time'] = implode(",", $value["medicine_time"]);
                }
                ////check for existing drug's entries
                if (isset($value['id'])) {
                    $id = $value['id'];
                    if ($this->Prescription->exists($id)) {
//                        debug($id);
                        $this->Prescription->id = $id;
                    }
                    ////else create new entry
                } else {
//                    echo '<br>create new<br>';
                    $this->Prescription->create();
                }
                $saveData1['Prescription'] = $value;
                $saveData1['Prescription']['appointment_id'] = $appId;
                $saveData1['Prescription']['doctor_by'] = $doc_id;
                $saveData1['Prescription']['patient_to'] = $services['User']['id'];
                $saveData1['Prescription']['things_to_do'] = $thtd;

//                debug($saveData1); 
                ////save/update drugs
                if ($this->Prescription->save($saveData1)) {
                    ////check executed queries
                    $flag = true;
                } else {
                    $flag = false;
                }
            }
//            $log = $this->Prescription->getDataSource()->getLog(false, false);
//            debug($log);
//            die;
            if ($flag) {
                $this->Session->setFlash(__('The prescription has been saved.'), 'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The prescription could not be saved. Please, try again.'), 'error');
            }
        }
        ////get 'Prescription' details to display on form if available
        $this->Prescription->recursive = -1;
        $options = array('conditions' => array('Prescription.appointment_id' => $appId, 'Prescription.doctor_by' => $doc_id, 'Prescription.patient_to' => $services['User']['id']));
        $prescription = $this->Prescription->find('all', $options);
//        debug($prescription);die;
        ////explode "," from checkbox values
        if (!empty($prescription)) {
            foreach ($prescription as $key => $value) {
                $prescription[$key]['Prescription']['medicine_time'] = explode(",", $value['Prescription']['medicine_time']);
            }
        }

        $this->set(compact('users', 'services', 'prescription'));
    }

    /**
     * add_drugs method
     *
     * @return void
     */
    public function add_drugs_by_patient($appId, $type) {

        $this->loadModel('Prescription');
//        $doc_id = $this->Auth->user('id');
        $patient_id = $this->Auth->user('id');
        $services = $this->Appointment->find('first', array(
            'conditions' => array('Appointment.id' => $appId),
            'fields' => array('Appointment.id', 'Service.id', 'User.id', 'User.first_name', 'User.last_name', 'Doctor.id')
        ));
//        debug($services);die;
        if ($this->request->is('post')) {
            $saveData = $this->request->data;
            ////save all drugs
            foreach ($saveData['Prescription'] as $key => $value) {
                if ($key == 0) {
                    $thtd = $value['things_to_do'];
                }
                ////implode checkbox values with ","
                If (isset($value["medicine_time"])) {
                    $value['medicine_time'] = implode(",", $value["medicine_time"]);
                }
                ////check for existing drug's entries
                if (isset($value['id'])) {
                    $id = $value['id'];
                    if ($this->Prescription->exists($id)) {
//                        debug($id);
                        $this->Prescription->id = $id;
                    }
                    ////else create new entry
                } else {
                    echo '<br>create new<br>';
                    $this->Prescription->create();
                }
                $saveData1['Prescription'] = $value;
                $saveData1['Prescription']['appointment_id'] = $appId;
                $saveData1['Prescription']['doctor_by'] = $services['Doctor']['id'];
                $saveData1['Prescription']['patient_to'] = $services['User']['id'];
                $saveData1['Prescription']['things_to_do'] = $thtd;
                ////save/update drugs if data not empty
                if (!empty($saveData1)) {
                    if ($this->Prescription->save($saveData1)) {
                        ////check executed queries
                        $flag = true;
                    } else {
                        $flag = false;
                    }
                } else {
                    $flag = true;
                }
            }
//            $log = $this->Prescription->getDataSource()->getLog(false, false);
//            debug($log);
//            die;
            if ($flag) {
                //$this->Session->setFlash(__('The prescription has been saved.'), 'success');
                return $this->redirect(array('action' => 'view_all'));
            } else {
                //$this->Session->setFlash(__('The prescription could not be saved. Please, try again.'), 'error');
            }
        }
        ////get 'Prescription' details to display on form if available
        $this->Prescription->recursive = -1;
//        $options = array('conditions' => array('Prescription.doctor_by' => $doc_id));
//        $prescription = $this->Prescription->find('all', $options);


        $options = array('conditions' => array('Prescription.appointment_id' => $appId, 'Prescription.doctor_by' => $services['Doctor']['id'], 'Prescription.patient_to' => $patient_id));
        $prescription = $this->Prescription->find('all', $options);

//        debug($prescription);die;
        ////explode "," from checkbox values
        if (!empty($prescription)) {
            foreach ($prescription as $key => $value) {
                $prescription[$key]['Prescription']['medicine_time'] = explode(",", $value['Prescription']['medicine_time']);
            }
        }
        if ($type == 1) {
            $action = 'view_all';
        } else if ($type == 2) {
            $action = 'view_rescheduled';
        } else if ($type == 3) {
            $action = 'view_cancelled';
        }
        $this->set(compact('users', 'services', 'prescription', 'action'));
    }

    /**
     * delete drug by id
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete_drug() {
        $this->autoRender = false;
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];
        }
        $this->loadModel('Prescription');
        $this->Prescription->id = $id;
        if (!$this->Prescription->exists()) {
            throw new NotFoundException(__('Invalid drug'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Prescription->delete()) {
            echo json_encode(array('flag' => true, 'msg' => 'The drug has been deleted.'));
        } else {
            echo json_encode(array('flag' => false, 'msg' => 'The drug could not be deleted. Please, try again.'));
        }
    }

    /**
     * view_presc method
     * view privios prescriptions
     *
     * @throws NotFoundException
     * @param string $userId - appointment id
     * @return void
     */
    public function view_presc($appId) {
        $this->loadModel('Prescription');
        $doc_id = $this->Auth->user('id');
        $services = $this->Appointment->find('first', array(
            'conditions' => array('Appointment.id' => $appId),
            'fields' => array('Appointment.id', 'Service.id', 'User.first_name', 'User.last_name', 'User.id')
        ));
//        debug($services); die;

        $this->Prescription->recursive = -1;
        $options = array('conditions' => array('Prescription.appointment_id' => $appId, 'Prescription.doctor_by' => $doc_id, 'Prescription.patient_to' => $services['User']['id']));
        $prescription = $this->Prescription->find('all', $options);
//        debug($prescription); die;
        ////explode "," from checkbox values
        if (!empty($prescription)) {
            foreach ($prescription as $key => $value) {
                $prescription[$key]['Prescription']['medicine_time'] = explode(",", $value['Prescription']['medicine_time']);
            }
        }
        $appointment_id = $appId;
        $this->set(compact('services', 'prescription', 'appointment_id'));
        $this->render('view_presc');
//        $options = array('conditions' => array('Appointment.' . $this->Appointment->primaryKey => $id));
//        $this->set('appointment', $this->Appointment->find('first', $options));
    }

    public function print_drugs_prescription($appId) {
        $this->layout = '';
        $this->loadModel('Prescription');
        $doc_id = $this->Auth->user('id');
        $services = $this->Appointment->find('first', array(
            'conditions' => array('Appointment.id' => $appId),
            'fields' => array('Appointment.id', 'Service.id', 'User.first_name', 'User.last_name', 'User.id')
        ));

        $this->Prescription->recursive = -1;
        $options = array('conditions' => array('Prescription.appointment_id' => $appId, 'Prescription.doctor_by' => $doc_id, 'Prescription.patient_to' => $services['User']['id']));
        $prescription = $this->Prescription->find('all', $options);
        ////explode "," from checkbox values
        if (!empty($prescription)) {
            foreach ($prescription as $key => $value) {
                $prescription[$key]['Prescription']['medicine_time'] = explode(",", $value['Prescription']['medicine_time']);
            }
        }
        $appointment_id = $appId;
        $this->set(compact('services', 'prescription', 'appointment_id'));
//        $this->render('view_presc');
    }

    public function view_prescription($appId) {
        $this->layout = 'front_layout';
        $this->loadModel('Prescription');
        $patient_id = $this->Auth->user('id');
        $services = $this->Appointment->find('first', array(
            'conditions' => array('Appointment.id' => $appId),
            'fields' => array('Appointment.id', 'Service.id', 'User.first_name', 'User.last_name', 'User.id', 'Doctor.id')
        ));

        $this->Prescription->recursive = -1;
        $options = array('conditions' => array('Prescription.appointment_id' => $appId, 'Prescription.doctor_by' => $services['Doctor']['id'], 'Prescription.patient_to' => $services['User']['id']));
        $prescription = $this->Prescription->find('all', $options);

        ////explode "," from checkbox values
        if (!empty($prescription)) {
            foreach ($prescription as $key => $value) {
                $prescription[$key]['Prescription']['medicine_time'] = explode(",", $value['Prescription']['medicine_time']);
            }
        }
//        debug($prescription);die;
        $appointment_id = $appId;
        $this->set(compact('services', 'prescription', 'appointment_id'));
//        $this->render('view_presc');
    }

    public function print_prescription($appId) {
        $this->layout = '';
        $this->loadModel('Prescription');
        $patient_id = $this->Auth->user('id');
        $services = $this->Appointment->find('first', array(
            'conditions' => array('Appointment.id' => $appId),
            'fields' => array('Appointment.id', 'Service.id', 'User.first_name', 'User.last_name', 'User.id', 'Doctor.id')
        ));

        $this->Prescription->recursive = -1;
        $options = array('conditions' => array('Prescription.appointment_id' => $appId, 'Prescription.doctor_by' => $services['Doctor']['id'], 'Prescription.patient_to' => $services['User']['id']));
        $prescription = $this->Prescription->find('all', $options);

        ////explode "," from checkbox values
        if (!empty($prescription)) {
            foreach ($prescription as $key => $value) {
                $prescription[$key]['Prescription']['medicine_time'] = explode(",", $value['Prescription']['medicine_time']);
            }
        }
//        debug($prescription);die;
        $appointment_id = $appId;
        $this->set(compact('services', 'prescription', 'appointment_id'));
//        $this->render('view_presc');
    }

    public function download_note($id) {

        $this->viewClass = 'Media';
        // Render app/webroot/notes/example.docx
        $fileName = 'note_for_PA-' . $id . '_' . date('Y-m-d');
        $params = array(
            'id' => $fileName . '.docx',
            'name' => $fileName,
            'extension' => 'docx',
            'mimeType' => array(
                'docx' => 'application/vnd.openxmlformats-officedocument' .
                '.wordprocessingml.document'
            ),
            'path' => 'notes' . DS
        );
//        print_r($params); die;
        $this->set($params);
    }

    public function view_all() {
        $this->layout = 'front_layout';
        $user_id = Authcomponent::user('id');
//        $appointments = $this->Appointment->get_all_appointments($user_id);
        $this->paginate = (array(
            'conditions' => array('Appointment.user_id' => $user_id, 'Appointment.status' => array(0)),
            'order' => 'Appointment.id DESC',
            'limit' => 10,
                // 'recursive'=>-1
        ));
        $appointments = $this->Paginator->paginate();
//        debug($appointments); die;
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $app_status = Configure::read('feish.appointment_status');
        $this->set(compact('appointments', 'salutations', 'app_status'));
    }

    public function get_soap_report_byid() {
        $this->layout = null;
        $this->loadModel('SoapNote');

        if ($this->request->is('post')) {

            $data = $this->request->data;
            $users_soap_history = $this->SoapNote->find('first', array('conditions' => array('SoapNote.appointment_id' => $this->request->data['id'])));

            if (!empty($users_soap_history)) {
                $result = $users_soap_history;
            } else {
                $result = 0;
            }
            $this->set(compact('result'));
        }
    }

    public function view_report_details($appointment_id) {
        $this->layout = 'front_layout';
        $user_id = Authcomponent::user('id');
        $this->loadModel('SoapNote');
        $this->loadModel('Appointment');
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        if (!empty($appointment_id)) {

            $data = $this->request->data;
            $users_soap_history = $this->SoapNote->find('first', array('conditions' => array('SoapNote.appointment_id' => $appointment_id)));
            $users_details = $this->Appointment->find('first', array('conditions' => array('Appointment.id' => $appointment_id)));
        }
//        debug($users_soap_history);die;
        $this->set(compact('users_soap_history', 'users_details', 'salutations'));
    }

    public function print_report_details($appointment_id) {
        $this->layout = null;
        $user_id = Authcomponent::user('id');
        $this->loadModel('Appointment');
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $this->loadModel('SoapNote');

        if (!empty($appointment_id)) {

            $data = $this->request->data;
            $users_soap_history = $this->SoapNote->find('first', array('conditions' => array('SoapNote.id' => $appointment_id)));
            $users_details = $this->Appointment->find('first', array('conditions' => array('Appointment.id' => $users_soap_history['SoapNote']['appointment_id'])));
//             echo '<pre>';print_r($users_soap_history);die;
        }
        $this->set(compact('users_soap_history', 'users_details', 'salutations'));
    }

    public function print_report($appointment_id) {
        $this->layout = null;
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $this->loadModel('SoapNote');
        $this->loadModel('Appointment');
        $user_id = Authcomponent::user('id');
        $this->loadModel('SoapNote');

        if (!empty($appointment_id)) {

            $data = $this->request->data;
            $users_soap_history = $this->SoapNote->find('first', array('conditions' => array('SoapNote.id' => $appointment_id)));
            $users_details = $this->Appointment->find('first', array('conditions' => array('Appointment.id' => $users_soap_history['SoapNote']['appointment_id'])));
        }

        $this->set(compact('users_soap_history', 'users_details', 'salutations'));
    }

    public function view_rescheduled() {
        $this->layout = 'front_layout';
        $user_id = Authcomponent::user('id');
        $this->paginate = (array(
            'conditions' => array('Appointment.user_id' => $user_id, 'Appointment.status' => 2),
            'order' => 'Appointment.id DESC',
            'limit' => 10,
                // 'recursive'=>-1
        ));
        $appointments = $this->Paginator->paginate();
//        debug($appointments); die;
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $app_status = Configure::read('feish.appointment_status');
        $this->set(compact('appointments', 'salutations', 'app_status'));
    }

    public function view_cancelled() {
        $this->layout = 'front_layout';
        $user_id = Authcomponent::user('id');
        $this->paginate = (array(
            'conditions' => array('Appointment.user_id' => $user_id, 'Appointment.status' => 3),
            'order' => 'Appointment.id DESC',
            'limit' => 10,
                // 'recursive'=>-1
        ));
        $appointments = $this->Paginator->paginate();
//        debug($appointments);
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $app_status = Configure::read('feish.appointment_status');
        $this->set(compact('appointments', 'salutations', 'app_status'));
    }

    public function view_confirmed() {
        $this->layout = 'front_layout';
        $user_id = Authcomponent::user('id');
        $this->paginate = (array(
            'conditions' => array('Appointment.user_id' => $user_id, 'Appointment.status' => array(1, 2)),
            'order' => 'Appointment.id DESC',
            'limit' => 10,
                // 'recursive'=>-1
        ));
        $appointments = $this->Paginator->paginate();
//        debug($appointments);
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $app_status = Configure::read('feish.appointment_status');
        $this->set(compact('appointments', 'salutations', 'app_status'));
    }

    public function view_documents_list($appoinment_id) {
        $this->layout = 'front_layout';
        $user_id = Authcomponent::user('id');
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $this->loadModel('UploadDocument');
        $this->loadModel('Appointment');
        if (!empty($appoinment_id)) {
            $appointment_uploaded_doc = $this->UploadDocument->find('all', array('conditions' => array('UploadDocument.foreign_key_id' => $appoinment_id, 'UploadDocument.type' => 10)));
            $appointment = $this->Appointment->find('first', array('conditions' => array('Appointment.id' => $appoinment_id)));
        } else {
            return $this->redirect(array('action' => 'view_all'));
        }
//        debug($appointment_uploaded_doc);die;
        $this->set(compact('appointment_uploaded_doc', 'appointment', 'salutations'));
    }

    public function view_uploaded_documents($appoinment_id) {
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $user_id = Authcomponent::user('id');
        $this->loadModel('UploadDocument');
        $this->loadModel('Appointment');
        if (!empty($appoinment_id)) {
            $appointment_uploaded_doc = $this->UploadDocument->find('all', array('conditions' => array('UploadDocument.foreign_key_id' => $appoinment_id, 'UploadDocument.type' => 10)));
            $appointment = $this->Appointment->find('first', array('conditions' => array('Appointment.id' => $appoinment_id)));
        } else {
            return $this->redirect(array('action' => 'index'));
        }

//        debug($appointment_uploaded_doc);die;

        $this->set(compact('appointment_uploaded_doc', 'appointment', 'salutations'));
    }

    public function upload_drugs() {
        $this->autoRender = false;
        $this->loadModel('Appointment');
        if ($this->request->is('post')) {
            if (!empty($this->request->data['upload_drugs']['name'])) {
//                debug($this->request->data);die;
                $name = $this->Appointment->upload_attachment($this->request->data['upload_drugs'], 'prescriptions');
                if (!empty($name)) {

                    $upload_detail = array();
                    $upload_detail['UploadDocument']['uploaded_by'] = $this->Auth->user('id');
                    $upload_detail['UploadDocument']['foreign_key_id'] = $this->request->data['id'];
                    $upload_detail['UploadDocument']['file_name'] = $name;
                    $upload_detail['UploadDocument']['original_name'] = $this->request->data['upload_drugs']['name'];
                    $upload_detail['UploadDocument']['type'] = 10;
                    $this->loadModel('UploadDocument');
                    $this->UploadDocument->create();

//                    if ($this->Appointment->updateAll(array('Appointment.upload_drugs' => "'" . $name . "'"), array('Appointment.id' => $this->request->data['id']))) {
                    if ($this->UploadDocument->save($upload_detail)) {
                        $this->Session->setFlash(__('The prescription has been saved.'), 'success');
                        return $this->redirect(Controller::referer());
                    } else {
                        $this->Session->setFlash(__('The prescription could not be uploaded.'), 'error');
                        return $this->redirect(Controller::referer());
                    }
                } else {
                    $this->Session->setFlash(__('The prescription could not be uploaded.'), 'error');
                    return $this->redirect(Controller::referer());
                }
            } else {
                $this->Session->setFlash(__('The prescription could not be uploaded.Please try again.'), 'error');
                return $this->redirect(Controller::referer());
            }
        }
    }

    public function appointment_upload_drugs() {
        $this->autoRender = false;
        $this->loadModel('Appointment');
        if ($this->request->is('post')) {
            if (!empty($this->request->data['upload_drugs']['name'])) {
//                debug($this->request->data);die;
                $name = $this->Appointment->upload_attachment($this->request->data['upload_drugs'], 'prescriptions');
                if (!empty($name)) {

                    $upload_detail = array();
                    $upload_detail['UploadDocument']['uploaded_by'] = $this->Auth->user('id');
                    $upload_detail['UploadDocument']['foreign_key_id'] = $this->request->data['id'];
                    $upload_detail['UploadDocument']['file_name'] = $name;
                    $upload_detail['UploadDocument']['original_name'] = $this->request->data['upload_drugs']['name'];
                    $upload_detail['UploadDocument']['type'] = 10;
                    $this->loadModel('UploadDocument');
                    $this->UploadDocument->create();

//                    if ($this->Appointment->updateAll(array('Appointment.upload_drugs' => "'" . $name . "'"), array('Appointment.id' => $this->request->data['id']))) {
                    if ($this->UploadDocument->save($upload_detail)) {
                        $this->Session->setFlash(__('The prescription has been saved.'), 'success');
                        return $this->redirect(Controller::referer());
                    } else {
                        $this->Session->setFlash(__('The prescription could not be uploaded.'), 'error');
                        return $this->redirect(Controller::referer());
                    }
                } else {
                    $this->Session->setFlash(__('The prescription could not be uploaded.'), 'error');
                    return $this->redirect(Controller::referer());
                }
            } else {
                $this->Session->setFlash(__('The prescription could not be uploaded.Please try again.'), 'error');
                return $this->redirect(Controller::referer());
            }
        }
    }

    public function download_uploaded_file($file_name) {

        $file = explode('.', $file_name);
        $this->viewClass = 'Media';
        $params = array(
            'id' => $file_name,
            'name' => $file[0],
            'download' => true,
            'extension' => $file[1],
            'path' => APP . WEBROOT_DIR . DS . 'files/prescriptions' . DS
        );

        $this->set($params);
    }

    public function can_cancel_appointment() {
        $this->layout = null;
        if ($this->request->is('post')) {
            // debug($this->request->data);die;
            $apt_data = $this->Appointment->find('first', array('conditions' => array('Appointment.id' => $this->request->data['apt_id']), 'fields' => array('Appointment.appointed_timing'), 'recursive' => -1));
            if ((strtotime($apt_data['Appointment']['appointed_timing']) - time()) > 3600) {
                $result = 1;
            } else {
                $result = 0;
            }
            $this->set(compact('result'));
            $this->render('filter');
        }
    }

    public function get_data() {
        $this->layout = null;
        if ($this->request->is('post')) {
            
        }
    }

}
