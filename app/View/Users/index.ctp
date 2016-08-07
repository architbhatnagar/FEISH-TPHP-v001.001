<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <?php if ($this->Session->read('Auth.User.user_type') == 1) { ?>
                    <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>
                <?php } else { ?>
                    <a href="#">Dashboard</a>
                <?php } ?>
            </li>
            <li>
                <a class="current" href="">
                    <?php
                    if (!empty($user_types[$user_type])) {
                        echo $user_types[$user_type] . "s";
                    } else {
                        echo "Patients";
                    }
                    ?>
                </a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                List of <?php
                if (!empty($user_types[$user_type])) {
                    echo $user_types[$user_type] . "s";
                } else {
                    echo "Patients";
                }
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" class="table table-bordered">
                        <?php if (count($users) > 0) { ?>
                            <tr>
                                <th><?php echo $this->Paginator->sort('first_name', 'Name'); ?></th>
                                <th><?php echo $this->Paginator->sort('email'); ?></th>

                                <th><?php echo $this->Paginator->sort('mobile'); ?></th>
                                <th><?php echo $this->Paginator->sort('is_active'); ?></th>
                                <th><?php echo $this->Paginator->sort('is_deleted'); ?></th>
                                <th width="30%"><?php echo $this->Paginator->sort('qualification'); ?></th>

                                <th class="actions"><?php echo __('Actions'); ?></th>
                            </tr>
                        <?php } ?>

                        <?php
                        if (count($users) > 0) {
                            foreach ($users as $user):
                                ?>                  
                                <tr>

                                    <td><?php echo ucwords($user['User']['first_name'] . " " . $user['User']['last_name']); ?>&nbsp;</td>

                                    <td><?php echo h($user['User']['email']); ?>&nbsp;</td>

                                    <td><?php echo h($user['User']['mobile']); ?>&nbsp;</td>
                                    <td><?php echo $yes_no[$user['User']['is_active']]; ?>&nbsp;</td>
                                    <td><?php echo $yes_no[$user['User']['is_deleted']]; ?>&nbsp;</td>

                                    <td><?= $user['User']['qualification'] != "" ? $user['User']['qualification'] : "-"; ?></td>
                                    <td class="actions">
                                        <?php
                                        if (!empty($user_types[$user_type])) {
                                            if ($user['User']['user_type'] == 2):
                                                ?>
                                                <?php echo $this->Html->link(__(''), array('action' => 'view', $user['User']['id'], $user_type), array('class' => 'btn btn-sm btn-primary fa fa-eye popovers', 'data-content' => 'View', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>
                                            <?php elseif (in_array($user['User']['user_type'], array(4, 5))): ?>
                                                <?php echo $this->Html->link(__(''), array('action' => 'patient_details', $user['User']['id'], $user_type), array('class' => 'btn btn-sm btn-primary fa fa-eye popovers', 'data-content' => 'View', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>

                                                <?php
                                            endif;
                                        } else {
                                            ?>
                                            <?php // echo $this->Html->link(__(''), array('action' => 'admin_patient_view', $user['User']['id']), array('class' => 'btn btn-sm btn-primary fa fa-eye popovers', 'data-content' => 'View', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>
                                            <?php echo $this->Html->link(__(''), array('controller' => 'patient_habits', 'action' => 'patient_health_profile', $user['User']['id'], 1), array('class' => 'btn btn-sm btn-primary fa fa-eye popovers', 'data-content' => 'View', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>
                                        <?php } ?>
                                        <?php if ($user['User']['is_active'] == 0): ?>
                                            <?php echo $this->Html->link(__(''), array('action' => 'change_status', $user['User']['id'], $user_type), array('class' => 'btn btn-sm btn-success fa fa-check popovers', 'data-content' => 'Activate', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>
                                        <?php else: ?>
                                            <?php echo $this->Html->link(__(''), array('action' => 'change_status', $user['User']['id'], $user_type), array('class' => 'btn btn-sm btn-success fa fa-times popovers', 'data-content' => 'Deactivate', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>
                                        <?php endif; ?>
                                        <?php if ($user['User']['is_deleted'] == 0): ?>
                                            <?php echo $this->Form->postLink(__(''), array('action' => 'delete', $user['User']['id'], $user_type), array('class' => 'btn btn-sm btn-warning fa fa-trash-o popovers', 'data-content' => 'Delete', 'data-placement' => 'bottom', 'data-trigger' => 'hover'), null, __('Are you sure you want to delete # %s?', $user['User']['first_name'])); ?>
                                        <?php else: ?>
                                            <?php echo $this->Form->postLink(__(''), array('action' => 'delete', $user['User']['id'], $user_type), array('class' => 'btn btn-sm btn-warning fa fa-refresh popovers', 'data-content' => 'Restore', 'data-placement' => 'bottom', 'data-trigger' => 'hover'), null, __('Are you sure you want to Restore # %s?', $user['User']['first_name'])); ?>
                                        <?php endif; ?>

                                        <?php if ($user_type == 3): ?>
                                            <?php echo $this->Html->link(__(''), array('controller' => 'doctor_assistants', 'action' => 'edit', $user['User']['id']), array('class' => 'btn btn-sm btn-danger fa fa-pencil popovers', 'data-content' => 'Edit', 'data-placement' => 'bottom', 'data-trigger' => 'hover')); ?>
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
                    
                    <?php if (count($users) > 0) { ?>
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
