<?php

$config = array(
    'users' => array(
        0 => 'add',
        1 => 'edit',
        2 => 'delete',
        3 => 'index',
        4 => 'login',
        5 => 'logout',
        6 => 'change_status',
        7 => 'view',
        8 => 'patient_details',
        9 => 'assistant_dashboard',
        10 => 'account_setting',
        11 => 'check_password',
        12 => 'patients_index_for_assistant',
        13 => 'assistant_change_status',
        14 => 'assistant_delete',
        15 => 'assistant_view',
        16 => 'get_user_purchased_plan'
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
        8 => 'book_appointment_by_ass',
        9 => 'appointment_timings',
        10 => 'get_time_slots_ass_dashboard'
    ),
    'patient_package_logs' => array(
        0 => 'index',
        1 => 'get_details',
        2 => 'renew_plan',
        3 => 'get_user_services_ass_dashboard'
    ),
    'patient_packages' => array(
        0 => 'listing',
        1 => 'edit',
        2 => 'index',
        3 => 'view',
        4 => 'pay_now',
        5 => 'pay_success',
        6 => 'pay_fail'
    ),
    'patient_habits' => array(
        0 => 'assistant_health_profile',
        1 => 'assistant_add_habits',
        2 => 'get_health_habbit_byid',
    ),
    'patient_plan_details' => array(
        0 => 'assistant_purchased_plans',
        1 => 'assistant_view_plan',
    ),
    'vital_signs' => array(
        0 => 'assistant_vital_signs',
        1 => 'get_vital_sign_byid',
        2 => 'change_unit',
        3 => 'assistant_update_vital_sign',
    ),
    'lab_test_results' => array(
        0 => 'assistant_test_results',
        1 => 'view_test_result_byid',
        2 => 'download_sample_file',
        3 => 'get_test_result_byid',
    ),
    'medical_histories' => array(
        0 => 'assistant_medical_history',
        1 => 'get_medical_history_byid',
        2 => 'assistant_update_medical_history',
    ),
    'family_histories' => array(
        0 => 'assistant_family_histories',
        1 => 'get_family_history_byid',
    ),
    'diet_plans' => array(
        0 => 'assistant_diet_plan',
        1 => 'get_diet_plan_details',
        2 => 'assistant_edit_diet_plan',
    ),
    'treatment_histories' => array(
        0 => 'assistant_treatment',
        1 => 'assistant_add_treatment',
        2 => 'get_status_data',
        3 => 'patient_add_status',
    ),
);
$config['roles'] = $config;
?>
