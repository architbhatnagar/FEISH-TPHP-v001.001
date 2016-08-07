
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Feish</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <?= $this->element('front_css_js'); ?>

        <!--if lt IE 9-->
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
         <link rel="shortcut icon" href="<?= Router::url('/',true)?> webroot/img/favicon.ico" />
    </head>
    <body>
        <a id="totop" href="index.html#">
            <i class="fa fa-angle-up">
            </i>
        </a>
        <div id="wrapper">
            <header class="header-wrapper">
                <div id="header">
                    <div class="container">
                        <div class="logo">
                            <a href="">
                                <?= $this->Html->image('logo.png', array('class' => 'img-responsive', ' alt' => '')) ?>
                            </a>
                        </div>
                        <nav class="menu">
                            <ul class="list-unstyled list-inline">
                                <li class="active">
                                    <a href="<?= Router::url(array('controller' => 'users', 'action' => 'homepage')) ?>">Home</a>
                                </li>
                                <li>    
                                    <a href="<?= Router::url(array('controller' => 'services', 'action' => 'services_listing')) ?>">Services</a>
                                </li>
                                <li>
                                    <a href="#">Contacts</a>
                                </li>

                                <li>
                                    <span class="btn btn-success btn-lg btn-14">
                                        <?php if (AuthComponent::user()): ?>
                                            <a href="<?= Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>"><i class="fa fa-user mrm"></i>Dashboard</a> /
                                        <?php else: ?>
                                            <a href="<?= Router::url(array('controller' => 'users', 'action' => 'sign_up')); ?>"><i class="fa fa-user mrm"></i>Signup</a> /
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
            <div class="header-bg-wrapper">
                <div id="header-bg">
                    <div class="container">
                        <div class="header-bg-content">
                            <ol class="breadcrumb">
                                <li>
                                    <a href="#">Home</a>
                                </li>
                                <li class="active">
                                    Forgot Password
                                </li>
                            </ol>
                            <h2 class="title">Forgot Password</h2>
                            <div class="desc">Best place to keep you healthy</div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="main">
                <div id="content">
                    <div class="section">
                        <div class="container">
                            <div class="section-content">
                                <div class="row" style="">
                                    <div class="col-md-12 col-sm-12">
                                        <?php echo $this->Session->flash(); ?>
                                    </div>
                                </div>
                                <div  class="row">
                                    <div class="col-md-3 col-sm-3"></div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="box mbn">
                                            <div class="box-heading">Fill the form below</div>
                                            <div class="box-body">
                                                <?php echo $this->Form->create('User', array('id' => 'login', 'class' => 'form-contact')); ?>
                                                
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label class="control-label mll">Email ID <span class="required">*</span></label>
                                                        <?php echo $this->Form->input('email', array('type' => 'text', 'class' => 'form-control', 'label' => false, 'type' => 'email', 'placeholder' => 'Enter Your Email Id', 'label' => false)); ?>

                                                    </div>
                                                </div>
                                               
                                                <div class="form-group mtxxl text-center mbn">
                                                    <?php echo $this->Form->submit('Submit', array('class' => 'btn btn-outlined btn-primary mtl')) ?>
                                                </div>
                                                <?php echo $this->Form->end(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3"></div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <link type="text/css" rel="stylesheet" href="http://www.feish.online/demo/theme/patient/css/pages/contact.css" /><div id="footer">
                <div id="section-footer" class="section"></div>
                <div id="section-copyright">
                    <div class="container">
                        <p class="text-center mbn">© 2015 Health Plus Theme. All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
        <?=
        $this->Html->script(array(
            'front_end/jquery-migrate-1.2.1.min.js',
            'front_end/libs/bootstrap/js/bootstrap.min.js',
            'front_end/libs/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js',
            'front_end/html5shiv.js',
            'front_end/respond.min.js',
            'front_end/jquery.appear.js',
            'front_end/pages/index.js',
            'front_end/main.js',
            'front_end/layout.js'
        ));
        ?>

    </body>
</html>