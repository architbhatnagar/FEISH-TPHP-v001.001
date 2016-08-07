<div class="header-bg-wrapper">
    <div id="header-bg">
        <div class="container">
            <div class="header-bg-content">
                <h2 class="title"><?= ucwords($salutations[$patientDetails['User']['salutation']] . " " . $patientDetails['User']['first_name'] . " " . $patientDetails['User']['last_name']); ?></h2>
                <ol class="breadcrumb"><li><a href="">Patient Details</a></li><li class="active"><?= ucwords($patientDetails['User']['first_name'] . " " . $patientDetails['User']['last_name']); ?></li></ol>
            </div>

        </div>

    </div>

</div>
<?php echo $this->Session->flash(); ?>
<div id="main">
    <!-- CONTENT-->
    <div id="content">
        <div id="section-services-detail" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row">

                    </div>
                    <div style="padding-bottom: 70px" class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-lg-3">
                                    <img class="img-responsive" src="http://www.feish.online/demo/theme/patient/images/service.png">

                                    <div style="margin-top:5px;" class="center">
                                        <div class="row">
                                            <div class="col-lg-2"></div>
                                            <div class="col-lg-8">
                                            </div>
                                            <div class="col-lg-2"></div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-9">
                                    <div class="box">
                                        <div class="box-heading">
                                            <?= ucwords($salutations[$patientDetails['User']['salutation']] . " " . $patientDetails['User']['first_name'] . " " . $patientDetails['User']['last_name']); ?>
                                            <div class="pull-right">                      
                                        <a href="/users/dashboard" class="btn btn-sm btn-success popovers home"><i class="fa fa-backward"></i> &nbsp;Home</a>
                                        <a class="btn btn-sm btn-success popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
                                    </div>
                                            <div class="pos" style="font-size:15px;"><?php echo "PA-000" . $patientDetails['MedicalHistory']['user_id']; ?></div>
                                        </div>

                                        <div class="box-body">
                                            <div class="desc"> 
                                                <strong>Marrital Status - </strong> <?php if(isset($patientDetails['User']['marital_status']) && !empty($patientDetails['User']['marital_status'])){ echo $maritalStatus[$patientDetails['User']['marital_status']]; } else { echo 'Not Available'; } ?>
                                            </div>
                                            <div class="desc"> 
                                                <strong>Occupation - </strong> <?php if(isset($users['Occupation']['name']) && !empty($users['Occupation']['name'])){ echo $users['Occupation']['name']; } else { echo 'Not Available'; } ?>
                                            </div>
                                            <div class="desc"> 
                                                <strong>Ethnicity - </strong> <?php if(isset($users['Ethnicity']['name']) && !empty($users['Ethnicity']['name'])){ echo $users['Ethnicity']['name']; } else { echo 'Not Available'; } ?>
                                            </div>
<!--                                            <div class="desc"> 
                                                <strong>Educatinal Qualification - </strong> <?php //echo $patientDetails['User']['ethnicity']; ?>
                                            </div>-->
                                            <div class="desc"> 
                                                <strong>Height - </strong> <?php if(isset($userDetails['UserDetail']['height']) && !empty($userDetails['UserDetail']['height'])){ echo $userDetails['UserDetail']['height']." cms"; } else { echo 'Not Available'; } ?> , <strong>Weight - </strong> <?php if(isset($userDetails['UserDetail']['weight']) && !empty($userDetails['UserDetail']['weight'])){ echo $userDetails['UserDetail']['weight']." kg"; } else { echo 'Not Available'; } ?>
                                            </div>
                                            <div class="desc"> 
                                                <strong>Waist - </strong> <?php if(isset($userDetails['UserDetail']['waist_size']) && !empty($userDetails['UserDetail']['waist_size'])){ echo $userDetails['UserDetail']['waist_size']." cm"; } else { echo 'Not Available'; } ?> 
                                            </div>
                                            <div class="social-info">
                                                <a href="#" title="Send Message" data-toggle="modal" data-target="#send_message"> 
                                                    <button class="btn btn-primary pull-right">Message Now</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="section-heading text-center" style="margin-top: 68px">
                                <div class="title"><h2>Medical History</h2></div>
                                <div class="line"></div>
                            </div>
                            <div class="section-content">
                                <div class="speciality-info">
                                    <div class="row">
                                        <?php foreach ($patientDescs as $patientDesc): 
                                            $l = count($patientDescs);
                                            if($l == 1) { $md = 12; } else if($l == 2) { $md = 6; } else if($l > 2) { $md = 4; }?>
                                            <div class="col-md-<?php echo $md; ?> text-center">
                                                <h4><?php echo h($patientDesc['MedicalCondition']['name']); ?></h4>
                                                <p></p>
                                                <p><?php echo h($patientDesc['MedicalHistory']['condition_type']); ?> On 
                                                    <?php $formatDt = strtotime($patientDesc['MedicalHistory']['mh_date']); echo date("jS M Y", $formatDt);?>
                                                </p>
                                                <p>Current Medication - <?php echo ($patientDesc['MedicalHistory']['current_medication'] == 1 ? 'Yes' : 'No'); ?></p>
                                                <p><?php echo h($patientDesc['MedicalHistory']['description']); ?></p>
                                            </div>
                                        <?php endforeach; ?>
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
<div id="send_message" class="modal fade in" role="dialog" aria-hidden="false" style="display: none; margin-top: 70px;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Send Message</h4>
            </div>  
            <?php echo $this->Form->create('Communication', array('conrtoller' => 'CommunicationS', 'action' => 'send_message', 'type' => 'file')); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label mll">Subject <span class="required">*</span></label>
                                <?= $this->Form->input('subject', array('type' => 'text', 'id' => 'subject', 'class' => 'form-control', 'label' => false)) ?>
                                <input type="text" name='user_id' class="hidden form-control" value="<?php echo $patientDetails['User']['id']; ?>" />

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label mll">Message <span class="required">*</span></label>
                                <?= $this->Form->input('message', array('id' => 'message', 'placeholder' => 'Your message...', 'row' =>'2', 'class' => 'ckeditor form-control', 'label' => false)) ?>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo $this->Form->input('Attach file', array('type' => 'file')); ?>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-8">
                            <?= $this->Form->input('Send', array('type' => 'submit', 'class' => 'btn btn-primary', 'label' => false)) ?>
                        </div>
                    </div>  
                </div>
            <?php echo $this->Form->end(); ?> 
        </div>

    </div>
