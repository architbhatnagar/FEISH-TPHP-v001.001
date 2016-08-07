<div class="header-bg-wrapper">
    <div id="header-bg">
        <div class="container">
            <div class="header-bg-content">
                <ol class="breadcrumb">
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li class="active">
                        Signup
                    </li>
                </ol>
                <h2 class="title">Sign Up</h2>
                <div class="desc">Best place to keep you healthy</div>
            </div>

        </div>

    </div>

</div>

<div id="main">
    <div id="content">
        <div class="section">
            <div class="container">
                <div class="section-content">
                    <div style="padding-bottom: 70px" class="row">
                        <div class="col-md-2 col-sm-2"></div>
                        <div class="col-md-8 col-sm-8">
                            <div class="box mbn">
                                <div class="box-heading">Fill the form below</div>
                                <div class="box-body">
                                    <?= $this->Form->create('User', array('class' => 'form-contact', 'id' => 'signup')); ?>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="col-md-8 col-sm-8">
                                                    <?php
                                                    $options = array(2 => 'Doctor', 4 => 'Individual');
                                                    $attributes = array(
                                                        'class' => 'user_type',
                                                        'legend' => false, 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                                                        'data-bvalidator' => 'required', 'value' => 4);
                                                    ?>
                                                    <?php echo $this->Form->radio('user_type', $options, $attributes); ?>
                                                </div>
                                                <div class="col-md-4 col-sm-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-2 col-sm-2">
                                            <label class="control-label ">Salutation <span class="required">*</span></label>
                                            <?= $this->Form->input('salutation', array('options' => $salutations, 'empty' => 'Select', 'label' => false, 'class' => 'form-control', 'tabindex' => 1, 'data-bvalidator' => 'required')); ?>

                                        </div>
                                        <div class="col-md-5 col-sm-5">
                                            <label class="control-label ">First Name <span class="required">*</span></label>
                                            <?= $this->Form->input('first_name', array('class' => 'form-control', 'placeholder' => 'First Name', 'label' => false, 'tabindex' => 2, 'data-bvalidator' => 'alpha,minlength[3],required')); ?>
                                        </div>
                                        <div class="col-md-5 col-sm-5">
                                            <label class="control-label ">Last Name <span class="required">*</span></label>
                                            <?= $this->Form->input('last_name', array('class' => 'form-control', 'placeholder' => 'Last Name', 'label' => false, 'tabindex' => 3, 'data-bvalidator' => 'alpha,minlength[3],required')); ?>
                                        </div>
                                    </div>

                                    <div class="form-group" id="dob_div">
                                        <div class="col-md-12 col-sm-12">
                                            <div style="margin-bottom: 20px; margin-top: 20px">
                                                <label class="control-label ">Date of Birth <span class="required">*</span></label>
                                                <?php echo $this->Form->input('birth_date', array('class' => 'form-control', 'type' => 'text', 'placeholder' => 'MM/DD/YYYY', 'label' => false, 'id' => 'dob_date', 'data-bvalidator' => 'required')); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <div style="margin-bottom: 20px; margin-top: 20px">
                                                <label class="control-label ">Sex <span class="required">*</span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <?php
                                                $options = array(1 => '  Male', 2 => '  Female');
                                                $attributes = array(
                                                    'legend' => false, 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                                                    'data-bvalidator' => 'required', 'tabindex' => 5);
                                                ?>
                                                <?php echo $this->Form->radio('gender', $options, $attributes); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <label class="control-label ">Email ID <span class="required">*</span></label>
                                            <?= $this->Form->input('email', array('id' => 'email_id', 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Email ID', 'label' => false, 'tabindex' => 6, 'data-bvalidator' => 'email,required')); ?> 
                                            <span id="email_invalid" style="color:red;" hidden> Sorry,Email already registered.</span>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 mtl" id="emailRpl"></div>

                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <label class="control-label ">Mobile Number <span class="required">*</span></label>
                                            <?= $this->Form->input('mobile', array('id' => 'mobile', 'class' => 'form-control', 'placeholder' => 'Mobile Number', 'autocomplete' => 'off', 'label' => false, 'tabindex' => 7, 'maxlength' => 10, 'minlength' => 10, 'data-bvalidator' => 'digit,minlength[10],maxlength[10],required')); ?>                                          
                                            <span id="mobile_invalid" style="color:red;" hidden> Sorry,Mobile number already registered.</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 mtl"></div>

                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <label class="control-label ">Password <span class="required">*</span></label>
                                            <?= $this->Form->input('password', array('type' => 'password', 'autocomplete' => 'off', 'class' => 'form-control', 'placeholder' => 'Password', 'label' => false, 'tabindex' => 8, 'minlength' => 6, 'maxlength' => 15, 'data-bvalidator' => 'required,minlength[6]')); ?>
                                        </div>
                                    </div>

                                    <div id="doctor_div" hidden="">
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12">
                                                <label class="control-label" style="margin-top: 20px;">MCI Number <span class="required">*</span></label>
                                                <?= $this->Form->input('mci_number', array('id' => 'mci_no', 'class' => 'form-control', 'placeholder' => 'MCI Number', 'disabled' => true, 'label' => false, 'tabindex' => 9, 'data-bvalidator' => 'required')); ?>                                          
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <?= $this->Form->input('is_agree', array('type' => 'checkbox', 'autocomplete' => 'off', 'class' => 'check_mgr', 'label' => false, 'tabindex' => 10, 'data-bvalidator' => 'required')); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            I agree the <a style="color:#31708f" target="_blank" href="<?= Router::url(array('controller' => 'users', 'action' => 'terms_and_conditions')) ?>"> Terms & Conditions</a>.
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 mtl"></div>

                                    <div class="col-md-12 col-sm-12 mtl"></div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="g-recaptcha" data-sitekey="6LdZwhkTAAAAAGUAMd_KE6_K3ZuY5wSG-Reco8wW" style="margin:0 auto !important;" align="center"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3"></div>
                                    <div class="col-md-6 col-sm-6 mtl"></div>
                                    <div class="col-md-3 col-sm-3"></div>
                                    <div class="form-group mtxxl text-center mbn">
                                        <div class="col-md-12 col-sm-12">
                                            <?= $this->Form->input('Sign Up', array('type' => 'submit', 'class' => 'btn btn-outlined btn-primary mtl', 'label' => false, 'onclick' => 'return checkCaptcha()')) ?>
                                        </div>
                                    </div>
                                    <?= $this->Form->end(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">

    function checkCaptcha() { 
        if (($('#UserFirstName').val() != "") && ($('#UserLastName').val() != "") && ($('#email_id').val() != "") && ($('#UserPassword').val() != "")) {
            if ($('#g-recaptcha-response').val() == "") {
                alert("Please verify I'm not robot.");
                return false;
            }else{
                return true;
            }
        }

    }

    $(document).ready(function () {

        $('#dob_date').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
            maxDate: "NOW",
        });

        $('.ptxxl').removeClass();
        $("#signup").bValidator();
//        $('.user_type').on('click', function () {
//            if ($(this).val() == 2) {
//                $("#doctor_div").show();
//                $("#dob_div").hide();
//                $('#dob_date').removeAttr('data-bvalidator');
//                $("#mci_no").attr('disabled', false);
//            } else {
//                $("#doctor_div").hide();
//                $("#dob_div").show();
//                $('#dob_date').attr('data-bvalidator', 'required');
//                $("#mci_no").attr('disabled', true);
//            }
//        });

        $("#email_id").blur(function () {
            var email_id = $("#email_id").val();
            if (email_id != "")
            {
                $.ajax({
                    dataType: "html",
                    type: "POST",
                    url: "<?php echo Router::url(array('controller' => 'users', 'action' => 'check_mail_id')); ?>",
                    data: {'email_id': email_id},
                    success: function (data) {
                        if (data == 0) {
                            $("#email_invalid").hide();
                        } else {
                            $("#email_id").val('');
                            $("#email_invalid").show();
                        }
                        //                        $("#div1").html(data);
                        console.log(data);
                    }
                });
            }
        });
        $("#mobile").blur(function () {
            var mobile = $("#mobile").val();
            if (mobile != "")
            {
                $.ajax({
                    dataType: "html",
                    type: "POST",
                    url: "<?php echo Router::url(array('controller' => 'users', 'action' => 'check_mobile')); ?>",
                    data: {'mobile': mobile},
                    success: function (data) {
                        if (data == 0) {
                            $("#mobile_invalid").hide();
                        } else {
                            $("#mobile").val('');
                            $("#mobile_invalid").show();
                        }
                        //                        $("#div1").html(data);
                        console.log(data);
                    }
                });
            }
        });

    });

    function radio_change(value) {
        if (value == 2) {
            $("#doctor_div").show();
            $("#dob_div").hide();
            $('#dob_date').removeAttr('data-bvalidator');
        } else {
            $("#doctor_div").hide();
            $('#dob_date').attr('data-bvalidator', 'required');
            $("#dob_div").show();
        }
    }
</script>
<style type="text/css">
    .check_mgr{
        margin-left: 0px !important;
    }
</style>