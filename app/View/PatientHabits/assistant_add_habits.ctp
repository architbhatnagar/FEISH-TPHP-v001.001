<script type="text/javascript">
    $(document).ready(function () {
        $(".habit_click").click(function () {
            var checked_val = $(this).prop('checked');
            var open_row_id = $(this).attr('habit_id');

            if (checked_val == true) {
                $("#add_habbit_frm").removeAttr("novalidate");
                $("#habit_" + open_row_id).show();
                //$("#Frequency"+open_row_id).addAttr('required');
                $("#Frequency" + open_row_id).attr('required', true);
            } else {
//                                                                        
                $("#add_habbit_frm").attr("novalidate", "novalidate");
                $("#habit_" + open_row_id).hide();
            }
            //$("#Frequency"+open_row_id).attr('required', true);
        });
        $(".is_stoped").click(function () {

            var checked_val = $(this).prop('checked');
            var open_row_id = $(this).attr('habit_id');

            if (checked_val == true) {
                $("#stp_date" + open_row_id).show();
            } else {
                $("#stp_date" + open_row_id).hide();
            }
        });

        $('.habbit_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            startDate: '-3m',
            maxDate: '0',
//            minDate: 0,

        });
    });

</script>
<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'assistant_dashboard')) ?>">Dashboard</a>
            </li>
            <li>
                <a class="active-trail active" href="<?= Router::url(array('controller' => 'users', 'action' => 'patients_index_for_assistant')) ?>">Patients</a>
            </li>
            <li>
                <a class="current" href="javascript:void(0);">Patient Details</a>
            </li>
            <li class="pull-right">
                <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <div class="twt-feed turquoise-theme">
                <div class="col-md-4">
                    <a>
                        <?php if (!empty($user['User']['avatar'])) { ?>
                            <?= $this->Html->image('user_avtar/' . $user['User']['avatar'], array('alt' => '')); ?>
                            <?php
                        } else {
                            if ($user['User']['gender'] == 1) {
                                ?>
                                <?= $this->Html->image('patient-male.png', array('class' => 'img-responsive', 'alt' => '')) ?>
                                <?php
                            } else {
                                ?>
                                <?= $this->Html->image('patient-female.png', array('class' => 'img-responsive', 'alt' => '')) ?>
                                <?php
                            }
                        }
                        ?>
                    </a>
                    <h1><?= ucwords($salutations[$user['User']['salutation']] . " " . $user['User']['first_name'] . " " . $user['User']['last_name']) ?></h1>
                    <p><?= $user['User']['email']; ?></p>
                </div>
                <div class="col-md-4">
                    <p> <i class="fa fa-envelope-o"></i> <b>Email</b> : <?= $user['User']['email'] ?></p>
                    <p> <i class="fa fa-tasks"></i> <b>Registered On</b> : <?= date('d-M-y', strtotime($user['User']['created'])); ?></p>
                    <p> <i class="fa fa-mobile"></i> <b>Mobile</b> : <?= $user['User']['mobile'] ?></p>
                </div>
                <div class="col-md-4">
                    <p><b>Patient id</b> : <?php
                        if (!empty($user['User']['registration_no'])) {
                            echo  "PA-".$user['User']['registration_no'];
                        } else {
                            echo "-";
                        }
                        ?> </p>
                    <p><b>Last logged in on</b> : </p>
                    <p><?php
                        if (!empty($last_login)) {
                            echo date('d-M-y h:i a', strtotime($last_login['LoginDetail']['created']));
                        } else {
                            echo "-";
                        }
                        ?></p>
                </div>
            </div>
        </section>
    </div>
    <div class="col-sm-12">

        <div class=" col-sm-12 bhoechie-tab-container">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 bhoechie-tab-menu">
                <div class="list-group">
                    <a href="<?= Router::url(array('controller' => 'patient_habits', 'action' => 'assistant_health_profile', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item active text-center">
                        <h4 class="glyphicon glyphicon-plane"></h4><br>Health Profile
                    </a>

                    <a href="<?= Router::url(array('controller' => 'patient_plan_details', 'action' => 'assistant_purchased_plans', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-road"></h4><br>Purchased Plans
                    </a>
                    <a href="<?= Router::url(array('controller' => 'users', 'action' => 'assistant_vital_signs', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-home"></h4><br>Vital Signs
                    </a>
                    <a href="<?= Router::url(array('controller' => 'lab_test_results', 'action' => 'assistant_test_results', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-cutlery"></h4><br>Test Results
                    </a>
                    <a href="<?= Router::url(array('controller' => 'medical_histories', 'action' => 'assistant_medical_history', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-credit-card"></h4><br>Medical History
                    </a>
                    <a href="<?= Router::url(array('controller' => 'family_histories', 'action' => 'assistant_family_histories', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item  text-center">
                        <h4 class="glyphicon glyphicon-plane"></h4><br>Family History
                    </a>
                    <a href="<?= Router::url(array('controller' => 'diet_plans', 'action' => 'assistant_diet_plan', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-road"></h4><br>Diet Plan
                    </a>
                    <a href="<?= Router::url(array('controller' => 'treatment_histories', 'action' => 'assistant_treatment', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-home"></h4><br> Treatments
                    </a>
                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 bhoechie-tab">
                <!-- flight section -->
                <div class="bhoechie-tab-content active">

                    <section class="panel">
                        <header class="panel-heading">
                            Habit Parameters
                            <?php echo $this->HTML->link(__('<i class="fa fa-medkit"></i> Habbit List'), array('controller' => 'patient_habits', 'action' => 'assistant_health_profile', $user['User']['id'], $user['User']['user_type']), array('id' => 'add_new_habit', 'escape' => false, 'class' => 'btn btn-danger btn-sm pull-right', 'style' => 'margin-top: -7px;')); ?>
                        </header>

                        <div class="panel-body">
                            <div class="box">
                                <div class="box-body">
                                    <div class="box last">
                                        <div class="box-body">
                                            <form method="post" action="" id="add_habbit_frm" role="form" class="cmxform form-horizontal" novalidate>
                                                <div class="form-body">
                                                    <table class="table table-bordered">
                                                        <tr>
                                                            <th>
                                                                Select Habits
                                                            </th>
                                                        </tr>
                                                        <?php foreach ($habits as $habit): ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-group-sm">
                                                                        <div class="row">
                                                                            <?php if (array_key_exists($habit['Habit']['id'], $already_habit_arr)): ?>
                                                                                <div class="col-lg-2">
                                                                                    <input type="checkbox" name="habits[<?= $habit['Habit']['id'] ?>][is_habit]" class="habit_click" habit_id="<?= $habit['Habit']['id'] ?>" checked=true value="1"> <?= $habit['Habit']['habit_name'] ?>  
                                                                                    <input type="hidden" name="habits[<?= $habit['Habit']['id'] ?>][habit_id]" value="<?= $habit['Habit']['id'] ?>">
                                                                                    <input type="hidden" name="habits[<?= $habit['Habit']['id'] ?>][id]" value="<?= $already_habit_arr[$habit['Habit']['id']]['id'] ?>">
                                                                                </div>
                                                                                <div class="col-lg-10">
                                                                                    <div class="row">  
                                                                                        <div id="habit_<?= $habit['Habit']['id'] ?>">
                                                                                            <div class="col-lg-4">
                                                                                                <div class="row">
                                                                                                    <div class="col-lg-6">
                                                                                                        <input type="text" class="form-control par_mang" placeholder="Frequency" id="Frequency<?= $habit['Habit']['id'] ?>" value="<?= $already_habit_arr[$habit['Habit']['id']]['frequency'] ?>" name="habits[<?= $habit['Habit']['id'] ?>][frequency]">
                                                                                                    </div>

                                                                                                    <div class="col-lg-6">
                                                                                                        <?= $this->Form->input('unit', array('name' => 'habits[' . $habit['Habit']['id'] . '][unit]', 'empty' => 'Select Unit', 'options' => $units, 'id' => 'Unit' . $habit['Habit']['id'], 'class' => 'form-control par_mang', 'label' => false, 'selected' => $already_habit_arr[$habit['Habit']['id']]['unit'])); ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-lg-3">
                                                                                                <?= $this->Form->input('time_period', array('name' => 'habits[' . $habit['Habit']['id'] . '][time_period]', 'empty' => 'Select', 'options' => $time_period, 'id' => 'Time_period' . $habit['Habit']['id'], 'class' => 'form-control par_mang', 'label' => false, 'selected' => $already_habit_arr[$habit['Habit']['id']]['time_period'])); ?>
                                                                                            </div>
                                                                                            <div class="col-lg-2">
                                                                                                <?= $this->Form->input('habit_since', array('name' => 'habits[' . $habit['Habit']['id'] . '][habit_since]', 'empty' => 'Habit Since', 'options' => $habit_since, 'id' => 'Habit_since' . $habit['Habit']['id'], 'class' => 'form-control par_mang', 'label' => false, 'selected' => $already_habit_arr[$habit['Habit']['id']]['habit_since'])); ?>
                                                                                            </div>

                                                                                            <div class="col-lg-3">
                                                                                                <input type="checkbox" id="Is_stopped<?= $habit['Habit']['id'] ?>" name=" habits[<?= $habit['Habit']['id'] ?>][is_stopped]" class="is_stoped par_mang" habit_id="<?= $habit['Habit']['id'] ?>" value="1" <?php if ($already_habit_arr[$habit['Habit']['id']]['is_stopped'] == 1) { ?> checked="checked" <?php } ?>> Is Stopped?
                                                                                            </div>
                                                                                            <div class="col-lg-3" id="stp_date<?= $habit['Habit']['id'] ?>"  <?php if ($already_habit_arr[$habit['Habit']['id']]['is_stopped'] != 1) { ?>hidden <?php } ?>>
                                                                                                <label>When</label>
                                                                                                <input type="text" id="Stopped_date<?= $habit['Habit']['id'] ?>" name="habits[<?= $habit['Habit']['id'] ?>][stopped_date]" class="form-control par_mang habbit_date" placeholder="mm/dd/yyyy" value="<?= date('m/d/Y', strtotime($already_habit_arr[$habit['Habit']['id']]['stopped_date'])); ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            <?php else: ?>
                                                                                <div class="col-lg-2">
                                                                                    <input type="checkbox" name="habits[<?= $habit['Habit']['id'] ?>][is_habit]" class="habit_click" habit_id="<?= $habit['Habit']['id'] ?>" value="1" > <?= $habit['Habit']['habit_name'] ?>  
                                                                                    <input type="hidden" name="habits[<?= $habit['Habit']['id'] ?>][habit_id]" value="<?= $habit['Habit']['id'] ?>">
                                                                                </div>
                                                                                <div class="col-lg-10">
                                                                                    <div class="row">  
                                                                                        <div id="habit_<?= $habit['Habit']['id'] ?>" hidden="">
                                                                                            <div class="col-lg-4">
                                                                                                <div class="row">
                                                                                                    <div class="col-lg-6">
                                                                                                        <input type="text" class="form-control par_mang" placeholder="Frequency" id="Frequency<?= $habit['Habit']['id'] ?>" name="habits[<?= $habit['Habit']['id'] ?>][frequency]">
                                                                                                    </div>

                                                                                                    <div class="col-lg-6">
                                                                                                        <?= $this->Form->input('unit', array('name' => 'habits[' . $habit['Habit']['id'] . '][unit]', 'empty' => 'Select Unit', 'options' => $units, 'id' => 'Unit' . $habit['Habit']['id'], 'class' => 'form-control par_mang', 'label' => false)); ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-lg-3">
                                                                                                <?= $this->Form->input('time_period', array('name' => 'habits[' . $habit['Habit']['id'] . '][time_period]', 'empty' => 'Select', 'options' => $time_period, 'id' => 'Time_period' . $habit['Habit']['id'], 'class' => 'form-control par_mang', 'label' => false)); ?>
                                                                                            </div>
                                                                                            <div class="col-lg-2">
                                                                                                <?= $this->Form->input('habit_since', array('name' => 'habits[' . $habit['Habit']['id'] . '][habit_since]', 'empty' => 'Habit Since', 'options' => $habit_since, 'id' => 'Habit_since' . $habit['Habit']['id'], 'class' => 'form-control par_mang', 'label' => false)); ?>
                                                                                            </div>
                                                                                            <div class="col-lg-3">
                                                                                                <input type="checkbox" id="Is_stopped<?= $habit['Habit']['id'] ?>" name=" habits[<?= $habit['Habit']['id'] ?>][is_stopped]" class="is_stoped par_mang" habit_id="<?= $habit['Habit']['id'] ?>" value="1"> Is Stopped?
                                                                                            </div>
                                                                                            <div class="col-lg-3" id="stp_date<?= $habit['Habit']['id'] ?>"  hidden>
                                                                                                <label>When</label>
                                                                                                <input type="text" id="Stopped_date<?= $habit['Habit']['id'] ?>" name="habits[<?= $habit['Habit']['id'] ?>][stopped_date]" class="form-control par_mang habbit_date" placeholder="mm/dd/yyyy">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>

                                                    </table>
                                                    <div class="form-group mtxxl text-center mbn"><input type="submit" class="btn btn-outlined btn-primary" name="add_patients_habits"></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

    </div>
