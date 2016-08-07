<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-9 col-sm-9">
                            <div class="box last">
                                <div class="box-heading">Appointments
                                    <div class="pull-right">
                                        <a href="/users/dashboard" class="btn btn-sm btn-success popovers home"><i class="fa fa-backward"></i> &nbsp;Home</a>
                                        <a class="btn btn-sm btn-success popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="section-content">
                                        <div class="doctor-info">
                                            <nav id="filters" class="doctor-cate-menu">
                                                <ul class="nav nav-pills nav-justified">
                                                    <li class="show_selected active" tab_id="booked"><a>Booked</a></li>
                                                    <li class="show_selected">
                                                        <?php echo $this->Html->link(__('Confirmed'), array('action' => 'view_confirmed')); ?>
                                                        <!--<a>Rescheduled</a>-->
                                                    </li>
                                                    <li class="show_selected">
                                                        <?php echo $this->Html->link(__('Rescheduled'), array('action' => 'view_rescheduled')); ?>
                                                        <!--<a>Rescheduled</a>-->
                                                    </li>
                                                    <li class="show_selected">
                                                        <?php echo $this->Html->link(__('Cancelled'), array('action' => 'view_cancelled')); ?>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="row all_tab_cls" id="booked">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="box">
                                                <br/>
                                                <div class="box-body">
                                                    <?php if (isset($appointments) && !empty($appointments)) { ?>
                                                        <div class="desc">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Name</th>
                                                                        <th>Timing</th>
                                                                        <th class="text-center">Options</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?PHP
                                                                    $i = 0;
                                                                    foreach ($appointments as $key => $value) { //debug($value); die;
                                                                        $i++;
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $i; ?>
                                                                            </td>
                                                                            <td class="service_title"><?PHP echo $value['Service']['title']; ?></td>
                                                                            <td><?PHP echo date('d-M-Y \a\t h:i a', strtotime($value['Appointment']['appointed_timing'])); ?></td>
                                                                            <td>
                                                                                <div class="pull-right">
                                                                                    <a data-content="View" data-placement="top" data-trigger="hover" data-toggle='modal' data-target="#app_details_<?php echo $value['Appointment']['id']; ?>"  href="#" class="btn btn-xs btn-warning no-upper" title='View'><i class="fa fa-eye"></i></a>
                                                                                    <?php /*if (time() > strtotime($value['Appointment']['appointed_timing'])) { ?>
                                                                                    <a data-content="Report" data-placement="top" data-trigger="hover" title="Report"  href="<?= Router::url(array('controller' => 'appointments', 'action' => 'view_report_details', $value['Appointment']['id'])) ?>" class="btn btn-xs btn-info no-upper"><i class="fa fa-pencil"></i></a>
                                                                                        <?php echo $this->Html->link(__('<i class="fa fa-file"></i>'), array('action' => 'add_drugs_by_patient', $value['Appointment']['id'], 1), array('escape' => false, 'data-content' => "Add Drugs", 'data-placement' => "bottom", 'data-trigger' => "hover", 'class' => "popovers btn btn-xs btn-success btn-sm",'title'=>'Add Drugs')); ?>
                                                                                        <?php echo $this->Html->link(__('<i class="fa fa-eye"></i>'), array('action' => 'view_prescription', $value['Appointment']['id'], 1), array('escape' => false, 'data-content' => "Add Drugs", 'data-placement' => "bottom", 'data-trigger' => "hover", 'class' => "popovers btn btn-xs btn-success btn-sm",'title'=>'View Drugs')); ?>
                                                                                        <a href="javascript:void(0)" onclick="display('<?= $value['Appointment']['id']; ?>')" class="btn btn-xs btn-warning no-upper" title="Upload Drugs"><i class="fa fa-upload"></i></a>
                                                                                        <?php if(!empty($value['Appointment']['upload_drugs'])) { ?>
                                                                                        <a title="Documents List" class="btn btn-xs btn-danger no-upper" href="<?= Router::url(array('controller' => 'appointments', 'action' => 'view_documents_list', $value['Appointment']['id'])) ?>" class="download_pdf popovers" data-content="Download">
                                                                                            <i class="fa fa-upload"></i>
                                                                                        </a>
                                                                                        <?php } ?>
                                                                                    <?php } */ ?>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-6" style="margin-top: 1em;">
                                                                        <p>
                                                                            <?php
                                                                            echo $this->Paginator->counter(array(
                                                                                'format' => __('Showing {:current} to {:end} of {:count} entries')
                                                                            ));
                                                                            ?>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <ul class="pagination  pull-right">
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
                                                    <?php } else { ?>
                                                        <div class="alert alert-danger">
                                                            <i class="fa fa-exclamation-circle mrl"></i>No records found
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--modal box for view-->
                                    <?php foreach ($appointments as $key => $value) { ?>
                                        <div class="modal fade in" id="app_details_<?php echo $value['Appointment']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog" style="margin:100px auto !important;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">View Details</h4>
                                                    </div>
                                                    <div class="">
                                                        <div class="appened_lab_test_view">
                                                            <table class="table table-bordered">
                                                                <tbody> 
                                                                    <tr><td></td></tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class=""> 
                                                                                <strong>Appointment ID - </strong> <?php echo h('APP - 00' . $value['Appointment']['id']); ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class=""> 
                                                                                <strong>Patient Name - </strong> <?php echo h($salutations[$value['User']['salutation']] . ' ' . $value['User']['first_name'] . ' ' . $value['User']['last_name']); ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class=""> 
                                                                                <strong>Doctor Name - </strong> <?php echo h($salutations[$value['Doctor']['salutation']] . ' ' . $value['Doctor']['first_name'] . ' ' . $value['Doctor']['last_name']); ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class=""> 
                                                                                <strong>Service - </strong> <?php echo h($value['Service']['title']); ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class=""> 
                                                                                <strong>Status - </strong> <?php echo h($app_status[$value['Appointment']['status']]); ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class=""> 
                                                                                <strong>Appointment Date - </strong> <?php echo date('d-M-Y h:i A', strtotime($value['Appointment']['appointed_timing'])); ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class=""> 
                                                                                <strong>Reason - </strong> <?php echo h($value['Appointment']['reason']); ?>
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
                                    <?php } ?>
                                    <!--modal box - end-->

                                    <div id="upload_pdf" class="modal fade in" role="dialog" aria-hidden="true" style="display: none; top:100px;">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <?php echo $this->form->create('Appointments', array('action' => 'upload_drugs', 'type' => 'file', 'id' => 'upload_pdf_doc')); ?>
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                    <h4 class="modal-title">Add Drug PDF</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <?php echo $this->Form->input('upload_drugs', array('type' => 'file', 'data-bvalidator' => 'required','onchange' => 'return imageValidate(this.value)')); ?>
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

<div class="modal fade in" id="report_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin:100px auto !important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">View Report Details</h4>
            </div>
            <div class="">
                <div class="appened_lab_test_view" id="append_report_data">
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<?=
$this->Html->css(array(
    'front_end/pages/our_team.css',
));
?>
<style type="text/css">
    .doctor-info{
        min-height: 0px !important;
    }
</style>
<script type="text/javascript">

    function display(apt_id) {
        $("#upload_pdf").modal({backdrop: "static"});
        $('#upload_pdf').modal('show');
        $('#appointment_id_upload').val(apt_id);
    }
    
    function imageValidate(val) {

        var file = $('#upload_drugs').val();

        var exts = ['doc', 'docx', 'png', 'jpg', 'jpeg', 'pdf','xlsx','xls','ico'];
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

    $(document).ready(function () {
        $('#upload_pdf_doc').bValidator();
    });
</script>
<script type="text/javascript">

    var myBaseUrl = '<?php echo Router::url('/', true) ?>';

    function showReport(appointment_id) {
        $.ajax({
            type: "POST",
            url: myBaseUrl + "appointments/get_soap_report_byid",
            data: {id: appointment_id},
            dataType: "html",
            success: function (data)
            {
                if (data != '')
                {
                    $('#append_report_data').html(data);
                    $("#report_details").modal({backdrop: "static"});
                    $('#report_details').modal('show');
                }
            }
        });
    }

    $(document).ready(function () {

        $(".show_selected").click(function () {
            var tab_id = $(this).attr('tab_id');
            $(".show_selected").removeClass('active');
            $(this).addClass('active');
            $(".all_tab_cls").fadeOut(-500);
            $("#" + tab_id).fadeIn(1000);
            //$("#panel").hide("slide", { direction: "left" }, 1000);
        });
    });
</script>

