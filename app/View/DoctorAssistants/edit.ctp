<script type="text/javascript">
    $(document).ready(function () {
        $('#add_assistants_form').bValidator();
    });
</script>

<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a class="active-trail active" href="<?= Router::url(array('controller' => 'users', 'action' => 'doctors_dashboard')) ?>">Dashboard</a>
            </li>
            <li>
                <a class="active-trail active" href="<?= Router::url(array('controller' => 'doctor_assistants', 'action' => 'index', 3)) ?>">Assistants</a>
            </li>
            <li>
                <a class="current" href="javascript:void(0);">Edit  Assistant</a>
            </li>
            <li class="pull-right">
                <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                Edit Assistant
            </header>
            <div class="panel-body">
                <div class="form">
                    <div class="position-center">
                        <?php echo $this->Form->create('User', array('id' => 'add_assistants_form', 'role' => 'form', 'class' => 'cmxform form-horizontal')); ?>
                        <div class="form-group">
                            <label for="service_id" class="control-label col-lg-4">Service Name (required)</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('service_id', array('options' => $services, 'selected' => $services_ids, 'id' => 'service_id', 'class' => 'populate service_id', 'label' => false, 'multiple' => true, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please select at leat one service.')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="service_id" class="control-label col-lg-4">Salutation</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('salutation', array('options' => array('1' => 'Mr.', '2' => 'Mrs.', '3' => 'Miss', '4' => 'Dr.'), 'id' => 'salutation', 'class' => 'form-control', 'label' => false, 'value' => $users['User']['salutation'], 'selected' => $users['User']['salutation'])); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">First Name</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('first_name', array('type' => 'text', 'id' => 'first_name', 'class' => 'form-control', 'placeholder' => 'Enter First name', 'label' => false, 'value' => $users['User']['first_name'], 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter first name.')); ?>
                            </div>  
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Last Name</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('last_name', array('type' => 'text', 'id' => 'last_name', 'class' => 'form-control', 'placeholder' => 'Enter Last name', 'label' => false, 'value' => $users['User']['last_name'], 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter last name.')); ?>
                            </div> 
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Email ID </label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('email', array('type' => 'email', 'id' => 'email_id', 'class' => 'form-control', 'placeholder' => 'Enter Email ID', 'label' => false, 'data-bvalidator' => 'required,email', 'data-bvalidator-msg' => 'Please enter valid email.','readonly'=>true)); ?>
                                <!--<span id="email_invalid" style="color:red;" hidden> Sorry....Email Already Registered.</span>-->
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Mobile Number </label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('mobile', array('type' => 'text', 'id' => 'mobile', 'class' => 'form-control', 'placeholder' => 'Enter 10 digit mobile number', 'label' => false, 'data-bvalidator' => 'number,minlength[10],maxlength[12],required', 'data-bvalidator-msg' => 'Please enter mobile number.','readonly'=>true)); ?>
                                <!--<span id="mobile_invalid" style="color:red;" hidden> Sorry....Mobile Number Already Registered.</span>-->
                                <?= $this->Form->input('user_type', array('type' => 'hidden', 'id' => 'user_type', 'class' => 'form-control', 'value' => '3', 'label' => false)); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-4 col-lg-6">
                                <?= $this->Form->input('Edit Assistant', array('type' => 'button', 'id' => 'add_assistants', 'class' => 'btn btn-primary', 'placeholder' => 'Add Assistant', 'value' => "Add Assistant", 'label' => false)); ?>
                            </div>
                        </div>
                        <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#add_assistants_form").bValidator();
        $("#service_id").select2({
            allowClear: true,
            maximumSelectionSize: 1,
            placeholder: "Click here and start typing to select service."
        });
//        $("#email_id").blur(function () {
//            var email_id = $("#email_id").val();
//            if (email_id != "")
//            {
//                $.ajax({
//                    dataType: "html",
//                    type: "POST",
//                    url: "<?php echo Router::url(array('controller' => 'users', 'action' => 'check_mail_id')); ?>",
//                    data: {'email_id': email_id},
//                    success: function (data) {
//                        if (data == 0) {
//                            $("#email_invalid").hide();
//                        } else {
//                            $("#email_id").val('');
//                            $("#email_invalid").show();
//                        }
//                        //                        $("#div1").html(data);
//                        console.log(data);
//                    }
//                });
//            }
//        });
//        $("#mobile").blur(function () {
//            var mobile = $("#mobile").val();
//            if (mobile != "")
//            {
//                $.ajax({
//                    dataType: "html",
//                    type: "POST",
//                    url: "<?php echo Router::url(array('controller' => 'users', 'action' => 'check_mobile')); ?>",
//                    data: {'mobile': mobile},
//                    success: function (data) {
//                        if (data == 0) {
//                            $("#mobile_invalid").hide();
//                        } else {
//                            $("#mobile").val('');
//                            $("#mobile_invalid").show();
//                        }
//                        //                        $("#div1").html(data);
//                        console.log(data);
//                    }
//                });
//            }
//        });

    });

    function radio_change(value) {
        if (value == 2) {
            $("#doctor_div").show();
        } else {
            $("#doctor_div").hide();
        }
    }
</script>
<style type="text/css">
    .service_id{
        width:100% !important;
    }
</style>
