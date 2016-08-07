<?php

App::uses('AppController', 'Controller');

/**
 * DoctorPlanDetails Controller
 *
 * @property DoctorPlanDetail $DoctorPlanDetail
 * @property PaginatorComponent $Paginator
 */
class DoctorPlanDetailsController extends AppController {

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
        $this->DoctorPlanDetail->recursive = 0;
        $this->set('doctorPlanDetails', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        
            
        $doctorPlanDetail=$this->DoctorPlanDetail->find('first', array('conditions'=>array('DoctorPlanDetail.user_id'=>$id)));
        $this->loadModel('User');
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));
        // print_r($user);die;
        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $id),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
         $salutations = Configure::read('feish.salutations');
        // debug($last_login);die;

        $this->set(compact('user', 'last_login', 'yes_no', 'doctorPlanDetail','salutations'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->DoctorPlanDetail->create();
            if ($this->DoctorPlanDetail->save($this->request->data)) {
                $this->Session->setFlash(__('The doctor plan detail has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The doctor plan detail could not be saved. Please, try again.'));
            }
        }
        $users = $this->DoctorPlanDetail->User->find('list');
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
        if (!$this->DoctorPlanDetail->exists($id)) {
            throw new NotFoundException(__('Invalid doctor plan detail'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->DoctorPlanDetail->save($this->request->data)) {
                $this->Session->setFlash(__('The doctor plan detail has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The doctor plan detail could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('DoctorPlanDetail.' . $this->DoctorPlanDetail->primaryKey => $id));
            $this->request->data = $this->DoctorPlanDetail->find('first', $options);
        }
        $users = $this->DoctorPlanDetail->User->find('list');
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
        $this->DoctorPlanDetail->id = $id;
        if (!$this->DoctorPlanDetail->exists()) {
            throw new NotFoundException(__('Invalid doctor plan detail'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->DoctorPlanDetail->delete()) {
            $this->Session->setFlash(__('The doctor plan detail has been deleted.'));
        } else {
            $this->Session->setFlash(__('The doctor plan detail could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
