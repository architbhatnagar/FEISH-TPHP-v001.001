<?php

App::uses('AppController', 'Controller');

/**
 * FamilyHistories Controller
 *
 * @property FamilyHistory $FamilyHistory
 * @property PaginatorComponent $Paginator
 */
class FamilyHistoriesController extends AppController {

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
        $this->layout = 'front_layout';

        $this->recursive = 0;
        $this->loadModel('FamilyHistory');
        $this->loadModel('Relationship');
        $login_userId = $this->Auth->user('id');
        Configure::load('feish');

//        $relationship = Configure::read('feish.relationship');
        $this->request->data['FamilyHistory']['user_id'] = $login_userId;
        $this->request->data['FamilyHistory']['added_by'] = $login_userId;

        if ($this->request->is('post')) {
            if ($this->request->data['id'] != "") {
                if ($this->request->is(array('post', 'put'))) {
                      $this->request->data['FamilyHistory']['updated_by']=$this->Auth->user('id');
                    $this->FamilyHistory->id = $this->request->data['id'];
                    if ($this->FamilyHistory->save($this->request->data['FamilyHistory'])) {
                        $this->Session->setFlash(__('The family history has been saved.'), 'success');
                        return $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                        return $this->redirect(array('action' => 'index'));
                    }
                }
            } else {
                $this->FamilyHistory->create();
                 $this->request->data['FamilyHistory']['added_by']=$this->Auth->user('id');
                $this->request->data['FamilyHistory']['updated_by']=$this->Auth->user('id');
                if ($this->FamilyHistory->save($this->request->data)) {
                    $this->Session->setFlash(__('The family history has been saved.'), 'success');
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The family history could not be saved. Please, try again.'), 'error');
                    return $this->redirect(array('action' => 'index'));
                }
            }
        }

//        $users_family_history = $this->FamilyHistory->find('all', array('conditions' => array('FamilyHistory.added_by' => $this->Auth->user('id'))));
        $this->FamilyHistory->recursive = 0;
        $this->paginate = array(
            'conditions' => array('FamilyHistory.user_id' => $this->Auth->user('id')),
            'order' => 'FamilyHistory.id DESC',
            'limit' => 10
        );
        $users_family_history = $this->Paginator->paginate();

