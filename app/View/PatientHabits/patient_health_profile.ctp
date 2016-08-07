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
                    <a href="<?= Router::url(array('controller' => 'patient_habits', 'action' => 'patient_health_profile', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item active text-center">
                        <h4 class="glyphicon glyphicon-plane"></h4><br>Health Profile
                    </a>

                    <a href="<?= Router::url(array('controller' => 'patient_plan_details', 'action' => 'patient_purchased_plans', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-road"></h4><br>Purchased Plans
                    </a>
                    <a href="<?= Router::url(array('controller' => 'vital_signs', 'action' => 'patient_vital_signs', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-home"></h4><br>Vital Signs
                    </a>
                    <a href="<?= Router::url(array('controller' => 'lab_test_results', 'action' => 'doctor_test_results', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-cutlery"></h4><br>Test Results
                    </a>
                    <a href="<?= Router::url(array('controller' => 'medical_histories', 'action' => 'patient_medical_history', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-credit-card"></h4><br>Medical History
                    </a>
                    <a href="<?= Router::url(array('controller' => 'family_histories', 'action' => 'patient_family_histories', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item  text-center">
                        <h4 class="glyphicon glyphicon-plane"></h4><br>Family History
                    </a>
                    <a href="<?= Router::url(array('controller' => 'diet_plans', 'action' => 'patient_diet_plan', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-road"></h4><br>Diet Plan
                    </a>
                    <a href="<?= Router::url(array('controller' => 'treatment_histories', 'action' => 'patient_treatment', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
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
                        </header>
                        <div class="panel-body">
                            <?php if($user_type_id != 1)
                                echo $this->HTML->link(__('<i class="fa fa-medkit"></i> Add Parameter'), array('controller' => 'patient_habits', 'action' => 'patient_add_habits', $user['User']['id'], $user['User']['user_type']), array('id' => 'add_new_habit', 'escape' => false, 'class' => 'btn btn-danger btn-sm pull-right', 'style' => 'margin-top: -55px;')); 
                            ?>
                            <div class="box">
                                <div class="box-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <?php if (count($patient_habits) > 0) { ?>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Frequency</th>
                                                    <th>Habit Since</th>
                                                    <th>Is Stopped?</th>
                                                    <th>Actions</th>
                                                </tr>
                                            <?php } ?>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (count($patient_habits) > 0) {
                                                foreach ($patient_habits as $habit):
                                                    ?>
                                                    <tr>
                                                        <td><?= ucwords($habit['Habit']['habit_name']) ?></td>
                                                        <td><?= $habit['PatientHabit']['frequency'] . ' ' . $habit['PatientHabit']['unit'] . ' ' . $habit['PatientHabit']['time_period'] ?></td>
                                                        <td><?= $habit['PatientHabit']['habit_since'] ?></td>
                                                        <td><?= ($habit['PatientHabit']['stopped_date']) ? 'YES' : 'NO' ?></td>
                                                        <td>
                                                            <a href="javascript:void(0);" onclick="viewHealthProfileDeatils('<?= $habit['PatientHabit']['id']; ?>');" class="btn btn-warning btn-xs"><i class="fa fa-expand"></i></a>
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
                                    <?php if (count($patient_habits) > 0) { ?>
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <div class="dataTables_info" id="dynamic-table_info">
                                                    <?php
                                                    echo $this->Paginator->counter(array(
                                                        'format' => __('Showing {:current} to {:end} of {:count} entries')
                                                    ));
                                                    ?>
                                                </div>
                                                <div class="span6">
                                                    <div class="dataTables_paginate paging_bootstrap pagination">
                                                        <?php
                                                        echo $this->Paginator->prev('< ' . __('previous '), array(), null, array('class' => 'prev disabled'));
                                                        echo $this->Paginator->numbers(array('separator' => ''));
                                                        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="health_profile_view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="margin-top: 120px;width: 500px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">View Details</h4>
            </div>
            <div class="">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td> <strong>Habbit Name : </strong> <span id="view_name"></span></td>
                        </tr>
                        <tr>
                            <td> <strong>Frequency : </strong> <span id="view_frequency"></span></td>
                        </tr>
                        <tr>
                            <td> <strong>Unit : </strong> <span id="view_unit"></span></td>
                        </tr>
                        <tr>
                            <td> <strong>Time Period : </strong> <span id="view_time"></span></td>
                        </tr>
                        <tr>
                            <td> <strong>Habbit Since : </strong> <span id="view_since"></span></td>
                        </tr>
                        <tr>
                            <td> <strong>Stopped Date : </strong>  <span id="view_date"></span></td>
                        </tr>
                    </tbody></table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="hideModal()">Cancel</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    function hideModal() {
        $('#health_profile_view').modal('hide');
    }

    var myBaseUrl = '<?php echo Router::url('/', true) ?>';

    function viewHealthProfileDeatils(id) {
        $("html,body").animate({scrollTop: 0}, 1000);
        var stopped_date;
        $.ajax({
            type: "POST",
            url: myBaseUrl + "patient_habits/get_health_habbit_byid",
            data: {id: id},
            dataType: "json",
            success: function (data)
            {
                if (data.PatientHabit.stopped_date == null || data.PatientHabit.stopped_date == "0000-00-00") {
                    stopped_date = "Not Available";
                } else {
                    stopped_date = data.PatientHabit.stopped_date;
                }

                if (data != '')
                {
                    $("#view_name").html(data.Habit.habit_name);
                    $("#view_frequency").html(data.PatientHabit.frequency);
                    $("#view_unit").html(data.PatientHabit.unit);
                    $("#view_time").html(data.PatientHabit.time_period);
                    $("#view_since").html(data.PatientHabit.habit_since);
                    $("#view_date").html(stopped_date);
                    $("#health_profile_view").modal({backdrop: "static"});
                    $('#health_profile_view').modal('show');
                }
            }
        });
    }

</script>

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