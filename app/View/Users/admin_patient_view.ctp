<script type="text/javascript">
    $(document).ready(function () {
        $('#user_personal_info').bValidator();

        var row_cnt = 0;
        var cnt = $('#cnt').val();
        var str = '';
        $('#add_more_file').click(function () {
            str = '';
            str += '<div class = "form-group" id="div' + cnt + '">';
            str += '<label class = "col-lg-2 control-label" > </label>';
            str += '<div class = "col-lg-4">';
            str += '<select name = "data[User][identity_details][' + cnt + '][identity_id]" id = "identity_id" class = "form-control">';
            str += "<option value = ''> Select Identity Type </option>";
<?php foreach ($identity_types as $key => $value) { ?>
                str += "<option value = '<?= $key ?>' > <?= $value ?></option>";
<?php } ?>

            str += '</select>';
            str += '</div>';
            str += '<div class = "col-lg-3" >';
            str += '<input type = "text" name = "data[User][identity_details][' + cnt + '][identity]" id = "identity" class = "form-control" placeholder = "Identity ID" >';
            str += '</div>';
            str += '<div class = "col-lg-1" >';
            str += '<a class = "btn btn-xs btn-danger del_row" row_id = ' + cnt + ' onclick = "delete_row(' + cnt + ',' + row_cnt + ')"> <i class = "fa fa-minus"> </i></a>';
            str += '</div>';
            str += '</div>';

            $(str).appendTo("#appened_diet_tr_totable");
            cnt++;
        });
    });

    function delete_row(cnt, row_id) {

        $("#div" + cnt).remove();
    }
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
                        <?php
                        if (!empty($user['User']['avatar'])) {
                            ?>
                            <?= $this->Html->image('user_avtar/' . $user['User']['avatar'], array('class' => 'img-responsive', 'alt' => '')) ?>

                            <?php
                        } else {
                            if (!empty($user['User']['gender'])) {
                                if ($user['User']['gender'] == 1) {
                                    ?>
                                    <?= $this->Html->image('patient-male.png', array('class' => 'img-responsive', 'alt' => '')) ?>
                                    <?php
                                } else {
                                    ?>
                                    <?= $this->Html->image('patient-female.png', array('class' => 'img-responsive', 'alt' => '')) ?>
                                    <?php
                                }
                            } else {
                                ?>
                                <?= $this->Html->image('patient-male.png', array('class' => 'img-responsive', 'alt' => '')) ?>
                                <?php
                            }
                        }
                        ?>

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
                        <h1><?= count($user['Services']); ?></h1>
                        <p>Total Services</p>
                        <h1>1121</h1>
                        <p>Contacted Customers</p>
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
                    <!--                    <li class="active">
                                            <a data-toggle="tab" href="#job-history">
                                                Billing and Account Information
                                            </a>
                                        </li>-->
                    <li class="active">
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
                    <div id="personal_info" class="tab-pane active">
                        <div class="position-center">
                            <div class="prf-contacts sttng">
                                <h2>  Personal Information</h2>
                            </div>
                            <?= $this->Form->create('User', array('class' => 'form-horizontal', 'id' => 'user_personal_info', 'role' => 'form', 'enctype' => 'multipart/form-data')); ?>
                            <div class="form-group">
                                <label class="col-lg-2 control-label"> Avatar</label>
                                <div class="col-lg-6">
                                    <?= $this->Form->input('avatar_img', array('type' => 'file', 'id' => 'avatar', 'label' => false, 'class' => 'file-pos', 'onchange' => 'return imageValidate(this.value)')); ?>    
                                    <?= $this->Form->input('avatar', array('type' => 'hidden', 'id' => 'avatar', 'label' => false, 'class' => 'file-pos', "value" => $user['User']['avatar'])); ?>    
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
                                <label class="col-lg-4 control-label"></label>
                                <div class="col-lg-6">
                                    <a class="btn btn-xs btn-primary pull-right" id="add_more_file" title="Add More"><i class="fa fa-plus"></i></a>
                                </div> 
                            </div>
                            <?php
                            $i = 1;
                            if (!empty($user['User']['identity'])) {
                                $identity = json_decode($user['User']['identity']);

                                foreach ($identity as $key => $value):
                                    ?>

                                    <div class="form-group" id="div<?= $i; ?>">
                                        <label class="col-lg-2 control-label">Identity Proof ID</label>
                                        <div class="col-lg-4">
                                            <?php echo $this->Form->input('identity_id', array('name' => 'data[User][identity_details][' . $i . '][identity_id]', 'class' => 'form-control', 'type' => 'select', 'options' => $identity_types, 'selected' => $key, 'placeholder' => '', 'label' => false, 'data-bvalidator' => 'required', 'empty' => '-- Select Identity Type --')); ?>
                                        </div> 
                                        <div class="col-lg-3">
                                            <?php echo $this->Form->input('identity', array('name' => 'data[User][identity_details][' . $i . '][identity]', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Identity ID', 'value' => $value, 'label' => false, 'data-bvalidator' => 'required')); ?>
                                        </div>
                                        <div class="col-lg-1">
                                            <?php if ($i != 1) { ?>
                                                <a class="btn btn-xs btn-danger del_row" row_id="<?= $i; ?>" onclick="delete_row('<?= $i; ?>', '<?= $key ?>')">
                                                    <i class="fa fa-minus"></i>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php
                                    ++$i;
                                endforeach;
                            } else {
                                ?>

                                <div class="form-group" id="div<?= $i; ?>">
                                    <label class="col-lg-2 control-label">Identity Proof ID</label>
                                    <div class="col-lg-4">
                                        <?php echo $this->Form->input('identity_id', array('name' => 'data[User][identity_details][' . $i . '][identity_id]', 'class' => 'form-control', 'type' => 'select', 'options' => $identity_types, 'selected' => '', 'placeholder' => '', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please select identity type.', 'empty' => '-- Select Identity Type --')); ?>
                                    </div> 
                                    <div class="col-lg-3">
                                        <?php echo $this->Form->input('identity', array('name' => 'data[User][identity_details][' . $i . '][identity]', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Identity ID', 'value' => '', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please identity.')); ?>
                                    </div>
                                    <div class="col-lg-1">
                                        <?php if ($i != 1) { ?>
                                            <a class="btn btn-xs btn-danger del_row" row_id="<?= $i; ?>" onclick="delete_row('<?= $i; ?>', '<?= $key ?>')">
                                                <i class="fa fa-minus"></i>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>

                                <?php
                                ++$i;
                            }
                            ?>

                            <input type="hidden" name="cnt" id="cnt" value="<?php echo $i ?>">
                            <div id="appened_diet_tr_totable">
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
                                    <?= $this->Form->input('mobile', array('type' => 'text', 'id' => 'mobile', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'number,required', 'data-bvalidator-msg' => 'Please enter mobile number.', 'value' => $user['User']['mobile'])); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Email</label>
                                <div class="col-lg-6">
                                    <?= $this->Form->input('email', array('type' => 'email', 'id' => 'email', 'class' => 'form-control', 'placeholder' => 'Enter Email ID', 'label' => false, 'data-bvalidator' => 'required,email', 'data-bvalidator-msg' => 'Please enter valid email.', 'value' => $user['User']['email'])); ?>
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