<?php

$config = array(
    'users' => array(
        0 => 'add',
        1 => 'edit',
        2 => 'delete',
        3 => 'edit',
        4 => 'change_status',
        5 => 'view',
        6 => 'account_setting',
        7 => 'check_password',
        8 => 'index',
        9 => 'login',
        10 => 'logout',
        11 => 'patient_details',
        12 => 'doctors_dashboard',
        13 => 'patients_index_for_doctor',
        14 => 'patient_purchased_plan',
        15 => 'patient_vital_signs',
        16 => 'patient_test_results',
        17 => 'patient_medical_history',
        18 => 'patient_family_history',
        20 => 'patient_treatments',
        21 => 'doctor_health_profile',
        22 => 'doctor_test_results',
        23 => 'doctor_change_status',
        24 => 'doctor_delete',
        25 => 'check_mail_id',
        26 => 'check_mobile',
        27 => 'get_user_purchased_plan',
        28 => 'search_patients',
    ),
    'lab_test_results' => array(
        0 => 'doctor_test_results',
        1 => 'view_test_result_byid',
        2 => 'download_sample_file',
        3 => 'get_test_result_byid',
    ),
    'family_histories' => array(
        0 => 'patient_family_histories',
        1 => 'get_family_history_byid',
    ),
    'diet_plans' => array(
        0 => 'patient_diet_plan',
        1 => 'get_diet_plan_details',
        2 => 'patient_edit_diet_plan',
    ),
    'patient_habits' => array(
        0 => 'patient_health_profile',
        1 => 'patient_add_habits',
        2 => 'get_health_habbit_byid',
    ),
    'medical_histories' => array(
        0 => 'patient_medical_history',
        1 => 'get_medical_history_byid',
        2 => 'patient_update_medical_history',
    ),
    'vital_signs' => array(
        0 => 'patient_vital_signs',
        1 => 'get_vital_sign_byid',
        2 => 'change_unit',
        3 => 'patient_update_vital_sign',
    ),
    'treatment_histories' => array(
        0 => 'patient_treatment',
        1 => 'patient_add_treatment',
        2 => 'get_status_data',
        3 => 'patient_add_status',
    ),
    'patient_plan_details' => array(
        0 => 'patient_purchased_plans',
        1 => 'patient_view_plan',
    ),
    'doctor_assistants' => array(
        0 => 'add',
        1 => 'index',
        2 => 'delete',
        3 => 'edit',
        4 => 'change_status'
    ),
    'doctor_packages' => array(
        0 => 'add',
        1 => 'index',
        2 => 'delete',
        3 => 'edit',
        4 => 'change_status',
        5 => 'view_paln_details',
        6=>'doctor_plans',
        7=>'view',
        8=>'pay_now',
        9=>'pay_success',
        10=>'pay_fail'
    ),
    'appointments' => array(
        0 => 'index',
        1 => 'add',
        2 => 'edit',
        3 => 'view',
        4 => 'change_status',
        5 => 'assistant_index',
        6 => 'get_details',
        7 => 'get_time_slots',
        8 => 'book_appointment',
        9 => 'appointment_timings',
        10 => 'add_encounter',
        11 => 'add_drugs',
        12 => 'download_note',
        13 => 'get_details',
        14 => 'delete_drug',
        15 => 'view_presc',
        16 => 'view_soap_report_details',
        17 => 'print_report',
        18 => 'view_drugs_report_details',
        19 => 'print_drugs_prescription',
        20 => 'appointment_upload_drugs',
        21 => 'view_uploaded_documents',
        22 => 'download_uploaded_file'
    ),
    'services' => array(
        0 => 'add',
        1 => 'edit',
        3 => 'delete',
        4 => 'index',
        5 => 'change_status',
        6 => 'view',
    ),
    'services_working_timings' => array(
        0 => 'add',
        1 => 'delete',
    ),
    'reviews' => array(
        0 => 'add',
        1 => 'index',
        2 => 'view',
        3 => 'update_reply',
        4 => 'get_reply_data'
    ),
    'doctor_plan_details' => array(
        0 => 'add',
        1 => 'index',
        2 => 'plan_details',
    ),
    'communications'=>array(
        0=>'communications_index_doctor',
        1=>'view_doc_communication',
        2=>'download_attachment',
    ),
    'patient_package_logs'=>array(
        0=>'get_user_services'
    )
);
$config['roles'] = $config;
?>
