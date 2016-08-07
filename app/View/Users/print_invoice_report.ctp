<?=
$this->Html->css(array(
    'front_end/libs/bootstrap/css/bootstrap.min.css',
));
?>
<div class="row">
    <div class="col-sm-offset-1 col-sm-10">
        <section class="panel">
            <br/>
            <header class="panel-heading">
                <strong><?php echo $salutations[$users['User']['salutation']]." ".$users['User']['full_name']; ?></strong><?php echo' - Report from '.($f_date == 0 ? 'beginning' : date("d-m-Y", strtotime($f_date))).' to '.date("d-m-Y", strtotime($l_date)); ?> 
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
                        <a id="print_page" data-content="Report" data-placement="top" data-trigger="hover"  href="javascript:void(0);" onclick="myFunction()"  class="btn btn-info pull-right" target="_blank"><i class="fa fa-file-excel-o"></i> Print</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    
     function myFunction() {
        window.print();
    }
</script>
<style> 
@media print {
    #print_page {
      display: none;
    }
}
</style>