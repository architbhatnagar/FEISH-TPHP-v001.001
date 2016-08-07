<?php

App::uses('AppModel', 'Model');

class User extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'is_active' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'is_deleted' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );
    
    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Ethnicity' => array(
            'className' => 'Ethnicity',
            'foreignKey' => 'ethnicity_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
        ),
        'IdentityType' => array(
            'className' => 'IdentityType',
            'foreignKey' => 'identity_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
        ),
        'Occupation' => array(
            'className' => 'Occupation',
            'foreignKey' => 'occupation_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
        )
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Appointment' => array(
            'className' => 'Appointment',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'UserDetail' => array(
            'className' => 'UserDetail',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => 'UserDetail.id DESC',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Communication' => array(
            'className' => 'Communication',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'DoctorAccountDetail' => array(
            'className' => 'DoctorAccountDetail',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'DoctorAssistant' => array(
            'className' => 'DoctorAssistant',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'DoctorPlanDetail' => array(
            'className' => 'DoctorPlanDetail',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => 'id desc',
            'limit' => '10',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'FamilyHistory' => array(
            'className' => 'FamilyHistory',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'LoginDetail' => array(
            'className' => 'LoginDetail',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => 'LoginDetail.created',
            'order' => 'LoginDetail.id DESC',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'MedicalHistory' => array(
            'className' => 'MedicalHistory',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'PatientHabit' => array(
            'className' => 'PatientHabit',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'PatientPackageLog' => array(
            'className' => 'PatientPackageLog',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'PatientPackage' => array(
            'className' => 'PatientPackage',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'PatientPlanDetail' => array(
            'className' => 'PatientPlanDetail',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'RecentlyViewedService' => array(
            'className' => 'RecentlyViewedService',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Review' => array(
            'className' => 'Review',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'TreatmentHistory' => array(
            'className' => 'TreatmentHistory',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'VitalSign' => array(
            'className' => 'VitalSign',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Services'=>array(
             'className' => 'Service',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
         'DoctorAccountDetail'=>array(
             'className' => 'DoctorAccountDetail',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
  
    //fetch full_name = first_name + last_name
    var $virtualFields = array(
        'full_name' => 'CONCAT(User.first_name, " ", User.last_name)'
    );
    
    public function uploadMainImage($image = null,$destination=null) {
        
        $alias_name = '';
        $img_name = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 7);
        $upload_path = IMAGES . $destination;
        
        if ($image['error'] == UPLOAD_ERR_OK) {
            $ext = pathinfo($image["name"], PATHINFO_EXTENSION);
            if (strtolower($ext) == 'png' || strtolower($ext) == 'jpg' || strtolower($ext) == 'jpeg' || strtolower($ext) == 'gif' || strtolower($ext) == 'ico') {
                if (move_uploaded_file($image['tmp_name'], $upload_path . DS . $img_name . "." . $ext)) {
                    $alias_name = $img_name . "." . $ext;
                }
            }
        }
        
        return $alias_name;
    }

    public function beforeSave($options = Array()) {
        if (isset($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        return true;
    }
   
}
