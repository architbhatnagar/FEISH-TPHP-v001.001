<?php
 $controller = $this->request->controller;
 $action = $this->request->action;
 $patient='';
 $doctor='';
 if($controller=='users' && $action=='index'){
     if(!empty($user_type) && $user_type==2){
         $doctor='active';
     }else{
         $patient='active'; 
     }
     
 }
?>    
<li>
    <a class="<?php if($controller == "users" && $action == "admin_dashboard") { ?> active <?php } ?>" href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">
        <i class="fa fa-dashboard"></i>
        <span>Dashboard</span>
    </a>
</li>
<li>
    <a class="<?php if(($controller == "services" && $action == "index") || $controller == "services" && $action == "view") { ?> active <?php } ?>" href="<?= Router::url(array('controller' => 'services', 'action' => 'index')) ?>">
        <i class="fa fa-dashboard"></i>
        <span>Services</span>
    </a>
</li>
<li class="sub-menu">
    <a href="" class="<?php if($controller == "specialties" && $action == "index") { ?> active <?php } ?>">
        <i class="fa fa-medkit"></i>
        <span>Specialty</span>
    </a>
    <ul class="sub">


        <li class="<?php if($controller == "specialties" && $action == "index" && $flag == 0) { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'specialties', 'action' => 'index', 0)) ?>">
                <i class="fa fa-arrow-circle-right"></i> Level 1 Specialties
            </a>
        </li>
        <li class="<?php if($controller == "specialties" && $action == "index" && $flag == 1) { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'specialties', 'action' => 'index', 1)) ?>">
                <i class="fa fa-arrow-circle-right"></i> Level 2 Specialties
            </a>
        </li>

    </ul>
</li>
<li>
    <a class="<?= $doctor?>" href="<?= Router::url(array('controller' => 'users', 'action' => 'index', 2)) ?>">
        <i class="fa fa-stethoscope"></i>
        <span>Doctors</span>
    </a>
</li>
<li>
    <a class="<?= $patient?>" href="<?= Router::url(array('controller' => 'users', 'action' => 'index')) ?>">
        <i class="fa fa-stethoscope"></i>
        <span>Patients</span>
    </a>
</li>
<li>
    <a class="<?php if($controller == "reviews" && $action == "admin_index") { ?> active <?php } ?>" href="<?= Router::url(array('controller' => 'reviews', 'action' => 'admin_index')) ?>">
        <i class="fa fa-star"></i>
        <span>Ratings & Reviews</span>
    </a>
</li>
<li>
    <a class="<?php if($controller == "communications" && $action == "communications_index_admin") { ?> active <?php } ?>" href="<?= Router::url(array('controller' => 'communications', 'action' => 'communications_index_admin')) ?>">
        <i class="fa fa-comments"></i>
        <span>Communications</span>
    </a>
</li>
<li>
    <a class="<?php if(($controller == "doctor_packages" && $action == "index_pkg") || ($controller == "doctor_packages" && $action == "edit_pkg") || ($controller == "doctor_packages" && $action == "add_pkg")) { ?> active <?php } ?>" href="<?= Router::url(array('controller' => 'doctor_packages', 'action' => 'index_pkg')) ?>">
        <i class="fa fa-stethoscope"></i>
        <span>Membership Plans  </span>
    </a>
</li>
<li class="sub-menu">
    <a href="" class="<?php if(($controller == "users" && $action == "doctors_report") || ($controller == "patient_package_logs" && $action == "invoice_report")) { ?> active <?php } ?>">
        <i class="fa fa-file-text"></i>
        <span>Reports</span>
    </a>
    <ul class="sub">
        <li class="<?php if($controller == "users" && $action == "doctors_report") { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'users', 'action' => 'doctors_report')) ?>">
                <i class="fa fa-arrow-circle-right"></i> Doctor Registration Reports
            </a>
        </li>
        <li class="<?php if($controller == "patient_package_logs" && $action == "invoice_report") { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'patient_package_logs', 'action' => 'invoice_report')) ?>">
                <i class="fa fa-arrow-circle-right"></i> Invoice Reports
            </a>
        </li>
    </ul>
