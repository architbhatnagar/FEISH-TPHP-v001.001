
<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                   
                    <div class="row ">
                        <div class="col-md-9 col-sm-9">
                            <div class="box last">
                                <div class="box-heading">Welcome, <?PHP echo AuthComponent::user('first_name').' '.Authcomponent::user('last_name'); ?>&nbsp;&nbsp;&nbsp;
                                    <a class="btn btn-sm btn-info" href="<?= Router::url(array('controller' => 'users', 'action' => 'profile')) ?>">Edit Profile</a>
                                    <a class="btn btn-sm btn-success pull-right popovers"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a></div>
                                <div class="box-body">

                                    <div class="row">
                                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6 block-design">
                                            <a href="<?= Router::url(array('controller'=>'patient_habits','action'=>'health_profile'))?>" class="style_prevu_kit">
                                                <?= $this->Html->image('medical-icons/general.png',array('class'=>'img-responsive  zoom-hover image_bg','alt'=>''))?>
                                                <p class=" box-heading box-headingx">
                                                    Health Profile
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6 block-design">
                                            <a href="<?= Router::url(array('controller'=>'patient_plan_details','action'=>'purchased_plans'))?>" class="style_prevu_kit">
                                                <?= $this->Html->image('medical-icons/emailing_system.png',array('class'=>'img-responsive  zoom-hover image_bg','alt'=>''))?>
                                                <p class=" box-heading box-headingx">
                                                    Purchased Plans
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6 block-design"> 
                                            <a href="<?= Router::url(array('controller'=>'appointments','action'=>'view_all'))?>" class="style_prevu_kit">
                                                <?= $this->Html->image('medical-icons/treatment_status.png',array('class'=>'img-responsive  zoom-hover image_bg','alt'=>''))?>
                                                <p class=" box-heading box-headingx">
                                                    Visits & Reports
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6 block-design"> 
                                            <a href="<?= Router::url(array('controller'=>'services','action'=>'services_listing'))?>" class="style_prevu_kit">
                                                <?= $this->Html->image('medical-icons/treatment_status.png',array('class'=>'img-responsive  zoom-hover image_bg','alt'=>''))?>
                                                <p class=" box-heading box-headingx">
                                                    Consult Doctor
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6 block-design"> 
                                            <a href="<?= Router::url(array('controller'=>'vital_signs','action'=>'index'))?>" class="style_prevu_kit">
                                                <?= $this->Html->image('medical-icons/cardiology.png',array('class'=>'img-responsive  zoom-hover image_bg','alt'=>''))?>
                                                <p class=" box-heading box-headingx">
                                                    Vital Signs 
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6 block-design">
                                            <a href="<?= Router::url(array('controller'=>'lab_test_results','action'=>'index'))?>" class="style_prevu_kit">
                                                <?= $this->Html->image('medical-icons/testing.png',array('class'=>'img-responsive  zoom-hover image_bg','alt'=>''))?>
                                                <p class=" box-heading box-headingx">
                                                    Lab Results
                                                </p>
                                            </a>
                                        </div>

                                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6 block-design">
                                            <a href="<?= Router::url(array('controller'=>'medical_histories','action'=>'index'))?>" class="style_prevu_kit">
                                                <?= $this->Html->image('medical-icons/drugstore.png',array('class'=>'img-responsive  zoom-hover image_bg','alt'=>''))?>
                                                <p class=" box-heading box-headingx">
                                                    Medical History
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6 block-design">
                                            <a href="<?= Router::url(array('controller' => 'family_histories', 'action' => 'index')) ?>" class="style_prevu_kit">
                                                <?= $this->Html->image('medical-icons/births.png',array('class'=>'img-responsive  zoom-hover image_bg','alt'=>''))?>
                                                <p class=" box-heading box-headingx">
                                                    Family History
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6 block-design">
                                            <a href="<?= Router::url(array('controller' => 'diet_plans', 'action' => 'index')) ?>" class="style_prevu_kit">
                                                <?= $this->Html->image('medical-icons/diet_plan.png',array('class'=>'img-responsive  zoom-hover image_bg','alt'=>''))?>
                                                <p class=" box-heading box-headingx">
                                                    Diet Plan
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6 block-design">
                                            <a href="<?= Router::url(array('controller' => 'treatment_histories', 'action' => 'index')) ?>" class="style_prevu_kit">
                                                <?= $this->Html->image('medical-icons/treatment_status.png',array('class'=>'img-responsive  zoom-hover image_bg','alt'=>''))?>
                                                <p class=" box-heading box-headingx">
                                                    Treatments
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6 block-design">
                                            <a href="<?= Router::url(array('controller'=>'communications','action'=>'patient_communications'))?>" class="style_prevu_kit">
                                                <?= $this->Html->image('medical-icons/emailing_system.png',array('class'=>'img-responsive  zoom-hover image_bg','alt'=>''))?>
                                                <p class=" box-heading box-headingx">
                                                    Messages
                                                </p>
                                            </a>
                                        </div>
                                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-6 block-design">
                                            <a href="<?= Router::url(array('controller' => 'medical_histories', 'action' => 'patients_listing')) ?>" class="style_prevu_kit">
                                                <?= $this->Html->image('medical-icons/general.png',array('class'=>'img-responsive  zoom-hover image_bg','alt'=>''))?>
                                                <p class=" box-heading box-headingx">
                                                    Patient Like Me
                                                </p>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?= $this->element('front_layout_rightbar');?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div> 
<style type="text/css">
    .block-design{
        padding-top: 10px;
        margin-bottom: 1%;
        margin-right: 1%;
        margin-left: 5%;
        margin-top: 3%;
        padding: 10px;
        border: 1px solid #ddd;
        box-sizing: border-box;
        background-size: cover;
        color: #ffffff;
    }
    .image_bg{
        background: url("../img/backgrounds/bg_1.jpg") no-repeat;
        width:100%;

    }

    .style_prevu_kit
    {
        display:inline-block;
        border:0;
        position: relative;
        -webkit-transition: all 200ms ease-in;
        -webkit-transform: scale(1); 
        -ms-transition: all 200ms ease-in;
        -ms-transform: scale(1); 
        -moz-transition: all 200ms ease-in;
        -moz-transform: scale(1);
        transition: all 200ms ease-in;
        transform: scale(1);   
        width:100%;

    }
    .style_prevu_kit:hover
    {
        box-shadow: 0px 0px 100px #000000;
        z-index: 2;
        -webkit-transition: all 100ms ease-in;
        -webkit-transform: scale(1.5);
        -ms-transition: all 100ms ease-in;
        -ms-transform: scale(1.5);   
        -moz-transition: all 100ms ease-in;
        -moz-transform: scale(1.5);
        transition: all 100ms ease-in;
        transform: scale(1.1);
    }
    .box-headingx{
        margin-bottom: 0px !important;
        margin-top: 5px;
    }

</style>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

