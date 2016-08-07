<div class="col-sm-12">
    <ul class="breadcrumbs-alt">
        <li>
            <a href="javascript:void(0);">Dashboard</a>
        </li>
        <li>
            <a class="active-trail active" href="<?= Router::url(array('controller' => 'doctor_packages', 'action' => 'doctor_plans')) ?>">Plans</a>
        </li>
        <li>
            <a class="current" href="javascript:void(0);">Plan Details</a>
        </li>
        <li class="pull-right">
            <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
       </li>
    </ul>
    <section class="panel">
        <header class="panel-heading">
            <strong>Plan Name : </strong><?= $doctorPackage['DoctorPackage']['name']; ?>
            <?php if(AuthComponent::user('user_type')==2):?>
                        <button class="btn btn-sm btn-success pull-right" onclick="javascript:window.location = '<?= Router::url(array('controller' => 'doctor_packages', 'action' => 'pay_now',$doctorPackage['DoctorPackage']['id'])) ?>'" style="margin-top: -5px;"><i class="fa fa-money"></i> Buy Now</button>

            <?php endif;?>
        </header>
        <div class="panel-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td> <strong>Plan Details : </strong> <span id=""><?= $doctorPackage['DoctorPackage']['plan_details']; ?></span></td>
                    </tr>
                    <tr>
                        <td> <strong>Plan Price : </strong> <span id=""><?= $doctorPackage['DoctorPackage']['price']; ?></span></td>
                    </tr>
                    <tr>
                        <td> <strong>Percentage per visit : </strong> <span id=""><?= $doctorPackage['DoctorPackage']['percentage_per_visit']; ?></span></td>
                    </tr>
                    <tr>
                        <td> <strong>Plan Validity : </strong> <span id=""><?= $doctorPackage['DoctorPackage']['validity']; ?></span></td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </section>
</div>
