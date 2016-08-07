<?php
$controller = $this->request->controller;
$action = $this->request->action;
?>
<li>
    <a class="<?php if (($controller == "users" && $action == "assistant_dashboard")) { ?> active <?php } ?>" href="<?= Router::url(array('controller' => 'users', 'action' => 'assistant_dashboard')) ?>">
        <i class="fa fa-dashboard"></i>
        <span>Dashboard</span>
    </a>
</li>
<li>
    <a class="<?php if (($controller == "treatment_histories" && $action="assistant_add_treatment") || ($controller == "treatment_histories" && $action="assistant_treatment") || ($controller == "diet_plans" && $action="assistant_edit_diet_plan") || ($controller == "diet_plans" && $action="assistant_diet_plan") || ($controller == "family_histories" && $action="assistant_family_histories") || ($controller == "medical_histories" && $action="assistant_medical_history") || ($controller == "lab_test_results" && $action="assistant_test_results") || ($controller == "vital_signs" && $action="assistant_vital_signs") || ($controller == "patient_plan_details" && $action="assistant_view_plan") || ($controller == "patient_plan_details" && $action="assistant_purchased_plans") || ($controller == "users" && $action == "patients_index_for_assistant") || ($controller == "patient_habits" && $action == "assistant_health_profile") ||($controller == "patient_habits" && $action="assistant_add_habits")) { ?> active <?php } ?>" href="<?= Router::url(array('controller' => 'users', 'action' => 'patients_index_for_assistant')) ?>">
        <i class="fa fa-dashboard"></i>
        <span>Patients</span>
    </a>
</li>
<li>
    <a class="" href="<?= Router::url(array('controller' => 'appointments', 'action' => 'assistant_index')) ?>">
        <i class="fa fa-stethoscope"></i>
        <span>Appointments</span>
    </a>
</li>
<li>
    <a class="" href="<?= Router::url(array('controller' => 'patient_package_logs', 'action' => 'index')) ?>">
        <i class="fa fa-stethoscope"></i>
        <span>Subscriptions  </span>
    </a>
</li>
<li>
    <a class="<?php if (($controller == "users" && $action == "assistant_view") ) { ?> active <?php } ?>" href="<?= Router::url(array('controller' => 'users', 'action' => 'assistant_view')) ?>">
        <i class="fa fa-gear"></i>
        <span>Settings</span>
    </a>
</li>
