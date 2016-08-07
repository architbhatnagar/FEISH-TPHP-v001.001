<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-9 col-sm-9">
                            <div class="box last">
                                <div class="box-heading">Appointment Document List<a class="btn btn-sm btn-success pull-right popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a></div>
                                <div class="box-body">
                                    <div class="section-content">
                                        <!--                                        <div class="doctor-info">
                                                                                    <nav id="filters" class="doctor-cate-menu">
                                                                                        <ul class="nav nav-pills nav-justified">
                                                                                            <li class="show_selected active" tab_id="booked"><a>Booked</a></li>
                                                                                            <li class="show_selected">
                                        <?php echo $this->Html->link(__('Confirmed'), array('action' => 'view_confirmed')); ?>
                                                                                                <a>Rescheduled</a>
                                                                                            </li>
                                                                                            <li class="show_selected">
                                        <?php echo $this->Html->link(__('Rescheduled'), array('action' => 'view_rescheduled')); ?>
                                                                                                <a>Rescheduled</a>
                                                                                            </li>
                                                                                            <li class="show_selected">
                                        <?php echo $this->Html->link(__('Cancelled'), array('action' => 'view_cancelled')); ?>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </nav>
                                                                                </div>-->
                                    </div>
                                    <div class="row all_tab_cls" id="booked">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="box">
                                                <br/>
                                                <div class="box-body">
                                                    <?php if (isset($appointment_uploaded_doc) && !empty($appointment_uploaded_doc)) { ?>
                                                        <div class="desc">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <?php if (count($appointment_uploaded_doc) > 0) { ?>
                                                                        <tr>
                                                                            <th>Sr No.</th>
                                                                            <th>Service Name</th>
                                                                            <th>Appointment Timing</th>
                                                                            <th>Uploaded By</th>
                                                                            <th>Documents</th>
                                                                        </tr>
                                                                    <?php } ?> 
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    if (count($appointment_uploaded_doc) > 0) {
                                                                        $i = 1;
                                                                        foreach ($appointment_uploaded_doc as $uploaded_doc) :
                                                                            ?>
                                                                            <tr>
                                                                                <td><?= $i; ?></td>
                                                                                <td><?= $appointment['Service']['title']; ?></td>
                                                                                <td>
                                                                                    <?PHP
                                                                                    if ($appointment['Appointment']['status'] != 2) {
                                                                                        echo date('d-M-Y \a\t h:i a', strtotime($appointment['Appointment']['appointed_timing']));
                                                                                    } else {
                                                                                        echo date('d-M-Y \a\t h:i a', strtotime($appointment['Appointment']['scheduled_date']));
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                                <td><?PHP echo $salutations[$uploaded_doc['User']['salutation']] . " " . $uploaded_doc['User']['first_name'] . " " . $uploaded_doc['User']['last_name']; ?></td>
                                                                                <td>

                                                                                    <a href="<?= Router::url(array('controller' => 'appointments', 'action' => 'download_uploaded_file', $uploaded_doc['UploadDocument']['file_name'])) ?>" class="download_pdf popovers" data-content="Download">
                                                                                        <?= $uploaded_doc['UploadDocument']['file_name']; ?>
                                                                                    </a>

                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                            $i++;
                                                                        endforeach;
                                                                    } else {
                                                                        ?>
                                                                    <div class="alert alert-danger">
                                                                        <i class="fa fa-exclamation-circle mrl"></i>No records found
                                                                    </div>
                                                                <?php } ?>
                                                                </tbody>
                                                            </table>

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

