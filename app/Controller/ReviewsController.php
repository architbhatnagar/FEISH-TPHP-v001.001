<?php

App::uses('AppController', 'Controller');

/**
 * Reviews Controller
 *
 * @property Review $Review
 * @property PaginatorComponent $Paginator
 */
class ReviewsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method for admin
     *
     * @return void
     */
    public function admin_index() {
        $this->loadModel('Service');
        $serviceArr = array();
        $this->Review->recursive = 0;
        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => array(
                'Review.id' => 'desc'
            )
        );
        $reviews = $this->Paginator->paginate();
        foreach ($reviews as $key => $value) {
            array_push($serviceArr, $value['Service']['title']);
        }
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $this->set(compact('reviews', 'serviceArr','salutations'));
    }
    
    /**
     * index method for dr
     *
     * @return void
     */
    public function index() {
        $this->loadModel('Service');
        $serviceArr = array();
        $services = $this->Service->find('list', array('conditions' => array('Service.user_id' => $this->Auth->user('id'))));
        $this->Review->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('Review.is_verified' => '1', 'Review.service_id' => array_keys($services)),
            'limit' => 10,
            'order' => array(
                'Review.id' => 'desc',
                'Review.service_id' => 'asc',
                'group' => 'Review.service_id'
            )
        );
        $reviews = $this->Paginator->paginate();
