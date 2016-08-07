<?php

App::uses('AppController', 'Controller');

/**
 * Keywords Controller
 *
 * @property Keyword $Keyword
 * @property PaginatorComponent $Paginator
 */
class KeywordsController extends AppController {

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
        $this->Keyword->recursive = 0;
        $this->Paginator->settings = array(
            'limit' => 10
        );
        $keywordss = $this->Paginator->paginate();
        $this->set(compact('keywordss'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Keyword->exists($id)) {
            throw new NotFoundException(__('Invalid keyword'));
        }
        $options = array('conditions' => array('Keyword.' . $this->Keyword->primaryKey => $id));
        $this->set('keyword', $this->Keyword->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $keyword = $this->request->data;
            foreach ($keyword['Keyword'] as $value) {
                $saveKeyword['Keyword'] = $value;
                $this->Keyword->create();
                if ($this->Keyword->save($saveKeyword)) {
                    $flag = true;
                } else {
                    $flag = false;
                }
            } 
            if($flag){
                $this->Session->setFlash(__('The Keyword has been saved.'),'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Keyword could not be saved. Please, try again.'),'error');
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
        if (!$this->Keyword->exists($id)) {
            throw new NotFoundException(__('Invalid keyword'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Keyword->save($this->request->data)) {
                $this->Session->setFlash(__('The keyword has been saved.'), 'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The keyword could not be saved. Please, try again.'), 'error');
            }
        } else {
            $options = array('conditions' => array('Keyword.' . $this->Keyword->primaryKey => $id));
            $this->request->data = $this->Keyword->find('first', $options);
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
        $this->Keyword->id = $id;
        if (!$this->Keyword->exists()) {
            throw new NotFoundException(__('Invalid keyword'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Keyword->delete()) {
            $this->Session->setFlash(__('The keyword has been deleted.'), 'success');
        } else {
            $this->Session->setFlash(__('The keyword could not be deleted. Please, try again.'), 'error');
        }
        return $this->redirect(array('action' => 'index'));
    }

}
