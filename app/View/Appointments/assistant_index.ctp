<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'assistant_dashboard')) ?>">Dashboard</a>
            </li>
            <li>
                <a class="current" href="">Appointments</a>
            </li>
            <li class="pull-right">
                <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                List of Appointments
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" class="table table-bordered">
                        <?php if (count($appointments) > 0) { ?>
                            <tr>
                                <th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
                                <th><?php echo $this->Paginator->sort('Service.title', 'Service'); ?></th>
                                <th><?php echo $this->Paginator->sort('User.first_name', 'Patient Name'); ?></th>

                                <th><?php echo $this->Paginator->sort('appointed_timing'); ?></th>
                                <th><?php echo $this->Paginator->sort('status'); ?></th>

                                <th class="actions"><?php echo __('Actions'); ?></th>
                            </tr>
                        <?php } ?>

                        <?php
                        if (count($appointments) > 0) {
                            foreach ($appointments as $apt):
                                ?>
                                <tr>
                                    <td><?php echo h('APT-' . $apt['Appointment']['id']); ?>&nbsp;</td>

                                    <td><?php
                                        if (!empty($apt['Service']['title'])) {
                                            echo h($apt['Service']['title']);
                                        } else {
                                            echo "External Patient";
                                        }
                                        ?>&nbsp;</td>

                                    <td><?php
                                        // if(!empty($apt['User']['first_name'])) {
                                        echo h($salutations[$apt['User']['salutation']] . " " . $apt['User']['first_name'] . " " . $apt['User']['last_name']);
                                        ?>&nbsp;</td>
                                    <?php // } ?>
                                    <td><?php
                                        if ($apt['Appointment']['status'] == 2) {
                                            echo date('d-M-Y h:i A', strtotime($apt['Appointment']['scheduled_date']));
                                        } else {
                                            if (!empty($apt['Appointment']['scheduled_date'])) {
                                                echo date('d-M-Y h:i A', strtotime($apt['Appointment']['scheduled_date']));
                                            } else {
                                                echo date('d-M-Y h:i A', strtotime($apt['Appointment']['appointed_timing']));
                                            }
                                        }
                                        ?>&nbsp;</td>
                                    <td><?= $appointment_status[$apt['Appointment']['status']]; ?></td>
                                    <td class="actions">
                                        <?php if ($apt['Appointment']['status'] != 3) { ?>
                                            <?php if (((time() - strtotime($apt['Appointment']['appointed_timing'])) < 0)) { ?>
                                                <a class="btn btn-primary btn-xs no-upper popovers chnge_status_id" apt_id="<?= $apt['Appointment']['id'] ?>" data-content="Update Status" data-placement="bottom" data-toggle="modal" data-target="#Add_status" data-trigger='hover'> <i class="fa fa-edit"></i></a>                                 
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        } else {
                            ?>
                            <h3>No record found.</h3>
                        <?php } ?>
                    </table>

                    <?php if (count($appointments) > 0) { ?>
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
        <div id="Add_status" class="modal fade" role="dialog" aria-hidden="true" style="display: none;">
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
                                            <div class="col-md-4">
                                         <!--<label class="control-label mll">Scheduled Date <span class="required">*</span></label>-->
                                                <?= $this->Form->input('scheduled_date', array('type' => 'text', 'id' => 'scheduled_date', 'class' => 'form-control schedule_date', 'placeholder' => 'Date')) ?>
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
    </div>
</div>
<script type='text/javascript'>
    var max_year = "<?= date('Y', strtotime('+1 year')) ?>";
    var min_year = "<?= date('Y', strtotime('-1 year')) ?>";
    $(document).ready(function () {
        $("#no_submit_btn").hide();

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
</style>
