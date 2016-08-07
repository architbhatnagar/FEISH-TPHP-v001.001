<?php

App::uses('AppModel', 'Model');

/**
 * DoctorAssistant Model
 *
 * @property User $User
 * @property Service $Service
 */
class DoctorAssistant extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
//    public $validate = array(
//        'service_id' => array(
//            'rule' => 'notEmpty',
//        ),
//        'is_deleted' => array(
//            'numeric' => array(
//                'rule' => array('numeric'),
//            ),
//        ),
//        'first_name' => array(
//            'rule' => 'notEmpty'
//        ),
//        'last_name' => array(
//            'rule' => 'notEmpty'
//        ),
//        'email' => array(
//            array(
//                'rule' => array('email'),
//                'massage' => 'Please enter a valid email address',
//            ),
//        ),
//        'mobile' => array(
//            array('rule' => array('numeric'),
//                'message' => 'Phone number should be numeric'),
//        ),
//    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Service' => array(
            'className' => 'Service',
            'foreignKey' => 'service_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
