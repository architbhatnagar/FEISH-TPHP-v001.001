<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="#">Dashboard</a>
            </li>
            <li>
                <a class="active-trail active" href="#">Patients</a>
            </li>
            <li>
                <a class="current" href="">Patient Details</a>
            </li>
             <li class="pull-right">
                 <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <div class="twt-feed turquoise-theme">
                <div class="col-md-4">
                    <a>
                        <?php if (!empty($this->request->data['User']['avatar'])) { ?>
                            <?= $this->Html->image('patient/files/' . $this->request->data['User']['avatar'], array('alt' => '')); ?>
                            <?php
                        } else {
                            if ($user['User']['sex'] == "male") {
                                ?>
                                <?= $this->Html->image('patient/files/patient-male.png', array('class' => 'img-responsive', 'alt' => '')) ?>
                                <?php
                            } else {
                                ?>
                                <?= $this->Html->image('patient/files/patient-female.png', array('class' => 'img-responsive', 'alt' => '')) ?>
                                <?php
                            }
                        }
                        ?>
                    </a>
                    <h1><?= ucwords($salutations[$user['User']['salutation']] . " " . $user['User']['first_name'] . " " . $user['User']['last_name']) ?></h1>
                    <p><?= $user['User']['email']; ?></p>
                </div>
                <div class="col-md-4">
                    <p> <i class="fa fa-envelope-o"></i> <b>Email</b> : <?= $user['User']['email'] ?></p>
                    <p> <i class="fa fa-tasks"></i> <b>Registered On</b> : <?= date('d-M-y', strtotime($user['User']['created'])); ?></p>
                    <p> <i class="fa fa-mobile"></i> <b>Mobile</b> : <?= $user['User']['mobile'] ?></p>
                </div>
                <div class="col-md-4">
                    <p><b>Last logged in on</b> : </p>
                    <p><?= date('d-M-y h:i a', strtotime($last_login['LoginDetail']['created'])); ?></p>
                </div>
            </div>
        </section>
    </div>
    <div class="col-sm-12">

        <div class=" col-sm-12 ">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 bhoechie-tab-menu">
                <div class="list-group">
                    <a href="<?= Router::url(array('controller' => 'users', 'action' => 'patient_details', $user['User']['id'], $user['User']['user_type'], 'patients_index_for_doctor')) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-plane"></h4><br>Health Profile
                    </a>
                    <a href="<?= Router::url(array('controller' => 'users', 'action' => 'patient_purchased_plan', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-road"></h4><br>Purchased Plans
                    </a>
                    <a href="<?= Router::url(array('controller' => 'users', 'action' => 'patient_vital_signs', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-home"></h4><br>Vital Signs
                    </a>
                    <a href="<?= Router::url(array('controller' => 'users', 'action' => 'patient_test_results', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-cutlery"></h4><br>Test Results
                    </a>
                    <a href="<?= Router::url(array('controller' => 'users', 'action' => 'patient_medical_history', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-credit-card"></h4><br>Medical History
                    </a>
                    <a href="<?= Router::url(array('controller' => 'users', 'action' => 'patient_family_history', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item  text-center">
                        <h4 class="glyphicon glyphicon-plane"></h4><br>Family History
                    </a>
                    <a href="<?= Router::url(array('controller' => 'users', 'action' => 'patient_diet_plan', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item active text-center">
                        <h4 class="glyphicon glyphicon-road"></h4><br>Diet Plan
                    </a>
                    <a href="<?= Router::url(array('controller' => 'users', 'action' => 'patient_treatments', $user['User']['id'], $user['User']['user_type'])) ?>" class="list-group-item  text-center">
                        <h4 class="glyphicon glyphicon-home"></h4><br> Treatments
                    </a>
                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">

                <div class="bhoechie-tab-content">
                    <section class="panel">
                        <header class="panel-heading">
                            Diet Plan

                        </header>
                        <div class="panel-body">


                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Plan Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>

                                        <!--<th>Actions</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($diet_plan_arr) > 0) {
                                        foreach ($diet_plan_arr as $diet_plan) :
                                            ?>
                                            <tr>
                                                    <td><?= $diet_plan['DietPlan']['plan_name']; ?></td>
                                                    <td><?= date('d M Y', strtotime($diet_plan['DietPlan']['start_date'])); ?></td>
                                                    <td><?= date('d M Y', strtotime($diet_plan['DietPlan']['end_date'])); ?></td>
<!--                                                    <td>
                                                        <a href="javascript:void(0);" onclick="showDietDetails('<?= $diet_plan['DietPlan']['id'] ?>')" class="btn btn-warning btn-xs" title="View"><i class="fa fa-search"></i></a>
                                                        <a href="<?= Router::url(array('controller' => 'diet_plans', 'action' => 'edit', $diet_plan['DietPlan']['id'])) ?>" class="btn btn-primary btn-xs" title="View"><i class="fa fa-edit"></i></a>
                                                    </td>-->
                                                </tr>
                                            <?php
                                        endforeach;
                                    } else {
                                        ?>
                                    <h3>No Record Found.</h3>
                                <?php } ?>

                                </tbody>
                            </table>


                            <div class="more">
                                <div class="row-fluid"><div class="span6"><div class="dataTables_info" id="dynamic-table_info">Showing 1 to 8 of 8 entries</div></div><div class="span6"><div class="dataTables_paginate paging_bootstrap pagination"><ul><li class="prev disabled"><a href="#">← Previous</a></li><li class="active"><a href="#">1</a></li><li class="next disabled"><a href="#">Next → </a></li></ul></div></div></div>

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </section>
                </div>
                <!--<div class="bhoechie-tab-content">
                    <section class="panel">
                        <header class="panel-heading">
                            Diet Plans 

                        </header>
                        <div class="panel-body">


                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Plan Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Test1</td>
                                        <td>3rd December 1015</td>
                                        <td>3rd January 2016</td>

                                    </tr>
                                    <tr>
                                        <td>Test2</td>
                                        <td>3rd December 1015</td>
                                        <td>3rd January 2016</td>


                                    </tr>
                                    <tr>
                                        <td>Test3</td>
                                        <td>3rd December 1015</td>
                                        <td>3rd January 2016</td>


                                    </tr>


                                </tbody>
                            </table>

                            <div class="more">
                                <div class="row-fluid"><div class="span6"><div class="dataTables_info" id="dynamic-table_info">Showing 1 to 8 of 8 entries</div></div><div class="span6"><div class="dataTables_paginate paging_bootstrap pagination"><ul><li class="prev disabled"><a href="#">← Previous</a></li><li class="active"><a href="#">1</a></li><li class="next disabled"><a href="#">Next → </a></li></ul></div></div></div>

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="bhoechie-tab-content">

                </div>-->
            </div>
        </div>





    </div>

    <!-- tabs left -->

    <!-- /tabs -->


