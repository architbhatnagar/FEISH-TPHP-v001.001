<?php
App::uses('AppController', 'Controller');
/**
 * LoginDetails Controller
 *
 * @property LoginDetail $LoginDetail
 * @property PaginatorComponent $Paginator
 */
class LoginDetailsController extends AppController {

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
		$this->LoginDetail->recursive = 0;
		$this->set('loginDetails', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->LoginDetail->exists($id)) {
			throw new NotFoundException(__('Invalid login detail'));
		}
		$options = array('conditions' => array('LoginDetail.' . $this->LoginDetail->primaryKey => $id));
		$this->set('loginDetail', $this->LoginDetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->LoginDetail->create();
			if ($this->LoginDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The login detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The login detail could not be saved. Please, try again.'));
			}
		}
		$users = $this->LoginDetail->User->find('list');
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
		if (!$this->LoginDetail->exists($id)) {
			throw new NotFoundException(__('Invalid login detail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->LoginDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The login detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The login detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('LoginDetail.' . $this->LoginDetail->primaryKey => $id));
			$this->request->data = $this->LoginDetail->find('first', $options);
		}
		$users = $this->LoginDetail->User->find('list');
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
		$this->LoginDetail->id = $id;
		if (!$this->LoginDetail->exists()) {
			throw new NotFoundException(__('Invalid login detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->LoginDetail->delete()) {
			$this->Session->setFlash(__('The login detail has been deleted.'));
		} else {
			$this->Session->setFlash(__('The login detail could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
