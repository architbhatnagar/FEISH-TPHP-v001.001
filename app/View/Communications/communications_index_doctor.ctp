<div class="col-sm-12">
    <ul class="breadcrumbs-alt">
        <li>
            <a href="javascript:void(0);">Dashboard</a>
        </li>
        <li>
            <a class="current" href="javascript:void(0);">Messages</a>
        </li>
        <li class="pull-right">
            <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
        </li>
    </ul>
    <section class="panel">
        <header class="panel-heading">
            Messages
        </header>
        <div class="panel-body">
            <div class="adv-table">
                <table class="table table table-inbox table-hover ">
                    <thead>
                        <?php if (count($communications) > 0) { ?>
                            <tr>
                                <th width="20%"><?php echo $this->Paginator->sort('subject'); ?> </th>
                                <th width="30%"><?php echo $this->Paginator->sort('message'); ?> </th>
                                <th><?php echo $this->Paginator->sort('User.first_name', 'Patient'); ?></th>
                                <th><?php echo $this->Paginator->sort('created', 'Date'); ?></th>
                            </tr>
                        <?php } ?>
                    </thead>
                    <tbody>
                        <?php
                        if (count($communications) > 0) {
                            foreach ($communications as $message):
                                ?>
                                <?php
                                if ($message['Communication']['new_count'] > 0):
                                    $tr_class = 'alert-info unread-text';
                                else:
                                    $tr_class = '';
                                endif;
                                ?>
                                <tr class="<?= $tr_class ?>">
                                    <td>
                                        <a href="<?= Router::url(array('controller' => 'communications', 'action' => 'view_doc_communication', $message['Communication']['id'])); ?>">
                                            <strong>  
                                                <?=
                                                $this->Text->truncate(ucfirst($message['Communication']['subject']), 20, array(
                                                    'ellipsis' => '...',
                                                    'exact' => false
                                                ));
                                                ?>
                                            </strong> 
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?= Router::url(array('controller' => 'communications', 'action' => 'view_doc_communication', $message['Communication']['id'])); ?>">

                                            <?=
                                            $this->Text->truncate(ucfirst($message['Communication']['message']), 30, array(
                                                'ellipsis' => '...',
                                                'exact' => false
                                            ));
                                            ?>
                                        </a>
                                    </td>

                                    <td>
                                        <?php if ($message['User']['id'] != null): ?>
                                            <?php if ($message['User']['id'] != AuthComponent::user('id')): ?>
                                                <a href="<?= Router::url(array('controller' => 'communications', 'action' => 'view_doc_communication', $message['Communication']['id'])); ?>">

                                                    <?= $salutations[$message['User']['salutation']] . ". " . $message['User']['first_name'] . " " . $message['User']['last_name'] ?>
                                                </a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            Admin
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= Router::url(array('controller' => 'communications', 'action' => 'view_doc_communication', $message['Communication']['id'])); ?>">

                                            <?= date('d-M-Y  h:i A', strtotime($message['Communication']['created'])); ?>
                                        </a>
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
                    </tbody>
                </table>

                <?php if (count($communications) > 0) { ?>
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
        </div>
    </section>
</div>
