<?php

App::uses('AppController', 'Controller');

/**
 * Tests Controller
 *
 * @property Test $Test
 * @property PaginatorComponent $Paginator
 */
class TestsController extends AppController {

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
        $this->Test->recursive = 0;
        $this->Paginator->settings = array(
            'limit' => 10
        );
        $tests = $this->Paginator->paginate();
        $this->set('tests', $tests);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Test->exists($id)) {
            throw new NotFoundException(__('Invalid test'));
        }
        $options = array('conditions' => array('Test.' . $this->Test->primaryKey => $id));
        $this->set('test', $this->Test->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $test = $this->request->data;
            foreach ($test['Test'] as $value) {
                $saveTest['Test'] = $value;
                $this->Test->create();
                if ($this->Test->save($saveTest)) {
                    $flag = true;
                } else {
                    $flag = false;
                }
            } 
            if($flag){
                $this->Session->setFlash(__('The test has been saved.'), 'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The test could not be saved. Please, try again.'), 'error');
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
        if (!$this->Test->exists($id)) {
            throw new NotFoundException(__('Invalid test'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Test->save($this->request->data)) {
                $this->Session->setFlash(__('The test has been saved.'), 'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The test could not be saved. Please, try again.'), 'error');
            }
        } else {
            $options = array('conditions' => array('Test.' . $this->Test->primaryKey => $id));
            $this->request->data = $this->Test->find('first', $options);
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
        $this->Test->id = $id;
        if (!$this->Test->exists()) {
            throw new NotFoundException(__('Invalid test'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Test->delete()) {
            $this->Session->setFlash(__('The test has been deleted.'), 'success');
        } else {
            $this->Session->setFlash(__('The test could not be deleted. Please, try again.'), 'error');
        }
        return $this->redirect(array('action' => 'index'));
    }
     public function beforeFilter() {
        $this->Auth->allow(array('view'));

       
    }

}
