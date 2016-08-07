<?php

App::uses('AppController', 'Controller');

/**
 * Services Controller
 *
 * @property Service $Service
 * @property PaginatorComponent $Paginator
 */
class ServicesController extends AppController {

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

        $this->Service->recursive = 0;
        if ($this->Auth->user('user_type') == 2) {
            $this->paginate = (array(
                'conditions' => array('Service.user_id' => $this->Auth->user('id')),
                'order' => 'Service.id DESC',
                'limit' => 20
            ));
        } else {
            $this->paginate = (array(
                'order' => 'Service.id DESC',
                'limit' => 20
            ));
        }

        $services = $this->Paginator->paginate();
        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
        $this->set(compact('yes_no', 'services'));
    }

    public function doctor_services_listing($id = null) {
        $this->Service->recursive = 0;
        $this->paginate = (array(
            'conditions' => array('Service.user_id' => $id),
            'order' => 'Specialty.id DESC',
            'limit' => 20
        ));
        $services = $this->Paginator->paginate();
        $this->loadModel('User');
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));
        // debug($user);die;
        $this->loadModel('LoginDetail');
        $last_login = $this->LoginDetail->find('first', array(
            'conditions' => array('LoginDetail.user_id' => $id),
            'fields' => array('LoginDetail.created'),
            'order' => 'LoginDetail.id DESC'
        ));
        Configure::load('feish');

        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        // debug($last_login);die;

        $this->set(compact('user', 'last_login', 'yes_no', 'services', 'salutations'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Service->exists($id)) {
            throw new NotFoundException(__('Invalid service'));
        }
        $options = array('conditions' => array('Service.' . $this->Service->primaryKey => $id));
        $service = $this->Service->find('first', $options);
        $fetched_timings = $service['Timing'];
        $timing_arr = array();
        foreach ($fetched_timings as $timimg) {
            $timing_arr[$timimg['day_of_week']][$timimg['open_time']] = $timimg;
        }
        ksort($timing_arr);
        foreach ($timing_arr as $key => $new_ar) {
            $inner_ar = $new_ar;
            ksort($inner_ar);
            $timing_arr[$key] = $inner_ar;
        }
        Configure::load('feish');
        $days = Configure::read('feish.days');
        $yes_no = Configure::read('feish.yes_no');
        $this->loadModel('Specialty');
        $specialities = array();
        if (!empty($service['Service']['specialty_id'])) {
            $sp_array=json_decode($service['Service']['specialty_id']);
            $specialities = $this->Specialty->find('list', array('conditions' => array('Specialty.id' => $sp_array), 'fields' => array('id', 'specialty_name')));
        }
        $this->set(compact('service', 'timing_arr', 'days', 'specialities', 'yes_no'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() { 
        if ($this->request->is('post')) {
             
            if (isset($this->request->data['Service']['logo']['name']) && !empty($this->request->data['Service']['logo']['name'])) {
                $this->loadModel('User');
                $this->request->data['Service']['logo'] = $this->User->uploadMainImage($this->request->data['Service']['logo'], 'services');
            }else{
                 $this->request->data['Service']['logo']='';
            }
            $this->request->data['Service']['specialty_id'] = json_encode($this->request->data['Service']['specialty_id']);
            $this->request->data['Service']['user_id'] = $this->Auth->user('id');
//            debug($this->request->data);die;
            $this->Service->create();
            if ($this->Service->save($this->request->data)) {
                $this->Session->setFlash(__('The service has been saved.'), 'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The service could not be saved. Please, try again.'), 'error');
            }
        }
        $users = $this->Service->User->find('list');
        
        $specialties = $this->Service->Specialty->find('list', array('conditions'=>array('is_deleted'=>0),'fields' => array('id', 'specialty_name')));
        $this->set(compact('users', 'parentSpecialties', 'specialties', 'diseases', 'keywords'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) { 
        if (!$this->Service->exists($id)) {
            throw new NotFoundException(__('Invalid service'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if (isset($this->request->data['Service']['logo_new']['name']) && !empty($this->request->data['Service']['logo_new']['name'])) {
                $this->loadModel('User');
                $this->request->data['Service']['logo'] = $this->User->uploadMainImage($this->request->data['Service']['logo_new'], 'services');
            }
            $this->request->data['Service']['specialty_id'] = implode(',',$this->request->data['Service']['specialty_id']);
            $this->Service->id = $id;
            if ($this->Service->save($this->request->data)) {

                $this->Session->setFlash(__('The service has been saved.'), 'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The service could not be saved. Please, try again.'), 'error');
            }
        } else {
            $options = array('conditions' => array('Service.' . $this->Service->primaryKey => $id));
            $this->request->data = $this->Service->find('first', $options);
        }
        $users = $this->Service->User->find('list');
        $specialties = $this->Service->Specialty->find('list', array('conditions'=>array('is_deleted'=>0),'fields' => array('id', 'specialty_name')));
        $this->set(compact('users', 'parentSpecialties', 'specialties', 'diseases', 'keywords'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function change_status($id = null, $user_id = null) {
        $data = $this->Service->find('first', array('conditions' => array('Service.id' => $id), 'fields' => array('is_active')));
        $status = 0;
        if ($data['Service']['is_active'] == 0) {
            $status = 1;
        } else {
            $status = 0;
        }

        if ($this->Service->updateAll(array('Service.is_active' => $status), array('Service.id' => $id))) {
            if ($status == 0) {
                $this->Session->setFlash(__('The Service has been Deactivated.'), 'success');
            } else {
                $this->Session->setFlash(__('The Service has been Activated.'), 'success');
            }
        } else {
            if ($status == 0) {
                $this->Session->setFlash(__('The Service could not be Deactivated.Please Try again'), 'error');
            } else {
                $this->Session->setFlash(__('The Service could not be Activated..Please Try again'), 'error');
            }
        }
        if (empty($user_id)) {
            return $this->redirect(array('action' => 'index'));
        } else {
            return $this->redirect(array('action' => 'doctor_services_listing', $user_id));
        }
    }

    public function delete($id = null, $user_id = null) {
        $this->Service->id = $id;
        if (!$this->Service->exists()) {
            throw new NotFoundException(__('Invalid service'));
        }
        $data = $this->Service->find('first', array('conditions' => array('Service.id' => $id), 'fields' => array('is_deleted')));
        $status = 0;
        if ($data['Service']['is_deleted'] == 0) {
            $status = 1;
        } else {
            $status = 0;
        }

        if ($this->Service->updateAll(array('Service.is_deleted' => $status), array('Service.id' => $id))) {
            if ($status == 0) {
                $this->Session->setFlash(__('The Service has been restored.'), 'success');
            } else {
                $this->Session->setFlash(__('The Service has been deleted.'), 'success');
            }
        } else {
            if ($status == 0) {
                $this->Session->setFlash(__('The Service could not be restored.Please Try again'), 'error');
            } else {
                $this->Session->setFlash(__('The Service could not be deleted..Please Try again'), 'error');
            }
        }
        if (empty($user_id)) {
            return $this->redirect(array('action' => 'index'));
        } else {
            return $this->redirect(array('action' => 'doctor_services_listing', $user_id));
        }
    }

    public function services_listing() {
        $this->layout = 'front_layout';
         $this->Service->recursive = 0;
        if($this->request->is('post')){ 
            if(!empty($this->request->data['Service']['lat'])){ 
            $lat=$this->request->data['Service']['lat'];
            $long=$this->request->data['Service']['long'];
            $field_text='(3959 * acos (cos ( radians('. $lat.') )* cos( radians(latitude ) )* cos( radians(longitude) - radians('.$long .') ) + sin ( radians('. $lat.') )* sin( radians(latitude))))'; 
//           debug($this->request->data['Service']['speciality']); die;
            if($this->request->data['Service']['speciality'] == ''){
                $condition = array('Service.is_deleted' => 0,'Service.is_active'=>1);
            } else {
                $condition = array('Service.is_deleted' => 0,'Service.is_active'=>1,'FIND_IN_SET(' . $this->request->data['Service']['speciality'] . ',Service.specialty_id)');
            }
            $this->paginate = (array(
                'fields'=>array('Service.*',$field_text.' AS distance'),
                'conditions' => $condition,
                'order' => 'distance ASC',
                'having'=>array('distance <='=>1000),
                'limit' => 20,
                'recursive'=>-1
            ));  
            }else{ 
//                $this->request->data=array();
                /*added by yogesh more date :: 11 april 2016*/
                $this->paginate = (array(
                'conditions' => array('Service.is_deleted' => 0,'Service.is_active'=>1),
                'order' => 'Service.id DESC',
                'limit' => 20
            ));  
            }
            
        }else{ 
           $this->paginate = (array(
                'conditions' => array('Service.is_deleted' => 0,'Service.is_active'=>1),
                'order' => 'Service.id DESC',
                'limit' => 20
            ));  
        }
        /*
         SELECT id, latitude, longitude, (
3959 * ACOS( COS( RADIANS( 18.5177472 ) ) * COS( RADIANS( latitude ) ) * COS( RADIANS( longitude ) - RADIANS( 73.93674429999999 ) ) + SIN( RADIANS( 18.5177472 ) ) * SIN( RADIANS( latitude ) ) )
) AS distance
FROM services
HAVING distance <20000
ORDER BY distance
LIMIT 0 , 20

        
         */
           
       

        $services = $this->Paginator->paginate();
//       echo '<pre>';print_r($services);die;
        $this->loadModel('Specialty');
        $specialities=$this->Specialty->find('list',array('fields'=>array('Specialty.id','Specialty.specialty_name')));
//        debug($services);die;
        Configure::load('feish');
        $yes_no = Configure::read('feish.yes_no');
        $this->set(compact('yes_no', 'services','specialities'));
    }
    public function service_details($id=null){ 
        
        $user_loggedin = $this->Auth->user();
        $this->layout='front_layout';
        if (!$this->Service->exists($id)) {
            throw new NotFoundException(__('Invalid service'));
        }
        $options = array('conditions' => array('Service.' . $this->Service->primaryKey => $id));
        $service = $this->Service->find('first', $options);
//        debug($service);die;
        $fetched_timings = $service['Timing'];
        $timing_arr = array();
        foreach ($fetched_timings as $timimg) {
            $timing_arr[$timimg['day_of_week']][$timimg['open_time']] = $timimg;
        }
        ksort($timing_arr);
        foreach ($timing_arr as $key => $new_ar) {
            $inner_ar = $new_ar;
            ksort($inner_ar);
            $timing_arr[$key] = $inner_ar;
        }
        Configure::load('feish');
        $days = Configure::read('feish.days');
        $yes_no = Configure::read('feish.yes_no');
        $salutations = Configure::read('feish.salutations');
        $this->loadModel('Specialty');
        $specialities = array();
        if (!empty($service['Service']['specialty_id'])) {
            $sp_array = explode(",", $service['Service']['specialty_id']);
            $specialities = $this->Specialty->find('list', array('conditions' => array('Specialty.id' => $sp_array), 'fields' => array('id', 'specialty_name')));
        }
        $this->loadModel('Review');
        $reviews=$this->Review->find('all',array('conditions'=>array('Review.service_id'=>$id,'Review.is_verified'=>1),'fields'=>array('Review.*','User.salutation','User.first_name','User.last_name','Service.avg_rating')));
//         debug($reviews);die;
//         $tot_review=0;
//         foreach($reviews as $review){
//             $tot_review+=$review['Review']['rating'];
//         }
//         $avg_rating=0;
//         if(count($reviews)>0){
//              $avg_rating=$tot_review/count($reviews);
//         }
        
        $this->loadModel('PatientPackageLog');
        $packege_exists = $this->PatientPackageLog->find('count',array('conditions'=>array('PatientPackageLog.user_id'=>$this->Auth->user('id'),'PatientPackageLog.service_id'=>$id,'PatientPackageLog.is_active'=>1)));
        /*added by yogesh*/
        $purchased_plan_list = $this->PatientPackageLog->find('list', array('conditions' => array('PatientPackageLog.user_id'=>$this->Auth->user('id'),'PatientPackageLog.is_active'=>1,'PatientPackageLog.service_id'=>$id), 'fields' => array('PatientPackageLog.id', 'PatientPackageLog.package_name')));
//        debug($purchased_plan_list);die;
        $this->set(compact('purchased_plan_list','packege_exists','id','avg_rating','user_loggedin','service', 'timing_arr', 'days', 'specialities', 'yes_no','salutations','reviews'));
         
    }

    public function beforeFilter() {
        $this->Auth->allow(array('services_listing', 'service_details'));
       
    }

}
