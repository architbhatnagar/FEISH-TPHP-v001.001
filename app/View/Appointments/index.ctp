<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'doctors_dashboard')) ?>">Dashboard</a>
            </li>
            <li>
                <a class="current" href="">Manage Encounters</a>
            </li>
            <li class="pull-right">
                <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                Encounters
            </header>
            <div class="appointments index">
                <div class="panel-body">
                    <table class="table table-bordered table-striped dataTable display">
                        <?php if (count($appointments) > 0) { ?>
                            <tr>
                                <th>#</th>
                                <th><?php echo $this->Paginator->sort('id', 'Appointment ID'); ?></th>
                                <th><?php echo $this->Paginator->sort('Service.title', 'Service Name'); ?></th>
                                <th><?php echo $this->Paginator->sort('user_id', 'Patient ID'); ?></th>
                                <th><?php echo $this->Paginator->sort('User.first_name', 'Patient Name'); ?></th>
                                <th><?php echo $this->Paginator->sort('status'); ?></th>
                                <th><?php echo $this->Paginator->sort('appointed_timing', 'Timing'); ?></th>
                                <th class="actions"><?php echo __('Actions', 'Options'); ?></th>
                            </tr>
                        <?php } ?>

                        <?php
                        if (count($appointments) > 0) {
                            $i = 1;
                            foreach ($appointments as $appointment):
                                ?>
                                <tr>
                                    <td><?php
                                        echo $i;
                                        $i++;
                                        ?>&nbsp;</td>
                                    <td>APT-<?php echo h($appointment['Appointment']['id']); ?>&nbsp;</td>
                                    <td><?php echo h($appointment['Service']['title']); ?>&nbsp;</td>
                                    <td>
                                        <?php echo h("PA-" . $appointment['User']['registration_no']); ?>
                                    </td>
                                    <td><?php echo h($appointment['User']['first_name']." ".$appointment['User']['last_name']); ?></td>
                                    <td> <label class=""><?= $appointment_status[$appointment['Appointment']['status']]; ?></label></td>
                                    <td><?php
                                        if ($appointment['Appointment']['status'] == 2) {
                                            echo date('d-M-Y h:i A', strtotime($appointment['Appointment']['scheduled_date']));
                                        } else {
                                            if (!empty($appointment['Appointment']['scheduled_date'])) {
                                                echo date('d-M-Y h:i A', strtotime($appointment['Appointment']['scheduled_date']));
                                            } else {
                                                echo date('d-M-Y h:i A', strtotime($appointment['Appointment']['appointed_timing']));
                                            }
                                        }
                                        ?>&nbsp;</td>
                                    <td class="actions">
                                        <?php if ($appointment['Appointment']['status'] != 3) { ?>
                                            <?php echo $this->Html->link(__('<i class="fa fa-eye"></i>'), array('action' => 'view_soap_report_details', $appointment['Appointment']['id']), array('escape' => false, 'data-content' => "View SOAP Details", 'data-placement' => "bottom", 'data-trigger' => "hover", 'class' => "popovers btn btn-xs btn-warning btn-sm")); ?>
                                            <?php echo $this->Html->link(__('<i class="fa fa-eye"></i>'), array('action' => 'view_presc', $appointment['Appointment']['id']), array('escape' => false, 'data-content' => "View Drugs Details", 'data-placement' => "bottom", 'data-trigger' => "hover", 'class' => "popovers btn btn-xs btn-danger btn-sm")); ?>
                                            <a class="btn btn-warning btn-xs no-upper popovers chnge_status_id" apt_id="<?= $appointment['Appointment']['id'] ?>" data-content="Update Status" data-placement="bottom" data-toggle="modal" data-target="#Add_status" data-trigger='hover' > <i class="fa fa-edit"></i></a>
                                            <?php if ($appointment['Appointment']['status'] != 0): ?>
                                                <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i>'), array('action' => 'add_encounter', $appointment['Appointment']['id']), array('escape' => false, 'data-content' => "Add SOAP Note", 'data-placement' => "bottom", 'data-trigger' => "hover", 'class' => "popovers btn btn-xs btn-primary btn-sm")); ?>
                                                <?php //echo $this->Html->link(__('View'), array('action' => 'view', $appointment['Appointment']['id'])); ?>
                                                <?php echo $this->Html->link(__('<i class="fa fa-file"></i>'), array('action' => 'add_drugs', $appointment['Appointment']['id']), array('escape' => false, 'data-content' => "Add Drugs", 'data-placement' => "bottom", 'data-trigger' => "hover", 'class' => "popovers btn btn-xs btn-success btn-sm")); ?>
                                                <?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $appointment['Appointment']['id'])); ?>
                                                <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $appointment['Appointment']['id']), null, __('Are you sure you want to delete # %s?', $appointment['Appointment']['id'])); ?>
                                                <?php $this->Html->link(__('<i class="fa fa-print"></i>'), array('action' => '#'), array('escape' => false, 'data-content' => "Print Note", 'data-placement' => "bottom", 'data-trigger' => "hover", 'class' => "popovers btn btn-xs btn-default btn-sm")); ?>
                                                <a href="javascript:void(0)" onclick="displayUploadDoc('<?= $appointment['Appointment']['id']; ?>')" class="btn btn-xs btn-warning no-upper" title="Upload Document"><i class="fa fa-upload"></i> </a>
                                                <a title="Uploaded Documents" class="btn btn-xs btn-danger no-upper" href="<?= Router::url(array('controller' => 'appointments', 'action' => 'view_uploaded_documents', $appointment['Appointment']['id'])) ?>" class="download_pdf popovers" data-content="Download">
                                                    <i class="fa fa-upload"></i>
                                                </a>

                                            <?php endif; ?>
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

                    <?php if (count($appointments) > 0) { ?>
                        <ul class="pagination pagination-sm  pull-right">
                            <?php
                            echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                            echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
                            echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                            ?>                                                                          
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </section>
    </div>
</div>

<div id="upload_pdf" class="modal fade in" role="dialog" aria-hidden="true" style="display: none; top:100px;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <?php echo $this->form->create('Appointments', array('action' => 'appointment_upload_drugs', 'type' => 'file', 'id' => 'upload_pdf_doc')); ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Add Drug PDF</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $this->Form->input('upload_drugs', array('type' => 'file', 'data-bvalidator' => 'required', 'onchange' => 'return imageValidate(this.value)')); ?>
                        </div>
                        <input type="hidden" name="id" id="appointment_id_upload">
                    </div>
                </div>
            </div>
            <div class="form-group modal-footer">
                <?php echo $this->Form->submit(('Upload'), array('class' => 'btn btn-warning btn-md')); ?>
            </div>
        </div>
        <?php echo $this->form->end(); ?>
        <!--end modal content-->
    </div>
</div>

<div id="Add_status" class="modal fade" role="dialog" aria-hidden="true" style="display: none;">
    <script>
        $('.aaaa').timepicker({
            showPeriod: true,
            showLeadingZero: true
        });

        $(document).ready(function () {
            $('#upload_pdf_doc').bValidator();
        });

        function imageValidate(val) {

            var file = $('#upload_drugs').val();

            var exts = ['doc', 'docx', 'png', 'jpg', 'jpeg', 'pdf', 'xlsx', 'xls', 'ico'];
            // first check if file field has any value
            if (file) {
                var get_ext = file.split('.');
                // reverse name to check extension
                get_ext = get_ext.reverse();
                // check file type is valid as given in 'exts' array
                if ($.inArray(get_ext[0].toLowerCase(), exts) > -1) {
                    return true;
                } else {
                    alert('Invalid file!,Please upload only doc,docx,png,jpg,jpeg,pdf,xlsx,xls,ico.');
                    $('#upload_drugs').val('');
                    return false;
                }
            }
        }

        function displayUploadDoc(apt_id) {
            $("#upload_pdf").modal({backdrop: "static"});
            $('#upload_pdf').modal('show');
            $('#appointment_id_upload').val(apt_id);
        }

    </script>
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Update Appointment</h4>
            </div>  
            <?= $this->Form->create('Appointment', array('class' => 'form-horizontal', 'role' => 'form')); ?>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class='col-lg-12'>
                            <div class="col-md-6">
                                <label class="control-label mll">Status <span class="required">*</span></label>
                                <?= $this->Form->input('status', array('options' => $appointment_status, 'id' => 'changed_status', 'empty' => 'Select Status', 'label' => false, 'class' => 'form-control')); ?>
                                <span id="an_hour_before" class="error_text" hidden>Sorry,Appointment can cancel at least before an hour.</span>
                                <?= $this->Form->input('id', array('type' => 'hidden', 'id' => 'apointment_id', 'label' => false)); ?>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class='col-lg-12'>
                            <div class="col-md-12">
                                <div id="date_div" hidden="">
                                    <!--                                    <div class="col-md-4">
                                                                        <label class="control-label mll">Scheduled Date <span class="required">*</span></label>
                                                                        </div>-->
                                    <div class="col-md-4">
                                        <!--<label class="control-label mll">Scheduled Date <span class="required">*</span></label>-->
                                        <?= $this->Form->input('scheduled_date', array('id' => 'scheduled_date', 'type' => 'text', 'class' => 'form-control schedule_date', 'placeholder' => 'Date')); ?>

                                    </div>     
                                    <div class="col-md-12">
                                        <div id="time_slots">

                                        </div>
                                        <!--<label class="control-label mll">Scheduled Time <span class="required">*</span></label>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class='col-lg-12'>
                            <div class="col-md-8">
                                <label class="control-label mll">Reason</label>
                                <?= $this->Form->input('reason', array('type' => 'textarea', 'rows' => 3, 'class' => 'form-control', 'label' => false)); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submit_btn" class="btn btn-success">Book</button>
                <a href="#" id="no_submit_btn" class="btn btn-success" hidden>Book</a>
            </div>
            <?= $this->Form->end(); ?>
        </div>

    </div>
</div>

<script type='text/javascript'>

    var max_year = "<?= date('Y', strtotime('+1 year')) ?>";
    var min_year = "<?= date('Y', strtotime('-1 year')) ?>";
    $(document).ready(function () {
        $("#no_submit_btn").hide();

        $("#schedule_date").combodate({
            firstItem: 'name',
            minuteStep: 1,
            minYear: min_year,
            maxYear: max_year,
        });

        $('#changed_status').change(function () {
            if ($(this).val() == 2) {
                $('#date_div').show();
                $('#schedule_date').attr("required", "required");
                var minDate = $(this).datepicker('getDate');
                $('#scheduled_date').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    minDate: "NOW",
                });
                $('.schedule_time').timepicker({
                    showPeriod: true,
                    showLeadingZero: true
                });
                $("#an_hour_before").hide();
            } else if ($(this).val() == 3) {
                var apt_id = $("#apointment_id").val();
                var base_path = "<?= Router::url('/', true) ?>";

                var urls = base_path + "appointments/can_cancel_appointment";
                $.ajax({
                    method: "POST",
                    url: urls,
                    type: 'json',
                    data: {apt_id: apt_id},
                    success: function (result) {
                        //alert(result);
                        if (result == 0) {
                            $("#an_hour_before").show();
                            $("#date_div").hide();
                            $("#changed_status").val('');
                        }
                    }
                });

            } else {
                $("#an_hour_before").hide();
                $('#date_div').hide();
                $('#schedule_date').removeAttr("required");
            }
        });
        $("#scheduled_date").change(function () {
            var apt_id = $("#apointment_id").val();
            var scheduled_date = $("#scheduled_date").val();
            if (scheduled_date != '' && apt_id != '') {
                var base_path = "<?= Router::url('/', true) ?>";
                var urls = base_path + "appointments/get_time_slots_update";
                $.ajax({
                    method: "POST",
                    url: urls,
                    type: 'html',
                    data: {apt_id: apt_id, scheduled_date: scheduled_date},
                    success: function (result) {
                        $('#time_slots').html('');
                        $('#time_slots').html(result);
                    }
                });
            }
        });
        $(".chnge_status_id").click(function () {
            var apt_id = $(this).attr('apt_id');
            $("#apointment_id").val(apt_id);

            var base_path = "<?= Router::url('/', true) ?>";
            /*
             var urls = base_path + "appointments/get_data";
             $.ajax({
             method: "POST",
             url: urls,
             type: 'json',
             data: {apt_id: apt_id},
             success: function (result) {
             //alert(result);
             if (result == 0) {
             alert(result);
             }
             }
             });
             */

        });
    });
</script>
<style type="text/css">
    .modal-dialog{
        width: 60%;
    }
    .error_text{
        color: red;
    }
    select.ui-datepicker-month {
        color: black;
    }
    select.ui-datepicker-year {
        color: black;
    }
</style>
