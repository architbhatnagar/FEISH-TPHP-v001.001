<div class="header-bg-wrapper">
    <div id="header-bg">
        <div class="container">
            <div class="header-bg-content">
                <h2 class="title"><?= ucwords($patientPackage['PatientPackage']['name']); ?></h2>
                <ol class="breadcrumb"><li><a href="">Package Details</a></li><li class="active"><?= ucwords($patientPackage['PatientPackage']['name']); ?></li></ol>
            </div>

        </div>

    </div>

</div>
<?php echo $this->Session->flash(); ?>
<div id="main">
    <!-- CONTENT-->
    <div id="content">
        <div id="section-services-detail" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row">

                    </div>
                    <div style="padding-bottom: 70px" class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="pull-right">
                                    <a href="/users/dashboard" class="btn btn-sm btn-success popovers home"><i class="fa fa-backward"></i> &nbsp;Home</a>
                                    <a class="btn btn-sm btn-success popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
                                </div>

                                <div class="col-lg-9">
                                    <div class="box">
                                        <div class="box-heading"><?= ucwords($patientPackage['PatientPackage']['name']); ?> For Service <?= ucwords($patientPackage['Service']['title']) ?></div>
                                        <div class="box-body">
                                            <div class="the-price">
                                                <h1>
                                                    <span class="subscript"><i class="fa fa-inr"></i></span>&nbsp;<?= $patientPackage['PatientPackage']['price'] ?></h1>
                                                Validity:&nbsp;<?= $patientPackage['PatientPackage']['validity'] ?>&nbsp;Days
                                            </div>
                                            <p>Valid Visits : <?= $patientPackage['PatientPackage']['valid_visits'] ?></p>
                                            <p>Plan Type : <?= $plan_types[$patientPackage['PatientPackage']['plan_type']] ?></p>
                                            <p>
                                                <?php $details = explode(',', $patientPackage['PatientPackage']['plan_details']); ?>
                                                <?php foreach ($details as $dtl): ?>
                                                <li><i class="fa fa-check"></i><?= ucwords($dtl); ?></li>
                                            <?php endforeach; ?>
                                            </p>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row top-buffer">
                                                        <div class="col-md-12">
                                                            <?php if ($purchased_flag) { ?>
                                                                <a href="<?= Router::url(array('controller' => 'patient_packages', 'action' => 'pay_now', $patientPackage['PatientPackage']['id'], $service_id)) ?>" class="btn btn-success" role="button">Buy Now</a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?= $this->element('front_layout_rightbar'); ?>
                    </div>
                    <?= $this->Html->css(array('front_end/pages/services_detail.css', 'front_end/pages/our_team.css')); ?>
