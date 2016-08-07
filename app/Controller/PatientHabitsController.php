<?php

App::uses('AppController', 'Controller');

/**
 * PatientHabits Controller
 *
 * @property PatientHabit $PatientHabit
 * @property PaginatorComponent $Paginator
 */
class PatientHabitsController extends AppController {

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
    public function beforeFilter() {
        $action = $this->request->action;
        $front_actions = array('health_profile', 'add_habits');
        if (in_array($action, $front_actions)) {
            $this->layout = 'front_layout';
        }
    }

    public function index() {
        $this->PatientHabit->recursive = 0;
        $this->set('patientHabits', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->PatientHabit->exists($id)) {
            throw new NotFoundException(__('Invalid patient habit'));
        }
        $options = array('conditions' => array('PatientHabit.' . $this->PatientHabit->primaryKey => $id));
        $this->set('patientHabit', $this->PatientHabit->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->PatientHabit->create();
            if ($this->PatientHabit->save($this->request->data)) {
                $this->Session->setFlash(__('The patient habit has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The patient habit could not be saved. Please, try again.'));
            }
        }
        $users = $this->PatientHabit->User->find('list');
        $habits = $this->PatientHabit->Habit->find('list');
        $this->set(compact('users', 'habits'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->PatientHabit->exists($id)) {
            throw new NotFoundException(__('Invalid patient habit'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->PatientHabit->save($this->request->data)) {
                $this->Session->setFlash(__('The patient habit has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The patient habit could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('PatientHabit.' . $this->PatientHabit->primaryKey => $id));
            $this->request->data = $this->PatientHabit->find('first', $options);
        }
        $users = $this->PatientHabit->User->find('list');
        $habits = $this->PatientHabit->Habit->find('list');
        $this->set(compact('users', 'habits'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->PatientHabit->id = $id;
        if (!$this->PatientHabit->exists()) {
            throw new NotFoundException(__('Invalid patient habit'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->PatientHabit->delete()) {
            $this->Session->setFlash(__('The patient habit has been deleted.'));
        } else {
            $this->Session->setFlash(__('The patient habit could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function health_profile() { 
        
         Configure::load('feish');

        $gender = Configure::read('feish.gender');
        $this->loadModel('User');
        $this->loadModel('PatientHabit');
        $this->loadModel('LoginDetail');
        $user_id = Authcomponent::user('id');
        $options = array(
            'conditions' =>
                    array(
                           'User.' . $this->PatientHabit->User->primaryKey => Authcomponent::user('id'),
                        ),
            );

        $user = $this->PatientHabit->User->find('first', $options);
//        debug($user);die;
        $this->recursive = 0;
        if (!empty($user_id)) {
            $this->paginate = array(
                'conditions' => array('PatientHabit.user_id' => $user_id),
                'order' => 'PatientHabit.id DESC',
                'limit' => 10
            );
        } else {
            $this->paginate = array(
                'order' => 'PatientHabit.id DESC',
                'limit' => 10
            );
        }
        //$this->PatientHabit->unbindModel(array('$belongsTo' => array('User','Habit')), true);
        $patient_habits = $this->Paginator->paginate();
        $this->set(compact('user', 'patient_habits','gender'));
    }
    
    public function patient_health_profile($id,$user_type) { 
       $this->loadModel('User');
        $this->loadModel('PatientHabit');
        $user_id = Authcomponent::user('id');
        $user_type_id = Authcomponent::user('user_type');
//        $options = array('conditions' => array('User.' . $this->PatientHabit->User->primaryKey => Authcomponent::user('id')));
//        $user = $this->PatientHabit->User->find('first', $options);
        
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id),'recursive'=>-1));
//        debug($user);die;
        
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $blood_groups = Configure::read('feish.blood_groups');
        
        $this->recursive = 0;
        if (!empty($id)) {
            $this->paginate = array(
                'conditions' => array('PatientHabit.user_id' => $id),
                'order' => 'PatientHabit.id DESC',
                'limit' => 10
            );
        } else {
            $this->paginate = array(
                'order' => 'PatientHabit.id DESC',
                'limit' => 10
            );
        }
        
        $patient_habits = $this->Paginator->paginate();
        
        $this->set(compact('user', 'patient_habits','salutations','last_login','user_type_id','blood_groups'));
    }
    
    public function get_health_habbit_byid() {
        $this->layout = null;
        $this->loadModel('PatientHabit');
        
        if ($this->request->is('post')) {

            $data = $this->request->data;
            $habbit_history = $this->PatientHabit->find('first', array('conditions' => array('PatientHabit.id' => $this->request->data['id'])));
            if (!empty($habbit_history)) {
                $result = $habbit_history;
            } else {
                $result = 0;
            }
            $this->set(compact('result'));
            $this->render('filter');
        }
    }
    
    public function assistant_health_profile($id,$user_type) { 
       $this->loadModel('User');
        $this->loadModel('PatientHabit');
        $user_id = Authcomponent::user('id');
        
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id),'recursive'=>-1));

        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $blood_groups = Configure::read('feish.blood_groups');
        
        $this->recursive = 0;
        if (!empty($id)) {
            $this->paginate = array(
                'conditions' => array('PatientHabit.user_id' => $id),
                'order' => 'PatientHabit.id DESC',
                'limit' => 10
            );
        } else {
            $this->paginate = array(
                'order' => 'PatientHabit.id DESC',
                'limit' => 10
            );
        }
        
        $patient_habits = $this->Paginator->paginate();

        $this->set(compact('user', 'patient_habits','salutations','last_login', 'yes_no', 'blood_groups'));
    }
    
      

    public function add_habits() {
        if ($this->request->is(array('post', 'put'))) {

            $post_data = $this->request->data;
//            debug($post_data);die;
            $insert_data = array();
            $added_array = array();
            foreach ($post_data['habits'] as $key => $data) {

                $save_data = array();
                if (isset($data['is_habit'])) {
                 
                    if (isset($data['habit_id']) && !empty($data['habit_id'])) {
                        $ex_entry = $this->PatientHabit->find('first', array('conditions' => array('PatientHabit.user_id' => $this->Auth->user('id'), 'PatientHabit.habit_id' => $data['habit_id']), 'fields' => array('PatientHabit.id')));
                        
                        $save_data['PatientHabit']['frequency'] = $data['frequency'];
                        $save_data['PatientHabit']['unit'] = $data['unit'];
                        $save_data['PatientHabit']['time_period'] = $data['time_period'];
                        $save_data['PatientHabit']['habit_since'] = $data['habit_since'];
                        if (isset($data['is_stopped']) && !empty($data['is_stopped'])) {
                            $save_data['PatientHabit']['is_stopped'] = $data['is_stopped'];
                            $save_data['PatientHabit']['stopped_date'] = date('Y-m-d',  strtotime($data['stopped_date']));
                        } else {
                            $save_data['PatientHabit']['is_stopped'] = 0;
                            $save_data['PatientHabit']['stopped_date'] = null;
                        }
                        if (!empty($ex_entry)) {
                            $this->PatientHabit->id = $ex_entry['PatientHabit']['id'];
                        } else {  
                            $save_data['PatientHabit']['habit_id'] = $data['habit_id'];
                            $save_data['PatientHabit']['user_id'] = $this->Auth->user('id');
                            $save_data['PatientHabit']['added_by'] = $this->Auth->user('id');
                            $save_data['PatientHabit']['last_updated_by'] = $this->Auth->user('id');
                            $save_data['PatientHabit']['created'] = date('Y-m-d H:i:s');
                            $this->PatientHabit->create();
                        }

                        if ($this->PatientHabit->save($save_data)) {
                            array_push($added_array, $this->PatientHabit->id);
                        }
                    }
                }
            }

            $this->PatientHabit->deleteAll(array('PatientHabit.id NOT' => $added_array, 'PatientHabit.user_id' => $this->Auth->user('id')));

            return $this->redirect(array('action' => 'health_profile'));
        }

        $habits = $this->PatientHabit->Habit->find('all');
        $options = array('conditions' => array('User.' . $this->PatientHabit->User->primaryKey => Authcomponent::user('id')));
        $patient_habbit = $this->PatientHabit->find('all', $options);

        $already_habit_arr = array();
        foreach ($patient_habbit as $habit) {
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['frequency'] = $habit['PatientHabit']['frequency'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['unit'] = $habit['PatientHabit']['unit'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['time_period'] = $habit['PatientHabit']['time_period'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['habit_since'] = $habit['PatientHabit']['habit_since'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['is_stopped'] = $habit['PatientHabit']['is_stopped'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['stopped_date'] = $habit['PatientHabit']['stopped_date'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['id'] = $habit['PatientHabit']['id'];
        }
        Configure::load('feish');
        $units = Configure::read('feish.units');
        $time_period = Configure::read('feish.time_period');
        $habit_since = range(1947,date('Y'),1);
        $habit_since=  array_combine($habit_since, $habit_since);
        $this->set(compact('habits', 'patient_habbit', 'already_habit_arr', 'units', 'time_period', 'habit_since'));
    }
    
    public function patient_add_habits($id,$user_type) { 
         $this->loadModel('User');
        $this->loadModel('PatientHabit');
        if ($this->request->is(array('post', 'put'))) {
//            debug($this->request->data);die;
            $post_data = $this->request->data;
            $insert_data = array();
            $added_array = array();
            foreach ($post_data['habits'] as $key => $data) {

                $save_data = array();
                if (isset($data['is_habit'])) {
                 
                    if (isset($data['habit_id']) && !empty($data['habit_id'])) {
                        $ex_entry = $this->PatientHabit->find('first', array('conditions' => array('PatientHabit.user_id' => $id, 'PatientHabit.habit_id' => $data['habit_id']), 'fields' => array('PatientHabit.id')));
                        
                        $save_data['PatientHabit']['frequency'] = $data['frequency'];
                        $save_data['PatientHabit']['unit'] = $data['unit'];
                        $save_data['PatientHabit']['time_period'] = $data['time_period'];
                        $save_data['PatientHabit']['habit_since'] = $data['habit_since'];
                        if (isset($data['is_stopped']) && !empty($data['is_stopped'])) {
                            $save_data['PatientHabit']['is_stopped'] = $data['is_stopped'];
                            $save_data['PatientHabit']['stopped_date'] = date('Y-m-d',  strtotime($data['stopped_date']));
                        } else {
                            $save_data['PatientHabit']['is_stopped'] = 0;
                            $save_data['PatientHabit']['stopped_date'] = null;
                        }
                        if (!empty($ex_entry)) {
                            $this->PatientHabit->id = $ex_entry['PatientHabit']['id'];
                        } else {  
                            $save_data['PatientHabit']['habit_id'] = $data['habit_id'];
                            $save_data['PatientHabit']['user_id'] = $id;
                            $save_data['PatientHabit']['added_by'] = $this->Auth->user('id');
                            $save_data['PatientHabit']['last_updated_by'] = $id;
                            $save_data['PatientHabit']['created'] = date('Y-m-d H:i:s');
                            $this->PatientHabit->create();
                        }

                        if ($this->PatientHabit->save($save_data)) {
                            array_push($added_array, $this->PatientHabit->id);
                        }
                    }
                }
            }

            $this->PatientHabit->deleteAll(array('PatientHabit.id NOT' => $added_array, 'PatientHabit.user_id' => $id));
             $this->Session->setFlash(__('Patient habit has been saved.'), 'success');
            return $this->redirect(array('action' => 'patient_health_profile',$id,$user_type));
        }

        $habits = $this->PatientHabit->Habit->find('all');
        $options = array('conditions' => array('User.' . $this->PatientHabit->User->primaryKey => $id));
        $patient_habbit = $this->PatientHabit->find('all', $options);

        $already_habit_arr = array();
        foreach ($patient_habbit as $habit) {
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['frequency'] = $habit['PatientHabit']['frequency'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['unit'] = $habit['PatientHabit']['unit'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['time_period'] = $habit['PatientHabit']['time_period'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['habit_since'] = $habit['PatientHabit']['habit_since'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['is_stopped'] = $habit['PatientHabit']['is_stopped'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['stopped_date'] = $habit['PatientHabit']['stopped_date'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['id'] = $habit['PatientHabit']['id'];
        }
        
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $id),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        
        
        Configure::load('feish');
        $units = Configure::read('feish.units');
        $time_period = Configure::read('feish.time_period');
        $habit_since = range(1947,date('Y'),1);
        $habit_since=  array_combine($habit_since, $habit_since);
        $this->set(compact('last_login','salutations','user','habits', 'patient_habbit', 'already_habit_arr', 'units', 'time_period', 'habit_since'));
    }
    
    public function assistant_add_habits($id,$user_type) { 
        $this->loadModel('User');
        $this->loadModel('PatientHabit');
        if ($this->request->is(array('post', 'put'))) {

            $post_data = $this->request->data;
            $insert_data = array();
            $added_array = array();
            foreach ($post_data['habits'] as $key => $data) {

                $save_data = array();
                if (isset($data['is_habit'])) {
                 
                    if (isset($data['habit_id']) && !empty($data['habit_id'])) {
                        $ex_entry = $this->PatientHabit->find('first', array('conditions' => array('PatientHabit.user_id' => $id, 'PatientHabit.habit_id' => $data['habit_id']), 'fields' => array('PatientHabit.id')));
                        
                        $save_data['PatientHabit']['frequency'] = $data['frequency'];
                        $save_data['PatientHabit']['unit'] = $data['unit'];
                        $save_data['PatientHabit']['time_period'] = $data['time_period'];
                        $save_data['PatientHabit']['habit_since'] = $data['habit_since'];
                        if (isset($data['is_stopped']) && !empty($data['is_stopped'])) {
                            $save_data['PatientHabit']['is_stopped'] = $data['is_stopped'];
                            $save_data['PatientHabit']['stopped_date'] = date('Y-m-d',  strtotime($data['stopped_date']));
                        } else {
                            $save_data['PatientHabit']['is_stopped'] = 0;
                            $save_data['PatientHabit']['stopped_date'] = null;
                        }
                        if (!empty($ex_entry)) {
                            $this->PatientHabit->id = $ex_entry['PatientHabit']['id'];
                        } else {  
                            $save_data['PatientHabit']['habit_id'] = $data['habit_id'];
                            $save_data['PatientHabit']['user_id'] = $id;
                            $save_data['PatientHabit']['added_by'] = $this->Auth->user('id');
                            $save_data['PatientHabit']['last_updated_by'] = $id;
                            $save_data['PatientHabit']['created'] = date('Y-m-d H:i:s');
                            $this->PatientHabit->create();
                        }

                        if ($this->PatientHabit->save($save_data)) {
                            array_push($added_array, $this->PatientHabit->id);
                        }
                    }
                }
            }

            $this->PatientHabit->deleteAll(array('PatientHabit.id NOT' => $added_array, 'PatientHabit.user_id' => $id));
            $this->Session->setFlash(__('Patient habit has been saved.'), 'success');
            return $this->redirect(array('action' => 'assistant_health_profile',$id,$user_type));
        }

        $habits = $this->PatientHabit->Habit->find('all');
        $options = array('conditions' => array('User.' . $this->PatientHabit->User->primaryKey => $id));
        $patient_habbit = $this->PatientHabit->find('all', $options);

        $already_habit_arr = array();
        foreach ($patient_habbit as $habit) {
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['frequency'] = $habit['PatientHabit']['frequency'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['unit'] = $habit['PatientHabit']['unit'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['time_period'] = $habit['PatientHabit']['time_period'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['habit_since'] = $habit['PatientHabit']['habit_since'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['is_stopped'] = $habit['PatientHabit']['is_stopped'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['stopped_date'] = $habit['PatientHabit']['stopped_date'];
            $already_habit_arr[$habit['PatientHabit']['habit_id']]['id'] = $habit['PatientHabit']['id'];
        }
        
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $id),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        
        Configure::load('feish');
        $units = Configure::read('feish.units');
        $time_period = Configure::read('feish.time_period');
//        $habit_since = Configure::read('feish.habit_since');
        $habit_since = range(1947,date('Y'),1);
        $habit_since=  array_combine($habit_since, $habit_since);
        $this->set(compact('last_login','salutations','user','habits', 'patient_habbit', 'already_habit_arr', 'units', 'time_period', 'habit_since'));
    }

//     public function add_habits(){ 
//        if ($this->request->is(array('post', 'put'))) {
//            echo "<pre>";print_r($this->request->data);die;
//            $post_data = $this->request->data;
//            $save_data = array();
//            foreach ($post_data['habits'] as $data) {
//                if(isset($data['frequency']) && !empty($data['frequency'])) {
//                    $temp = array();
//                    $temp['user_id'] = Authcomponent::User('id');
//                    $temp['added_by'] = $temp['user_id'];
//                    $temp['last_updated_by'] = $temp['user_id'];
//                    $temp['created'] = date('Y-m-d H:i:s');
//                    
//                    foreach($data as $key=>$val) {
//                        
//                        //print_r("$key : $val"). PHP_EOL;
//                        $temp[$key] = $val;
//                    }
//                    
//                    unset($temp['is_habit']);
//                    $temp['stopped_date'] = ($temp['stopped_date'] == '') ? null : $temp['stopped_date'];
//                    $this->PatientHabit->create();
//                    if ($this->PatientHabit->save($temp)) {
//                        $this->Session->setFlash(__('The patient habit has been saved.'));
//                        return $this->redirect(array('action' => 'health_profile'));
//                    } else {
//                        $this->Session->setFlash(__('The patient habit could not be saved. Please, try again.'));
//                    }
//                }
//            }
//            //$this->health_profile();
//            //redirect('/patient/dashboard/health_profile','refresh'); 
//        }
//
//        $habits = $this->PatientHabit->Habit->find('all');
//        $this->set(compact('habits'));
//    }



    /*
      TRUNCATE patient_habits
      ALTER TABLE `patient_habits` ADD PRIMARY KEY(`id`);
      ALTER TABLE `patient_habits` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;
      ALTER TABLE `patient_habits` CHANGE `unit` `unit` VARCHAR(30) NOT NULL;
      ALTER TABLE `patient_habits` CHANGE `time_period` `time_period` VARCHAR(30) NOT NULL;
      ALTER TABLE `patient_habits` DROP `is_stopped`; */
}
