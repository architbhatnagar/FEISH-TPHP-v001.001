<?php

App::uses('AppController', 'Controller');

/**
 * Procedures Controller
 *
 * @property Procedure $Procedure
 * @property PaginatorComponent $Paginator
 */
class ProceduresController extends AppController {

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
        $this->Procedure->recursive = 0;
        $this->Paginator->settings = array(
            'limit' => 10
        );
        $procedures = $this->Paginator->paginate();
        $this->set('procedures', $procedures);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Procedure->exists($id)) {
            throw new NotFoundException(__('Invalid procedure'));
        }
        $options = array('conditions' => array('Procedure.' . $this->Procedure->primaryKey => $id));
        $this->set('procedure', $this->Procedure->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $procedure = $this->request->data;
            foreach ($procedure['Procedure'] as $value) {
                $saveProcedure['Procedure'] = $value;
                $this->Procedure->create();
                if ($this->Procedure->save($saveProcedure)) {
                    $flag = true;
                } else {
                    $flag = false;
                }
            } 
            if($flag){
                $this->Session->setFlash(__('The procedure has been saved.'),'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The procedure could not be saved. Please, try again.'),'error');
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
        if (!$this->Procedure->exists($id)) {
            throw new NotFoundException(__('Invalid procedure'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Procedure->save($this->request->data)) {
                $this->Session->setFlash(__('The procedure has been saved.'), 'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The procedure could not be saved. Please, try again.'), 'error');
            }
        } else {
            $options = array('conditions' => array('Procedure.' . $this->Procedure->primaryKey => $id));
            $this->request->data = $this->Procedure->find('first', $options);
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
        $this->Procedure->id = $id;
        if (!$this->Procedure->exists()) {
            throw new NotFoundException(__('Invalid procedure'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Procedure->delete()) {
            $this->Session->setFlash(__('The procedure has been deleted.'), 'success');
        } else {
            $this->Session->setFlash(__('The procedure could not be deleted. Please, try again.'), 'error');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
