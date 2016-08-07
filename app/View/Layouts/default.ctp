    
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="Fiesch" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />
        <meta http-equiv="X-UA-Compatible" content="IE=9" />
        <link rel="shortcut icon" href="<?= Router::url('/',true)?> webroot/img/favicon.ico" />

        <title> Feish  <?= $user_types[AuthComponent::user('user_type')]?></title>
        <?= $this->element('backend_css_js'); ?>
    </head>
    <body>
        <section id="container">
            <?= $this->element('backend_header'); ?>
            <?= $this->element('backend_sidebar'); ?>
            <section id="main-content">
                <section class="wrapper">
                    <?php echo $this->Session->flash(); ?>
                    <?php echo $this->fetch('content'); ?>
                </section>
            </section>


        </section>
    </body>
</html>