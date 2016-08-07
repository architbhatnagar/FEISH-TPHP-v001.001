<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <?php if ($this->Session->read('Auth.User.user_type') == 1) { ?>
                    <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>
                <?php } else if ($this->Session->read('Auth.User.user_type') == 2) { ?>
                    <a href="<?= Router::url(array('controller' => 'users', 'action' => 'doctors_dashboard')) ?>">Dashboard</a>
                <?php } ?>
            </li>
            <li>
                <a class="current" href="">Services</a>
            </li>
            <li class="pull-right">
                <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                List of Services
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" class="table table-bordered">
                        <?php if (count($services) > 0) { ?>
                        <tr>
                            <th><?php echo $this->Paginator->sort('title'); ?></th>
                            <?php if ($this->Session->read('Auth.User.user_type') == 1) { ?>
                                <th><?php echo $this->Paginator->sort('User.first_name',"Doctor's Name"); ?></th>
                            <?php } ?>
                            <th width="30%"><?php echo $this->Paginator->sort('address'); ?></th>

                            <th><?php echo $this->Paginator->sort('phone'); ?></th>
                            <th><?php echo $this->Paginator->sort('is_active'); ?></th>

                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                        <?php } ?>
                        
                        <?php
                        if (count($services) > 0) {
                            foreach ($services as $service):
                                ?>
                                <tr>

                                    <td><?php echo h($service['Service']['title']); ?>&nbsp;</td>
                                    <?php if ($this->Session->read('Auth.User.user_type') == 1) { ?>
                                        <td><?php echo h('Dr '.$service['User']['full_name']); ?>&nbsp;</td>
                                    <?php } ?>
                                    <td><?php echo h($service['Service']['address']); ?>&nbsp;</td>

                                    <td><?php echo h($service['Service']['phone']); ?>&nbsp;</td>
                                    <td><?= $yes_no[$service['Service']['is_active']]; ?></td>
                                    <td class="actions">
                                        <?php if (AuthComponent::user('user_type') == 2): ?>
                                            <?php echo $this->Html->link(__(''), array('controller' => 'services', 'action' => 'edit', $service['Service']['id']), array('class' => 'btn btn-sm btn-warning fa fa-pencil popovers', 'data-content' => 'Edit', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>
                                            <?php echo $this->Html->link(__(''), array('controller' => 'services_working_timings', 'action' => 'add', $service['Service']['id']), array('class' => 'btn btn-sm btn-danger fa fa-clock-o popovers', 'data-content' => 'Add Working Hours', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>

                                        <?php endif; ?>
                                        <?php echo $this->Html->link(__(''), array('action' => 'view', $service['Service']['id']), array('class' => 'btn btn-sm btn-primary fa fa-eye popovers', 'data-content' => 'View', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>
                                        <?php if ($service['Service']['is_active'] == 0): ?>
                                            <?php echo $this->Html->link(__(''), array('action' => 'change_status', $service['Service']['id']), array('class' => 'btn btn-sm btn-success fa fa-check popovers', 'data-content' => 'Activate', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>
                                        <?php else: ?>
                                            <?php echo $this->Html->link(__(''), array('action' => 'change_status', $service['Service']['id']), array('class' => 'btn btn-sm btn-success fa fa-times popovers', 'data-content' => 'Deactivate', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>
                                        <?php endif; ?>
                                        <?php if ($service['Service']['is_deleted'] == 0): ?>
                                            <?php echo $this->Form->postLink(__(''), array('action' => 'delete', $service['Service']['id']), array('class' => 'btn btn-sm btn-warning fa fa-trash-o popovers', 'data-content' => 'Delete', 'data-placement' => 'bottom', 'data-trigger' => 'hover'), null, __('Are you sure you want to delete # %s?', $service['Service']['title'])); ?>
                                        <?php else: ?>
                                            <?php echo $this->Form->postLink(__(''), array('action' => 'delete', $service['Service']['id']), array('class' => 'btn btn-sm btn-warning fa fa-refresh popovers', 'data-content' => 'Restore', 'data-placement' => 'bottom', 'data-trigger' => 'hover'), null, __('Are you sure you want to Restore # %s?', $service['Service']['title'])); ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        } else {
                            ?>
                            <div class="alert alert-block alert-danger">
                                <p><span class="alert-icon"><i class="fa fa-check"></i></span>&nbsp;No records found.</p>
                            </div>
                        <?php } ?>
                    </table>
                    
                    <?php if (count($services) > 0) { ?>
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="dataTables_info" id="dynamic-table_info">
                                <?php
                                echo $this->Paginator->counter(array(
                                    'format' => __(' Showing {:current} records out of {:count}.')
                                ));
                                ?>

                            </div>
                            <div class="span6">
                                <div class="">
                                    <ul class="pagination pagination-sm  pull-right">
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
        </section>
    </div>
</div>
