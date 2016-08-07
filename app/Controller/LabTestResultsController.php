<?php

App::uses('AppController', 'Controller');

/**
 * LabTestResults Controller
 *
 * @property LabTestResult $LabTestResult
 * @property PaginatorComponent $Paginator
 */
class LabTestResultsController extends AppController {

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
        $this->loadModel('LabTestResult');
        $this->loadModel('User');
        $this->loadModel('Test');
        $this->LabTestResult->recursive = 0;
        $login_userId = $this->Auth->user('id');

        if ($this->request->is('post')) {
           // debug($this->request->data);die;
            $this->LabTestResult->create();
            if (isset($this->request->data['LabTestResult']['report_img']['name']) && !empty($this->request->data['LabTestResult']['report_img']['name'])) {
                $this->request->data['LabTestResult']['report'] = $this->LabTestResult->uploadTestReport($this->request->data['LabTestResult']['report_img'], 'lab_test_reports');
            }
            $this->request->data['LabTestResult']['test_date']=date('Y-m-d',strtotime($this->request->data['LabTestResult']['test_date']));
            $this->request->data['LabTestResult']['added_by'] = $login_userId;
            $this->request->data['LabTestResult']['user_id'] = $login_userId;

            if ($this->request->data['id'] != "") {
                if ($this->request->is(array('post', 'put'))) {
                    $this->LabTestResult->id = $this->request->data['id'];
                    if ($this->LabTestResult->save($this->request->data['LabTestResult'])) {
                        $this->Session->setFlash(__('The lab test result has been updated successfully.'), 'success');
                        return $this->redirect(array('action' => 'index'));
                    } else {
                       
                        $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
                        return $this->redirect(array('action' => 'index'));
                    }
                }
            } else {
                if ($this->LabTestResult->save($this->request->data)) {
                    $this->Session->setFlash(__('The lab test result has been saved.'), 'success');
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The lab test result could not be saved. Please, try again.'), 'error');
                }
            }
        }

        $tests = $this->LabTestResult->Test->find('list', array('fields' => 'Test.id,Test.test_name'));
//        $test_results_details = $this->LabTestResult->find('all', array('conditions' => array('LabTestResult.added_by' => $this->Auth->user('id'))));
        $this->LabTestResult->recursive = 0;
        $this->paginate = array(
            'conditions' => array('LabTestResult.user_id' => $this->Auth->user('id')),
            'order' => 'LabTestResult.id DESC',
            'limit' => 10
        );
        $test_results_details = $this->Paginator->paginate();
        $this->set(compact('tests', 'test_results_details'));
    }
    
     public function doctor_test_results($id,$user_type) { 

        $this->loadModel('LabTestResult');
        $this->loadModel('User');
        $this->loadModel('Test');
        $this->LabTestResult->recursive = 0;
        $login_userId = $id;

        if ($this->request->is('post')) {
            
            $this->LabTestResult->create();
            if (isset($this->request->data['LabTestResult']['report_img']['name']) && !empty($this->request->data['LabTestResult']['report_img']['name'])) {
                $this->request->data['LabTestResult']['report'] = $this->LabTestResult->uploadTestReport($this->request->data['LabTestResult']['report_img'], 'lab_test_reports');
            }

            $this->request->data['LabTestResult']['added_by'] = $this->Auth->user('id');
            $this->request->data['LabTestResult']['user_id'] = $login_userId;
            $this->request->data['LabTestResult']['test_date'] = date('Y-m-d',  strtotime($this->request->data['LabTestResult']['test_date']));

            if ($this->request->data['id'] != "") {
                if ($this->request->is(array('post', 'put'))) {
                    $this->LabTestResult->id = $this->request->data['id'];
                    if ($this->LabTestResult->save($this->request->data['LabTestResult'])) {
                        $this->Session->setFlash(__('The lab test result has been updated successfully.'), 'success');
                        return $this->redirect(array('action' => 'doctor_test_results',$id,$user_type));
                    } else {
                       
                        $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
                        return $this->redirect(array('action' => 'doctor_test_results',$id,$user_type));
                    }
                }
            } else {
                if ($this->LabTestResult->save($this->request->data)) {
                    $this->Session->setFlash(__('The lab test result has been saved.'), 'success');
                    return $this->redirect(array('action' => 'doctor_test_results',$id,$user_type));
                } else {
                    $this->Session->setFlash(__('The lab test result could not be saved. Please, try again.'), 'error');
                }
            }
        }

        $tests = $this->LabTestResult->Test->find('list', array('fields' => 'Test.id,Test.test_name'));
//        $test_results_details = $this->LabTestResult->find('all', array('conditions' => array('LabTestResult.added_by' => $this->Auth->user('id'))));
        $this->LabTestResult->recursive = 0;
        $this->paginate = array(
            'conditions' => array('LabTestResult.user_id' => $id),
            'order' => 'LabTestResult.id DESC',
            'limit' => 10
        );
        $test_results_details = $this->Paginator->paginate();
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id),'recursive'=>-1));
        
        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $blood_groups = Configure::read('feish.blood_groups');
        $this->set(compact('user','salutations','tests', 'test_results_details','blood_groups'));
    }
    
     public function assistant_test_results($id,$user_type) { 

        $this->loadModel('LabTestResult');
        $this->loadModel('User');
        $this->loadModel('Test');
        $this->LabTestResult->recursive = 0;
        $login_userId = $id;

        if ($this->request->is('post')) {
            
            $this->LabTestResult->create();
            if (isset($this->request->data['LabTestResult']['report_img']['name']) && !empty($this->request->data['LabTestResult']['report_img']['name'])) {
                $this->request->data['LabTestResult']['report'] = $this->LabTestResult->uploadTestReport($this->request->data['LabTestResult']['report_img'], 'lab_test_reports');
            }

            $this->request->data['LabTestResult']['added_by'] = $this->Auth->user('id');
            $this->request->data['LabTestResult']['user_id'] = $login_userId;
            $this->request->data['LabTestResult']['test_date'] = date('Y-m-d',  strtotime($this->request->data['LabTestResult']['test_date']));

            if ($this->request->data['id'] != "") {
                if ($this->request->is(array('post', 'put'))) {
                    $this->LabTestResult->id = $this->request->data['id'];
                    if ($this->LabTestResult->save($this->request->data['LabTestResult'])) {
                        $this->Session->setFlash(__('The lab test result has been updated successfully.'), 'success');
                        return $this->redirect(array('action' => 'assistant_test_results',$id,$user_type));
                    } else {
                       
                        $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'error');
                        return $this->redirect(array('action' => 'assistant_test_results',$id,$user_type));
                    }
                }
            } else {
                if ($this->LabTestResult->save($this->request->data)) {
                    $this->Session->setFlash(__('The lab test result has been saved.'), 'success');
                    return $this->redirect(array('action' => 'doctor_test_results',$id,$user_type));
                } else {
                    $this->Session->setFlash(__('The lab test result could not be saved. Please, try again.'), 'error');
                }
            }
        }

        $tests = $this->LabTestResult->Test->find('list', array('fields' => 'Test.id,Test.test_name'));
