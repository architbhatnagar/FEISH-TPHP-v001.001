<?php

App::uses('AppController', 'Controller');

/**
 * MedicalConditions Controller
 *
 * @property MedicalCondition $MedicalCondition
 * @property PaginatorComponent $Paginator
 */
class MedicalConditionsController extends AppController {

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
        $this->MedicalCondition->recursive = 0;
        $this->Paginator->settings = array(
            'limit' => 10
        );
        $medicalConditions = $this->Paginator->paginate();
        $this->set('medicalConditions', $medicalConditions);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->MedicalCondition->exists($id)) {
            throw new NotFoundException(__('Invalid medical condition'));
        }
        $options = array('conditions' => array('MedicalCondition.' . $this->MedicalCondition->primaryKey => $id));
        $this->set('medicalCondition', $this->MedicalCondition->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $medicalCondition = $this->request->data;
            foreach ($medicalCondition['MedicalCondition'] as $value) {
                $saveMedicalCondition['MedicalCondition'] = $value;
                $this->MedicalCondition->create();
                if ($this->MedicalCondition->save($saveMedicalCondition)) {
                    $flag = true;
                } else {
                    $flag = false;
                }
            } 
            if($flag){
                $this->Session->setFlash(__('The medical condition has been saved.'),'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The medical condition could not be saved. Please, try again.'),'error');
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
        if (!$this->MedicalCondition->exists($id)) {
            throw new NotFoundException(__('Invalid medical condition'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->MedicalCondition->save($this->request->data)) {
                $this->Session->setFlash(__('The medical condition has been saved.'), 'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The medical condition could not be saved. Please, try again.'), 'error');
            }
        } else {
            $options = array('conditions' => array('MedicalCondition.' . $this->MedicalCondition->primaryKey => $id));
            $this->request->data = $this->MedicalCondition->find('first', $options);
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
        $this->MedicalCondition->id = $id;
        if (!$this->MedicalCondition->exists()) {
            throw new NotFoundException(__('Invalid medical condition'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->MedicalCondition->delete()) {
            $this->Session->setFlash(__('The medical condition has been deleted.'), 'success');
        } else {
            $this->Session->setFlash(__('The medical condition could not be deleted. Please, try again.'), 'error');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
