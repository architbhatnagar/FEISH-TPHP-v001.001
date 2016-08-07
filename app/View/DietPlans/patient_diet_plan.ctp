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
                <?php if($user_type_id == 1) { ?>
                    <a class="active-trail active" href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>
                <?php } else { ?>
                    <a class="active-trail active" href="<?= Router::url(array('controller' => 'users', 'action' => 'doctors_dashboard')) ?>">Dashboard</a>
                <?php } ?>
            </li>
            <li>
                <?php if($user_type_id == 1) { ?>
                    <a class="active-trail active" href="<?= Router::url(array('controller' => 'users', 'action' => 'index')) ?>">Patients</a>
                <?php } else { ?>
                    <a class="active-trail active" href="<?= Router::url(array('controller' => 'users', 'action' => 'patients_index_for_doctor')) ?>">Patients</a>
                <?php } ?>
            </li>
            <li>
                <a class="current" href="javascript:void(0);">Patient Details</a>
            </li>
            <li class="pull-right">
                <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <?php echo $this->element('patient_info'); ?>
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
                            <?php if(Authcomponent::user('user_type') != 1) { ?>
                                <a style="display: block;" class="btn btn-info pull-right" id="add_new_family_history">Add </a>
                                <a style="display: none;" class="btn btn-danger pull-right" id="cancel_add_new_family_history" hidden="">Cancel</a>
                            <?php } ?>
                        </header>

                        <div style="display: none;" id="new_family_history" hidden="">
                            <div class="box">
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <tbody><tr>
                                                <td>
                                                    <?= $this->Form->create('DietPlan', array('class' => '', 'id' => 'frm_diet_plan', 'role' => 'form', 'type' => 'file')); ?>
                                                    <div class="">
                                                        <h4>Add Diet Plan</h4>
                                                        <hr>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label class="control-label ">Plan Name <span class="required">*</span></label>
                                                                <?= $this->Form->input('plan_name', array('type' => 'text', 'id' => 'test_id', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter diet plan name.', 'placeholder' => 'Diet Plan Name')); ?>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="control-label">Start Date <span class="required">*</span></label>
                                                                <?= $this->Form->input('start_date', array('type' => 'text', 'id' => 'start_date', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter start date.', 'placeholder' => 'yyyy/mm/dd', 'readonly' => true)); ?>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="control-label">End Date</label>
                                                                <?= $this->Form->input('end_date', array('type' => 'text', 'id' => 'end_date', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter end date.', 'placeholder' => 'yyyy/mm/dd', 'readonly' => true, 'onchange' => 'return checkValidDate()')); ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="choose_file" class="control-label col-lg-2">Add Timetable <span class="required">*</span></label>
                                                        <div class="col-lg-8">
                                                            <div class="panel-body">
                                                                <table class="table table-bordered" id="appened_diet_tr_totable">
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
                                                                        <tr id="tr0">
                                                                            <td>
                                                                                <?= $this->Form->input('weekday', array('name' => 'data[DietPlan][PlanDetails][0][weekday]', 'empty' => 'Select day', 'options' => $weekdays, 'id' => 'weekday', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please select weekday.')); ?>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" class="form-control timepicker" name="data[DietPlan][PlanDetails][0][time]"  data-bvalidator="required"  data-bvalidator-msg = "Please enter time."  placeholder = "Time"/>
                                                                                <?php // $this->Form->input('time', array('name' => 'data[DietPlan][PlanDetails][0][time]', 'type' => 'time', 'id' => 'time', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter time.', 'placeholder' => 'Time'));   ?>
                                                                            </td>
                                                                            <td>
                                                                                <?= $this->Form->input('description', array('name' => 'data[DietPlan][PlanDetails][0][description]', 'type' => 'textarea', 'id' => 'description', 'class' => 'form-control', 'placeholder' => 'Enter description', 'label' => false)); ?>
                                                                            </td>
                                                                            <td>
                                                                                <a class="btn btn-xs btn-danger del_row" row_id="0" onclick="delete_row(0)">
                                                                                    <i class="fa fa-minus"></i>
                                                                                </a>
                                                                            </td>

                                                                        </tr>
                                                                    </tbody>

                                                                </table>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2"></div>
                                                    </div>

                                                    <div class="form-group text-center">
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
                            <table class="table table-bordered">
                                <thead>
                                    <?php if (count($diet_plan_arr) > 0) { ?>
                                        <tr>
                                            <th>Plan Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>

                                            <th>Actions</th>
                                        </tr>
                                    <?php } ?>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($diet_plan_arr) > 0) {
                                        foreach ($diet_plan_arr as $diet_plan) :
                                            ?>
                                            <tr>
                                                <td><?= $diet_plan['DietPlan']['plan_name']; ?></td>
                                                <td><?= date('d M Y', strtotime($diet_plan['DietPlan']['start_date'])); ?></td>
                                                <td><?= date('d M Y', strtotime($diet_plan['DietPlan']['end_date'])); ?></td>
                                                <td>
                                                    <a href="javascript:void(0);" onclick="showDietDetails('<?= $diet_plan['DietPlan']['id'] ?>')" class="btn btn-warning btn-xs" title="View"><i class="fa fa-search"></i></a>
                                                    <?php if(Authcomponent::user('user_type') != 1) { ?>
                                                        <a href="<?= Router::url(array('controller' => 'diet_plans', 'action' => 'patient_edit_diet_plan', $diet_plan['DietPlan']['id'], $user['User']['id'], $user['User']['user_type'])) ?>" class="btn btn-primary btn-xs" title="View"><i class="fa fa-edit"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    } else {
                                        ?>
                                    <div class="alert alert-block alert-danger">
                                <p><span class="alert-icon"><i class="fa fa-check"></i></span>&nbsp;No records found.</p>
                            </div>
                                <?php } ?>
                                </tbody>

                            </table>

                        </div>
                        <?php if (count($diet_plan_arr) > 0) { ?>
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="dataTables_info" id="dynamic-table_info">
                                        <?php
                                        echo $this->Paginator->counter(array(
                                            'format' => __(' Showing {:current} records out of {:count}.')
                                        ));
                                        ?>

                                    </div>
                                    <div class="span6">
                                        <div class="">
                                            <ul class="pagination pagination-sm  pull-right">
                                                <?php
                                                echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                                                echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
                                                echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                                                ?>                                                                          
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="diet_plan_view_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="margin-top: 120px;width: 500px !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">View Details</h4>
                </div>
                <div class="" id="appened_diet_view">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" onclick="hideModal()">Cancel</button>
                </div>
            </div>
        </div>
    </div>


</div>
<script type="text/javascript">

    var myBaseUrl = '<?php echo Router::url('/', true) ?>';

    function showDietDetails(plan_id) {
        $("html,body").animate({scrollTop: 0}, 1000);
        $.ajax({
            type: "POST",
            url: myBaseUrl + "diet_plans/get_diet_plan_details",
            data: {id: plan_id},
            dataType: "html",
            success: function (data)
            {
                $("#appened_diet_view").html(data);
                $("#diet_plan_view_details").modal({backdrop: "static"});
                $('#diet_plan_view_details').modal('show');
            }
        });
    }

    function hideModal() {
        $('#diet_plan_view_details').modal('hide');
    }

    $(document).ready(function () {

        $('.timepicker').timepicker({
            showPeriod: true,
            showLeadingZero: true
        });

        $("#description").removeAttr("rows");
        $("#description").removeAttr("cols");

        $("#cancel_add_new_family_history").hide();

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

        var row_cnt = 1;
        $('#add_more_file').click(function () {
            var append_desg = '<tr id=tr' + row_cnt + '><td><select name="data[DietPlan][PlanDetails][' + row_cnt + '][weekday]" class="form-control" data-bvalidator = "required" data-bvalidator-msg = "Please select weekday."><option value=""> Select Day</option><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thursday</option><option value="5">Friday</option><option value="6">Saturday</option><option value="7">Sunday</option></select></td><td><input type="text" class="form-control timepicker" name="data[DietPlan][PlanDetails][' + row_cnt + '][time]" data-bvalidator="required"  data-bvalidator-msg = "Please enter time." /></td><td><textarea class="form-control" name="data[DietPlan][PlanDetails][' + row_cnt + '][description]" placeholder="Enter description" /></textarea></td><td><a class="btn btn-xs btn-danger del_row" row_id=' + row_cnt + ' onclick=delete_row(' + row_cnt + ')><i class="fa fa-minus"></i></a></td></tr>';
            $(append_desg).appendTo("#appened_diet_tr_totable");
            row_cnt++;
            $('.timepicker').timepicker({
                showPeriod: true,
                showLeadingZero: true
            });
        });

    });

    function delete_row(row_id) {
        $("#tr" + row_id).remove();
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