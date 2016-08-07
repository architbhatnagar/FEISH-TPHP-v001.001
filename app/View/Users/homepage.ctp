<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            Feish Online
        </title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:700,600,400,300,200">
        <?=
        $this->Html->css(array(
            'back_end/font-awesome.css',
            'front_end/libs/ionicons/css/ionicons.min.css',
            'front_end/vendors/medical-icons/style.css',
            'front_end/libs/bootstrap/css/bootstrap.min.css',
            'front_end/libs/animate.css/animate.css',
            'front_end/core.css',
            'front_end/layout.css',
            'front_end/vendor.css',
            'front_end/services_search.css',
            //'front_end/pages/news.css',
            //'front_end/pages/gallery.css',
            'front_end/pages/index.css',
        ));
        ?>

        <?=
        $this->Html->script(array(
            'front_end/jquery-1.11.2.min.js',
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

        <!--if lt IE 9-->
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
        </script>

        <style>
            input#gsc-i-id1 {
                color: black;
            }
            .testimonials-wrap {
                background: rgba(0, 0, 0, 0) url("img/quotes.png") no-repeat scroll 0 0;
                line-height: 20px;
                margin-bottom: 20px;
            }
            .testimonials-author {

                font-size: 0.9em;
                padding-right: 30px;
                text-align: right;
            }
            .list-styles ul li {
                background: rgba(0, 0, 0, 0) url("img/lsat.png") no-repeat scroll left 8px;
                list-style: outside none none;
                padding: 0 0 3px 20px;
            }
            #section-new {
                background: #f5f5f5 none repeat scroll 0 0;
                color: #5a5a5a;

            }
            #section-footer {
                background-color: #31708f;
                color: #ffffff;
                padding-bottom: 20px;
                padding-top: 20px;
            }
            #section-new a, #section-new p, #section-new h5, #section-new h2  {

                color: #5a5a5a!important;

            }

            #section-footer a, #section-footer p{
                color: #fff!important;
            }
            #section-copyright {
                background-color: #2c6581;
                color: #ffffff;
                font-weight: 600;
                padding: 15px 0;
            }
            .block-info a {
                color: #fff !important;
                font-size: 18px;
                margin: 3px;
            }
            .email_id {
                height: 42px;
            }
            ul li {
                padding: 5px 0;
            }
            .slider-wrapper {
                position: relative;
                top: 90px;
            }
            .news p{
                font-size: 12px;
            }
            h5 {
                font-size: 15px !important;
            }
            .input-group-btn .btn-secondary {
                padding-left: 3.3em;
                padding-right: 3.3em;
                height: 3em;
            }
            .slider_heading{
                top: 25%;
                position: absolute;
                color: white;
                background-color: rgba(0, 0, 0, 0.54);
                padding: 20px;
                border-radius: 10px;
                text-align: center;
            }
            .tt_upcoming_events_widget {
                height: 300px;
                overflow: scroll !important;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <!-- THEME SETTINGS-->
        <!-- BACK TO TOP-->
        <a id="totop" href="#">
            <i class="fa fa-angle-up">
            </i>
        </a>
        <!-- WRAPPER-->
        <div id="wrapper">
            <!-- HEADER-->
            <?= $this->element('front_header'); ?>

            <!-- SLIDER-->
            <div class="slider-wrapper">
            <div class="search-bar">
            <div class="autocomp">
            
                             <script>
                                (function () {
                                    var cx = '003888482740603081064:lgj0mlj4q_8';
                                    var gcse = document.createElement('script');
                                    gcse.type = 'text/javascript';
                                    gcse.async = true;
                                    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                                            '//cse.google.com/cse.js?cx=' + cx;
                                    var s = document.getElementsByTagName('script')[0];
                                    s.parentNode.insertBefore(gcse, s);
                                })();
                            </script>
                            <gcse:search></gcse:search>
            </div>
            </div>
                <div id="slider">
                    <div id="banner-sliders" data-ride="carousel" class="carousel slide">
                        <div class="carousel-inner">
                            <div class="item active">
                                <?php echo $this->Html->image("banners/appointment.jpg"); ?>
                                
                            </div>
                            <div class="item">
                                <?php echo $this->Html->image("banners/consulting.jpg"); ?>
                                
                            </div>
                            <div class="item">
                                <?php echo $this->Html->image("banners/hrm.jpg"); ?>
                                
                            </div>
                            <div class="item">
                                <?php echo $this->Html->image("banners/social.jpg"); ?>
                                
                            </div>
                        </div>
                        <!--div class="carousel-caption">
                            <div class="search">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-10 col-xs-10 col-xs-offset-1 col-md-offset-1 col-sm-10 col-lg-10 col-sm-offset-1 col-lg-offset-1">
                                            <div class="form-section">
                                                <div class="row">
                                                    <form role="form">
                                                        <div class="col-md-12">
                                                            <script>
                                                                (function () {
                                                                    var cx = '008090191634183339836:zgcmmw-uvsy';
                                                                    var gcse = document.createElement('script');
                                                                    gcse.type = 'text/javascript';
                                                                    gcse.async = true;
                                                                    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                                                                            '//cse.google.com/cse.js?cx=' + cx;
                                                                    var s = document.getElementsByTagName('script')[0];
                                                                    s.parentNode.insertBefore(gcse, s);
                                                                })();
                                                            </script>
                                                            <gcse:search></gcse:search>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div-->
                        <a href="#banner-sliders" data-slide="prev" class="left carousel-control">
                            <span class="fa fa-arrow-left"></span>
                        </a>
                        <a href="#banner-sliders" data-slide="next" class="right carousel-control">
                            <span class="fa fa-arrow-right"></span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- MAIN-->
            <div id="main">
                <!-- CONTENT-->
                <div id="content">
                    <div id="section-features" class="section">
                        <div class="container text-center">
                            <div class="section-heading">
                                <div class="info">Our Services</div>
                                <div class="line"></div>
                            </div>
                            <div class="section-content">
                                <div class="list-features">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'sign_up')); ?>">
                                                <span class="icons med-heart2">
                                                </span>
                                                <span class="title">Health Record Management</span>
                                                <span class="info">
                                                    Record your past appointments, lab tests results, prescriptions, medical history, various other medical 
                                                    records & plan your diet and so on. Keep track of your medical records and store important health 
                                                    information, easy accessibility of your records from anywhere 24X7 with option to upload or download 
                                                    and print. Register to find more about it…
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="<?php echo Router::url(array('controller' => 'services', 'action' => 'services_listing')); ?>">
                                                <span class="icons med-clinic">
                                                </span>
                                                <span class="title">Online Appointments</span>
                                                <span class="info">
                                                    Connect with doctors and book appointments online at your ease from anywhere and at any point of time. 
                                                    Enjoy the hassle-free experience and avoid the need to wait in lines or sitting next to a sick person. 
                                                    Maintain track of appointments, the history of treatments & reduce exposure to medical risks. 
                                                    Register to find more about it…
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="<?php echo Router::url(array('controller' => 'services', 'action' => 'services_listing')); ?>">
                                                <span class="icons med-doctor">
                                                </span>
                                                <span class="title">Doctor Consultation</span>
                                                <span class="info">
                                                    Practitioners can access patient’s complete health information online, treat more efficiently, improve 
                                                    adherence, another windows for patient acquisition. A great and convenient resource for everyone including 
                                                    those who are too sick to leave home or those who have limited time or those who pay repeated visits for 
                                                    a chronic condition or those who simply want to have a hassle-free experience. Register to find more about it…
                                                </span>
                                            </a>
                                        </div>
                                        
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <a href="<?php echo Router::url(array('controller' => 'users', 'action' => 'sign_up')); ?>">
                                                <span class="icons med-biology">
                                                </span>
                                                <span class="title">Social Networking</span>
                                                <span class="info">
                                                    Compare treatments, symptoms and experiences with people like you and take control of your health. 
                                                    Connect with people like you, share your experiences, give and get support to improve your life and 
                                                    life of others. Register to find more about it...
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container" style="margin-bottom: 25px;">
                       
                        </div>
                    </div>

                    <div class="section section-background" id="section-new">
                        <div class="container">

                            <div class="row">                    
