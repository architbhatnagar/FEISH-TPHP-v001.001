<script type="text/javascript">

    $(document).ready(function () {
        $('#frm_test_lab_results').bValidator();
    });
</script>

<style>
    .bvalidator_errmsg {
        margin-left: -203px;
    }
</style>  
<script>
    function imageValidate(val) {

        var file = $('#report_img').val();

        var exts = ['doc', 'docx', 'png', 'jpg', 'jpeg', 'pdf'];
        // first check if file field has any value
        if (file) {
            var get_ext = file.split('.');
            // reverse name to check extension
            get_ext = get_ext.reverse();
            // check file type is valid as given in 'exts' array
            if ($.inArray(get_ext[0].toLowerCase(), exts) > -1) {
                return true;
            } else {
                alert('Invalid file!,Please upload only doc,docx,png,jpg,jpeg,pdf.');
                $('#report_img').val('');
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
                        <div class="col-md-9 col-sm-9" id="lab">
                            <?php echo $this->Session->flash(); ?>
                            <div class="box last">
                                <div class="box-heading">Lab  Results 
                                    <div class="pull-right">
                                        <a  class="btn btn-info btn-sm" id="add_new_family_history">Add </a>
                                        <a  class="btn btn-danger btn-sm" id="cancel_add_new_family_history" hidden >Cancel</a>
                                        <a href="/users/dashboard" class="btn btn-sm btn-success popovers home"><i class="fa fa-backward"></i> &nbsp;Home</a>
                                        <a class="btn btn-sm btn-success popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
                                    </div>
                                </div>
                            </div>

                            <div  id="new_family_history" hidden>
                                <div class="box">
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tbody><tr>
                                                    <td>
                                                        <?= $this->Form->create('LabTestResult', array('class' => '', 'id' => 'frm_test_lab_results', 'role' => 'form', 'type' => 'file')); ?>
                                                        <div class="prf-contacts sttng">
                                                            <h4><span id="edit_action">Add</span> Lab Result</h4>
                                                            <hr>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <input name="id" id="table_id" value="" type="hidden">
                                                                    <label class="control-label mll">Date <span class="required">*</span></label>
                                                                    <?= $this->Form->input('test_date', array('type' => 'text', 'id' => 'test_date', 'class' => 'form-control', 'placeholder' => 'Enter test date', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter test date.', 'readonly' => true)); ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="control-label mll">Test Name <span class="required">*</span></label>
                                                                    <?= $this->Form->input('test_id', array('empty' => 'Select test name', 'options' => $tests, 'id' => 'test_id', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please select test name.')); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="control-label mll">Observed Value <span class="required">*</span></label>
                                                                    <?= $this->Form->input('observed_value', array('type' => 'text', 'id' => 'observed_value', 'class' => 'form-control', 'placeholder' => 'Enter observed value', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter observed value.')); ?>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="control-label mll">Upload Report <span class="required">*</span></label>
                                                                    <?= $this->Form->input('report_img', array('type' => 'file', 'id' => 'report_img', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => '', 'data-bvalidator-msg' => 'Please upload report.', 'onchange' => 'return imageValidate(this.value)')); ?>
                                                                    <?= $this->Form->input('report', array('type' => 'hidden', 'id' => 'report', 'label' => false, 'class' => 'form-control')); ?>    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label class="control-label mll">Description</label>
                                                                    <?= $this->Form->input('description', array('type' => 'textarea', 'id' => 'test_result_description', 'class' => 'form-control', 'placeholder' => 'Enter description', 'label' => false)); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mtxxl text-center mbn">
                                                            <?= $this->Form->input('Save Lab Result', array('type' => 'submit', 'id' => 'btn_submit', 'class' => 'btn btn-outlined btn-primary', 'placeholder' => 'Enter description', 'label' => false)); ?>
                                                        </div>

                                                        <?= $this->Form->end(); ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php if (count($test_results_details) > 0) { ?>
                                            <h4> Lab Results</h4>
                                        <?php } ?>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <?php if (count($test_results_details) > 0) { ?>
                                            <tr>
                                                <th>Date</th>
                                                <th>Test Name</th>
                                                <th>Report File</th>
                                                <th>Observed Value</th>
                                                <th>Description</th>
                                                <th>Actions</th>
                                            </tr>
                                        <?php } ?> 
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($test_results_details) > 0) {
                                            foreach ($test_results_details as $test_results) :
                                                ?>
                                                <tr>
                                                    <td><?= date('d-M-Y', strtotime($test_results['LabTestResult']['test_date'])); ?></td>
                                                    <td><?= $test_results['Test']['test_name']; ?></td>
                                                    <td>
                                                        <?php if (!empty($test_results['LabTestResult']['report'])) { ?>
                                                            <a href="<?= Router::url(array('controller' => 'lab_test_results', 'action' => 'download_sample_file', $test_results['LabTestResult']['report'])) ?>" class="download_pdf popovers" data-content="Download">
                                                                <?= $test_results['LabTestResult']['report']; ?>
                                                            </a>
                                                        <?php
                                                        } else {
                                                            echo "-";
                                                        }
                                                        ?>




                                                    </td>
                                                    <td><?= $test_results['LabTestResult']['observed_value']; ?></td>
                                                    <th><?= $test_results['LabTestResult']['description']; ?></th>
                                                    <td>
                                                        <a href="javascript:void(0);" onclick="viewTestDetails('<?= $test_results['LabTestResult']['id']; ?>');" class="btn btn-warning btn-xs"><i class="fa fa-search"></i></a>
                                                        <a href="#" onclick="show_edit_div('<?= $test_results['LabTestResult']['id']; ?>');" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
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
<?php if (count($test_results_details) > 0) { ?>
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

<div class="modal fade" id="test_results_view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="margin-top: 120px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">View Details</h4>
            </div>
            <div class="" id="appened_lab_test_view">

            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="hideModal()">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var myBaseUrl = '<?php echo Router::url('/', true) ?>';

    $(document).ready(function () {
        $("#cancel_add_new_family_history").hide();
        $("#add_new_family_history").click(function () {
            $("#new_family_history").fadeIn();
            $("#add_new_family_history").hide();
            $("#cancel_add_new_family_history").show();
        });
        $("#cancel_add_new_family_history").click(function () {
            $("#edit_action").html("Add");
            $("#new_family_history").fadeOut();
            $("#add_new_family_history").show();
            $("#cancel_add_new_family_history").hide();
        });
        $('#test_date').datepicker({
            maxDate: new Date()
        });

    });

    function viewTestDetails(id) {

        $.ajax({
            type: "POST",
            url: myBaseUrl + "lab_test_results/view_test_result_byid",
            data: {id: id},
            dataType: "html",
            success: function (data)
            {

                if (data != '')
                {
//                    $("#view_test_date").html(data.LabTestResult.test_date);
//                    $("#view_test_id").html(data.Test.test_name);
//                    $("#view_observed_value").html(data.LabTestResult.observed_value);
//                    $("#view_report").html(data.LabTestResult.report);
//                    $("#view_description").html(data.LabTestResult.description);
                    $("#appened_lab_test_view").html(data);
                    $("#test_results_view").modal({backdrop: "static"});
                    $('#test_results_view').modal('show');

                }
            }
        });
    }

    function hideModal() {
        $('#test_results_view').modal('hide');
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
//        var history_id = str.replace("edit_family_hostory_", "");
        $.ajax({
            type: "POST",
            url: myBaseUrl + "lab_test_results/get_test_result_byid",
            data: {id: id},
            dataType: "json",
            success: function (data)
            {
                $("div.bvalidator_errmsg").remove();
                if (data.LabTestResult.report != "") {

                    $("#report_img").removeAttr("data-bvalidator");
                    $("#report_img").removeAttr("data-bvalidator-msg");
                }

                if (data != '')
                {
                    $("#edit_action").html("Edit");
                    $("#add_new_family_history").css("display", "none");
                    $("#cancel_add_new_family_history").css("display", "inline-block");
                    $("#test_result_description").val(data.LabTestResult.description);
                    $("#table_id").val(data.LabTestResult.id);
                    $("#test_date").val(data.LabTestResult.test_date);
                    $("#test_id").val(data.LabTestResult.test_id);
                    $("#observed_value").val(data.LabTestResult.observed_value);
                    $("#report").val(data.LabTestResult.report);
                    $("#report_img").val(data.LabTestResult.report);
                    $('#test_date').datepicker({
                        maxDate: new Date()
                    });
                }
            }
        });
    }
</script>
<style type="text/css">
    .check_bx_spce{
        width:10%;

    }
    .download_pdf:hover{
        color:#026f7a !important;
    }
</style>