<script type="text/javascript">

    $(document).ready(function () {
        $('#frm_diet_plan').bValidator();
        $('#end_date').datepicker({
            changeMonth: true,
            changeYear: true,
            minDate: $("#start_date").val()
        });
        $('#start_date').datepicker({
            minDate: "NOW",
            changeMonth: true,
            changeYear: true,
            onSelect: function (dt, dt_obj) {
                var minDate = $(this).datepicker('getDate');

                $('#end_date').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    minDate: minDate
                });
                $("#end_date").datepicker("option", "minDate", minDate);
            }
        });
    });
    
    var options = {
        singleError: true,
        showCloseIcon: false
    };

    $('#frm_diet_plan').bValidator(options);

</script>

<style>
    .bvalidator_errmsg {
        margin-left: -90px;
    }
</style> 
<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a class="active-trail active" href="<?= Router::url(array('controller' => 'users', 'action' => 'doctors_dashboard')) ?>">Dashboard</a>
            </li>
            <li>
                <a class="active-trail active" href="#">Patients</a>
            </li>
            <li>
                <a class="current" href="">Patient Details</a>
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
                    <a href="<?= Router::url(array('controller' => 'patient_habits', 'action' => 'patient_health_profile', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item  text-center">
                        <h4 class="glyphicon glyphicon-plane"></h4><br>Health Profile
                    </a>

                    <a href="<?= Router::url(array('controller' => 'users', 'action' => 'patient_purchased_plan', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item  text-center">
                        <h4 class="glyphicon glyphicon-road"></h4><br>Purchased Plans
                    </a>
                    <a href="<?= Router::url(array('controller' => 'vital_signs', 'action' => 'patient_vital_signs', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-home"></h4><br>Vital Signs
                    </a>
                    <a href="<?= Router::url(array('controller' => 'lab_test_results', 'action' => 'doctor_test_results', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item  text-center">
                        <h4 class="glyphicon glyphicon-cutlery"></h4><br>Test Results
                    </a>
                    <a href="<?= Router::url(array('controller' => 'medical_histories', 'action' => 'patient_medical_history', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item  text-center">
                        <h4 class="glyphicon glyphicon-credit-card"></h4><br>Medical History
                    </a>
                    <a href="<?= Router::url(array('controller' => 'family_histories', 'action' => 'patient_family_histories', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item  text-center">
                        <h4 class="glyphicon glyphicon-plane"></h4><br>Family History
                    </a>
                    <a href="<?= Router::url(array('controller' => 'diet_plans', 'action' => 'patient_diet_plan', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item active text-center">
                        <h4 class="glyphicon glyphicon-road"></h4><br>Diet Plan
                    </a>
                    <a href="<?= Router::url(array('controller' => 'treatment_histories', 'action' => 'patient_treatment', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-home"></h4><br> Treatments
                    </a>
                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">

                <div class="bhoechie-tab-content">
                    <section class="panel">
                        <header class="panel-heading">
                            Diet Plan
                            <a style="display: none;" class="btn btn-info pull-right" id="add_new_family_history">Add </a>
                            <a style="display: block;" href="<?= Router::url(array('controller' => 'diet_plans', 'action' => 'patient_diet_plan', $user_id, $user_type)) ?>" class="btn btn-danger pull-right" id="cancel_add_new_family_history" hidden="">Cancel</a>
                        </header>
                        <div style="display: block;" id="new_family_history" hidden="">
                            <div class="box">
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tbody><tr>
                                                <td>
                                                    <?= $this->Form->create('DietPlan', array('class' => '', 'id' => 'frm_diet_plan', 'role' => 'form', 'type' => 'file')); ?>
                                                    <div class="prf-contacts sttng">
                                                        <h4>Edit Diet Plan</h4>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label class="control-label mll">Plan Name <span class="required">*</span></label>
                                                                <?= $this->Form->input('plan_name', array('type' => 'text', 'id' => 'test_id', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter diet plan name.', 'placeholder' => 'Diet Plan Name', 'value' => $diet_paln_details['DietPlan']['plan_name'])); ?>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="control-label mll">Start Date <span class="required">*</span></label>
                                                                <?= $this->Form->input('start_date', array('type' => 'text', 'id' => 'start_date', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter start date.', 'placeholder' => 'yyyy/mm/dd', 'value' => date('m/d/Y', strtotime($diet_paln_details['DietPlan']['start_date'])), 'readonly' => true)); ?>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="control-label mll">End Date</label>
                                                                <?= $this->Form->input('end_date', array('type' => 'text', 'id' => 'end_date', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter end date.', 'placeholder' => 'yyyy/mm/dd', 'value' => date('m/d/Y', strtotime($diet_paln_details['DietPlan']['end_date'])), 'readonly' => true, 'onchange' => 'return checkValidDate()')); ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="choose_file" class="control-label col-lg-2">Add Timetable <span class="required">*</span></label>
                                                        <div class="col-lg-8">
                                                            <div class="panel-body">
                                                                <table class="table table-bordered appened_tr" id="appened_diet_tr_totable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="3">
                                                                                <a class="btn btn-xs btn-primary pull-right" id="add_more_file" title="Add More">
                                                                                    <i class="fa fa-plus"></i>
                                                                                </a> </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Weekday</th>
                                                                            <th>Time</th>
                                                                            <th>Description</th>
                                                                            <th>Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        foreach ($diet_paln_details['DietPlansDetail'] as $key => $value) :
                                                                            $i = $key;
                                                                            ?>
                                                                            <tr id="tr<?= $key; ?>">
                                                                                <td>
                                                                                    <?= $this->Form->input('weekday', array('name' => 'data[DietPlan][PlanDetails][' . $key . '][weekday]', 'empty' => 'Select day', 'options' => $weekdays, 'selected' => $value['weekday'], 'id' => 'weekday', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please select weekday.')); ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?php
                                                                                    $curr_time = explode(' ', date('h:i A', strtotime($value['time'])));
                                                                                    ?>
                                                                                    <input type="text" class="form-control timepicker" name="data[DietPlan][PlanDetails][<?= $key; ?>][time]" id="timepicker<?= $key; ?>"  data-bvalidator="required"  data-bvalidator-msg = "Please enter time."  placeholder = "Time" value="<?= $curr_time[0] . "" . $curr_time[1] ?>" />
                                                                                    <?php // $this->Form->input('time', array('name' => 'data[DietPlan][PlanDetails][' . $key . '][time]', 'type' => 'text', 'id' => 'time', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter time.', 'placeholder' => 'Time', 'value' => $value['time'])); ?>
                                                                                    <?= $this->Form->input('edit_id', array('name' => 'data[DietPlan][PlanDetails][' . $key . '][edit_id]', 'type' => 'hidden', 'id' => 'edit_id', 'class' => 'form-control', 'label' => false, 'value' => $value['id'])); ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $this->Form->input('description', array('name' => 'data[DietPlan][PlanDetails][' . $key . '][description]', 'type' => 'textarea', 'id' => 'description', 'class' => 'form-control remove', 'placeholder' => 'Enter description', 'label' => false, 'value' => $value['description'])); ?>
                                                                                </td>
                                                                                <td>
                                                                                    <a class="btn btn-xs btn-danger del_row" row_id="<?= $key; ?>" onclick="delete_row('<?= $key; ?>', '<?= $value['id'] ?>')">
                                                                                        <i class="fa fa-minus"></i>
                                                                                    </a>
                                                                                </td>

                                                                            </tr>
                                                                            <?php
                                                                            $i++;
                                                                        endforeach;
                                                                        ?>
                                                                    </tbody>
                                                                    <input type="hidden" name="cnt" id="cnt" value="<?php echo $i ?>">

                                                                </table>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2"></div>
                                                    </div>

                                                    <div class="form-group mtxxl text-center mbn">
                                                        <div class="row">

                                                            <div class="col-md-12">
                                                                <?= $this->Form->input('Save Diet Plan', array('type' => 'submit', 'id' => 'btn_submit', 'class' => 'btn btn-outlined btn-primary', 'placeholder' => 'Enter description', 'label' => false)); ?>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <?= $this->Form->end(); ?>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">

                        </div>

                    </section>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">

    $(document).ready(function () {
        $('.timepicker').timepicker({
            showPeriod: true,
            showLeadingZero: true
        });

        $(".remove").removeAttr("rows");
        $(".remove").removeAttr("cols");

        $("#cancel_add_new_family_history").show();

        $("#add_new_family_history").click(function () {
            $("#new_family_history").fadeIn();
            $("#add_new_family_history").toggle();
            $("#cancel_add_new_family_history").toggle();
        });

        $("#cancel_add_new_family_history").click(function () {
            $("#new_family_history").fadeOut();
            $("#add_new_family_history").toggle();
            $("#cancel_add_new_family_history").toggle();
        });

        var row_cnt = 0;
        var cnt = $('#cnt').val();
        var arr_cnt
        $('#add_more_file').click(function () {
            var append_desg = '<tr id=tr' + cnt + '><td><select name="data[DietPlan][PlanDetails][' + cnt + '][weekday]" class="form-control" data-bvalidator = "required" data-bvalidator-msg = "Please select weekday."><option value=""> Select Day</option><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thursday</option><option value="5">Friday</option><option value="6">Saturday</option><option value="7">Sunday</option></select></td><td><input type="text" class="form-control timepicker"  name="data[DietPlan][PlanDetails][' + cnt + '][time]" data-bvalidator="required"  data-bvalidator-msg = "Please enter time." /></td><td><textarea class="form-control" name="data[DietPlan][PlanDetails][' + cnt + '][description]" placeholder="Enter description" /></textarea></td><td><a class="btn btn-xs btn-danger del_row" row_id=' + cnt + ' onclick=delete_row(' + cnt + ',' + row_cnt + ')><i class="fa fa-minus"></i></a></td></tr>';
            $(append_desg).appendTo("#appened_diet_tr_totable");
            cnt++;
            $('.timepicker').timepicker({
                showPeriod: true,
                showLeadingZero: true
            });

        });

    });

    var myBaseUrl = '<?php echo Router::url('/', true) ?>';

    function delete_row(key, row_id) {
        if (key != "" && row_id == 0) {
            $("#tr" + key).remove();
        }
        if (row_id != "") {
            if (confirm("Are you sure?")) {
                // your deletion code
                $.ajax({
                    type: "POST",
                    url: myBaseUrl + "diet_plans/delete_diet_plan",
                    data: {id: row_id},
                    dataType: "json",
                    success: function (data)
                    {
                        $("#tr" + key).remove();
                    }
                });
                return true;
            } else {
                return false;
            }

        }

    }
</script>

<style type="text/css">
    .check_bx_spce{
        width:10%;
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