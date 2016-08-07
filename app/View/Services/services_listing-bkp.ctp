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
                                    <div id="map" style="width: 100%; height: 400px; position: relative; overflow: hidden; transform: translateZ(0px); background-color: rgb(229, 227, 223);" class="map_div_design">
                                        <div class="gm-style" style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;">
                                            <div style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0; cursor: url(&quot;http://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;) 8 8, default;">
                                                <div style="position: absolute; left: 0px; top: 0px; z-index: 1; width: 100%; transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);">
                                                    <div style="transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;">
                                                        <div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
                                                            <div aria-hidden="true" style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;"><div style="width: 256px; height: 256px; transform: translateZ(0px); position: absolute; left: -121px; top: -22px;"></div>

                                                            </div>                                                            
                                                        </div>   
                                                    </div>
                                                    <div style="transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;">
                                                        <div style="position: absolute; left: 0px; top: 0px; z-index: 30;">
                                                            <div aria-hidden="true" style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;">
                                                                <div style="width: 256px; height: 256px; overflow: hidden; transform: translateZ(0px); position: absolute; left: -121px; top: -22px;">
                                                                    <canvas width="256" height="256" draggable="false" style="width: 256px; height: 256px; -webkit-user-select: none; position: absolute; left: 0px; top: 0px;"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div>
                                                    <div style="transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;">
                                                        <div style="position: absolute; left: 0px; top: 0px; z-index: -1;">
                                                            <div aria-hidden="true" style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;">
                                                                <div style="width: 256px; height: 256px; overflow: hidden; transform: translateZ(0px); position: absolute; left: -121px; top: -22px;"></div>
                                                            </div>
                                                        </div>
                                                        <div style="width: 22px; height: 40px; overflow: hidden; position: absolute; left: -11px; top: -40px; z-index: 0;">
                                                            <img src="http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 22px; height: 40px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                                        </div>
                                                    </div>
                                                    <div style="position: absolute; z-index: 0; transform: translateZ(0px); left: 0px; top: 0px;">
                                                        <div style="overflow: hidden;"></div>
                                                    </div>
                                                    <div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
                                                        <div aria-hidden="true" style="position: absolute; left: 0px; top: 0px; z-index: 1; visibility: inherit;"></div>
                                                    </div>

                                                </div>
                                                <div style="position: absolute; left: 0px; top: 0px; z-index: 2; width: 100%; height: 100%;"></div>
                                                <div style="position: absolute; left: 0px; top: 0px; z-index: 3; width: 100%; height: 100%;"></div>
                                                <div style="position: absolute; left: 0px; top: 0px; z-index: 4; width: 100%; transform-origin: 0px 0px 0px; transform: matrix(1, 0, 0, 1, 0, 0);">
                                                    <div style="transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div>
                                                    <div style="transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div>
                                                    <div style="transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;">
                                                        <div class="gmnoprint" style="width: 22px; height: 40px; overflow: hidden; position: absolute; opacity: 0.01; left: -11px; top: -40px; z-index: 0;">
                                                            <img src="http://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi.png" draggable="false" usemap="#gmimap0" style="position: absolute; left: 0px; top: 0px; width: 22px; height: 40px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;"><map name="gmimap0" id="gmimap0"><area href="javascript:void(0)" log="miw" coords="8,0,5,1,4,2,3,3,2,4,2,5,1,6,1,7,0,8,0,14,1,15,1,16,2,17,2,18,3,19,3,20,4,21,5,22,5,23,6,24,7,25,7,27,8,28,8,29,9,30,9,33,10,34,10,40,11,40,11,34,12,33,12,30,13,29,13,28,14,27,14,25,15,24,16,23,16,22,17,21,18,20,18,19,19,18,19,17,20,16,20,15,21,14,21,8,20,7,20,6,19,5,19,4,18,3,17,2,16,1,14,1,13,0,8,0" shape="poly" title="Drag Me" style="cursor: pointer;"></map>
                                                        </div>
                                                    </div>
                                                    <div style="transform: translateZ(0px); position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;">
                                                        <div style="z-index: -202; cursor: pointer; transform: translateZ(0px); display: none;">
                                                            <div style="width: 30px; height: 27px; overflow: hidden; position: absolute;">
                                                                <img src="http://maps.gstatic.com/mapfiles/undo_poly.png" draggable="false" style="position: absolute; left: 0px; top: 0px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 90px; height: 27px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="padding: 15px 21px; border: 1px solid rgb(171, 171, 171); font-family: Roboto, Arial, sans-serif; color: rgb(34, 34, 34); box-shadow: rgba(0, 0, 0, 0.2) 0px 4px 16px; z-index: 10000002; display: none; width: 0px; height: 0px; position: absolute; left: 5px; top: 5px; background-color: white;">
                                                <div style="padding: 0px 0px 10px; font-size: 16px;">Map Data</div>
                                                <div style="font-size: 13px;"></div>
                                                <div style="width: 13px; height: 13px; overflow: hidden; position: absolute; opacity: 0.7; right: 12px; top: 12px; z-index: 10000; cursor: pointer;">
                                                    <img src="http://maps.gstatic.com/mapfiles/api-3/images/mapcnt6.png" draggable="false" style="position: absolute; left: -2px; top: -336px; width: 59px; height: 492px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                                </div>
                                            </div>
                                            <div class="gmnoprint" style="z-index: 1000001; position: absolute; right: 0px; bottom: 0px; width: 12px;"><div draggable="false" class="gm-style-cc" style="-webkit-user-select: none; height: 14px; line-height: 14px;"><div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;"><div style="width: 1px;"></div><div style="width: auto; height: 100%; margin-left: 1px; background-color: rgb(245, 245, 245);"></div></div><div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;"><a style="color: rgb(68, 68, 68); text-decoration: none; cursor: pointer; display: none;">Map Data</a><span style="display: none;"></span></div></div></div><div class="gmnoscreen" style="position: absolute; right: 0px; bottom: 0px;"><div style="font-family: Roboto, Arial, sans-serif; font-size: 11px; color: rgb(68, 68, 68); direction: ltr; text-align: right; background-color: rgb(245, 245, 245);"></div>

                                            </div>
                                            <div class="gmnoprint gm-style-cc" draggable="false" style="z-index: 1000001; -webkit-user-select: none; height: 14px; line-height: 14px; position: absolute; right: 0px; bottom: 0px;">
                                                <div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
                                                    <div style="width: 1px;"></div>
                                                    <div style="width: auto; height: 100%; margin-left: 1px; background-color: rgb(245, 245, 245);"></div>
                                                </div>
                                                <div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;">
                                                    <a href="https://www.google.com/intl/en-US_US/help/terms_maps.html" target="_blank" style="text-decoration: none; cursor: pointer; color: rgb(68, 68, 68);">Terms of Use</a>
                                                </div>
                                            </div>
                                            <div style="width: 25px; height: 25px; overflow: hidden; display: none; margin: 10px 14px; position: absolute; top: 0px; right: 0px;">
                                                <img src="http://maps.gstatic.com/mapfiles/api-3/images/sv5.png" draggable="false" class="gm-fullscreen-control" style="position: absolute; left: -52px; top: -86px; width: 164px; height: 112px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;">
                                            </div>
                                            <div draggable="false" class="gm-style-cc" style="-webkit-user-select: none; height: 14px; line-height: 14px; display: none; position: absolute; right: 0px; bottom: 0px;">
                                                <div style="opacity: 0.7; width: 100%; height: 100%; position: absolute;">
                                                    <div style="width: 1px;"></div>
                                                    <div style="width: auto; height: 100%; margin-left: 1px; background-color: rgb(245, 245, 245);"> </div> 
                                                </div>
                                                <div style="position: relative; padding-right: 6px; padding-left: 6px; font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); white-space: nowrap; direction: ltr; text-align: right; vertical-align: middle; display: inline-block;">
                                                    <a target="_new" title="Report errors in the road map or imagery to Google" href="https://www.google.com/maps/@18.5177794,73.9367419,13z/data=!10m1!1e1!12b1?source=apiv3&amp;rapsrc=apiv3" style="font-family: Roboto, Arial, sans-serif; font-size: 10px; color: rgb(68, 68, 68); text-decoration: none; position: relative;">Report a map error</a>
                                                </div>
                                            </div>
                                            <div class="gmnoprint gm-bundled-control gm-bundled-control-on-bottom" draggable="false" controlwidth="0" controlheight="0" style="margin: 10px; -webkit-user-select: none; position: absolute; display: none; bottom: 0px; right: 0px;">
                                                <div class="gmnoprint" style="display: none; position: absolute;">
                                                    <div draggable="false" style="-webkit-user-select: none; box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; border-radius: 2px; cursor: pointer; background-color: rgb(255, 255, 255);">
                                                        <div title="Zoom in" style="position: relative;">
                                                            <div style="overflow: hidden; position: absolute;">
                                                                <img src="http://maps.gstatic.com/mapfiles/api-3/images/tmapctrl.png" draggable="false" style="position: absolute; left: 0px; top: 0px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 120px; height: 54px;">
                                                            </div>
                                                        </div>
                                                        <div style="position: relative; overflow: hidden; width: 67%; height: 1px; left: 16%; background-color: rgb(230, 230, 230);"></div>
                                                        <div title="Zoom out" style="position: relative;">
                                                            <div style="overflow: hidden; position: absolute;">
                                                                <img src="http://maps.gstatic.com/mapfiles/api-3/images/tmapctrl.png" draggable="false" style="position: absolute; left: 0px; top: 0px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none; width: 120px; height: 54px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gmnoprint" controlwidth="28" controlheight="0" style="display: none; position: absolute;">
                                                    <div title="Rotate map 90 degrees" style="width: 28px; height: 28px; overflow: hidden; position: absolute; border-radius: 2px; box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; cursor: pointer; display: none; background-color: rgb(255, 255, 255);">
                                                        <img src="http://maps.gstatic.com/mapfiles/api-3/images/tmapctrl4.png" draggable="false" style="position: absolute; left: -141px; top: 6px; width: 170px; height: 54px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                                    </div>
                                                    <div class="gm-tilt" style="width: 0px; height: 0px; overflow: hidden; position: absolute; border-radius: 2px; box-shadow: rgba(0, 0, 0, 0.298039) 0px 1px 4px -1px; top: 0px; cursor: pointer; background-color: rgb(255, 255, 255);"><img src="http://maps.gstatic.com/mapfiles/api-3/images/tmapctrl4.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 170px; height: 54px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px; max-width: none;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin-left: 5px; margin-right: 5px; z-index: 1000000; position: absolute; left: 0px; bottom: 0px;">
                                                <a target="_blank" href="https://maps.google.com/maps?ll=18.517779,73.936742&amp;z=13&amp;t=m&amp;hl=en-US&amp;gl=US&amp;mapclient=apiv3" title="Click to see this area on Google Maps" style="position: static; overflow: visible; float: none; display: inline;">
                                                    <div style="width: 66px; height: 26px; cursor: pointer;"><img src="http://maps.gstatic.com/mapfiles/api-3/images/google4.png" draggable="false" style="position: absolute; left: 0px; top: 0px; width: 66px; height: 26px; -webkit-user-select: none; border: 0px; padding: 0px; margin: 0px;">
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
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

<?= $this->Html->script(array('front_end/locationpicker.jquery.js')) ?>
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
    'front_end/layout.js',
    'back_end/jquery.raty.js'
));
?>
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
