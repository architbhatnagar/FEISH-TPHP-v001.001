<div class="row">
    <div class="col-sm-12">
<!--        <ul class="breadcrumbs-alt">
            <li>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>
            </li>
            <li>
                <a class="" href="<?= Router::url(array('controller' => 'patient_package_logs', 'action' => 'invoice_report')) ?>">Invoice Reports</a>
            </li>
            <li>
                <a class="current" href="">Invoice Details</a>
            </li>
             <li class="pull-right">
                 <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>-->
        <section class="panel">
            <header class="panel-heading">
                <strong><?php echo $salutations[$users['User']['salutation']]." ".$users['User']['full_name']; ?></strong><?php echo' - Invoice Report from '.($f_date == 0 ? 'beginning' : date("d-m-Y", strtotime($f_date))).' to '.date("d-m-Y", strtotime($l_date)); ?> 
            </header>
            <div class="panel-body">
                <table cellpadding="0" cellspacing="0" class="table table-bordered">
                    <?php if(count($patient_details) > 0) { ?>
                        <tr>
                            <th><?php echo h('Patient Name'); ?></th>
                            <th><?php echo h('Plan Name'); ?></th>
                            <th><?php echo h('Plan Price'); ?></th>
                            <th><?php echo h('Commission'); ?></th>
                            <th><?php echo h("Doctor's Amount"); ?></th>
                        </tr>
                        <?php foreach ($patient_details as $value) {  ?>
                            <tr>
                                <td>
                                    <?php echo $value['User']['full_name']; ?>
                                </td>
                                <td> <?php echo $value['PatientPackageLog']['package_name']; ?> </td>
                                <td> <?php echo $value['PatientPackageLog']['price']; ?> </td>
                                <td> <?php echo $value['PatientPackageLog']['commission']; ?> </td>
                                <td><?php echo number_format(($value['PatientPackageLog']['price'] - $value['PatientPackageLog']['commission']),2,'.',''); ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <h3>No record found.</h3>
                    <?php } ?>   
                </table>
                <div class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-primary pull-right" id="print_page" href="<?= Router::url(array('controller' => 'users', 'action' => 'print_invoice_report',$user_id,$f_date,$l_date)) ?>"  target="_blank">Print</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
