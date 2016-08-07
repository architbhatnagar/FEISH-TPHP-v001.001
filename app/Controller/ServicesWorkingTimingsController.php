<?php

App::uses('AppController', 'Controller');

/**
 * ServicesWorkingTimings Controller
 *
 * @property ServicesWorkingTiming $ServicesWorkingTiming
 * @property PaginatorComponent $Paginator
 */
class ServicesWorkingTimingsController extends AppController {

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
        $this->ServicesWorkingTiming->recursive = 0;
        $this->set('servicesWorkingTimings', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->ServicesWorkingTiming->exists($id)) {
            throw new NotFoundException(__('Invalid services working timing'));
        }
        $options = array('conditions' => array('ServicesWorkingTiming.' . $this->ServicesWorkingTiming->primaryKey => $id));
        $this->set('servicesWorkingTiming', $this->ServicesWorkingTiming->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($service_id = null) {
        if ($this->request->is('post')) {
            $this->request->data['ServicesWorkingTiming']['service_id'] = $service_id;
            $this->request->data['ServicesWorkingTiming']['open_time'] = date('H:i:s', strtotime($this->request->data['ServicesWorkingTiming']['open_time']));
            $this->request->data['ServicesWorkingTiming']['close_time'] = date('H:i:s', strtotime($this->request->data['ServicesWorkingTiming']['close_time']));
            // debug($this->request->data);die;
            // `service_id` = '" . $data['service_id'] . "' AND `day_of_week` = '" . $data['day_of_week'] . "' AND ((`open_time` BETWEEN '" . $data['open_time'] . "' AND '" . $data['close_time'] . "')  OR(`close_time` BETWEEN '" . $data['open_time'] . "' AND '" . $data['close_time'] . "')  OR  ('open_time' <= '" . $data['open_time'] . "' AND 'close_time' >= '" . $data['close_time'] . "') OR('open_time' >= '" . $data['open_time'] . "' AND 'close_time'>='" . $data['close_time'] . "' AND 'open_time'<='" . $data['close_time'] . "')      OR      &&&&('open_time' <= '" . $data['open_time'] . "' AND 'close_time'<='" . $data['close_time'] . "' AND 'close_time'<='" . $data['open_time'] . "'))";
            //query = "SELECT * FROM (`services_working_timing`) WHERE `service_id` = '" . $data['service_id'] . "' AND `day_of_week` = '" . $data['day_of_week'] . "' AND ((`open_time` BETWEEN '" . $data['open_time'] . "' AND '" . $data['close_time'] . "') OR (`close_time` BETWEEN '" . $data['open_time'] . "' AND '" . $data['close_time'] . "') OR ('open_time' <= '" . $data['open_time'] . "' AND 'close_time' >= '" . $data['close_time'] . "') OR ('open_time' >= '" . $data['open_time'] . "' AND 'close_time'>='" . $data['close_time'] . "' AND 'open_time'<='" . $data['close_time'] . "') OR ('open_time' <= '" . $data['open_time'] . "' AND 'close_time'<='" . $data['close_time'] . "' AND 'close_time'<='" . $data['open_time'] . "'))";
           
            if(!empty($this->request->data['ServicesWorkingTiming']['id'])){
                $this->ServicesWorkingTiming->id=$this->request->data['ServicesWorkingTiming']['id'];
                 $exist = $this->ServicesWorkingTiming->find('count', array(
                'conditions' => array(
                    'ServicesWorkingTiming.id NOT'=>$this->request->data['ServicesWorkingTiming']['id'],
                    'ServicesWorkingTiming.service_id' => $service_id,
                    'ServicesWorkingTiming.day_of_week' => $this->request->data['ServicesWorkingTiming']['day_of_week'],
                    'OR' => array(
                        array(
                            'ServicesWorkingTiming.close_time between ? and ?' => array($this->request->data['ServicesWorkingTiming']['open_time'], $this->request->data['ServicesWorkingTiming']['close_time']),
                        ),
                        array(
                            'ServicesWorkingTiming.open_time between ? and ?' => array($this->request->data['ServicesWorkingTiming']['open_time'], $this->request->data['ServicesWorkingTiming']['close_time']),
                        ),
                        array(
                            'ServicesWorkingTiming.open_time <=' => $this->request->data['ServicesWorkingTiming']['open_time'],
                            'ServicesWorkingTiming.close_time >=' => $this->request->data['ServicesWorkingTiming']['close_time']
                        ),
                        array(
                            'ServicesWorkingTiming.open_time <=' => $this->request->data['ServicesWorkingTiming']['open_time'],
                            'ServicesWorkingTiming.close_time <=' => $this->request->data['ServicesWorkingTiming']['close_time'],
                            'ServicesWorkingTiming.close_time >=' => $this->request->data['ServicesWorkingTiming']['open_time']
                        ),
                        array(
                            'ServicesWorkingTiming.open_time >=' => $this->request->data['ServicesWorkingTiming']['open_time'],
                            'ServicesWorkingTiming.close_time >=' => $this->request->data['ServicesWorkingTiming']['close_time'],
                            'ServicesWorkingTiming.open_time <=' => $this->request->data['ServicesWorkingTiming']['close_time']
                        )
                        
                    )
                )
            ));
            }else{
                 $exist = $this->ServicesWorkingTiming->find('count', array(
                'conditions' => array(
                    'ServicesWorkingTiming.service_id' => $service_id,
                    'ServicesWorkingTiming.day_of_week' => $this->request->data['ServicesWorkingTiming']['day_of_week'],
                    'OR' => array(
                        array(
                            'ServicesWorkingTiming.close_time between ? and ?' => array($this->request->data['ServicesWorkingTiming']['open_time'], $this->request->data['ServicesWorkingTiming']['close_time']),
                        ),
                        array(
                            'ServicesWorkingTiming.open_time between ? and ?' => array($this->request->data['ServicesWorkingTiming']['open_time'], $this->request->data['ServicesWorkingTiming']['close_time']),
                        ),
                        array(
                            'ServicesWorkingTiming.open_time <=' => $this->request->data['ServicesWorkingTiming']['open_time'],
                            'ServicesWorkingTiming.close_time >=' => $this->request->data['ServicesWorkingTiming']['close_time']
                        ),
                        array(
                            'ServicesWorkingTiming.open_time <=' => $this->request->data['ServicesWorkingTiming']['open_time'],
                            'ServicesWorkingTiming.close_time <=' => $this->request->data['ServicesWorkingTiming']['close_time'],
                            'ServicesWorkingTiming.close_time >=' => $this->request->data['ServicesWorkingTiming']['open_time']
                        ),
                        array(
                            'ServicesWorkingTiming.open_time >=' => $this->request->data['ServicesWorkingTiming']['open_time'],
                            'ServicesWorkingTiming.close_time >=' => $this->request->data['ServicesWorkingTiming']['close_time'],
                            'ServicesWorkingTiming.open_time <=' => $this->request->data['ServicesWorkingTiming']['close_time']
                        )
                        
                    )
                )
            ));
                  $this->ServicesWorkingTiming->create();
            }
            //debug($exist);die;
          if($exist==0){
             
            if ($this->ServicesWorkingTiming->save($this->request->data)) {
                $this->Session->setFlash(__('The services working timing has been saved.'),'success');
                return $this->redirect(array('action' => 'add',$service_id));
            } else {
                $this->Session->setFlash(__('The services working timing could not be saved. Please, try again.'),'error');
            }
            return $this->redirect(array('action' => 'add', $service_id));
          }else{
               $this->Session->setFlash(__('Sorry, it looks like this time range overlaps with already existed timeslot, Please change it..'),'error');
                return $this->redirect(array('action' => 'add', $service_id));
          }
            
        }
        $working_timings = $this->ServicesWorkingTiming->find('all', array('conditions' => array('ServicesWorkingTiming.service_id' => $service_id), 'fields' => array('ServicesWorkingTiming.id', 'ServicesWorkingTiming.day_of_week', 'ServicesWorkingTiming.open_time', 'ServicesWorkingTiming.close_time')));
        Configure::load('feish');
        $week_days = Configure::read('feish.days');
        $day_wise_timimg = $week_days;
        foreach ($working_timings as $time) {
            if (!is_array($day_wise_timimg[$time['ServicesWorkingTiming']['day_of_week']])) {
                $day_wise_timimg[$time['ServicesWorkingTiming']['day_of_week']] = array();
            }
            array_push($day_wise_timimg[$time['ServicesWorkingTiming']['day_of_week']], $time);
        }
        //  debug($day_wise_timimg);die;
        $service_name = $this->ServicesWorkingTiming->Service->find('first', array('conditions' => array('Service.id' => $service_id), 'fields' => array('Service.title')));

        $services = $this->ServicesWorkingTiming->Service->find('list');
        $this->set(compact('services', 'week_days', 'day_wise_timimg', 'service_name'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->ServicesWorkingTiming->exists($id)) {
            throw new NotFoundException(__('Invalid services working timing'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ServicesWorkingTiming->save($this->request->data)) {
                $this->Session->setFlash(__('The services working timing has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The services working timing could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('ServicesWorkingTiming.' . $this->ServicesWorkingTiming->primaryKey => $id));
            $this->request->data = $this->ServicesWorkingTiming->find('first', $options);
        }
        $services = $this->ServicesWorkingTiming->Service->find('list');
        $this->set(compact('services'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->layout = null;
        if ($this->ServicesWorkingTiming->deleteAll(array('ServicesWorkingTiming.id'=>$id))) {
            $result = 1;
        } else {
            $result = 0;
        }
        $this->set(compact('result'));
        $this->render('filter');
    }

}
