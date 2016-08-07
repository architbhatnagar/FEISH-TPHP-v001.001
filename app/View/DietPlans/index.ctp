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
                    <div class="row">
                        <?php echo $this->Session->flash(); ?>
                        <div class="col-md-9 col-sm-9">
                            <div class="box last">
                                <div class="box-heading">Diet Plans 
                                    <div class="pull-right">                      
                                        <a style="display: none;" class="btn btn-info btn-sm" id="add_new_family_history">Add </a>
                                        <a style="display: inline-block;" class="btn btn-danger btn-sm" id="cancel_add_new_family_history" hidden="">Cancel</a>
                                        <a href="/users/dashboard" class="btn btn-sm btn-success popovers home"><i class="fa fa-backward"></i> &nbsp;Home</a>
                                        <a class="btn btn-sm btn-success popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
                                    </div>
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
                                                            <h4>Add Diet Plan</h4>
                                                            <hr>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="control-label mll">Plan Name <span class="required">*</span></label>
                                                                    <?= $this->Form->input('plan_name', array('type' => 'text', 'id' => 'test_id', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter diet plan name.', 'placeholder' => 'Diet Plan Name')); ?>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="control-label mll">Start Date <span class="required">*</span></label>
                                                                    <?= $this->Form->input('start_date', array('type' => 'text', 'id' => 'start_date', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter start date.', 'placeholder' => 'mm/dd/yyyy', 'readonly' => true, 'onchange' => 'return checkEndDateValidDate()')); ?>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="control-label mll">End Date</label>
                                                                    <?= $this->Form->input('end_date', array('type' => 'text', 'id' => 'end_date', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter end date.', 'placeholder' => 'mm/dd/yyyy', 'readonly' => true, 'onchange' => 'return checkValidDate()')); ?>
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
                                                                            <tr id="tr0">
                                                                                <td>
                                                                                    <?= $this->Form->input('weekday', array('name' => 'data[DietPlan][PlanDetails][0][weekday]', 'empty' => 'Select day', 'options' => $weekdays, 'id' => 'weekday', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please select weekday.')); ?>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" class="form-control time1" name="data[DietPlan][PlanDetails][0][time]" id="time1" data-bvalidator="required"  data-bvalidator-msg = "Please enter time."  placeholder = "Time"/>
                                                                                    <?php // $this->Form->input('time', array('name' => 'data[DietPlan][PlanDetails][0][time]', 'type' => 'time', 'id' => 'time', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter time.', 'placeholder' => 'Time'));  ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $this->Form->input('description', array('name' => 'data[DietPlan][PlanDetails][0][description]', 'type' => 'textarea', 'id' => 'description', 'class' => 'form-control', 'placeholder' => 'Enter description', 'label' => false)); ?>
                                                                                </td>
                                                                                <td>
<!--                                                                                    <a class="btn btn-xs btn-danger del_row" row_id="0" onclick="delete_row(0)">
                                                                                        <i class="fa fa-minus"></i>
                                                                                    </a>-->
                                                                                </td>

                                                                            </tr>
                                                                        </tbody>

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
                            <div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h4>Previous Diet Plans</h4>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <?php if (count($diet_plan_arr) > 0) { ?>
                                            <tr>
                                                <th>Plan Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>

                                                <th>Actions</th>
                                            </tr>
                                        <?php } ?>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($diet_plan_arr) > 0) {
                                            foreach ($diet_plan_arr as $diet_plan) :
                                                ?>
                                                <tr>
                                                    <td><?= $diet_plan['DietPlan']['plan_name']; ?></td>
                                                    <td><?= date('d M Y', strtotime($diet_plan['DietPlan']['start_date'])); ?></td>
                                                    <td><?= date('d M Y', strtotime($diet_plan['DietPlan']['end_date'])); ?></td>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="showDietDetails('<?= $diet_plan['DietPlan']['id'] ?>')" class="btn btn-warning btn-xs" title="View"><i class="fa fa-search"></i></a>
                                                        <a href="<?= Router::url(array('controller' => 'diet_plans', 'action' => 'edit', $diet_plan['DietPlan']['id'])) ?>" class="btn btn-primary btn-xs" title="View"><i class="fa fa-edit"></i></a>
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
                                <?php if (count($diet_plan_arr) > 0) { ?>
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

<div class="modal fade" id="diet_plan_view_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="margin-top: 120px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">View Details</h4>
            </div>
            <div class="" id="appened_diet_view">
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="hideModal()">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $this->webroot?>js/front_end/jquery.ptTimeSelect.js"></script>
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

        $('.time1').ptTimeSelect();

        $("#description").removeAttr("rows");
        $("#description").removeAttr("cols");

        $("#cancel_add_new_family_history").hide();
        $("#add_new_family_history").show();
        $("#new_family_history").hide();
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

        var row_cnt = 1;
        $('#add_more_file').click(function () {
            var append_desg = '<tr id=tr' + row_cnt + '><td><select name="data[DietPlan][PlanDetails][' + row_cnt + '][weekday]" class="form-control" data-bvalidator = "required" data-bvalidator-msg = "Please select weekday."><option value=""> Select Day</option><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thursday</option><option value="5">Friday</option><option value="6">Saturday</option><option value="7">Sunday</option></select></td><td><input type="text" class="form-control time1" placeholder="Time" name="data[DietPlan][PlanDetails][' + row_cnt + '][time]" data-bvalidator="required"  data-bvalidator-msg = "Please enter time." /></td><td><textarea class="form-control" name="data[DietPlan][PlanDetails][' + row_cnt + '][description]" placeholder="Enter description" /></textarea></td><td><a class="btn btn-xs btn-danger del_row" row_id=' + row_cnt + ' onclick=delete_row(' + row_cnt + ')><i class="fa fa-minus"></i></a></td></tr>';
            $(append_desg).appendTo("#appened_diet_tr_totable");
            row_cnt++;
            $('.time1').ptTimeSelect();
        });



//        $('#end_date').datepicker({
//            minDate: "NOW"
//        });



    });

    function delete_row(row_id) {
        $("#tr" + row_id).remove();
    }
</script>


<style type="text/css">
    .check_bx_spce{
        width:10%;
    }
</style>
