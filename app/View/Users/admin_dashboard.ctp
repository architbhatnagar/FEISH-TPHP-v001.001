<div class="row">
    <div class="col-lg-12">
        <!--        <div class="alert alert-info">
                    <h2>Under Construction..........</h2>
                </div>-->
        <div class="panel-body">
            <div class="row">
                <!-- 1. all vounts blocks -->
                <div class="row">
                    <div class="col-md-3">
                        <section class="panel count-outer-secs">
                            <div class="panel-body" style="height: 13em;">
                                <div class="mini-stat clearfix">
                                    <span class="mini-stat-icon orange"><i class="fa fa-medkit"></i></span>
                                    <div class="mini-stat-info count-block">
                                        <span><?php echo $services_count; ?></span>
                                        Active Services
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-3">
                        <section class="panel count-outer-secs">
                            <div class="panel-body" style="height: 13em;">
                                <div class="mini-stat clearfix">
                                    <span class="mini-stat-icon tar"><i class="fa fa-user-md"></i></span>
                                    <div class="mini-stat-info count-block">
                                        <span><?php echo $doctors_count; ?></span>
                                        Total Doctors
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-3">
                        <section class="panel count-outer-secs">
                            <div class="panel-body" style="height: 13em;">
                                <div class="mini-stat clearfix">
                                    <span class="mini-stat-icon pink"><i class="fa fa-wheelchair"></i></span>
                                    <div class="mini-stat-info count-block">
                                        <span><?php echo $patients_count; ?></span>
                                        Total Internal Patients
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-3">
                        <section class="panel count-outer-secs">
                            <div class="panel-body" style="height: 13em;">
                                <div class="mini-stat clearfix">
                                    <span class="mini-stat-icon orange"><i class="fa fa-wheelchair"></i></span>
                                    <div class="mini-stat-info count-block">
                                        <span><?php echo $ext_patients_count; ?></span>
                                        Total External Patients
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <!--count blocks - end-->

        <!-- 2. daily appointment count-->
        <section class="panel">
            <div class="panel-heading">
                <div class="row">
                    <strong class="col-md-offset-4 col-md-3">Today's Total Appointments </strong>
                    <span class="col-md-1 label label-success" style="font-size: 100%;"><?= $app_count; ?></span>
                </div>
            </div>
        </section>


        <!-- 3. current month report-->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <strong>Invoice Report for <?php echo date('F Y'); ?></strong>
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <table class="table general-table">
                            <thead>
                                <tr>
                                    <th> Doctor's Name</th>
                                    <th>Total Patients</th>
                                    <th>Total Cost</th>
                                    <th>Commission</th>
                                    <th>Doctor's Income</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) { ?>
                                    <tr>
                                        <td rowspan="" style="vertical-align: middle;">
                                            <?= $user['User']['full_name']; ?>
                                        </td>
                                        <td rowspan="" style="vertical-align: middle;"><?= $patient_count[$user['User']['id']]; ?></td>
                                        <td><span class="label label-default"><?= $save_prices[$user['User']['id']]; ?></span></td>
                                        <td><span class="label label-danger"><?= $total_commision[$user['User']['id']]; ?></span></td>
                                        <td><span class="label label-success"><?= number_format($doctor_income[$user['User']['id']],2,'.',''); ?></span></td>
                                        <td rowspan="" style="vertical-align: middle;">
                                            <?php if($paid_flag[$user['User']['id']] == 0) { ?>
                                                <span class="label label-warning label-mini">Due</span>
                                            <?php } else { ?>
                                                <span class="label label-success label-mini">Paid</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<style>
    .count-block {
        font-size: 16px;
    }
    .count-outer-secs {
        box-shadow: 3px 3px 7px rgba(216, 216, 216, 0.34);
    }
</style>