</div>
<script type="text/javascript">
    $(document).ready(function () {
//        $("div.bhoechie-tab-menu>div.list-group>a").click(function (e) {
//            e.preventDefault();
//            $(this).siblings('a.active').removeClass("active");
//            $(this).addClass("active");
//            var index = $(this).index();
//            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
//            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
//        });
    });
</script>

<style type="text/css">
    [contenteditable=true]:empty:before {
        content: attr(placeholder);
        display: block; /* For Firefox */
    }
    @media (min-width:768px){
        .modal-dialog {
            width: 80% !important;
        }
        .bootbox .modal-dialog {
            width: 40% !important;
        }
    }
    .invoice-title a img {
        height: 90px;
        width: 90px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        border: 5px solid rgba(241,242,247,0.5);
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
    }
    .modal-content .panel {
        padding-top: 10px;
    }
    .tab-content {
        margin-top: 30px;
    }
    .stepwizard-step p {
        margin-top: 10px;
    }
    .stepwizard-row {
        display: table-row;
    }
    .stepwizard {
        display: table;
        width: 100%;
        margin-top: 25px;
        position: relative;
    }
    .stepwizard-row:before {
        top: 100px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 2px;
        background-color: #ccc;
        z-order: 0;
    }
    .stepwizard-row .active:after {
        content: " ";
        position: absolute;
        left: 40%;
        top: 101px;
        padding-bottom: 10px;
        opacity:1;
        margin: 0 auto;
        bottom: 0px;
        border: 10px solid transparent;
        border-top-color: #ccc;
    }
    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
        text-decoration: none;
        background-color: #eee;
        margin-left: 75px;
        margin-right: 75px;
    }
    .stepwizard-step i {
        font-size: 25px;
    }
    .btn-circle {
        width: 50px;
        height: 50px;
        text-align: center;
        padding: 6px 0;
        font-size: 25px;
        line-height: 1.428571429;
        border-radius: 25px;
    }
    @media( max-width : 1340px ){
        .stepwizard-step {
            margin-left: 30px !important;
            margin-right: 30px !important;
        }
    }
    @media( max-width : 1075px ){
        .stepwizard-step {
            margin-left: 10px !important;
            margin-right: 10px !important;
        }
    }
    @media( max-width : 825px ){
        .stepwizard-step {
            margin-left: 2px !important;
            margin-right: 0px !important;
        }
        .stepwizard-row:before {
            background-color: #fff !important;
        }
    }


    div.bhoechie-tab-container{
        z-index: 10;
        background-color: #ffffff;
        padding: 0 !important;
        border-radius: 4px;
        -moz-border-radius: 4px;
        border:1px solid #ddd;

        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
        -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        background-clip: padding-box;
        opacity: 0.97;
        filter: alpha(opacity=97);
    }
    div.bhoechie-tab-menu{
        padding-right: 0;
        padding-left: 0;
        padding-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group{
        margin-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group>a{
        margin-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group>a .glyphicon,
    div.bhoechie-tab-menu div.list-group>a .fa {
        color: #1FB5AD;
    }
    div.bhoechie-tab-menu div.list-group>a:first-child{
        border-top-right-radius: 0;
        -moz-border-top-right-radius: 0;
    }
    div.bhoechie-tab-menu div.list-group>a:last-child{
        border-bottom-right-radius: 0;
        -moz-border-bottom-right-radius: 0;
    }
    div.bhoechie-tab-menu div.list-group>a.active,
    div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
    div.bhoechie-tab-menu div.list-group>a.active .fa{
        background-color: #1FB5AD;
        background-image: #1FB5AD;
        color: #ffffff;
    }
    div.bhoechie-tab-menu div.list-group>a.active:after{
        content: '';
        position: absolute;
        left: 100%;
        top: 50%;
        margin-top: -13px;
        border-left: 0;
        border-bottom: 13px solid transparent;
        border-top: 13px solid transparent;
        border-left: 10px solid #1FB5AD;
    }

    div.bhoechie-tab-content{
        background-color: #ffffff;
        /* border: 1px solid #eeeeee; */
        padding-left: 20px;
        padding-top: 10px;
    }

    div.bhoechie-tab div.bhoechie-tab-content:not(.active){
        display: none;
    }
    .panel-body{
        background-color: #F2F4F4 !important;
    }
    table{
        background-color: #FFF;
    }

</style>