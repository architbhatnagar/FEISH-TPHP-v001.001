<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-9 col-sm-9">
                            <div class="box last">
                                <div class="box-heading">Medical Histories 
                                    <div class="pull-right">
                                        <a class="btn btn-info btn-sm" id="add_new_family_history" style="display: inline-block;">Add </a>
                                        <a class="btn btn-danger btn-sm" id="cancel_add_new_family_history" hidden="" style="display: none;">Cancel</a>
                                        <a href="/users/dashboard" class="btn btn-sm btn-success popovers home"><i class="fa fa-backward"></i> &nbsp;Home</a>
                                        <a class="btn btn-sm btn-success popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
                                    </div>
                                </div>
                            </div>
                            <div id="new_family_history" hidden="">
                                <div class="box">
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?php echo $this->Form->create('MedicalHistory', array('action' => 'update_medical_history', 'name' => "add_medical_history", 'id' => "add-medical-history")); ?>
                                                        <div class="prf-contacts sttng">
                                                            <h4><span id="action"></span> Medical History</h4>
                                                            <hr>
                                                        </div>
                                                        <div class="form-group">
                                                            <?php echo $this->Form->input('id', array('id' => "table_id", 'class' => 'hidden form-control', 'div' => false,)); ?>
                                                            <div class="row">

                                                                <div class="col-md-6">
                                                                    <?php echo $this->Form->input('conditions', array('options' => $medicalConditionList, 'empty' => '-Select-', 'id' => 'conditions', 'class' => 'form-control', 'label' => 'Condition *')); ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <?php echo $this->Form->input('condition_type', array('id' => "condition_type", 'required' => '', 'placeholder' => 'Condition Type', 'class' => 'form-control', 'label' => 'Condition Type*')); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">

                                                                <div class="col-md-6">
                                                                    <?php echo $this->Form->input('current_medication', array('options' => array('0' => 'No', '1' => 'Yes'), 'empty' => '-Select-', 'id' => "current_medication", 'required' => '', 'class' => 'form-control', 'label' => 'Current Medication? ')); ?>
                                                                </div>
                                                                <div class="col-md-6" id="added_date">
                                                                    <?php echo $this->Form->input('mh_date', array('type' => 'text', 'id' => 'date', 'readonly' => 'readonly', 'class' => 'form-control', 'div' => false, 'label' => 'Date *')); ?>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <?php echo $this->Form->input('description', array('type' => 'textarea', 'placeholder' => "Description....", 'rows' => '3', 'id' => "description", 'class' => 'ckeditor form-control', 'div' => false, 'label' => 'Description')); ?>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="form-group mtxxl text-center mbn">
                                                            <?php echo $this->Form->submit(__('Save Medical History'), array('class' => 'btn btn-outlined btn-primary')); ?>
                                                        </div>
                                                        <?php echo $this->Form->end(); ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="medicalHistories index">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?php if (count($medicalHistories) > 0) { ?>
                                            <h4> Medical Histories</h4>
                                            <?php } ?>
                                        </div>
                                        <!--modal box for view-->
                                        <?php foreach ($medicalHistories as $medicalHistory): ?>
                                            <div class="modal fade in" id="medical_history_<?php echo $medicalHistory['MedicalHistory']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog" style="margin:100px auto !important;">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title">View Details</h4>
                                                        </div>
                                                        <div class="">
                                                            <div class="col-md-10">
                                                                <div class="profile-desk">
                                                                    <h4><?php echo h($medicalHistory['MedicalCondition']['name']); ?></h4>
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <td><span class="text-muted"><strong>Condition type</strong></span></td>
                                                                                <td><span class="text-muted"><strong>Current Medication</strong></span></td>
                                                                                <td><span class="text-muted"><strong>Date</strong></span></td>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td><?php echo h($medicalHistory['MedicalHistory']['condition_type']); ?></td>
                                                                                <td><?php echo ($medicalHistory['MedicalHistory']['current_medication'] == 1 ? 'Yes' : 'No'); ?></td>
                                                                                <td><?php echo h(date("d-M-Y", strtotime($medicalHistory['MedicalHistory']['mh_date']))); ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="3"><strong>Description</strong></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="3"><?php echo h($medicalHistory['MedicalHistory']['description']); ?></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <!--modal box - end-->
                                        <table class="table table-bordered">
                                            <?php if (count($medicalHistories) > 0) { ?>
                                                <tr>
                                                    <th><?php echo "Condition"; ?></th>
                                                    <th><?php echo "Condition Type"; ?></th>
                                                    <th><?php echo "Is Current Medication?"; ?></th>
                                                    <th><?php echo "Date"; ?></th>
                                                    <th><?php echo "Description"; ?></th>
                                                    <th class="actions"><?php echo __('Actions'); ?></th>
                                                </tr>
                                            <?php } ?>

                                            <?php
                                            if (count($medicalHistories) > 0) {
                                                foreach ($medicalHistories as $medicalHistory):
                                                    ?>
                                                    <tr>
                                                        <td><?php echo h($medicalHistory['MedicalCondition']['name']); ?>&nbsp;</td>
                                                        <td><?php echo h($medicalHistory['MedicalHistory']['condition_type']); ?>&nbsp;</td>
                                                        <td><?php echo ($medicalHistory['MedicalHistory']['current_medication'] == 1 ? 'Yes' : 'No'); ?>&nbsp;</td>
                                                        <td><?php echo h(date("d M Y", strtotime($medicalHistory['MedicalHistory']['mh_date']))); ?>&nbsp;</td>
                                                        <td><?php echo h($medicalHistory['MedicalHistory']['description']); ?>&nbsp;</td>
                                                        <td class="actions">
                                                            <a href="#medical_history_<?php echo $medicalHistory['MedicalHistory']['id']; ?>" data-toggle="modal" class="btn btn-warning btn-xs"><i class="fa fa-search"></i></a>
                                                            <?php //echo $this->Form->button(__('<i class="fa fa-search"></i>'), array('action' => "#medical_history_" . $medicalHistory['MedicalHistory']['id']), array('escape' => false, 'data-toggle' => "modal", 'class' => "btn btn-warning btn-xs")); ?>
                                                            <?php echo $this->Form->button(__('<i class="fa fa-edit"></i>'), array('escape' => false, 'id' => "edit_medical_hostory_" . $medicalHistory['MedicalHistory']['id'] . "", 'onclick' => "show_edit_div(" . $medicalHistory['MedicalHistory']['id'] . ")", 'data-toggle' => "modal", 'class' => "btn btn-primary btn-xs")); ?>
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
                                        </table>
                                        <?php if (count($medicalHistories) > 0) { ?>
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

        $('#date').datepicker({
            maxDate: new Date()
        });
    });

    function show_edit_div(id)
    {
        $("#new_family_history").fadeIn();
        $("#add_new_family_history").toggle();
        $("#cancel_add_new_family_history").toggle();
        $("#cancel_add_new_family_history").bind("click", function () {
            $("input[type=text], textarea,select").val("");
            $("#table_id").val("");
        });
        $.ajax({
            type: "POST",
            url: "<?php echo Router::url(array('controller' => 'medical_histories', 'action' => 'get_medical_history_byid')); ?>",
            data: {'id': id},
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data != '') {
                    $("#table_id").val(data.MedicalHistory.id);
//                    $('#conditions option')[data.MedicalHistory.condition].selected = true;
                    $("#conditions").val(data.MedicalHistory.conditions);
                    $("#condition_type").val(data.MedicalHistory.condition_type);
                    $("#current_medication").val(data.MedicalHistory.current_medication);
                    $("#date").val(data.MedicalHistory.mh_date);
                    $("#description").val(data.MedicalHistory.description);
                    $("#action").html("Edit");

                } else {
                    alert('error');
                }
            }
        });
    }

</script>

<style type="text/css">
    .check_bx_spce{
        width:10%;
    }
    .alert {
        padding: 20px;
        font-size: 24px;
    }
    .modal{
        top:9%;
        bottom: 35%;

    }
</style>