</li>
<li class="sub-menu">
    <a class="<?php if(($controller == "accounts" && ($action == "index" || $action == "outstanding_invoice"))) { ?> active <?php } ?>" href="">
        <i class="fa fa-money"></i>
        <span>Accounts  </span>
    </a>
     <ul class="sub">
        <li class="<?php if($controller == "accounts" && $action == "outstanding_invoice") { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'accounts', 'action' => 'outstanding_invoice')) ?>">
                <i class="fa fa-file-text"></i> Outstanding
            </a>
        </li>
        <li class="<?php if($controller == "accounts" && $action == "index") { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'accounts', 'action' => 'index')) ?>">
                <i class="fa fa-inr"></i> Invoices
            </a>
        </li>
    </ul>
</li>
<li class="sub-menu">
    <a href="" class="<?php if($controller == "ethnicities" || $controller == "habits" || $controller == "identity_types" || $controller == "keywords" || $controller == "medical_conditions" || $controller == "occupations" || $controller == "procedures" || $controller == "relationships" || $controller == "tests" || $controller == "vital_sign_lists" || $controller == "vital_units") { ?> active <?php } ?>">
        <i class="fa fa-gears"></i>
        <span>Dropdown Settings</span>
    </a>
    <ul class="sub">
        <li class="<?php if($controller == "ethnicities" && ($action == "index" || $action == "edit" || $action == "add")) { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'ethnicities', 'action' => 'index')) ?>">
                <i class="fa fa-arrow-circle-right"></i> Ethnicities
            </a>
        </li>
        <li class="<?php if($controller == "habits" && ($action == "index" || $action == "edit" || $action == "add")) { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'habits', 'action' => 'index')) ?>">
                <i class="fa fa-arrow-circle-right"></i> Habits
            </a>
        </li>
        <li class="<?php if($controller == "identity_types" && ($action == "index" || $action == "edit" || $action == "add")) { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'identity_types', 'action' => 'index')) ?>">
                <i class="fa fa-arrow-circle-right"></i> Identities
            </a>
        </li>
        <li class="<?php if($controller == "keywords" && ($action == "index" || $action == "edit" || $action == "add")) { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'keywords', 'action' => 'index')) ?>">
                <i class="fa fa-arrow-circle-right"></i> Keywords
            </a>
        </li>
        <li class="<?php if($controller == "medical_conditions" && ($action == "index" || $action == "edit" || $action == "add")) { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'medical_conditions', 'action' => 'index')) ?>">
                <i class="fa fa-arrow-circle-right"></i> Medical Conditions
            </a>
        </li>
        <li class="<?php if($controller == "occupations" && ($action == "index" || $action == "edit" || $action == "add")) { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'occupations', 'action' => 'index')) ?>">
                <i class="fa fa-arrow-circle-right"></i> Occupations
            </a>
        </li>
        <li class="<?php if($controller == "procedures" && ($action == "index" || $action == "edit" || $action == "add")) { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'procedures', 'action' => 'index')) ?>">
                <i class="fa fa-arrow-circle-right"></i> Procedures
            </a>
        </li>
        <li class="<?php if($controller == "relationships" && ($action == "index" || $action == "edit" || $action == "add")) { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'relationships', 'action' => 'index')) ?>">
                <i class="fa fa-arrow-circle-right"></i> Relationships
            </a>
        </li>
        <li class="<?php if($controller == "tests" && ($action == "index" || $action == "edit" || $action == "add")) { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'tests', 'action' => 'index')) ?>">
                <i class="fa fa-arrow-circle-right"></i> Tests
            </a>
        </li>
        <li class="<?php if($controller == "vital_sign_lists" && ($action == "index" || $action == "edit" || $action == "add")) { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'vital_sign_lists', 'action' => 'index')) ?>">
                <i class="fa fa-arrow-circle-right"></i> Vital Sign Lists
            </a>
        </li>
        <li class="<?php if($controller == "vital_units" && ($action == "index" || $action == "edit" || $action == "add")) { ?> active <?php } ?>">
            <a href="<?= Router::url(array('controller' => 'vital_units', 'action' => 'index')) ?>">
                <i class="fa fa-arrow-circle-right"></i> Vital Units
            </a>
        </li>
    </ul>
</li>