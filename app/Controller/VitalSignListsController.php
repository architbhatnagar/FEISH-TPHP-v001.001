<?php

App::uses('AppController', 'Controller');

/**
 * VitalSignLists Controller
 *
 * @property VitalSignList $VitalSignList
 * @property PaginatorComponent $Paginator
 */
class VitalSignListsController extends AppController {

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
        $this->VitalSignList->recursive = 0;
        $this->Paginator->settings = array(
            'limit' => 10
        );
        $vitalSignLists = $this->Paginator->paginate();
        $this->set('vitalSignLists', $vitalSignLists);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->VitalSignList->exists($id)) {
            throw new NotFoundException(__('Invalid vital sign list'));
        }
        $options = array('conditions' => array('VitalSignList.' . $this->VitalSignList->primaryKey => $id));
        $this->set('vitalSignList', $this->VitalSignList->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $allVitalSigns = $this->request->data;
            foreach ($allVitalSigns['VitalSignList'] as $value) {
                $saveSigns['VitalSignList'] = $value;
                $this->VitalSignList->create();
                if ($this->VitalSignList->save($saveSigns)) {
                    $flag = true;
                } else {
                    $flag = false;
                }
            } 
            if($flag){
                $this->Session->setFlash(__('The vital sign has been saved.'),'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The vital sign could not be saved. Please, try again.'),'error');
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
        if (!$this->VitalSignList->exists($id)) {
            throw new NotFoundException(__('Invalid vital sign list'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->VitalSignList->save($this->request->data)) {
                $this->Session->setFlash(__('The vital sign list has been saved.'),'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The vital sign list could not be saved. Please, try again.'),'error');
            }
        } else {
            $options = array('conditions' => array('VitalSignList.' . $this->VitalSignList->primaryKey => $id));
            $this->request->data = $this->VitalSignList->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->VitalSignList->id = $id;
        if (!$this->VitalSignList->exists()) {
            throw new NotFoundException(__('Invalid vital sign list'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->VitalSignList->delete()) {
            $this->Session->setFlash(__('The vital sign list has been deleted.'),'success');
        } else {
            $this->Session->setFlash(__('The vital sign list could not be deleted. Please, try again.'),'error');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
