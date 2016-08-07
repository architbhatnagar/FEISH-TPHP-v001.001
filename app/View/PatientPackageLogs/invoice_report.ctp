<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>

            </li>
            <li>
                <a class="current" href="">Invoice Reports</a>
            </li>
            <li class="pull-right">
                <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                Invoice Reports
            </header>
            <div class="panel-body">
                <?= $this->Form->create('PatientPackageLog', array('action' => 'invoice_report'), array('id' => 'fill_dates', 'class' => 'form-horizontal', 'role' => 'form')); ?>
                <div id="container">
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label class="col-sm-4 control-label text-right">Doctor :</label>
                            <div class="row">
                                <div class="col-sm-7">
                                    <?php echo $this->Form->input('dr_name', array('empty' =>'--select doctor--', 'options' => $dr_list, 'id' => 'dr_name', 'data-bvalidator' => 'required', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                </div>
                            </div>
                        </div>                       
                        <div class="col-sm-3 form-group">
                            <label class="col-sm-4 control-label text-right">From :</label>
                            <div class="row">
                                <div class="col-sm-7">
                                    <?php echo $this->Form->input('from_date', array('type' => 'text', 'placeholder' => "DD/MM/YYYY", 'id' => 'from_date', 'data-bvalidator' => 'required', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                </div>
                            </div>
                        </div>                       
                        <div class="col-sm-3 form-group">
                            <label class="col-sm-4 control-label text-right" >To :</label> 
                            <div class="row">
                                <div class="col-sm-7">
                                    <?php echo $this->Form->input('to_date', array('type' => 'text', 'id' => 'to_date', 'placeholder' => "DD/MM/YYYY", 'data-bvalidator' => 'required', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                </div>
                            </div>
                        </div> 
                        <div class="col-sm-2 form-group">
                            <div class="row">
                                <div class="col-sm-offset-2 col-sm-2">
                                    <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-primary btn-md', 'id' => 'get_results')); ?>
                                </div>                       
                            </div>
                        </div>   
                    </div>
                </div>
                <?= $this->Form->end(); ?>
                <div class="panel-body">
                    <div class="adv-table">
                        <table cellpadding="0" cellspacing="0" class="table table-bordered">
                            <?php if (count($users) > 0) { ?>
                                <tr>
                                    <th><?php echo h('Doctor Name'); ?></th>
                                    <th><?php echo h('Total Patient'); ?></th>

                                    <th><?php echo h('Total Invoice Cost'); ?></th>
                                    <th><?php echo h('Commission'); ?></th>
                                    <th><?php echo h("Doctor's Income"); ?></th>
                                    <th class="actions"><?php echo __('Actions'); ?></th>
                                </tr>
                            <?php } ?>

                            <?php
                            if (count($users) > 0) {
                                foreach ($users as $user):
                                    ?>                  
                                    <tr>
                                        <td><?php echo ucwords($user['User']['full_name']); ?>&nbsp;</td>

                                        <td><?php echo h($patient_count[$user['User']['id']]); ?>&nbsp;</td>

                                        <td><?php echo number_format($save_prices[$user['User']['id']],2,'.','' ); ?>&nbsp;</td>

                                        <td><?php echo number_format($total_commision[$user['User']['id']],2,'.',''); ?></td>
                                        <td><?php echo number_format($doctor_income[$user['User']['id']],2,'.',''); ?></td>
                                        <td class="actions">
                                            <?php if($patient_count[$user['User']['id']]>0){ 
                                                if($f_date != '') { $f_date = date("Y-m-d", strtotime(str_replace('/', '-', $f_date))); } else { $f_date = '0'; }
                                                if($l_date != '') { $l_date = date("Y-m-d", strtotime(str_replace('/', '-', $l_date))); } else { $l_date = '0'; }
                                                echo $this->Html->link(__(''), array('controller' => 'users', 'action' => 'view_invoice_report', $user['User']['id'], $f_date, $l_date), array('target' => '_blank','class' => 'btn btn-sm btn-primary fa fa-eye popovers', 'data-content' => 'View', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); 
                                            }?>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            } else {
                                ?>
                                <div class="alert alert-block alert-danger">
                                    <p><span class="alert-icon"><i class="fa fa-check"></i></span>&nbsp;No patients for this Doctor.</p>
                                </div>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#fill_dates').bValidator();
        $('#to_date').datepicker({
            changeMonth: true,
            changeYear: true,
            maxDate: "NOW",
            autoclose: true,
            dateFormat: "dd/mm/yy"
        });

        $('#from_date').datepicker({
            changeMonth: true,
            changeYear: true,
            maxDate: "NOW",
            dateFormat: "dd/mm/yy",
            onSelect: function (dt, dt_obj) {
                var minDate = $(this).datepicker('getDate');
//                    alert(minDate);
                $('#to_date').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "dd/mm/yy",
                });
                $("#to_date").datepicker("option", "minDate", minDate);
            }
        });
    });
</script>
<style>
    .ui-datepicker-year, .ui-datepicker-year option {
        color: black;
    }
    .ui-datepicker-month, .ui-datepicker-month option {
        color: black;
    }
</style>