        $relationship = $this->Relationship->find('list');
        $this->set(compact('relationship', 'users_family_history'));
    }
    
    public function patient_family_histories($id,$user_type) {
        
        $this->recursive = 0;
        $this->loadModel('FamilyHistory');
        $this->loadModel('Relationship');
        $this->loadModel('User');
        $login_userId = $this->Auth->user('id');
        Configure::load('feish');

        $this->request->data['FamilyHistory']['user_id'] = $id;
        $this->request->data['FamilyHistory']['added_by'] = $login_userId;
          $this->request->data['FamilyHistory']['updated_by'] = $login_userId;

        if ($this->request->is('post')) {
            if ($this->request->data['id'] != "") {
                if ($this->request->is(array('post', 'put'))) {
                    $this->FamilyHistory->id = $this->request->data['id'];
                    if ($this->FamilyHistory->save($this->request->data['FamilyHistory'])) {
                        $this->Session->setFlash(__('The family history has been saved.'), 'success');
                        return $this->redirect(array('action' => 'patient_family_histories',$id,$user_type));
                    } else {
                        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                        return $this->redirect(array('action' => 'patient_family_histories',$id,$user_type));
                    }
                }
            } else {
                $this->FamilyHistory->create();
                if ($this->FamilyHistory->save($this->request->data)) {
                    $this->Session->setFlash(__('The family history has been saved.'), 'success');
                    return $this->redirect(array('action' => 'patient_family_histories',$id,$user_type));
                } else {
                    $this->Session->setFlash(__('The family history could not be saved. Please, try again.'), 'error');
                    return $this->redirect(array('action' => 'patient_family_histories',$id,$user_type));
                }
            }
        }

        $this->FamilyHistory->recursive = 0;
        $this->paginate = array(
            'conditions' => array('FamilyHistory.user_id' => $id),
            'order' => 'FamilyHistory.id DESC',
            'limit' => 10
        );
        $users_family_history = $this->Paginator->paginate();
        
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id),'recursive'=>-1));
        
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $blood_groups = Configure::read('feish.blood_groups');
        $relationship = $this->Relationship->find('list');
        
        $this->set(compact('user','relationship', 'last_login','salutations','users_family_history','blood_groups'));
    }
    
     public function assistant_family_histories($id,$user_type) {
        
        $this->recursive = 0;
        $this->loadModel('FamilyHistory');
        $this->loadModel('Relationship');
        $this->loadModel('User');
        $login_userId = $this->Auth->user('id');
        Configure::load('feish');

        $this->request->data['FamilyHistory']['user_id'] = $id;
        $this->request->data['FamilyHistory']['added_by'] = $login_userId;

        if ($this->request->is('post')) {
            if ($this->request->data['id'] != "") {
                if ($this->request->is(array('post', 'put'))) {
                    $this->FamilyHistory->id = $this->request->data['id'];
                    if ($this->FamilyHistory->save($this->request->data['FamilyHistory'])) {
                        $this->Session->setFlash(__('The family history has been saved.'), 'success');
                        return $this->redirect(array('action' => 'assistant_family_histories',$id,$user_type));
                    } else {
                        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                        return $this->redirect(array('action' => 'assistant_family_histories',$id,$user_type));
                    }
                }
            } else {
                $this->FamilyHistory->create();
                if ($this->FamilyHistory->save($this->request->data)) {
                    $this->Session->setFlash(__('The family history has been saved.'), 'success');
                    return $this->redirect(array('action' => 'assistant_family_histories',$id,$user_type));
                } else {
                    $this->Session->setFlash(__('The family history could not be saved. Please, try again.'), 'error');
                    return $this->redirect(array('action' => 'assistant_family_histories',$id,$user_type));
                }
            }
        }

        $this->FamilyHistory->recursive = 0;
        $this->paginate = array(
            'conditions' => array('FamilyHistory.user_id' => $id),
            'order' => 'FamilyHistory.id DESC',
            'limit' => 10
        );
        $users_family_history = $this->Paginator->paginate();
        
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id),'recursive'=>-1));

        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $blood_groups = Configure::read('feish.blood_groups');

        $relationship = $this->Relationship->find('list');
        $this->set(compact('user','relationship', 'last_login','salutations','users_family_history','yes_no','blood_groups'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->FamilyHistory->exists($id)) {
            throw new NotFoundException(__('Invalid family history'));
        }
        $options = array('conditions' => array('FamilyHistory.' . $this->FamilyHistory->primaryKey => $id));
        $this->set('familyHistory', $this->FamilyHistory->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->FamilyHistory->create();
            if ($this->FamilyHistory->save($this->request->data)) {
                $this->Session->setFlash(__('The family history has been saved.'), 'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The family history could not be saved. Please, try again.'), 'error');
            }
        }
        $diseases = $this->FamilyHistory->Disease->find('list');
        $users = $this->FamilyHistory->User->find('list');
        $this->set(compact('diseases', 'users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function get_family_history_byid() {
        $this->layout = null;
        $this->loadModel('FamilyHistory');

        if ($this->request->is('post')) {

            $data = $this->request->data;
            $users_family_history = $this->FamilyHistory->find('first', array('conditions' => array('FamilyHistory.id' => $this->request->data['id'])));
//            $users_family_history = $users_family_history['FamilyHistory'];

            if (!empty($users_family_history)) {
                $result = $users_family_history;
            } else {
                $result = 0;
            }
            $this->set(compact('result'));
            $this->render('filter');
        }
    }

    public function edit($id = null) {
        if (!$this->FamilyHistory->exists($id)) {
            throw new NotFoundException(__('Invalid family history'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->FamilyHistory->save($this->request->data)) {
                $this->Session->setFlash(__('The family history has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The family history could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('FamilyHistory.' . $this->FamilyHistory->primaryKey => $id));
            $this->request->data = $this->FamilyHistory->find('first', $options);
        }
        $diseases = $this->FamilyHistory->Disease->find('list');
        $users = $this->FamilyHistory->User->find('list');
        $this->set(compact('diseases', 'users'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->FamilyHistory->id = $id;
        if (!$this->FamilyHistory->exists()) {
            throw new NotFoundException(__('Invalid family history'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->FamilyHistory->delete()) {
            $this->Session->setFlash(__('The family history has been deleted.'));
        } else {
            $this->Session->setFlash(__('The family history could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
