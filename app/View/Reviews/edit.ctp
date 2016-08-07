<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="#">Dashboard</a>
            </li>
            <li>
                <a href="#">Reviews</a>
            </li>
            <li>
                <a class="current" href="">Update Reviews</a>
            </li>
             <li class="pull-right">
                 <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>

        <div class="panel panel-default">
            <section class="panel">
                <header class="panel-heading">
                    Edit Review
                </header>
                <div class="reviews form">
                    <?php echo $this->Form->create('Review'); ?>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-10">
                                    <?php echo $this->Form->input('id'); ?>
                                    <label class="control-label col-lg-2">Review</label>
                                    <div class="col-lg-10">
                                        <?php echo $this->Form->input('review', array('id' => 'review', 'class' => 'ckeditor form-control', 'label' => false)); ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-offset-3 col-lg-4">
                                    <?php echo $this->Form->submit(__('Update'), array('class' => 'btn btn-outlined btn-primary')); ?>
                                </div>

                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
