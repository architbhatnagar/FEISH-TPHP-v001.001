<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-9 col-sm-9">
                            <div class="box last">
                                <div class="box-heading">Welcome, <?PHP echo Authcomponent::user('first_name'); ?>
                                    <div class="pull-right">
                                        <a href="/users/dashboard" class="btn btn-sm btn-success popovers home"><i class="fa fa-backward"></i> &nbsp;Home</a>
                                        <a class="btn btn-sm btn-success popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <ul class="breadcrumbs-alt">
                                        <li>
                                            <a href="<?= Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a>
                                        </li>
                                        <li>
                                            <a class="current" href="">Purchased Service Plans</a>
                                        </li>
                                    </ul>
                                    <?php
                                    if (!empty($package_list)) {
                                        ?>
                                        <div class="panel-body">
                                            <div class="row">
                                                <?php
                                                $i = 0;
                                                foreach ($package_list as $plan) {
                                                    ?>

                                                    <div class="col-lg-4 col-md-4">       
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-xs-12 col-md-12">
                                                                    <div class="panel panel-primary">
                                                                        <div class="panel-heading">
                                                                            <h3 class="panel-title">
                                                                                <?php echo $plan['PatientPackageLog']['package_name']; ?></h3>
                                                                        </div>
                                                                        <div class="panel-body">
                                                                            <div class="the-price">
                                                                                <h1>
                                                                                    <span class="subscript"><i class="fa fa-inr"></i></span>&nbsp;<?= $plan['PatientPackageLog']['price'] ?></h1>
                                                                                Validity:&nbsp;<small><?= $plan['PatientPackageLog']['validity'] ?>&nbsp;Days</small>
                                                                            </div>
                                                                            <?php $details = explode(',', $plan['PatientPackage']['plan_details']); ?>

                                                                            <?php /* foreach ($details as $dtl): ?>
                                                                              <li>
                                                                              <i class="fa fa-check"></i>
                                                                              <?= ucwords($dtl); ?>
                                                                              </li>
                                                                              <?php endforeach; */ ?>

                                                                            <li>
                                                                                <i class="fa fa-check"></i>
                                                                                <?php if (strlen($details[0]) <= 25) { ?>
                                                                                    <a title="" href="<?= Router::url(array('controller' => 'patient_plan_details', 'action' => 'view_plan', $plan['PatientPackageLog']['id'])) ?>">
                                                                                        <?php
                                                                                        echo stripslashes(strip_tags($details[0]));
                                                                                    } else {
                                                                                        ?>
                                                                                    </a>    
                                                                                    <a title="" href="<?= Router::url(array('controller' => 'patient_plan_details', 'action' => 'view_plan', $plan['PatientPackageLog']['id'])) ?>">  
                                                                                        <?php
                                                                                        echo substr(stripslashes((strip_tags($details[0]))), 0, 20) . '...';
                                                                                    }
                                                                                    ?>
                                                                                    </a>     
                                                                            </li>


                                                                            <div class="panel-footer">
                                                                                <a href="<?= Router::url(array('controller' => 'patient_plan_details', 'action' => 'view_plan', $plan['PatientPackageLog']['id'])) ?>" class="btn btn-danger" role="button">View</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <?php
                                                    $i++;
                                                    if ($i % 3 == 0) {
                                                        ?>
                                                        <div class="clearfix"></div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="alert alert-danger">
                                            <i class="fa fa-exclamation-circle mrl"></i>No records found
                                        </div>
                                    <?php } ?> 
                                </div>
                            </div>
                        </div>
                        <?= $this->element('front_layout_rightbar'); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>