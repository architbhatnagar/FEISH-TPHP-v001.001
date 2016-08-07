<script type="text/javascript">
    $(document).ready(function () {
        $('#personal_info').bValidator();
    });
    var options = {
        singleError: true,
        showCloseIcon: false
    };

    $('#personal_info').bValidator(options);

</script>
<script type="text/javascript">

    var myBaseUrl = '<?php echo Router::url('/', true) ?>';

    function showDietDetails(plan_id) {
        $("html,body").animate({scrollTop: 0}, 1000);
        $.ajax({
            type: "POST",
            url: myBaseUrl + "diet_plans/get_diet_plan_details",
            data: {id: plan_id},
            dataType: "html",
            success: function (data)
            {
                $("#appened_diet_view").html(data);
                $("#diet_plan_view_details").modal({backdrop: "static"});
                $('#diet_plan_view_details').modal('show');
            }
        });
    }

    function hideModal() {
        $('#diet_plan_view_details').modal('hide');
    }

    $(document).ready(function () {

        var row_cnt = 0;
        var cnt = $('#cnt').val();
        var str = '';
        $('#add_more_file').click(function () {
            str = '';
            str += '<div class = "form-group" id="div' + cnt + '">';
            str += '<label class = "col-lg-4 control-label" > </label>';
            str += '<div class = "col-lg-4">';
            str += '<select name = "data[User][identity_details][' + cnt + '][identity_id]" id = "identity_id" class = "form-control">';
            str += '<option value = ""> -- Identity Type -- </option>';
<?php foreach ($identity_types as $key => $value) { ?>
                str += "<option value = \"<?= $key ?>\" > <?= $value ?></option>";
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
    
    function imageValidate(val) {

        var file = $('#avatar').val();

        var exts = ['png','jpg','jpeg'];
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
<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-9 col-sm-9">

                            <div class="box last">

                                <div class="box-heading">Welcome, <?PHP echo Authcomponent::user('first_name').' '.Authcomponent::user('last_name'); ?></div>
                                <div class="box-body">
                                    <section id="main-content">
                                        <section class="wrapper">
                                            <div class="col-md-12">
                                                <ul class="breadcrumbs-alt">
                                                    <li>
                                                        <a href="<?= Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a>
                                                    </li>
                                                    <li>
                                                        <a class="current" href="">View / Update Profile</a>
                                                    </li>
                                                    <li class="pull-right">
                                                        <a class="" href="<?= Router::url(array('controller' => 'users', 'action' => 'change_password')) ?>">Account Setting</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-12">
                                                <section class="panel">
                                                    <div class="panel-body">
                                                        <div class="position-center">
                                                            <?php echo $this->Form->create('User', array('id' => 'personal_info', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
                                                            <div class="col-lg-9">
                                                                <div class="prf-contacts sttng">
                                                                    <h4>Personal Information</h4>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label"> Avatar</label>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $this->Form->input('avatar', array('class' => 'form-control file-pos','id'=>'avatar' ,'type' => 'file', 'placeholder' => 'Avtar', 'label' => false,'onchange' => 'return imageValidate(this.value)')); ?>
                                                                        <?php echo $this->Form->input('hidden_img', array('class' => 'form-control', 'label' => false, 'value' => $user['User']['avatar'], 'type' => 'hidden', 'id' => 'hidden_img')); ?>
                                                                        <!--<input type="file" name="avatar" id="avatar" accept="image/*" class="file-pos">
                                                                        <input type="hidden" name="hidden_img" id="hidden_img" value="<?php echo $user['User']['avatar']; ?>">-->
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Salutation</label>
                                                                    <div class="col-lg-4">
                                                                        <?php echo $this->Form->input('salutation', array('class' => 'form-control', 'type' => 'select', 'options' => $salutations, 'placeholder' => 'Salutation', 'label' => false, 'data-bvalidator' => 'required')); ?>
                                                                    </div> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">First Name</label>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $this->Form->input('first_name', array('class' => 'form-control', 'type' => 'text', 'placeholder' => 'First Name', 'label' => false, 'data-bvalidator' => 'required,alpha')); ?>
                                                                    </div>  
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Last Name</label>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $this->Form->input('last_name', array('class' => 'form-control', 'type' => 'text', 'placeholder' => 'Last Name', 'label' => false, 'data-bvalidator' => 'required,alpha')); ?>
                                                                    </div> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Date of Birth</label>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $this->Form->input('birth_date', array('class' => 'form-control', 'type' => 'text', 'placeholder' => 'DD/MM/YYYY', 'label' => false, 'id' => 'dob_date', 'data-bvalidator' => 'required')); ?>
                                                                    </div> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Gender</label>
                                                                    <div class="col-lg-8">
                                                                        <?php 
                                                                        $options = $gender; $attributes = array('legend' => FALSE, 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;','data-bvalidator' => 'required', 'value' => $user['User']['gender']);
                                                                        ?>
                                                                        <?php echo $this->Form->radio('gender', $options, $attributes); ?>
                                                                    </div> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Marital Status</label>
                                                                    <div class="col-lg-8">
                                                                        <?php
                                                                        $options = $marital_status;
                                                                        $attributes = array(
                                                                            'legend' => FALSE, 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                                                                            'data-bvalidator' => 'required', 'value' => $user['User']['marital_status']);
                                                                        ?>
                                                                        <?php echo $this->Form->radio('marital_status', $options, $attributes); ?>
                                                                    </div> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Educational Qualification</label>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $this->Form->input('qualification', array('class' => 'form-control', 'type' => 'text', 'placeholder' => 'Educational Qualification', 'label' => false, 'data-bvalidator' => 'required,alpha')); ?>
                                                                    </div> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Occupation</label>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $this->Form->input('occupation_id', array('class' => 'form-control', 'type' => 'select', 'options' => $occupations, 'placeholder' => 'Occupation', 'label' => false, 'data-bvalidator' => 'required', 'empty' => '-- Occupation --')); ?>
                                                                    </div> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Address</label>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $this->Form->input('address', array('class' => 'form-control', 'type' => 'text-area', 'placeholder' => 'Address', 'label' => false, 'data-bvalidator' => 'required')); ?>
                                                                    </div> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Ethnicity</label>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $this->Form->input('ethnicity_id', array('class' => 'form-control', 'type' => 'select', 'options' => $ethnicity, 'placeholder' => 'Occupation', 'label' => false, 'data-bvalidator' => 'required', 'empty' => '-- Ethnicity --')); ?>
                                                                    </div> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label"></label>
                                                                    <div class="col-lg-8">
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
                                                                            <label class="col-lg-4 control-label">Identity Proof ID</label>
                                                                            <div class="col-lg-4">
                                                                                <?php echo $this->Form->input('identity_id', array('name' => 'data[User][identity_details][' . $i . '][identity_id]', 'class' => 'form-control', 'type' => 'select', 'options' => $identity_types, 'selected' => $key, 'placeholder' => '', 'label' => false, 'data-bvalidator' => 'required', 'empty' => '-- Identity Type --')); ?>
                                                                            </div> 
                                                                            <div class="col-lg-3">
                                                                                <?php echo $this->Form->input('identity', array('name' => 'data[User][identity_details][' . $i . '][identity]', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Identity ID', 'value' => $value, 'label' => false, 'data-bvalidator' => 'required')); ?>
                                                                            </div>
                                                                            <div class="col-lg-1">
                                                                                <?php if($i != 1) {?>
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
                                                                        <label class="col-lg-4 control-label">Identity Proof ID</label>
                                                                        <div class="col-lg-4">
                                                                            <?php echo $this->Form->input('identity_id', array('name' => 'data[User][identity_details][' . $i . '][identity_id]', 'class' => 'form-control', 'type' => 'select', 'options' => $identity_types, 'selected' => '', 'placeholder' => '', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please select identity type.', 'empty' => '-- Identity Type --')); ?>
                                                                        </div> 
                                                                        <div class="col-lg-3">
                                                                            <?php echo $this->Form->input('identity', array('name' => 'data[User][identity_details][' . $i . '][identity]', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Identity ID', 'value' => '', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please identity.')); ?>
                                                                        </div>
                                                                        <div class="col-lg-1">
                                                                            <?php if($i != 1) {?>
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
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Blood Group</label>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $this->Form->input('blood_group', array('class' => 'form-control', 'type' => 'select', 'options' => $blood_groups, 'placeholder' => 'Occupation', 'label' => false)); ?>
                                                                    </div> 
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Height(In Inches)</label>
                                                                    <div class="col-lg-8">
                                                                        <?php if(!empty($user['UserDetail'][0]['height'])){
                                                                          $height = $user['UserDetail'][0]['height'];  
                                                                        }else {
                                                                            $height = "";
                                                                        }
                                                                        echo $this->Form->input('UserDetail.0.height', array('id' => 'height', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Height', 'label' => false,'value'=>$height,'data-bvalidator' => 'required,number')); ?>
                                                                    </div> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Weight(In Kg)</label>
                                                                    <div class="col-lg-8">
                                                                        <?php if(!empty($user['UserDetail'][0]['weight'])){
                                                                          $weight = $user['UserDetail'][0]['weight'];  
                                                                        }else {
                                                                            $weight = "";
                                                                        }
                                                                        echo $this->Form->input('UserDetail.0.weight', array('id' => 'weight', 'class' => 'form-control ', 'type' => 'text', 'placeholder' => 'Weight', 'label' => false,'value'=>$weight,'data-bvalidator' => 'required,number')); ?>
                                                                    </div> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Waist Size(In Inches)</label>
                                                                    <div class="col-lg-6">
                                                                        <?php if(!empty($user['UserDetail'][0]['waist_size'])){
                                                                          $waist_size = $user['UserDetail'][0]['waist_size'];  
                                                                        }else {
                                                                            $waist_size = "";
                                                                        }
                                                                        echo $this->Form->input('UserDetail.0.waist_size', array('id' => 'waist', 'class' => 'form-control ', 'type' => 'text', 'placeholder' => 'Waist', 'label' => false,'value'=>$waist_size,'data-bvalidator' => 'required,number')); ?>
                                                                    </div> 


                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">BMI</label>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $this->Form->input('bmi', array('id' => 'bmi', 'class' => 'form-control', 'readonly' => 'readonly', 'type' => 'text', 'placeholder' => 'BMI', 'label' => false)); ?>
                                                                    </div> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">WHtR(Waist to Height Ratio)</label>
                                                                    <div class="col-lg-6">
                                                                        <?php echo $this->Form->input('WHtR', array('id' => 'WHtR', 'class' => 'form-control', 'readonly' => 'readonly', 'type' => 'text', 'placeholder' => 'WHtR', 'label' => false)); ?>
                                                                    </div> 
                                                                </div>


                                                                <div class="prf-contacts sttng">
                                                                    <h4>Contact information</h4>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Email</label>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $this->Form->input('email', array('class' => 'form-control','disabled'=>'disabled', 'type' => 'text', 'placeholder' => 'Email ID', 'label' => false, 'data-bvalidator' => 'required,email')); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Mobile</label>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $this->Form->input('mobile', array('class' => 'form-control','disabled'=>'disabled', 'type' => 'text', 'max_lenght' => '10', 'min_length' => '10', 'placeholder' => 'Email ID', 'label' => false, 'data-bvalidator' => 'required,digit')); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="prf-contacts sttng">
                                                                    <h4> Social Information</h4>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Facebook</label>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $this->Form->input('facebook', array('class' => 'form-control', 'type' => 'text', 'placeholder' => 'Facebook Profile Page URL', 'label' => false)); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Twitter</label>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $this->Form->input('twitter', array('class' => 'form-control', 'type' => 'text', 'placeholder' => 'Twitter Profile Page URL', 'label' => false)); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-4 control-label">Google plus</label>
                                                                    <div class="col-lg-8">
                                                                        <?php echo $this->Form->input('google_plus', array('class' => 'form-control', 'type' => 'text', 'placeholder' => 'Google Plus Profile Page URL', 'label' => false)); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-lg-offset-4 col-lg-8">
                                                                        <button name="submit_info" class="btn btn-primary" type="submit">Update Information</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 profile-information">
                                                                <div class="profile-pic text-center">
                                                                    <?php
                                                                    if (!empty($user['User']['avatar'])) {
                                                                        ?>
                                                                        <?= $this->Html->image('user_avtar/' . $user['User']['avatar'], array('class' => 'img-responsive', 'alt' => '')) ?>

                                                                        <?php
                                                                    } else {
                                                                        if (Authcomponent::user('gender') == 1) {
                                                                            ?>
                                                                            <?= $this->Html->image('patient-male.png', array('class' => 'img-responsive', 'alt' => '')) ?>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <?= $this->Html->image('patient-female.png', array('class' => 'img-responsive', 'alt' => '')) ?>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
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
        $('#dob_date').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
            maxDate: "NOW",
        });
        
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