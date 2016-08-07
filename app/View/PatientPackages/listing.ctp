
<div class="row">
    <div class="col-lg-12">
        <div class="box" style="margin-top:100px">
            <div class="box-heading">Service Plans</div>
            <div class="box-body">
                <div class="row">

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php foreach ($patientPackages as $package): ?>
                                    <div class="col-xs-12 col-md-3 col-lg-3 col-sm-3">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">
                                                    <?= ucwords($package['PatientPackage']['name']); ?></h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="the-price">
                                                    <h1>
                                                        <span class="subscript"><i class="fa fa-inr"></i></span>&nbsp;<?= $package['PatientPackage']['price'] ?></h1>
                                                    Validity:&nbsp;<small><?= $package['PatientPackage']['validity'] ?>&nbsp;Days</small>
                                                </div>
                                                <?= $package['PatientPackage']['plan_details']; ?>
                                                <div class="panel-footer">
                                                    <a href="<?= Router::url(array('controller'=>'patient_packages','action'=>'view',$package['PatientPackage']['id']))?>" class="btn btn-success" role="button">Buy Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>


                        </div>






                    </div>
                </div>
            </div>
        </div>
    </div>
</div>