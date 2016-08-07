<?php
App::uses('AppController', 'Controller');
/**
 * DoctorAccountDetails Controller
 *
 * @property DoctorAccountDetail $DoctorAccountDetail
 * @property PaginatorComponent $Paginator
 */
class DoctorAccountDetailsController extends AppController {

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
		$this->DoctorAccountDetail->recursive = 0;
		$this->set('doctorAccountDetails', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DoctorAccountDetail->exists($id)) {
			throw new NotFoundException(__('Invalid doctor account detail'));
		}
		$options = array('conditions' => array('DoctorAccountDetail.' . $this->DoctorAccountDetail->primaryKey => $id));
		$this->set('doctorAccountDetail', $this->DoctorAccountDetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DoctorAccountDetail->create();
			if ($this->DoctorAccountDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The doctor account detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The doctor account detail could not be saved. Please, try again.'));
			}
		}
		$users = $this->DoctorAccountDetail->User->find('list');
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
		if (!$this->DoctorAccountDetail->exists($id)) {
			throw new NotFoundException(__('Invalid doctor account detail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DoctorAccountDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The doctor account detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The doctor account detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DoctorAccountDetail.' . $this->DoctorAccountDetail->primaryKey => $id));
			$this->request->data = $this->DoctorAccountDetail->find('first', $options);
		}
		$users = $this->DoctorAccountDetail->User->find('list');
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
		$this->DoctorAccountDetail->id = $id;
		if (!$this->DoctorAccountDetail->exists()) {
			throw new NotFoundException(__('Invalid doctor account detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DoctorAccountDetail->delete()) {
			$this->Session->setFlash(__('The doctor account detail has been deleted.'));
		} else {
			$this->Session->setFlash(__('The doctor account detail could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
