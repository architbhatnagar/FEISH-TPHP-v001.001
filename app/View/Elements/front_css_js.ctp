 
<?=
$this->Html->css(array(
  'front_end/jquery-ui-1.11.4.custom/jquery-ui.min.css',
  'back_end/font-awesome.css',
  'front_end/libs/ionicons/css/ionicons.min.css',
  'front_end/vendors/medical-icons/style.css',
  'front_end/libs/bootstrap/css/bootstrap.min.css',
  'front_end/libs/animate.css/animate.css',
  'front_end/core.css',
  'front_end/data-tables/DT_bootstrap.css',
  'front_end/layout.css',
  'front_end/vendor.css',
  'front_end/services_search.css',
  'front_end/pages/news.css',
  'front_end/pages/gallery.css',
  'back_end/bvalidator.css',
  'back_end/jquery.raty.css'
));
?>

<?php echo
$this->Html->script(array(
  'front_end/jquery-1.11.2.min.js',
  'front_end/jquery-ui-1.11.4.custom/jquery-ui.min.js',
  'front_end/jquery-migrate-1.2.1.min.js',
  'front_end/libs/bootstrap/js/bootstrap.min.js',
  'front_end/libs/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js',
  'front_end/html5shiv.js',
  'front_end/respond.min.js',
  'front_end/data-tables/jquery.dataTables.js',
  'front_end/jquery.appear.js',
  'front_end/pages/index.js',
  'front_end/main.js',
  'front_end/layout.js',
  'back_end/jquery.bvalidator-yc.js',
  'back_end/jquery.raty.js'
));
?>

<!--if lt IE 9-->




<!--if lt IE 9-->
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<link rel="shortcut icon" href="<?= Router::url('/', true) ?> webroot/img/favicon.ico" />

<script type="text/javascript">
    function goBack() {
        window.history.back();
    }
</script>
<style type="text/css">
    .goBack{
        margin-left: 5px;
    }
</style>
