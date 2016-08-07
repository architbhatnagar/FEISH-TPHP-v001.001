<script type="text/javascript">
    $(document).ready(function () {
        $('#personal_info').bValidator();
    });
</script>
<script type="text/javascript">

    var options = {
        singleError: true,
        showCloseIcon: false
    };

    var myBaseUrl = '<?php echo Router::url('/', true) ?>';

    $('#personal_info').bValidator(options);
    
//    $(document).ready(function () {
//        alert("in");
//        $("#current_password").blur(function () {
//            alert("in");
//            var val = $(this).val();
//            if (val != "") {
//                $.ajax({
//                    type: 'POST',
//                    url: myBaseUrl + "users/check_password",
//                    async: true,
//                    data: {'password': val},
//                    success: function (data) {
//                        if (data == 1) {
//                            $("#incorrect_password").hide();
//                            return true;
//
//                        } else {
//                            // alert("Please enter correct current password.");
//                            $("#incorrect_password").show();
//                            $('#current_password').val('');
//                            $('#current_password').focus();
//                            return false;
//                        }
//
//                    }
//                });
//            }
//        });
//    });

    function checkCurrentPassword(val) {
         
        if (val != "") {
            $.ajax({
                type: 'POST',
                url: myBaseUrl + "users/check_password",
                async: true,
                data: {'password': val},
                success: function (data) {
                    if (data == 1) {
                        $("#incorrect_password").hide();
                        return true;

                    } else {
                        $("#incorrect_password").show();
                        $('#current_password').val('');
                        $('#current_password').focus();
                        return false;
                    }

                }
            });
        }

    }

</script>
<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-9 col-sm-9">

                            <div class="box last">

                                <div class="box-heading">Welcome, <?PHP echo Authcomponent::user('first_name'); ?></div>
                                <div class="box-body">
                                    <section id="main-content">
                                        <section class="wrapper">
                                            <div class="col-md-12">
                                                <ul class="breadcrumbs-alt">
                                                    <li>
                                                        <a href="<?= Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a>
                                                    </li>
                                                    <li>
                                                        <a class="current" href="">Account Setting</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-12">
                                                <section class="panel">
                                                    <div class="panel-body">
                                                        <div class="position-center">
                                                            <?php echo $this->Form->create('User', array('id' => 'personal_info', 'class' => 'form-horizontal','role' => 'form')); ?>
                                                            <div class="col-lg-9">

                                                                <div class="prf-contacts sttng">
                                                                    <h4> Password Information</h4>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Current Password</label>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $this->Form->input('current_password', array('class' => 'form-control', 'id' => 'current_password','onblur'=>'checkCurrentPassword(this.value)', 'type' => 'password', 'placeholder' => 'Current Password', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter current password.','autocomplete'=>"false")); ?>
                                                                        <span id="incorrect_password" style="color:red;" hidden> Password Incorrect...</span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">New Password</label>
                                                                    <div class="col-lg-8">
                                                                        <?= $this->Form->input('new_password', array('type' => 'password', 'id' => 'new_password', 'class' => 'form-control', 'placeholder' => 'New Password', 'label' => false, 'data-bvalidator' => 'minlength[6],required', 'data-bvalidator-msg' => 'Please enter new password.<br>The length must be at least 6 characters.')); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Confirm Password</label>
                                                                    <div class="col-lg-8">
                                                                        <?= $this->Form->input('confirm_password', array('type' => 'password', 'id' => 'confirm_password', 'class' => 'form-control', 'placeholder' => 'Confirm Password', 'label' => false, 'data-bvalidator' => 'equalto[new_password],required', 'data-bvalidator-msg' => 'Please enter confirm password.')); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-lg-offset-4 col-lg-8">
                                                                        <button name="submit_info" class="btn btn-primary" type="submit">Update Information</button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </section>
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
<style type="text/css">
    .profile-information .profile-pic img {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        border: 10px solid #f1f2f7;
        margin-top: 20px;
    }
    .prf-contacts.sttng h4 {
        color: #062045;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        var height = parseFloat($("#height").val());
        var converted_height = parseFloat(height * 0.0254);
        var weight = parseFloat($("#weight").val());
        var waist = parseFloat($("#waist").val());
        if (isNaN(height) == false && isNaN(weight) == false) {
            var bmi = weight / (converted_height * converted_height);
            $("#bmi").val(Math.round(parseFloat(bmi), 2) + '%');
        }
        if (isNaN(height) == false && isNaN(waist) == false) {
            var WHtR = (waist / height) * 100;
            $("#WHtR").val(Math.round(parseFloat(WHtR), 2) + '%');
        }
        $("#weight").blur(function () {
            var height = parseFloat($("#height").val());
            var converted_height = parseFloat(height * 0.0254);
            var weight = parseFloat($("#weight").val());
            var waist = parseFloat($("#waist").val());
            if (isNaN(height) == false && isNaN(weight) == false) {
                var bmi = weight / (converted_height * converted_height);
                $("#bmi").val(Math.round(parseFloat(bmi), 2) + '%');
            }
            if (isNaN(height) == false && isNaN(waist) == false) {
                var WHtR = (waist / height) * 100;
                $("#WHtR").val(Math.round(parseFloat(WHtR), 2) + '%');
            }

        });
        $("#height").blur(function () {
            var height = parseFloat($("#height").val());
            var converted_height = parseFloat(height * 0.0254);
            var weight = parseFloat($("#weight").val());
            var waist = parseFloat($("#waist").val());
            //alert(isNaN(weight));
            if (isNaN(height) == false && isNaN(weight) == false) {
                var bmi = weight / (converted_height * converted_height);
                $("#bmi").val(Math.round(parseFloat(bmi), 2) + '%');
            }
            if (isNaN(height) == false && isNaN(waist) == false) {
                var WHtR = (waist / height) * 100;
                $("#WHtR").val(Math.round(parseFloat(WHtR), 2) + '%');
            }

        });
        $("#waist").blur(function () {
            var height = parseFloat($("#height").val());
            var converted_height = parseFloat(height * 0.0254);
            var weight = parseFloat($("#weight").val());
            var waist = parseFloat($("#waist").val());
            if (isNaN(height) == false && isNaN(weight) == false) {
                var bmi = weight / (converted_height * converted_height);
                $("#bmi").val(Math.round(parseFloat(bmi), 2) + '%');
            }
            if (isNaN(height) == false && isNaN(waist) == false) {
                var WHtR = (waist / height) * 100;
                $("#WHtR").val(Math.round(parseFloat(WHtR), 2) + '%');
            }
        });
    });

</script>