<!--                                <div class="col-md-4" id='ar1'>
                                    <div class="tt_upcoming_events_widget">
                                        <h2 class="widget_h_3">Specials</h2>
                                        <div class="news-widget">
                                            <?php foreach ($feed as $item): ?>
                                                <div class="news">
                                                    <h5><a href="<?php echo $item['link']; ?>" target='_blank'><?php echo $item['title']; ?></a></h5>
                                                    <p>
                                                        <?php echo $item['desc']; ?>
                                                    </p>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>                            
                                </div>
                                <div class="col-md-4">
                                    <div class="">
                                        <h2 class="widget_h_3">Testimonials </h2>

                                        <div class="testimonials-wrap">
                                            "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout structure."
                                            <div class="testimonials-author">John Baker, Customer</div>
                                        </div>
                                        <div class="testimonials-wrap">
                                            "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout structure."
                                            <div class="testimonials-author">John Baker, Customer</div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>


                                </div>
                                <div class="col-md-4">
                                    <div class="tt_upcoming_events_widget">
                                        <h2 class="widget_h_3">Latest News </h2>
                                        <div class="news-widget">
                                            <?php foreach ($feed2 as $item2): ?>
                                                <div class="news">
                                                    <h5><a href="<?php echo $this->webroot?>news/<?php echo $item2['id']; ?>" ><?php echo $item2['title']; ?></a></h5>
                                                    <p>
                                                        <?php echo $item2['desc']; ?>
                                                    </p>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>                            
                                </div>-->
                                <div class="col-md-6">
                                    <div class="">
                                        <h2 class="widget_h_3">Testimonials </h2>

                                        <div class="testimonials-wrap">
                                            "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout structure."
                                            <div class="testimonials-author">John Baker, Customer</div>
                                        </div>
