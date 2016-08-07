<?=
$this->Html->css(array(
    'front_end/libs/bootstrap/css/bootstrap.min.css',
));
?>
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
             <div class="panel-body">
                <section class="panel">
                    <div class="panel-body invoice">
                        <div class="row invoice-to">
                            <div class="col-lg-8 pull-left">
                                <h4>
                                    <i>Rx, <?php print_r($services['User']['first_name']); ?> <?php print_r($services['User']['last_name']); ?></i>
                                </h4>
                            </div>
<!--                            <div class="col-lg-4 pull-right">
                                <?php echo $this->Html->link(__('<i class="fa fa-arrow-circle-left"></i> Back'), array('action' => 'add_drugs', $services['Appointment']['id']), array('escape' => false, 'class' => "pull-right btn btn-sm btn-success")); ?>
                            </div>-->
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
                                    <?php if(!empty($prescription)){ $i = 1;?>
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
                                                    <?php $times = array(); $times = $value['Prescription']['medicine_time']; ?>
                                                    <?php echo $this->Form->checkbox($key.'.medicine_time.0', array('value' => 'mt_morning', 'div' => false, 'label' => false, 'checked' => (in_array('mt_morning', $times) ? 'checked' : ''), 'disabled' => 'disabled')); ?> Morning &nbsp;
                                                    <?php echo $this->Form->checkbox($key.'.medicine_time.1', array('value' => 'mt_noon', 'div' => false, 'label' => false, 'checked' => (in_array('mt_noon', $times) ? 'checked' : ''), 'disabled' => 'disabled')); ?> Afternoon &nbsp;
                                                    <?php echo $this->Form->checkbox($key.'.medicine_time.2', array('value' => 'mt_eve', 'div' => false, 'label' => false, 'checked' => (in_array('mt_eve', $times) ? 'checked' : ''), 'disabled' => 'disabled')); ?> Evening &nbsp;
                                                    <?php echo $this->Form->checkbox($key.'.medicine_time.3', array('value' => 'mt_night', 'div' => false, 'label' => false, 'checked' => (in_array('mt_night', $times) ? 'checked' : ''), 'disabled' => 'disabled')); ?> Night &nbsp;
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $this->Form->radio($key.'.after_meal', array('0' => ' Before Meal', '1' => ' After Meal'), array('value' => $value['Prescription']['after_meal'], 'id' => 'after_meal_0', 'label' => false, 'legend' => false, 'separator' => ' &nbsp;&nbsp;', 'disabled' => 'disabled'));?>
                                                </td>
                                            </tr>  
                                        <?php $i++; } ?>
                                    <?php } else { ?>
                                        <tr id="tr_0" rowspan="10">
                                            <td class="text-center" >
                                                <p class="btn btn-danger" id="row_0" >No data available</p>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <?php if(!empty($prescription[0]['Prescription']['things_to_do'])){ ?>
                        <div class="row">
                            <div class="col-lg-3 payment-method">
                                <h4 class="pull-right">Things to do</h4>
                            </div>
                            <div class="col-lg-9 payment-method">
                                <?php echo $this->Form->input($i.'.things_to_do', array('value' => strip_tags($prescription[0]['Prescription']['things_to_do']), 'type' => 'textarea', 'placeholder' => "Add important instruction", 'rows' => '5', 'class' => 'ckeditor form-control', 'div' => false, 'label' => false)); ?>
                            </div>
                        </div>
                        <?php } ?>
                        <br>
                        <?php if(!empty($prescription)){ ?>
                        <div>
                        <a data-content="Report" data-placement="top" data-trigger="hover"  href="javascript:void(0);" onclick="myFunction()"  class="btn btn-info pull-right" target="_blank"><i class="fa fa-file-excel-o"></i> Print</a>
                        </div>
                        <?php } ?>
                    </div>
                </section>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    
     function myFunction() {
        window.print();
    }
</script>
<script type="text/javascript">
    var counter;
    var count = 0;
    $(document).ready(function () {
       CKEDITOR.config.readOnly = true;
   });

</script>