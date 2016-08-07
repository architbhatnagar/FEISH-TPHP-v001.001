<div class="col-md-3 col-sm-3">
    <div class="box">
        <div class="box-heading">Shortcuts</div>
        <div class="box-body">
            <nav class="list-category-news">
                <ul class="list-unstyled">
                    <li><a href="<?= Router::url(array('controller' => 'users', 'action' => 'profile')) ?>">View / Update Profile</a></li>
                    <li><a href="<?= Router::url(array('controller' => 'users', 'action' => 'change_password')) ?>">Change Password</a></li>
                    <li><a href="<?= Router::url(array('controller' => 'patient_plan_details', 'action' => 'purchased_plans')) ?>">Purchased Plan</a></li>
                    <li><a href="<?= Router::url(array('controller' => 'appointments', 'action' => 'view_all')) ?>">Consultation</a></li>
                    <li><a href="<?= Router::url(array('controller' => 'services', 'action' => 'services_listing')) ?>">Consult Doctor </a></li>
                    <li><a href="<?= Router::url(array('controller' => 'vital_signs', 'action' => 'index')) ?>">Add Vital Sign</a></li>
                    <li><a href="<?= Router::url(array('controller' => 'lab_test_results', 'action' => 'index')) ?>">Add Lab Result</a></li>
                    <li><a href="<?= Router::url(array('controller' => 'medical_histories', 'action' => 'index')) ?>">Add Medical History</a></li>
                    <li><a href="<?= Router::url(array('controller' => 'family_histories', 'action' => 'index')) ?>">Add Family History</a></li>
                    <li><a href="<?= Router::url(array('controller' => 'diet_plans', 'action' => 'index')) ?>">Add Diet Plan</a></li>
                    <li><a href="<?= Router::url(array('controller' => 'treatment_histories', 'action' => 'add')) ?>">Add Treatment History</a></li>
                    <li><a href="<?= Router::url(array('controller' => 'communications', 'action' => 'patient_communications')) ?>">Messages</a></li>
                    <li><a href="<?= Router::url(array('controller' => 'medical_histories', 'action' => 'patients_listing')) ?>">Patient like me</a></li>
                    <li><a href="<?= Router::url(array('controller' => 'services', 'action' => 'services_listing')) ?>">Send New Message</a></li>
                    
                    
                </ul>
            </nav>
        </div>
    </div>
    <?PHP
    if (isset($last_viewed_services)) {
        ?>
    <div class="box">
        <div class="box-heading">Last Viewed Services</div>
        <div class="box-body">
            <div class="list-most-commented">
                    <?PHP
                    foreach ($last_viewed_services as $val) {
                        ?>
                <div class="media">
                    <div class="media-left">
                        <a href="<?php echo $this->config->item('front_url') . $this->config->item('services'); ?>/detail/<?php echo $val['service_id']; ?>">
                                    <?PHP
                                    if (!empty($val['logo'])) {
                                        ?>
                            <img src="<?php echo $this->config->item('download_url') . $val['logo']; ?>" alt="" class="media-image" />
                                        <?PHP
                                    } else {
                                        ?>
                            <img src="<?php echo $this->config->item('admin_image_url'); ?>service.png" alt="" class="media-image" />
                                        <?PHP
                                    }
                                    ?>
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="media-heading">
                            <a href="<?php echo $this->config->item('front_url') . $this->config->item('services'); ?>/detail/<?php echo $val['service_id']; ?>" class="title"><?PHP echo $val['title']; ?></a>
                        </div>
                        <div class="info">
                            <span class="time"><i class="fa fa-clock-o"></i><?PHP echo $val['added_date']; ?></span>
                            <span class="comment"><i class="fa fa-eye"></i>(<?PHP echo $val['view_counter']; ?>)</span>
                        </div>
                    </div>
                </div>
                        <?PHP
                    }
                    ?>
            </div>
        </div>
    </div>
        <?PHP
    }
    ?>
</div>