<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-9 col-sm-9">
                            <div class="box last">
                                <div class="box-heading">View Drugs Details
                                    <div class="pull-right">
                                        <a href="/users/dashboard" class="btn btn-sm btn-success popovers home"><i class="fa fa-backward"></i> &nbsp;Home</a>
                                        <a class="btn btn-sm btn-success popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
                                    </div>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="vitalSigns index">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="col-lg-8 pull-left">
                                                <h4>
                                                    <i>Rx, <?php print_r($services['User']['first_name']); ?> <?php print_r($services['User']['last_name']); ?></i>
                                                </h4>
                                            </div>
<!--                                            <div class="col-lg-4 pull-right">
                                                <?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-left"></i> Back'), array('action' => 'add_drugs', $services['Appointment']['id']), array('escape' => false, 'class' => "pull-right btn btn-sm btn-success")); ?>
                                            </div>-->
                                        </div>

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Medicine Name</th>
                                                    <th class="text-center">Unit Quantity</th>
                                                    <th class="text-center">Total Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($prescription)) {
                                                    $i = 1;
                                                    ?>
                                                    <?php foreach ($prescription as $key => $value) { ?>
                                                        <tr id="tr_<?php echo $i; ?>">
                                                            <td class="text-center" rowspan="2">
                                                                <p  id="row_<?php echo $i; ?>"><?php echo $i; ?></p>
                                                                <p class="hidden"><?php echo h($value['Prescription']['id']); ?></p>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php echo h($value['Prescription']['medicine_name']); ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php echo h($value['Prescription']['unit_qty']); ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php echo h($value['Prescription']['total_qty']); ?>
                                                            </td>
                                                        </tr>
                                                        <tr id="tra_<?php echo $i; ?>">
                                                            <td class="text-center">
                                                                <?php echo h($value['Prescription']['comments']); ?>
                                                            </td>
                                                            <td class="text-center">  
                                                                <?php
                                                                $times = array();
                                                                $times = $value['Prescription']['medicine_time'];
                                                                ?>
                                                                <?php echo $this->Form->checkbox($key . '.medicine_time.0', array('value' => 'mt_morning', 'div' => false, 'label' => false, 'checked' => (in_array('mt_morning', $times) ? 'checked' : ''), 'disabled' => 'disabled')); ?> Morning &nbsp;
                                                                <?php echo $this->Form->checkbox($key . '.medicine_time.1', array('value' => 'mt_noon', 'div' => false, 'label' => false, 'checked' => (in_array('mt_noon', $times) ? 'checked' : ''), 'disabled' => 'disabled')); ?> Afternoon &nbsp;
                                                                <?php echo $this->Form->checkbox($key . '.medicine_time.2', array('value' => 'mt_eve', 'div' => false, 'label' => false, 'checked' => (in_array('mt_eve', $times) ? 'checked' : ''), 'disabled' => 'disabled')); ?> Evening &nbsp;
                                                                <?php echo $this->Form->checkbox($key . '.medicine_time.3', array('value' => 'mt_night', 'div' => false, 'label' => false, 'checked' => (in_array('mt_night', $times) ? 'checked' : ''), 'disabled' => 'disabled')); ?> Night &nbsp;
                                                            </td>
                                                            <td class="text-center">
                                                                <?php echo $this->Form->radio($key . '.after_meal', array('0' => ' Before Meal', '1' => ' After Meal'), array('value' => $value['Prescription']['after_meal'], 'id' => 'after_meal_0', 'label' => false, 'legend' => false, 'separator' => ' &nbsp;&nbsp;', 'disabled' => 'disabled')); ?>
                                                            </td>
                                                        </tr>  
                                                        <?php
                                                        $i++;
                                                    }
                                                    ?>
                                                        
                                                <?php }
                                                else { ?>
                                                    <tr id="tr_0" colspan="4" rowspan="10">
                                                        <td class="text-center" >
                                                            <p class="btn btn-danger" id="row_0" >No data available</p>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                    
                                            </tbody>
                                        </table>
                                        
                                        <?php if (!empty($prescription[0]['Prescription']['things_to_do'])) { ?>
                                            <div class="row">
                                                <div class="col-lg-3 payment-method">
                                                    <h4 class="pull-right">Things to do</h4>
                                                </div>
                                                <div class="col-lg-9 payment-method">
                                                    <?php echo $this->Form->input($i . '.things_to_do', array('value' => strip_tags($prescription[0]['Prescription']['things_to_do']), 'type' => 'textarea', 'placeholder' => "Add important instruction", 'rows' => '5', 'class' => 'ckeditor form-control', 'div' => false, 'label' => false)); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <br>
                                        <?php  if (!empty($prescription)) { ?>
                                        <div>
                                        <a data-content="Report" data-placement="top" data-trigger="hover"  href="<?= Router::url(array('controller' => 'appointments', 'action' => 'print_prescription',$appointment_id)) ?>" class="btn btn-info pull-right" target="_blank"><i class="fa fa-file-excel-o"></i> Print</a>
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
                    $("#vital_sign").val(data.VitalSignList.id - 1).change();
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