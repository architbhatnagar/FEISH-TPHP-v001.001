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
                    <a href="<?= Router::url(array('controller' => 'medical_histories', 'action' => 'assistant_medical_history', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item  text-center">
                        <h4 class="glyphicon glyphicon-credit-card"></h4><br>Medical History
                    </a>
                    <a href="<?= Router::url(array('controller' => 'family_histories', 'action' => 'assistant_family_histories', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item  text-center">
                        <h4 class="glyphicon glyphicon-plane"></h4><br>Family History
                    </a>
                    <a href="<?= Router::url(array('controller' => 'diet_plans', 'action' => 'assistant_diet_plan', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item  text-center">
                        <h4 class="glyphicon glyphicon-road"></h4><br>Diet Plan
                    </a>
                    <a href="<?= Router::url(array('controller' => 'treatment_histories', 'action' => 'assistant_treatment', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item active text-center">
                        <h4 class="glyphicon glyphicon-home"></h4><br> Treatments
                    </a>
                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">

                <div class="bhoechie-tab-content">
                    <section class="panel">
                        <header class="panel-heading">
                            Treatments 

                        </header>
                        <div class="panel-body">

                            <?php echo $this->HTML->link(__('<i class="fa fa-medkit"></i> Add Treatment'), array('action' => 'assistant_add_treatment', $id, $user_type), array('id' => 'add_treatment', 'escape' => false, 'class' => 'btn btn-danger btn-sm pull-right', 'style' => 'margin-top: -55px;')); ?>
                            <table class="table table-bordered">
                                <thead>
                                    <?php if (count($treatmentHistories) > 0) { ?>
                                        <tr>
                                            <th><?php
                                                $i = 1;
                                                echo $this->Paginator->sort($i, '#');
                                                ?></th>
                                            <th>Treatment Name</th>
                                            <th>Is Cured</th>
                                            <th>Is Running</th>
                                            <th>Actions</th>
                                        </tr>
                                    <?php } ?>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($treatmentHistories) > 0) {
                                        foreach ($treatmentHistories as $treatmentHistory):
                                            ?>
                                            <tr>
                                                <td><?php echo h($i); ?>&nbsp;</td>
                                                <td><?php echo h($treatmentHistory['TreatmentHistory']['name']); ?>&nbsp;</td>
                                                <td><?php echo h($treatmentHistory['TreatmentHistory']['is_cured'] == 1 ? 'Yes' : 'No'); ?>&nbsp;</td>
                                                <td><?php echo h($treatmentHistory['TreatmentHistory']['is_running'] == 1 ? 'Yes' : 'No'); ?>&nbsp;</td>
                                                <td class="actions">
                                                    <?php echo $this->Form->button(__('<i class="fa fa-plus"></i>'), array('row_id' => $treatmentHistory['TreatmentHistory']['id'], 'escape' => false, 'title' => 'Add Status', 'data-toggle' => 'modal', 'data-target' => '#Add_status', 'class' => 'add_status_info btn btn-primary btn-xs')); ?>
                                                    <?php echo $this->Form->button(__('<i class="fa fa-eye"></i>'), array('escape' => false, 'title' => 'View', 'data-toggle' => 'modal', 'data-target' => '#treatmentdetails_' . $treatmentHistory['TreatmentHistory']['id'], 'class' => 'treatment_details btn btn-warning btn-xs')); ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                        endforeach;
                                    } else {
                                        ?>
                                    <div class="alert alert-block alert-danger">
                                <p><span class="alert-icon"><i class="fa fa-check"></i></span>&nbsp;No records found.</p>
                            </div>
                                <?php } ?>
                                </tbody>
                            </table>

                            <?php if (count($treatmentHistories) > 0) { ?>
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
                <div class="bhoechie-tab-content">

                </div>
            </div>
        </div>
    </div>
</div>

<div id="Add_status" class="modal fade in" role="dialog" aria-hidden="true" style="display: none; top:100px;">
    <div class="modal-dialog" style="width: 500px !important;">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Add Status</h4>
            </div>  

            <?php echo $this->Form->create('TreatmentHistory', array('action' => 'patient_add_status'), array('class' => 'cmxform form-horizontal')); ?>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="patient_id" value="<?= $id; ?>">
                            <input type="hidden" name="user_type" value="<?= $user_type; ?>">
                            <?php echo $this->Form->input('id', array('id' => 'status_id', 'class' => 'form-control', 'label' => FALSE)); ?>
                            <label class="control-label mll">Status <span   class="required">*</span></label>
                            <?php echo $this->Form->input('status', array('id' => 'tt_status', 'options' => $treatment_status, 'empty' => '-Select Status-', 'class' => 'form-control', 'label' => FALSE)); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label mll">Reason <span class="required">*</span></label>
                            <?php echo $this->Form->input('reason', array('id' => 'tt_reason', 'options' => $treatment_reasons, 'empty' => '-Select Reason-', 'class' => 'form-control', 'label' => FALSE)); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">

                        <div class="col-md-8">
                            <label class="control-label mll">Description <span class="required">*</span></label>
                            <?php echo $this->Form->input('description', array('id' => 'tt_description', 'placeholder' => 'Description...', 'row' => '3', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="form-group modal-footer">
                <?php echo $this->Form->submit(__('Save Treatment Status'), array('class' => 'btn btn-primary btn-outlined')); ?>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<!--modal box for view-->
<?php foreach ($treatmentHistories as $treatmentHistory): ?>
    <div class="modal fade in" id="treatmentdetails_<?php echo $treatmentHistory['TreatmentHistory']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="row modal-dialog" style="margin:100px auto !important;">
            <div class="col-md-offset-3 col-md-6 modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><?php echo h($treatmentHistory['TreatmentHistory']['name']); ?></h4>
                </div>
                <div class="">
                    <div class="appened_lab_test_view">
                        <table class="table table-bordered">
                            <tbody> 
                                <tr><td></td></tr>
                                <tr>
                                    <td>
                                        <div class=""> 
                                            <strong>Appointment ID - </strong> 
                                            <?php
                                            if (isset($treatmentHistory['TreatmentHistory']['appointment_id']) && !empty($treatmentHistory['TreatmentHistory']['appointment_id'])) {
                                                echo h('APP - 00' . $treatmentHistory['TreatmentHistory']['appointment_id']);
                                            } else {
                                                echo "Not Available";
                                            }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class=""> 
                                            <strong>Start Date - </strong> <?php echo date('d-M-Y h:i A', strtotime($treatmentHistory['TreatmentHistory']['start_date'])); ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class=""> 
                                            <strong>End Date - </strong> <?php echo date('d-M-Y h:i A', strtotime($treatmentHistory['TreatmentHistory']['end_date'])); ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class=""> 
                                            <strong>Is Cured - </strong> <?php echo h($treatmentHistory['TreatmentHistory']['is_cured'] == 1 ? 'Yes' : 'No'); ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class=""> 
                                            <strong>Is Running - </strong> <?php echo h($treatmentHistory['TreatmentHistory']['is_running'] == 1 ? 'Yes' : 'No'); ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php if (isset($treatmentHistory['TreatmentHistory']['status']) && !empty($treatmentHistory['TreatmentHistory']['status'])) { ?>
                                    <tr>
                                        <td>
                                            <div class=""> 
                                                <strong>Status - </strong> <?php echo h($treatment_status[$treatmentHistory['TreatmentHistory']['status']]); ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td>
                                        <div class=""> 
                                            <strong>Procedure - </strong> <?php echo h($treatmentHistory['Procedure']['name']); ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class=""> 
                                            <strong>Description - </strong> <?php echo h($treatmentHistory['TreatmentHistory']['description']); ?>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!--modal box - end-->
<script>
    $(function () {
        //$('#DataTables_Table_0').DataTable();
    });

    $(document).ready(function () {
        $('.add_status_info').on('click', function () {
            var id = $(this).attr('row_id');
            $('#status_id').val(id);
            $.ajax({
                dataType: "html",
                type: "POST",
                url: "<?php echo Router::url(array('controller' => 'treatment_histories', 'action' => 'get_status_data')); ?>",
                data: {'id': id},
                success: function (data, textStatus) {
                    var obj = $.parseJSON(data);
                    $('#status_id').val(obj.id);
                    $('#tt_status').val(obj.status);
                    $('#tt_reason').val(obj.reason);
                    $('#tt_description').val(obj.description);
                }
            });
        });
    });
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