<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-9 col-sm-9">
                            <div class="box last">
                                <div class="box-heading">Vital Sign 
                                    <div class="pull-right">
                                        <?php echo $this->Form->button(__('Add'), array('escape' => false, 'id' => "add_new_vital_sign", 'class' => "btn btn-info")); ?>
                                        <?php echo $this->Form->button(__('Cancel'), array('escape' => false, 'id' => 'cancel_add_new_vital_sign', 'class' => "hiddden btn btn-danger")); ?>
                                        <a href="/users/dashboard" class="btn btn-sm btn-success popovers home"><i class="fa fa-backward"></i> &nbsp;Home</a>
                                        <a class="btn btn-sm btn-success popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
                                    </div>
                                </div>
                            </div>
                            <div id="new_vital_sign" hidden="">
                                <div class="box">
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?php echo @$this->Form->create('VitalSign', array('action' => 'update_vital_sign', 'id' => 'add_vital_sign_form')); ?>
                                                        <div class="prf-contacts sttng">
                                                            <h4><span id="action">Add </span>Vital Sign</h4>
                                                            <hr>
                                                        </div>
                                                        <div class="form-group">
                                                            <?php echo $this->Form->input('id', array('id' => "table_id", 'class' => 'hidden form-control', 'div' => false,)); ?>
                                                            <div class="row">

                                                                <div class="col-md-3">
                                                                    <?php echo $this->Form->input('vital_sign_list_id', array('options' => $vitalSignsList, 'empty' => '-Select-', 'id' => 'vital_sign', 'onchange' => 'change_unit(this.value);', 'class' => 'form-control', 'label' => false)); ?>
                                                                </div>
                                                                <div class="col-md-3" id="replace_div">
                                                                    <?php echo $this->Form->input('vital_unit_id', array('options' => $vitalUnit, 'empty' => '-Select-', 'id' => 'unit', 'class' => 'form-control', 'label' => false)); ?>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <?php echo $this->Form->input('max_observation', array('type' => 'text', 'placeholder' => "Max Observation", 'id' => 'max_observation', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <?php echo $this->Form->input('min_observation', array('type' => 'text', 'placeholder' => "Min Observation", 'id' => 'min_observation', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <?php echo $this->Form->input('observation', array('type' => 'text', 'placeholder' => "Observation", 'id' => 'observation', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <?php echo $this->Form->input('remark', array('type' => 'textarea', 'placeholder' => "remark...", 'rows' => '3', 'id' => 'remark', 'class' => 'ckeditor form-control', 'div' => false, 'label' => false)); ?>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-outlined btn-primary')); ?>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <?php echo $this->Form->end(); ?>

                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="vitalSigns index">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <?php if(count($vitalSigns) > 0) { ?>
                                            <h4>Vital Signs</h4>
                                            <?php } ?>
                                        </div>
                                        <!--modal box for view-->
                                        <?php foreach ($vitalSigns as $vitalSign): ?>
                                            <div class="modal fade in" id="patientsdetails_<?php echo $vitalSign['VitalSign']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog" style="margin:100px auto !important;">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title">View Details</h4>
                                                        </div>
                                                        <div class="">
                                                            <div class="col-md-10">
                                                                <div class="profile-desk">
                                                                    <h4><?php echo h($vitalSign['VitalSignList']['name']); ?></h4>
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <td><span class="text-muted"><strong>General Range:</strong></span></td>
                                                                                <td><span class="text-muted"><strong>Observation:</strong></span></td>
                                                                                <td><span class="text-muted"><strong>Remark:</strong></span></td>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td><?php echo h($vitalSign['VitalSign']['min_observation'] . " - " . $vitalSign['VitalSign']['max_observation'] . " " . $vitalSign['VitalUnit']['name']); ?></td>
                                                                                <td><?php echo h($vitalSign['VitalSign']['observation']); ?></td>
                                                                                <td><?php echo h($vitalSign['VitalSign']['remark']); ?></td>
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
                                            <?php if (count($vitalSigns) > 0) { ?>
                                                <tr>
                                                    <th><?php echo h('Name'); ?></th>
                                                    <th><?php echo h('General Range'); ?></th>
                                                    <th><?php echo h('Observation'); ?></th>
                                                    <th><?php echo h('Remark'); ?></th>
                                                    <th class="actions"><?php echo __('Actions'); ?></th>
                                                </tr>
                                            <?php } ?>

                                            <?php
                                            if (count($vitalSigns) > 0) {
                                                foreach ($vitalSigns as $vitalSign):
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo h($vitalSign['VitalSignList']['name']); ?>
                                                        </td>
                                                        <td><?php echo h($vitalSign['VitalSign']['min_observation'] . " - " . $vitalSign['VitalSign']['max_observation'] . " " . $vitalSign['VitalUnit']['name']); ?>&nbsp;</td>
                                                        <td><?php echo h($vitalSign['VitalSign']['observation']); ?>&nbsp;</td>
                                                        <td><?php echo h($vitalSign['VitalSign']['remark']); ?>&nbsp;</td>
                                                        <td class="actions">
                                                            <a href="#patientsdetails_<?php echo $vitalSign['VitalSign']['id']; ?>" data-toggle="modal" class="btn btn-warning btn-xs"><i class="fa fa-search"></i></a>
                                                            <?php //echo $this->Form->button(__('<i class="fa fa-search"></i>'), array('action' => "#medical_history_" . $medicalHistory['MedicalHistory']['id']), array('escape' => false, 'data-toggle' => "modal", 'class' => "btn btn-warning btn-xs")); ?>
                                                            <?php echo $this->Form->button(__('<i class="fa fa-edit"></i>'), array('escape' => false, 'id' => "edit_vital_sign_" . $vitalSign['VitalSign']['id'], 'onclick' => "show_edit_div(" . $vitalSign['VitalSign']['id'] . ")", 'data-toggle' => "modal", 'class' => "btn btn-primary btn-xs")); ?>
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
        $("#cancel_add_new_vital_sign").hide();
        $("#add_new_vital_sign").click(function () {
            $("#new_vital_sign").fadeIn();
            $("#add_new_vital_sign").toggle();
            $("#cancel_add_new_vital_sign").toggle();
        });
        $("#cancel_add_new_vital_sign").click(function () {
            $("#new_vital_sign").fadeOut();
            $("#add_new_vital_sign").toggle();
            $("#cancel_add_new_vital_sign").toggle();
            $("input[type=text], textarea,select").val("");
        });
    });

    function show_edit_div(id)
    {
        $("#new_vital_sign").fadeIn();
        $("#add_new_vital_sign").toggle();
        $("#cancel_add_new_vital_sign").toggle();
        $("#cancel_add_new_vital_sign").bind("click", function () {
            $("input[type=text], textarea,select").val("");
            $("#table_id").val("");
        });

        $.ajax({
            type: "POST",
            url: "<?php echo Router::url(array('controller' => 'vital_signs', 'action' => 'get_vital_sign_byid')); ?>",
            data: {id: id},
            dataType: "json",
            success: function (data) {
                if (data != '') {
                    $("#table_id").val(data.VitalSign.id);
                    $("#vital_sign").val(data.VitalSignList.id).change();
                    $("#unit").val(data.VitalUnit.id);
                    $("#max_observation").val(data.VitalSign.max_observation);
                    $("#min_observation").val(data.VitalSign.min_observation);
                    $("#observation").val(data.VitalSign.observation);
                    $("#remark").val(data.VitalSign.remark);
                    $("#action").html("Edit ");

                } else {
                    alert('error');
                }
            }
        });
    }

    function change_unit(thisObj)
    {
//        if (typeof thisObj == 'undefined')
//            return false;
//        id = thisObj.value;
//        id++;
        $('#unit').empty();
        $.ajax({
            type: "POST",
            data: {unit: thisObj},
            async: false,
            url: "<?php echo Router::url(array('controller' => 'vital_signs', 'action' => 'change_unit')); ?>",
            success: function (data) {
                var obj = $.parseJSON(data);
                $.each(obj, function (index, val) {
                    //you can access other data by using val.id, val.created etc
                    $('<option>').val(val.id).text(val.name).appendTo('#unit');
                });
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