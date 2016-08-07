<?php

App::uses('AppController', 'Controller');

/**
 * Specialties Controller
 *
 * @property Specialty $Specialty
 * @property PaginatorComponent $Paginator
 */
class SpecialtiesController extends AppController {

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
    public function index($flag = null) {
        $this->loadModel('Disease');
        if ($this->request->is('post')) {

            if (isset($this->request->data['Specialty']['parent_id'])) {
                $this->request->data['Specialty']['level'] = 2;
            } else {
                $this->request->data['Specialty']['level'] = 1;
                $this->request->data['Specialty']['parent_id'] = 0;
            }
            $this->request->data['Specialty']['is_deleted'] = 0;
            if (isset($this->request->data['Specialty']['id']) && !empty($this->request->data['Specialty']['id'])) {
                $this->Specialty->id = $this->request->data['Specialty']['id'];
            } else {
                $this->Specialty->create();
            }

            if ($this->Specialty->save($this->request->data)) {
                $sp_id = $this->Specialty->id;
                //debug($sp_id);die;
                if (!empty($this->request->data['Specialty']['disease_id'])) {
                    $diseases = explode(",", $this->request->data['Specialty']['disease_id']);
                    if (!empty($diseases)) {
                        $de_arr = array();
                        foreach ($diseases as $disease) {
                            $save_data = array();
                            $save_data['Disease']['name'] = $disease;
                            $save_data['Disease']['specialty_id'] = $sp_id;
                            $if_exist = $this->Disease->find('first', array('conditions' => array('Disease.name' => $disease, 'Disease.specialty_id' => $sp_id), 'fields' => array('id'), 'recursive' => -1));
                            if (empty($if_exist)) {
                                $this->Disease->create();
                                if ($this->Disease->save($save_data)) {
                                    array_push($de_arr, $this->Disease->id);
                                }
                            } else {
                                array_push($de_arr, $if_exist['Disease']['id']);
                            }
                        }
                        $dise_text = implode(",", $de_arr);
                        $this->Disease->deleteAll(array('Disease.id NOT' => $de_arr, 'Disease.specialty_id' => $sp_id));
                        $this->Specialty->updateAll(array('Specialty.disease_id' => "'" . $dise_text . "'"), array('Specialty.id' => $sp_id));
                    }
                } else {
                    $this->Disease->deleteAll(array('Disease.specialty_id' => $sp_id));
                }
                $this->Session->setFlash(__('The specialty has been saved successfully'), 'success');
                return $this->redirect(array('action' => 'index', $flag));
            } else {
                $this->Session->setFlash(__('The specialty could not been saved.Please try again later'), 'error');
                return $this->redirect(array('action' => 'index', $flag));
            }
        }
        $this->Specialty->recursive = 0;
        if (!empty($flag)) {
            if ($flag == 0) {
                $this->paginate = array(
                    'conditions' => array('Specialty.parent_id' => 0),
                    'order' => 'Specialty.id DESC',
                    'limit' => 20
                );
            } else {
                $this->paginate = array(
                    'conditions' => array('Specialty.parent_id NOT' => 0),
                    'order' => 'Specialty.id DESC',
                    'limit' => 20
                );
            }
        } else {
            $this->paginate = array(
                'order' => 'Specialty.id DESC',
                'limit' => 20
            );
        }
        $specialties = $this->Paginator->paginate();
        $parent_specialties = $this->Specialty->find('list', array('conditions' => array('parent_id' => 0), 'fields' => array('id', 'specialty_name')));

        foreach ($specialties as $key => $spec) {


            $deseases = array();
            if (!empty($spec['Specialty']['disease_id'])) {
                $sp_array = explode(",", $spec['Specialty']['disease_id']);
                $deseases = $this->Disease->find('list', array('conditions' => array('Disease.id' => $sp_array), 'fields' => array('id', 'name')));
            }
            $specialties[$key]['diseases'] = $deseases;
        }
        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
        // debug($specialties);die;
        $this->set(compact('specialties', 'flag', 'parent_specialties', 'yes_no'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Specialty->exists($id)) {
            throw new NotFoundException(__('Invalid specialty'));
        }
        $options = array('conditions' => array('Specialty.' . $this->Specialty->primaryKey => $id));
        $this->set('specialty', $this->Specialty->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Specialty->create();
            if ($this->Specialty->save($this->request->data)) {
                $this->Session->setFlash(__('The specialty has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The specialty could not be saved. Please, try again.'));
            }
        }
        $parentSpecialties = $this->Specialty->ParentSpecialty->find('list');
        $diseases = $this->Specialty->Disease->find('list');
        $this->set(compact('parentSpecialties', 'diseases'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Specialty->exists($id)) {
            throw new NotFoundException(__('Invalid specialty'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Specialty->save($this->request->data)) {
                $this->Session->setFlash(__('The specialty has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The specialty could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Specialty.' . $this->Specialty->primaryKey => $id));
            $this->request->data = $this->Specialty->find('first', $options);
        }
        $parentSpecialties = $this->Specialty->ParentSpecialty->find('list');
        $diseases = $this->Specialty->Disease->find('list');
        $this->set(compact('parentSpecialties', 'diseases'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function get_details() {
        $this->layout = null;
        if ($this->request->is('post')) {
            $fetch_data = $this->Specialty->find('first', array('conditions' => array('Specialty.id' => $this->request->data['id']), 'fields' => array('id', 'specialty_name', 'parent_id',)));

            $disease_text_arr = array();
            foreach ($fetch_data['Disease'] as $de) {
                array_push($disease_text_arr, $de['name']);
            }
            $disease_text = implode(",", $disease_text_arr);
            $result['Specialty'] = $fetch_data['Specialty'];
            $result['Specialty']['disease_id'] = $disease_text;
            //  debug($result);die;
            $this->set(compact('result'));
            $this->render('filter');
        }
    }

    public function delete($id = null, $flag = null) {
        $this->Specialty->id = $id;
        if (!$this->Specialty->exists()) {
            throw new NotFoundException(__('Invalid specialty'));
        }
        $data = $this->Specialty->find('first', array('conditions' => array('Specialty.id' => $id), 'fields' => array('is_deleted')));
        $status = 0;
        if ($data['Specialty']['is_deleted'] == 0) {
            $status = 1;
        } else {
            $status = 0;
        }

        if ($this->Specialty->updateAll(array('Specialty.is_deleted' => $status), array('Specialty.id' => $id))) {
            if ($status == 0) {
                $this->Session->setFlash(__('The Specialty has been restored.'), 'success');
            } else {
                $this->Session->setFlash(__('The Specialty has been deleted.'), 'success');
            }
        } else {
            if ($status == 0) {
                $this->Session->setFlash(__('The Specialty could not be restored.Please Try again'), 'error');
            } else {
                $this->Session->setFlash(__('The Specialty could not be deleted..Please Try again'), 'error');
            }
        }

        return $this->redirect(array('action' => 'index', $flag));
    }

}
