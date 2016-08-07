<?php
App::uses('AppController', 'Controller');
/**
 * SoapNotes Controller
 *
 * @property SoapNote $SoapNote
 * @property PaginatorComponent $Paginator
 */
class SoapNotesController extends AppController {

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
		$this->SoapNote->recursive = 0;
		$this->set('soapNotes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SoapNote->exists($id)) {
			throw new NotFoundException(__('Invalid soap note'));
		}
		$options = array('conditions' => array('SoapNote.' . $this->SoapNote->primaryKey => $id));
		$this->set('soapNote', $this->SoapNote->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SoapNote->create();
			if ($this->SoapNote->save($this->request->data)) {
				$this->Session->setFlash(__('The soap note has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The soap note could not be saved. Please, try again.'));
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
		if (!$this->SoapNote->exists($id)) {
			throw new NotFoundException(__('Invalid soap note'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SoapNote->save($this->request->data)) {
				$this->Session->setFlash(__('The soap note has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The soap note could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SoapNote.' . $this->SoapNote->primaryKey => $id));
			$this->request->data = $this->SoapNote->find('first', $options);
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
		$this->SoapNote->id = $id;
		if (!$this->SoapNote->exists()) {
			throw new NotFoundException(__('Invalid soap note'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SoapNote->delete()) {
			$this->Session->setFlash(__('The soap note has been deleted.'));
		} else {
			$this->Session->setFlash(__('The soap note could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
