<?php
$controller = $this->request->controller;
$action = $this->request->action;
?>
<header class="header fixed-top clearfix">
    <div class="brand">
        <a href="" class="logo">
            <?php $this->Html->image('logo.png', array('alt' => '','class'=>'logo_ht')); ?>
        </a>
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars"></div>
        </div>
    </div>
    <div class="nav notify-row" id="top_menu">
        <ul class="nav top-menu">
            <li class="dropdown">
                <button data-toggle="dropdown" id="search_patient" class="btn btn-sm btn-danger dropdown-toggle">
                    <i class="fa fa-search"></i> Patients Search
                </button>
                <ul class="dropdown-menu extended tasks-bar">
                    <li>
                        <?php // echo $this->form->create('User', array('controller' => 'users', 'action' => 'patients_index_for_doctor', 'class' => 'form-horizontal bucket-form')); ?>
                        <?php if($user_type_id == 2) { 
                            echo $this->form->create('User', array('controller' => 'users', 'action' => 'search_patients', 'class' => 'form-horizontal bucket-form')); 
                        }
                        else if($user_type_id == 3) {
                            echo $this->form->create('User', array('controller' => 'users', 'action' => 'patients_index_for_assistant', 'class' => 'form-horizontal bucket-form'));
                        } 
                        else if($user_type_id == 1) {
                            echo $this->form->create('User', array('controller' => 'users', 'action' => 'patients_index_for_admin', 'class' => 'form-horizontal bucket-form'));
                        } 
                        ?>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Search by</label>
                                <div class="col-sm-8">
                                    <?php echo $this->Form->input('column_name', array('options' => $keywords, 'id' => 'keyword', 'class' => 'form-control', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Keyword</label>
                                <div class="col-sm-8">
                                    <!--<input type="text" name="keyword" placeholder="Enter search Keyword" class="form-control" />-->
                                    <?php echo $this->Form->input('condition_like', array('id' => "condition_like", 'required' => '', 'placeholder' => 'Enter search keyword', 'class' => 'form-control', 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12 text-center">
                                    <?php echo $this->Form->submit(__('Search'), array('class' => 'btn btn-outlined btn-primary')); ?>
                                </div>
                            </div>
                            <div class="form-group"></div>
                        <?php echo $this->Form->end(); ?>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="top-nav clearfix">
        <ul class="nav pull-right top-menu">
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="">
                    <?php if (AuthComponent::user('avatar') != ""): ?>
                        <?= $this->Html->image('user_avtar/' . AuthComponent::user('avatar'), array('alt' => '')); ?>
                    <?php else: ?>
                        <?= $this->Html->image('doctor.png', array('alt' => '')); ?>
                    <?php endif; ?>
                    <span class="username"><?= ucwords(AuthComponent::user('first_name') . " " . AuthComponent::user('last_name')) ?></span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <?php if(AuthComponent::user('user_type') != 3) { ?>
                    <li class="<?php if (($controller == "users" && $action == "view")) { ?> active <?php } ?>">
                        <a href="<?= Router::url(array('controller' => 'users', 'action' => 'view')) ?>">
                            <i class="fa fa-suitcase"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <?php } else { ?>
                    <li class="<?php if (($controller == "users" && $action == "assistant_view")) { ?> active <?php } ?>">
                        <a href="<?= Router::url(array('controller' => 'users', 'action' => 'assistant_view')) ?>">
                            <i class="fa fa-suitcase"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <?php } ?>
                    <li class="<?php if (($controller == "users" && $action == "account_setting")) { ?> active <?php } ?>">
                        <a href="<?= Router::url(array('controller' => 'users', 'action' => 'account_setting')) ?>">
                            <i class="fa fa-gears"></i> 
                            <span>Change Password</span>
                        </a>
                    </li>
                    <li><a href="<?= Router::url(array('controller' => 'users', 'action' => 'logout')) ?>"><i class="fa fa-key"></i> <span>Logout</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</header>
<style type="text/css">
    .logo{
            height: 80% !important;
    }
    </style>


