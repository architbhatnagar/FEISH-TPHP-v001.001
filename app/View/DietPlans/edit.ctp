<script type="text/javascript">

    $(document).ready(function () {
        $('#frm_diet_plan').bValidator();
        
        $('#end_date').datepicker({
            changeMonth: true,
            changeYear: true,
            minDate: $("#start_date").val()
        });
        $('#start_date').datepicker({
            minDate: "NOW",
            changeMonth: true,
            changeYear: true,
            onSelect: function (dt, dt_obj) {
                var minDate = $(this).datepicker('getDate');

                $('#end_date').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    minDate: minDate
                });
                $("#end_date").datepicker("option", "minDate", minDate);
            }
        });
    });

    var options = {
        singleError: true,
        showCloseIcon: false
    };

    $('#frm_diet_plan').bValidator(options);



</script>
<style>
    .bvalidator_errmsg {
        margin-left: -90px;
    }
</style> 
<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row ">
                        <div class="col-md-12 col-sm-12">
                            <div class="box last">
                                <div class="box-heading">Diet Plans 
                                    <a class="btn btn-sm btn-success pull-right popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
                                    <a style="display: none;" class="btn btn-info btn-sm pull-right" id="add_new_family_history">Add </a>
                                    <a style="display: block;" href="<?= Router::url(array('controller' => 'diet_plans', 'action' => 'index')) ?>" class="btn btn-danger btn-sm pull-right" id="cancel_add_new_family_history" hidden="">Cancel</a>
                                </div>
                            </div>

                            <div style="display: block;" id="new_family_history" hidden="">
                                <div class="box">
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tbody><tr>
                                                    <td>
                                                        <?= $this->Form->create('DietPlan', array('class' => '', 'id' => 'frm_diet_plan', 'role' => 'form', 'type' => 'file')); ?>
                                                        <div class="prf-contacts sttng">
                                                            <h4>Edit Diet Plan</h4>
                                                            <hr>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="control-label mll">Plan Name <span class="required">*</span></label>
                                                                    <?= $this->Form->input('plan_name', array('type' => 'text', 'id' => 'test_id', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter diet plan name.', 'placeholder' => 'Diet Plan Name', 'value' => $diet_paln_details['DietPlan']['plan_name'])); ?>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="control-label mll">Start Date <span class="required">*</span></label>
                                                                    <?= $this->Form->input('start_date', array('type' => 'text', 'id' => 'start_date', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter start date.', 'placeholder' => 'yyyy/mm/dd', 'value' => date('m/d/Y', strtotime($diet_paln_details['DietPlan']['start_date'])), 'readonly' => true, 'onchange' => 'return checkEndDateValidDate()')); ?>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="control-label mll">End Date</label>
                                                                    <?= $this->Form->input('end_date', array('type' => 'text', 'id' => 'end_date', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter end date.', 'placeholder' => 'yyyy/mm/dd', 'value' => date('m/d/Y', strtotime($diet_paln_details['DietPlan']['end_date'])), 'readonly' => true, 'onchange' => 'return checkValidDate()')); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="choose_file" class="control-label col-lg-2">Add Timetable <span class="required">*</span></label>
                                                            <div class="col-lg-8">
                                                                <div class="panel-body">
                                                                    <table class="table table-bordered appened_tr" id="appened_diet_tr_totable">
                                                                        <thead>
                                                                            <tr>
                                                                                <th colspan="3">
                                                                                    <a class="btn btn-xs btn-primary pull-right" id="add_more_file" title="Add More">
                                                                                        <i class="fa fa-plus"></i>
                                                                                    </a> </th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Weekday</th>
                                                                                <th>Time</th>
                                                                                <th>Description</th>
                                                                                <th>Actions</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php
                                                                            foreach ($diet_paln_details['DietPlansDetail'] as $key => $value) :
                                                                                $i = $key;
                                                                                ?>
                                                                                <tr id="tr<?= $key; ?>">
                                                                                    <td>
                                                                                        <?= $this->Form->input('weekday', array('name' => 'data[DietPlan][PlanDetails][' . $key . '][weekday]', 'empty' => 'Select day', 'options' => $weekdays, 'selected' => $value['weekday'], 'id' => 'weekday', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please select weekday.')); ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php
                                                                                        $curr_time = explode(' ', date('h:i A', strtotime($value['time'])));
                                                                                        ?>
                                                                                        <input type="text" class="form-control time1" name="data[DietPlan][PlanDetails][<?= $key; ?>][time]" id="time" data-bvalidator="required"  data-bvalidator-msg = "Please enter time."  placeholder = "Time" value="<?= $curr_time[0] . "" . $curr_time[1] ?>"/>
                                                                                        <?php // $this->Form->input('time', array('name' => 'data[DietPlan][PlanDetails][' . $key . '][time]', 'type' => 'text', 'id' => 'time', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter time.', 'placeholder' => 'Time', 'value' => $value['time']));  ?>
                                                                                        <?= $this->Form->input('edit_id', array('name' => 'data[DietPlan][PlanDetails][' . $key . '][edit_id]', 'type' => 'hidden', 'id' => 'edit_id', 'class' => 'form-control', 'label' => false, 'value' => $value['id'])); ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?= $this->Form->input('description', array('name' => 'data[DietPlan][PlanDetails][' . $key . '][description]', 'type' => 'textarea', 'id' => 'description', 'class' => 'form-control remove', 'placeholder' => 'Enter description', 'label' => false, 'value' => $value['description'])); ?>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php if($key != 0) { ?>
                                                                                        <a class="btn btn-xs btn-danger del_row" row_id="<?= $key; ?>" onclick="delete_row('<?= $key; ?>', '<?= $value['id'] ?>')">
                                                                                            <i class="fa fa-minus"></i>
                                                                                        </a>
                                                                                        <?php } ?>
                                                                                    </td>

                                                                                </tr>
                                                                                <?php
                                                                                $i++;
                                                                            endforeach;
                                                                            ?>
                                                                        </tbody>
                                                                        <input type="hidden" name="cnt" id="cnt" value="<?php echo $i ?>">

                                                                    </table>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2"></div>
                                                        </div>

                                                        <div class="form-group mtxxl text-center mbn">
                                                            <div class="row">

                                                                <div class="col-md-12">
                                                                    <?= $this->Form->input('Save Diet Plan', array('type' => 'submit', 'id' => 'btn_submit', 'class' => 'btn btn-outlined btn-primary', 'placeholder' => 'Enter description', 'label' => false)); ?>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <?= $this->Form->end(); ?>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $this->webroot?>js/front_end/jquery.ptTimeSelect.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $('.time1').ptTimeSelect();

        $(".remove").removeAttr("rows");
        $(".remove").removeAttr("cols");

        $("#cancel_add_new_family_history").show();

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

        var row_cnt = 0;
        var cnt = $('#cnt').val();
        var arr_cnt
        $('#add_more_file').click(function () {
            var append_desg = '<tr id=tr' + cnt + '><td><select name="data[DietPlan][PlanDetails][' + cnt + '][weekday]" class="form-control" data-bvalidator = "required" data-bvalidator-msg = "Please select weekday."><option value=""> Select Day</option><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thursday</option><option value="5">Friday</option><option value="6">Saturday</option><option value="7">Sunday</option></select></td><td><input type="text" class="form-control time1" name="data[DietPlan][PlanDetails][' + cnt + '][time]" data-bvalidator="required"  data-bvalidator-msg = "Please enter time." /></td><td><textarea class="form-control" name="data[DietPlan][PlanDetails][' + cnt + '][description]" placeholder="Enter description" /></textarea></td><td><a class="btn btn-xs btn-danger del_row" row_id=' + cnt + ' onclick=delete_row(' + cnt + ',' + row_cnt + ')><i class="fa fa-minus"></i></a></td></tr>';
            $(append_desg).appendTo("#appened_diet_tr_totable");
            cnt++;
            $('.time1').ptTimeSelect();
        });

//        $('#start_date').datepicker({
//            autoclose: true,
////            startDate: '-3m'
//            minDate: new Date()
//        });
//       
//                   
//        $('#end_date').datepicker({
//              var minsDate = $('#start_date').datepicker('getDate');
//            
//            minDate: minsDate
////            startDate: '-3m'
//        });
    });

    var myBaseUrl = '<?php echo Router::url('/', true) ?>';

    function delete_row(key, row_id) {
        if (key != "" && row_id == 0) {
            $("#tr" + key).remove();
        }
        if (row_id != "") {
            if (confirm("Are you sure?")) {
                // your deletion code
                $.ajax({
                    type: "POST",
                    url: myBaseUrl + "diet_plans/delete_diet_plan",
                    data: {id: row_id},
                    dataType: "json",
                    success: function (data)
                    {
                        $("#tr" + key).remove();
                    }
                });
                return true;
            } else {
                return false;
            }

        }

    }
</script>

<style type="text/css">
    .check_bx_spce{
        width:10%;
    }
</style>

