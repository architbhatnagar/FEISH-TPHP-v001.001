<div class="row">
    <div class="col-md-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="#">Dashboard</a>
            </li>
            <li>
                <a class="active-trail active" href="#">Doctors</a>
            </li>
            <li>
                <a class="current" href=""><?= ucwords($salutations[$user['User']['salutation']] . " " . $user['User']['first_name'] . " " . $user['User']['last_name']) ?></a>
            </li>
        </ul>
        <section class="panel">
            <div class="row">
                <div class="col-md-12">
                    <aside class="profile-nav alt">
                        <div class="user-heading alt gray-bg">
                            <div class="col-md-4">
                                <a>
                                   <?php if(!empty($this->request->data['User']['avatar'])):?>
                                           <?= $this->Html->image('user_avtar/'.$this->request->data['User']['avatar'], array('alt' => '')); ?>
                                        <?php else:?>
                                           <?= $this->Html->image('doctor.png', array('alt' => '')); ?>
                                        <?php endif;?>
                                </a>
                                <h4><?= ucwords($salutations[$user['User']['salutation']] . " " . $user['User']['first_name'] . " " . $user['User']['last_name']) ?></h4>
                                <span><b><?= $user['User']['qualification'] ?></b><br> <?= $user['User']['registration_number']; ?></span>
                            </div>
                            <div class="col-md-4">
                                <p> <i class="fa fa-envelope-o"></i> <b>Email</b> : <?= $user['User']['email'] ?></p>
                                <p> <i class="fa fa-tasks"></i> <b>Registered On</b> : <?= date('d-M-y', strtotime($user['User']['created_date'])); ?></p>
                                <p> <i class="fa fa-mobile"></i> <b>Mobile</b> : <?= $user['User']['mobile'] ?></p>
                            </div>
                            <div class="col-md-4">
                                <p><b>Last logged in on</b> : <?= date('d-M-y h:i a', strtotime($last_login['LoginDetail']['created'])); ?></p>
                                <p><?= date('D-M-y h:i a'); ?></p>
                                <a href="<?= $user['User']['facebook'] ?>" target="_blank" class="link">
                                    <i class="fa fa-facebook"></i> Facebook
                                </a>
                                <a href="<?= $user['User']['twitter'] ?>" target="_blank" class="link">
                                    <i class="fa fa-twitter"></i> Twitter
                                </a>
                                <a href="<?= $user['User']['google_plus'] ?>" target="_blank" class="link">
                                    <i class="fa fa-google-plus"></i> Google +
                                </a>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading tab-bg-dark-navy-blue">
                <ul class="nav nav-tabs nav-justified ">
                    <li class="">
                        <a href="<?= Router::url(array('controller' => 'services', 'action' => 'doctor_services_listing', $user['User']['id'])) ?>" aria-expanded="false">
                            Services
                        </a>
                    </li>
                    <li class="active">
                        <a  href="#" aria-expanded="false">
                            Billing Information
                        </a>
                    </li>
                    <li class="">
                        <a  href="<?= Router::url(array('controller' => 'users', 'action' => 'view', $user['User']['id'])) ?>" aria-expanded="true">
                            Settings
                        </a>
                    </li>
                </ul>
            </header>
            <div class="panel-body">
                <div class="tab-content tasi-tab">


                    <div id="settings" class="tab-pane  active">

                        <div class="row">
                            <div class="col-lg-12">
                                <section class="panel">
                                    <header class="panel-heading">
                                        Plan Details
                                    </header>
                                    <div class="panel-body">

                                        <div class="position-center">
                                            <div class="col-md-6 form-horizontal">
                                                <div class="form-group">
                                                    <span class="col-md-6">Package Name : </span>
                                                    <div class="col-md-6">
                                                        <span class="label label-warning label-mini"><?= $doctorPlanDetail['DoctorPackage']['name'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <span class="col-md-6">Package Price : </span>
                                                    <div class="col-md-6">
                                                        <strong>₹&nbsp;<?= $doctorPlanDetail['DoctorPackage']['price'] ?></strong>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <span class="col-md-6">Validity : </span>
                                                    <div class="col-md-6">
                                                        <strong><?= $doctorPlanDetail['DoctorPackage']['validity'] ?>&nbsp;<span>months</span></strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 form-horizontal">
                                                <div class="form-group">
                                                    <span class="col-md-6" for="startdate">Start Date : </span>
                                                    <div class="col-md-6">
                                                        <strong><?= date('d-M-y', strtotime($doctorPlanDetail['DoctorPlanDetail']['start_date'])); ?></strong>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <span class="col-md-6" for="enddate">End Date : </span>
                                                    <div class="col-md-6">
                                                        <strong><?= date('d-M-y', strtotime($doctorPlanDetail['DoctorPlanDetail']['end_date'])); ?></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class="panel">
                                    <header class="panel-heading">
                                        Transaction History
                                    </header>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th> Transaction Name</th>
                                                    <th>Transaction Type</th>

                                                    <th>Transaction Amount</th>
                                                    <th>Invoice Number</th>

                                                    <th class="actions"><?php echo __('Actions'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php  //echo '<pre>',print_r($user['DoctorAccountDetail']),'</pre>';?>
                                                <?php foreach ($user['DoctorAccountDetail'] as $tr): ?>
                                                    <tr>
                                                        <td><?php echo ucwords($tr['transaction_name']); ?>&nbsp;</td>

                                                        <td><?php echo h($tr['transaction_type']); ?>&nbsp;</td>

                                                        <td><?php echo h($tr['transaction_amount']); ?>&nbsp;</td>
                                                        <td><?= $tr['invoice_number']; ?></td>
                                                        <td class="actions">
                                                            <?php echo $this->Html->link(__(''), array('action' => 'view', $tr['id']), array('class' => 'btn btn-sm btn-primary fa fa-eye popovers', 'data-content' => 'View', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>
                                                          <?php /*  <?php if ($tr['is_active'] == 0): ?>
                                                                <?php echo $this->Html->link(__(''), array('action' => 'change_status', $tr['id'], $user['User']['id']), array('class' => 'btn btn-sm btn-success fa fa-check popovers', 'data-content' => 'Activate', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>
                                                            <?php else: ?>
                                                                <?php echo $this->Html->link(__(''), array('action' => 'change_status', $tr['id'], $user['User']['id']), array('class' => 'btn btn-sm btn-success fa fa-times popovers', 'data-content' => 'Deactivate', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>
                                                            <?php endif; ?>
                                                            <?php if ($tr['is_deleted'] == 0): ?>
                                                                <?php echo $this->Form->postLink(__(''), array('action' => 'delete', $tr['id'], $user['User']['id']), array('class' => 'btn btn-sm btn-warning fa fa-trash-o popovers', 'data-content' => 'Delete', 'data-placement' => 'bottom', 'data-trigger' => 'hover'), null, __('Are you sure you want to delete # %s?', $tr['transaction_name'])); ?>
                                                            <?php else: ?>
                                                                <?php echo $this->Form->postLink(__(''), array('action' => 'delete', $tr['id'], $user['User']['id']), array('class' => 'btn btn-sm btn-warning fa fa-refresh popovers', 'data-content' => 'Restore', 'data-placement' => 'bottom', 'data-trigger' => 'hover'), null, __('Are you sure you want to Restore # %s?', $tr['transaction_name'])); ?>
                                                            <?php endif; ?>
                                                           * *
                                                           */?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>    
                                            </tbody>
                                        </table>

                                    </div>
                                </section>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>
    </div>
</div>





