<?php

App::uses('AppController', 'Controller');

/**
 * DietPlans Controller
 *
 * @property DietPlan $DietPlan
 * @property PaginatorComponent $Paginator
 */
class DietPlansController extends AppController {

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
        $this->loadModel('DietPlan');
        $this->loadModel('DietPlansDetail');
        Configure::load('feish');
        $weekdays = Configure::read('feish.weekdays');
        $login_userId = $this->Auth->user('id');

        if ($this->request->is('post')) {
            
            $this->request->data['DietPlan']['start_date'] = date('Y-m-d',  strtotime($this->request->data['DietPlan']['start_date']));
            $this->request->data['DietPlan']['end_date'] = date('Y-m-d',  strtotime($this->request->data['DietPlan']['end_date']));
            $this->request->data['DietPlan']['added_by'] = $login_userId;
            $this->request->data['DietPlan']['user_id'] = $login_userId;

            $this->DietPlan->create();
            if ($this->DietPlan->save($this->request->data)) {

                $last_insert_id = $this->DietPlan->id;
                $this->request->data['DietPlan']['diet_plan_id'] = $last_insert_id;
                $PlanDetails = $this->request->data['DietPlan']['PlanDetails'];

                foreach ($PlanDetails as $value) {
                    $this->DietPlansDetail->create();
                    $diet_arr = array('diet_plan_id' => $this->request->data['DietPlan']['diet_plan_id'], 'weekday' => $value['weekday'], 'time' => date('H:i:s', strtotime($value['time'])), 'description' => $value['description'], 'created_date' => date('Y-m-d i:m:s'));
                    $this->DietPlansDetail->save($diet_arr);
                }

                $this->Session->setFlash(__('The diet plan has been saved.'), 'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The diet plan could not be saved. Please, try again.'), 'error');
            }
        }

        $this->paginate = array(
            'conditions' => array('DietPlan.user_id' => $login_userId),
            'order' => 'DietPlan.id DESC',
            'limit' => 10
        );
        $diet_plan_arr = $this->Paginator->paginate();
        $this->set(compact('weekdays', 'diet_plan_arr'));
    }

    public function patient_diet_plan($id, $user_type) {

        $this->recursive = 0;
        $this->loadModel('DietPlan');
        $this->loadModel('User');
        $this->loadModel('DietPlansDetail');
        Configure::load('feish');
        $weekdays = Configure::read('feish.weekdays');
        $login_userId = $this->Auth->user('id');

        if ($this->request->is('post')) {

            $this->request->data['DietPlan']['added_by'] = $login_userId;
            $this->request->data['DietPlan']['user_id'] = $id;
            $this->request->data['DietPlan']['start_date'] = date('Y-m-d', strtotime($this->request->data['DietPlan']['start_date']));
            $this->request->data['DietPlan']['end_date'] = date('Y-m-d', strtotime($this->request->data['DietPlan']['end_date']));

            $this->DietPlan->create();
            if ($this->DietPlan->save($this->request->data)) {

                $last_insert_id = $this->DietPlan->id;
                $this->request->data['DietPlan']['diet_plan_id'] = $last_insert_id;
                $PlanDetails = $this->request->data['DietPlan']['PlanDetails'];

                foreach ($PlanDetails as $value) {
                    $this->DietPlansDetail->create();
                    $diet_arr = array('diet_plan_id' => $this->request->data['DietPlan']['diet_plan_id'], 'weekday' => $value['weekday'], 'time' => date('H:i:s', strtotime($value['time'])), 'description' => $value['description'], 'created_date' => date('Y-m-d i:m:s'));
                    $this->DietPlansDetail->save($diet_arr);
                }

                $this->Session->setFlash(__('The diet plan has been saved.'), 'success');
                return $this->redirect(array('action' => 'patient_diet_plan',$id, $user_type));
            } else {
                $this->Session->setFlash(__('The diet plan could not be saved. Please, try again.'), 'error');
            }
        }

        $this->paginate = array(
            'conditions' => array('DietPlan.user_id' => $id),
            'order' => 'DietPlan.id DESC',
            'limit' => 10
        );
        $diet_plan_arr = $this->Paginator->paginate();

        $user = $this->User->find('first', array('conditions' => array('User.id' => $id),'recursive'=>-1));

        
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $blood_groups = Configure::read('feish.blood_groups');

        $this->set(compact('user', 'last_login', 'salutations', 'weekdays', 'diet_plan_arr','blood_groups'));
    }
    
     public function assistant_diet_plan($id, $user_type) {

        $this->recursive = 0;
        $this->loadModel('DietPlan');
        $this->loadModel('User');
        $this->loadModel('DietPlansDetail');
        Configure::load('feish');
        $weekdays = Configure::read('feish.weekdays');
        $login_userId = $this->Auth->user('id');

        if ($this->request->is('post')) {

            $this->request->data['DietPlan']['added_by'] = $login_userId;
            $this->request->data['DietPlan']['user_id'] = $id;
            $this->request->data['DietPlan']['start_date'] = date('Y-m-d', strtotime($this->request->data['DietPlan']['start_date']));
            $this->request->data['DietPlan']['end_date'] = date('Y-m-d', strtotime($this->request->data['DietPlan']['end_date']));

            $this->DietPlan->create();
            if ($this->DietPlan->save($this->request->data)) {

                $last_insert_id = $this->DietPlan->id;
                $this->request->data['DietPlan']['diet_plan_id'] = $last_insert_id;
                $PlanDetails = $this->request->data['DietPlan']['PlanDetails'];

                foreach ($PlanDetails as $value) {
                    $this->DietPlansDetail->create();
                    $diet_arr = array('diet_plan_id' => $this->request->data['DietPlan']['diet_plan_id'], 'weekday' => $value['weekday'], 'time' => date('H:i:s', strtotime($value['time'])), 'description' => $value['description'], 'created_date' => date('Y-m-d i:m:s'));
                    $this->DietPlansDetail->save($diet_arr);
                }

                $this->Session->setFlash(__('The diet plan has been saved.'), 'success');
                return $this->redirect(array('action' => 'assistant_diet_plan',$id, $user_type));
            } else {
                $this->Session->setFlash(__('The diet plan could not be saved. Please, try again.'), 'error');
                 return $this->redirect(array('action' => 'assistant_diet_plan',$id, $user_type));
            }
        }

        $this->paginate = array(
            'conditions' => array('DietPlan.user_id' => $id),
            'order' => 'DietPlan.id DESC',
            'limit' => 10
        );
        $diet_plan_arr = $this->Paginator->paginate();

        $user = $this->User->find('first', array('conditions' => array('User.id' => $id),'recursive'=>-1));

        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $blood_groups = Configure::read('feish.blood_groups');

        $this->set(compact('user', 'last_login', 'salutations', 'weekdays', 'diet_plan_arr', 'yes_no','blood_groups'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->DietPlan->exists($id)) {
            throw new NotFoundException(__('Invalid diet plan'));
        }
        $options = array('conditions' => array('DietPlan.' . $this->DietPlan->primaryKey => $id));
        $this->set('dietPlan', $this->DietPlan->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->DietPlan->create();
            if ($this->DietPlan->save($this->request->data)) {
                $this->Session->setFlash(__('The diet plan has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The diet plan could not be saved. Please, try again.'));
            }
        }
        $users = $this->DietPlan->User->find('list');
        $doctors = $this->DietPlan->Doctor->find('list');
        $this->set(compact('users', 'doctors'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {

        $this->layout = 'front_layout';
        $this->recursive = 0;
        $this->loadModel('DietPlan');
        $this->loadModel('DietPlansDetail');
        Configure::load('feish');
        $weekdays = Configure::read('feish.weekdays');
        $login_userId = $this->Auth->user('id');
        if (!$this->DietPlan->exists($id)) {
            throw new NotFoundException(__('Invalid diet plan'));
        }


        if ($this->request->is(array('post', 'put'))) {
            $this->DietPlan->id = $id;
            $this->request->data['DietPlan']['start_date'] = date('Y-m-d',  strtotime($this->request->data['DietPlan']['start_date']));
            $this->request->data['DietPlan']['end_date'] = date('Y-m-d',  strtotime($this->request->data['DietPlan']['end_date']));
            if ($this->DietPlan->save($this->request->data)) {

                $PlanDetails = $this->request->data['DietPlan']['PlanDetails'];
                foreach ($PlanDetails as $value) {
                    if (isset($value['edit_id'])) {
                        $this->DietPlansDetail->id = $value['edit_id'];
                        $diet_arr = array('weekday' => $value['weekday'], 'time' => date('H:i:s', strtotime($value['time'])), 'description' => $value['description'], 'modified_date' => date('Y-m-d i:m:s'));
                        $this->DietPlansDetail->save($diet_arr);
                    } else {
                        $this->DietPlansDetail->create();
                        $diet_arr = array('diet_plan_id' => $id, 'weekday' => $value['weekday'], 'time' => date('H:i:s', strtotime($value['time'])), 'description' => $value['description'], 'created_date' => date('Y-m-d i:m:s'));
                        $this->DietPlansDetail->save($diet_arr);
                    }
                }


                $this->Session->setFlash(__('The diet plan has been saved successfully.'), 'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The diet plan could not be saved. Please, try again.'), 'error');
            }
        } else {
            $options = array('conditions' => array('DietPlan.' . $this->DietPlan->primaryKey => $id));
            $this->request->data = $this->DietPlan->find('first', $options);
        }

        $diet_paln_details = $this->DietPlan->find('first', array('conditions' => array('DietPlan.id' => $id)));
        $this->set(compact('users', 'weekdays', 'diet_paln_details'));
    }

    public function patient_edit_diet_plan($id = null, $user_id, $user_type) {

        $this->recursive = 0;
        $this->loadModel('DietPlan');
        $this->loadModel('User');
        $this->loadModel('DietPlansDetail');
        Configure::load('feish');
        $weekdays = Configure::read('feish.weekdays');
        $login_userId = $this->Auth->user('id');
        if (!$this->DietPlan->exists($id)) {
            throw new NotFoundException(__('Invalid diet plan'));
        }


        if ($this->request->is(array('post', 'put'))) {
//            debug($this->request->data);die;
            $this->DietPlan->id = $id;
            $this->request->data['DietPlan']['start_date'] = date('Y-m-d', strtotime($this->request->data['DietPlan']['start_date']));
            $this->request->data['DietPlan']['end_date'] = date('Y-m-d', strtotime($this->request->data['DietPlan']['end_date']));
            if ($this->DietPlan->save($this->request->data)) {

                $PlanDetails = $this->request->data['DietPlan']['PlanDetails'];

                foreach ($PlanDetails as $value) {
                    if (isset($value['edit_id'])) {
                        $this->DietPlansDetail->id = $value['edit_id'];
                        $diet_arr = array('weekday' => $value['weekday'], 'time' => date('H:i:s', strtotime($value['time'])), 'description' => $value['description'], 'modified_date' => date('Y-m-d i:m:s'));
                       // debug($diet_arr);die;
                        $this->DietPlansDetail->save($diet_arr);
                    } else {
                        $this->DietPlansDetail->create();
                        $diet_arr = array('diet_plan_id' => $id, 'weekday' => $value['weekday'], 'time' => date('H:i:s', strtotime($value['time'])), 'description' => $value['description'], 'created_date' => date('Y-m-d i:m:s'));
                        $this->DietPlansDetail->save($diet_arr);
                    }
                }


                $this->Session->setFlash(__('The diet plan has been saved successfully.'), 'success');
                return $this->redirect(array('action' => 'patient_diet_plan', $user_id, $user_type));
            } else {
                $this->Session->setFlash(__('The diet plan could not be saved. Please, try again.'), 'error');
            }
        } else {
            $options = array('conditions' => array('DietPlan.' . $this->DietPlan->primaryKey => $id));
            $this->request->data = $this->DietPlan->find('first', $options);
        }

        $diet_paln_details = $this->DietPlan->find('first', array('conditions' => array('DietPlan.id' => $id)));

        $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $user_id),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');

        $this->set(compact('salutations', 'user', 'last_login', 'users', 'weekdays', 'diet_paln_details', 'user_id', 'user_type'));
    }
    
    public function assistant_edit_diet_plan($id = null, $user_id, $user_type) {

        $this->recursive = 0;
        $this->loadModel('DietPlan');
        $this->loadModel('User');
        $this->loadModel('DietPlansDetail');
        Configure::load('feish');
        $weekdays = Configure::read('feish.weekdays');
        $login_userId = $this->Auth->user('id');
        if (!$this->DietPlan->exists($id)) {
            throw new NotFoundException(__('Invalid diet plan'));
        }


        if ($this->request->is(array('post', 'put'))) {

            $this->DietPlan->id = $id;
            $this->request->data['DietPlan']['start_date'] = date('Y-m-d', strtotime($this->request->data['DietPlan']['start_date']));
            $this->request->data['DietPlan']['end_date'] = date('Y-m-d', strtotime($this->request->data['DietPlan']['end_date']));
            if ($this->DietPlan->save($this->request->data)) {

                $PlanDetails = $this->request->data['DietPlan']['PlanDetails'];

                foreach ($PlanDetails as $value) {
                    if (isset($value['edit_id'])) {
                        $this->DietPlansDetail->id = $value['edit_id'];
                        $diet_arr = array('weekday' => $value['weekday'], 'time' => date('H:i:s', strtotime($value['time'])), 'description' => $value['description'], 'modified_date' => date('Y-m-d i:m:s'));
                        $this->DietPlansDetail->save($diet_arr);
                    } else {
                        $this->DietPlansDetail->create();
                        $diet_arr = array('diet_plan_id' => $id, 'weekday' => $value['weekday'], 'time' => date('H:i:s', strtotime($value['time'])), 'description' => $value['description'], 'created_date' => date('Y-m-d i:m:s'));
                        $this->DietPlansDetail->save($diet_arr);
                    }
                }


                $this->Session->setFlash(__('The diet plan has been saved successfully.'), 'success');
                return $this->redirect(array('action' => 'assistant_diet_plan', $user_id, $user_type));
            } else {
                $this->Session->setFlash(__('The diet plan could not be saved. Please, try again.'), 'error');
                return $this->redirect(array('action' => 'assistant_diet_plan', $user_id, $user_type));
            }
        } else {
            $options = array('conditions' => array('DietPlan.' . $this->DietPlan->primaryKey => $id));
            $this->request->data = $this->DietPlan->find('first', $options);
        }

        $diet_paln_details = $this->DietPlan->find('first', array('conditions' => array('DietPlan.id' => $id)));

        $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $user_id),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');

        $this->set(compact('salutations', 'user', 'last_login', 'users', 'weekdays', 'diet_paln_details', 'user_id', 'user_type'));
    }

    function get_diet_plan_details() {
        $this->layout = null;
        $this->loadModel('DietPlan');
        $this->loadModel('DietPlansDetail');
        Configure::load('feish');
        $weekdays = Configure::read('feish.weekdays');

        if ($this->request->is('post')) {

            $diet_paln_details = $this->DietPlan->find('all', array('conditions' => array('DietPlan.id' => $this->request->data['id'])));
            $diet_paln_details = $diet_paln_details[0];

            if (!empty($diet_paln_details)) {
                $result = $diet_paln_details;
            } else {
                $result = 0;
            }

            $this->set(compact('result', 'weekdays'));
//            $this->render('filter');
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
        $this->DietPlan->id = $id;
        if (!$this->DietPlan->exists()) {
            throw new NotFoundException(__('Invalid diet plan'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->DietPlan->delete()) {
            $this->Session->setFlash(__('The diet plan has been deleted.'));
        } else {
            $this->Session->setFlash(__('The diet plan could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function delete_diet_plan() {
        $this->layout = null;
        $this->loadModel('DietPlansDetail');

        if ($this->request->is('post')) {

            $this->DietPlansDetail->id = $this->request->data['id'];
            $this->DietPlansDetail->delete();

            $result = 0;

            $this->set(compact('result'));
            $this->render('filter');
        }
    }

}
