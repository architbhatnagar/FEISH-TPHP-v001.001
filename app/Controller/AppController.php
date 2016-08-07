<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $helpers = array("Html", "Form", "Session");
    public $components = array(
        'Session',
        'Cookie',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'User',
                    'fields' => array(
                        'username' => 'email',
                        'password' => 'password'
                    )
                )
            ),
            'authorize' => array('Controller'),
            //'loginRedirect' => array('controller' => 'users', 'action' => 'index'),
            'logoutRedirect' => array('/'),
        //'loginAction' => array('controller' => 'users', 'action' => 'login'),
        )
    );

    const ROLE_ADMIN = 1;
    const ROLE_DOCTOR = 2;
    const ROLE_ASSISTANT = 3;
    const ROLE_PATIENT = 4;

    public function isAuthorized() {
        $role = AuthComponent::user('user_type');
        $url = $this->request->url;
        $controller = $this->request->controller;
        $action = $this->request->action;
        $is_authorized = false;
        //debug($controller);
        //debug($action); 
        if ($role == 1) {
            Configure::load('admin_roles');
            $role_data = Configure::read("roles");
        } elseif ($role == 2) {
            Configure::load('doctor_roles');
            $role_data = Configure::read("roles");
        } elseif ($role == 3) {
            Configure::load('assistant_roles');
            $role_data = Configure::read("roles");
        } elseif ($role == 4) {
            Configure::load('patient_roles');
            $role_data = Configure::read("roles");
        } else {
            $this->Session->setFlash(__('You are not authorized to perform this actions. Please contact to the administrator'), 'error');
            return false;
        }
        //debug($role_data);
        switch (true) {
            case $url == false;
                $is_authorized = true;
                break;
            case $role == self::ROLE_ADMIN && in_array($action, $role_data[$controller]):
                $is_authorized = true;
                break;
            case $role == self::ROLE_DOCTOR && in_array($action, $role_data[$controller]):
                $is_authorized = true;
                break;
            case $role == self::ROLE_ASSISTANT && in_array($action, $role_data[$controller]):
                $is_authorized = true;
                break;
            case $role == self::ROLE_PATIENT && in_array($action, $role_data[$controller]):
                $is_authorized = true;
                break;
        }
        //debug($is_authorized);die;
        if ($is_authorized) {
            return true;
        } else {
            $this->Session->setFlash(__('You are not authorized to perform this actions.'), 'error');
            return false;
        }
        return true;
    }

    public function beforeRender() { 
        
        $user_type_id = $this->Auth->user('user_type');
        if ($this->request->controller == "vital_units" || $this->request->controller == "vital_sign_lists" || $this->request->controller == "tests" || $this->request->controller == "relationships" || $this->request->controller == "procedures" || $this->request->controller == "occupations" || $this->request->controller == "medical_conditions" || $this->request->controller == "ethnicities" || $this->request->controller =="habits" || $this->request->controller == "identity_types" || $this->request->controller == "keywords") {
            Configure::load('feish');
        }
        
        $user_types = Configure::read('feish.user_types');
        $keywords = Configure::read('feish.search_keywords');
        
        $doctor_side_menu = true;
        $this->loadModel('DoctorPackage');
        $this->loadModel('DoctorPlanDetail');
        if ($user_type_id == 2) {
            $plan_ids = $this->DoctorPlanDetail->find('list', array('conditions' => array('DoctorPlanDetail.user_id' => $this->Auth->user('id'), 'is_deleted' => 0), 'fields' => array('DoctorPlanDetail.doctor_package_id')));
            if (empty($plan_ids)) {
                $doctor_side_menu = false;
            } else {
                $doctor_side_menu = true;
            }
        }
        $this->set(compact('keywords', 'user_type_id', 'doctor_side_menu', 'user_types'));
        $this->response->disableCache();
    }

}
