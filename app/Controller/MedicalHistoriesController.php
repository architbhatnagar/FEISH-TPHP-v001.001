<?php

App::uses('AppController', 'Controller');

/**
 * MedicalHistories Controller
 *
 * @property MedicalHistory $MedicalHistory
 * @property PaginatorComponent $Paginator
 */
class MedicalHistoriesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    public function beforeFilter() {
        $action = $this->request->action;
        $front_actions = array('index', 'view','patients_listing','patient_details');
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
        $this->loadModel('MedicalCondition');
        $this->MedicalHistory->recursive = 0;
        $this->paginate = array(
            'conditions' => array('MedicalHistory.user_id' => Authcomponent::user('id')),
            'order' => 'MedicalHistory.id DESC',
            'fields' => array('MedicalHistory.id', 'MedicalHistory.conditions', 'MedicalHistory.condition_type', 'MedicalHistory.mh_date', 'MedicalHistory.current_medication', 'MedicalHistory.description', 'MedicalCondition.name'),
            'limit' => 50
        );
        $medicalHistories = $this->Paginator->paginate();
        
        $medicalConditionList = array();
        $medicalConditionList = $this->MedicalCondition->find('list', array('feilds' => array('MedicalCondition.id', 'MedicalCondition.name')));
        
//        foreach ($medicalCondition as $key => $value) {
////            debug($value['MedicalCondition']['name']);
//            array_push($medicalConditionList, $value['MedicalCondition']['name']);
//        }
        
