<?php

App::uses('AppModel', 'Model');

/**
 * Appointment Model
 *
 * @property User $User
 * @property Service $Service
 * @property Prescription $Prescription
 */
class Appointment extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'appointed_timing' => array(
            'datetime' => array(
                'rule' => array('datetime'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'user_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'service_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'is_visited' => array(
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
        'Doctor' => array(
            'className' => 'User',
            'foreignKey' => 'doctor_id',
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
        ),
        'StatusUpdateBy'=>array(
            'className' => 'User',
            'foreignKey' => 'status_updated_by',
            'conditions' => '',
          //  'fields' => array('User.salutation','User.first_name','User.last_name'),
            'order' => ''
        ),
        'PatientPackageLog'=>array(
             'className' => 'PatientPackageLog',
            'foreignKey' => 'patient_package_log_id',
            'conditions' => '',
          //  'fields' => array('User.salutation','User.first_name','User.last_name'),
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Prescription' => array(
            'className' => 'Prescription',
            'foreignKey' => 'appointment_id',
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

    public function get_all_appointments($user_id) {
        $appointments = array();
        $options = array();
        $options['conditions']['Appointment.user_id'] = $user_id;
        $options['conditions']['Appointment.status'] = 1;
        $options['limit'] = 5;
        $appointments['booked'] = $this->find('all', $options);

        $options['conditions']['Appointment.status'] = 2;
        $appointments['rescheduled'] = $this->find('all', $options);

        $options['conditions']['Appointment.status'] = 3;
        $appointments['cancelled'] = $this->find('all', $options);
        return $appointments;
    }

    public function upload_attachment($file, $destination) {
        $alias_name = '';
        $pdf_name = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 7);
        $upload_path = APP . WEBROOT_DIR . DS . 'files' . DS . $destination;

        if ($file['error'] == UPLOAD_ERR_OK) {
            $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
            if (strtolower($ext) == 'xlsx' || strtolower($ext) == 'xls' || strtolower($ext) == 'doc' || strtolower($ext) == 'docx' || strtolower($ext) == 'pdf' || strtolower($ext) == 'png' || strtolower($ext) == 'jpg' || strtolower($ext) == 'jpeg' || strtolower($ext) == 'gif' || strtolower($ext) == 'ico') {
                if (move_uploaded_file($file['tmp_name'], $upload_path . DS . $pdf_name . "." . $ext)) {
                    $alias_name = $pdf_name . "." . $ext;
                }
            }
        }
        return $alias_name;
    }
    
}
