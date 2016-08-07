<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row ptxxl">
                        <div class="col-md-9 col-sm-9" id="lab">
                            <div class="box last">
                                <div class="box-heading"> Communications
                                </div>
                            </div>


                            <div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="breadcrumbs-alt">
                                            <li>
                                                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'dashboard')) ?>">Dashboard</a>
                                            </li>
                                            <li>
                                                <a class="" href="#">Communication</a>
                                            </li>
                                            <li>
                                                <a class="current" href="#">Compose</a>
                                            </li>
                                        </ul>

                                        <div class="panel reply_panel">
                                            <div class="panel-body">
                                                <div class="form">
                                                    <?= $this->Form->create('Communication', array('class' => 'cmxform form-horizontal')); ?>
                                                  
                                                    <div class="form-group">
                                                        <label for="service_id" class="control-label col-lg-2">Service Name (required)</label>
                                                        <div class="col-lg-10">
                                                            <?= $this->Form->input('service_id', array('options' => $services,'multiple'=>'multiple', 'class' => 'drp_width', 'label' => false,'id'=>'service_id')); ?>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="message" class="control-label col-lg-2">Message (required)</label>
                                                        <div class="col-lg-10">
                                                            <?= $this->Form->input('message', array('type' => 'textarea', 'rows' => 4, 'label' => false, 'class' => 'form-control ckeditor')) ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="choose_file" class="control-label col-lg-2">Choose Files (required)</label>
                                                        <div class="col-lg-8">
                                                            <div class="panel-body">
                                                                <table class="table table-bordered appened_tr" id="appened_tr_totable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="2"><a class="btn btn-xs btn-primary pull-right" id="add_more_file">
                                                                                    <i class="fa fa-plus"></i>
                                                                                </a> </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Choose Files</th>
                                                                            <th>Actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr id="tr0">
                                                                            <td>
                                                                                <?= $this->Form->input('file_attachment[0]', array('type' => 'file', 'class' => '','label'=>false)); ?>
                                                                            </td>
                                                                            <td>
                                                                                <a class="btn btn-xs btn-danger del_row" row_id="0" onclick="delete_row(0)">
                                                                                    <i class="fa fa-minus"></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>

                                                                </table>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2"></div>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <?= $this->Form->input('Send', array('type' => 'submit', 'class' => 'btn btn-primary btn-sm')) ?>
                                                    </div>
                                                    <?= $this->Form->end(); ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3">
                            <div class="box">
                                <div class="box-heading">Shortcuts</div>
                                <div class="box-body">
                                    <nav class="list-category-news">
                                        <ul class="list-unstyled">
                                            <li><a href="javascript:void(0);">Add Treatment History</a></li>
                                            <li><a href="javascript:void(0);">View / Update Profile</a></li>
                                            <li><a href="javascript:void(0);">Change Password</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-heading">Last Viewed Services</div>
                                <div class="box-body">
                                    <div class="list-most-commented">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="javascript:void(0);">
                                                    <img src="http://www.feish.online/demo/theme/admin/images/service.png" alt="" class="media-image">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="media-heading">
                                                    <a href="javascript:void(0);" class="title">Dentalwiz-City Point Dental Care</a>
                                                </div>
                                                <div class="info">
                                                    <span class="time"><i class="fa fa-clock-o"></i>1 month ago</span>
                                                    <span class="comment"><i class="fa fa-eye"></i>(23)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="javascript:void(0);">
                                                    <img src="http://www.feish.online/demo/theme/admin/images/service.png" alt="" class="media-image">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="media-heading">
                                                    <a href="javascript:void(0);" class="title">OM Dental Clinic</a>
                                                </div>
                                                <div class="info">
                                                    <span class="time"><i class="fa fa-clock-o"></i>2 months ago</span>
                                                    <span class="comment"><i class="fa fa-eye"></i>(1121)</span>
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
        </div>
    </div>
</div>
<?php echo $this->Html->css(array('back_end/bootstrap-wysihtml5/bootstrap-wysihtml5.css','back_end/select2/select2.css'));
echo $this->Html->script(array('back_end/select2/select2.js'));
?>

<style type="text/css">
    .drp_width{
        width: 100% !important;
    }
    </style>
<script type="text/javascript">
    $(document).ready(function () {


        var row_cnt = 1;

        $('#add_more_file').click(function () {
            var append_desg = '<tr id=tr' + row_cnt + '><td><input type="file" class="form-control" name="file_attachment[' + row_cnt + ']" /></td><td><a class="btn btn-xs btn-danger" onclick=delete_row(' + row_cnt + ') row_id=' + row_cnt + ' ><i class="fa fa-minus"></i></a></td></tr>';
            //  $('#append_tr > tr:last').after(append_desg);
            //alert(append_desg);
            //$("#append_tr").append('hoiiiii');
            $(append_desg).appendTo("#appened_tr_totable");
            row_cnt++;

        });
        
          $("#communicated_users").select2();
        $("#service_id").select2({
            allowClear: true,
            maximumSelectionSize: 1,
            placeholder: "Click here and start typing to select service."
        });

    });
    function submit_form()
    {
        $("#selected_users").val($("#communicated_users").val());
        document.forms['reply-form'].submit();
    }
    function delete_row(row_id) {
        $("#tr" + row_id).remove();
    }
</script>

