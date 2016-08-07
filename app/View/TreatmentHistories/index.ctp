<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-9 col-sm-9">
                            <div class="box last">
                                <div class="box-heading">Welcome, <?php echo $users['first_name'] . " " . $users['last_name']; ?> 
                                    <div class="pull-right">
                                        <a href="/users/dashboard" class="btn btn-sm btn-success popovers home"><i class="fa fa-backward"></i> &nbsp;Home</a>
                                        <a class="btn btn-sm btn-success popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <section class="main-content">
                                        <section class="wrapper">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <ul class="breadcrumbs-alt">
                                                        <li>
                                                            <a href="<?= Router::url(array('controller'=>'users','action'=>'dashboard'));?>">Dashboard</a>
                                                        </li>
                                                        <li>
                                                            <a class="current" href="#">Treatments</a>
                                                        </li>

                                                    </ul>
                                                    <div class="pull-right">
                                                        <?php echo $this->Html->link(__('<i class="fa fa-medkit"></i> Add Treatment'), array('action' => 'add'), array('id' => 'add_treatment', 'escape' => false, 'class' => 'btn btn-danger btn-sm', 'style' => 'margin-top: -85px;')); ?>
                                                    </div>
                                                    <section class="panel" style="border: 1px solid #D2D2D2;">
                                                        <div class="panel-body minimal">
                                                            <div class="table-inbox-wrap ">
                                                                <?php
                                                                    if(!empty($treatmentHistories)){
                                                                ?>
                                                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper" role="grid">
                                                                    <table class="table table-striped table-hover dynamic-table dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                                                                        <tr>
                                                                            <th><?php
                                                                                $i = 1;
                                                                                echo $this->Paginator->sort($i, '#');
                                                                                ?></th>
                                                                            <th><?php echo $this->Paginator->sort('name', 'Treatment Name'); ?></th>
                                                                            <th><?php echo $this->Paginator->sort('start_date'); ?></th>
                                                                            <th><?php echo $this->Paginator->sort('end_date'); ?></th>
                                                                            <th><?php echo $this->Paginator->sort('appointment_id', 'Appointment Id'); ?></th>
                                                                            <th><?php echo $this->Paginator->sort('is_cured'); ?></th>
                                                                            <th><?php echo $this->Paginator->sort('is_running'); ?></th>
                                                                            <th class="actions"><?php echo __('Actions'); ?></th>
                                                                        </tr>
                                                                        <?php foreach ($treatmentHistories as $treatmentHistory): ?>
                                                                            <tr>
                                                                                <td><?php echo h($i); ?>&nbsp;</td>
                                                                                <td><?php echo h($treatmentHistory['TreatmentHistory']['name']); ?>&nbsp;</td>
                                                                                <td><?php echo date('d-M-Y h:i A', strtotime($treatmentHistory['TreatmentHistory']['start_date'])); ?>&nbsp;</td>
                                                                                <td><?php echo date('d-M-Y h:i A', strtotime($treatmentHistory['TreatmentHistory']['end_date'])); ?>&nbsp;</td>
                                                                                <td>
                                                                                    <?php if(isset($treatmentHistory['TreatmentHistory']['appointment_id']) && !empty($treatmentHistory['TreatmentHistory']['appointment_id'])) {
                                                                                        echo h('APP - 00'.$treatmentHistory['TreatmentHistory']['appointment_id']); 
                                                                                    } else {
                                                                                        echo "--";
                                                                                    } ?>
                                                                                    &nbsp;
                                                                                </td>
                                                                                <td><?php echo h($treatmentHistory['TreatmentHistory']['is_cured'] == 1 ? 'Yes' : 'No'); ?>&nbsp;</td>
                                                                                <td><?php echo h($treatmentHistory['TreatmentHistory']['is_running'] == 1 ? 'Yes' : 'No'); ?>&nbsp;</td>
                                                                                <td class="actions">
                                                                                    <?php echo $this->Form->button(__('<i class="fa fa-plus"></i>'), array('row_id' => $treatmentHistory['TreatmentHistory']['id'], 'escape' => false, 'title' => 'Add Status', 'data-toggle' => 'modal', 'data-target' => '#Add_status', 'class' => 'add_status_info btn btn-primary btn-xs')); ?>
                                                                                    <?php echo $this->Form->button(__('<i class="fa fa-eye"></i>'), array('escape' => false, 'title' => 'View', 'data-toggle' => 'modal', 'data-target' => '#treatmentdetails_'.$treatmentHistory['TreatmentHistory']['id'], 'class' => 'treatment_details btn btn-warning btn-xs')); ?>
                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                            $i++;
                                                                        endforeach;
                                                                        ?>
                                                                    </table>
                                                                    <p>
                                                                        <?php
                                                                        echo $this->Paginator->counter(array(
                                                                            'format' => __('Showing {:current} to {:end} of {:count} entries')
                                                                        ));
                                                                        ?>	</p>
                                                                    <div class="paging pull-right" style="margin-top: -31px;">
                                                                        <?php
                                                                        echo $this->Paginator->first('<< ');
                                                                        echo $this->Paginator->prev('< ' . __('previous '), array(), null, array('class' => 'prev disabled'));
                                                                        echo $this->Paginator->numbers(array('separator' => ' '));
                                                                        echo $this->Paginator->next(__(' next') . ' >', array(), null, array('class' => 'next'));
                                                                        echo $this->Paginator->last(' >>');
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <?php } else { ?>
                                                                    <div class="alert alert-danger">
                                                                        <i class="fa fa-exclamation-circle mrl"></i>No records found
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </section>
                                                    <!--modal box for view-->
                                                    <?php foreach ($treatmentHistories as $treatmentHistory): ?>
                                                        <div class="modal fade in" id="treatmentdetails_<?php echo $treatmentHistory['TreatmentHistory']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                            <div class="modal-dialog" style="margin:100px auto !important;">
                                                                <div class="modal-content">
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
                                                                                                    <?php if(isset($treatmentHistory['TreatmentHistory']['appointment_id']) && !empty($treatmentHistory['TreatmentHistory']['appointment_id'])) {
                                                                                                        echo h('APP - 00'.$treatmentHistory['TreatmentHistory']['appointment_id']); 
                                                                                                    } else {
                                                                                                        echo "Not Available";
                                                                                                    } ?>
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
                                                                                    <?php if(isset($treatmentHistory['TreatmentHistory']['status']) && !empty($treatmentHistory['TreatmentHistory']['status'])) { ?>
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
                                                </div>
                                            </div>
                                        </section>
                                    </section>
                                </div>
                            </div>
                        </div>
                        <?= $this->element('front_layout_rightbar'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="Add_status" class="modal fade in" role="dialog" aria-hidden="true" style="display: none; top:100px;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Add Status</h4>
            </div>  

            <?php echo $this->Form->create('TreatmentHistory', array('action' => 'add_status'), array('class' => 'cmxform form-horizontal')); ?>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
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
                            <?php echo $this->Form->input('description', array('id' => 'tt_description', 'placeholder' => 'Description...', 'row' => '3', 'class' => 'ckeditor form-control', 'div' => false, 'label' => false)); ?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="form-group modal-footer">
                <?php echo $this->Form->submit(__('Save Treatment Status'), array('class' => 'btn btn-primary btn-outlined')); ?>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    <!--end modal content-->
    </div>
</div>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
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
    .check_bx_spce{
        width:10%;
    }
    .alert {
        padding: 20px;
        font-size: 24px;
    }
    .modal{
        top:9%;
        /*bottom: 35%;*/

    }
</style>