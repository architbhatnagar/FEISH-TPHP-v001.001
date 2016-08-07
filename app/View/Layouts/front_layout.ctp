<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Feish Online</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">

        <?=
        $this->Html->script(array(
            'front_end/jquery-1.11.2.min.js',
        ));
        ?>
           <?= $this->element('front_css_js'); ?>
          
    </head>
    <body><!-- THEME SETTINGS--><!-- BACK TO TOP-->
        <a id="totop" href="javascript:void(0);" onclick="slideUp()"><i class="fa fa-angle-up"></i></a>
        <!-- WRAPPER-->
        <div id="wrapper">
            <!-- HEADER--> 
            <?= $this->element('front_header'); ?>
            <!-- MAIN--> 
            <div id="main">
                <!-- CONTENT-->
                <div id="content">
                    <div class="row ptxxl">
                        <div class="col-lg-12">
                            <?php echo $this->Session->flash(); ?>
                        </div>

                    </div>
                    <?php echo $this->fetch('content'); ?>
                </div>

            </div> 
            <!-- FOOTER-->
            <?php echo $this->element('front_footer'); ?>    
        </div>
     

    </body>

</html>
<script>
    function slideUp(){
         $("html,body").animate({scrollTop: 0}, 1000);
    }
</script>
<style>
    #main_content{
        margin-top: 15px;
    }
</style>