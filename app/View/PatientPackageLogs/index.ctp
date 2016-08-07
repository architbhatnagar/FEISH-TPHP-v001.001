<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                 <a href="<?= Router::url(array('controller' => 'users', 'action' => 'assistant_dashboard')) ?>">Dashboard</a>
            </li>
            <li>
                <a class="current" href="">Subscriptions</a>
            </li>
             <li class="pull-right">
                 <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                List of Subscriptions
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" class="table table-bordered">
                        <?php if(count($patientPackageLogs) > 0) { ?>
                        <tr>
                            <th><?php echo $this->Paginator->sort('PatientPackage.name'); ?></th>
                            <th><?php echo $this->Paginator->sort('User.first_name', 'Patient Name'); ?></th>
                            <th><?php echo $this->Paginator->sort('start_date', 'Purchased_on'); ?></th>
                            <th><?php echo $this->Paginator->sort('end_date', 'Expires On'); ?></th>
                            <th><?php echo $this->Paginator->sort('email', 'Contact/Email'); ?></th>

                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                        <?php } ?>
                        
                        <?php if(count($patientPackageLogs) > 0) {
                        foreach ($patientPackageLogs as $patientPackageLog): ?>
                            <tr>
                                <td><?php echo h($patientPackageLog['PatientPackageLog']['package_name']); ?>&nbsp;</td>
                                <td><?php echo h($patientPackageLog['User']['first_name'] . " " . $patientPackageLog['User']['last_name']); ?>&nbsp;</td>
                                <td><?php echo date('d-M-Y',strtotime($patientPackageLog['PatientPackageLog']['start_date'])); ?>&nbsp;</td>
                                <td><?php echo date('d-M-Y',strtotime($patientPackageLog['PatientPackageLog']['end_date'])); ?>&nbsp;</td>
                                <td><?php echo h($patientPackageLog['User']['mobile'] . "/" . $patientPackageLog['User']['email']); ?>&nbsp;</td>

                                <td class="actions">
                                    <a class="btn btn-primary btn-xs no-upper popovers" target="_blank" href="<?= Router::url(array('controller'=>'patient_package_logs','action'=>'renew_plan',$patientPackageLog['PatientPackageLog']['id']))?>"> <i class="fa fa-mail-forward"></i> Send Alert</a>
                                    <a class="view_package_details btn btn-primary btn-xs no-upper popovers" data-toggle="modal" data-target="#view_details" curr_id="<?= $patientPackageLog['PatientPackageLog']['id'] ?>"> <i class="fa fa-eye"></i> View</a>                                </td>
                            </tr>
                        <?php endforeach; 
                        } else { ?>
                            <h3>No record found.</h3>
                        <?php } ?>   
                    </table>
                    
                    <?php if(count($patientPackageLogs) > 0) { ?>
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="dataTables_info" id="dynamic-table_info">
                                <?php
                                echo $this->Paginator->counter(array(
                                    'format' => __(' Showing {:current} records out of {:count}.')
                                ));
                                ?>

                            </div>
                           <div class="span6">
                                <div class="">
                                    <ul class="pagination pagination-sm  pull-right">
                                        <?php
                                        echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                                        echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
                                        echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                                        ?>                                                                          
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>  
        </section>

    </div>
</div>


<div id="Add_status" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Success</h4>
        </div> 
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-body">

                <div class="alert alert-success">
                    <h5>Alert mail has been send successfully</h5>
                </div>

            </div>
            <div class="modal-footer">
                <input type="submit" value="Ok" class="btn btn-outlined btn-primary" data-dismiss="modal">
            </div>
        </div>

    </div>
</div>
<div id="view_details" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Subscription Details</h4>
        </div> 
        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-body">

                <table class="table table-bordered">
                    <tr>
                        <td> <strong>Plan Name : </strong> <span id="plan_name"></span></td>
                    </tr>
                    <tr>
                        <td> <strong>Patient Name : </strong> <span id="patient_name"></span></td>
                    </tr>
                    <tr>
                        <td> <strong>Service Name : </strong> <span id="service_name"></span></td>
                    </tr>
                    <tr>
                        <td> <strong>Plan Type : </strong> <span id="plan_type"></span></td>
                    </tr>
                    <tr>
                        <td> <strong>Paid Amount : </strong>  <span id="paid_amt"></span></td>
                    </tr>
                    <tr>
                        <td> <strong>Plan Validity : </strong> <span id="validity"></span> </td>
                    </tr>
                    <tr>
                        <td> <strong>Purchased On : </strong>  <span id="purchased_on"></span></td>
                    </tr>
                    <tr>
                        <td> <strong>Expires On : </strong> <span id="exp_on"></span></td>
                    </tr>
                    <tr>
                        <td> <strong>Patient Contact : </strong> <span id="contact"></span></td>
                    </tr>
                </table>

            </div>
            <div class="modal-footer">
                <input type="submit" value="Ok" class="btn btn-outlined btn-primary" data-dismiss="modal">
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".view_package_details").click(function () {
            var package_id = $(this).attr('curr_id');
            var base_path = "<?= Router::url('/', true) ?>";
            var urls_remove = base_path + "patient_package_logs/get_details";
            $.ajax({
                url: urls_remove,
                type: "POST",
                data: {id: package_id},
                dataType: 'json'
            }).done(function (res_data) {
               // alert(res_data['PatientPackageLog']['package_name']);
                $("#plan_name").text(res_data['PatientPackageLog']['package_name']);
                $("#patient_name").text(res_data['User']['salutation']+". "+res_data['User']['first_name']+" "+res_data['User']['last_name']);
                $("#service_name").text(res_data['Service']['title']);
                $("#plan_type").text(res_data['PatientPackageLog']['plan_type']);
                $("#paid_amt").text(res_data['PatientPackageLog']['price']);
                $("#validity").text(res_data['PatientPackageLog']['validity']);
                $("#purchased_on").text(res_data['PatientPackageLog']['start_date']);
                $("#exp_on").text(res_data['PatientPackageLog']['end_date']);
                $("#contact").text(res_data['User']['mobile']+" / "+res_data['User']['email']); 
            });
        });
    });
</script>