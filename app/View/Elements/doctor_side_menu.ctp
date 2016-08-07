<?php
$controller = $this->request->controller;
$action = $this->request->action;
?>
<?php if($doctor_side_menu):?>
<li>
    <a class="<?php if ($controller == "users" && $action == "doctors_dashboard") { ?> active <?php } ?>" href="<?= Router::url(array('controller' => 'users', 'action' => 'doctors_dashboard')) ?>">
        <i class="fa fa-dashboard"></i>
        <span>Dashboard</span>
    </a>
</li>

<li class="sub-menu">
    <a href="" class="<?php if (($controller == "doctor_assistants" && $action == "edit") || ($controller == "doctor_assistants" && $action == "add") || ($controller == "doctor_assistants" && $action == "index")) { ?> active <?php } ?>">
        <i class="fa fa-medkit"></i>
        <span>Assistants</span>
    </a>
    <ul class="sub">
        <li class="<?php if (($controller == "doctor_assistants" && $action == "add")) { ?> active <?php } ?>">
            <a class="" href="<?= Router::url(array('controller' => 'doctor_assistants', 'action' => 'add')) ?>">
                <i class="fa fa-plus-square"></i> Add Assistant
            </a>
        </li>
        <li class="<?php if (($controller == "doctor_assistants" && $action == "index") || ($controller == "doctor_assistants" && $action == "edit")) { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'doctor_assistants', 'action' => 'index', 3)) ?>">
                <i class="fa fa-list-ul"></i> List Assistants
            </a>
        </li>
    </ul>
</li>
<li>
    <a class="<?php if (($controller == "patient_plan_details" && $action == "patient_purchased_plans") || ($controller == "patient_plan_details" && $action= "patient_view_plan") || ($controller == "vital_signs" && $action == "patient_vital_signs") || ($controller == "treatment_histories" && $action == "patient_treatment" || $action == "patient_add_treatment") || ($controller == "treatment_histories" && $action == "patient_treatment") || ($controller == "users" && $action == "patients_index_for_doctor") || ($controller == "diet_plans" && $action == "patient_edit_diet_plan") || ($controller == "diet_plans" && $action == "patient_diet_plan") || ($controller == "family_histories" && $action == "patient_family_histories") || ($controller == "medical_histories" && $action == "patient_medical_history") || ($controller == "patient_habits" && $action == "patient_health_profile") || ($controller == "patient_habits" && $action == "patient_add_habits") || ($controller == "lab_test_results" && $action == "doctor_test_results")) { ?> active <?php } ?>" href="<?= Router::url(array('controller' => 'users', 'action' => 'patients_index_for_doctor')) ?>">
        <i class="fa fa-dashboard"></i>
        <span>Patients</span>
    </a>
</li>
<li class="sub-menu">
    <a href="" class="<?php if (($controller == "services" && $action == "index") || ($controller == "services" && $action == "add") || ($controller == "services" && $action == "view") || ($controller == "services" && $action == "edit")) { ?> active <?php } ?>">
        <i class="fa fa-medkit"></i>
        <span>Services</span>
    </a>
    <ul class="sub">
        <li class="<?php if (($controller == "services" && $action == "add")) { ?> active <?php } ?>">
            <a class="" href="<?= Router::url(array('controller' => 'services', 'action' => 'add')) ?>">
                <i class="fa fa-plus-square"></i> Add Services
            </a>
        </li>
        <li class="<?php if (($controller == "services" && $action == "index") || ($controller == "services" && $action == "view") || ($controller == "services" && $action == "edit")) { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'services', 'action' => 'index')) ?>">
                <i class="fa fa-list-ul"></i> List Services
            </a>
        </li>
    </ul>
</li>

<li class="sub-menu">
    <a href="" class="<?php if (($controller == "doctor_packages" && $action == "add") || ($controller == "doctor_packages" && $action == "edit") || ($controller == "doctor_packages" && $action == "index")) { ?> active <?php } ?>">
        <i class="fa fa-medkit"></i>
        <span>Plan</span>
    </a>
    <ul class="sub">
        <li class="<?php if (($controller == "doctor_packages" && $action == "add")) { ?> active <?php } ?>">
            <a class="" href="<?= Router::url(array('controller' => 'doctor_packages', 'action' => 'add')) ?>">
                <i class="fa fa-plus-square"></i> Add Plan
            </a>
        </li>
        <li class="<?php if (($controller == "doctor_packages" && $action == "edit") || ($controller == "doctor_packages" && $action == "index")) { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'doctor_packages', 'action' => 'index')) ?>">
                <i class="fa fa-list-ul"></i> List Plan
            </a>
        </li>
    </ul>
</li>
<li class="active">
    <a href="<?= Router::url(array('controller' => 'appointments', 'action' => 'index')) ?>">
        <i class="fa fa-plus-square"></i> Encounters
    </a>
</li>
<li class="active">
    <a href="<?= Router::url(array('controller' => 'communications', 'action' => 'communications_index_doctor')) ?>">
        <i class="fa fa-envelope"></i> Messages
    </a>
</li>


<li class="active">
    <a href="<?= Router::url(array('controller' => 'reviews', 'action' => 'index')) ?>">
        <i class="fa fa-star"></i> Ratings & Reviews
    </a>
</li>

<li class="active">
    <a href="<?= Router::url(array('controller' => 'doctor_packages', 'action' => 'doctor_plans')) ?>">
        <i class="fa fa-list-ul"></i> List Plans
    </a>
</li>

<li>
    <a class="<?php if (($controller == "users" && $action == "view") || ($controller == "users" && $action == "account_setting")) { ?> active <?php } ?>" href="<?= Router::url(array('controller' => 'users', 'action' => 'view')) ?>">
        <i class="fa fa-gear"></i>
        <span>Settings</span>
    </a>
</li>
<?php endif;?>