//        $test_results_details = $this->LabTestResult->find('all', array('conditions' => array('LabTestResult.added_by' => $this->Auth->user('id'))));
        $this->LabTestResult->recursive = 0;
        $this->paginate = array(
            'conditions' => array('LabTestResult.user_id' => $id),
            'order' => 'LabTestResult.id DESC',
            'limit' => 10
        );
        $test_results_details = $this->Paginator->paginate();
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id),'recursive'=>-1));
        
        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $blood_groups = Configure::read('feish.blood_groups');
        $this->set(compact('user','last_login','salutations','tests', 'test_results_details', 'yes_no', 'blood_groups'));
    }

    public function view_test_result_byid() {
        $this->layout = null;
        $this->loadModel('LabTestResult');

        if ($this->request->is('post')) {

            $data = $this->request->data;
            $test_results_history = $this->LabTestResult->find('all', array('conditions' => array('LabTestResult.id' => $this->request->data['id'])));
            $test_results_history = $test_results_history[0];
            if (!empty($test_results_history)) {
                $result = $test_results_history;
            } else {
                $result = 0;
            }
            $this->set(compact('result'));
//            $this->render('filter');
        }
    }
    
    public function get_test_result_byid() {
        $this->layout = null;
        $this->loadModel('LabTestResult');

        if ($this->request->is('post')) {

            $data = $this->request->data;
            $test_results_history = $this->LabTestResult->find('first', array('conditions' => array('LabTestResult.id' => $this->request->data['id'])));
            $test_results_history['LabTestResult']['test_date']=date('m/d/Y',strtotime($test_results_history['LabTestResult']['test_date']));
            if (!empty($test_results_history)) {
                $result = $test_results_history;
            } else {
                $result = 0;
            }
            $this->set(compact('result'));
            $this->render('filter');
        }
    }

    public function download_sample_file($file_name) {
        $file = explode('.', $file_name);
        $this->viewClass = 'Media';
        $params = array(
            'id' => $file_name,
            'name' => $file[0],
            'download' => true,
            'extension' => $file[1],
            'path' => APP . WEBROOT_DIR . DS . 'img/lab_test_reports' . DS
        );
        $this->set($params);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->LabTestResult->exists($id)) {
            throw new NotFoundException(__('Invalid lab test result'));
        }
        $options = array('conditions' => array('LabTestResult.' . $this->LabTestResult->primaryKey => $id));
        $this->set('labTestResult', $this->LabTestResult->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->LabTestResult->create();
            if ($this->LabTestResult->save($this->request->data)) {
                $this->Session->setFlash(__('The lab test result has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The lab test result could not be saved. Please, try again.'));
            }
        }
        $tests = $this->LabTestResult->Test->find('list');
        $users = $this->LabTestResult->User->find('list');
        $this->set(compact('tests', 'users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->LabTestResult->exists($id)) {
            throw new NotFoundException(__('Invalid lab test result'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->LabTestResult->save($this->request->data)) {
                $this->Session->setFlash(__('The lab test result has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The lab test result could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('LabTestResult.' . $this->LabTestResult->primaryKey => $id));
            $this->request->data = $this->LabTestResult->find('first', $options);
        }
        $tests = $this->LabTestResult->Test->find('list');
        $users = $this->LabTestResult->User->find('list');
        $this->set(compact('tests', 'users'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->LabTestResult->id = $id;
        if (!$this->LabTestResult->exists()) {
            throw new NotFoundException(__('Invalid lab test result'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->LabTestResult->delete()) {
            $this->Session->setFlash(__('The lab test result has been deleted.'));
        } else {
            $this->Session->setFlash(__('The lab test result could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
