<script type="text/javascript">
    $(document).ready(function () {
        $('#user_personal_info').bValidator();
    });
</script>
<script type="text/javascript">

    var options = {
        singleError: true,
        showCloseIcon: false
    };

    $('#user_personal_info').bValidator(options);

    function imageValidate(val) {

        var file = $('#avatar').val();

        var exts = ['png', 'jpg', 'jpeg'];
        // first check if file field has any value
        if (file) {
            var get_ext = file.split('.');
            // reverse name to check extension
            get_ext = get_ext.reverse();
            // check file type is valid as given in 'exts' array
            if ($.inArray(get_ext[0].toLowerCase(), exts) > -1) {
                return true;
            } else {
                alert('Invalid file!,Please upload only png,jpg,jpeg.');
                $('#avatar').val('');
                return false;
            }
        }
    }

</script>
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <div class="panel-body profile-information">
                <div class="col-md-3">
                    <div class="profile-pic text-center">
                        <?php if (!empty($this->request->data['User']['avatar'])): ?>
                            <?= $this->Html->image('user_avtar/' . $this->request->data['User']['avatar'], array('alt' => '')); ?>
                        <?php else: ?>
                            <?= $this->Html->image('doctor.png', array('alt' => '')); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-desk">
                        <h3><?= ucwords($salutations[$user['User']['salutation']] . ". " . $user['User']['first_name'] . " " . $user['User']['last_name']) ?></h3>
                        <span class="text-muted"><strong>Email:</strong>&nbsp;<?= $user['User']['email'] ?></span><br>
                        <span class="text-muted"><strong>Registered On:</strong>&nbsp;<?= date('d M y', strtotime($user['User']['created'])); ?></span><br>
                        <span class="text-muted"><strong>Mobile:</strong>&nbsp;<?= $user['User']['mobile'] ?></span>
                    </div>
                </div>
                <div class="col-md-3">

                    <div class="profile-statistics">
                        <h1></h1>
                        <p></p>
                        <h1></h1>
                        <p></p>
                        <ul>
                            <li>
                                <a href="<?= $user['User']['facebook']; ?>" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?= $user['User']['twitter']; ?>" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?= $user['User']['google_plus']; ?>" target="_blank">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading tab-bg-dark-navy-blue">
                <ul class="nav nav-tabs nav-justified ">
                    <li class="active">
                        <a data-toggle="tab" href="#job-history">
                            Billing and Account Information
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#personal_info">
                            Personal Information
                        </a>
                    </li>
                    <!--                    <li>
                                            <a data-toggle="tab" href="#change_password">
                                                Change Password
                                            </a>
                                        </li>-->
                </ul>
            </header>
            <div class="panel-body">
                <div class="tab-content tasi-tab">
                    <div id="job-history" class="tab-pane active">
                        <div class="row">              
                            <div class="col-lg-12">
                                <section class="panel">
                                    <header class="panel-heading">
                                        Membership Plan Details
                                    </header>
                                    <div class="panel-body">
                                        <?php if (!empty($user['DoctorPlanDetail'])) { ?>
                                            <div class="position-right">
                                                <form role="form" class="form-horizontal">
                                                    <div class="form-group">
                                                        <span class="col-sm-3  col-lg-3">Package Name</span>
                                                        <div class="col-lg-1 col-sm-3">
                                                            <span class="label label-warning label-mini"><?= $user['DoctorPlanDetail'][0]['name']; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <span class="col-lg-3 col-sm-3">Price</span>
                                                        <div class="col-lg-1 col-sm-3">
                                                            <strong>₹&nbsp;<?= $user['DoctorPlanDetail'][0]['price']; ?></strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <span class="col-lg-3 col-sm-3">Validity</span>
                                                        <div class="col-lg-1">
                                                            <strong><?= $user['DoctorPlanDetail'][0]['validity']; ?>&nbsp;<span>months</span></strong>
                                                        </div>
                                                    </div>    
                                                    <div class="form-group">
                                                        <span class="col-lg-3 col-sm-3 " for="inputPassword1">Start Date</span>
                                                        <div class="col-lg-6">
                                                            <strong><?= date('d M y', strtotime($user['DoctorPlanDetail'][0]['start_date'])); ?></strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <span class="col-lg-3 col-sm-3" for="inputPassword1">End Date</span>
                                                        <div class="col-lg-6">
                                                            <strong><?= date('d M y', strtotime($user['DoctorPlanDetail'][0]['end_date'])); ?></strong>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php } else { ?>
                                            <h3>No Record Found.</h3>
                                        <?php } ?>
                                    </div>
                                </section>
                            </div>   
                            <div class="col-lg-12">
                                <section class="panel">
                                    <header class="panel-heading">
                                        Transaction History
                                    </header>
                                    <div class="panel-body">
                                        <table class="table  table-hover general-table">
                                            <thead>
                                                <?php if (count($user['DoctorPlanDetail']) > 0) { ?>
                                                    <tr>
                                                        <th>Transaction Date</th>
                                                        <th>Plan Name</th>
                                                        <th>Transaction Mode</th>
                                                        <th>Transaction Amount</th>
                                                        <th>Invoice Number</th>
                                                    </tr>
                                                <?php } ?>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (count($user['DoctorPlanDetail']) > 0) {
                                                    foreach ($user['DoctorPlanDetail'] as $value) :
                                                        ?>
                                                        <tr>
                                                            <td><a href="basic_table.html#"><?= date('d M y', strtotime($value['created'])); ?></a></td>
                                                            <td class="hidden-phone"><?= $value['name']; ?></td>
                                                            <td><?= $value['mode']; ?></td>
                                                            <td><span class="label label-primary label-mini"><?= $value['price']; ?></span></td>
                                                            <td><span><?= $value['mihpayid']; ?></span></td>
                                                        </tr>
                                                        <?php
                                                    endforeach;
                                                } else {
                                                    ?>
                                                <h3>No Record Found.</h3>
                                            <?php } ?>     

                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div id="personal_info" class="tab-pane ">
                        <div class="position-center">
                            <div class="prf-contacts sttng">
                                <h2>  Personal Information</h2>
                            </div>
                            <?= $this->Form->create('User', array('class' => 'form-horizontal', 'id' => 'user_personal_info', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>
                            <div class="form-group">
                                <label class="col-lg-2 control-label"> Avatar</label>
                                <div class="col-lg-6">
                                    <?= $this->Form->input('avatar_img', array('type' => 'file', 'id' => 'avatar', 'label' => false, 'class' => 'file-pos', 'onchange' => 'return imageValidate(this.value)')); ?>    
                                    <?= $this->Form->input('avatar', array('type' => 'hidden', 'id' => 'avatar', 'label' => false, 'class' => 'file-pos')); ?>    
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Salutation</label>
                                <div class="col-lg-2">
                                    <?= $this->Form->input('salutation', array('options' => array('1' => 'Mr.', '2' => 'Mrs.', '3' => 'Miss', '4' => 'Dr.'), 'id' => 'salutation', 'class' => 'form-control', 'label' => false, 'value' => $user['User']['salutation'], 'selected' => $user['User']['salutation'])); ?>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">First Name</label>
                                <div class="col-lg-6">
                                    <?= $this->Form->input('first_name', array('type' => 'text', 'id' => 'first_name', 'class' => 'form-control', 'placeholder' => 'Enter First name', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter first name.', 'value' => $user['User']['first_name'])); ?>
                                </div>  
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Last Name</label>
                                <div class="col-lg-6">
                                    <?= $this->Form->input('last_name', array('type' => 'text', 'id' => 'last_name', 'class' => 'form-control', 'placeholder' => 'Enter Last name', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter last name.', 'value' => $user['User']['last_name'])); ?>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Date of Birth</label>
                                <div class="col-lg-6">
                                    <?= $this->Form->input('birth_date', array('class' => 'form-control', 'type' => 'text', 'placeholder' => 'DD/MM/YYYY', 'label' => false, 'id' => 'dob_date', 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter last name.', 'value' => date('d M Y', strtotime($user['User']['birth_date'])))); ?>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Qualification</label>
                                <div class="col-lg-6">
                                    <?= $this->Form->input('qualification', array('type' => 'text', 'id' => 'qualification', 'class' => 'form-control', 'placeholder' => 'Enter Qualification', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter Qualification.', 'value' => $user['User']['qualification'])); ?>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2   control-label">Identity Proof ID</label>
                                <div class="col-lg-4">
                                    <?= $this->Form->input('identity_type', array('options' => array('1' => 'Adhaar Card', '2' => 'Passport', '3' => 'Pancard', '4' => 'Driving License'), 'id' => 'identity_type', 'class' => 'form-control', 'label' => false, 'value' => $user['User']['identity_type'], 'selected' => $user['User']['identity_type'])); ?>
                                </div> 
                                <div class="col-lg-4">
                                    <?= $this->Form->input('identity_id', array('type' => 'text', 'id' => 'id_value', 'class' => 'form-control', 'placeholder' => 'Identity ID', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter identity id', 'value' => $user['User']['identity_id'])); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Consultation Time ( In Minutes)</label>
                                <div class="col-lg-6">
                                    <?= $this->Form->input('consultation_time', array('type' => 'text', 'id' => 'consultation_time', 'class' => 'form-control', 'placeholder' => 'Enter Consultation Time', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter last name.', 'value' => $user['User']['consultation_time'])); ?>
                                </div> 
                            </div>

                            <div class="prf-contacts sttng">
                                <h2> social networks</h2>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Facebook</label>
                                <div class="col-lg-6">
                                    <?= $this->Form->input('facebook', array('type' => 'url', 'id' => 'fb-name', 'class' => 'form-control', 'label' => false, 'value' => $user['User']['facebook'], 'data-bvalidator' => 'url', 'data-bvalidator-msg' => 'Please enter valid facebook url')); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Twitter</label>
                                <div class="col-lg-6">
                                    <?= $this->Form->input('twitter', array('type' => 'url', 'id' => 'twitter', 'class' => 'form-control', 'label' => false, 'value' => $user['User']['twitter'], 'data-bvalidator' => 'url', 'data-bvalidator-msg' => 'Please enter valid twitter url')); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Google plus</label>
                                <div class="col-lg-6">
                                    <?= $this->Form->input('google_plus', array('type' => 'url', 'id' => 'g-plus', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'value' => $user['User']['google_plus'], 'data-bvalidator' => 'url', 'data-bvalidator-msg' => 'Please enter valid google plus url')); ?>
                                </div>
                            </div>

                            <div class="prf-contacts sttng">
                                <h2>Contact</h2>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Mobile</label>
                                <div class="col-lg-6">
                                    <?= $this->Form->input('mobile', array('type' => 'text', 'id' => 'mobile', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'number,required', 'data-bvalidator-msg' => 'Please enter mobile number.', 'value' => $user['User']['mobile'],'readonly' => true)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-6">
                                    <?= $this->Form->input('email', array('type' => 'email', 'id' => 'email', 'class' => 'form-control', 'placeholder' => 'Enter Email ID', 'label' => false, 'data-bvalidator' => 'required,email', 'data-bvalidator-msg' => 'Please enter valid email.', 'value' => $user['User']['email'], 'readonly' => true)); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <?= $this->Form->input('save', array('type' => 'button', 'id' => 'submit_info', 'class' => 'btn btn-primary', 'label' => false, 'value' => 'Save')); ?>
                                    <!--<button class="btn btn-default" type="button">Cancel</button>-->
                                </div>
                            </div>

                            <?= $this->Form->end(); ?>
                        </div>

                    </div>
                    <div id="change_password" class="tab-pane ">
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" method="post" name="change_password" id="change_password" action="">
                                    <div class="form-group">
                                        <label for="currentpassword">Current Password</label>
                                        <input placeholder="Current Password" name="current_password" id="current_password" class="form-control" type="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="newpassword">New Password</label>
                                        <input placeholder="New Password" name="new_password" id="new_password" class="form-control" type="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmpassword">Confirm Password</label>
                                        <input placeholder="Confirm Password" name="confirm_password" id="confirm_password" class="form-control" type="password">
                                    </div>
                                    <button class="btn btn-info" name="submit" type="submit">Submit</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<style>
    .profile-information .profile-desk {
        border: none;
    }
    .ui-datepicker-month, .ui-datepicker-year, .ui-datepicker-month option, .ui-datepicker-year option {
        color: black !important;
    }
</style>

<script>
        $(document).ready(function () {
            $('#dob_date').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'dd M yy',
                yearRange: "-100:+0",
                maxDate: "NOW",
            });
        });
</script>