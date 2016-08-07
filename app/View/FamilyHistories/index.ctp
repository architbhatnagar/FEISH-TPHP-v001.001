<script type="text/javascript">

    $(document).ready(function () {
        $('#frm_familiy_history').bValidator();
    });
</script>
<script type="text/javascript">

    var options = {
        singleError: true,
        showCloseIcon: false
    };

    $('#frm_familiy_history').bValidator(options);

</script>
<style>
    .bvalidator_errmsg {
        margin-left: -203px;
    }
</style> 
<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-9 col-sm-9">
                            <div class="box last">
                                <div class="box-heading">Family Histories 
                                    <div class="pull-right">
                                        <a class="btn btn-info btn-sm" id="add_new_family_history">Add </a>
                                        <a style="display: none;" class="btn btn-danger btn-sm" id="cancel_add_new_family_history" hidden="">Cancel</a>
                                        <a href="/users/dashboard" class="btn btn-sm btn-success popovers home"><i class="fa fa-backward"></i> &nbsp;Home</a>
                                        <a class="btn btn-sm btn-success popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
                                    </div>
                                </div>
                            </div>

                            <div id="new_family_history" hidden="">
                                <div class="box">
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tbody><tr>
                                                    <td>
                                                        <?= $this->Form->create('FamilyHistory', array('class' => '', 'id' => 'frm_familiy_history', 'role' => 'form', 'type' => 'file')); ?>
                                                        <div class="prf-contacts sttng">
                                                            <h4><span id="action">Add</span> Family History</h4>
                                                            <hr>
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="id" id="table_id" value="" type="hidden">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="control-label mll">Member Name <span class="required">*</span></label>
                                                                    <?= $this->Form->input('member_name', array('type' => 'text', 'id' => 'member_name', 'class' => 'form-control', 'placeholder' => 'Enter member name', 'label' => false, 'data-bvalidator' => 'required,minlength[3]', 'data-bvalidator-msg' => 'Please enter member name.')); ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="control-label mll">Relationship <span class="required">*</span></label>
                                                                    <?= $this->Form->input('relationship_id', array('empty' => 'Select relationship', 'options' => $relationship, 'id' => 'relationship', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please select relationship.')); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="control-label mll">Age <span class="required">*</span></label>
                                                                    <?= $this->Form->input('age', array('type' => 'text', 'id' => 'age', 'class' => 'form-control', 'placeholder' => 'Age', 'label' => false, 'data-bvalidator' => 'required,digit,minlength[2],maxlength[2]', 'data-bvalidator-msg' => 'Please enter age.')); ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="control-label mll">Disease Name <span class="required">*</span></label>
                                                                    <?= $this->Form->input('disease_id', array('type' => 'text', 'id' => 'disease_id', 'class' => 'form-control', 'placeholder' => 'Disease name', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter disease name.')); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="control-label mll">Current Status <span class="required">*</span></label>
                                                                    <?= $this->Form->input('current_status', array('empty' => 'Select status', 'options' => array('Healthy' => 'Healthy', 'Under Treatment' => 'Under Treatment', 'Died' => 'Died'), 'id' => 'current_status', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please select current status.')); ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="control-label mll">Detected In Year </label>
                                                                    <?= $this->Form->input('year', array('type' => 'text', 'id' => 'year', 'class' => 'form-control', 'placeholder' => 'Detected year', 'label' => false, 'data-bvalidator' => 'digit,minlength[4],maxlength[4]', 'data-bvalidator-msg' => 'Please enter year.')); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label class="control-label mll">Description</label>
                                                                    <?= $this->Form->input('description', array('type' => 'textarea', 'id' => 'description', 'class' => 'form-control', 'placeholder' => 'Description', 'label' => false)); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mtxxl text-center mbn">
                                                            <?= $this->Form->input('Save Family History', array('type' => 'submit', 'id' => 'save_family_history', 'class' => 'btn btn-outlined btn-primary', 'placeholder' => 'Description', 'label' => false, 'value' => 'Save Family History')); ?>
                                                        </div>

                                                        <?= $this->Form->end(); ?>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php if (count($users_family_history) > 0) { ?>
                                            <h4>Family Histories</h4>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="modal fade" id="family_history_1_view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog" style="margin-top: 120px;">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">View Details</h4>
                                            </div>
                                            <div class="">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td> <strong>Name : </strong> <span id="view_name"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td> <strong>Relationship : </strong> <span id="view_relation"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td> <strong>Current Age : </strong> <span id="view_age"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td> <strong>Disease Name : </strong> <span id="view_disease"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td> <strong>Detected in Year : </strong> <span id="view_disease_yr"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td> <strong>Current Status : </strong> <span id="view_status"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td> <strong>Description : </strong>  <span id="view_description"></span></td>
                                                        </tr>
                                                    </tbody></table>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-success" onclick="hideModal()">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <?php if (count($users_family_history) > 0) { ?>
                                            <tr>
                                                <th>Name</th>
                                                <th>Relationship</th>
                                                <th>Current Age</th>
                                                <th>Disease Name</th>
                                                <th>Current status</th>
                                                <th>Actions</th>
                                            </tr>
                                        <?php } ?>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($users_family_history) > 0) {
                                            foreach ($users_family_history as $family_history) :
                                                ?>
                                                <tr>
                                                    <td><?= $family_history['FamilyHistory']['member_name']; ?></td>
                                                    <td><?= $family_history['Relationship']['name']; ?></td>
                                                    <td><?= $family_history['FamilyHistory']['age']; ?></td>
                                                    <td><?= $family_history['FamilyHistory']['disease_id']; ?></td>
                                                    <td>
                                                        <?= $family_history['FamilyHistory']['current_status']; ?>                              
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="viewHistory('<?= $family_history['FamilyHistory']['id']; ?>');" class="btn btn-warning btn-xs"><i class="fa fa-search"></i></a>
                                                        <!--<a href="#family_history_1" class="btn btn-warning btn-xs"><i class="fa fa-search"></i></a>-->
                                                        <a id="edit_family_hostory_1" onclick="show_edit_div('<?= $family_history['FamilyHistory']['id']; ?>');" href="javascript:void(0);" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            endforeach;
                                        } else {
                                            ?>
                                        <div class="alert alert-danger">
                                            <i class="fa fa-exclamation-circle mrl"></i>No records found
                                        </div>
                                    <?php } ?>
                                    </tbody>
                                </table>

                                <?php if (count($users_family_history) > 0) { ?>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6" style="margin-top: 1em;">
                                                <p>
                                                    <?php
                                                    echo $this->Paginator->counter(array(
                                                        'format' => __('Showing {:current} to {:end} of {:count} entries')
                                                    ));
                                                    ?>
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="pagination  pull-right">
                                                    <?php
                                                    echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                                                    echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
                                                    echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                                                    ?>                                                                          
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>
                        <?= $this->element('front_layout_rightbar'); ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#cancel_add_new_family_history").hide();
        $("#add_new_family_history").click(function () {
            $("#new_family_history").fadeIn();
            $("#add_new_family_history").toggle();
            $("#cancel_add_new_family_history").toggle();
        });
        $("#cancel_add_new_family_history").click(function () {
            $("#new_family_history").fadeOut();
            $("#add_new_family_history").toggle();
            $("#cancel_add_new_family_history").toggle();
        });
    });
</script>
<script>

    var myBaseUrl = '<?php echo Router::url('/', true) ?>';

    function viewHistory(id) {
        $("html,body").animate({scrollTop: 0}, 1000);
        $.ajax({
            type: "POST",
            url: myBaseUrl + "family_histories/get_family_history_byid",
            data: {id: id},
            dataType: "json",
            success: function (data)
            {
                if (data != '')
                {
                    $("#view_name").html(data.FamilyHistory.member_name);
                    $("#view_relation").html(data.Relationship.name);
                    $("#view_age").html(data.FamilyHistory.age);
                    $("#view_disease").html(data.FamilyHistory.disease_id);
                    $("#view_disease_yr").html(data.FamilyHistory.year);
                    $("#view_status").html(data.FamilyHistory.current_status);
                    $("#view_description").html(data.FamilyHistory.description);
                    $("#family_history_1_view").modal({backdrop: "static"});
                    $('#family_history_1_view').modal('show');
                }
            }
        });
    }

    function hideModal() {
        $('#family_history_1_view').modal('hide');
    }

    function show_edit_div(id)
    {

        $("#new_family_history").fadeIn();
        $("#add_new_family_history").toggle();
        $("#cancel_add_new_family_history").toggle();
        $("#cancel_add_new_family_history").bind("click", function () {
            $("input[type=text], textarea,select").val("");
            $("#table_id").val("");
        });
        var str = String(id);
        var history_id = str.replace("edit_family_hostory_", "");
        $.ajax({
            type: "POST",
            url: myBaseUrl + "family_histories/get_family_history_byid",
            data: {id: id},
            dataType: "json",
            success: function (data)
            {
//                alert(data.FamilyHistory.member_name);
                $("div.bvalidator_errmsg").remove();
                if (data != '')
                {
                    $("#table_id").val(data.FamilyHistory.id);
                    $("#member_name").val(data.FamilyHistory.member_name);
                    $("#relationship").val(data.FamilyHistory.relationship_id);
                    $("#age").val(data.FamilyHistory.age);
                    $("#disease_id").val(data.FamilyHistory.disease_id);
                    $("#current_status").val(data.FamilyHistory.current_status);
                    $("#year").val(data.FamilyHistory.year);
                    $("#description").val(data.FamilyHistory.description);
                    $("#action").html("Edit");

                }
            }
        });
    }
</script>
<style type="text/css">
    .check_bx_spce{
        width:10%;
    }
</style>
<style>
    .modal{
        top:9%;
        bottom: 5%;
    }
</style>