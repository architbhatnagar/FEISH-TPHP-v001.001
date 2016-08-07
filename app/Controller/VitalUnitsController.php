<?php

App::uses('AppController', 'Controller');

/**
 * VitalUnits Controller
 *
 * @property VitalUnit $VitalUnit
 * @property PaginatorComponent $Paginator
 */
class VitalUnitsController extends AppController {

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
        $this->VitalUnit->recursive = 0;
        $this->Paginator->settings = array(
            'limit' => 10
        );
        $vitalUnits = $this->Paginator->paginate();
        $this->set('vitalUnits', $vitalUnits);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->VitalUnit->exists($id)) {
            throw new NotFoundException(__('Invalid vital unit'));
        }
        $options = array('conditions' => array('VitalUnit.' . $this->VitalUnit->primaryKey => $id));
        $this->set('vitalUnit', $this->VitalUnit->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $allVitalUnits = $this->request->data;
            foreach ($allVitalUnits['VitalUnit'] as $value) {
                $saveUnit['VitalUnit'] = $value;
                $this->VitalUnit->create();
                if ($this->VitalUnit->save($saveUnit)) {
                    $flag = true;
                } else {
                    $flag = false;
                }
            } 
            if($flag){
                $this->Session->setFlash(__('The vital unit has been saved.'),'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The vital unit could not be saved. Please, try again.'),'error');
            }
        }
        $vitalSignLists = $this->VitalUnit->VitalSignList->find('list');
        $this->set(compact('vitalSignLists'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->VitalUnit->exists($id)) {
            throw new NotFoundException(__('Invalid vital unit'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->VitalUnit->save($this->request->data)) {
                $this->Session->setFlash(__('The vital unit has been saved.'),'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The vital unit could not be saved. Please, try again.'),'error');
            }
        } else {
            $options = array('conditions' => array('VitalUnit.' . $this->VitalUnit->primaryKey => $id));
            $this->request->data = $this->VitalUnit->find('first', $options);
        }
        $vitalSignLists = $this->VitalUnit->VitalSignList->find('list');
        $this->set(compact('vitalSignLists'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->VitalUnit->id = $id;
        if (!$this->VitalUnit->exists()) {
            throw new NotFoundException(__('Invalid vital unit'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->VitalUnit->delete()) {
            $this->Session->setFlash(__('The vital unit has been deleted.'),'success');
        } else {
            $this->Session->setFlash(__('The vital unit could not be deleted. Please, try again.'),'error');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
