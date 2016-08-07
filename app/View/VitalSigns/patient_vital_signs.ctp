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
                    <a href="<?= Router::url(array('controller' => 'vital_signs', 'action' => 'patient_vital_signs', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item active text-center">
                        <h4 class="glyphicon glyphicon-home"></h4><br>Vital Signs
                    </a>
                    <a href="<?= Router::url(array('controller' => 'lab_test_results', 'action' => 'doctor_test_results', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
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

                <!--hotel search--> 
                <div class="bhoechie-tab-content">

                    <section class="panel">
                        <header class="panel-heading">
                            Vital Signs
                            <?php if(Authcomponent::user('user_type') != 1) { ?>
                                <?php echo $this->Form->button(__('Add'), array('escape' => false, 'id' => "add_new_vital_sign", 'class' => "btn btn-info pull-right")); ?>
                                <?php echo $this->Form->button(__('Cancel'), array('escape' => false, 'id' => 'cancel_add_new_vital_sign', 'class' => "hiddden btn btn-danger pull-right")); ?>
                            <?php } ?>
                        </header>
                        <div class="panel-body">
                            <div id="new_vital_sign" hidden="">
                                <div class="box">
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?php echo @$this->Form->create('VitalSign', array('action' => 'patient_update_vital_sign', 'name' => 'add_vital_sign_form', 'id' => 'add_vital_sign_form')); ?>
                                                        <div class="prf-contacts sttng">
                                                            <h4><span id="action">Add </span>Vital Sign</h4>
                                                            <hr>
                                                        </div>
                                                        <div class="form-group">
                                                            <?php echo $this->Form->input('id', array('id' => "table_id", 'class' => 'hidden form-control', 'div' => false,)); ?>
                                                            <div class="row">

                                                                <div class="col-md-2">
                                                                    <input type="hidden" name="user_id" value="<?= $id; ?>">
                                                                    <input type="hidden" name="user_type" value="<?= $user_type; ?>">
                                                                    <?php echo $this->Form->input('vital_sign_list_id', array('options' => $vitalSignsList, 'empty' => '-Select-', 'id' => 'vital_sign', 'onchange' => 'change_unit(this.value);', 'class' => 'form-control', 'label' => false)); ?>
                                                                </div>
                                                                <div class="col-md-2" id="replace_div">
                                                                    <?php echo $this->Form->input('vital_unit_id', array('options' => $vitalUnit, 'empty' => '-Select-', 'id' => 'unit', 'class' => 'form-control', 'label' => false)); ?>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <?php echo $this->Form->input('max_observation', array('type' => 'text', 'placeholder' => "Max Observation", 'id' => 'max_observation', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <?php echo $this->Form->input('min_observation', array('type' => 'text', 'placeholder' => "Min Observation", 'id' => 'min_observation', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <?php echo $this->Form->input('observation', array('type' => 'text', 'placeholder' => "Observation", 'id' => 'observation', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <?php echo $this->Form->input('remark', array('type' => 'textarea', 'placeholder' => "remark...", 'rows' => '3', 'id' => 'remark', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-outlined btn-primary')); ?>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <?php echo $this->Form->end(); ?>

                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <?php foreach ($vitalSigns as $vitalSign): ?>
                                <div class="modal fade in view_vital_sign" id="patientsdetails_<?php echo $vitalSign['VitalSign']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog" style="margin:100px auto !important;width: 500px !important;">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">View Details</h4>
                                            </div>
                                            <div class="">
                                                <div class="col-md-12">
                                                    <div class="profile-desk">
                                                        <h4><?php echo h($vitalSign['VitalSignList']['name']); ?></h4>
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <td><span class="text-muted"><strong>General Range:</strong></span></td>
                                                                    <td><span class="text-muted"><strong>Observation:</strong></span></td>
                                                                    <td><span class="text-muted"><strong>Remark:</strong></span></td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><?php echo h($vitalSign['VitalSign']['min_observation'] . " - " . $vitalSign['VitalSign']['max_observation'] . " " . $vitalSign['VitalUnit']['name']); ?></td>
                                                                    <td><?php echo h($vitalSign['VitalSign']['observation']); ?></td>
                                                                    <td><?php echo h($vitalSign['VitalSign']['remark']); ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <button class="btn btn-success pull-right" onclick="hideModal()">Cancel</button>
                                                </div>

                                            </div>
                                            <div class="modal-footer">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <!--modal box - end-->
                            <table class="table table-bordered">
                                <?php if (count($vitalSigns) > 0) { ?>
                                    <tr>
                                        <th><?php echo h('Name'); ?></th>
                                        <th><?php echo h('General Range'); ?></th>
                                        <th><?php echo h('Observation'); ?></th>
                                        <th><?php echo h('Remark'); ?></th>
                                        <th class="actions"><?php echo __('Actions'); ?></th>
                                    </tr>
                                <?php } ?>
                                <?php
                                if (count($vitalSigns) > 0) {
                                    foreach ($vitalSigns as $vitalSign):
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $this->Html->link($vitalSign['VitalSignList']['name'], array('controller' => 'vital_sign_lists', 'action' => 'view', $vitalSign['VitalSignList']['id'])); ?>
                                            </td>
                                            <td><?php echo h($vitalSign['VitalSign']['min_observation'] . " - " . $vitalSign['VitalSign']['max_observation'] . " " . $vitalSign['VitalUnit']['name']); ?>&nbsp;</td>
                                            <td><?php echo h($vitalSign['VitalSign']['observation']); ?>&nbsp;</td>
                                            <td><?php echo h($vitalSign['VitalSign']['remark']); ?>&nbsp;</td>
                                            <td class="actions">
                                                <a href="#patientsdetails_<?php echo $vitalSign['VitalSign']['id']; ?>" data-toggle="modal" class="btn btn-warning btn-xs"><i class="fa fa-search"></i></a>
                                                <?php //echo $this->Form->button(__('<i class="fa fa-search"></i>'), array('action' => "#medical_history_" . $medicalHistory['MedicalHistory']['id']), array('escape' => false, 'data-toggle' => "modal", 'class' => "btn btn-warning btn-xs")); ?>
                                                <?php if(Authcomponent::user('user_type') != 1) { ?>
                                                    <?php echo $this->Form->button(__('<i class="fa fa-edit"></i>'), array('escape' => false, 'id' => "edit_vital_sign_" . $vitalSign['VitalSign']['id'], 'onclick' => "show_edit_div(" . $vitalSign['VitalSign']['id'] . ")", 'data-toggle' => "modal", 'class' => "btn btn-primary btn-xs")); ?>
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
                            </table>

                            <?php if (count($vitalSigns) > 0) { ?>
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
<script type="text/javascript">

    function hideModal() {
        $('.view_vital_sign').modal('hide');
    }

    $(document).ready(function () {
        $("#cancel_add_new_vital_sign").hide();
        $("#add_new_vital_sign").click(function () {
            $("#new_vital_sign").fadeIn();
            $("#add_new_vital_sign").toggle();
            $("#cancel_add_new_vital_sign").toggle();
        });
        $("#cancel_add_new_vital_sign").click(function () {
            $("#new_vital_sign").fadeOut();
            $("#add_new_vital_sign").toggle();
            $("#cancel_add_new_vital_sign").toggle();
            $("input[type=text], textarea,select").val("");
        });
    });

    function show_edit_div(id)
    {
        $("#new_vital_sign").fadeIn();
        $("#add_new_vital_sign").toggle();
        $("#cancel_add_new_vital_sign").toggle();
        $("#cancel_add_new_vital_sign").bind("click", function () {
            $("input[type=text], textarea,select").val("");
            $("#table_id").val("");
        });

        $.ajax({
            type: "POST",
            url: "<?php echo Router::url(array('controller' => 'vital_signs', 'action' => 'get_vital_sign_byid')); ?>",
            data: {id: id},
            dataType: "json",
            success: function (data) {
                if (data != '') {
                    $("#table_id").val(data.VitalSign.id);
                    $("#vital_sign").val(data.VitalSignList.id).change();
                    $("#unit").val(data.VitalUnit.id);
                    $("#max_observation").val(data.VitalSign.max_observation);
                    $("#min_observation").val(data.VitalSign.min_observation);
                    $("#observation").val(data.VitalSign.observation);
                    $("#remark").val(data.VitalSign.remark);
                    $("#action").html("Edit ");

                } else {
                    alert('error');
                }
            }
        });
    }

    function change_unit(thisObj)
    {
//        alert(thisObj);
//        if (typeof thisObj == 'undefined')
//            return false;
//        id = thisObj.value;
//        id++;
        $('#unit').empty();
        $.ajax({
            type: "POST",
            data: {unit: thisObj},
            async: false,
            url: "<?php echo Router::url(array('controller' => 'vital_signs', 'action' => 'change_unit')); ?>",
            success: function (data) {
                var obj = $.parseJSON(data);
                $.each(obj, function (index, val) {
                    //you can access other data by using val.id, val.created etc
                    $('<option>').val(val.id).text(val.name).appendTo('#unit');
                });
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