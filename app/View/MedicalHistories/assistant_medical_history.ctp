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
        <?php echo $this->element('patient_info'); ?>
    </div>
    <div class="col-sm-12">

        <div class=" col-sm-12 bhoechie-tab-container">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 bhoechie-tab-menu">
                <div class="list-group">
                    <a href="<?= Router::url(array('controller' => 'patient_habits', 'action' => 'assistant_health_profile', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item  text-center">
                        <h4 class="glyphicon glyphicon-plane"></h4><br>Health Profile
                    </a>

                    <a href="<?= Router::url(array('controller' => 'patient_plan_details', 'action' => 'assistant_purchased_plans', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-road"></h4><br>Purchased Plans
                    </a>
                    <a href="<?= Router::url(array('controller' => 'vital_signs', 'action' => 'assistant_vital_signs', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-home"></h4><br>Vital Signs
                    </a>
                    <a href="<?= Router::url(array('controller' => 'lab_test_results', 'action' => 'assistant_test_results', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item  text-center">
                        <h4 class="glyphicon glyphicon-cutlery"></h4><br>Test Results
                    </a>
                    <a href="<?= Router::url(array('controller' => 'medical_histories', 'action' => 'assistant_medical_history', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item active text-center">
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
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">

                <div class="bhoechie-tab-content">

                    <section class="panel">
                        <header class="panel-heading">
                            Medical History
                            <a class="btn btn-sm btn-info pull-right" id="add_new_family_history" style="margin-top: -8px;display: block;">Add </a>
                            <a class="btn btn-sm btn-danger pull-right" id="cancel_add_new_family_history" hidden="" style="margin-top: -8px;display: none;">Cancel</a>
                        </header>
                        <div class="panel-body">
                            <div id="new_family_history" hidden="">
                                <div class="box">
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?php echo $this->Form->create('MedicalHistory', array('action' => 'assistant_update_medical_history', 'name' => "add_medical_history", 'id' => "add-medical-history")); ?>
                                                        <div class="prf-contacts sttng">
                                                            <h4><span id="action"></span> Medical History</h4>
                                                            <hr>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" name="user_id" value="<?= $id; ?>">
                                                            <input type="hidden" name="user_type" value="<?= $user_type; ?>">
                                                            <?php echo $this->Form->input('id', array('id' => "table_id", 'class' => 'hidden form-control', 'div' => false,)); ?>
                                                            <div class="row">

                                                                <div class="col-md-6">
                                                                    <?php echo $this->Form->input('conditions', array('options' => $medicalConditionList, 'empty' => '-Select-', 'id' => 'conditions', 'class' => 'form-control', 'label' => 'Condition *')); ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <?php echo $this->Form->input('condition_type', array('id' => "condition_type", 'required' => '', 'placeholder' => 'Condition Type', 'class' => 'form-control', 'label' => 'Condition Type*')); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">

                                                                <div class="col-md-6">
                                                                    <?php echo $this->Form->input('current_medication', array('options' => array('0' => 'No', '1' => 'Yes'), 'empty' => '-Select-', 'id' => "current_medication", 'required' => '', 'class' => 'form-control', 'label' => 'Current Medication? *')); ?>
                                                                </div>
                                                                <div class="col-md-6" id="added_date">
                                                                    <?php echo $this->Form->input('mh_date', array('type' => 'text', 'id' => 'date', 'readonly' => 'readonly', 'class' => 'form-control', 'div' => false, 'label' => 'Date *')); ?>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <?php echo $this->Form->input('description', array('type' => 'textarea', 'placeholder' => "Description....", 'rows' => '3', 'id' => "description", 'class' => 'form-control', 'div' => false, 'label' => 'Description')); ?>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="form-group mtxxl text-center mbn">
                                                            <?php echo $this->Form->submit(__('Save Medical History'), array('class' => 'btn btn-outlined btn-primary')); ?>
                                                        </div>
                                                        <?php echo $this->Form->end(); ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-bordered">
                                <?php if (count($medicalHistories) > 0) { ?>
                                    <tr>
                                        <th><?php echo "Condition"; ?></th>
                                        <th><?php echo "Condition Type"; ?></th>
                                        <th><?php echo "Is Current Medication?"; ?></th>
                                        <th><?php echo "Date"; ?></th>
                                        <th><?php echo "Description"; ?></th>
                                        <th class="actions"><?php echo __('Actions'); ?></th>
                                    </tr>
                                <?php } ?>
                                <?php
                                if (count($medicalHistories) > 0) {
                                    foreach ($medicalHistories as $medicalHistory):
                                        ?>
                                        <tr>
                                            <td><?php echo h($medicalHistory['MedicalCondition']['name']); ?>&nbsp;</td>
                                            <td><?php echo h($medicalHistory['MedicalHistory']['condition_type']); ?>&nbsp;</td>
                                            <td><?php echo ($medicalHistory['MedicalHistory']['current_medication'] == 1 ? 'Yes' : 'No'); ?>&nbsp;</td>
                                            <td><?php echo h(date("d M Y", strtotime($medicalHistory['MedicalHistory']['mh_date']))); ?>&nbsp;</td>
                                            <td><?php echo h($medicalHistory['MedicalHistory']['description']); ?>&nbsp;</td>
                                            <td class="actions">
                                                <a href="javascript:void(0);" onclick="viewMedicalHistoryDeatils('<?= $medicalHistory['MedicalHistory']['id']; ?>');" data-toggle="modal" class="btn btn-warning btn-xs"><i class="fa fa-search"></i></a>
                                                <?php echo $this->Form->button(__('<i class="fa fa-edit"></i>'), array('escape' => false, 'id' => "edit_medical_hostory_" . $medicalHistory['MedicalHistory']['id'] . "", 'onclick' => "show_edit_div(" . $medicalHistory['MedicalHistory']['id'] . ")", 'data-toggle' => "modal", 'class' => "btn btn-primary btn-xs")); ?>
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
                            </table>

                            <?php if (count($medicalHistories) > 0) { ?>
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
    </div>
</div>

<div class="modal fade" id="medical_history_view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;bottom: -18%;top:-1%">
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
                            <td> <strong>Condition : </strong> <span id="view_condition"></span></td>
                        </tr>
                        <tr>
                            <td> <strong>Condition Type : </strong> <span id="view_condtion_type"></span></td>
                        </tr>
                        <tr>
                            <td> <strong>Is Current Medication? : </strong> <span id="view_medication"></span></td>
                        </tr>
                        <tr>
                            <td> <strong>Date : </strong> <span id="view_date"></span></td>
                        </tr>
                        <tr>
                            <td> <strong>Description : </strong> <span id="view_description"></span></td>
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
        $('#medical_history_view').modal('hide');
    }

    var myBaseUrl = '<?php echo Router::url('/', true) ?>';

    function viewMedicalHistoryDeatils(id) {
        $("html,body").animate({scrollTop: 0}, 1000);
        var medication;
        $.ajax({
            type: "POST",
            url: myBaseUrl + "medical_histories/get_medical_history_byid",
            data: {id: id},
            dataType: "json",
            success: function (data)
            {

                if (data.MedicalHistory.current_medication == 1) {
                    medication = "Yes";
                } else {
                    medication = "No";
                }

                if (data != '')
                {
                    $("#view_condition").html(data.MedicalCondition.name);
                    $("#view_condtion_type").html(data.MedicalHistory.condition_type);
                    $("#view_medication").html(medication);
                    $("#view_date").html(data.MedicalHistory.mh_date);
                    $("#view_description").html(data.MedicalHistory.description);
                    $("#medical_history_view").modal({backdrop: "static"});
                    $('#medical_history_view').modal('show');
                }
            }
        });
    }

</script>

<script type="text/javascript">
    $(document).ready(function () {
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

        $('#date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            startDate: '-3m'
        });
    });

    function show_edit_div(id)
    {
        $("#new_family_history").fadeIn();
        $("#add_new_family_history").toggle();
        $("#cancel_add_new_family_history").toggle();
        $("#cancel_add_new_family_history").bind("click", function () {
            $("input[type=text], textarea,select").val("");
            $("#table_id").val("");
        });
        $.ajax({
            type: "POST",
            url: "<?php echo Router::url(array('controller' => 'medical_histories', 'action' => 'get_medical_history_byid')); ?>",
            data: {'id': id},
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data != '') {
                    $("#table_id").val(data.MedicalHistory.id);
//                    $('#conditions option')[data.MedicalHistory.condition].selected = true;
                    $("#conditions").val(data.MedicalHistory.conditions);
                    $("#condition_type").val(data.MedicalHistory.condition_type);
                    $("#current_medication").val(data.MedicalHistory.current_medication);
                    $("#date").val(data.MedicalHistory.mh_date);
                    $("#description").val(data.MedicalHistory.description);
                    $("#action").html("Edit");

                } else {
                    alert('error');
                }
            }
        });
    }

</script>

<style type="text/css">
    .check_bx_spce{
        width:10%;
    }
    .alert {
        padding: 20px;
        font-size: 24px;
    }
    .modal{
        top:9%;
        bottom: 35%;

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