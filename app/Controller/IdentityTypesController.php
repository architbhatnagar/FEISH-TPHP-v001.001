<?php

App::uses('AppController', 'Controller');

/**
 * IdentityTypes Controller
 *
 * @property IdentityType $IdentityType
 * @property PaginatorComponent $Paginator
 */
class IdentityTypesController extends AppController {

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
        $this->IdentityType->recursive = 0;
        $this->set('identityTypes', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->IdentityType->exists($id)) {
            throw new NotFoundException(__('Invalid identity type'));
        }
        $options = array('conditions' => array('IdentityType.' . $this->IdentityType->primaryKey => $id));
        $this->set('identityType', $this->IdentityType->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $identityType = $this->request->data;
            foreach ($identityType['IdentityType'] as $value) {
                $saveIdentity['IdentityType'] = $value;
                $this->IdentityType->create();
                if ($this->IdentityType->save($saveIdentity)) {
                    $flag = true;
                } else {
                    $flag = false;
                }
            } 
            if($flag){
                $this->Session->setFlash(__('The Identity type has been saved.'),'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Identity type could not be saved. Please, try again.'),'error');
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
        if (!$this->IdentityType->exists($id)) {
            throw new NotFoundException(__('Invalid identity type'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->IdentityType->save($this->request->data)) {
                $this->Session->setFlash(__('The identity type has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The identity type could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('IdentityType.' . $this->IdentityType->primaryKey => $id));
            $this->request->data = $this->IdentityType->find('first', $options);
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
        $this->IdentityType->id = $id;
        if (!$this->IdentityType->exists()) {
            throw new NotFoundException(__('Invalid identity type'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->IdentityType->delete()) {
            $this->Session->setFlash(__('The identity type has been deleted.'));
        } else {
            $this->Session->setFlash(__('The identity type could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
