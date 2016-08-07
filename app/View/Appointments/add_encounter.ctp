<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="#">Dashboard</a>
            </li>
            <li>
                <a href="/feish/appointments/">Encounters</a>
            </li>
            <li>
                <a class="current" href="">Add SOAP Note</a>
            </li>
             <li class="pull-right">
                 <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                Add SOAP Notes
                <?php echo $this->Html->link(__('View Patient Details'), array('controller'=>'patient_habits','action' => 'patient_health_profile',$appId,4), array('escape' => false, 'class' => "btn btn-primary btn-sm pull-right", 'style' => '')); ?>
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <div class="appointments form">
                        <?php echo $this->Form->create('SoapNote'); ?>
                        <div class="form-group">
                            <label class="">Identified Problem/Disease</label>
                            <!--<div class="col-sm-7">-->
                            <?php echo $this->Form->input('disease', array('type' => 'textarea', 'class' => 'ckeditor form-control', 'rows' => '5', 'placeholder' => "Identified Problem/Disease", 'div' => false, 'label' => false)); ?>
                            <p class="help-block"></p>
                            <!--</div>-->
                        </div>

                        <div class="form-group">
                            <label class="">Observations</label>
                            <!--<div class="col-sm-7">-->
                            <?php echo $this->Form->input('observation', array('type' => 'textarea', 'class' => 'ckeditor form-control', 'rows' => '5', 'placeholder' => "Observations", 'div' => false, 'label' => false)); ?>
                            <p class="help-block"></p>
                            <!--</div>-->
                        </div>

                        <div class="form-group">
                            <label class="">Diagnosis</label>
                            <!--<div class="col-sm-7">-->
                            <?php echo $this->Form->input('dignosis', array('type' => 'textarea', 'placeholder' => "Diagnosis", 'rows' => '5', 'class' => 'ckeditor form-control', 'div' => false, 'label' => false)); ?>
                            <p class="help-block"></p>
                            <!--</div>-->
                        </div>

                        <div class="form-group">
                            <label class="">Comments</label>
                            <!--<div class="col-sm-7">-->
                            <?php echo $this->Form->input('comments', array('type' => 'textarea', 'placeholder' => "Comments", 'rows' => '5', 'class' => 'ckeditor form-control', 'div' => false, 'label' => false)); ?>
                            <p class="help-block"></p>
                            <!--</div>-->
                        </div>
                        <div class="form-group">
<!--                            <input type="checkbox" id="is_reference" class=""> Is Reference?-->
                            <?php echo $this->Form->checkbox('is_reference', array('id' => 'is_reference', 'class' => '', 'div' => false, 'label' => false)); ?>
                            <label class="">Is Reference?</label>
                        </div>
                        <div id="ref_div" hidden>
                            <div class="form-group">
                                <label>Reference Name</label>
                                <!--<div class="col-sm-7">-->
                            <?php echo $this->Form->input('reference_name', array( 'placeholder' => "Name", 'class' => 'ckeditor form-control', 'div' => false, 'label' => false)); ?>
                            <p class="help-block"></p>
                            <!--</div>-->
                            </div>
                            <div class="form-group">
                                <label>Contact/Address</label>
                                <?php echo $this->Form->input('reference_address', array('type' => 'textarea', 'placeholder' => "Contact/Address", 'rows' => '4', 'class' => 'ckeditor form-control', 'div' => false, 'label' => false)); ?>
                            <p class="help-block"></p>
                            </div>
                            <div class="form-group">
                                <label>Comments</label>
                                <?php echo $this->Form->input('reference_comments', array('type' => 'textarea', 'placeholder' => "Comments", 'rows' => '4', 'class' => 'ckeditor form-control', 'div' => false, 'label' => false)); ?>
                            <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-primary')); ?>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    $(document).ready(function () {
        if ($('#is_reference').is(":checked")) {
            $("#ref_div").show();
        } else {
            $("#ref_div").hide();
        }
        $("#is_reference").click(function () {
            if ($(this).is(":checked")) {
                $("#ref_div").show();
            } else {
                $("#ref_div").hide();
            }
        });
    });
</script>