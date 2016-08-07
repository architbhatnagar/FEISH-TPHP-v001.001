<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row ptxxl">
                        <div class="col-md-12 col-sm-12">
                            <div class="box last">
                                <div class="box-heading">Medical Histories</div>
                                <div class="box-body">
                                    <div class="medicalHistories form">
                                        <?php echo $this->Form->create('MedicalHistory'); ?>
                                        <fieldset>
                                            <legend><?php echo __('Edit Medical History'); ?></legend>
                                            <?php
                                            echo $this->Form->input('id');
                                            echo $this->Form->input('conditions');
                                            echo $this->Form->input('condition_type');
                                            echo $this->Form->input('current_medication');
                                            echo $this->Form->input('description');
                                            echo $this->Form->input('date');
                                            echo $this->Form->input('user_id');
                                            ?>
                                        </fieldset>
                                        <?php echo $this->Form->end(__('Submit')); ?>
                                    </div>
                                    <div class="actions">
                                        <h3><?php echo __('Actions'); ?></h3>
                                        <ul>

                                            <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('MedicalHistory.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('MedicalHistory.id'))); ?></li>
                                            <li><?php echo $this->Html->link(__('List Medical Histories'), array('action' => 'index')); ?></li>
                                            <li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
                                            <li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
