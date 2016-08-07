<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <?php if ($this->Session->read('Auth.User.user_type') == 1) { ?>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>
            <?php } else if($this->Session->read('Auth.User.user_type') == 2){ ?>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'doctors_dashboard')) ?>">Dashboard</a>
            <?php } ?>
            </li>
            <li>
                <a class="" href="<?= Router::url(array('controller' => 'services', 'action' => 'index')) ?>">Services</a>
            </li>
            <li>
                <a class="current" href="#">Edit  Service</a>
            </li>
             <li class="pull-right">
                 <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                Edit Service
            </header>
            <div class="panel-body">
                <div class="form">
                    <div class="position-center">
                        <?php echo $this->Form->create('Service', array('id'=>'edit_service','class' => 'cmxform form-horizontal','type'=>'file', 'role' => 'form')); ?>

                        <div class="form-group">
                            <label class="col-lg-4 control-label">Facility Name</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('title', array('class' => 'form-control', 'label' => false)) ?>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="parentspeciality" class="col-lg-4 control-label">Specialty</label>
                            <div class="col-lg-8">
                                <?php $added = explode(',',$this->request->data['Service']['specialty_id']); ?>
                                <?= $this->Form->input('specialty_id', array('options' => $specialties, 'selected' => $added, 'multiple' => 'multiple', 'id' => 'specialty','data-bvalidator' => 'required', 'class' => 'populate width_class', 'label' => false)) ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-4 control-label">Description</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('description', array('id' => 'description', 'class' => 'form-control', 'label' => false)) ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label"> Logo</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('logo_new', array('type' => 'file', 'class' => 'form-control', 'label' => false)) ?>
                                 <?= $this->Form->input('logo', array('type' => 'hidden', 'class' => 'form-control', 'label' => false)) ?>
                            </div>
                        </div>
                        <div class="prf-contacts sttng">
                            <h2>Contact</h2>
                        </div>
                        <div class="form-group">
                            <div id="us5" class="col-lg-12" style="height:350px;"></div>
                        </div>
                         <div class="form-group">
                            <label class="col-lg-4 control-label">Full Address</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('address', array('data-bvalidator' => 'required', 'id' => 'autocomplete', 'class' => 'form-control', 'label' => false)) ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Place Name</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('place_name', array('data-bvalidator' => 'required', 'id' => 'us5-address', 'class' => 'form-control', 'label' => false)) ?>
                            </div>
                        </div>
                      
                        <div class="form-group">
                            <label class="col-lg-4 control-label">City</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('city', array('readonly' => 'readonly','id' => 'city', 'class' => 'form-control', 'label' => false)) ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Locality</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('locality', array('id' => 'locality', 'class' => 'form-control', 'label' => false)) ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Pin Code</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('pin_code', array('id' => 'pincode', 'class' => 'form-control', 'label' => false)) ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">State</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('state', array('readonly' => 'readonly','id' => 'state', 'class' => 'form-control', 'label' => false)) ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Country</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('country', array('id' => 'country', 'class' => 'form-control', 'label' => false)) ?>
                            </div>
                        </div>
                        <?= $this->Form->input('latitude', array('type' => 'hidden', 'id' => 'lat', 'class' => 'form-control', 'label' => false)) ?>
                        <?= $this->Form->input('longitude', array('type' => 'hidden', 'id' => 'lon', 'class' => 'form-control', 'label' => false)) ?>
                        <div class="form-group">
                            <label class="col-lg-4 control-label">Phone</label>
                            <div class="col-lg-8">
                                <?= $this->Form->input('phone', array('class' => 'form-control', 'label' => false)) ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-4 col-lg-8">
                                <?= $this->Form->input('Save', array('type' => 'submit', 'class' => 'btn btn-primary', 'label' => false)) ?>
                            </div>
                        </div>  
                        <?php echo $this->Form->end(); ?>                 </div>
                </div>
            </div>
        </section>
    </div>
</div>

<style type="text/css">
    .width_class{
        width: 100%;
    }
</style>
<script type="text/javascript" src='http://maps.google.com/maps/api/js?libraries=places'></script>
<?= $this->Html->script(array('front_end/locationpicker.jquery.js')); ?>
<script>
    $(document).ready(function () {
        $("#edit_service").bValidator();
        $("#specialty").select2();
        function updateControls(addressComponents, currentLocation) {
            console.log(currentLocation);
            $('#us5-address').val(addressComponents.addressLine1 + " " + addressComponents.addressLine2);
            $('#city').val(addressComponents.city);
            $('#state').val(addressComponents.stateOrProvince);
            $('#locality').val(addressComponents.district);
            $('#pincode').val(addressComponents.postalCode);
            $('#country').val(addressComponents.country);

            $('#lat').val(currentLocation.latitude);
            $('#lon').val(currentLocation.longitude);
        }
        $('#us5').locationpicker({
            location: {latitude: '<?= $this->request->data['Service']['latitude']?>', longitude:'<?= $this->request->data['Service']['longitude']?>' },
            radius: 300,
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#lon'),
                  locationNameInput: $('#autocomplete')
            },
            enableAutocomplete: true,
            onchanged: function (currentLocation, radius, isMarkerDropped) {
                console.log(currentLocation);
                var addressComponents = $(this).locationpicker('map').location.addressComponents;
                updateControls(addressComponents, currentLocation);
            },
            oninitialized: function (component) {
                var addressComponents = $(component).locationpicker('map').location.addressComponents;
                updateControls(addressComponents);
            }
        });
    });
</script>

