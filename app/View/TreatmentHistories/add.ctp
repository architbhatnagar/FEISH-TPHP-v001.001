<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row ">
                        <div class="col-md-9 col-sm-9">
                            <div class="box last">
                                <div class="box-heading">Welcome<a class="btn btn-sm btn-success pull-right popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a> </div>
                                <div class="box-body">
                                    <section class="main-content">
                                        <section class="wrapper">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <ul class="breadcrumbs-alt">
                                                        <li>
                                                            <a href="#">Dashboard</a>
                                                        </li>
                                                        <li>
                                                            <a class="" href="/feish/treatment_histories">Treatments</a>
                                                        </li>
                                                        <li class="">
                                                            <a class="current" href="">Add Treatment</a>
                                                        </li>
                                                    </ul>
                                                    <div class="panel reply_panel" style="border: 1px solid #D2D2D2;">
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="treatmentHistories form col-md-12">
                                                                    <?php echo $this->Form->create('TreatmentHistory', array('id' => 'add_treatment_form', 'class' => 'cmxform form-horizontal')); ?>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Treatment Name <span class="required">*</span></label>
                                                                        <div class="col-sm-9">
                                                                            <?php echo $this->Form->input('name', array('data-bvalidator' => 'required', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Appointment</label>
                                                                        <div class="col-sm-9">
                                                                            <?php echo $this->Form->input('appointment_id', array('options' => $appointments, 'empty' => '-Select Appointment-', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div>
                                                                            <label class="col-sm-3 control-label">Start Date <span class="required">*</span></label>
                                                                            <div class="col-sm-3">
                                                                                <?php echo $this->Form->input('start_date', array('data-bvalidator' => 'required', 'type' => 'text', 'id' => 'start_date', 'readonly' => 'readonly', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div id="end_date_div">
                                                                            <label class="col-sm-offset-1 col-sm-2 control-label">End Date <span class="required"></span></label>
                                                                            <div class="col-sm-3">
                                                                                <?php echo $this->Form->input('end_date', array( 'type' => 'text', 'id' => 'end_date', 'readonly' => 'readonly', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Is Cured <span class="required">*</span></label>
                                                                        <div class="col-sm-9">
                                                                            <?php echo $this->Form->radio('is_cured', array('1' => ' Yes', '0' => ' No'), array('data-bvalidator' => 'required',  'id' => 'is_cured_0', 'label' => false, 'legend' => false, 'separator' => ' &nbsp;&nbsp;')); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Is running <span class="required">*</span></label>
                                                                        <div class="col-sm-9">
                                                                            <?php echo $this->Form->radio('is_running', array('1' => ' Yes', '0' => ' No'), array('data-bvalidator' => 'required', 'id' => 'is_running_0', 'label' => false, 'legend' => false, 'separator' => ' &nbsp;&nbsp;')); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Procedure</label>
                                                                        <div class="col-sm-9">
                                                                            <?php echo $this->Form->input('procedure_id', array('data-bvalidator' => 'required', 'options' => $procedures, 'empty' => '-Select Procedure-', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-3 control-label">Description</label>
                                                                        <div class="col-sm-9">
                                                                            <?php echo $this->Form->input('description', array('data-bvalidator' => 'required', 'class' => 'ckeditor form-control', 'div' => false, 'label' => false)); ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group text-center">
                                                                        <?php echo $this->Form->submit(__('Add Treatment History'), array('class' => 'btn btn-primary btn-md')); ?>
                                                                    </div>
                                                                    <?php echo $this->Form->end(); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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

<script type="text/javascript">
    $(document).ready(function () {
        $("#add_treatment_form").bValidator();
        $('#end_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            minDate: "NOW",
        });
      
         $('#start_date').datepicker({
//            minDate: "NOW",
            changeMonth: true,
            changeYear: true,
            onSelect: function(dt, dt_obj) {
                    var minDate = $(this).datepicker('getDate');
                 //   alert(minDate);
                    $('#end_date').datepicker({
                        changeMonth: true,
                        changeYear: true,
                        minDate:minDate
                    });
                    $("#end_date").datepicker("option", "minDate", minDate);
            }
        });
    });
    
</script>
