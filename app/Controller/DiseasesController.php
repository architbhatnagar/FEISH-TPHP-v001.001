<?php
App::uses('AppController', 'Controller');
/**
 * Diseases Controller
 *
 * @property Disease $Disease
 * @property PaginatorComponent $Paginator
 */
class DiseasesController extends AppController {

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
		$this->Disease->recursive = 0;
		$this->set('diseases', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Disease->exists($id)) {
			throw new NotFoundException(__('Invalid disease'));
		}
		$options = array('conditions' => array('Disease.' . $this->Disease->primaryKey => $id));
		$this->set('disease', $this->Disease->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Disease->create();
			if ($this->Disease->save($this->request->data)) {
				$this->Session->setFlash(__('The disease has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The disease could not be saved. Please, try again.'));
			}
		}
		$parentDiseases = $this->Disease->ParentDisease->find('list');
		$this->set(compact('parentDiseases'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Disease->exists($id)) {
			throw new NotFoundException(__('Invalid disease'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Disease->save($this->request->data)) {
				$this->Session->setFlash(__('The disease has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The disease could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Disease.' . $this->Disease->primaryKey => $id));
			$this->request->data = $this->Disease->find('first', $options);
		}
		$parentDiseases = $this->Disease->ParentDisease->find('list');
		$this->set(compact('parentDiseases'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Disease->id = $id;
		if (!$this->Disease->exists()) {
			throw new NotFoundException(__('Invalid disease'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Disease->delete()) {
			$this->Session->setFlash(__('The disease has been deleted.'));
		} else {
			$this->Session->setFlash(__('The disease could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
