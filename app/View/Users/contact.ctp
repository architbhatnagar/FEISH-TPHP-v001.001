<script type="text/javascript">
    $(document).ready(function () {
        $('#conatct_frm').bValidator();
        $('.ptxxl').removeClass();
    });

    var options = {
        singleError: true,
        showCloseIcon: false
    };

    $('#conatct_frm').bValidator(options);
</script>
<style>
    .bvalidator_errmsg {
        margin-left: -160px;
    }
</style> 
<div class="header-bg-wrapper">
    <div id="header-bg">
        <div class="container">
            <div class="header-bg-content">
                <ol class="breadcrumb">
                    <li><a href="<?= Router::url(array('controller' => 'users', 'action' => 'homepage')) ?>">Home</a></li>
                    <li class="active">Contact</li></ol><h2 class="title">Contact Us</h2>
                <div class="desc">Best place to keep you healthy</div>
            </div>
        </div>
    </div>
</div>

<div id="main">
    <div id="content">
        <div id="section-contact" class="section">
            <!--            <div class="container">
                            <div class="section-heading text-center">
                                <div class="title">Our location
                                </div>
                                <div class="line"></div>
                            </div>
            
                        </div>-->
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
            <!--            <div style="overflow:hidden;height:775px;width:100%;">
                            <div id="gmap_canvas" style="height:775px;width:100%;"></div>
                            <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
                            <a class="google-map-code" href="http://premium-wordpress-themes.org" id="get-map-data">themes wordpress premium</a>
                        </div>-->
            <script type="text/javascript">
    function init_map() {
        var myOptions = {zoom: 12, scrollwheel: false, center: new google.maps.LatLng(28.584216, 77.317874), mapTypeId: google.maps.MapTypeId.ROADMAP};
        map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
        marker = new google.maps.Marker({map: map, position: new google.maps.LatLng(28.584216, 77.317874)});
        infowindow = new google.maps.InfoWindow({content: "<b>D-26, Sector -2,</b><br/>Gautam Budh nagar,<br/> Noida , UP, India"});
        google.maps.event.addListener(marker, "click", function () {
            infowindow.open(map, marker);
        });
        infowindow.open(map, marker);
    }
    google.maps.event.addDomListener(window, 'load', init_map);
            </script>
            <div class="container">
                <div class="section-content">
                    <div style="padding-bottom: 70px" class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="box mbn">
                                <div class="box-heading">Fill the form below</div>
                                <div class="box-body">
                                    <?= $this->Form->create('Contact', array('class' => 'form-contact', 'id' => 'conatct_frm', 'role' => 'form')); ?>
                                    <div class="form-group">
                                        <label class="control-label mll">Your name <span class="required">*</span></label>
                                        <?= $this->Form->input('name', array('id' => 'name', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Name', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter name.')); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mll">Mobile Number <span class="required">*</span></label>
                                        <?= $this->Form->input('mobile_number', array('id' => 'mobile_number', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Mobile Number', 'label' => false, 'data-bvalidator' => 'required,number,minlength[10]', 'data-bvalidator-msg' => 'Please enter mobile number.')); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label mll">Your email <span class="required">*</span></label>
                                        <?= $this->Form->input('email', array('id' => 'email', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Email', 'label' => false, 'data-bvalidator' => 'required,email', 'data-bvalidator-msg' => 'Please enter email.')); ?>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label mll">Message</label>
                                        <?= $this->Form->input('message', array('id' => 'message', 'type' => 'textarea', 'class' => 'form-control', 'placeholder' => 'Message', 'label' => false, 'data-bvalidator' => 'required', 'data-bvalidator-msg' => 'Please enter message.')); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="g-recaptcha" data-sitekey="6LdZwhkTAAAAAGUAMd_KE6_K3ZuY5wSG-Reco8wW" style="margin:0 auto !important;" align="center"></div>
                                        </div>
                                    </div>
                                    <div class="form-group mtxxl text-center mbn">
                                        <?= $this->Form->input('submit message', array('type' => 'submit', 'id' => 'submit', 'class' => 'btn btn-outlined btn-primary', 'label' => false)); ?>
                                    </div>
                                    <?= $this->Form->end(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="box mbn">
                                <div class="box-heading">Contact us</div>
                                <div class="box-body">
                                    <div id="gmap_canvas" style="height:400px;width:100%;"></div>
                                    <div class="contact-infos" style="margin-top:10px">
                                        <ul class="list-unstyled">
                                            <li>
                                                <i class="fa fa-map-marker fa-fw"></i>D-26, Sector -2, Gautam Budh nagar, Noida , UP, India
                                            </li>
                                            <li><i class="fa fa-phone fa-fw"></i>01204164011</li>
                                            <li><i class="fa fa-mobile fa-fw"></i>7379-825-666</li>
                                            <li><a href="mailto:support@feish.online"><i class="fa fa-envelope fa-fw"></i>support@feish.online</a></li>
                                            <li><a href="feish.online" target="_blank"><i class="fa fa-globe fa-fw"></i>www.feish.online</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
<script src='https://www.google.com/recaptcha/api.js'></script>
<!--<style>
    #wrapper .header-bg-wrapper #header-bg {
        background: url("../../feish/img/backgrounds/bg_header_1.jpg") no-repeat center center;
        background-size: cover ;
        height: 200px ;
    }

</style>    -->