<script type="text/javascript"> 
    $(document).ready(function () { 
        $('#add_plan_form').bValidator();
    });
</script>
<script type="text/javascript">
    
    var options = {
        singleError: true,
        showCloseIcon: false
    };

    $('#add_plan_form').bValidator(options);

</script>
<div class="col-sm-12">
    <ul class="breadcrumbs-alt">
        <li>
            <?php if ($this->Session->read('Auth.User.user_type') == 1) { ?>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>
            <?php } else if($this->Session->read('Auth.User.user_type') == 2){ ?>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'doctors_dashboard')) ?>">Dashboard</a>
            <?php } ?>
        </li>
        <li>
            <a class="active-trail active" href="<?= Router::url(array('controller' => 'doctor_packages', 'action' => 'index')) ?>">Plans</a>
        </li>
        <li>
            <a class="current" href="javascript:void(0);">Add New plan</a>
        </li>
    </ul>
    <section class="panel">
        <header class="panel-heading">
            Add New plan
        </header>
        <div class="panel-body">
            <div class="form">
                <?php echo $this->Form->create('DoctorPackage',array('id'=>'add_plan_form','role'=>'form','class'=>'cmxform form-horizontal','enctype'=>'multipart/form-data')); ?>
                    <div class="form-group">
                        <label for="service_id" class="control-label col-lg-3">Service Name</label>
                        <div class="col-lg-6">
                            <?= $this->Form->input('service_id',array('default'=>'Please select Service','options'=>$services,'id'=>'service_id','class'=>'populate form-control','label'=>false)); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="plan_name" class="control-label col-lg-3">Plan Name</label>
                        <div class="col-lg-6">
                            <?= $this->Form->input('name',array('type'=>'text','id'=>'plan_name','class'=>'form-control','placeholder'=>'Enter Plan Name','label'=>false,'data-bvalidator'=>'required','data-bvalidator-msg'=>'Please enter plan name.')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="plan_price" class="control-label col-lg-3">Plan Price</label>
                        <div class="col-lg-6">
                            <?= $this->Form->input('price',array('type'=>'text','id'=>'plan_price','class'=>'form-control','placeholder'=>'Enter Plan Price','label'=>false,'data-bvalidator'=>'required','data-bvalidator-msg'=>'Please enter plan price')); ?>
                        </div>
                    </div>
                <div class="form-group">
                        <label for="plan_price" class="control-label col-lg-3">Plan Type</label>
                        <div class="col-lg-6">
                            <?= $this->Form->input('plan_type',array('options'=>$plan_types,'empty'=>'Select Plan Type','id'=>'plan_type','class'=>'form-control','placeholder'=>'Enter Plan Price','label'=>false,'data-bvalidator'=>'required','data-bvalidator-msg'=>'Please enter plan price')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="plan_price" class="control-label col-lg-3">Plan Details</label>
                        <div class="col-lg-6">
                            <?= $this->Form->input('plan_details',array('type'=>'textarea','id'=>'plan_details','class'=>'form-control','placeholder'=>'Enter Plan details line separated','label'=>false,'data-bvalidator'=>'required','data-bvalidator-msg'=>'Please enter plan details')); ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="valid_visits" class="control-label col-lg-3">Valid Visits</label>
                        <div class="col-lg-6">
                            <?= $this->Form->input('valid_visits',array('type'=>'text','id'=>'valid_visits','class'=>'form-control','placeholder'=>'Enter Plan valid visits','label'=>false,'data-bvalidator'=>'required','data-bvalidator-msg'=>'Please enter first name','data-bvalidator'=>'number,required','data-bvalidator-msg'=>'Please enter valid visits')); ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="plan_validity" class="control-label col-lg-3">Validity (in days)</label>
                        <div class="col-lg-6">
                            <?= $this->Form->input('validity',array('type'=>'text','id'=>'plan_validity','class'=>'form-control','placeholder'=>'Enter Plan Validity','label'=>false,'data-bvalidator'=>'number,maxlength[3],required','data-bvalidator-msg'=>'Please enter validity')); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-6">
                            <?= $this->Form->input('Add Plan',array('type'=>'button','id'=>'add_plan','class'=>'btn btn-primary','placeholder'=>'Add Assistant','value'=>"Add Assistant",'label'=>false)); ?>
                        </div>
                    </div>
                <?= $this->Form->end();?>
            </div>
        </div>
    </section>
</div>
