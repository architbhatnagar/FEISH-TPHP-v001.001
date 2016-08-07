<?php

App::uses('AppController', 'Controller');

/**
 * VitalSigns Controller
 *
 * @property VitalSign $VitalSign
 * @property PaginatorComponent $Paginator
 */
class VitalSignsController extends AppController {

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
        $this->loadModel('VitalSignList');
        $this->loadModel('VitalUnit');
        $this->VitalSign->recursive = 0;
        $userId = $this->Auth->user('id');
        //   $this->recursive = 0;
        if (!empty($userId)) {
            $this->paginate = array(
                'conditions' => array('VitalSign.user_id' => Authcomponent::user('id')),
                'order' => 'VitalSign.id DESC',
                'limit' => 10
            );
        } else {
            $this->paginate = array(
                'order' => 'VitalSign.id DESC',
                'limit' => 10
            );
        }

        $vitalSigns = $this->Paginator->paginate();
        $vitalSignsList = array();
//        $signsList = $this->VitalSignList->find('list', array('feilds' => array('VitalSignList.id', 'VitalSignList.name')));
        $vitalSignsList = $this->VitalSignList->find('list', array('feilds' => array('VitalSignList.id', 'VitalSignList.name')));

        $vitalUnit = array();
        $unitList = $this->VitalUnit->find('all', array('feilds' => array('VitalUnit.id', 'VitalUnit.name')));
        foreach ($unitList as $key => $value) {
            array_push($vitalUnit, $value['VitalUnit']['name']);
        }

