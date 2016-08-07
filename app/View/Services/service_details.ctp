<script type="text/javascript">

    $(document).ready(function () {
        $('#book_appointment_frm').bValidator();
    });
</script>
<div class="header-bg-wrapper">
    <div id="header-bg">
        <div class="container">
            <div class="header-bg-content">
                <h2 class="title"><?= ucwords($service['Service']['title']); ?></h2>
                <ol class="breadcrumb"><li><a href="">Service Details</a></li><li class="active"><?= ucwords($service['Service']['title']); ?></li></ol>
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
                                    <?php if (!empty($service['Service']['logo'])) { ?>
                                        <?= $this->Html->image('services/' . $service['Service']['logo'], array('class' => 'img-responsive')); ?>
                                    <?php } else { ?>
                                        <?= $this->Html->image('doctor_images.png', array('class' => 'img-responsive default_img_c', 'alt' => '')); ?>
                                    <?php } ?>
                                    <div style="margin-top:5px;" class="center">
                                        <div class="row">
                                            <div class="col-lg-2"></div>
                                            <div class="col-lg-8">
                                                <span class="span_align">
                                                    <div data-rating="<?php if(!empty($reviews[0]['Service']['avg_rating'])) { echo $reviews[0]['Service']['avg_rating']; } ?>"  class="ratings"></div>
                                                </span>
                                            </div>
                                            <div class="col-lg-2"></div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-9">
                                    <div class="box">
                                        <div class="box-heading"><?= ucwords($service['Service']['title']); ?>
                                            <div class="pull-right">
                                        <a href="/users/dashboard" class="btn btn-sm btn-success popovers home"><i class="fa fa-backward"></i> &nbsp;Home</a>
                                        <a class="btn btn-sm btn-success popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
                                    </div>
                                        </div>
                                        <div class="box-body">
                                            <p><i class="fa fa-map-marker fa-lg"></i> 
                                                <?= ucwords($service['Service']['address']); ?>  
                                            </p>
                                            <p>
                                                <?= ucfirst($service['Service']['description']); ?>
                                            </p>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row top-buffer">
                                                        <div class="col-md-12">
                                                            <a data-toggle='modal' data-target='#give_feedback'  href="#"><button class="btn btn-primary btn-sm">Give feedback</button></a> &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <button class="btn btn-success btn-sm " id="book_appointment">Book Appointment</button> &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <a href="#" title="Send Message" data-toggle="modal" data-target="#send_message"> 
                                                                <button class="btn btn-warning btn-sm">Message Now</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="addNewAppointment" style="display: none;">
                                        <div class="box">
                                            <div class="box-heading">Book Appointment <a class="pull-right btn btn-default btn-sm" id="close_add_appointment" title="close"><i class="fa fa-times"></i>&nbsp;Close</a></div>
                                            <div class="box-body">
                                                <div class="panel-body">
                                                    <?= $this->Form->create('Appointment', array('controller' => 'appointments', 'action' => 'book_appointment_by_patient', 'class' => 'form-horizontal', 'id' => 'book_appointment_frm', 'role' => 'form')); ?>
                                                    <?php if ((AuthComponent::user('user_type') == 4)): ?>
                                                        <?php if ($packege_exists != 0): ?>
                                                            <div class="form-body">
                                                                <div class="form-group">
                                                                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Plan</label>
                                                                    <div class="col-lg-4">
                                                                        <?= $this->Form->input('plan_id', array('empty' => 'Select plan name', 'options' => $purchased_plan_list, 'id' => 'plan_id', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please select plan.')); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Date</label>
                                                                    <div class="col-lg-4">
                                                                        <?= $this->Form->input('appointment_date', array('id' => 'apt_date', 'type' => 'text', 'class' => 'form-control  col-lg-4', 'label' => false, 'data-bvalidator' => 'required')); ?>
                                                                    </div>
                                                                </div>
                                                                <?= $this->Form->input('service_id', array('type' => 'hidden', 'value' => $id, 'label' => false)); ?>
                                                                <div class="form-group">
                                                                    <div class="col-lg-12">
                                                                        <div id="append_ts">

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-lg-offset-2 col-lg-10">
                                                                        <button type="submit" class="btn btn-success" id="sumit_btn_book" onclick="return checkEntry()">Book</button>
                                                                        <?= $this->Html->image('loader.gif', array('id' => 'loader', 'class' => '', 'alt' => '', 'style' => 'display:none')); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="alert alert-warning">
                                                                Sorry You haven't purchased plan to book appointment for this service.
                                                            </div>
                                                        <?php endif; ?>

                                                    <?php else: ?>
                                                        <?php if (AuthComponent::user()): ?>
                                                            <div class="alert alert-warning">
                                                                Sorry you are not a patient,You can not book appointment.
                                                            </div>
                                                        <?php else: ?>
                                                            <div class="alert alert-warning">
                                                                Please login to book appointment.
                                                            </div>
                                                        <?php endif; ?>

                                                    <?php endif; ?>

                                                    <?= $this->Form->end(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="section-content">
                                <div class="doctor-info">
                                    <nav id="filters" class="doctor-cate-menu">
                                        <ul class="nav nav-pills nav-justified">

                                            <li class="show_selected active" tab_id="service_plans"><a>Service Plans</a></li>
                                            <li class="show_selected " tab_id="about_service"><a>About</a></li>
                                            <li class="show_selected" tab_id="feedback"><a>Feedback</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="row all_tab_cls" id="service_plans">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="box">
                                        <div class="box-heading">Service Plans</div>
                                        <div class="box-body">
                                            <div class="row">
                                                <?php foreach ($service['PatientPackage'] as $package): ?>
                                                    <div class="col-lg-4 col-md-4">       
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-xs-12 col-md-12">
                                                                    <div class="panel panel-primary ">
                                                                        <div class="panel-heading">
                                                                            <h3 class="panel-title">
                                                                                <?= $package['name'] ?></h3>
                                                                        </div>
                                                                        <div class="panel-body">
                                                                            <div class="the-price">
                                                                                <h1>
                                                                                    <span class="subscript"><i class="fa fa-inr"></i></span>&nbsp;<?= $package['price'] ?></h1>
                                                                                Validity:&nbsp;<small><?= $package['validity'] ?>&nbsp;Days</small>
                                                                            </div>
                                                                            <div class="service_block">
                                                                                <?php $details = explode(',', $package['plan_details']); ?>
                                                                                <?php foreach ($details as $key => $dtl): ?>
                                                                                    <?php if ($key <= 1): ?>  
                                                                                        <li><i class="fa fa-check"></i>
                                                                                            <?=
                                                                                            $this->Text->truncate($dtl, 30, array(
                                                                                                'ellipsis' => '...',
                                                                                                'exact' => false
                                                                                            ));
                                                                                            ?>
                                                                                        </li>

                                                                                    <?php else: ?>
                                                                                        <?php break; ?>
                                                                                    <?php endif; ?>

                                                                                <?php endforeach; ?>
                                                                            </div>
                                                                            <div class="panel-footer">
                                                                                <a href="<?= Router::url(array('controller' => 'patient_packages', 'action' => 'view', $package['id'], $id)); ?>" class="btn btn-success center-block" role="button">Buy Now</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row all_tab_cls" id="about_service" hidden="">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="box">
                                        <div class="box-heading">Timing</div>
                                        <div class="box-body">
                                            <br><b><a id="timing">
                                                    <ul class="doc-clinic-services">
                                                        <?php foreach ($timing_arr as $key => $time): ?>
                                                            <li>
                                                                <?= $days[$key] ?>:
                                                                <ul>
                                                                    <?php foreach ($time as $ind_time): ?>
                                                                        <li>
                                                                            <?= date('h:i a', strtotime($ind_time['open_time'])) . "  - " . date('h:i a', strtotime($ind_time['close_time'])) ?>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            </li>
                                                        <?php endforeach; ?>
                                                        </div>
                                                        </div>
                                                        <div class="box">
                                                            <div class="box-heading">Specializations</div>
                                                            <div class="box-body">

                                                                <ul class="doc-clinic-services">
                                                                    <?php foreach ($specialities as $spe): ?>
                                                                        <li>  <?= ucwords($spe); ?></li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="box mbn">
                                                            <div class="box-heading">Doctor</div>
                                                            <div class="box-body">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <div class="t-img">
                                                                            <a href="#" style="color:#333;font-weight:normal;" target="_blank">
                                                                                <img style="height:76px;width:76px;" class="img-responsive center-block" src="http://www.feish.online/demo/files/1601210616327724.png">
                                                                            </a>
                                                                        </div>

                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="row">
                                                                            <div class="col-md-12 t-name">
                                                                                <h5><strong><?= $salutations[$service['User']['salutation']] . ". " . $service['User']['first_name'] . " " . $service['User']['last_name'] ?></strong></h5>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        </div>
                                                        </div>



                                                        <div class="row all_tab_cls" id="feedback" hidden="">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <div class="box">
                                                                    <div class="box-heading">Feedback</div>
                                                                    <div class="box-body">
                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th width="20%">Review By</th>
                                                                                    <th width="20%"> Ratings</th>
                                                                                    <th> Review Text</th>
                                                                                    <th> Reply Text</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php if (!empty($reviews)): ?>
                                                                                    <?php foreach ($reviews as $review): ?>
                                                                                        <tr>
                                                                                            <td><?= $salutations[$review['User']['salutation']] . ". " . $review['User']['first_name'] . " " . $review['User']['last_name'] ?></td>
                                                                                            <td>
                                                                                                <div data-rating="<?php echo $review['Review']['rating']; ?>" id="ratings_<?php echo $review['Review']['id']; ?>" class="ratings"></div>

                                                                                            </td>
                                                                                            <td><?= ucfirst($review['Review']['review']) ?></td>
                                                                                            <td><?php
                                                                                                if (!empty($review['Review']['reply_desc']) && $review['Review']['reply_approve'] == 1) {
                                                                                                    echo ucfirst($review['Review']['reply_desc']);
                                                                                                } else {
                                                                                                    echo '-';
                                                                                                }
                                                                                                ?></td>
                                                                                        </tr>
                                                                                    <?php endforeach; ?>
                                                                                <?php else: ?>
                                                                                    <tr>
                                                                                        <td colspan="4">
                                                                                            <div class="alert alert-warning">
                                                                                                Feedback not available...
                                                                                            </div>

                                                                                        </td>
                                                                                    </tr>
                                                                                <?php endif; ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        </div>
                                                        <?= $this->element('front_layout_rightbar'); ?>
                                                        <!--                                                        <div class="col-md-3">
                                                                                                                    <div class="box">
                                                                                                                        <div class="box-heading">Our departments</div>
                                                                                                                        <div class="box-body">
                                                                                                                            <nav class="list-our-departments">
                                                                                                                                <ul class="list-unstyled">
                                                                                                                                    <li><a href="#"><i class="med-teeth"></i>Dental</a></li>
                                                                                                                                    <li><a href="#"><i class="med-heart2"></i>cardiology</a></li>
                                                                                                                                    <li><a href="#"><i class="med-brain"></i>neurology</a></li>
                                                                                                                                    <li><a href="#"><i class="med-medical1"></i>Drugstore</a></li>
                                                                                                                                    <li><a href="#"><i class="med-xray"></i>x-ray</a></li>
                                                                                                                                    <li><a href="#"><i class="med-baby"></i>birth</a></li>
                                                                                                                                    <li><a href="#"><i class="med-stethoscope"></i>general</a>
                                                                                                                                    </li><li><a href="#"><i class="med-xray"></i>testing</a></li><li><a href="services_detail.html#"><i class="med-biology"></i>first-aid</a></li>
                                                                                                                                    <li><a href="#"><i class="med-syringe"></i>immunizations</a></li>
                                                                                                                                    <li><a href="#"><i class="med-skeleton"></i>pulmonary</a></li>
                                                                                                                                </ul>
                                                                                                                            </nav>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>-->
                                                        </div>

                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>

                                                        <!--geve feedback modal-->
                                                        <div id="give_feedback" class="modal fade in" role="dialog" aria-hidden="true" style="display: none; top:100px;">
                                                            <div class="modal-dialog">
                                                                <!-- Modal content-->
                                                                <?php echo $this->form->create('Review', array('id' => 'feedback_form', 'action' => 'save_feedback')); ?>
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                                        <h4 class="modal-title">Your Feedback</h4>
                                                                    </div>
                                                                    <?php if (!empty($user_loggedin)) { ?>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col-md-8">
                                                                                        <label class="control-label mll">Rate <span class="required">*</span></label>
                                                                                        <div id="feedback_rating" class="feedback_rating"></div>
                                                                                        <?php echo $this->Form->input('Review.rating', array('id' => 'fb_rating', 'readonly' => 'readonly', 'class' => 'hidden form-control', 'div' => false, 'label' => false)); ?>
                                                                                        <input name='data[Review][service_id]' value='<?php echo $id; ?>' id='fb_service_id' readonly class='hidden form-control' />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="col-md-8">
                                                                                        <label class="control-label mll">Reviews <span class="required">*</span></label>
                                                                                        <?php echo $this->Form->input('Review.review', array('data-bvalidator' => 'required', 'id' => 'fb_review', 'placeholder' => 'review...', 'row' => '3', 'class' => 'ckeditor form-control', 'div' => false, 'label' => false)); ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group modal-footer">
                                                                            <?php echo $this->Form->submit(('Send'), array('class' => 'btn btn-warning btn-md')); ?>
                                                                        </div>
                                                                    <?php } else { ?>
                                                                        <div class="modal-body  alert-danger">
                                                                            <div class="form-group">
                                                                                <div class="row">
                                                                                    <div class="alert-danger col-md-offset-1 col-md-10">
                                                                                        <i class="fa fa-exclamation-circle mrl"></i>Please login to give feedback
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                                <?php echo $this->form->end(); ?>
                                                                <!--end modal content-->
                                                            </div>
                                                        </div>
                                                        <!--feedback modal - end-->
                                                        <!--message now modal-->
                                                        <div id="send_message" class="modal fade in" role="dialog" aria-hidden="false" style="display: none; margin-top: 70px;">
                                                            <div class="modal-dialog">

                                                                <!-- Modal content-->
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                                        <h4 class="modal-title">Send Message</h4>
                                                                    </div> 
                                                                    <?php echo $this->Form->create('Communication', array('conrtoller' => 'Communications', 'action' => 'send_message_to_dr', 'type' => 'file')); ?>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <label class="control-label mll">Subject <span class="required">*</span></label>
                                                                                    <?= $this->Form->input('subject', array('type' => 'text', 'id' => 'subject', 'class' => 'form-control', 'label' => false)) ?>
                                                                                    <?= $this->Form->input('service_id', array('value' => $service['Service']['id'], 'type' => 'text', 'id' => 'msg_service_id', 'class' => 'hidden form-control', 'label' => false)) ?>
                                                                                    <?= $this->Form->input('reciever_user_id', array('value' => $service['Service']['user_id'] . ",0", 'type' => 'text', 'id' => 'msg_rcv_user_id', 'class' => 'hidden form-control', 'label' => false)) ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <label class="control-label mll">Message <span class="required">*</span></label>
                                                                                    <?= $this->Form->input('message', array('id' => 'message', 'placeholder' => 'Your message...', 'row' => '2', 'class' => 'ckeditor form-control', 'label' => false)) ?>
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
                                                        <!--message modal - end-->

                                                        <?= $this->Html->css(array('front_end/pages/services_detail.css', 'front_end/pages/our_team.css')); ?>

                                                        <style type="text/css">
                                                            .doctor-info {
                                                                min-height: 0px !important; 
                                                            }
                                                            .service_block{
                                                                min-height: 70px !important;
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
                                                            function checkEntry() {
                                                                if ($('#apt_date').val() == "") {
                                                                    alert("Please select book date.");
                                                                    return false;
                                                                } else {
                                                                    return true;
                                                                }
                                                            }


                                                            $(document).ready(function ()
                                                            {
                                                                $("#book_appointment").click(function ()
                                                                {
                                                                    $("#addNewAppointment").show();

                                                                });
                                                                $("#apt_date").change(function () {
                                                                    var s_date = $(this).val();

                                                                    if (s_date != '') {
                                                                        $('#sumit_btn_book').hide();
                                                                        $('#loader').show();
                                                                        var base_path = "<?= Router::url('/', true) ?>";
                                                                        var urls = base_path + "appointments/get_time_slots_dtl";
                                                                        $.ajax({
                                                                            method: "POST",
                                                                            url: urls,
                                                                            type: 'html',
                                                                            data: {apt_date: s_date, service_id: '<?= $id ?>'},
                                                                            success: function (result) {
                                                                                $('#loader').hide();
                                                                                $('#sumit_btn_book').show();
                                                                                $('#append_ts').html('');
                                                                                $('#append_ts').html(result);
                                                                            }
                                                                        });
                                                                    } else {
                                                                        $('#append_ts').hide();
                                                                        $('#loader').hide();
                                                                        $('#sumit_btn_book').show();
                                                                    }

                                                                });
                                                            });
                                                        </script>
                                                        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
                                                        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

                                                        <script>
                                                            $(document).ready(function () {
                                                                $('#feedback_form').bValidator();
                                                                $('#feedback_rating').raty({
                                                                    half: true,
                                                                    halfShow: true,
                                                                    number: 5,
                                                                    click: function (score) {
                                                                        rate = (Math.ceil(score * 2) / 2).toFixed(1);
                                                                        $('#fb_rating').val(rate);
                                                                    },
                                                                    path: '../../img/raty/'
                                                                });

                                                                $('.ratings').raty({
                                                                    readOnly: true,
                                                                    half: true,
                                                                    halfShow: true,
                                                                    number: 5,
                                                                    score: function () {
                                                                        return $(this).attr('data-rating');
                                                                    },
                                                                    path: '../../img/raty/'
                                                                });



                                                                $('#apt_date').datepicker({
                                                                    minDate: new Date()
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