</div>

<style type="text/css">
    .check_bx_spce{
        width:10%;
    }
    .par_mang{
        padding: 5px 4px !important;
    }
</style>

<style type="text/css">
    [contenteditable=true]:empty:before {
        content: attr(placeholder);
        display: block; /* For Firefox */
    }
    @media (min-width:768px){
        .modal-dialog {
            width: 80% !important;
        }
        .bootbox .modal-dialog {
            width: 40% !important;
        }
    }
    .invoice-title a img {
        height: 90px;
        width: 90px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        border: 5px solid rgba(241,242,247,0.5);
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
    }
    .modal-content .panel {
        padding-top: 10px;
    }
    .tab-content {
        margin-top: 30px;
    }
    .stepwizard-step p {
        margin-top: 10px;
    }
    .stepwizard-row {
        display: table-row;
    }
    .stepwizard {
        display: table;
        width: 100%;
        margin-top: 25px;
        position: relative;
    }
    .stepwizard-row:before {
        top: 100px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 2px;
        background-color: #ccc;
        z-order: 0;
    }
    .stepwizard-row .active:after {
        content: " ";
        position: absolute;
        left: 40%;
        top: 101px;
        padding-bottom: 10px;
        opacity:1;
        margin: 0 auto;
        bottom: 0px;
        border: 10px solid transparent;
        border-top-color: #ccc;
    }
    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
        text-decoration: none;
        background-color: #eee;
        margin-left: 75px;
        margin-right: 75px;
    }
    .stepwizard-step i {
        font-size: 25px;
    }
    .btn-circle {
        width: 50px;
        height: 50px;
        text-align: center;
        padding: 6px 0;
        font-size: 25px;
        line-height: 1.428571429;
        border-radius: 25px;
    }
    @media( max-width : 1340px ){
        .stepwizard-step {
            margin-left: 30px !important;
            margin-right: 30px !important;
        }
    }
    @media( max-width : 1075px ){
        .stepwizard-step {
            margin-left: 10px !important;
            margin-right: 10px !important;
        }
    }
    @media( max-width : 825px ){
        .stepwizard-step {
            margin-left: 2px !important;
            margin-right: 0px !important;
        }
        .stepwizard-row:before {
            background-color: #fff !important;
        }
    }


    div.bhoechie-tab-container{
        z-index: 10;
        background-color: #ffffff;
        padding: 0 !important;
        border-radius: 4px;
        -moz-border-radius: 4px;
        border:1px solid #ddd;

        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
        -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        background-clip: padding-box;
        opacity: 0.97;
        filter: alpha(opacity=97);
    }
    div.bhoechie-tab-menu{
        padding-right: 0;
        padding-left: 0;
        padding-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group{
        margin-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group>a{
        margin-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group>a .glyphicon,
    div.bhoechie-tab-menu div.list-group>a .fa {
        color: #1FB5AD;
    }
    div.bhoechie-tab-menu div.list-group>a:first-child{
        border-top-right-radius: 0;
        -moz-border-top-right-radius: 0;
    }
    div.bhoechie-tab-menu div.list-group>a:last-child{
        border-bottom-right-radius: 0;
        -moz-border-bottom-right-radius: 0;
    }
    div.bhoechie-tab-menu div.list-group>a.active,
    div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
    div.bhoechie-tab-menu div.list-group>a.active .fa{
        background-color: #1FB5AD;
        background-image: #1FB5AD;
        color: #ffffff;
    }
    div.bhoechie-tab-menu div.list-group>a.active:after{
        content: '';
        position: absolute;
        left: 100%;
        top: 50%;
        margin-top: -13px;
        border-left: 0;
        border-bottom: 13px solid transparent;
        border-top: 13px solid transparent;
        border-left: 10px solid #1FB5AD;
    }

    div.bhoechie-tab-content{
        background-color: #ffffff;
        /* border: 1px solid #eeeeee; */
        padding-left: 20px;
        padding-top: 10px;
    }

    div.bhoechie-tab div.bhoechie-tab-content:not(.active){
        display: none;
    }
    .panel-body{
        background-color: #F2F4F4 !important;
    }
    table{
        background-color: #FFF;
    }

</style>