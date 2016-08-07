<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>

            </li>
            <li>
                <a class="current" href="">Invoices</a>
            </li>
            <li class="pull-right">
                <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                <strong>Invoices</strong>
            </header>
            <div class="panel-body">

                <div class="panel-body">
                    <div class="adv-table">
                        <table cellpadding="0" cellspacing="0" class="table table-bordered">
                            <?php if (count($accounts) > 0) { ?>
                                <tr>
                                    <th><?php echo h('Doctor Name'); ?></th>
                                    <th><?php echo h('Total Patient'); ?></th>
                                    <th><?php echo h('Total Invoice Cost'); ?></th>
                                    <th><?php echo h('Commission'); ?></th>
                                    <th><?php echo h("Doctor's Income"); ?></th>
                                    <th><?php echo h("Invoice Date"); ?></th>
                                    <th class="actions"><?php echo __('Actions'); ?></th>
                                </tr>
                            <?php } ?>

                            <?php
                            if (count($accounts) > 0) {
                                foreach ($accounts as $account):
                                    ?>                  
                                    <tr>
                                        <td><?php echo h($account['User']['full_name']); ?>&nbsp; </td>
                                        <td><?php echo h($account['Account']['patient_count']); ?>&nbsp;</td>
                                        <td><?php echo h($account['Account']['total_cost']); ?>&nbsp;</td>
                                        <td><?php echo h($account['Account']['commission']); ?>&nbsp;</td>
                                        <td><?php echo number_format($account['Account']['dr_income_cost'],2,'.',''); ?>&nbsp;</td>
                                        <td><?php echo date("d M Y", strtotime($account['Account']['invoice_date'])); ?>&nbsp;</td>
                                        <td>
                                            <?php if($account['Account']['paid_flag'] == 0) {
                                                echo $this->Html->link(__('Pay'), array('controller' => 'accounts', 'action' => 'payment_process', $account['Account']['id'],$account['User']['id']), array('class' => 'btn btn-xs btn-warning popovers', 'data-content' => 'pay', 'data-placement' => 'bottom', 'data-trigger' => 'hover'), __('Are you sure you want to Pay?'));  
                                            } else {?>
                                                <span class="label label-success">Paid</span>
                                            <?php } ?>
                                    </tr>
                                    <?php
                                endforeach;
                            } else {
                                ?>
                                <div class="alert alert-block alert-danger">
                                    <p><span class="alert-icon"><i class="fa fa-check"></i></span>&nbsp;No invoices generated.</p>
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