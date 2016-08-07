<script type="text/javascript">
    $(document).ready(function () {
        $('#change_password_frm').bValidator();
    });
</script>
<script type="text/javascript">

    var options = {
        singleError: true,
        showCloseIcon: false
    };

    var myBaseUrl = '<?php echo Router::url('/', true) ?>';

    $('#change_password_frm').bValidator(options);
    $(document).ready(function(){
        $("#current_password").blur(function(){
    
    var val=$(this).val();
    
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
});
    });

    function checkCurrentPassword(val) { 
       // alert(val);
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
                       // alert("Please enter correct current password.");
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
<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <?php if ($this->Session->read('Auth.User.user_type') == 1) { ?>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>
            <?php } else if($this->Session->read('Auth.User.user_type') == 2){ ?>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'doctors_dashboard')) ?>">Dashboard</a>
            <?php } else if($this->Session->read('Auth.User.user_type') == 3){?>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'assistant_dashboard')) ?>">Dashboard</a>
            <?php } ?>
            </li>
            <li>
                <a class="current" href="">Account Setting</a>
            </li>
             <li class="pull-right">
                 <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                Change Password
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <div class="row-fluid">
                        <div class="span6">
                            <div id="change_password" class="tab-pane ">
                                <div class="panel-body">
                                    <div class="position-center">
                                        <?= $this->Form->create('User', array('class' => 'form-horizontal', 'id' => 'change_password_frm', 'role' => 'form')); ?>
                                        <div class="form-group">
                                            <div class="col-lg-6">
                                                <label for="currentpassword">Current Password</label>
                                                <?= $this->Form->input('current_password', array('id'=>'current_password','type' => 'password', 'id' => 'current_password', 'class' => 'form-control', 'placeholder' => 'Current Password', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter current password.')); ?>
                                                <span id="incorrect_password" style="color:red;" hidden> Password Incorrect...</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-6">
                                                <label for="newpassword">New Password</label>
                                                <?= $this->Form->input('password', array('type' => 'password', 'id' => 'new_password', 'class' => 'form-control', 'placeholder' => 'New Password', 'label' => false, 'data-bvalidator' => 'minlength[6],required', 'data-bvalidator-msg' => 'Please enter new password.<br>The length must be at least 6 characters.')); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-6">
                                                <label for="confirmpassword">Confirm Password</label>
                                                <?= $this->Form->input('confirm_password', array('type' => 'password', 'id' => 'confirm_password', 'class' => 'form-control', 'placeholder' => 'Confirm Password', 'label' => false, 'data-bvalidator' => 'equalto[new_password],required', 'data-bvalidator-msg' => 'Please enter confirm password.')); ?>
                                            </div>
                                        </div>
                                        <?= $this->Form->input('submit', array('type' => 'button', 'id' => 'submit', 'class' => 'btn btn-info', 'label' => false)); ?>
                                        <?= $this->Form->end(); ?>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
        </section>
    </div>
</div>