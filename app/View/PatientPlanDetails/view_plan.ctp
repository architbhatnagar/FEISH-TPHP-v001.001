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
                                            <a href="<?= Router::url(array('controller' => 'patient_plan_details', 'action' => 'purchased_plans')) ?>">Puchased Service Plans</a>
                                        </li>
                                        <li>
                                            <a class="current" href=""><?php echo $package_detail['PatientPackage']['name']; ?></a>
                                        </li>
                                    </ul>
                                    <?php
                                    if(!empty($package_detail))
                                    {    

                                        ?>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table class="table mbn">
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Plan Name</strong></td>
                                                                <td><?PHP echo $package_detail['PatientPackage']['name']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Price</strong></td>
                                                                <td><?PHP echo $package_detail['PatientPackage']['price']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Service Name</strong></td>
                                                                <td class="service_title"><a href="#"><?PHP echo $package_detail['Service']['title']; ?></a></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Validity</strong></td>
                                                                <td><?PHP echo $package_detail['PatientPackage']['validity']." days"; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Valid Visits</strong></td>
                                                                <td><?PHP echo $package_detail['PatientPackage']['valid_visits']; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                    <table class="table mbn">
                                                        <tbody>
                                                            <tr>
                                                                <td><strong>Customer Name</strong></td>
                                                                <td><?PHP echo Authcomponent::user('first_name'); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Plan Start Date</strong></td>
                                                                <td><?PHP echo date('d-M-Y',strtotime($package_detail['PatientPackageLog']['start_date'])); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Plan End Date</strong></td>
                                                                <td><?PHP echo date('d-M-Y',strtotime($package_detail['PatientPackageLog']['end_date'])); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>Plan Status</strong></td>
                                                                <td><?php
                                                                if($package_detail['PatientPackageLog']['is_active'] == 1 && ($package_detail['PatientPackageLog']['end_date'] > date('Y-m-d') || $package_detail['PatientPackageLog']['remaining_visits'] > 0))
                                                                {
                                                                    echo "<b style='color:#449d44;'>Active</b>";
                                                                }
                                                                else
                                                                {
                                                                    if($package_detail['PatientPackageLog']['is_active'] == 1) {
                                                                        echo "<b style='color:#f85b5b;'>Expired</b>"; 
                                                                    ?> 
                                                                        <a style="float: right" href="<?= Router::url(array('controller' => 'patient_packages', 'action' => 'view', $package_detail['PatientPackageLog']['patient_package_id'], $package_detail['PatientPackageLog']['service_id'])); ?>" class="btn btn-xs btn-success center-block" role="button">Buy Now</a>
                                                                    <?php } else {
                                                                        echo "<b style='color:#f85b5b;'>This plan has been deactivated by Doctor. Please purchase another plan.</b>"; 
                                                                    }
                                                                }
                                                                ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
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
