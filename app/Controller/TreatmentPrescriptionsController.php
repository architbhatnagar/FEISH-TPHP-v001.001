<?php
App::uses('AppController', 'Controller');
/**
 * TreatmentPrescriptions Controller
 *
 * @property TreatmentPrescription $TreatmentPrescription
 * @property PaginatorComponent $Paginator
 */
class TreatmentPrescriptionsController extends AppController {

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
		$this->TreatmentPrescription->recursive = 0;
		$this->set('treatmentPrescriptions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TreatmentPrescription->exists($id)) {
			throw new NotFoundException(__('Invalid treatment prescription'));
		}
		$options = array('conditions' => array('TreatmentPrescription.' . $this->TreatmentPrescription->primaryKey => $id));
		$this->set('treatmentPrescription', $this->TreatmentPrescription->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TreatmentPrescription->create();
			if ($this->TreatmentPrescription->save($this->request->data)) {
				$this->Session->setFlash(__('The treatment prescription has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The treatment prescription could not be saved. Please, try again.'));
			}
		}
		$treatmentHistories = $this->TreatmentPrescription->TreatmentHistory->find('list');
		$users = $this->TreatmentPrescription->User->find('list');
		$this->set(compact('treatmentHistories', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TreatmentPrescription->exists($id)) {
			throw new NotFoundException(__('Invalid treatment prescription'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TreatmentPrescription->save($this->request->data)) {
				$this->Session->setFlash(__('The treatment prescription has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The treatment prescription could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TreatmentPrescription.' . $this->TreatmentPrescription->primaryKey => $id));
			$this->request->data = $this->TreatmentPrescription->find('first', $options);
		}
		$treatmentHistories = $this->TreatmentPrescription->TreatmentHistory->find('list');
		$users = $this->TreatmentPrescription->User->find('list');
		$this->set(compact('treatmentHistories', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->TreatmentPrescription->id = $id;
		if (!$this->TreatmentPrescription->exists()) {
			throw new NotFoundException(__('Invalid treatment prescription'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TreatmentPrescription->delete()) {
			$this->Session->setFlash(__('The treatment prescription has been deleted.'));
		} else {
			$this->Session->setFlash(__('The treatment prescription could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
