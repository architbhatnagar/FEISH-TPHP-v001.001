<?php

App::uses('AppModel', 'Model');

/**
 * User Model
 *
 * @property Appointment $Appointment
 * @property Communication $Communication
 * @property DoctorAccountDetail $DoctorAccountDetail
 * @property DoctorAssistant $DoctorAssistant
 * @property DoctorPlanDetail $DoctorPlanDetail
 * @property FamilyHistory $FamilyHistory
 * @property LoginDetail $LoginDetail
 * @property MedicalHistory $MedicalHistory
 * @property PatientHabit $PatientHabit
 * @property PatientPackageLog $PatientPackageLog
 * @property PatientPackage $PatientPackage
 * @property PatientPlanDetail $PatientPlanDetail
 * @property RecentlyViewedService $RecentlyViewedService
 * @property Review $Review
 * @property TreatmentHistory $TreatmentHistory
 * @property VitalSign $VitalSign
 */
class UserDetail extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
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
            
	);
  
    
}