//        debug($reviews); die;
        foreach ($reviews as $value) {
            array_push($serviceArr, $value['Service']['title']);
        }
        Configure::load('feish');
        $salutations = Configure::read('feish.salutations');
        $this->set(compact('reviews', 'services', 'serviceArr','salutations'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Review->exists($id)) {
            throw new NotFoundException(__('Invalid review'));
        }
        $options = array('conditions' => array('Review.' . $this->Review->primaryKey => $id));
        $this->set('review', $this->Review->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Review->create();
            if ($this->Review->save($this->request->data)) {
                $this->Session->setFlash(__('The review has been saved.'), 'success');
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The review could not be saved. Please, try again.'), 'error');
            }
        }
        $services = $this->Review->Service->find('list');
        $users = $this->Review->User->find('list');
        $this->set(compact('services', 'users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Review->exists($id)) {
            throw new NotFoundException(__('Invalid review'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Review->save($this->request->data)) {
                $this->Session->setFlash(__('The review has been saved.'));
                return $this->redirect(array('action' => 'admin_index'));
            } else {
                $this->Session->setFlash(__('The review could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Review.' . $this->Review->primaryKey => $id));
            $this->request->data = $this->Review->find('first', $options);
        }
        $services = $this->Review->Service->find('list');
        $users = $this->Review->User->find('list');
        $this->set(compact('services', 'users'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Review->id = $id;
        if (!$this->Review->exists()) {
            throw new NotFoundException(__('Invalid review'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Review->delete()) {
            $this->Session->setFlash(__('The review has been deleted.'));
        } else {
            $this->Session->setFlash(__('The review could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function approve_disapprove() {
        $flag = true;
        $serAvgRating = $userAvgRating = array();
        $this->loadModel('User');
        $this->loadModel('Service');
        $updateData = $this->request->data;
        ////find current rating and Service's prev rating
        $this->Review->recursive = 0;
        $options = array('conditions' => array('Review.' . $this->Review->primaryKey => $updateData['id']), 'feilds' => array('Review.rating'));
        $ratings = $this->Review->find('first', $options);
        
        $serAvgRating['id'] = $ratings['Service']['id'];
        ////save user's avg rating
        $this->User->recursive = -1;
        $userAvgRating['id'] = $ratings['Service']['user_id'];
        $options2 = array('conditions' => array('User.' . $this->User->primaryKey => $userAvgRating['id']), 'feilds' => array('User.prev_rating'));
        $users = $this->User->find('first', $options2);
//        debug($ratings); die;
        
        $this->Review->id = $updateData['id'];
//        debug($updateData); die;

        ///save ratings in reviews table
        if ($this->Review->save($updateData)) {
            $flag = true;
        } else {
            $flag = false;
        }
        
        ////////if approving - add rating and update average and previous ratings
        $options = array('conditions' => array('Review.service_id' => $ratings['Service']['id'],'Review.is_verified' => 1), 'fields' => array('avg(Review.rating) as avg_ratings','count(Review.id) as rate_count'), 'recursive' => -1);
        $ser_avg_rating = $this->Review->find('all', $options);
//        debug($ser_avg_rating); die;
        if($updateData['is_verified'] = 1){
            $serAvgRating['Service']['review_count'] = $ratings['Service']['review_count'] + 1;
        } else {
            $serAvgRating['Service']['review_count'] = $ratings['Service']['review_count'] - 1;
        }
        if($ser_avg_rating[0][0]['rate_count'] > 0) {
            $serAvgRating['Service']['prev_rating'] = $serAvgRating['Service']['avg_rating'] = round($ser_avg_rating[0][0]['avg_ratings'],3);
            $userAvgRating['User']['prev_rating'] = $userAvgRating['User']['avg_rating'] = round($ser_avg_rating[0][0]['avg_ratings'],3);
        } else {
            $serAvgRating['Service']['prev_rating'] = $serAvgRating['Service']['avg_rating'] = $ratings['Review']['rating'];
            $userAvgRating['User']['prev_rating'] = $userAvgRating['User']['avg_rating'] = $ratings['Review']['rating'];
        }
        
        //update user ratings
        $this->User->id = $ratings['Service']['user_id'];
        $this->User->save($userAvgRating);
        //update service ratings
        $this->Service->id = $ratings['Service']['id'];
        $this->Service->save($serAvgRating);
        
        if ($flag) {
            $this->Session->setFlash(__('The review status has been changed.'),'success');
            return $this->redirect(Router::url( $this->referer(), true ));
        } else {
            $this->Session->setFlash(__('The review status could not be changed. Please, try again.'),'error');
        }
    }
    
    public function approve_disapprove_reply() {
        $updateData = $this->request->data;
        $this->Review->id = $updateData['id'];
        if ($this->Review->save($updateData)) {
            $this->Session->setFlash(__('The reply has been approved.'));
            return $this->redirect(Router::url( $this->referer(), true ));
        } else {
            $this->Session->setFlash(__('The reply could not be approved. Please, try again.'));
        }
    }
    
    public function get_reply_data(){
        $this->autoRender = false;
        if(isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];
        }
        $options = array('conditions' => array('Review.id' => $id), 'fields' => array('Review.id','Review.reply_desc'));
        $returnData = $this->Review->find('first', $options);
//        debug($returnData); die;
        echo json_encode($returnData['Review']);
    }
    
    public function update_reply() {
        if ($this->request->is('post')) {
            $updateData = $this->request->data;
            $this->Review->id = $updateData['id'];
            $updateData['Review']['is_reply'] = 1;
    //        debug($updateData); die;
            if ($this->Review->save($updateData)) {
                $this->Session->setFlash(__('The reply has been sent.'),'success');
                return $this->redirect(Router::url( $this->referer(), true ));
            } else {
                $this->Session->setFlash(__('The reply could not be sent. Please, try again.'),'error');
            }
        }
    }
    
    public function save_feedback(){
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $saveReviews = $this->request->data;
            $saveReviews['Review']['user_id'] = $this->Auth->user('id');
//            debug($saveReviews); die;
            unset($saveReviews['score']);
            if ($this->Review->save($saveReviews)) {
                $this->Session->setFlash(__('The review has been updated.'),'success');
                return $this->redirect(Router::url( $this->referer(), true ));
            } else {
                $this->Session->setFlash(__('The review could not be updated. Please, try again.'),'error');
            }
        }
    }

}
