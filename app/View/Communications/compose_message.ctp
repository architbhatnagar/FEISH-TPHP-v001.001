<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>
            </li>
            <li>
                <a class="" href="<?= Router::url(array('controller' => 'communications', 'action' => 'communications_index_admin')) ?>">Communications</a>
            </li>
            <li>
                <a class="current" href="#">Compose Message</a>
            </li>
             <li class="pull-right">
                 <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                Add Service
            </header>
            <div class="panel-body">
                <div class="form">
                    <div class="position-center">
                        <?php echo $this->Form->create('Communication', array('id'=>'compose_msg','type'=>'file','class' => 'cmxform form-horizontal', 'role' => 'form')); ?>

                        <div class="form-group">
                            <label class="col-lg-4 control-label">Subject</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('subject', array('data-bvalidator' => 'required', 'class' => 'form-control', 'label' => false)) ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Service Name</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('service_id', array('data-bvalidator' => 'required', 'class' => 'form-control', 'label' => false)) ?>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="" class="col-lg-4 control-label">To</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('replied_user_key', array('data-bvalidator' => 'required', 'options' => $users, 'multiple'=>'multiple', 'data-bvalidator' => 'required', 'id'=>'specialty','class' => 'populate width_class', 'label' => false)) ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-4 control-label">Message</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('message', array('data-bvalidator' => 'required', 'id' => 'message', 'class' => 'form-control', 'label' => false)) ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Attachments</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('Attach file', array('type' => 'file', 'class' => 'form-control', 'label' => false)) ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-lg-offset-4 col-lg-8">
                                <?= $this->Form->input('Send', array('type' => 'submit', 'class' => 'btn btn-primary', 'label' => false)) ?>
                            </div>
                        </div>  
                        <?php echo $this->Form->end(); ?>                 
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style type="text/css">
    .width_class{
        width: 100%;
    }
</style>
<script type="text/javascript" src='http://maps.google.com/maps/api/js?libraries=places'></script>
<?= $this->Html->script(array('front_end/locationpicker.jquery.js')); ?>
<script>
    $(document).ready(function () {
        $("#compose_msg").bValidator();
        $("#specialty").select2();

    });

//communication validations
    $('.send_btn').on('click', function(e){
        
        var text = $('.msg_body').val();
//        var digit_err = $('.msg_body').attr('digit-err');
        get_contact_length = get_numbers(text);
        if(checkIfEmailInString(text) || contact_found){
            $('.msg_body').addClass('bvalidator_invalid');
            alert("Message can not contain Email or Contact number");
            return false;
        } else {
            $('.msg_body').removeClass('bvalidator_invalid');
        }
    });
    
    var get_numbers = function(text){
        var contact_found = false;
        contact = text.match(/(\d+)/g);
        contact.forEach(function(value, index){
            if(value.length == 10) {
                return contact_found = true;
            }
        }, this);
        return contact_found;
    }
    
    function checkIfEmailInString(text) { 
        var re = /(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/;
        return re.test(text);
    }
    
    var new_val = [];
    //Function to restrict 10 digit numbers to textbox
    function validate(key)
    {
        //getting key code of pressed key
        var keycode = (key.which) ? key.which : key.keyCode;
        var phn = $('.msg_body');
        //comparing pressed keycodes
        if ((keycode < 48 || keycode > 57))
        {
//            $('.msg_body').attr('digit-err','true');
            new_val = [];
            return true;
        }
        else
        {
            value = $(this);
            new_val.push(value);
            //Condition to check textbox contains ten numbers or not
            if (new_val.length <10)
            {
              $('.msg_body').removeClass('bvalidator_invalid');
                return true;
            }
            else
            {
                $('.msg_body').addClass('bvalidator_invalid');
//                alert("Message can not contain Email or Contact number");
//                $('.msg_body').attr('digit-err','true');
            }
        }
    }
</script>



