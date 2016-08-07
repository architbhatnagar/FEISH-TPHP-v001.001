<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Communications Controller
 *
 * @property Communication $Communication
 * @property PaginatorComponent $Paginator
 */
class CommunicationsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Email');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Communication->recursive = 0;
        $this->set('communications', $this->Paginator->paginate());
    }

    public function patient_communications() {
        $this->layout = 'front_layout';
        $this->Communication->recursive = 0;
        $this->paginate = (array(
            // 'fields'=>array('Communication.id','Communication.reciever_user_id'),
            'conditions' => array('OR' => array('Communication.user_id' => $this->Auth->user('id'), 'FIND_IN_SET(' . $this->Auth->user('id') . ',Communication.reciever_user_id)'), 'Communication.parent_id' => 0, 'Communication.message_type' => 1),
            'order' => 'Communication.id DESC',
            'limit' => 10,
                // 'recursive'=>-1
        ));
        $communications = $this->Paginator->paginate();
        //debug($communications);die;
        Configure::load('feish');

        $salutations = Configure::read('feish.salutations');
        $this->set(compact('communications', 'salutations'));
    }

    public function doctor_communications() {
        $this->layout = 'front_layout';
        $this->Communication->recursive = 0;
        $this->paginate = (array(
            // 'fields'=>array('Communication.id','Communication.reciever_user_id'),
            'conditions' => array('OR' => array('Communication.user_id' => $this->Auth->user('id'), 'FIND_IN_SET(' . $this->Auth->user('id') . ',Communication.reciever_user_id)'), 'Communication.parent_id' => 0, 'Communication.message_type' => array(0, 2)),
            'order' => 'Communication.id DESC',
            'limit' => 10,
                // 'recursive'=>-1
        ));
        $communications = $this->Paginator->paginate();
        $new_messages = 0;
        foreach ($communications as $key => $message) {
            // debug($this->Auth->user('id'));
            // debug($message);die;
            $communications[$key]['Communication']['new_count'] = 0;
            if (!empty($message['Communication']['viewed_users'])):
                $view_flag = 1;
                $is_viewed = json_decode($message['Communication']['viewed_users'], true);
                //  debug($is_viewed);die;
                if (array_key_exists($this->Auth->user('id'), $is_viewed)) {
                    $view_flag = $is_viewed[$this->Auth->user('id')];
                }
                if ($view_flag == 0):
                    $communications[$key]['Communication']['new_count']+=1;
                    $new_messages++;
                endif;
            endif;

            $is_new = $this->Communication->find('all', array('conditions' => array('Communication.parent_id' => $message['Communication']['id']), 'Order' => 'Communication.created ASC', 'fields' => array('Communication.viewed_users','Communication.message', 'Communication.subject', 'Communication.created', 'Communication.is_attachment', 'User.salutation', 'User.first_name', 'User.last_name')));
            // debug($is_new);die;
            foreach ($is_new as $key2 => $new) {
                $view_flag = 1;
                if (!empty($new['Communication']['viewed_users'])):
                    $is_viewed = json_decode($new['Communication']['viewed_users'], true);
                    // debug($is_viewed);die;
                    if (array_key_exists($this->Auth->user('id'), $is_viewed)) :
                        $view_flag = $is_viewed[$this->Auth->user('id')];
                    endif;
                    if ($view_flag == 0):
                        $communications[$key]['Communication']['new_count']+=1;
                        $new_messages++;
                    endif;
                endif;
                $communications[$key]['Communication']['message'] = $new['Communication']['message'];
                $communications[$key]['Communication']['subject'] = $new['Communication']['subject'];
                $communications[$key]['Communication']['created'] = $new['Communication']['created'];
                $communications[$key]['Communication']['is_attachment'] = $new['Communication']['is_attachment'];
               
                $communications[$key]['User']['first_name'] = $new['User']['first_name'];
                $communications[$key]['User']['last_name'] = $new['User']['last_name'];
                $communications[$key]['User']['salutation'] = $new['User']['salutation'];
            }
        }
//         debug($communications);die;
        Configure::load('feish');

        $salutations = Configure::read('feish.salutations');
        $this->set(compact('communications', 'salutations'));
    }

    public function admin_communications() {
        $this->layout = 'front_layout';
        $this->Communication->recursive = 0;
        $this->paginate = (array(
            'conditions' => array('OR' => array('Communication.user_id' => 0, 'FIND_IN_SET(' . $this->Auth->user('id') . ',Communication.reciever_user_id)'), 'Communication.parent_id' => 0, 'Communication.message_type' => 0),
            'order' => 'Communication.id DESC',
            'limit' => 10,
                // 'recursive'=>-1
        ));
        $communications = $this->Paginator->paginate();
//         debug($communications);die;
        Configure::load('feish');

        $salutations = Configure::read('feish.salutations');
        $this->set(compact('communications', 'salutations'));
    }

    public function communications_index_doctor() {
        $this->Communication->recursive = 0;
        $this->paginate = (array(
            // 'fields'=>array('Communication.id','Communication.reciever_user_id'),
            'conditions' => array('OR' => array('Communication.user_id' => $this->Auth->user('id'), 'FIND_IN_SET(' . $this->Auth->user('id') . ',Communication.reciever_user_id)'), 'Communication.parent_id' => 0),
            'order' => 'Communication.id DESC',
            'limit' => 20,
            'fields' => array(
                'Communication.id', 'Communication.viewed_users', 'Communication.subject', 'Communication.message', 'Communication.created', 'Service.title',
                'User.salutation', 'User.first_name', 'User.last_name', 'User.id'
            )
                // 'recursive'=>-1
        ));
        $communications = $this->Paginator->paginate();
        // debug($communications);die;
        $new_messages = 0;
        foreach ($communications as $key => $message) {
            // debug($this->Auth->user('id'));
            // debug($message);die;
            $communications[$key]['Communication']['new_count'] = 0;
            if (!empty($message['Communication']['viewed_users'])):
                $view_flag = 1;
                $is_viewed = json_decode($message['Communication']['viewed_users'], true);
                //  debug($is_viewed);die;
                if (array_key_exists($this->Auth->user('id'), $is_viewed)) {
                    $view_flag = $is_viewed[$this->Auth->user('id')];
                }
                if ($view_flag == 0):
                    $communications[$key]['Communication']['new_count']+=1;
                    $new_messages++;
                endif;
            endif;

            $is_new = $this->Communication->find('all', array('conditions' => array('Communication.parent_id' => $message['Communication']['id']), 'Order' => 'Communication.created ASC', 'fields' => array('Communication.viewed_users','Communication.message', 'Communication.subject', 'Communication.created', 'Communication.is_attachment', 'User.salutation', 'User.first_name', 'User.last_name')));
            // debug($is_new);die;
            foreach ($is_new as $key2 => $new) {
                $view_flag = 1;
                if (!empty($new['Communication']['viewed_users'])):
                    $is_viewed = json_decode($new['Communication']['viewed_users'], true);
                    // debug($is_viewed);die;
                    if (array_key_exists($this->Auth->user('id'), $is_viewed)) :
                        $view_flag = $is_viewed[$this->Auth->user('id')];
                    endif;
                    if ($view_flag == 0):
                        $communications[$key]['Communication']['new_count']+=1;
                        $new_messages++;
                    endif;
                endif;
                $communications[$key]['Communication']['message'] = $new['Communication']['message'];
                $communications[$key]['Communication']['subject'] = $new['Communication']['subject'];
                $communications[$key]['Communication']['created'] = $new['Communication']['created'];
                $communications[$key]['Communication']['is_attachment'] = $new['Communication']['is_attachment'];
               
                $communications[$key]['User']['first_name'] = $new['User']['first_name'];
                $communications[$key]['User']['last_name'] = $new['User']['last_name'];
                $communications[$key]['User']['salutation'] = $new['User']['salutation'];
            }
        }
        Configure::load('feish');

        $salutations = Configure::read('feish.salutations');
        $this->set(compact('communications', 'salutations'));
    }

    public function communications_index_admin() { 
        
        $this->Communication->recursive = 0;
        $this->paginate = (array(
            // 'fields'=>array('Communication.id','Communication.reciever_user_id'),
            'conditions' => array('Communication.parent_id' => 0),
            'order' => 'Communication.id DESC',
            'limit' => 20,
            'fields' => array(
                'Communication.id', 'Communication.viewed_users', 'Communication.subject', 'Communication.message', 'Communication.created', 'Service.title',
                'User.salutation', 'User.first_name', 'User.last_name', 'User.id'
            )
                // 'recursive'=>-1
        ));
        $communications = $this->Paginator->paginate();
        $new_messages = 0;
        foreach ($communications as $key => $message) {
            // debug($this->Auth->user('id'));
            // debug($message);die;
            $communications[$key]['Communication']['new_count'] = 0;
            if (!empty($message['Communication']['viewed_users'])):
                $view_flag = 1;
                $is_viewed = json_decode($message['Communication']['viewed_users'], true);
                //  debug($is_viewed);die;
                if (array_key_exists(0, $is_viewed)) {
                    $view_flag = $is_viewed[0];
                }
                if ($view_flag == 0):
                    $communications[$key]['Communication']['new_count']+=1;
                    $new_messages++;
                endif;
            endif;

            $is_new = $this->Communication->find('all', array('conditions' => array('Communication.parent_id' => $message['Communication']['id']), 'Order' => 'Communication.created ASC', 'fields' => array('Communication.viewed_users','Communication.message', 'Communication.subject', 'Communication.created', 'Communication.is_attachment', 'User.salutation', 'User.first_name', 'User.last_name')));
            // debug($is_new);die;
            foreach ($is_new as $key2 => $new) {
                $view_flag = 1;
                if (!empty($new['Communication']['viewed_users'])):
                    $is_viewed = json_decode($new['Communication']['viewed_users'], true);
                    // debug($is_viewed);die;
                    if (array_key_exists($this->Auth->user('id'), $is_viewed)) :
                        $view_flag = $is_viewed[$this->Auth->user('id')];
                    endif;
                    if ($view_flag == 0):
                        $communications[$key]['Communication']['new_count']+=1;
                        $new_messages++;
                    endif;
                endif;
                $communications[$key]['Communication']['message'] = $new['Communication']['message'];
                $communications[$key]['Communication']['subject'] = $new['Communication']['subject'];
                $communications[$key]['Communication']['created'] = $new['Communication']['created'];
                $communications[$key]['Communication']['is_attachment'] = $new['Communication']['is_attachment'];
               
                $communications[$key]['User']['first_name'] = $new['User']['first_name'];
                $communications[$key]['User']['last_name'] = $new['User']['last_name'];
                $communications[$key]['User']['salutation'] = $new['User']['salutation'];
                //debug($communications);die;
            }
        }
//        $log = $this->Communication->getDataSource()->getLog(false, false);
//        debug($log);
//        die;
        // debug($communications);die;
        Configure::load('feish');

        $salutations = Configure::read('feish.salutations');
        $this->set(compact('communications', 'salutations'));
    }

    public function patient_compose() {
        $this->layout = 'front_layout';
        Configure::load('feish');

        $salutations = Configure::read('feish.salutations');
        if ($this->request->is('post')) {
            debug($this->request->data);
            die;
        }
        $this->loadModel('PatientPackageLog');
        $services_list = $this->PatientPackageLog->find('list', array('conditions' => array('PatientPackageLog.user_id' => $this->Auth->user('id'), 'PatientPackageLog.is_active' => 1), 'fields' => array('PatientPackageLog.service_id', 'PatientPackageLog.service_id')));
        $services = $this->Communication->Service->find('list', array('conditions' => array('Service.id' => $services_list), 'fields' => array('id', 'title')));


        $this->set(compact('users', 'services'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $this->layout = 'front_layout';
        Configure::load('feish');
        // debug($this->Auth->user('id'));
        $salutations = Configure::read('feish.salutations');
        $communication = $this->Communication->find('first', array('conditions' => array('Communication.id' => $id)));

        $comm_data = $this->Communication->find('first', array('conditions' => array('Communication.id' => $id, 'FIND_IN_SET(' . $this->Auth->user('id') . ',Communication.reciever_user_id)')));
        //debug($comm_data);
        if (!empty($comm_data)) {
            $viewed_users = json_decode($comm_data['Communication']['viewed_users'], TRUE);
            $viewed_users[$this->Auth->user('id')] = 1;
            $this->Communication->updateAll(array('Communication.is_viewed' => 1, 'Communication.viewed_users' => "'" . json_encode($viewed_users) . "'"), array('Communication.id' => $id));
            // $this->Communication->updateAll(array('Communication.is_viewed'=>1),array('Communication.user_id NOT'=>$this->Auth->user('id'),'OR'=>array('Communication.id'=>$id,'Communication.parent_id'=>$id)));
        }
        $parent_messages = $this->Communication->find('all', array('conditions' => array('Communication.parent_id' => $id, 'FIND_IN_SET(' . $this->Auth->user('id') . ',Communication.reciever_user_id)'), 'fields' => array('Communication.id', 'Communication.viewed_users')));
        //debug($parent_messages);die;
        foreach ($parent_messages as $p_message) {
            if (!empty($p_message['Communication']['viewed_users'])) {
                $viewed_users = json_decode($p_message['Communication']['viewed_users'], TRUE);
                $viewed_users[$this->Auth->user('id')] = 1;
                $this->Communication->updateAll(array('Communication.is_viewed' => 1, 'Communication.viewed_users' => "'" . json_encode($viewed_users) . "'"), array('Communication.id' => $p_message['Communication']['id']));
            }
        }






        if (!$this->Communication->exists($id)) {
            throw new NotFoundException(__('Invalid communication'));
        }
        $link = Router::url('/', true) . "communications/view/" . $id;
        // debug($link);die;


        if ($communication['Communication']['message_type'] == 1) {
            $actionName = 'patient_communications';
        } else if ($communication['Communication']['message_type'] == 2) {
            $actionName = 'doctor_communications';
        } else {
            $actionName = 'admin_communications';
        }
//        debug($communication);die;
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $result = $this->Communication->validate_text($this->request->data['Communication']['message']);
            if ($result) {
                if (isset($this->request->data['Communication']['file_attachment']) && !empty($this->request->data['Communication']['file_attachment'])) {
                    $this->request->data['Communication']['is_attachment'] = 1;
                    $uploded_files_array = array();
                    $uploaded_file_text = '';
                    foreach ($this->request->data['Communication']['file_attachment'] as $file) {
                        $uploaded_file = $this->Communication->upload_attachment($file, 'attachements');
                        if (!empty($uploaded_file)) {
                            $push_array['file_name'] = $uploaded_file;
                            $push_array['original_name'] = $file['name'];
                            array_push($uploded_files_array, $push_array);
                            if (!empty($uploaded_file_text)) {
                                $uploaded_file_text .="," . $uploaded_file;
                            } else {
                                $uploaded_file_text .= $uploaded_file;
                            }
                        }
                    }
                    $this->request->data['Communication']['uploaded_files'] = $uploaded_file_text;
                }
                $this->request->data['Communication']['user_id'] = $this->Auth->user('id');
                $this->request->data['Communication']['service_id'] = $communication['Communication']['service_id'];
                $rev_array = explode(',', $communication['Communication']['reciever_user_id']);
                array_push($rev_array, $communication['Communication']['user_id']);
                if (in_array($this->Auth->user('id'), $rev_array)) {
                    unset($rev_array[$this->Auth->user('id')]);
                }

                $this->request->data['Communication']['reciever_user_id'] = implode(",", $rev_array);
                // $this->request->data['Communication']['reciever_user_id'] = $communication['Communication']['reciever_user_id'];
                // $this->request->data['Communication']['subject'] = $communication['Communication']['subject'];
                $this->request->data['Communication']['parent_id'] = $id;
                $viewed_users = explode(',', $this->request->data['Communication']['reciever_user_id']);
                foreach ($viewed_users as $user) {
                    $user_array[$user] = 0;
                }
                $this->request->data['Communication']['viewed_users'] = json_encode($user_array);
//debug($this->request->data);die;
                $this->Communication->create();
                if ($this->Communication->save($this->request->data)) {
                    $saved_id = $this->Communication->id;
                    if (isset($uploded_files_array) && !empty($uploded_files_array)) {
                        foreach ($uploded_files_array as $file_arr) {
                            $this->loadModel('upload_documents');
                            $file_save_data = array();
                            $file_save_data['upload_documents']['file_name'] = $file_arr['file_name'];
                            $file_save_data['upload_documents']['original_name'] = $file_arr['original_name'];
                            $file_save_data['upload_documents']['uploaded_date'] = date('Y-m-d H:i:s');
                            $file_save_data['upload_documents']['uploaded_by'] = $this->Auth->user('id');
                            $file_save_data['upload_documents']['type'] = 1;
                            $file_save_data['upload_documents']['foreign_key_id'] = $saved_id;

                            $this->upload_documents->create();
                            if ($this->upload_documents->save($file_save_data)) {
                                
                            } else {
                                debug($this->upload_documents->validationErrors);
                                die;
                            }
                        }
                    }
                    //$to=array();
                    // $this->
                    // $to = $salutations[$comm_data['Reciever']['salutation']] . ". " . $comm_data['Reciever']['first_name'] . " " . $comm_data['Reciever']['last_name'];
                    $from = $salutations[$this->Auth->user('salutation')] . ". " . $this->Auth->user('first_name') . " " . $this->Auth->user('last_name');
                    $message = $this->request->data['Communication']['message'];
                    $reciever_arr = explode(',', $this->request->data['Communication']['reciever_user_id']);
                    foreach ($reciever_arr as $reciver_id) {
                        $to_user_data = $this->Communication->User->find('first', array('conditions' => array('User.id' => $reciver_id), 'fields' => array('User.email', 'User.salutation', 'User.first_name', 'User.last_name')));
                        if ($reciver_id != 0) {
                            $to = $salutations[$to_user_data['User']['salutation']] . ". " . $to_user_data['User']['first_name'] . " " . $to_user_data['User']['last_name'];
                        } else {
                            $to = 'support@feish.online';
                        }
                        $email = new CakeEmail();
                        $email->config('communication_mail');
                        if ($reciver_id != 0) {
                            $email->to($to_user_data['User']['email']);
                        } else {
                            $email->to('support@feish.online');
                        }

                        $email->viewVars(compact('to', 'from', 'message', 'link'));
                        $email->subject($this->request->data['Communication']['subject']);
                        $email->send();
                    }

                    $this->Session->setFlash(__('Mail Send Successfuly'), 'success');
                    $this->redirect(array('action' => 'view', $id));
                } else {
                    $this->Session->setFlash(__('Mail Could Not Be Send,Please try again'), 'error');
                    $this->redirect(array('action' => 'view', $id));
                }
                die;
            } else {
                $this->Session->setFlash(__('Message can not contain email or phone number,Please try again'), 'error');
            }
        }

        $childCommunications = $this->Communication->find('all', array('conditions' => array('Communication.parent_id' => $id), 'order' => 'Communication.created DESC'));
        $this->set(compact('communication', 'salutations', 'childCommunications', 'actionName'));
    }

    public function view_doc_communication($id = null) {
        $options = array('conditions' => array('Communication.' . $this->Communication->primaryKey => $id), 'recursive' => 0);
        $communication = $this->Communication->find('first', $options);
        $comm_data = $this->Communication->find('first', array('conditions' => array('Communication.id' => $id, 'FIND_IN_SET(' . $this->Auth->user('id') . ',Communication.reciever_user_id)')));

        if (!empty($comm_data)) {
            $viewed_users = json_decode($comm_data['Communication']['viewed_users'], TRUE);
            $viewed_users[$this->Auth->user('id')] = 1;
            $this->Communication->updateAll(array('Communication.is_viewed' => 1, 'Communication.viewed_users' => "'" . json_encode($viewed_users) . "'"), array('Communication.id' => $id));
            // $this->Communication->updateAll(array('Communication.is_viewed'=>1),array('Communication.user_id NOT'=>$this->Auth->user('id'),'OR'=>array('Communication.id'=>$id,'Communication.parent_id'=>$id)));
        }
        $parent_messages = $this->Communication->find('all', array('conditions' => array('Communication.parent_id' => $id, 'FIND_IN_SET(' . $this->Auth->user('id') . ',Communication.reciever_user_id)'), 'fields' => array('Communication.id', 'Communication.viewed_users')));
        //debug($parent_messages);die;
        foreach ($parent_messages as $p_message) {
            if (!empty($p_message['Communication']['viewed_users'])) {
                $viewed_users = json_decode($p_message['Communication']['viewed_users'], TRUE);
                $viewed_users[$this->Auth->user('id')] = 1;
                $this->Communication->updateAll(array('Communication.is_viewed' => 1, 'Communication.viewed_users' => "'" . json_encode($viewed_users) . "'"), array('Communication.id' => $p_message['Communication']['id']));
            }
        }

        Configure::load('feish');

        $salutations = Configure::read('feish.salutations');
        if (!$this->Communication->exists($id)) {
            throw new NotFoundException(__('Invalid communication'));
        }
        $link = Router::url('/', true) . "communications/view_doc_communication/" . $id;
        // debug($link);die;
//        debug($communication);die;
        if ($this->request->is('post')) {
            $result = $this->Communication->validate_text($this->request->data['Communication']['message']);
            if ($result) {
                if (isset($this->request->data['Communication']['file_attachment']) && !empty($this->request->data['Communication']['file_attachment'])) {
                    $this->request->data['Communication']['is_attachment'] = 1;
                    $uploded_files_array = array();
                    $uploaded_file_text = '';
                    foreach ($this->request->data['Communication']['file_attachment'] as $file) {
                        $uploaded_file = $this->Communication->upload_attachment($file, 'attachements');
                        if (!empty($uploaded_file)) {
                            $push_array['file_name'] = $uploaded_file;
                            $push_array['original_name'] = $file['name'];
                            array_push($uploded_files_array, $push_array);
                            if (!empty($uploaded_file_text)) {
                                $uploaded_file_text .="," . $uploaded_file;
                            } else {
                                $uploaded_file_text .= $uploaded_file;
                            }
                        }
                    }
                    $this->request->data['Communication']['uploaded_files'] = $uploaded_file_text;
                }
                $this->request->data['Communication']['user_id'] = $this->Auth->user('id');
                $this->request->data['Communication']['service_id'] = $communication['Communication']['service_id'];
                $rev_array = explode(',', $communication['Communication']['reciever_user_id']);
                array_push($rev_array, $communication['Communication']['user_id']);
                //$rev_array=array_combine($rev_array, $rev_array);
                if (in_array($this->Auth->user('id'), $rev_array)) {
                    $s_key = array_search($this->Auth->user('id'), $rev_array);
                    unset($rev_array[$s_key]);
                }
                $this->request->data['Communication']['reciever_user_id'] = implode(",", $rev_array);

                if (empty($this->request->data['Communication']['subject'])) {
                    $this->request->data['Communication']['subject'] = $communication['Communication']['subject'];
                }
                $this->request->data['Communication']['parent_id'] = $id;
                $viewed_users = explode(',', $this->request->data['Communication']['reciever_user_id']);
                // debug($viewed_users);die;

                foreach ($viewed_users as $user) {
                    $user_array[$user] = 0;
                }
                $this->request->data['Communication']['viewed_users'] = json_encode($user_array);
                // debug($this->request->data);die;
                $this->Communication->create();
                if ($this->Communication->save($this->request->data)) {

                    $saved_id = $this->Communication->id;
                    if (isset($uploded_files_array) && !empty($uploded_files_array)) {
                        foreach ($uploded_files_array as $file_arr) {
                            $this->loadModel('upload_documents');
                            $file_save_data = array();
                            $file_save_data['upload_documents']['file_name'] = $file_arr['file_name'];
                            $file_save_data['upload_documents']['original_name'] = $file_arr['original_name'];
                            $file_save_data['upload_documents']['uploaded_date'] = date('Y-m-d H:i:s');
                            $file_save_data['upload_documents']['uploaded_by'] = $this->Auth->user('id');
                            $file_save_data['upload_documents']['type'] = 1;
                            $file_save_data['upload_documents']['foreign_key_id'] = $saved_id;

                            $this->upload_documents->create();
                            if ($this->upload_documents->save($file_save_data)) {
                                
                            } else {
//                                debug($this->upload_documents->validationErrors);
//                                die;
                            }
                        }
                    }
                    //$to=array();
                    // $to = $salutations[$communication['Reciever']['salutation']] . ". " . $communication['Reciever']['first_name'] . " " . $communication['Reciever']['last_name'];
                    $from = $salutations[$this->Auth->user('salutation')] . ". " . $this->Auth->user('first_name') . " " . $this->Auth->user('last_name');
                    $message = $this->request->data['Communication']['message'];
                    $reciever_arr = explode(',', $this->request->data['Communication']['reciever_user_id']);
                    foreach ($reciever_arr as $reciver_id) {
                        $to_user_data = $this->Communication->User->find('first', array('conditions' => array('User.id' => $reciver_id), 'fields' => array('User.email', 'User.salutation', 'User.first_name', 'User.last_name')));
                        if ($reciver_id != 0) {
                            $to = $salutations[$to_user_data['User']['salutation']] . ". " . $to_user_data['User']['first_name'] . " " . $to_user_data['User']['last_name'];
                        } else {
                            $to = 'support@feish.online';
                        } $email = new CakeEmail();
                        $email->config('communication_mail');
                        if ($reciver_id != 0) {
                            $email->to($to_user_data['User']['email']);
                        } else {
                            $email->to('support@feish.online');
                        }
                        $email->viewVars(compact('to', 'from', 'message', 'link'));
                        $email->subject($this->request->data['Communication']['subject']);
                        // debug($saved_id);die;
                        $email->send();
                    }


                    $this->Session->setFlash(__('Mail Send Successfuly'), 'success');
                    $this->redirect(array('action' => 'view_doc_communication', $id));
                } else {
                    $this->Session->setFlash(__('Mail Could Not Be Send,Please try again'), 'error');
                    $this->redirect(array('action' => 'view_doc_communication', $id));
                }
            } else {
                $this->Session->setFlash(__('Message can not contain email or phone number,Please try again'), 'error');
            }
        }

        $childCommunications = $this->Communication->find('all', array('conditions' => array('Communication.parent_id' => $id), 'order' => 'Communication.created DESC'));
//        debug($childCommunications);die;
        $this->set(compact('communication', 'salutations', 'childCommunications'));
    }

    public function view_admin_communication($id = null) {
        //$this->Communication->updateAll(array('Communication.is_viewed' => 1), array('OR' => array('Communication.id' => $id, 'Communication.parent_id' => $id)));
        Configure::load('feish');

        $salutations = Configure::read('feish.salutations');
        if (!$this->Communication->exists($id)) {
            throw new NotFoundException(__('Invalid communication'));
        }
        $link = Router::url('/', true) . "communications/view_admin_communication/" . $id;
        // debug($link);die;
        $options = array('conditions' => array('Communication.' . $this->Communication->primaryKey => $id), 'recursive' => 0);
        $communication = $this->Communication->find('first', $options);

        $comm_data = $this->Communication->find('first', array('conditions' => array('Communication.id' => $id, 'FIND_IN_SET(' . 0 . ',Communication.reciever_user_id)')));
        //debug($comm_data);
        if (!empty($comm_data)) {
            $viewed_users = json_decode($comm_data['Communication']['viewed_users'], TRUE);
            $viewed_users[0] = 1;
            $this->Communication->updateAll(array('Communication.is_viewed' => 1, 'Communication.viewed_users' => "'" . json_encode($viewed_users) . "'"), array('Communication.id' => $id));
            // $this->Communication->updateAll(array('Communication.is_viewed'=>1),array('Communication.user_id NOT'=>$this->Auth->user('id'),'OR'=>array('Communication.id'=>$id,'Communication.parent_id'=>$id)));
        }
        $parent_messages = $this->Communication->find('all', array('conditions' => array('Communication.parent_id' => $id, 'FIND_IN_SET(' . 0 . ',Communication.reciever_user_id)'), 'fields' => array('Communication.id', 'Communication.viewed_users')));
        //debug($parent_messages);die;
        foreach ($parent_messages as $p_message) {
            if (!empty($p_message['Communication']['viewed_users'])) {
                $viewed_users = json_decode($p_message['Communication']['viewed_users'], TRUE);
                $viewed_users[0] = 1;
                $this->Communication->updateAll(array('Communication.is_viewed' => 1, 'Communication.viewed_users' => "'" . json_encode($viewed_users) . "'"), array('Communication.id' => $p_message['Communication']['id']));
            }
        }












        //debug($communication);die;
        if ($this->request->is('post')) {
            $result = $this->Communication->validate_text($this->request->data['Communication']['message']);
            if ($result) {
                if (isset($this->request->data['Communication']['file_attachment']) && !empty($this->request->data['Communication']['file_attachment'])) {
                    $this->request->data['Communication']['is_attachment'] = 1;
                    $uploded_files_array = array();
                    $uploaded_file_text = '';
                    foreach ($this->request->data['Communication']['file_attachment'] as $file) {
                        $uploaded_file = $this->Communication->upload_attachment($file, 'attachements');
                        if (!empty($uploaded_file)) {
                            $push_array['file_name'] = $uploaded_file;
                            $push_array['original_name'] = $file['name'];
                            array_push($uploded_files_array, $push_array);
                            if (!empty($uploaded_file_text)) {
                                $uploaded_file_text .="," . $uploaded_file;
                            } else {
                                $uploaded_file_text .= $uploaded_file;
                            }
                        }
                    }
                    $this->request->data['Communication']['uploaded_files'] = $uploaded_file_text;
                }
                $this->request->data['Communication']['user_id'] = $this->Auth->user('id');
                $this->request->data['Communication']['service_id'] = $communication['Communication']['service_id'];
                //  $this->request->data['Communication']['reciever_user_id'] = $communication['Communication']['reciever_user_id'];
                $rev_array = explode(',', $communication['Communication']['reciever_user_id']);
                array_push($rev_array, $communication['Communication']['user_id']);
                //$rev_array=array_combine($rev_array, $rev_array);
                if (in_array(0, $rev_array)) {
                    $s_key = array_search(0, $rev_array);
                    unset($rev_array[$s_key]);
                }
                $this->request->data['Communication']['reciever_user_id'] = implode(",", $rev_array);

                //  $this->request->data['Communication']['subject'] = $communication['Communication']['subject'];
                $this->request->data['Communication']['parent_id'] = $id;
                $viewed_users = explode(',', $this->request->data['Communication']['reciever_user_id']);

                foreach ($viewed_users as $user) {
                    $user_array[$user] = 0;
                }
                $this->request->data['Communication']['viewed_users'] = json_encode($user_array);
                // debug($this->request->data);die;
                $this->Communication->create();
                if ($this->Communication->save($this->request->data)) {
                    $saved_id = $this->Communication->id;
                    if (isset($uploded_files_array) && !empty($uploded_files_array)) {
                        foreach ($uploded_files_array as $file_arr) {
                            $this->loadModel('upload_documents');
                            $file_save_data = array();
                            $file_save_data['upload_documents']['file_name'] = $file_arr['file_name'];
                            $file_save_data['upload_documents']['original_name'] = $file_arr['original_name'];
                            $file_save_data['upload_documents']['uploaded_date'] = date('Y-m-d H:i:s');
                            $file_save_data['upload_documents']['uploaded_by'] = $this->Auth->user('id');
                            $file_save_data['upload_documents']['type'] = 1;
                            $file_save_data['upload_documents']['foreign_key_id'] = $saved_id;

                            $this->upload_documents->create();
                            if ($this->upload_documents->save($file_save_data)) {
                                
                            } else {
                                //                                debug($this->upload_documents->validationErrors);
                                //                                die;
                            }
                        }
                    }
                    //$to=array();
                    $to = $salutations[$communication['Reciever']['salutation']] . ". " . $communication['Reciever']['first_name'] . " " . $communication['Reciever']['last_name'];
                    $from = $salutations[$this->Auth->user('salutation')] . ". " . $this->Auth->user('first_name') . " " . $this->Auth->user('last_name');
                    $message = $this->request->data['Communication']['message'];
                    $reciever_arr = explode(',', $this->request->data['Communication']['reciever_user_id']);
                    foreach ($reciever_arr as $reciver_id) {
                        $to_user_data = $this->Communication->User->find('first', array('conditions' => array('User.id' => $reciver_id), 'fields' => array('User.email', 'User.salutation', 'User.first_name', 'User.last_name')));
                        $to = $salutations[$to_user_data['User']['salutation']] . ". " . $to_user_data['User']['first_name'] . " " . $to_user_data['User']['last_name'];
                        $email = new CakeEmail();
                        $email->config('communication_mail');
                        $email->to($to_user_data['User']['email']);
                        $email->viewVars(compact('to', 'from', 'message', 'link'));
                        $email->subject($this->request->data['Communication']['subject']);
                        // debug($saved_id);die;
                        $email->send();
                    }


                    $this->Session->setFlash(__('Mail Send Successfuly'), 'success');
                    $this->redirect(array('action' => 'view_admin_communication', $id));
                } else {
                    $this->Session->setFlash(__('Mail Could Not Be Send,Please try again'), 'error');
                    $this->redirect(array('action' => 'view_admin_communication', $id));
                }
            } else {
                $this->Session->setFlash(__('Message can not contain email or phone number,Please try again'), 'error');
            }
        }

        $childCommunications = $this->Communication->find('all', array('conditions' => array('Communication.parent_id' => $id), 'order' => 'Communication.created DESC'));
        $this->set(compact('communication', 'salutations', 'childCommunications'));
    }

    public function compose_message() {
        if ($this->request->is('post')) {
            $this->Communication->create();
            $mail_data = $this->request->data;
            $mail_data['Communication']['parent_id'] = 0;
            $mail_data['Communication']['is_viewed'] = 0;
            if (isset($mail_data['Communication']['Attach file']['name'])) {
                $mail_data['Communication']['is_attachment'] = 1;
                $mail_data['Communication']['uploaded_files'] = $this->Communication->upload_attachment($mail_data['Communication']['Attach file'], 'attachements');
            } else {
                $mail_data['Communication']['is_attachment'] = 0;
            }
            $mail_data['Communication']['user_id'] = $this->Auth->user('id');
            $mail_data['Communication']['replied_user_key'] = implode(" ", $mail_data['Communication']['replied_user_key']);
            unset($mail_data['Communication']['Attach file']);
//            debug($mail_data); die;
            if ($this->Communication->save($mail_data)) {
                $this->Session->setFlash(__('The communication has been saved.'), 'success');
                return $this->redirect(array('action' => 'communications_index_admin'));
            } else {
                $this->Session->setFlash(__('The communication could not be saved. Please, try again.'), 'error');
            }
        }
        $parentCommunications = $this->Communication->ParentCommunication->find('list');
        $services = $this->Communication->Service->find('list');
        $users = $this->Communication->User->find('list', array('fields' => array('User.id', 'User.email')));
//        debug($users); die;
        $this->set(compact('parentCommunications', 'services', 'users'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Communication->create();
            if ($this->Communication->save($this->request->data)) {
                $this->Session->setFlash(__('The communication has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The communication could not be saved. Please, try again.'));
            }
        }
        $parentCommunications = $this->Communication->ParentCommunication->find('list');
        $services = $this->Communication->Service->find('list');
        $users = $this->Communication->User->find('list');
        $this->set(compact('parentCommunications', 'services', 'users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Communication->exists($id)) {
            throw new NotFoundException(__('Invalid communication'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Communication->save($this->request->data)) {
                $this->Session->setFlash(__('The communication has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The communication could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Communication.' . $this->Communication->primaryKey => $id));
            $this->request->data = $this->Communication->find('first', $options);
        }
        $parentCommunications = $this->Communication->ParentCommunication->find('list');
        $services = $this->Communication->Service->find('list');
        $users = $this->Communication->User->find('list');
        $this->set(compact('parentCommunications', 'services', 'users'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Communication->id = $id;
        if (!$this->Communication->exists()) {
            throw new NotFoundException(__('Invalid communication'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Communication->delete()) {
            $this->Session->setFlash(__('The communication has been deleted.'));
        } else {
            $this->Session->setFlash(__('The communication could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function download_attachment($file = null) {
        $this->viewClass = 'Media';
        $explod_arr = explode('.', $file);
        $params = array(
            'id' => $file,
            'name' => $explod_arr[0],
            'download' => true,
            'extension' => $explod_arr[1],
            'path' => APP . WEBROOT_DIR . DS . 'files' . DS . 'attachements' . DS
        );

        $this->set($params);
        //debug($params);die;
    }

    public function test_mail() {
        $this->layout = null;
        $email = new CakeEmail();
        $email->config('communication_mail');
        $email->to('support@feish.online');
        // $email->viewVars(compact('fetch_data', 'verify_link','salutations'));
        $email->subject('Test subject');
        debug($email->send());
        //debug();
        die;
    }

    public function beforeFilter() {
        $this->Auth->allow(array('test_mail'));
    }

    public function send_message() {
        $this->autoRender = false;
        $sendData = $this->request->data;

        $sendData['Communication']['parent_id'] = 0;
        $sendData['Communication']['is_viewed'] = 0;
        if (isset($sendData['Communication']['Attach file'])) {
            $sendData['Communication']['is_attachment'] = 1;
            $sendData['Communication']['uploaded_files'] = $this->Communication->upload_attachment($sendData['Communication']['Attach file'], 'attachements');
        } else {
            $sendData['Communication']['is_attachment'] = 0;
        }
        $sendData['Communication']['service_id'] = NULL;
        $sendData['Communication']['user_id'] = $sendData['user_id'];
        $sendData['Communication']['reciever_user_id'] = Authcomponent::user('id');
        $sendData['Communication']['message_type'] = 1;
        unset($sendData['user_id']);
        unset($sendData['Communication']['Attach file']);
        if ($this->Communication->save($sendData)) {
            $this->Session->setFlash(__('The communication has been saved.'), 'success');
            $this->redirect(Controller::referer());
        } else {
            $this->Session->setFlash(__('The communication could not be saved. Please, try again.'), 'error');
        }
    }

    public function send_message_to_dr() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            // debug($this->request->data);die;
            $sendData = $this->request->data;
            $sendData['Communication']['parent_id'] = 0;
            $sendData['Communication']['is_viewed'] = 0;
            //$sendData['Communication']['reciever_user_id']

            if (!empty($sendData['Communication']['Attach file']['name'])) {
                $sendData['Communication']['is_attachment'] = 1;
                $sendData['Communication']['uploaded_files'] = $this->Communication->upload_attachment($sendData['Communication']['Attach file'], 'attachements');
            } else {
                $sendData['Communication']['is_attachment'] = 0;
            }
            $sendData['Communication']['user_id'] = Authcomponent::user('id');
            $sendData['Communication']['message_type'] = 2;
            $viewed_users = explode(',', $this->request->data['Communication']['reciever_user_id']);
            //debug($viewed_users);
            foreach ($viewed_users as $user) {
                $user_array[$user] = 0;
            }
            // debug($user_array);die;
            $sendData['Communication']['viewed_users'] = json_encode($user_array);
            unset($sendData['Communication']['Attach file']);
            //debug($sendData); die;
            if ($this->Communication->save($sendData)) {
                $this->Session->setFlash(__('The communication has been saved.'), 'success');
                $this->redirect(Controller::referer());
            } else {
                $this->Session->setFlash(__('The communication could not be saved. Please, try again.'), 'error');
            }
        }
    }

}
