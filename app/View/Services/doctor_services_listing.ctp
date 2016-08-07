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
                    <li class="active">
                        <a href="#" aria-expanded="false">
                            Services
                        </a>
                    </li>
                    <li class="">
                        <a  href="<?= Router::url(array('controller'=>'doctor_plan_details','action'=>'view',$user['User']['id']))?>" aria-expanded="false">
                            Billing Information
                        </a>
                    </li>
                    <li class="">
                        <a  href="<?= Router::url(array('controller'=>'users','action'=>'view',$user['User']['id']))?>" aria-expanded="true">
                            Settings
                        </a>
                    </li>
                </ul>
            </header>
            <div class="panel-body">
                <div class="tab-content tasi-tab">
                    <div id="overview" class="tab-pane active">
                        <section class="panel">
                            <div class="panel-body">
                                <table cellpadding="0" cellspacing="0" class="table table-bordered">
                        <tr>
                            <th><?php echo $this->Paginator->sort('title'); ?></th>
                            <th><?php echo $this->Paginator->sort('address'); ?></th>

                            <th><?php echo $this->Paginator->sort('phone'); ?></th>
                           <th><?php echo $this->Paginator->sort('is_active'); ?></th>
                            <th><?php echo $this->Paginator->sort('is_deleted'); ?></th>

                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                        <?php foreach ($services as $service): ?>
                            <tr>

                                <td><?php echo h($service['Service']['title']); ?>&nbsp;</td>

                                <td><?php echo h($service['Service']['address']); ?>&nbsp;</td>

                                <td><?php echo h($service['Service']['phone']); ?>&nbsp;</td>
                                <td><?= $yes_no[$service['Service']['is_active']];?></td>
                                <td><?= $yes_no[$service['Service']['is_deleted']];?></td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__(''), array('action' => 'view', $service['Service']['id']), array('class' => 'btn btn-sm btn-primary fa fa-eye popovers', 'data-content' => 'View', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>
                                    <?php if ($service['Service']['is_active'] == 0): ?>
                                        <?php echo $this->Html->link(__(''), array('action' => 'change_status', $service['Service']['id'],$user['User']['id']), array('class' => 'btn btn-sm btn-success fa fa-check popovers', 'data-content' => 'Activate', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>
                                    <?php else: ?>
                                        <?php echo $this->Html->link(__(''), array('action' => 'change_status', $service['Service']['id'],$user['User']['id']), array('class' => 'btn btn-sm btn-success fa fa-times popovers', 'data-content' => 'Deactivate', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>
                                    <?php endif; ?>
                                    <?php if ($service['Service']['is_deleted'] == 0): ?>
                                        <?php echo $this->Form->postLink(__(''), array('action' => 'delete', $service['Service']['id'],$user['User']['id']), array('class' => 'btn btn-sm btn-warning fa fa-trash-o popovers', 'data-content' => 'Delete', 'data-placement' => 'bottom', 'data-trigger' => 'hover'), null, __('Are you sure you want to delete # %s?', $service['Service']['title'])); ?>
                                    <?php else: ?>
                                        <?php echo $this->Form->postLink(__(''), array('action' => 'delete', $service['Service']['id'],$user['User']['id']), array('class' => 'btn btn-sm btn-warning fa fa-refresh popovers', 'data-content' => 'Restore', 'data-placement' => 'bottom', 'data-trigger' => 'hover'), null, __('Are you sure you want to Restore # %s?', $service['Service']['title'])); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                    <div class="row-fluid">
                        <div class="span6">
                            <div class="dataTables_info" id="dynamic-table_info">
                                <?php
                                echo $this->Paginator->counter(array(
                                    'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                                ));
                                ?>

                            </div>
                            <div class="span6">
                                <div class="dataTables_paginate paging_bootstrap pagination">
                                    <?php
                                    echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
                                    echo $this->Paginator->numbers(array('separator' => ''));
                                    echo $this->Paginator->next(__('next') . ' ->', array(), null, array('class' => 'next disabled'));
                                    ?>
                                </div>
                            </div>
                        </div>



                    </div>

                                
                            </div>
                        </section>
                    </div>
             
                  
                </div>
            </div>
        </section>
    </div>
</div>





