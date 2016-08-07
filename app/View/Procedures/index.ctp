<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>
            </li>
            <li>
                <a class="current" href="">Procedures</a>
            </li>
             <li class="pull-right">
                 <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                Procedures
            </header>
            <div class="panel-body">
                <div class="row ">
                    <div class="col-lg-4 pull-right">
                        <?php echo $this->Html->link(__('New procedure'), array('action' => 'add'), array('class' => 'btn btn-success btn-sm pull-right')); ?>
                    </div>
                </div>
                <section class="panel">                                 
                    <div class="panel-body invoice">
                        <div class="procedure index">
                            <div id="procedures_table">
                                <table class="table table-bordered table-striped " id="procedure_table">
                                    <tr <?php $i = 1; ?> >
                                        <th><?php echo $this->Paginator->sort($i,'#'); ?></th>
                                        <th><?php echo $this->Paginator->sort('name'); ?></th>
                                        <th class="actions"><?php echo __('Actions'); ?></th>
                                    </tr>
                                    <?php foreach ($procedures as $procedure): ?>
                                        <tr>
                                            <td><?php echo h($i); ?>&nbsp;</td>
                                            <td><?php echo h($procedure['Procedure']['name']); ?>&nbsp;</td>
                                            <td class="actions">
                                                <?php //echo $this->Html->link(__('View'), array('action' => 'view', $vitalUnit['VitalUnit']['id'])); ?>
                                                <?php echo $this->Html->link(__('<i class="fa fa-pencil"></i>'), array('action' => 'edit', $procedure['Procedure']['id']), array('escape' => false, 'data-content' => "Edit", 'data-placement' => "top", 'data-trigger' => "hover", 'class' => "popovers btn btn-xs btn-primary btn-sm")); ?>
                                                <?php echo $this->Form->postLink(__('<i class="fa fa-times"></i>'), array('action' => 'delete', $procedure['Procedure']['id']), array('escape' => false, 'data-content' => "Delete", 'data-placement' => "top", 'data-trigger' => "hover", 'class' => "popovers btn btn-xs btn-danger btn-sm"), __('Are you sure you want to delete # %s?', $i)); ?>
                                            </td>
                                        </tr>
                                    <?php $i++; endforeach; ?>
                                </table>
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
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
</div>