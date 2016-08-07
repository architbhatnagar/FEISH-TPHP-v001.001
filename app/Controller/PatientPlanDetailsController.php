<?php

App::uses('AppController', 'Controller');

/**
 * PatientPlanDetails Controller
 *
 * @property PatientPlanDetail $PatientPlanDetail
 * @property PaginatorComponent $Paginator
 */
class PatientPlanDetailsController extends AppController {

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
        $this->PatientPlanDetail->recursive = 0;
        $this->set('patientPlanDetails', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->PatientPlanDetail->exists($id)) {
            throw new NotFoundException(__('Invalid patient plan detail'));
        }
        $options = array('conditions' => array('PatientPlanDetail.' . $this->PatientPlanDetail->primaryKey => $id));
        $this->set('patientPlanDetail', $this->PatientPlanDetail->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->PatientPlanDetail->create();
            if ($this->PatientPlanDetail->save($this->request->data)) {
                $this->Session->setFlash(__('The patient plan detail has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The patient plan detail could not be saved. Please, try again.'));
            }
        }
        $users = $this->PatientPlanDetail->User->find('list');
        $services = $this->PatientPlanDetail->Service->find('list');
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
        if (!$this->PatientPlanDetail->exists($id)) {
            throw new NotFoundException(__('Invalid patient plan detail'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->PatientPlanDetail->save($this->request->data)) {
                $this->Session->setFlash(__('The patient plan detail has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The patient plan detail could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('PatientPlanDetail.' . $this->PatientPlanDetail->primaryKey => $id));
            $this->request->data = $this->PatientPlanDetail->find('first', $options);
        }
        $users = $this->PatientPlanDetail->User->find('list');
        $services = $this->PatientPlanDetail->Service->find('list');
        $this->set(compact('users', 'services'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->PatientPlanDetail->id = $id;
        if (!$this->PatientPlanDetail->exists()) {
            throw new NotFoundException(__('Invalid patient plan detail'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->PatientPlanDetail->delete()) {
            $this->Session->setFlash(__('The patient plan detail has been deleted.'));
        } else {
            $this->Session->setFlash(__('The patient plan detail could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function purchased_plans() {
        $this->loadModel('PatientPackageLog');
        $this->layout = 'front_layout';
        $options = array();
//        $options['conditions']['PatientPackageLog.user_id'] = Authcomponent::user('id');
        $options = array('conditions' => array('PatientPackageLog.user_id' => Authcomponent::user('id')));
        $package_list = $this->PatientPackageLog->find('all', $options);
        $this->set(compact('package_list'));
    }

    public function patient_purchased_plans($id, $user_type) {
        $this->loadModel('PatientPackageLog');
        $this->loadModel('User');
        $options = array();
        $options['conditions']['PatientPackageLog.user_id'] = $id;
        $package_list = $this->PatientPackageLog->find('all', $options);

        $user = $this->User->find('first', array('conditions' => array('User.id' => $id),'recursive'=>-1));

        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $id),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $blood_groups = Configure::read('feish.blood_groups');

        $this->set(compact('user', 'last_login', 'salutations', 'package_list','blood_groups'));
    }

    public function assistant_purchased_plans($id, $user_type) {
        $this->loadModel('PatientPackageLog');
        $this->loadModel('User');
        $options = array();
        $options['conditions']['PatientPackageLog.user_id'] = $id;
        $package_list = $this->PatientPackageLog->find('all', $options);
//        debug($package_list);die;
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id),'recursive'=>-1));

        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $blood_groups = Configure::read('feish.blood_groups');

        $this->set(compact('user', 'last_login', 'salutations', 'package_list', 'yes_no', 'blood_groups'));
    }

    public function view_plan($id = null) {
        $this->loadModel('PatientPackageLog');
        $this->layout = 'front_layout';
        if (!$this->PatientPackageLog->exists($id)) {
            throw new NotFoundException(__('Invalid patient plan detail'));
        }
        $options = array('conditions' => array('PatientPackageLog.' . $this->PatientPackageLog->primaryKey => $id));
        $package_detail = $this->PatientPackageLog->find('first', $options);

        $this->set(compact('package_detail'));
    }

    public function patient_view_plan($id = null, $user_id, $user_type) {
        $this->loadModel('PatientPackageLog');
        $this->loadModel('User');

        if (!$this->PatientPackageLog->exists($id)) {
            throw new NotFoundException(__('Invalid patient plan detail'));
        }
        $options = array('conditions' => array('PatientPackageLog.' . $this->PatientPackageLog->primaryKey => $id));
        $package_detail = $this->PatientPackageLog->find('first', $options);

        $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));

        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $user_id),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');

        $this->set(compact('user', 'last_login', 'salutations', 'package_detail'));
    }

    public function assistant_view_plan($id = null, $user_id, $user_type) {
        $this->loadModel('PatientPackageLog');
        $this->loadModel('User');

        if (!$this->PatientPackageLog->exists($id)) {
            throw new NotFoundException(__('Invalid patient plan detail'));
        }
        $options = array('conditions' => array('PatientPackageLog.' . $this->PatientPackageLog->primaryKey => $id));
        $package_detail = $this->PatientPackageLog->find('first', $options);

        $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));

        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $user_id),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');

        $this->set(compact('user', 'last_login', 'salutations', 'package_detail'));
    }

}
