
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
        <link rel="shortcut icon" href="<?= Router::url('/', true) ?> webroot/img/favicon.ico" />
    </head>
    <body>
        <a id="totop" href="javascript:void(0);" onclick="slideUp()">
            <i class="fa fa-angle-up">
            </i>
        </a>
        <div id="wrapper">
            <?php echo $this->Element('front_header'); ?>
            <div class="header-bg-wrapper">
                <div id="header-bg">
                    <div class="container">
                        <div class="header-bg-content">
                            <ol class="breadcrumb">
                                <li>
                                    <a href="#">Home</a>
                                </li>
                                <li class="active">
                                    Login
                                </li>
                            </ol>
                            <h2 class="title">Login</h2>
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
                                                        <label class="control-label mll">Email ID / Mobile <span class="required">*</span></label>
                                                        <?php echo $this->Form->input('email', array('type' => 'text', 'class' => 'form-control', 'label' => false, 'type' => 'text', 'placeholder' => 'Email/Mobile', 'label' => false, 'data-bvalidator' => 'required')); ?>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label class="control-label mll">Password <span class="required">*</span></label>
                                                        <?php echo $this->Form->input('password', array('class' => 'form-control', 'label' => false, 'type' => 'password', 'placeholder' => 'Password', 'label' => false, 'data-bvalidator' => 'required')) ?>
                                                    </div>
                                                </div>
                                                <div class="form-group mtxxl text-center mbn">
                                                    <?php echo $this->Form->submit('Sign in', array('class' => 'btn btn-outlined btn-primary mtl')) ?>
                                                    <a href="<?= Router::url(array('controller' => 'users', 'action' => 'forgot_password')); ?>">Forgot your username or password?</a>
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
            
            <?php echo $this->Element('front_footer'); ?>
            
            
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
    <script type="text/javascript">
        $(document).ready(function () {
            $("#login").bValidator();
        });
    </script>

</body>
</html>
<script>
    function slideUp() {
        $("html,body").animate({scrollTop: 0}, 1000);
    }
</script>