        $this->set('medicalHistories', $medicalHistories);
        $this->set('medicalConditionList', $medicalConditionList);
    }
    
    public function patient_medical_history($id,$user_type) { 
        $this->loadModel('MedicalCondition');
        $this->loadModel('User');
        $this->MedicalHistory->recursive = 0;
        $this->paginate = array(
            'conditions' => array('MedicalHistory.user_id' => $id),
            'order' => 'MedicalHistory.id DESC',
            'fields' => array('MedicalHistory.id', 'MedicalHistory.conditions', 'MedicalHistory.condition_type', 'MedicalHistory.mh_date', 'MedicalHistory.current_medication', 'MedicalHistory.description', 'MedicalCondition.name'),
            'limit' => 10
        );
        $medicalHistories = $this->Paginator->paginate();
        $medicalConditionList = array();
        $medicalConditionList = $this->MedicalCondition->find('list', array('feilds' => array('MedicalCondition.id', 'MedicalCondition.name')));
//        foreach ($medicalCondition as $key => $value) {
//            array_push($medicalConditionList, $value['MedicalCondition']['name']);
//        }
        
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id),'recursive'=>-1));

       
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $blood_groups = Configure::read('feish.blood_groups');
        $this->set(compact('user','salutations','medicalHistories','medicalConditionList','id','user_type','blood_groups'));
    }
    
     public function assistant_medical_history($id,$user_type) { 
        $this->loadModel('MedicalCondition');
        $this->loadModel('User');
        $this->MedicalHistory->recursive = 0;
        $this->paginate = array(
            'conditions' => array('MedicalHistory.user_id' => $id),
            'order' => 'MedicalHistory.id DESC',
            'fields' => array('MedicalHistory.id', 'MedicalHistory.conditions', 'MedicalHistory.condition_type', 'MedicalHistory.mh_date', 'MedicalHistory.current_medication', 'MedicalHistory.description', 'MedicalCondition.name'),
            'limit' => 10
        );
        $medicalHistories = $this->Paginator->paginate();
        $medicalConditionList = array();
        $medicalConditionList = $this->MedicalCondition->find('list', array('feilds' => array('MedicalCondition.id', 'MedicalCondition.name')));
//        foreach ($medicalCondition as $key => $value) {
//            array_push($medicalConditionList, $value['MedicalCondition']['name']);
//        }
        
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id),'recursive'=>-1));

        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $blood_groups = Configure::read('feish.blood_groups');
        
         $this->set(compact('user', 'last_login', 'salutations','medicalHistories','medicalConditionList','id','user_type','blood_groups'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->MedicalHistory->exists($id)) {
            throw new NotFoundException(__('Invalid medical history'));
        }
        $options = array('conditions' => array('MedicalHistory.' . $this->MedicalHistory->primaryKey => $id));
        $this->set('medicalHistory', $this->MedicalHistory->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->MedicalHistory->create();
            if ($this->MedicalHistory->save($this->request->data)) {
                $this->Session->setFlash(__('The medical history has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The medical history could not be saved. Please, try again.'));
            }
        }
        $users = $this->MedicalHistory->User->find('list');
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
        if (!$this->MedicalHistory->exists($id)) {
            throw new NotFoundException(__('Invalid medical history'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->MedicalHistory->save($this->request->data)) {
                $this->Session->setFlash(__('The medical history has been saved.'),'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The medical history could not be saved. Please, try again.'),'error');
            }
        } else {
            $options = array('conditions' => array('MedicalHistory.' . $this->MedicalHistory->primaryKey => $id));
            $this->request->data = $this->MedicalHistory->find('first', $options);
        }
        $users = $this->MedicalHistory->User->find('list');
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
        $this->MedicalHistory->id = $id;
        if (!$this->MedicalHistory->exists()) {
            throw new NotFoundException(__('Invalid medical history'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->MedicalHistory->delete()) {
            $this->Session->setFlash(__('The medical history has been deleted.'));
        } else {
            $this->Session->setFlash(__('The medical history could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function update_medical_history() {
        
        if ($this->request->is(array('post', 'put'))) {
            $requestData = $this->request->data;
            $id = $requestData['MedicalHistory']['id'];
            if (!$this->MedicalHistory->exists($id)) {
                $this->MedicalHistory->create();
            } else {
                $this->MedicalHistory->id = $id;
            }
            $requestData['MedicalHistory']['user_id'] = Authcomponent::user('id');
            $requestData['MedicalHistory']['mh_date'] = date("Y-m-d H:i:s",strtotime($requestData['MedicalHistory']['mh_date']));
            $requestData['MedicalHistory']['conditions'] = $requestData['MedicalHistory']['conditions'] ;
            if ($this->MedicalHistory->save($requestData)) {
                $this->Session->setFlash(__('The medical history has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The medical history could not be saved. Please, try again.'));
                return $this->redirect(array('action' => 'index'));
            }
        } else {
            $options = array('conditions' => array('MedicalHistory.' . $this->MedicalHistory->primaryKey => $id));
            $this->request->data = $this->MedicalHistory->find('first', $options);
        }
        $users = $this->MedicalHistory->User->find('list');
        $this->set(compact('users'));
    }
    
    public function patient_update_medical_history() {
        
        $this->loadModel('MedicalHistory');
        
        if ($this->request->is(array('post', 'put'))) {
            
            $requestData = $this->request->data;
            $id = $requestData['MedicalHistory']['id'];
            if (!$this->MedicalHistory->exists($id)) {
                $this->MedicalHistory->create();
            } else {
                $this->MedicalHistory->id = $id;
            }
            $requestData['MedicalHistory']['user_id'] = $this->request->data['user_id'];
            $requestData['MedicalHistory']['mh_date'] = date("Y-m-d H:i:s",strtotime($requestData['MedicalHistory']['mh_date']));
            $requestData['MedicalHistory']['conditions'] = $requestData['MedicalHistory']['conditions'];
            if ($this->MedicalHistory->save($requestData)) {
                $this->Session->setFlash(__('The medical history has been saved.'),'success');
                return $this->redirect(array('action' => 'patient_medical_history',$this->request->data['user_id'],$this->request->data['user_type']));
            } else {
                $this->Session->setFlash(__('The medical history could not be saved. Please, try again.'),'success');
                return $this->redirect(array('action' => 'patient_medical_history',$this->request->data['user_id'],$this->request->data['user_type']));
            }
        } else {
            $options = array('conditions' => array('MedicalHistory.' . $this->MedicalHistory->primaryKey => $id));
            $this->request->data = $this->MedicalHistory->find('first', $options);
        }
        $users = $this->MedicalHistory->User->find('list');
        $this->set(compact('users'));
    }
    
    public function assistant_update_medical_history() {
        
        $this->loadModel('MedicalHistory');
        
        if ($this->request->is(array('post', 'put'))) {
            
            $requestData = $this->request->data;
            $id = $requestData['MedicalHistory']['id'];
            if (!$this->MedicalHistory->exists($id)) {
                $this->MedicalHistory->create();
            } else {
                $this->MedicalHistory->id = $id;
            }
            $requestData['MedicalHistory']['user_id'] = $this->request->data['user_id'];
            $requestData['MedicalHistory']['mh_date'] = date("Y-m-d H:i:s",strtotime($requestData['MedicalHistory']['mh_date']));
            $requestData['MedicalHistory']['conditions'] = $requestData['MedicalHistory']['conditions'];
            if ($this->MedicalHistory->save($requestData)) {
                $this->Session->setFlash(__('The medical history has been saved.'),'success');
                return $this->redirect(array('action' => 'assistant_medical_history',$this->request->data['user_id'],$this->request->data['user_type']));
            } else {
                $this->Session->setFlash(__('The medical history could not be saved. Please, try again.'),'success');
                return $this->redirect(array('action' => 'assistant_medical_history',$this->request->data['user_id'],$this->request->data['user_type']));
            }
        } else {
            $options = array('conditions' => array('MedicalHistory.' . $this->MedicalHistory->primaryKey => $id));
            $this->request->data = $this->MedicalHistory->find('first', $options);
        }
        $users = $this->MedicalHistory->User->find('list');
        $this->set(compact('users'));
    }

    public function get_medical_history_byid() {
        $this->autoRender = false;
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];
        }
        if (!$this->MedicalHistory->exists($id)) {
            throw new NotFoundException(__('Invalid medical history'));
        }
        $options = array('conditions' => array('MedicalHistory.' . $this->MedicalHistory->primaryKey => $id));
        $medicalHistory = $this->MedicalHistory->find('first', $options);
//        debug($medicalHistory['MedicalHistory']['mh_date']); 
        $medicalHistory['MedicalHistory']['mh_date'] = date('m/d/Y', strtotime($medicalHistory['MedicalHistory']['mh_date']));
//        die;
        echo json_encode($medicalHistory);
    }

    public function patients_listing() {
          $conditions = array();
          $conditions['MedicalHistory.user_id NOT']=$this->Auth->user('id');
        if($this->request->is('post')){
           // debug($this->request->data);die;
             if(($this->request->data['MedicalHistory']['conditions']!=0)){
                  $conditions['MedicalHistory.conditions']=$this->request->data['MedicalHistory']['conditions'];
            }
          
            if(!empty($this->request->data['MedicalHistory']['search_text'])){
               $conditions['MedicalHistory.description LIKE']="%".$this->request->data['MedicalHistory']['search_text']."%"; 
            }
        }
       //debug($conditions);die;
        $this->loadModel('User');
        $this->loadModel('MedicalCondition');
        $id = Authcomponent::user('id');
        $this->MedicalHistory->recursive = -1;
        
        //$medicalConditionList = array();
        $medicalConditionList = $this->MedicalCondition->find('list', array('fields' => array('MedicalCondition.id', 'MedicalCondition.name')));
        $this->set('medicalConditionList', $medicalConditionList);
        $this->MedicalHistory->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'order' => 'MedicalHistory.id DESC',
            'group' => 'MedicalHistory.user_id',
            'limit' => 10
        );
        $patientListings = $this->Paginator->paginate();
     // debug($patientListings);
        $this->set('patientListings', $patientListings);
    }
    
    public function patient_details($id = null){
        $this->loadModel('UserDetail');
        $this->loadModel('User');
        if (!$this->MedicalHistory->exists($id)) {
            throw new NotFoundException(__('Invalid patient'));
        }
        $options = array('conditions' => array('MedicalHistory.' . $this->MedicalHistory->primaryKey => $id));
        $patientDetails = $this->MedicalHistory->find('first', $options);
//        debug($patientDetails); 
        
        $options = array('conditions' => array('UserDetail.user_id' => $patientDetails['User']['id']));
        $userDetails = $this->UserDetail->find('first', $options);
        
        $options = array('conditions' => array('MedicalHistory.user_id' => $patientDetails['User']['id']));
        $patientDescs = $this->MedicalHistory->find('all', $options);
        
        $options = array('conditions' => array('User.id' => $patientDetails['User']['id']));
        $users = $this->User->find('first', $options);
//        debug($users);
//        die;
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $maritalStatus = Configure::read('feish.marital_status');
        $this->set(compact('patientDetails', 'salutations', 'maritalStatus', 'users', 'patientDescs', 'userDetails'));
    }
}