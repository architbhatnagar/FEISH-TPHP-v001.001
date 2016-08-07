<?php

$config = array(
    'users' => array('dashboard', 'profile','change_password','check_password','contact'),
    'patient_habits' => array('health_profile', 'add_habits'),
    'patient_plan_details' => array('purchased_plans', 'view_plan'),
    'medical_histories' => array(
        0 => 'index',
        1 => 'add',
        2 => 'view',
        3 => 'delete',
        4 => 'update_medical_history',
        5 => 'get_medical_history_byid',
        6=>'patients_listing',
        7=>'patient_details'
    ),
    'family_histories' => array(
        0 => 'add',
        1 => 'index',
        2 => 'delete',
        3 => 'edit',
        4 => 'change_status',
        5 => 'get_family_history_byid'
    ),
    'tests' => array(
        0 => 'add',
        1 => 'index',
        2 => 'delete',
        3 => 'edit',
    ),
    'lab_test_results' => array(
        0 => 'add',
        1 => 'index',
        2 => 'delete',
        3 => 'edit',
        4 => 'get_test_result_byid',
        5 => 'download_sample_file',
        6 => 'view_test_result_byid',
        7 => 'doctor_test_results',
        
    ),
    'vital_signs' => array(
        0=>'index',
        1=>'add',
        2=>'view',
        3 =>'delete',
        4=>'update_vital_sign',
        5=>'get_vital_sign_byid',
        6=>'change_unit'
    ),
    'treatment_histories' => array(
        0=>'index',
        1=>'add',
        2=>'view',
        3 =>'delete',
        4=>'add_status',
        5=>'get_status_data'
    ),
    'diet_plans' => array(
        0=>'index',
        1=>'add',
        2=>'view',
        3=>'edit',
        4=>'delete_diet_plan',
        5=>'get_diet_plan_details',
        ),
    'appointments'=>array(
        0=>'get_time_slots_dtl',
        1=>'book_appointment_by_patient',
        2=>'view_all',
        3=>'add_drugs_by_patient',
        4=>'upload_drugs',
        5=>'view_rescheduled',
        6=>'view_cancelled',
        7=>'delete_drug',
        8=>'view_confirmed',
        9=>'get_soap_report_byid',
        10=>'view_report_details',
        11=>'print_report_details',
        12=>'view_prescription',
        13=>'view_documents_list',
        14=>'download_uploaded_file',
        15=>'print_prescription',
        
    ),
    'communications'=>array(
        0=>'patient_communications',
        1=>'reply',
        2=>'view',
        3=>'patient_compose',
        4=>'download_attachment',
        5=>'send_message',
        6=>'send_message_to_dr',
        7=>'doctor_communications',
        8=>'admin_communications'
    ),
    'patient_packages'=>array(
        0=>'view',
        1=>'pay_now',
        2=>'pay_success',
        3=>'pay_fail'
        ),
    'reviews'=>array(
        0=>'save_feedback'
    )
);
$config['roles'] = $config;
?>
