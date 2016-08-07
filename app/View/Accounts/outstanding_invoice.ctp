<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>

            </li>
            <li>
                <a class="current" href="">Outstanding</a>
            </li>
            <li class="pull-right">
                <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                Outstanding
            </header>
            <div class="panel-body">
                <div class="panel-body">
                <?= $this->Form->create('accounts', array('controller' => 'accounts', 'action' => 'manage_accounts'), array('id' => 'select_records', 'class' => 'form-horizontal', 'role' => 'form')); ?>
                    <div class="adv-table">
                        <table cellpadding="0" cellspacing="0" class="table table-bordered">
                            <?php $i = 1; 
                            if (count($users) > 0) { ?>
                                <tr>
                                    <th><input type="checkbox" name="selectall" id="selectall_id" onclick="checkall()"><span class="custom-checkbox"></span></th>
                                    <th><?php echo h('Doctor Name'); ?></th>
                                    <th><?php echo h('Total Patient'); ?></th>
                                    <th><?php echo h('Total Invoice Cost'); ?></th>
                                    <th><?php echo h('Commission'); ?></th>
                                    <th><?php echo h("Doctor's Income"); ?></th>
                                </tr>
                            <?php } ?>

                            <?php
                            if (count($users) > 0) {
                                foreach ($users as $user):
                                    ?>                  
                                    <tr>
                                        <td>
                                            <?php // echo $this->Form->input('userlist[]', array('id' => 'check'.$i, 'type' => 'checkbox', 'value' => $user['User']['id'], 'class' => 'form-control hidden', 'div' => false, 'label' => false)); ?>
                                            <input type="checkbox" name="userlist[]" class="check_select" id="check<?= $i; ?>" value="<?php echo $user['User']['id']; ?>"><span class="custom-checkbox"></span>
                                        </td>
                                        <td><?php echo ucwords($user['User']['full_name']); ?>&nbsp;</td>

                                        <td><?php echo h($patient_count[$user['User']['id']]); ?>&nbsp;</td>

                                        <td><?php echo h($save_prices[$user['User']['id']]); ?>&nbsp;</td>

                                        <td><?php echo h($total_commision[$user['User']['id']]); ?></td>
                                        <td><?php echo number_format($doctor_income[$user['User']['id']],2,'.',''); ?></td>
                                    </tr>
                                    <?php $i++;
                                endforeach;
                            } else {
                                ?>
                                <div class="alert alert-block alert-danger">
                                    <p><span class="alert-icon"><i class="fa fa-check"></i></span>&nbsp;No pending payments.</p>
                                </div>
                            <?php } ?>
                        </table>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php echo $this->Form->submit(__('Generate Invoices'), array('id' => 'generate_inv', 'class' => 'pull-right btn btn-primary')); ?>
                            </div>
                        </div>
                        <?= $this->Form->end(); ?>
                        <input type="hidden" name="count" id="count_id" value="<?php echo $i; ?>"/>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    function checkall()
    {
        var count = $('#count_id').val();
        var boxes = $('#selectall_id').is(':checked');

        if (boxes) {
            for (var i = 1; i <= count; i++)
            {
                var ctname = 'check' + i;
                $('#' + ctname).prop('checked', true);
            }
        } else
        {
            for (var i = 1; i <= count; i++)
            {
                var ctname = 'check' + i;
                $('#' + ctname).prop('checked', false);
            }
        }
    }
        
    $(document).ready(function () {
        $('#select_records').bValidator();
        
        $('#generate_inv').on('click', function(){
            var checked = $('input:checkbox:checked').length;
            var count = $('#count_id').val();
            if(checked < 1 || count == 0) {
                if(count == 0) {
                    alert('No records to generate Invoices.');
                    return false;
                }
                alert('Please select records');
                return false;
            }
        });
    });
</script>
<style>

</style>