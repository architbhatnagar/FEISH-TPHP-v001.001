<script type="text/javascript">

    $(document).ready(function () {
        $('#frm_test_lab_results').bValidator();
    });
</script>
<script type="text/javascript">

    var options = {
        singleError: true,
        showCloseIcon: false
    };

    $('#frm_test_lab_results').bValidator(options);

</script>
<style>
    .bvalidator_errmsg {
        margin-left: -203px;
    }
</style>  
<script>
    function imageValidate(val) {

        var file = $('#report_img').val();

        var exts = ['doc', 'docx', 'png', 'jpg', 'jpeg', 'pdf'];
        // first check if file field has any value
        if (file) {
            var get_ext = file.split('.');
            // reverse name to check extension
            get_ext = get_ext.reverse();
            // check file type is valid as given in 'exts' array
            if ($.inArray(get_ext[0].toLowerCase(), exts) > -1) {
                return true;
            } else {
                alert('Invalid file!,Please upload only doc,docx,png,jpg,jpeg,pdf.');
                $('#report_img').val('');
                return false;
            }
        }
    }


</script>
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

                    <a href="<?= Router::url(array('controller' => 'patient_plan_details', 'action' => 'patient_purchased_plans', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-road"></h4><br>Purchased Plans
                    </a>
                    <a href="<?= Router::url(array('controller' => 'vital_signs', 'action' => 'patient_vital_signs', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-home"></h4><br>Vital Signs
                    </a>
                    <a href="<?= Router::url(array('controller' => 'lab_test_results', 'action' => 'doctor_test_results', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item active text-center">
                        <h4 class="glyphicon glyphicon-cutlery"></h4><br>Test Results
                    </a>
                    <a href="<?= Router::url(array('controller' => 'medical_histories', 'action' => 'patient_medical_history', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item  text-center">
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
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                <div class="bhoechie-tab-content">
                    <section class="panel">
                        <header class="panel-heading">
                            Test Results
                            <?php if(Authcomponent::user('user_type') != 1) { ?>
                                <a style="display: block;" class="btn btn-info pull-right" id="add_new_family_history">Add </a>
                                <a style="display: none;" class="btn btn-danger pull-right" id="cancel_add_new_family_history" hidden="">Cancel</a>
                            <?php } ?>
                        </header>

                        <div class="panel-body">
                            <div style="display: none;" id="new_family_history" hidden="">
                                <div class="box">
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tbody><tr>
                                                    <td>
                                                        <?= $this->Form->create('LabTestResult', array('class' => '', 'id' => 'frm_test_lab_results', 'role' => 'form', 'type' => 'file')); ?>
                                                        <div class="prf-contacts sttng">
                                                            <h4><span id="edit_action">Add</span> Test Result</h4>
                                                            <hr>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input name="id" id="table_id" value="" type="hidden">
                                                                    <label class="control-label mll">Date <span class="required">*</span></label>
                                                                    <?= $this->Form->input('test_date', array('type' => 'text', 'id' => 'test_date', 'class' => 'form-control', 'placeholder' => 'Enter test date', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter test date.', 'readonly' => true)); ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="control-label mll">Test Name <span class="required">*</span></label>
                                                                    <?= $this->Form->input('test_id', array('empty' => 'Select test name', 'options' => $tests, 'id' => 'test_id', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please select test name.')); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="control-label mll">Observed Value <span class="required">*</span></label>
                                                                    <?= $this->Form->input('observed_value', array('type' => 'text', 'id' => 'observed_value', 'class' => 'form-control', 'placeholder' => 'Enter observed value', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter observed value.')); ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="control-label mll">Upload Report <span class="required">*</span></label>
                                                                    <?= $this->Form->input('report_img', array('type' => 'file', 'id' => 'report_img', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please upload report.', 'onchange' => 'return imageValidate(this.value)')); ?>
                                                                    <?= $this->Form->input('report', array('type' => 'hidden', 'id' => 'report', 'label' => false, 'class' => 'form-control')); ?>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label class="control-label mll">Description</label>
                                                                    <?= $this->Form->input('description', array('type' => 'textarea', 'id' => 'test_result_description', 'class' => 'form-control', 'placeholder' => 'Enter description', 'label' => false)); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mtxxl text-center mbn">
                                                            <?= $this->Form->input('Save Test Result', array('type' => 'submit', 'id' => 'btn_submit', 'class' => 'btn btn-outlined btn-primary', 'placeholder' => 'Enter description', 'label' => false)); ?>
                                                        </div>

                                                        <?= $this->Form->end(); ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-bordered">
                                <thead>
                                    <?php if (count($test_results_details) > 0) { ?>
                                        <tr>
                                            <th>Date</th>
                                            <th>Test Name</th>
                                            <th>Report File</th>
                                            <th>Observed Value</th>
                                            <th width="35%">Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    <?php } ?>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($test_results_details) > 0) {
                                        foreach ($test_results_details as $test_results) :
                                            ?>
                                            <tr>
                                                <td><?= date('d M Y', strtotime($test_results['LabTestResult']['test_date'])); ?></td>
                                                <td><?= $test_results['Test']['test_name']; ?></td>
                                                <td><a href="<?= Router::url(array('controller' => 'lab_test_results', 'action' => 'download_sample_file', $test_results['LabTestResult']['report'])) ?>" class="download_pdf" title="Download">
                                                        <?= $test_results['LabTestResult']['report']; ?>
                                                    </a></td>
                                                <td><?= $test_results['LabTestResult']['observed_value']; ?></td>
                                                <th><?= $test_results['LabTestResult']['description']; ?></th>
                                                <td>
                                                    <a href="javascript:void(0);" onclick="viewTestDetails('<?= $test_results['LabTestResult']['id']; ?>');" class="btn btn-warning btn-xs"><i class="fa fa-search"></i></a>
                                                    <?php if(Authcomponent::user('user_type') != 1) { ?>
                                                        <a href="javascript:void(0);" onclick="show_edit_div('<?= $test_results['LabTestResult']['id']; ?>');" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
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

                            <?php if (count($test_results_details) > 0) { ?>
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

                        </div>
                    </section>


                </div>
            </div>
        </div>

        <div class="modal fade" id="test_results_view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" style="margin-top: 120px;width: 500px !important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">View Details</h4>
                    </div>
                    <div class="" id="appened_lab_test_view">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" onclick="hideModal()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- tabs left -->

    <!-- /tabs -->


</div>
<script type="text/javascript">
    var myBaseUrl = '<?php echo Router::url('/', true) ?>';

    $(document).ready(function () {
        $("#cancel_add_new_family_history").hide();
        $("#add_new_family_history").click(function () {
            $("#new_family_history").fadeIn();
            $("#add_new_family_history").toggle();
            $("#cancel_add_new_family_history").toggle();
        });
        $("#cancel_add_new_family_history").click(function () {
            $("#edit_action").html("Add");
            $("#new_family_history").fadeOut();
            $("#add_new_family_history").toggle();
            $("#cancel_add_new_family_history").toggle();
        });

        $('#test_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            maxDate: "NOW"
        });
    });

    function viewTestDetails(id) {

        $.ajax({
            type: "POST",
            url: myBaseUrl + "lab_test_results/view_test_result_byid",
            data: {id: id},
            dataType: "html",
            success: function (data)
            {

                if (data != '')
                {
                    $("#appened_lab_test_view").html(data);
                    $("#test_results_view").modal({backdrop: "static"});
                    $('#test_results_view').modal('show');

                }
            }
        });
    }

    function hideModal() {
        $('#test_results_view').modal('hide');
    }

    function show_edit_div(id)
    {
        $("#new_family_history").fadeIn();
        $("#add_new_family_history").toggle();
        $("#cancel_add_new_family_history").toggle();
        $("#cancel_add_new_family_history").bind("click", function () {
            $("input[type=text], textarea,select").val("");
            $("#table_id").val("");
        });
        var str = String(id);

        $.ajax({
            type: "POST",
            url: myBaseUrl + "lab_test_results/get_test_result_byid",
            data: {id: id},
            dataType: "json",
            success: function (data)
            {
                $("div.bvalidator_errmsg").remove();
                if (data.LabTestResult.report != "") {

                    $("#report_img").removeAttr("data-bvalidator");
                    $("#report_img").removeAttr("data-bvalidator-msg");
                }

                if (data != '')
                {
                    $("#edit_action").html("Edit");
                    $("#add_new_family_history").css("display", "none");
                    $("#cancel_add_new_family_history").css("display", "block");
                    $("#test_result_description").val(data.LabTestResult.description);
                    $("#table_id").val(data.LabTestResult.id);
                    $("#test_date").val(data.LabTestResult.test_date);
                    $("#test_id").val(data.LabTestResult.test_id);
                    $("#observed_value").val(data.LabTestResult.observed_value);
                    $("#report").val(data.LabTestResult.report);
                    $("#report_img").val(data.LabTestResult.report);
                }
            }
        });
    }

    $(document).ready(function () {
//        $("div.bhoechie-tab-menu>div.list-group>a").click(function (e) {
//            e.preventDefault();
//            $(this).siblings('a.active').removeClass("active");
//            $(this).addClass("active");
//            var index = $(this).index();
//            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
//            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
//        });
    });
</script>
<style type="text/css">
    .check_bx_spce{
        width:10%;

    }
    .download_pdf:hover{
        color:#026f7a !important;
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