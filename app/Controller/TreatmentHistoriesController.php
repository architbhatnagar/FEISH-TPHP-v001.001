<?php

App::uses('AppController', 'Controller');

/**
 * TreatmentHistories Controller
 *
 * @property TreatmentHistory $TreatmentHistory
 * @property PaginatorComponent $Paginator
 */
class TreatmentHistoriesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');
   
    public function beforeFilter() {
        $action = $this->request->action;
        $front_actions = array('index', 'view', 'add');
        if (in_array($action, $front_actions)) {
            $this->layout = 'front_layout';
        }
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->loadModel('User');
        $id = $this->Auth->user('id');
        $this->TreatmentHistory->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('TreatmentHistory.user_id' => $id),
            'limit' => 10,
            'order' => array(
                'TreatmentHistory.id' => 'desc'
            )
        );
        $treatmentHistories = $this->Paginator->paginate();
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));
        $users = array('first_name' => $user['User']['first_name'], 'last_name' => $user['User']['last_name'], 'user_id' => $user['User']['id']);
        Configure::load('feish');
        $treatment_reasons = Configure::read('feish.treatment_reasons');
        $treatment_status = Configure::read('feish.treatment_status');
        $this->set(compact('users','treatmentHistories','treatment_reasons','treatment_status'));
    }
    
    public function patient_treatment($id,$user_type) { 
         $this->loadModel('User');
         $this->loadModel('TreatmentHistory');
        $this->TreatmentHistory->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('TreatmentHistory.user_id' => $id),
            'limit' => 10,
            'order' => array(
                'TreatmentHistory.id' => 'desc'
            )
        );
        $treatmentHistories = $this->Paginator->paginate();
        
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id),'recursive'=>-1));
        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $treatment_reasons = Configure::read('feish.treatment_reasons');
        $treatment_status = Configure::read('feish.treatment_status');
        $blood_groups = Configure::read('feish.blood_groups');
        $this->set(compact('user', 'last_login', 'salutations','users','treatmentHistories','treatment_reasons','treatment_status','id','user_type','blood_groups'));
    }
    
    public function assistant_treatment($id,$user_type) { 
         $this->loadModel('User');
         $this->loadModel('TreatmentHistory');
        $this->TreatmentHistory->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('TreatmentHistory.user_id' => $id),
            'limit' => 10,
            'order' => array(
                'TreatmentHistory.id' => 'desc'
            )
        );
        $treatmentHistories = $this->Paginator->paginate();
        
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id),'recursive'=>-1));

        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $treatment_reasons = Configure::read('feish.treatment_reasons');
        $treatment_status = Configure::read('feish.treatment_status');
        $blood_groups = Configure::read('feish.blood_groups');
        $this->set(compact('user', 'last_login', 'salutations','users','treatmentHistories','treatment_reasons','treatment_status','id','user_type','blood_groups'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->TreatmentHistory->exists($id)) {
            throw new NotFoundException(__('Invalid treatment history'));
        }
        $options = array('conditions' => array('TreatmentHistory.' . $this->TreatmentHistory->primaryKey => $id));
        $this->set('treatmentHistory', $this->TreatmentHistory->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() { 
        $user_id = $this->Auth->user('id');
        $this->loadModel('Appointment');
        $this->loadModel('Procedure');
        $procedures = $this->Procedure->find('list');
        $this->TreatmentHistory->recursive = -1;
        $options = array('conditions' => array('Appointment.user_id' => $user_id, 'NOT' => array('Appointment.status' => 3)));
        $appointments = $this->Appointment->find('list', $options);
        foreach ($appointments as $key => $value) {
            $appointments[$key] = 'App-'.$value;
        }
        if ($this->request->is('post')) {
            $addData = $this->request->data;
            $this->TreatmentHistory->create();
            $addData['TreatmentHistory']['start_date'] = date("Y-m-d H:i:s",strtotime($addData['TreatmentHistory']['start_date']));
            if(!empty($addData['TreatmentHistory']['end_date'])){
                $addData['TreatmentHistory']['end_date'] = date("Y-m-d H:i:s",strtotime($addData['TreatmentHistory']['end_date']));
            }
            $addData['TreatmentHistory']['parent_treatment'] = '0';
            $addData['TreatmentHistory']['user_id'] = $user_id;
            $flag = $this->TreatmentHistory->save($addData);
            if ($flag) {
                $this->Session->setFlash(__('The treatment history has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The treatment history could not be saved. Please, try again.'));
            }
        }
        $users = $this->TreatmentHistory->User->find('list');
        $this->set(compact('users','appointments','procedures'));
    }
    
    public function patient_add_treatment($id,$user_type) { 
        $user_id = $this->Auth->user('id');
        $this->loadModel('Appointment');
        $this->loadModel('Procedure');
        $this->loadModel('User');
        $procedures = $this->Procedure->find('list');
        $this->TreatmentHistory->recursive = -1;
        $options = array('conditions' => array('Appointment.user_id' => $id, 'NOT' => array('Appointment.status' => 3)));
        $appointments = $this->Appointment->find('list', $options);
        foreach ($appointments as $key => $value) {
            $appointments[$key] = 'App-'.$value;
        }
        if ($this->request->is('post')) {
            $addData = $this->request->data;
            $this->TreatmentHistory->create();
            $addData['TreatmentHistory']['start_date'] = date("Y-m-d H:i:s",strtotime($addData['TreatmentHistory']['start_date']));
            if(!empty($addData['TreatmentHistory']['end_date'])){
                $addData['TreatmentHistory']['end_date'] = date("Y-m-d H:i:s",strtotime($addData['TreatmentHistory']['end_date']));
            }
            $addData['TreatmentHistory']['parent_treatment'] = '0';
            $addData['TreatmentHistory']['user_id'] = $id;
            $flag = $this->TreatmentHistory->save($addData);
            if ($flag) {
                $this->Session->setFlash(__('The treatment history has been saved.'),'success');
                return $this->redirect(array('action' => 'patient_treatment',$id,$user_type));
            } else {
                $this->Session->setFlash(__('The treatment history could not be saved. Please, try again.'),'error');
                return $this->redirect(array('action' => 'patient_treatment',$id,$user_type));
            }
        }
        
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
        
        $users = $this->TreatmentHistory->User->find('list');
        $this->set(compact('users','appointments','procedures','user','last_login','salutations','id','user_type'));
    }
    
    public function assistant_add_treatment($id,$user_type) { 
        $user_id = $this->Auth->user('id');
        $this->loadModel('Appointment');
        $this->loadModel('Procedure');
        $this->loadModel('User');
        $procedures = $this->Procedure->find('list');
        $this->TreatmentHistory->recursive = -1;
        $options = array('conditions' => array('Appointment.user_id' => $id, 'NOT' => array('Appointment.status' => 3)));
        $appointments = $this->Appointment->find('list', $options);
        foreach ($appointments as $key => $value) {
            $appointments[$key] = 'App-'.$value;
        }
        if ($this->request->is('post')) {
            $addData = $this->request->data;
            $this->TreatmentHistory->create();
            $addData['TreatmentHistory']['start_date'] = date("Y-m-d H:i:s",strtotime($addData['TreatmentHistory']['start_date']));
            if(!empty($addData['TreatmentHistory']['end_date'])){
                $addData['TreatmentHistory']['end_date'] = date("Y-m-d H:i:s",strtotime($addData['TreatmentHistory']['end_date']));
            }
            $addData['TreatmentHistory']['parent_treatment'] = '0';
            $addData['TreatmentHistory']['user_id'] = $id;
            $flag = $this->TreatmentHistory->save($addData);
            if ($flag) {
                $this->Session->setFlash(__('The treatment history has been saved.'),'success');
                return $this->redirect(array('action' => 'assistant_treatment',$id,$user_type));
            } else {
                $this->Session->setFlash(__('The treatment history could not be saved. Please, try again.'),'error');
                return $this->redirect(array('action' => 'assistant_treatment',$id,$user_type));
            }
        }
        
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
        
        $users = $this->TreatmentHistory->User->find('list');
        $this->set(compact('users','appointments','procedures','user','last_login','salutations','id','user_type'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->TreatmentHistory->exists($id)) {
            throw new NotFoundException(__('Invalid treatment history'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->TreatmentHistory->save($this->request->data)) {
                $this->Session->setFlash(__('The treatment history has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The treatment history could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('TreatmentHistory.' . $this->TreatmentHistory->primaryKey => $id));
            $this->request->data = $this->TreatmentHistory->find('first', $options);
        }
        $users = $this->TreatmentHistory->User->find('list');
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
        $this->TreatmentHistory->id = $id;
        if (!$this->TreatmentHistory->exists()) {
            throw new NotFoundException(__('Invalid treatment history'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->TreatmentHistory->delete()) {
            $this->Session->setFlash(__('The treatment history has been deleted.'));
        } else {
            $this->Session->setFlash(__('The treatment history could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function add_status() {
        if ($this->request->is('post')) {
            $addData = $this->request->data;
            $addData['TreatmentHistory']['user_id'] = $this->Auth->user('id');
            $this->TreatmentHistory->id = $addData['TreatmentHistory']['id'];
            $flag = $this->TreatmentHistory->save($addData);
            if ($flag) {
                $this->Session->setFlash(__('The treatment history has been saved.'));
                return $this->redirect(Router::url( $this->referer(), true ));
            } else {
                $this->Session->setFlash(__('The treatment history could not be saved. Please, try again.'));
            }
        }
    }
    
    public function patient_add_status() {
        if ($this->request->is('post')) {
            
            $addData = $this->request->data;
            $addData['TreatmentHistory']['user_id'] = $this->request->data['patient_id'];
            $this->TreatmentHistory->id = $addData['TreatmentHistory']['id'];
            $flag = $this->TreatmentHistory->save($addData);
            if ($flag) {
                $this->Session->setFlash(__('The treatment history has been saved.'),'success');
                return $this->redirect(Router::url( $this->referer(), true ));
            } else {
                $this->Session->setFlash(__('The treatment history could not be saved. Please, try again.'),'error');
            }
        }
    }
    
    public function get_status_data(){
        $this->autoRender = false;
        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];
        }
        $options = array('conditions' => array('TreatmentHistory.id' => $id), 'fields' => array('TreatmentHistory.id','TreatmentHistory.description','TreatmentHistory.status','TreatmentHistory.reason'));
        $returnData = $this->TreatmentHistory->find('first', $options);
        echo json_encode($returnData['TreatmentHistory']);
    }
}
