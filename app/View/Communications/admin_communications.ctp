<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-9 col-sm-9" id="lab">
                            <div class="box last">
                                <div class="box-heading"> Communications
                                    <!--<a class="btn btn-sm btn-success pull-right popovers goBack" onclick="goBack();">-->
                                    <a class="btn btn-sm btn-success pull-right popovers goBack" href="<?= Router::url(array('controller' => 'communications', 'action' => 'admin_communications')) ?>">
                                        <i class="fa fa-backward"></i> &nbsp;Back
                                    </a>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="breadcrumbs-alt">
                                            <li>
                                                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a>
                                            </li>
                                            <li>
                                                <a class="current" href="#">Communication</a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                                <div class="section-content">
                                    <header id="filters" class="panel-heading tab-bg-dark-navy-blue">
                                        <ul class="nav nav-pills nav-justified" style="background-color: #ECECEC;">
                                            <li class="">
                                                <?php echo $this->Html->link(__('Patient to Patient'), array('action' => 'patient_communications')); ?>
                                            </li>
                                            <li class="">
                                                <?php echo $this->Html->link(__('Patient to Doctor'), array('action' => 'doctor_communications')); ?>
                                            </li>
                                            <li class="active"><a data-toggle="tab" href="#ptodr_msg1">Other Messages</a></li>
                                        </ul>
                                    </header>
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content tasi-tab">
                                        <div class = "row tab-pane active" id = "ptodr_msg1" hidden>
                                            <div class = "col-md-12 col-sm-12 col-xs-12">
                                                <div class = "box">
                                                    <br/>
                                                    <div class="box-body">
                                                        <?php if (!empty($communications)) { ?>
                                                            <div class="desc">
                                                                <table class="table table table-inbox table-hover ">
                                                                    <thead>
                                                                        <tr>
                                                                            <th><?php echo $this->Paginator->sort('subject'); ?> </th>
                                                                            <th><?php echo $this->Paginator->sort('message'); ?> </th>
                                                                            <th><?php echo $this->Paginator->sort('Service.title', 'Service'); ?></th>
                                                                            <th><?php echo $this->Paginator->sort('Reciever.first_name', 'Doctor'); ?></th>
                                                                            <th><?php echo $this->Paginator->sort('created', 'Date'); ?></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php foreach ($communications as $message): ?>
                                                                            <?php
                                                                            if ($message['Communication']['is_viewed'] == 0):
                                                                                $tr_class = 'alert-info unread-text';
                                                                            else:
                                                                                $tr_class = '';
                                                                            endif;
                                                                            ?>
                                                                            <tr class="<?= $tr_class ?>">
                                                                                <td>
                                                                                    <a href="<?= Router::url(array('controller' => 'communications', 'action' => 'view', $message['Communication']['id'])); ?>">
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
                                                                                    <a href="<?= Router::url(array('controller' => 'communications', 'action' => 'view', $message['Communication']['id'])); ?>">

                                                                                        <?=
                                                                                        $this->Text->truncate(ucfirst($message['Communication']['message']), 30, array(
                                                                                            'ellipsis' => '...',
                                                                                            'exact' => false
                                                                                        ));
                                                                                        ?>
                                                                                    </a>
                                                                                </td>
                                                                                <td>
                                                                                    <?php if(!empty($message['Communication']['service_id']) || $message['Communication']['service_id'] != 0) { ?>
                                                                                        <a href="<?= Router::url(array('controller' => 'communications', 'action' => 'view', $message['Communication']['id'])); ?>">
                                                                                            <?= $message['Service']['title'] ?>
                                                                                        </a>
                                                                                    <?php } else { ?>        
                                                                                                    --
                                                                                    <?php } ?>  
                                                                                </td>
                                                                                <td>
                                                                                    <a href="<?= Router::url(array('controller' => 'communications', 'action' => 'view', $message['Communication']['id'])); ?>">
                                                                                        <?= $salutations[$message['Reciever']['salutation']] . ". " . $message['Reciever']['first_name'] . " " . $message['Reciever']['last_name'] ?>
                                                                                    </a>
                                                                                </td>
                                                                                <td>
                                                                                    <a href="<?= Router::url(array('controller' => 'communications', 'action' => 'view', $message['Communication']['id'])); ?>">
                                                                                        <?= date('d-M-Y  h:i A', strtotime($message['Communication']['created'])); ?>
                                                                                    </a>
                                                                                </td>

                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="alert alert-danger">
                                                                <i class="fa fa-exclamation-circle mrl"></i>No records found
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="upload_pdf" class="modal fade in" role="dialog" aria-hidden="true" style="display: none; top:100px;">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <?php echo $this->form->create('Appointments', array('action' => 'upload_drugs', 'type' => 'file')); ?>
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                <h4 class="modal-title">Add Drug PDF</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <?php echo $this->Form->input('Drug file', array('type' => 'file')); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group modal-footer">
                                                <?php echo $this->Form->submit(('Upload'), array('class' => 'btn btn-warning btn-md')); ?>
                                            </div>
                                        </div>
                                        <?php echo $this->form->end(); ?>
                                        <!--end modal content-->
                                    </div>
                                </div>
                                
                                <?php if (!empty($communications)) { ?>
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
                                <?php } ?>
                            </div>
                        </div>
                        <?= $this->element('front_layout_rightbar'); ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .unread-text {
        font-weight: bold;
    }
</style>