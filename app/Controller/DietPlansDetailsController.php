<?php
App::uses('AppController', 'Controller');
/**
 * DietPlansDetails Controller
 *
 * @property DietPlansDetail $DietPlansDetail
 * @property PaginatorComponent $Paginator
 */
class DietPlansDetailsController extends AppController {

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
		$this->DietPlansDetail->recursive = 0;
		$this->set('dietPlansDetails', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DietPlansDetail->exists($id)) {
			throw new NotFoundException(__('Invalid diet plans detail'));
		}
		$options = array('conditions' => array('DietPlansDetail.' . $this->DietPlansDetail->primaryKey => $id));
		$this->set('dietPlansDetail', $this->DietPlansDetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DietPlansDetail->create();
			if ($this->DietPlansDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The diet plans detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The diet plans detail could not be saved. Please, try again.'));
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
		if (!$this->DietPlansDetail->exists($id)) {
			throw new NotFoundException(__('Invalid diet plans detail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DietPlansDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The diet plans detail has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The diet plans detail could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('DietPlansDetail.' . $this->DietPlansDetail->primaryKey => $id));
			$this->request->data = $this->DietPlansDetail->find('first', $options);
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
		$this->DietPlansDetail->id = $id;
		if (!$this->DietPlansDetail->exists()) {
			throw new NotFoundException(__('Invalid diet plans detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DietPlansDetail->delete()) {
			$this->Session->setFlash(__('The diet plans detail has been deleted.'));
		} else {
			$this->Session->setFlash(__('The diet plans detail could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
