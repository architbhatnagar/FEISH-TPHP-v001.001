<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            Health Plus | Home Page
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
            'back_end/jquery.raty.css'
        ));
        ?>

        <?=
        $this->Html->script(array(
            'front_end/jquery-1.11.2.min.js',
            'front_end/jquery-migrate-1.2.1.min.js',
            'front_end/libs/bootstrap/js/bootstrap.min.js'
        ));
        ?>

        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
        </script>

        <style>
            #myCarousel{
                padding-top: 91px;
            }
            #myCarousel .carousel-caption {
                left:0;
                right:0;
                bottom:0;
                text-align:left;
                padding:10px;
                background:rgba(0,0,0,0.6);
                text-shadow:none;
            }

            #myCarousel .list-group {
                position:absolute;
                top:0;
                right:0;
                padding-top: 89px;
                padding-right: 0px;
            }
            #myCarousel .list-group-item {
                border-radius:0px;
                cursor:pointer;
            }
            #myCarousel .list-group .active {
                background-color:#eee;	
            }

            @media (min-width: 992px) { 
                #myCarousel {padding-right:33.3333%;}
                #myCarousel .carousel-controls {display:none;} 	
            }
            @media (max-width: 991px) { 
                .carousel-caption p,
                #myCarousel .list-group {display:none;} 
            }   
        </style>

        <script>
            $(document).ready(function () {
                var clickEvent = false;
                $('#myCarousel').carousel({
                    interval: 4000
                }).on('click', '.list-group li', function () {
                    clickEvent = true;
                    $('.list-group li').removeClass('active');
                    $(this).addClass('active');
                }).on('slid.bs.carousel', function (e) {
                    if (!clickEvent) {
                        var count = $('.list-group').children().length - 1;
                        var current = $('.list-group li.active');
                        current.removeClass('active').next().addClass('active');
                        var id = parseInt(current.data('slide-to'));
                        if (count == id) {
                            $('.list-group li').first().addClass('active');
                        }
                    }
                    clickEvent = false;
                });

            });

            $(window).load(function () {
                var boxheight = $('#myCarousel .carousel-inner').innerHeight();
                var itemlength = $('#myCarousel .item').length;
                var triggerheight = Math.round(boxheight / itemlength + 1);
                $('#myCarousel .list-group-item').outerHeight(triggerheight);
            });



        </script>


    </head>
    <body>
        <!-- THEME SETTINGS-->
        <!-- BACK TO TOP-->
        <a id="totop" href="javascript:void(0);" onclick="slideUp()">
            <i class="fa fa-angle-up">
            </i>
        </a>
        <!-- WRAPPER-->
        <div id="wrapper">
            <!-- HEADER-->
            <?= $this->element('front_header'); ?>

            <div id="myCarousel" class="carousel slide" data-ride="carousel">

                <!-- Wrapper for slides -->
                <div class="carousel-inner">

                    <div class="item active">
                        <img src="http://placehold.it/1024x300/cccccc/ffffff">
                        <div class="carousel-caption">
                            <h3><a href="#">Online Appointments</a></h3>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat. <a class="label label-primary" href="http://sevenx.de/demo/bootstrap-carousel/" target="_blank">Free Bootstrap Carousel Collection</a></p>
                        </div>
                    </div><!-- End Item -->

                    <div class="item">
                        <img src="http://placehold.it/1024x300/cccccc/ffffff">
                        <div class="carousel-caption">
                            <h3><a href="#">Online Doctor's Consultation</a></h3>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat. <a class="label label-primary" href="http://sevenx.de/demo/bootstrap-carousel/" target="_blank">Free Bootstrap Carousel Collection</a></p>
                        </div>
                    </div><!-- End Item -->

                    <div class="item">
                        <img src="http://placehold.it/1024x300/cccccc/ffffff">
                        <div class="carousel-caption">
                            <h4><a href="#">Health Record Management</a></h4>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat. <a class="label label-primary" href="http://sevenx.de/demo/bootstrap-carousel/" target="_blank">Free Bootstrap Carousel Collection</a></p>
                        </div>
                    </div><!-- End Item -->

                    <div class="item">
                        <img src="http://placehold.it/1024x300/cccccc/ffffff">
                        <div class="carousel-caption">
                            <h4><a href="#">Social Networking</a></h4>
                            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat. <a class="label label-primary" href="http://sevenx.de/demo/bootstrap-carousel/" target="_blank">Free Bootstrap Carousel Collection</a></p>
                        </div>
                    </div><!-- End Item -->
                </div><!-- End Carousel Inner -->


                <ul class="list-group col-sm-4">
                    <li data-target="#myCarousel" data-slide-to="0" class="list-group-item active"><h4>Online Appointment</h4></li>
                    <li data-target="#myCarousel" data-slide-to="1" class="list-group-item"><h4>Doctor Consultation</h4></li>
                    <li data-target="#myCarousel" data-slide-to="2" class="list-group-item"><h4>Health record management</h4></li>
                    <li data-target="#myCarousel" data-slide-to="3" class="list-group-item"><h4>Social Networking</h4></li>
                </ul>

                <!-- Controls -->
                <div class="carousel-controls">
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>

            </div><!-- End Carousel -->

            <!-- MAIN-->
            <div id="main">
                <!-- CONTENT-->
                <div id="content">
                    <div id="section-meet-our-doctor" class="section">
                        <div class="container text-center">
                            <div class="section-heading heading_padding">
                                <div class="title">
                                    Facilities
                                </div>
                                <div class="line">
                                </div>
                            </div>
                            <div class="section-content slider_padding">
                                <div id="doctor-carousel" data-ride="carousel" class="carousel slide">
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <div class="row man">
                                                <?php foreach ($services as $key => $service): ?>
                                                    <?php if (($key % 4 == 0) && $key != 0): ?>

                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="row man">


                                                    <?php endif; ?>
                                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                                        <div class="thumb">
                                                            <?php if (!empty($service['Service']['logo'])): ?>
                                                                <?= $this->Html->image('services/' . $service['Service']['logo'], array('class' => 'img-responsive', 'alt' => ''));
                                                                ?>

                                                            <?php else: ?>
                                                                <?= $this->Html->image('doctor_images.png', array('class' => 'img-responsive', 'alt' => ''));
                                                                ?>

                                                            <?php endif; ?>
                                                            <div class="caption">
                                                                <div class="name">
                                                                    <a href="<?= Router::url(array('controller' => 'services', 'action' => 'service_details', $service['Service']['id'])); ?>">
                                                                        <?= $service['Service']['title'] ?>
                                                                    </a>
                                                                </div>
                                                                <div class="pos">
                                                                    <div data-rating="<?= $service['Service']['avg_rating'] ?> "  class="ratings"></div>
                                                                </div>
                                                                <div class="pos">
                                                                    <?=
                                                                    $this->Text->truncate($service['Service']['description'], 100, array(
                                                                        'ellipsis' => '...',
                                                                        'exact' => false
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#doctor-carousel" data-slide="prev" class="left carousel-control">
                            <span class="fa fa-arrow-left">
                            </span>
                        </a>
                        <a href="##doctor-carousel" data-slide="next" class="right carousel-control">
                            <span class="fa fa-arrow-right">
                            </span>
                        </a>
                    </div>



                    <div id="section-about-us-2">
                        <div class="container">
                            <div class="section-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="box">
                                            <div class="box-heading"><h4>Dental dean</h4></div>
                                            <div class="box-body">
                                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, 
                                                    sed quia dolorem consequuntur magni dolores eos qui ratione sequi nesciunt.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                    </div>
                                    <div class="col-md-4">

                                    </div>                   
                                </div>
                            </div>
                        </div>
                    </div>













                    <div id="section-about-us-2" class="section section-background">
                        <div class="container text-center">
                            <div class="section-content">
                                <div class="list-about">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <div class="number">702</div>
                                            <div class="name">Services</div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <div class="number">127</div>
                                            <div class="name">Doctors</div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <div class="number">364</div>
                                            <div class="name">Patients</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- FOOTER-->
                    <div id="footer">
                        <div id="section-footer" class="section">
                            <div class="container">
                                <div class="section-content">
                                    <div class="row">
                                        <div class="col-md-4 prl">
                                            <div class="logo">
                                                <a href="#">
                                                    <?= $this->Html->image('logo.png', array('class' => 'img-responsive', 'alt' => '')); ?>
                                                </a>
                                            </div>
                             
                                            <div class="contact-info">
                                                <ul class="list-unstyled mbn">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-map-marker fa-fw">
                                                            </i>
                                                            No: 27 A, East Madison St Baltimore, MD, USA</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-phone fa-fw">
                                                            </i>
                                                            +1800 000 123</a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fa fa-envelope fa-fw">
                                                            </i>
                                                            healthplus@info.com</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="pbn">
                                                            <i class="fa fa-globe fa-fw">
                                                            </i>
                                                            www.healthplus_clinic.com</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pll prl">
                                            <div class="recent-twitter">
                                                <div class="heading">
                                                    <i class="fa fa-twitter">
                                                    </i>
                                                    Recent Twitter</div>
                                                <div class="content">
                                                    <div class="list-recent-twitter">
                                                        <ul class="list-unstyled mbn">
                                                            <li>
                                                                <a href="#">
                                                                    <strong class="mrs">
                                                                        @Porroquia:</strong>
                                                                    <span>
                                                                        Est qui dolorem ipsum quia dolor sit amet consectetur adipisci velit sed quia</span>
                                                                    <p class="mts">
                                                                        <small>
                                                                            2 hours ago</small>
                                                                    </p>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                    <strong class="mrs">
                                                                        @Dolorem:</strong>
                                                                    <span>
                                                                        Est qui dolorem ipsum quia dolor sit amet consectetur adipisci velit sed quia non</span>
                                                                    <p class="mts">
                                                                        <small>
                                                                            4 hours ago</small>
                                                                    </p>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                    <strong class="mrs">
                                                                        @Quiamea:</strong>
                                                                    <span>
                                                                        Est qui dolorem ipsum quia dolor sit amet consectetur adipisci velit sed quia non</span>
                                                                    <p class="mts mbn">
                                                                        <small>
                                                                            7 hours ago</small>
                                                                    </p>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pll">
                                            <div class="newsletter">
                                                <div class="content">
                                                    <div class="block-info">
                                                        <a href="#" class="icons">
                                                            <i class="fa fa-facebook">
                                                            </i>
                                                        </a>
                                                        <a href="#" class="icons">
                                                            <i class="fa fa-twitter">
                                                            </i>
                                                        </a>
                                                        <a href="#" class="icons">
                                                            <i class="fa fa-google-plus">
                                                            </i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="section-copyright">
                            <div class="container">
                                <div class="col-md-6">
                                    <p class="text-center mbn">
                                        © <?php echo date('Y') ?> Feish.online. All Rights Reserved
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <div class="newsletter">
                                        <div class="content">
                                            <div class="block-info">
                                                <a href="#" class="icons">
                                                    <i class="fa fa-facebook">
                                                    </i>
                                                </a>
                                                <a href="#" class="icons">
                                                    <i class="fa fa-twitter">
                                                    </i>
                                                </a>
                                                <a href="#" class="icons">
                                                    <i class="fa fa-google-plus">
                                                    </i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?=
                $this->Html->script(array(
                    'front_end/libs/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js',
                    'front_end/html5shiv.js',
                    'front_end/respond.min.js',
                    'front_end/jquery.appear.js',
                    'front_end/pages/index.js',
                    'front_end/main.js',
                    'front_end/layout.js',
                    'back_end/jquery.raty.js'
                ));
                ?>

                <?= $this->Html->css(array('front_end/amazingslider-1.css')); ?>
                <?= $this->Html->script(array('front_end/amazingslider.js', 'front_end/initslider-1.js')); ?>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('.ratings').raty({
                            readOnly: true,
                            half: true,
                            halfShow: true,
                            number: 5,
                            score: function () {
                                return $(this).attr('data-rating');
                            },
                            path: 'img/raty/'
                        });
                    });

                </script>
                </body>
                </html>
                <script>
                    function slideUp() {
                        $("html,body").animate({scrollTop: 0}, 1000);
                    }
                </script>












