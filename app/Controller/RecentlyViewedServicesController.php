<?php
App::uses('AppController', 'Controller');
/**
 * RecentlyViewedServices Controller
 *
 * @property RecentlyViewedService $RecentlyViewedService
 * @property PaginatorComponent $Paginator
 */
class RecentlyViewedServicesController extends AppController {

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
		$this->RecentlyViewedService->recursive = 0;
		$this->set('recentlyViewedServices', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RecentlyViewedService->exists($id)) {
			throw new NotFoundException(__('Invalid recently viewed service'));
		}
		$options = array('conditions' => array('RecentlyViewedService.' . $this->RecentlyViewedService->primaryKey => $id));
		$this->set('recentlyViewedService', $this->RecentlyViewedService->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RecentlyViewedService->create();
			if ($this->RecentlyViewedService->save($this->request->data)) {
				$this->Session->setFlash(__('The recently viewed service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The recently viewed service could not be saved. Please, try again.'));
			}
		}
		$users = $this->RecentlyViewedService->User->find('list');
		$services = $this->RecentlyViewedService->Service->find('list');
		$this->set(compact('users', 'services'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->RecentlyViewedService->exists($id)) {
			throw new NotFoundException(__('Invalid recently viewed service'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->RecentlyViewedService->save($this->request->data)) {
				$this->Session->setFlash(__('The recently viewed service has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The recently viewed service could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RecentlyViewedService.' . $this->RecentlyViewedService->primaryKey => $id));
			$this->request->data = $this->RecentlyViewedService->find('first', $options);
		}
		$users = $this->RecentlyViewedService->User->find('list');
		$services = $this->RecentlyViewedService->Service->find('list');
		$this->set(compact('users', 'services'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->RecentlyViewedService->id = $id;
		if (!$this->RecentlyViewedService->exists()) {
			throw new NotFoundException(__('Invalid recently viewed service'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RecentlyViewedService->delete()) {
			$this->Session->setFlash(__('The recently viewed service has been deleted.'));
		} else {
			$this->Session->setFlash(__('The recently viewed service could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