</div>

<?= $this->Html->css(array('front_end/pages/services_detail.css', 'front_end/pages/our_team.css')); ?>

<style type="text/css">
    .doctor-info {
        min-height: 0px !important; 
    }
</style>
<script>
    $(document).ready(function () {
        var showChar = 250;
        var ellipsestext = "...";
        var moretext = "read more";
        var lesstext = "shrink";
        $('.more').each(function () {
            var content = $(this).html();

            if (content.length > showChar) {

                var c = content.substr(0, showChar);
                var h = content.substr(showChar - 1, content.length - showChar);

                var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

                $(this).html(html);
            }

        });

        $(".morelink").click(function () {
            if ($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(moretext);
            } else {
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });
    });

</script>
<script>
    $("#timing").click(function () {

        $("ul li#show_timings").slideToggle("slow", function () {
            // Animation complete.
        });
    });
</script>



<script>
    $(document).ready(function ()
    {
        $("#book_appointment").click(function ()
        {
            $("#addNewAppointment").show();

        });
        $("#apt_date").change(function () {
            var s_date = $(this).val();
            if (s_date != '') {
                var base_path = "<?= Router::url('/', true) ?>";
                var urls = base_path + "appointments/get_time_slots_dtl";
                $.ajax({
                    method: "POST",
                    url: urls,
                    type: 'html',
                    data: {apt_date: s_date, service_id: '<?= $id ?>'},
                    success: function (result) {
                        $('#append_ts').html('');
                        $('#append_ts').html(result);
                    }
                });
            }

        });
    });
</script>

<script src="http://www.feish.online/demo/theme/admin/js/lib/jquery.raty.js"></script>
<script>
    $(function () {
        $.fn.raty.defaults.path = 'http://www.feish.online/demo/theme/admin/js/lib/images';

        $('#score').raty({cancel: false,
            target: '#hint',
            targetType: 'number',
            click: function (score) {
                $.post('http://www.feish.online/demo/feedback/add_rating', {score: score, userid: '', service_id: '1'},
                function () {

                });
            }
        });
    });

</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link type="text/css" rel="stylesheet" href="http://www.feish.online/demo/theme/patient/css/pages/our_team.css">
<script>

    $(document).ready(function () {
        $.ajax({
            method: "POST",
            url: "http://www.feish.online/demo/homepage/getbooked_appointments",
            data: {service_id: '1', date: '2016-03-02'},
            success: function (result) {
                $('#appointment_sessions_1').html(result);
                $('.modal-body .nav').tab();
            }
        });
        $.ajax({
            method: "POST",
            url: "http://www.feish.online/demo/homepage/getbooked_appointments",
            data: {service_id: '1', date: '2016-03-02'},
            success: function (result) {
                $('#appointment_sessions_2').html(result);
                $('.modal-body .nav').tab();
            }
        });

        $('#apt_date').datepicker({
            dateFormat: 'dd-mm-yy',
            todayHighlight: 'TRUE',
            autoclose: true,
            minDate: 0,
        });



        $("#close_add_appointment").click(function () {
            $("#addNewAppointment").hide();
        });

        $(".show_selected").click(function () {
            var tab_id = $(this).attr('tab_id');
            $(".show_selected").removeClass('active');
            $(this).addClass('active');
            $(".all_tab_cls").hide();
            $("#" + tab_id).show();
        });
    });

</script>





