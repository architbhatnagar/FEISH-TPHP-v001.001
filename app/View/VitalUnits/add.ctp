<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>
            </li>
            <li>
                <a class="" href="/feish/vital_units">Vital Units</a>
            </li>
            <li>
                <a class="current" href="">Add Vital Units</a>
            </li>
             <li class="pull-right">
                 <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                Vital Units
            </header>
            <div class="panel-body">
                <div class="row ">
                    <div class="col-lg-4 pull-right">
                        <?php echo $this->Form->button(__('Add Vital Unit'), array('id' => 'add_new_vu', 'class' => 'btn btn-success btn-sm pull-right')); ?>
                    </div>
                </div>
                <section class="panel">
                    <div class="panel-body invoice">
                        <div class="vitalUnits form">
                            <?php echo $this->Form->create('VitalUnit', array('id' => 'vu_form', 'class' => "form-horizontal")); ?>
                            <div id="all_vital_units" class="row">
                                <div class="col-lg-12 col-md-12 content_div content_div_0">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Name <span class="required">*</span></label>
                                        <div class="col-sm-9">
                                            <?php echo $this->Form->input('0.name', array('data-bvalidator' => 'required', 'placeholder' => 'Enter vital unit name', 'id' => 'vu_name_', 'class' => 'form-control', 'label' => FALSE)); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Vital Sign <span class="required">*</span></label>
                                        <div class="col-sm-8">
                                            <?php echo $this->Form->input('0.vital_sign_list_id', array('id' => 'vu_vs_list_id_', 'class' => 'form-control', 'label' => FALSE)); ?>
                                        </div>
                                        <!--<div id="delete_name_0" onclick="delete_content(this.id);" class="delete_content col-sm-1"><i style="color:red;" class="fa fa-times"></i></div>-->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                    <?php echo $this->Form->submit(__('Save Vital Unit'), array('class' => 'btn btn-sm btn-primary btn-outlined')); ?>
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
        $('#vu_form').bValidator();
        
        $('#add_new_vu').click(function (event)
        {
            counter = ($('#all_vital_units .content_div').length);
            counter += count;
            var newRow = $('<div class="col-lg-12 col-md-12 content_div content_div_'+counter+'"><div class="form-group"><label class="col-sm-3 control-label">Name <span class="required">*</span></label><div class="col-sm-9"><input name="data[VitalUnit]['+counter+'][name]" data-bvalidator="required" placeholder="Enter vital unit name" class="form-control" type="text" id="vu_name_'+counter+'"></div></div>\n\
                    <div class="form-group"><label class="col-sm-3 control-label">Vital Sign <span class="required">*</span></label><div class="col-sm-8"><select name="data[VitalUnit]['+counter+'][vital_sign_list_id]" class="form-control" type="text" id="vu_vs_list_id'+counter+'"><?php foreach($vitalSignLists as $key => $value){$key = htmlspecialchars($key); echo '<option value="'. $key .'">'. $value .'</option>';}?></select></div><div id="delete_name_'+counter+'" onclick="delete_content(this.id);" class="delete_content col-sm-1"><i style="color:red;" class="fa fa-times"></i></div></div></div>');
            $('#all_vital_units').append(newRow);
            // after adding medicine row in modal height will be autoresized.
            $('.modal').css("overflow", "auto");
            var maxHeight = -1;
            $('.invoice').each(function () {
                maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
            });
            if ((maxHeight + 375) < $(document).height())
            {
                $('.modal-backdrop').css("height", $(document).height());
            }
            else
            {
                $('.modal-backdrop').css("height", maxHeight + 375);
            }
            //$('.modal').data('bs.modal').handleUpdate();
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