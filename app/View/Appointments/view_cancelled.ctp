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
                                                    <li class="show_selected">
                                                        <?php echo $this->Html->link(__('Booked'), array('action' => 'view_all')); ?>
                                                    </li>
                                                    <li class="show_selected">
                                                        <?php echo $this->Html->link(__('Confirmed'), array('action' => 'view_confirmed')); ?>
                                                        <!--<a>Rescheduled</a>-->
                                                    </li>
                                                    <li class="show_selected">
                                                        <?php echo $this->Html->link(__('Rescheduled'), array('action' => 'view_rescheduled')); ?>
                                                    </li>
                                                    <li class="show_selected active" tab_id="canceled">
                                                        <a>Cancelled</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="row all_tab_cls" id="canceled">
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
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $i = 0;
                                                                    foreach ($appointments as $key => $value) {
                                                                        $i++;
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $i; ?></td>
                                                                            <td class="service_title"><a href="<?= "appointment_details/" . $value['Appointment']['id']; ?>"><?PHP echo $value['Service']['title']; ?></a></td>
                                                                            <td><?PHP 
                                                                            if($value['Appointment']['status'] == 3 && !empty($value['Appointment']['scheduled_date'])){
                                                                                 echo date('d-M-Y h:i A', strtotime($value['Appointment']['scheduled_date']));
                                                                            }else {
                                                                            echo date('d-M-Y \a\t h:i a', strtotime($value['Appointment']['appointed_timing'])); 
                                                                            }
                                                                            ?>
                                                                            </td>
                                                                            <td>
                                                                                <div class="pull-right">
                                                                                    <a data-content="View" data-placement="top" data-trigger="hover" data-toggle='modal' data-target="#app_details_<?php echo $value['Appointment']['id']; ?>"  href="#" class="btn btn-xs btn-warning no-upper" title="View"><i class="fa fa-eye"></i></a>
                                                                                    <!--<a data-content="Dignosis" data-placement="top" data-trigger="hover"  href="javascript:void(0)" onclick="showReport('<?php echo $value['Appointment']['id']; ?>')" class="btn btn-xs btn-info no-upper"><i class="fa fa-file-excel-o"></i> Reports</a>-->
                                                                                    <?php // echo $this->Html->link(__('<i class="fa fa-file"></i> Add Drug'), array('action' => 'add_drugs_by_patient', $value['Appointment']['id'], 3), array('escape' => false, 'data-content' => "Add Drugs", 'data-placement' => "bottom", 'data-trigger' => "hover", 'class' => "popovers btn btn-xs btn-success btn-sm")); ?>
                                                                                    <!--<a data-content="Dignosis" data-placement="top" data-trigger="hover" data-toggle='modal' data-target='#upload_pdf'  href="#" class="btn btn-xs btn-warning no-upper"><i class="fa fa-upload"></i> Upload Drugs</a>-->
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
                                            <?php echo $this->form->create('Appointments', array('action' => 'upload_drugs', 'type' => 'file')); ?>
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                                    <h4 class="modal-title">Add Drug PDF</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <?php echo $this->Form->input('Drug file', array('type' => 'file')); ?>
                                                            </div>
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

<style type="text/css">
    .pagination ul > li.myclass {
        float: left;
        padding: 4px 12px;
        line-height: 20px;
        text-decoration: none;
        background-color: #ffffff;
        border: 1px solid #dddddd;
        border-left-width: 0;
        color: #999999;
        cursor: default;
        background-color: transparent;
    }
    .pagination ul > li.myclass:first-child {
        border-left-width: 1px;
        -webkit-border-bottom-left-radius: 4px;
        border-bottom-left-radius: 4px;
        -webkit-border-top-left-radius: 4px;
        border-top-left-radius: 4px;
        -moz-border-radius-bottomleft: 4px;
        -moz-border-radius-topleft: 4px;
    }
    .pagination ul > li.myclass:last-child {
        -webkit-border-top-right-radius: 4px;
        border-top-right-radius: 4px;
        -webkit-border-bottom-right-radius: 4px;
        border-bottom-right-radius: 4px;
        -moz-border-radius-topright: 4px;
        -moz-border-radius-bottomright: 4px;
    }
</style>
