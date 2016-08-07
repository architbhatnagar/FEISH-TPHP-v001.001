<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>
            </li>
            <li>
                <a class="" href="/feish/ethnicities">Ethnicities</a>
            </li>
            <li>
                <a class="current" href="">Add Ethnicity</a>
            </li>
            <li class="pull-right">
                 <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                Add Ethnicity
            </header>
            <div class="panel-body">
                <div class="row ">
                    <div class="col-lg-4 pull-right">
                        <?php echo $this->Form->button(__('Add Ethnicity'), array('id' => 'add_new_ethnicity', 'class' => 'btn btn-success btn-sm pull-right')); ?>
                    </div>
                </div>
                <section class="panel">
                    <div class="panel-body invoice">
                        <div class="ethnicity form">
                            <?php echo $this->Form->create('Ethnicity', array('id' => 'ethnicity_form', 'class' => "form-horizontal")); ?>
                            <div id="all_ethnicity" class="row">
                                <div class="col-lg-12 col-md-12 content_div content_div_0">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Name <span class="required">*</span></label>
                                        <div class="col-sm-8">
                                            <?php echo $this->Form->input('0.name', array('data-bvalidator' => 'required', 'placeholder' => 'Enter ethnicity name', 'id' => 'kw_name_0', 'class' => 'form-control', 'label' => FALSE)); ?> 
                                        </div>
                                        <!--<div id="delete_name_0" onclick="delete_content(this.id);" class="delete_content col-sm-1"><i style="color:red;" class="fa fa-times"></i></div>-->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <?php echo $this->Form->submit(__('Save Ethnicity'), array('class' => 'btn btn-sm btn-primary btn-outlined')); ?>
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
<script>
    var counter;
    var count = 0;
    $(document).ready(function () {
        $('#ethnicity_form').bValidator();
        
        $('#add_new_ethnicity').click(function (event)
        {
            counter = ($('#all_ethnicity .content_div').length);
            counter += count;
            var newRow = $('<div class="col-lg-12 col-md-12 content_div content_div_'+counter+'"><div class="form-group"><label class="col-sm-3 control-label">Name <span class="required">*</span></label><div class="col-sm-8"><input name="data[Ethnicity]['+counter+'][name]" data-bvalidator="required" placeholder="Enter ethnicity name" class="form-control" type="text" id="kw_name_'+counter+'"></div><div id="delete_name_'+counter+'" onclick="delete_content(this.id);" class="delete_content col-sm-1"><i style="color:red;" class="fa fa-times"></i></div></div></div>');
            $('#all_ethnicity').append(newRow);
            // after adding medicine row in modal height will be autoresized.
            $('.modal').css("overflow", "auto");
            var maxHeight = -1;
            $('.invoice').each(function () {
                maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
            });
            counter++;
        });
        
    });
    
    function delete_content(id){
        console.log(id);
//        id = $(this).attr('id');
        var arr = id.split('_');
        bootbox.confirm("Are you sure about to remove?", function (result) {
            if(result)
                $('.content_div_'+arr[2]).remove();
        });
    }
    
</script>
<style>
    .delete_content {
        margin-top: 7px;
        margin-left: -14px; 
    }
</style>