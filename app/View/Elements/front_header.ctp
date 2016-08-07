 <link rel="stylesheet" type="text/css" href="<?php echo $this->webroot?>css/custome.css">
<style>
     body{
        overflow-x: hidden !important;
        overflow-y: scroll !important;
    }
</style>    
<header class="header-wrapper">
    <div id="header">
        <div class="container">
            <div class="logo">
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'homepage')) ?>">
                    <?= $this->Html->image('logo.png', array('class' => 'img-responsive', ' alt' => '')) ?>
                </a>
            </div>
            <nav class="menu">
                <ul class="list-unstyled list-inline">
                    <li class="<?php if ($this->request->controller == 'users' && $this->request->action == 'homepage') {
                        echo 'active';
                    } ?>">
                        <a href="<?= Router::url(array('controller' => 'users', 'action' => 'homepage')) ?>">Home</a>
                    </li>
                 
                    <li class="dropdown <?php if ($this->request->controller == 'services' && ($this->request->action == 'services_listing' || $this->request->action == 'service_details')) {
                        echo 'active';
                    } ?>">
                        <a href="#" data-hover="dropdown" class="data-toggle">
                            Services<span class="arrow fa fa-angle-down">
                            </span>
                        </a>
                        <ul class="dropdown-menu multi-level">
                            <li>
                                <a href="<?= Router::url(array('controller' => 'services', 'action' => 'services_listing')) ?>">Online Appointments</a>
                            </li>
                            <li>
                                <a href="<?= Router::url(array('controller' => 'services', 'action' => 'services_listing')) ?>">Online Consulting</a>
                            </li>
                            <li>
                                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'sign_up')); ?>">Health Record Management</a>
                            </li>
                            <li>
                                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'sign_up')); ?>">Social Networking</a>
                            </li>
                        </ul>
                    </li>


                    <li class="<?php if ($this->request->controller == 'users' && $this->request->action == 'contact_us') {
                        echo 'active';
                    } ?>">
                        <a href="<?= Router::url(array('controller' => 'users', 'action' => 'contact')) ?>">Contact  Us</a>
                    </li>
					
					<li class="dropdown <?php if ($this->request->controller == 'users' && ($this->request->action == 'user_faq' || $this->request->action == 'user_faq')) {
                        echo 'active';
                    } ?>">
                        <a href="#" data-hover="dropdown" class="data-toggle">
                            FAQ<span class="arrow fa fa-angle-down">
                            </span>
                        </a>
                        <ul class="dropdown-menu multi-level">
                            <li>
                                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'user_faq','individuals')) ?>">For Individual's</a>
                            </li>
                             <li>
                                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'user_faq','doctors')) ?>">For Doctor's</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <span class="btn btn-success btn-lg btn-14">
                            <?php if (AuthComponent::user()): ?>
                                <a href="<?php
                                if (AuthComponent::user('user_type') == 1) {
                                    echo Router::url(array('controller' => 'users', 'action' => 'admin_dashboard'));
                                } else if (AuthComponent::user('user_type') == 2) {
                                    echo Router::url(array('controller' => 'users', 'action' => 'doctors_dashboard'));
                                } else if (AuthComponent::user('user_type') == 3) {
                                    echo Router::url(array('controller' => 'users', 'action' => 'assistant_dashboard'));
                                } else {
                                    echo Router::url(array('controller' => 'users', 'action' => 'dashboard'));
                                }
                                ?>">Dashboard</a> / 
                            <?php else: ?>
                                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'sign_up')); ?>"><i class="fa fa-user mrm"></i>Sign up</a> /
<?php endif; ?>
<?php if (AuthComponent::user()): ?>
                                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'logout')) ?>"><i class="fa fa-sign-in mrm"></i>Logout</a>
<?php else: ?>
                                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'login')) ?>"><i class="fa fa-sign-in mrm"></i>Login</a>
<?php endif; ?>

                        </span>
                    </li>
                </ul>
            </nav>
            <div class="menu-responsive">
                <span class="fa fa-bars"></span>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</header>



