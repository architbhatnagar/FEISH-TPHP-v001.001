<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>
            </li>
            <li>
                <a href="/feish/tests">Tests</a>
            </li>
            <li>
                <a class="current" href="">Edit Test</a>
            </li>
             <li class="pull-right">
                 <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                Edit Test
            </header>
            <div class="panel-body">
                <section class="panel">                                 
                    <div class="panel-body invoice">
                        <div class="tests form">
                            <?php echo $this->Form->create('Test', array('class' => "form-horizontal")); ?>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Test Name <span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <?php echo $this->Form->input('id', array('class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                    <?php echo $this->Form->input('test_name', array('class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-primary')); ?>
                                </div>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
</div>