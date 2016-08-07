<div class="container-fluid"> 
    <div class="row" style="margin-top: 100px;">
        <div class="col-md-10">
            <div class="" style="padding-left: 30px;">
                <?= $this->Form->create('Service', array('class' => 'form-horizontal', 'role' => 'form')); ?>
                <div class="row">
                    <div class="col-md-3">
                        <?= $this->Form->input('speciality', array('empty'=>'--select--', 'options' => $specialities, 'class' => 'form-control populate', 'label' => false)); ?>
                    </div>

                    <div class="col-md-5">
                        <?= $this->Form->input('address', array('id' => 'autocomplete', 'type' => 'text', 'placeholder' => 'Enter your address', 'class' => 'form-control', 'label' => false)); ?>
                        <?= $this->Form->input('long', array('id' => 'long', 'type' => 'hidden')); ?>
                        <?= $this->Form->input('lat', array('id' => 'lat', 'type' => 'hidden')); ?>
                    </div>

                    <div class="col-md-2">
                        <?= $this->Form->input('Search', array('type' => 'submit', 'class' => 'btn btn-success  form-control', 'label' => false)); ?>
                    </div>
                    <div class="col-md-2">
                        <a href="<?= Router::url(array('controller' => 'services', 'action' => 'services_listing')) ?>" class="btn btn-success btn-md btn_styl">Clear</a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <div id="map_div_design" hidden="">
                            <div class="row">
                                <div class="col-lg-10">
                                    <div id="map" class="map_div_design">
                                        
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <a class="btn btn-default" id="hide_location" title="Hide Map"><i class="fa fa-times"></i></a>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="pull-right">
                <a href="/users/dashboard" class="btn btn-sm btn-success popovers home"><i class="fa fa-backward"></i> &nbsp;Home</a>
                <a class="btn btn-sm btn-success popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </div>
        </div>
    </div>

    <!-- Header End -->
    <!-- page inner content start-->
    <div class="row">
        <div class="col-md-12">
            <span>
                <b>
                    <?php
                    echo $this->Paginator->counter(array(
                        'format' => __('{:count}')
                    ));
                    ?>
                 services found </b>
            </span>
        </div>
    </div>
    
    <div class="row">
        <div id="contents">
            <?php $i = 0; ?>
            <?php foreach ($services as $service): ?>
                <div class="col-md-6">
                    <div class="doctor">
                        <div class="wrap">
                            <div class="row t-top ">
                                <div class="col-md-3">
                                    <div class="t-img">
                                        <a href="#" style="color:#333;font-weight:normal;">
                                            <?php if (!empty($service['Service']['logo'])): ?>
                                                <?= $this->Html->image('services/' . $service['Service']['logo'], array('class' => 'img-responsive center-block')); ?>
                                            <?php else: ?>
                                                <?= $this->Html->image('doctor_images.png', array('class' => 'img-responsive default_img_c', 'alt' => '')); ?>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                    <div style="margin-top:5px;">
                                    </div>   
                                </div>
                                <div class="col-md-8">
                                    <div class="t-subject wrap_data"><a href="<?= Router::url(array('controller' => 'services', 'action' => 'service_details', $service['Service']['id'])); ?>"><?= ucwords($service['Service']['title']) ?></a></div>
                                    <div class="t-name">
                                        <small>
                                            <div class="comment more">
                                                <?=
                                                $this->Text->truncate($service['Service']['description'], 200, array(
                                                    'ellipsis' => '...',
                                                    'exact' => false
                                                ));
                                                ?>
                                                <a href="<?= Router::url(array('controller' => 'services', 'action' => 'service_details', $service['Service']['id'])); ?>" class="morelink">read more</a>
                                            </div>
                                        </small>
                                    </div>

                                    <div class="t-education wrap_data">
                                        <i class="fa fa-map-marker fa-lg"></i> 
                                        <?= $service['Service']['address'] ?>
                                    </div>
                                    <div class="pos">
                                        <div data-rating="<?= $service['Service']['avg_rating'] ?> "  class="ratings">
                                        </div>
                                    </div>
                                    <div class="t-desc wrap_data"></div>
                                    <a href="<?= Router::url(array('controller' => 'services', 'action' => 'service_details', $service['Service']['id'])); ?>"> <button class="btn btn-primary btn-sm book-appoinment-btn pull-right">Book Appointment</button></a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++;
                if ($i % 2 == 0) { ?>
                    <!-- Add clearfix to prevent uneven col wrap -->
                    <div class="clearfix"></div>
                <?php } ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <ul class="pagination  pull-right">
                    <?php
                    echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                    echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
                    echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                    ?>                                                                          
                </ul>
            </div>    
        </div>
    </div>