<!--                                        <div class="testimonials-wrap">
                                            "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout structure."
                                            <div class="testimonials-author">John Baker, Customer</div>
                                        </div>-->
                                    </div>
                                    <div class="clear"></div>


                                </div>
                                <div class="col-md-6">
                                    <div class="tt_upcoming_events_widget">
                                        <h2 class="widget_h_3">Latest News </h2>
                                        <div class="news-widget">
                                            <?php foreach ($feed2 as $item2): ?>
                                                <div class="news">
                                                    <h5><a href="<?php echo $this->webroot?>news/<?php echo $item2['id']; ?>" ><?php echo $item2['title']; ?></a></h5>
                                                    <p>
                                                        <?php echo $item2['desc']; ?>
                                                    </p>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="clear"></div>                            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="section-about-us" class="section section-background">
                    <div class="container text-center">
                        <div class="section-content">
                            <div class="list-about">
                                <div class="row">
                                    <div data-value="7" class="col-md-4 fact col-sm-4 col-xs-4">
                                        <div class="number factor">
                                            50147</div>
                                        <div class="name">
                                            No of Visits</div>
                                        <div class="line">
                                        </div>
                                    </div>
                                    <div data-value="<?= $user_dr ?>" class="col-md-4 fact col-sm-4 col-xs-4">
                                        <div class="number factor">
                                            <?= 400+$user_dr ?></div>
                                        <div class="name">
                                            No of Doctors</div>
                                        <div class="line">
                                        </div>
                                    </div>
                                    <div data-value="<?= $user_pt ?>" class="col-md-4 fact col-sm-4 col-xs-4">
                                        <div class="number factor">
                                            <?= 1000+$user_pt ?></div>
                                        <div class="name">
                                            No of Patients</div>
                                        <div class="line">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $this->Element('front_footer'); ?>
        <?php //echo $this->Html->css('custom_search'); ?>
        <div id="slidebox" class="hidden-xs">
            <a class="close">x</a>

        <video width="100%" src="<?php echo $this->webroot ?>media/feish.mp4" type="video/mp4" controls> </video>

        </div>
        <script>
        $.noConflict();
        jQuery(function($) {
          $(window).scroll(function(){
            /* when reaching the element with id "last" we want to show the slidebox. Let's get the distance from the top to the element */
            var distanceTop = '300';
            
            if  ($(window).scrollTop() > distanceTop)
              $('#slidebox').animate({'right':'0px'},500);
            else 
              $('#slidebox').stop(true).animate({'right':'-355px'},100);  
          });
          
          /* remove the slidebox when clicking the cross */
          $('#slidebox .close').bind('click',function(){
            $(this).parent().remove();
          });
        });
        </script>
       
       
    </body>
</html>
