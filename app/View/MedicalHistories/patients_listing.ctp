<div class="container"> 
    <div class="row">
        <div class="section-heading text-center" >
            <div class="title"><h2>Patients Like You</h2> 
                <div class="pull-right">                      
                    <a href="/users/dashboard" class="btn btn-sm btn-success popovers home"><i class="fa fa-backward"></i> &nbsp;Back</a>
                    <!--<a class="btn btn-sm btn-success popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>-->
                </div>
            </div>
            <div class="line"></div>
        </div>
        <div class="section-content">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div class="" style="padding-left: 30px;">

                                <?= $this->Form->create('MedicalHistory',array('class'=>'form-horizontal','role'=>'form'));?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <?php $medicalConditionList[0]='All';ksort($medicalConditionList);?>
                                        <?php echo $this->Form->input('conditions', array('options' => $medicalConditionList, 'id' => 'conditions', 'class' => 'form-control', 'label' => false)); ?>

                                    </div>

                                    <div class="col-md-6">
                                        <?php echo $this->Form->input('search_text', array('id' => 'text', 'placeholder' => 'Short Description About Medical Problem...', 'class' => 'form-control', 'label' => false)); ?>
                                    </div>

                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-success  form-control" style="min-width:70px;">Search</button>
                                    </div>

                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div id="map_div_design" hidden="">
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <div id="map" style="width: 100%; height: 400px;" class="map_div_design">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <a class="btn btn-default" id="hide_location" title="Hide Map"><i class="fa fa-times"></i></a>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

<?= $this->Form->end();?>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <!-- page inner content start-->
    <div class="section-content">
        <div class="row">
            <?php
            if (count($patientListings) > 0) {
                foreach ($patientListings as $patientListing):
                    ?>
                    <div class="col-md-6 patient_div" id="result_<?php echo $patientListing['MedicalHistory']['conditions'] - 1 ?>">
                        <div class="doctor">
                            <div class="wrap">
                                <div class="row t-top">
                                    <div class="col-lg-3">
                                        <img class="img-responsive" src="http://www.feish.online/demo/theme/patient/images/service.png">
                                        <div style="margin-top:5px;" class="center">
                                            <div class="row">
                                                <div class="col-lg-2"></div>
                                                <div class="col-lg-8">
                                                </div>
                                                <div class="col-lg-2"></div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-8">
                                        <div class="t-subject wrap_data">
                                            <h3><a href="<?= Router::url(array('controller' => 'medical_histories', 'action' => 'patient_details', $patientListing['MedicalHistory']['id'])); ?>"><?= ucwords($patientListing['User']['first_name'] . " " . $patientListing['User']['last_name']) ?></a></h3>
                                            <div class="pos"><?php echo "PA-000" . $patientListing['MedicalHistory']['user_id']; ?></div>
                                        </div>
                                        <div class="t-name">
                                            <div class="des">
                                                <?=
                                                $this->Text->truncate($patientListing['MedicalHistory']['description'], 200, array(
                                                    'ellipsis' => '...',
                                                    'exact' => false
                                                ));
                                                ?>
                                                <span><a href="<?= Router::url(array('controller' => 'medical_histories', 'action' => 'patient_details', $patientListing['MedicalHistory']['id'])); ?>" class="morelink">read more</a></span>
                                            </div>
                                        </div>
                                        <div class="social-info">
                                            <a href="<?= Router::url(array('controller' => 'medical_histories', 'action' => 'patient_details', $patientListing['MedicalHistory']['id'])); ?>"> 
                                                <button class="btn btn-primary">Message Now</button>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endforeach;
            } else {
                ?>
                <div class="alert alert-danger">
                    <i class="fa fa-exclamation-circle mrl"></i>No records found
                </div>
            <?php } ?>
        </div>
    </div>
    <?php if (count($patientListings) > 0) { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6" style="margin-top: 1em;">
                        <p>
                            <?php
                            echo $this->Paginator->counter(array(
                                'format' => __('Showing {:current} to {:end} of {:count} entries')
                            ));
                            ?>
                        </p>
                    </div>
                    <div class="col-md-6">
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
    <?php } ?>
</div>
<style type="text/css">
    .doctor{
        min-height: 176px !important;
    }
</style>

<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places'></script>

<?= $this->Html->script(array('front_end/locationpicker.jquery.js')) ?>
<script>
                $(document).ready(function () {
                  
                });

</script>
