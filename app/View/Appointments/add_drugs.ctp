<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'doctors_dashboard')) ?>">Dashboard</a>
            </li>
            <li>
                <a href="<?= Router::url(array('controller' => 'appointments', 'action' => 'index')) ?>">Appointments</a>
            </li>
            <li>
                <a class="current" href="">Add Drug</a>
            </li>
             <li class="pull-right">
                 <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                Add Drug
            </header>
            <div class="panel-body">
                <?php echo $this->Form->create('Prescription'); $i = 0; ?>
                <section class="panel">
                    <div class="panel-body invoice">
                        <div class="row invoice-to">
                            <div class="col-lg-8 pull-left">
                                <h4>
                                    <i>Rx, <?php print_r($services['User']['first_name']); ?> <?php print_r($services['User']['last_name']); ?></i>
                                </h4>
                            </div>
                            <div class="col-lg-4 pull-right">
                                <?php echo $this->Html->link(__('<i class="fa fa-mail-reply-all"></i> Previos drugs'), array('action' => 'view_presc', $services['Appointment']['id']), array('id'=>"prev_drugs", 'escape' => false, 'data-placement' => "bottom", 'class' => "btn btn-success btn-sm pull-right", 'style' => 'margin-left: 1em;')); ?>
                                <a class="btn btn-success btn-sm pull-right" id="add_medicines"><i class="fa fa-plus-square"></i> Add Medicine</a>
                            </div>
                        </div>
                        
                        <div id="prescription_table">
                            <table class="table table-invoice" id="medicines_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Medicine Name</th>
                                        <th class="text-center">Unit Quantity</th>
                                        <th class="text-center">Total Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($prescription)){ ?>
                                        <?php foreach ($prescription as $key => $value) { ?>
                                            <tr id="tr_<?php echo $key; ?>">
                                                <td class="text-center" rowspan="2">
                                                    <a class="btn btn-danger" id="row_<?php echo $key; ?>" onclick="remove_medicine(<?php echo $key; ?>,<?php echo $value['Prescription']['id']; ?>)"><i class="fa fa-trash-o"></i></a>
                                                    <?php echo $this->Form->input($key.'.id', array('value' => $value['Prescription']['id'], 'class' => 'form-control hidden', 'div' => false, 'label' => false)); ?>
                                                </td>
                                                <td>
                                                    <?php echo $this->Form->input($key.'.medicine_name', array('value' => $value['Prescription']['medicine_name'], 'placeholder' => "Enter medicine name", 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                                </td>
                                                <td>
                                                    <?php echo $this->Form->input($key.'.unit_qty', array('value' => $value['Prescription']['unit_qty'], 'placeholder' => "Enter unit quantity. e.g. 2 spoon / 1 tab", 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                                </td>
                                                <td>
                                                    <?php echo $this->Form->input($key.'.total_qty', array('value' => $value['Prescription']['total_qty'], 'placeholder' => "Enter total quantity. e.g. 100 ml / 10 tabs", 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                                </td>
                                            </tr>
                                            <tr id="tra_<?php echo $key; ?>">
                                                <td>
                                                    <?php echo $this->Form->input($key.'.comments', array('value' => $value['Prescription']['comments'], 'placeholder' => "Enter additional comment", 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                                </td>
                                                <td class="text-center">  
                                                    <?php $times = array(); $times = $value['Prescription']['medicine_time']; ?>
                                                    <?php echo $this->Form->checkbox($key.'.medicine_time.0', array('value' => 'mt_morning', 'div' => false, 'label' => false, 'checked' => (in_array('mt_morning', $times) ? 'checked' : ''))); ?> Morning &nbsp;
                                                    <?php echo $this->Form->checkbox($key.'.medicine_time.1', array('value' => 'mt_noon', 'div' => false, 'label' => false, 'checked' => (in_array('mt_noon', $times) ? 'checked' : ''))); ?> Afternoon &nbsp;
                                                    <?php echo $this->Form->checkbox($key.'.medicine_time.2', array('value' => 'mt_eve', 'div' => false, 'label' => false, 'checked' => (in_array('mt_eve', $times) ? 'checked' : ''))); ?> Evening &nbsp;
                                                    <?php echo $this->Form->checkbox($key.'.medicine_time.3', array('value' => 'mt_night', 'div' => false, 'label' => false, 'checked' => (in_array('mt_night', $times) ? 'checked' : ''))); ?> Night &nbsp;
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $this->Form->radio($key.'.after_meal', array('0' => ' Before Meal', '1' => ' After Meal'), array('value' => $value['Prescription']['after_meal'], 'id' => 'after_meal_0', 'label' => false, 'legend' => false, 'separator' => ' &nbsp;&nbsp;'));?>
                                                </td>
                                            </tr>  
                                        <?php } ?>
                                    <?php } else { ?>
                                        <tr id="tr_0">
                                            <td class="text-center" rowspan="2">
                                                <a class="btn btn-danger" id="row_0" onclick="remove_medicine(0,-1)"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td>
                                                <?php echo $this->Form->input($i.'.medicine_name', array('placeholder' => "Enter medicine name", 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                            </td>
                                            <td>
                                                <?php echo $this->Form->input($i.'.unit_qty', array('placeholder' => "Enter unit quantity. e.g. 2 spoon / 1 tab", 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                            </td>
                                            <td>
                                                <?php echo $this->Form->input($i.'.total_qty', array('placeholder' => "Enter total quantity. e.g. 100 ml / 10 tabs", 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                            </td>
                                        </tr>
                                        <tr id="tra_0">
                                            <td>
                                                <?php echo $this->Form->input($i.'.comments', array('placeholder' => "Enter additional comment", 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $this->Form->checkbox('Prescription.'.$i.'.medicine_time.0', array('checked' => 'checked', 'value' => 'mt_morning', 'div' => false, 'label' => false)); ?> Morning &nbsp;
                                                <?php echo $this->Form->checkbox('Prescription.'.$i.'.medicine_time.1', array('checked' => 'checked', 'value' => 'mt_noon', 'div' => false, 'label' => false)); ?> Afternoon &nbsp;
                                                <?php echo $this->Form->checkbox('Prescription.'.$i.'.medicine_time.2', array('value' => 'mt_eve', 'div' => false, 'label' => false)); ?> Evening &nbsp;
                                                <?php echo $this->Form->checkbox('Prescription.'.$i.'.medicine_time.3', array('value' => 'mt_night', 'div' => false, 'label' => false)); ?> Night &nbsp;
                                            </td>
                                            <td class="text-center">
                                                <?php echo $this->Form->radio($i.'.after_meal', array('0' => 'Before Meal'), array('id' => 'after_meal_0', 'legend' => false, 'after' => '&nbsp;&nbsp;&nbsp;'));?>
                                                <?php echo $this->Form->radio($i.'.after_meal', array('1' => 'After Meal'), array('id' => 'after_meal_0', 'legend' => false, 'after' => '&nbsp;&nbsp;&nbsp;')); ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 payment-method">
                                <h4 class="pull-right">Things to do</h4>
                            </div>
                            <div class="col-lg-9 payment-method">
                                <?php if(!empty($prescription[0]['Prescription']['things_to_do'])) {
                                echo $this->Form->input($i.'.things_to_do', array('value' => $prescription[0]['Prescription']['things_to_do'], 'type' => 'textarea', 'placeholder' => "Add important instruction", 'rows' => '5', 'class' => 'ckeditor form-control', 'div' => false, 'label' => false)); 
                                } else { 
                                    echo $this->Form->input($i.'.things_to_do', array('type' => 'textarea', 'placeholder' => "Add important instruction", 'rows' => '5', 'class' => 'ckeditor form-control', 'div' => false, 'label' => false)); 
                                }
                                ?>
                            </div>
                            <h3 class="text-center inv-label itatic">Thank you for your visit</h3>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="">
                            <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-primary')); ?>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </section>

            </div>
        </section>
    </div>
</div>


<script type="text/javascript">
    var counter;
    var count = 0;
    $(document).ready(function () {
        $('#add_medicines').click(function (event)
        {
            counter = ($('#medicines_table tbody tr').length)/2;
            counter += count;
            var newRow = $('<tr id="tr_' + counter + '">\n\
                    <td class="text-center" rowspan="2"><a class="btn btn-danger" id="row_' + counter + '" onclick="remove_medicine('+ counter +',-1)"><i class="fa fa-trash-o"></i></a></td>\n\
                    <td><input name="data[Prescription]['+counter+'][medicine_name]" placeholder="Enter medicine name" class="form-control" maxlength="255" type="text" id="PrescriptionMedicineName'+counter+'"><?php //echo $this->Form->input('', array('placeholder' => "Enter medicine name", 'class' => 'form-control', 'div' => false, 'label' => false)); ?></td>\n\
                    <td><input name="data[Prescription]['+counter+'][unit_qty]" placeholder="Enter unit quantity. e.g. 2 spoon / 1 tab" class="form-control" type="text" id="PrescriptionUnitQty'+counter+'"><?php //echo $this->Form->input('', array('placeholder' => "Enter unit quantity. e.g. 2 spoon / 1 tab", 'class' => 'form-control', 'div' => false, 'label' => false)); ?></td>\n\
                    <td><input name="data[Prescription]['+counter+'][total_qty]" placeholder="Enter total quantity. e.g. 100 ml / 10 tabs" class="form-control" type="text" id="PrescriptionToatalQty'+counter+'"><?php // echo $this->Form->input('', array('placeholder' => "Enter total quantity. e.g. 100 ml / 10 tabs", 'class' => 'form-control', 'div' => false, 'label' => false)); ?></td></tr>\n\
                    <tr id="tra_' + counter + '">\n\
                    <td><input name="data[Prescription]['+counter+'][comments]" placeholder="Enter additional comment" class="form-control" type="text" id="PrescriptionComments'+counter+'"><?php // echo $this->Form->input('', array('placeholder' => "Enter additional comment", 'class' => 'form-control', 'div' => false, 'label' => false)); ?></td>\n\
                    <td class="text-center">\n\
                        <input type="checkbox" name="data[Prescription]['+counter+'][medicine_time][0]" value="mt_morning" checked="checked"> Morning &nbsp;\n\
                        <input type="checkbox" name="data[Prescription]['+counter+'][medicine_time][1]" value="mt_noon"> Afternoon &nbsp;\n\
                        <input type="checkbox" name="data[Prescription]['+counter+'][medicine_time][3]" value="mt_eve">  Evening &nbsp;\n\
                        <input type="checkbox" name="data[Prescription]['+counter+'][medicine_time][4]" value="mt_night" checked="checked"> Night &nbsp;</td>\n\
                    <td class="text-center">\n\
                        <input type="radio" name="data[Prescription]['+counter+'][after_meal]" id="medicine_time_0" value="0"> Before Meal &nbsp;\n\
                        <input type="radio" name="data[Prescription]['+counter+'][after_meal]" id="medicine_time_1" value="1"> After Meal </td>\n\
                    </tr>');
            $('#medicines_table').append(newRow);
            // after adding medicine row in modal height will be autoresized.
            $('.modal').css("overflow", "auto");
            var maxHeight = -1;
            $('.invoice').each(function () {
                maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
            });
            if ((maxHeight + 375) < $(document).height())
            {
                $('.modal-backdrop').css("height", $(document).height());
            }
            else
            {
                $('.modal-backdrop').css("height", maxHeight + 375);
            }
            //$('.modal').data('bs.modal').handleUpdate();
            counter++;
        });
        
    });
    function remove_medicine(key,id)
    {
        bootbox.confirm("Are you sure about to remove?", function (result) {
            if (result == true)
            { 
                if(id !== -1){
                    $.ajax({
                        dataType: "html",
                        type: "POST",
                        url: "<?php echo Router::url(array('controller'=>'appointments','action'=>'delete_drug'));?>",
                        data: {'id':id} ,
                        success: function (data, textStatus){
    //                        $("#div1").html(data);
                            console.log(data);
                        }
                    });
                }
                $("#tr_" + key).remove();
                $("#tra_" + key).remove();
            }
        });
        $('.modal').css("overflow", "auto");
        var maxHeight = -1;
        $('.invoice').each(function () {
            maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
        });
        if ((maxHeight + 375) < $(document).height())
        {
            $('.modal-backdrop').css("height", $(document).height());
        }
        else
        {
            $('.modal-backdrop').css("height", maxHeight + 375);
        }
        count++;
    }

</script>