</div>
<style type="text/css">
    .doctor{
        min-height: 208px !important;
    }
</style>

<script type="text/javascript" src='http://maps.google.com/maps/api/js?libraries=places'></script>

<?php echo $this->Html->script(array('front_end/locationpicker.jquery.js')) ?>
<script>
    var lat = 18.5204;
    var long = 73.8567;
    $(document).ready(function () {
        if (window.navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                //  console.log(position);
                window.lat = position.coords.latitude;
                window.long = position.coords.longitude;
                <?php if (isset($this->request->data['Service']['lat']) && !empty($this->request->data['Service']['lat'])): ?>
                    window.lat = '<?= $this->request->data['Service']['lat'] ?>';
                    window.long = '<?= $this->request->data['Service']['long'] ?>';
                <?php endif; ?>
                $('#map').locationpicker({
                    location: {latitude: lat, longitude: long},
                    radius: 300,
                    zoom: 13,
                    inputBinding: {
                        locationNameInput: $('#autocomplete'),
                        latitudeInput: $('#lat'),
                        longitudeInput: $('#long')
                    },
                    enableAutocomplete: true,
                    onchanged: function (currentLocation, radius, isMarkerDropped) {
                        var addressComponents = $(this).locationpicker('map').location.addressComponents;
                        $('#autocomplete').val(addressComponents.district);
                    },
                    oninitialized: function (component) {

                        var addressComponents = $(component).locationpicker('map').location.addressComponents;
                        $('#autocomplete').val(addressComponents.district);
                    }
                });
            });
        } else {
            $('#map').locationpicker({
                location: {latitude: lat, longitude: long},
                radius: 300,
                zoom: 5,
                inputBinding: {
                    locationNameInput: $('#autocomplete')
                },
                enableAutocomplete: true,
                onchanged: function (currentLocation, radius, isMarkerDropped) {
                    var addressComponents = $(this).locationpicker('map').location.addressComponents;
                    $('#autocomplete').val(addressComponents.district);
                },
                oninitialized: function (component) {

                    var addressComponents = $(component).locationpicker('map').location.addressComponents;
                    $('#autocomplete').val(addressComponents.district);
                }
            });
        }
    });
</script>

<?= $this->Html->css(array('front_end/amazingslider-1.css')); ?>
<?= $this->Html->script(array('front_end/amazingslider.js', 'front_end/initslider-1.js')); ?>
<style type="text/css">
    .ptxxl{
        padding-top: 0px !important;
    }
    .news_cls{

    }
    .section {
        padding-bottom: 0px !important;
    }
    .slider_padding{
        padding-bottom: 80px !important;
    }
    .caption{
        min-height: 190px;
    }
    #section-patients-saying{
        height: 400px !important;
    }
    .img_size{
        height: 90px !important;
        width:90px !important;
    }
    .slider-wrapper{
        height: 277px !important;
    }
    .heading_padding{
        padding-top:10px !important;
    }
    .line{
        margin: 0 auto 24px !important;
    }

</style>
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
            path: '../img/raty/'
//                    path: '<?= WEBROOT_DIR; ?>'+'/img/raty/'
        });
    });

</script>
<style type="text/css">
    .btn_styl{
        padding: 11px 12px !important;
    }
</style>
