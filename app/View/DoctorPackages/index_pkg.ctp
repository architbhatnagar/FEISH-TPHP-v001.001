<script>
    $(document).ready(function () {
        $('.test').collapse("hide");
    });

</script>    
<div class="col-sm-12">
    <ul class="breadcrumbs-alt">
        <li>
            <a href="/feish/users/doctors_dashboard/">Dashboard</a>
        </li>
        <li>
            <a class="current" href="#">Plans</a>
        </li>
        <li class="pull-right">
            <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
        </li>

    </ul>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
        $flag1 = 0;
        $flag2 = 0;
        ?>            
        <div class="panel panel-default">
            <section class="panel">
                <header class="panel-heading">
                    <a><b>Plans </b></a>
                    <button class="btn btn-danger pull-right" onclick="javascript:window.location = '<?= Router::url(array('controller' => 'doctor_packages', 'action' => 'add_pkg')) ?>'"><i class="fa fa-money"></i> Add New Plan</button>
                   
                </header>
                <div style="height: 0px;" aria-expanded="false" id="collapse_0" class="panel-collapse collapse test">
                    <div class="panel">
                        <div class="panel-body">
                            <?php
                            if (count($plans) > 0) {
                                foreach ($plans as $plan) :
                                    $flag2 ++;
                                    ?>
                                    <div class="col-lg-3 col-sm-3">
                                        <div class="pricing-table most-popular">
                                            <div class="pricing-head">

                                                <h1><?= $plan['DoctorPackage']['name'] ?></h1>
                                            </div>
                                            <div class="pricing-quote">
                                                <i class="fa fa-inr"></i> <?= $plan['DoctorPackage']['price'] ?>                                                                 
                                                <p><?= $plan['DoctorPackage']['validity'] ?>&nbsp;Days</p>
                                            </div>
                                            <ul class="list-unstyled">
                                                <?php $plan_details = explode(',', $plan['DoctorPackage']['plan_details']); ?>
                                                <?php
//                                                        foreach ($plan_details as $value) :
                                                ?>
                                                <li>
                                                    <i class="fa fa-check"></i>
                                                    <?php if (strlen($plan_details[0]) <= 25) { ?>
                                                        <a title="View" href="javascript:void(0);" onclick="viewPlanDetails('<?= $plan['DoctorPackage']['id']; ?>');">
                                                            <?php
                                                            echo stripslashes(strip_tags($plan_details[0]));
                                                        } else {
                                                            ?>
                                                        </a>    
                                                        <a title="View" href="javascript:void(0);" onclick="viewPlanDetails('<?= $plan['DoctorPackage']['id']; ?>');">  
                                                            <?php
                                                            echo substr(stripslashes((strip_tags($plan_details[0]))), 0, 20) . '...';
                                                        }
                                                        ?>
                                                    </a>
                                                </li>
                                                <?php //                                                            endforeach;   ?> 

                                            </ul>
                                            <div class="price-actions">
                                                <a href="<?= Router::url(array('controller' => 'doctor_packages', 'action' => 'view', $plan['DoctorPackage']['id'])); ?>" class="btn">View</a>
                                                <a href="<?= Router::url(array('controller' => 'doctor_packages', 'action' => 'edit_pkg', $plan['DoctorPackage']['id'])); ?>" class="btn">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endforeach;
                            }
                            ?>

                            <?php
                            if ($flag1 != $flag2) {
                                $flag2 = 0;
                            } else {
                                ?>
                                <div class="alert alert-block alert-danger">
                                    <p><span class="alert-icon"><i class="fa fa-check"></i></span>&nbsp;No records found.</p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="modal fade" id="view_plan_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="margin-top: 120px;width: 500px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">View Details</h4>
            </div>
            <div class="" id="appened_lab_test_view">
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="hideModal()">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script>

    var myBaseUrl = '<?php echo Router::url('/', true) ?>';

    function viewPlanDetails(id) {

        $.ajax({
            type: "POST",
            url: myBaseUrl + "doctor_packages/view_paln_details",
            data: {id: id},
            dataType: "html",
            success: function (data)
            {

                if (data != '')
                {
                    $("#appened_lab_test_view").html(data);
                    $("#view_plan_details").modal({backdrop: "static"});
                    $('#view_plan_details').modal('show');

                }
            }
        });
    }

    function hideModal() {
        $('#view_plan_details').modal('hide');
    }
</script>