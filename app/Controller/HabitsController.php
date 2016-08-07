<?php

App::uses('AppController', 'Controller');

/**
 * Habits Controller
 *
 * @property Habit $Habit
 * @property PaginatorComponent $Paginator
 */
class HabitsController extends AppController {

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
        $this->Habit->recursive = 0;
        $this->Paginator->settings = array(
            'limit' => 10
        );
        $habits = $this->Paginator->paginate();
        $this->set('habits', $habits);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Habit->exists($id)) {
            throw new NotFoundException(__('Invalid habit'));
        }
        $options = array('conditions' => array('Habit.' . $this->Habit->primaryKey => $id));
        $this->set('habit', $this->Habit->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $habit = $this->request->data;
            foreach ($habit['Habit'] as $value) {
                $saveHabit['Habit'] = $value;
                $this->Habit->create();
                if ($this->Habit->save($saveHabit)) {
                    $flag = true;
                } else {
                    $flag = false;
                }
            } 
            if($flag){
                $this->Session->setFlash(__('The habit has been saved.'),'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The habit could not be saved. Please, try again.'),'error');
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
        if (!$this->Habit->exists($id)) {
            throw new NotFoundException(__('Invalid habit'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Habit->save($this->request->data)) {
                $this->Session->setFlash(__('The habit has been saved.'), 'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The habit could not be saved. Please, try again.'), 'error');
            }
        } else {
            $options = array('conditions' => array('Habit.' . $this->Habit->primaryKey => $id));
            $this->request->data = $this->Habit->find('first', $options);
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
        $this->Habit->id = $id;
        if (!$this->Habit->exists()) {
            throw new NotFoundException(__('Invalid habit'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Habit->delete()) {
            $this->Session->setFlash(__('The habit has been deleted.'), 'success');
        } else {
            $this->Session->setFlash(__('The habit could not be deleted. Please, try again.'), 'error');
        }
        return $this->redirect($this->referer());
    }

}