        $this->set('vitalSignsList', $vitalSignsList);
        $this->set('vitalUnit', $vitalUnit);
        $this->set('vitalSigns', $vitalSigns);
    }

    public function patient_vital_signs($id, $user_type) {
        $this->loadModel('VitalSignList');
        $this->loadModel('VitalUnit');
        $this->loadModel('User');
        $this->VitalSign->recursive = 0;

        $this->recursive = 0;
        if (!empty($id)) {
            $this->paginate = array(
                'conditions' => array('VitalSign.user_id' => $id),
                'order' => 'VitalSign.id DESC',
                'limit' => 10
            );
        } else {
            $this->paginate = array(
                'order' => 'VitalSign.id DESC',
                'limit' => 10
            );
        }


        $vitalSigns = $this->Paginator->paginate();

        $vitalSignsList = array();
//        $signsList = $this->VitalSignList->find('list', array('feilds' => array('VitalSignList.id', 'VitalSignList.name')));
        $vitalSignsList = $this->VitalSignList->find('list', array('feilds' => array('VitalSignList.id', 'VitalSignList.name')));

//        foreach ($signsList as $key => $value) {
//            array_push($vitalSignsList, $value['VitalSignList']['name']);
//        }
//        debug($vitalSignsList);die;
        $vitalUnit = array();
        $unitList = $this->VitalUnit->find('all', array('feilds' => array('VitalUnit.id', 'VitalUnit.name')));
        foreach ($unitList as $key => $value) {
            array_push($vitalUnit, $value['VitalUnit']['name']);
        }
        
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id),'recursive'=>-1));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $blood_groups = Configure::read('feish.blood_groups');
        
        $this->set(compact('user', 'salutations', 'vitalSignsList', 'vitalUnit', 'vitalSigns', 'id', 'user_type','blood_groups'));
    }

    public function assistant_vital_signs($id, $user_type) {
        $this->loadModel('VitalSignList');
        $this->loadModel('VitalUnit');
        $this->loadModel('User');
        $this->VitalSign->recursive = 0;

        $this->recursive = 0;
        if (!empty($id)) {
            $this->paginate = array(
                'conditions' => array('VitalSign.user_id' => $id),
                'order' => 'VitalSign.id DESC',
                'limit' => 10
            );
        } else {
            $this->paginate = array(
                'order' => 'VitalSign.id DESC',
                'limit' => 10
            );
        }


        $vitalSigns = $this->Paginator->paginate();

        $vitalSignsList = array();
        $vitalSignsList = $this->VitalSignList->find('list', array('feilds' => array('VitalSignList.id', 'VitalSignList.name')));
//        $vitalSignsList = array();
//        $signsList = $this->VitalSignList->find('all', array('feilds' => array('VitalSignList.id', 'VitalSignList.name')));
//        foreach ($signsList as $key => $value) {
//            array_push($vitalSignsList, $value['VitalSignList']['name']);
//        }
        $vitalUnit = array();
        $unitList = $this->VitalUnit->find('all', array('feilds' => array('VitalUnit.id', 'VitalUnit.name')));
        foreach ($unitList as $key => $value) {
            array_push($vitalUnit, $value['VitalUnit']['name']);
        }

        $user = $this->User->find('first', array('conditions' => array('User.id' => $id),'recursive'=>-1));

        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $blood_groups = Configure::read('feish.blood_groups');

        $this->set(compact('user', 'last_login', 'salutations', 'vitalSignsList', 'vitalUnit', 'vitalSigns', 'id', 'user_type', 'yes_no', 'blood_groups'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->VitalSign->exists($id)) {
            throw new NotFoundException(__('Invalid vital sign'));
        }
        $options = array('conditions' => array('VitalSign.' . $this->VitalSign->primaryKey => $id));
        $this->set('vitalSign', $this->VitalSign->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->VitalSign->create();
            if ($this->VitalSign->save($this->request->data)) {
                $this->Session->setFlash(__('The vital sign has been saved.'),'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The vital sign could not be saved. Please, try again.'),'error');
            }
        }
        $users = $this->VitalSign->User->find('list');
        $vitalSignLists = $this->VitalSign->VitalSignList->find('list');
        $this->set(compact('users', 'vitalSignLists'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->VitalSign->exists($id)) {
            throw new NotFoundException(__('Invalid vital sign'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->VitalSign->save($this->request->data)) {
                $this->Session->setFlash(__('The vital sign has been saved.'),'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The vital sign could not be saved. Please, try again.'),'error');
            }
        } else {
            $options = array('conditions' => array('VitalSign.' . $this->VitalSign->primaryKey => $id));
            $this->request->data = $this->VitalSign->find('first', $options);
        }
        $users = $this->VitalSign->User->find('list');
        $vitalSignLists = $this->VitalSign->VitalSignList->find('list');
        $this->set(compact('users', 'vitalSignLists'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->VitalSign->id = $id;
        if (!$this->VitalSign->exists()) {
            throw new NotFoundException(__('Invalid vital sign'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->VitalSign->delete()) {
            $this->Session->setFlash(__('The vital sign has been deleted.'),'success');
        } else {
            $this->Session->setFlash(__('The vital sign could not be deleted. Please, try again.'),'error');
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function update_vital_sign() {
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['VitalSign']['user_id'] = Authcomponent::user('id');
            $requestData = $this->request->data;
            $id = $requestData['VitalSign']['id'];
            if (!$this->VitalSign->exists($id)) {
                $this->VitalSign->create();
            } else {
                $this->VitalSign->id = $id;
            }
            $requestData['VitalSign']['vital_sign_list_id'] = $requestData['VitalSign']['vital_sign_list_id'];
            if ($this->VitalSign->save($requestData)) {
                $this->Session->setFlash(__('The Vital Sign has been saved.'),'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The vital sign could not be saved. Please, try again.'),'error');
                return $this->redirect(array('action' => 'index'));
            }
        } else {
            $options = array('conditions' => array('VitalSign.' . $this->VitalSign->primaryKey => $id));
            $this->request->data = $this->VitalSign->find('first', $options);
        }
        $users = $this->VitalSign->User->find('list');
        $this->set(compact('users'));
    }

    public function patient_update_vital_sign() {
        $this->loadModel('VitalSignList');
        $this->loadModel('VitalUnit');
        $this->loadModel('User');

        if ($this->request->is(array('post', 'put'))) {

            $this->request->data['VitalSign']['user_id'] = $this->request->data['user_id'];
            $requestData = $this->request->data;

            $id = $requestData['VitalSign']['id'];
            if (!$this->VitalSign->exists($id)) {
                $this->VitalSign->create();
            } else {
                $this->VitalSign->id = $id;
            }
            $requestData['VitalSign']['vital_sign_list_id'] = $requestData['VitalSign']['vital_sign_list_id'];
            if ($this->VitalSign->save($requestData)) {
                $this->Session->setFlash(__('The Vital Sign has been saved.'), 'success');
                return $this->redirect(array('action' => 'patient_vital_signs', $this->request->data['user_id'], $this->request->data['user_type']));
            } else {
                $this->Session->setFlash(__('The vital sign could not be saved. Please, try again.'), 'error');
                return $this->redirect(array('action' => 'patient_vital_signs', $this->request->data['user_id'], $this->request->data['user_type']));
            }
        } else {
            $options = array('conditions' => array('VitalSign.' . $this->VitalSign->primaryKey => $id));
            $this->request->data = $this->VitalSign->find('first', $options);
        }
        $users = $this->VitalSign->User->find('list');
        $this->set(compact('users'));
    }

    public function assistant_update_vital_sign() {
        $this->loadModel('VitalSignList');
        $this->loadModel('VitalUnit');
        $this->loadModel('User');

        if ($this->request->is(array('post', 'put'))) {

            $this->request->data['VitalSign']['user_id'] = $this->request->data['user_id'];
            $requestData = $this->request->data;

            $id = $requestData['VitalSign']['id'];
            if (!$this->VitalSign->exists($id)) {
                $this->VitalSign->create();
            } else {
                $this->VitalSign->id = $id;
            }
            $requestData['VitalSign']['vital_sign_list_id'] = $requestData['VitalSign']['vital_sign_list_id'];
            if ($this->VitalSign->save($requestData)) {
                $this->Session->setFlash(__('The Vital Sign has been saved.'), 'success');
                return $this->redirect(array('action' => 'assistant_vital_signs', $this->request->data['user_id'], $this->request->data['user_type']));
            } else {
                $this->Session->setFlash(__('The vital sign could not be saved. Please, try again.'), 'error');
                return $this->redirect(array('action' => 'assistant_vital_signs', $this->request->data['user_id'], $this->request->data['user_type']));
            }
        } else {
            $options = array('conditions' => array('VitalSign.' . $this->VitalSign->primaryKey => $id));
            $this->request->data = $this->VitalSign->find('first', $options);
        }
        $users = $this->VitalSign->User->find('list');
        $this->set(compact('users'));
    }

    public function get_vital_sign_byid() {
        $this->autoRender = false;
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];
        }
//        debug($id); die;
        if (!$this->VitalSign->exists($id)) {
            throw new NotFoundException(__('Invalid medical history'));
        }
        $options = array('conditions' => array('VitalSign.' . $this->VitalSign->primaryKey => $id));
        $vitalSign = $this->VitalSign->find('first', $options);
        echo json_encode($vitalSign);
    }

    public function change_unit() {
        $this->autoRender = false;
        $this->loadModel('VitalUnit');
        if (isset($_POST['unit']) && !empty($_POST['unit'])) {
            $id = $_POST['unit'];
        }
//        debug($_POST); die;
        $options = array('conditions' => array('VitalUnit.vital_sign_list_id' => $id));
        $vitalUnit = $this->VitalUnit->find('all', $options);
//        echo '<pre>';print_r($vitalUnit);die;
        $returnArr = array();
        foreach ($vitalUnit as $value) {
//            debug($value['VitalUnit']);
            array_push($returnArr, $value['VitalUnit']);
        }
        echo json_encode($returnArr);
    }

}
