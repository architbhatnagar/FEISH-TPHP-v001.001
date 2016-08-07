<div class="col-sm-12">
    <ul class="breadcrumbs-alt">
        <li>
            <a href="javascript:void(0);">Dashboard</a>
        </li>
        <li>
            <!--<a class="" href="<?= Router::url(array('controller' => 'communications', 'action' => 'doctor_communications')) ?>">Messages</a>-->
            <a class="" href="<?= Router::url(array('controller' => 'communications', 'action' => 'communications_index_doctor')) ?>">Messages</a>
        </li>
        <li>
            <a class="current" href="#">Details</a>
        </li>
        <li class="pull-right">
            <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
        </li>
    </ul>
    <div class="row">
        <div class="col-lg-12">
            <a href="#" id="reply" class="btn btn-sm btn-danger pull-right" style="margin-top:-5px;"><i class="fa fa-reply">&nbsp;Reply</i></a>
            <br/>   
            <div  id="reply_form" hidden>

                <div class="panel reply_panel panel-info    ">
                    <div class="panel-heading">
                        Reply       
                        <a href="#" id="close_reply" class="btn btn-sm btn-danger pull-right" style="margin-top:-5px;"><i class="fa fa-times">&nbsp;close</i></a>

                    </div>
                    <div class="panel-body" style="border:2px solid #bce8f1">
                        <div class="form">
                            <?= $this->Form->create('Communication', array('class' => 'cmxform form-horizontal', 'type' => 'file', 'id' => 'reply-msg')); ?>
 <div class="form-group">
                                <label for="message" class="control-label col-lg-2">Subject (required)</label>
                                <div class="col-lg-10">
                                    <?= $this->Form->input('subject', array("data-bvalidator" => "required", 'type' => 'text','value'=>$communication['Communication']['subject'], 'label' => false,  'class' => ' form-control')) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message" class="control-label col-lg-2">Message (required)</label>
                                <div class="col-lg-10">
                                    <?= $this->Form->input('message', array("data-bvalidator" => "required", 'type' => 'textarea', 'rows' => 6, 'label' => false, 'onkeypress' => 'return validate(event)', 'class' => 'msg_body form-control')) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="choose_file" class="control-label col-lg-2">Choose Files </label>
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
                                                 
                                            </tbody>

                                        </table>

                                    </div>
                                </div>
                                <div class="col-lg-2"></div>
                            </div>
                            <div class="form-group text-center">
                                <?= $this->Form->input('Send', array('type' => 'submit', 'class' => 'send_btn btn btn-primary btn-sm', 'label' => false)) ?>
                            </div>
                            <?= $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php foreach ($childCommunications as $mes): ?>
    <div class="panel panel-danger">
        <div class="panel-heading">
            <strong>Subject :  <?= ucwords($mes['Communication']['subject']); ?></strong>
        </div>
        <div class="panel-body">
            <div class="row">
                    <div class="col-lg-12">
                        <?php if ($mes['Communication']['user_id'] == AuthComponent::user('id')): ?>
                            <div class="alert alert-success">
                                <div class="row">
                                    <div class="col-lg-12"> 
                                        <div class="pull-left">
                                            From:<?= $salutations[AuthComponent::user('salutation')] . " " . AuthComponent::user('first_name') . " " . AuthComponent::user('last_name') ?>
                                        </div>
                                        <div class="pull-right">
                                            <?= date('d-M-Y h:i A', strtotime($mes['Communication']['created'])); ?>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-12"> 
                                        <div class="pull-left">
                                            <?= $mes['Communication']['message']; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if (!empty($mes['Communication']['uploaded_files'])): ?>
                                    <div class="row">
                                        <div class="col-lg-12"> 
                                            <div id="gallery" class="media-gal isotope">
                                                <?php $files = explode(',', $mes['Communication']['uploaded_files']); ?>

                                                <?php foreach ($files as $file): ?>
                                                    <?php $ext = pathinfo($file, PATHINFO_EXTENSION); ?>
                                                    <div class="images item  isotope-item col-sm-2 col-lg-2 col-sm-2 col-xs-2">
                                                        <a href="#">
                                                            <?= $this->Html->image('file_types/' . strtolower($ext) . '.png', array('alt' => '')) ?>
                                                        </a>
                                                        <p>
                                                            <a href="<?= Router::url(array('controller' => 'communications', 'action' => 'download_attachment', $file)); ?>" class="btn btn-xs btn-warning popovers" data-toggle="popover" data-content="Download Attachment" data-placement="bottom" data-trigger="hover" data-original-title="" title=""><i class="fa fa-download"></i></a>
                                                        </p>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                <div class="row">
                                    <div class="col-lg-12"> 
                                        <div class="pull-left">
                                            <?php if ($mes['User']['id'] != null): ?>
                                                From : <?= $salutations[$mes['User']['salutation']] . ". " . $mes['User']['first_name'] . " " . $mes['User']['last_name'] ?>
                                            <?php else: ?>
                                                From :  Admin
                                            <?php endif; ?>
                                        </div>
                                        <div class="pull-right">
                                            <?= date('d-M-Y h:i A', strtotime($mes['Communication']['created'])); ?>
                                        </div>


                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-12"> 
                                        <div class="pull-left">
                                            <?= $mes['Communication']['message']; ?>
                                        </div>


                                    </div>
                                </div>
                                <?php if (!empty($mes['Communication']['uploaded_files'])): ?>
                                    <div class="row">
                                        <div class="col-lg-12"> 
                                            <div id="gallery" class="media-gal isotope">
                                                <?php $files = explode(',', $mes['Communication']['uploaded_files']); ?>

                                                <?php foreach ($files as $file): ?>
                                                    <?php $ext = pathinfo($file, PATHINFO_EXTENSION); ?>
                                                    <div class="images item  isotope-item col-sm-2 col-lg-2 col-sm-2 col-xs-2">
                                                        <a href="#">
                                                            <?= $this->Html->image('file_types/' . $ext . '.png', array('alt' => '')) ?>

                                                        </a>
                                                        <p>
                                                            <a href="<?= Router::url(array('controller' => 'communications', 'action' => 'download_attachment', $file)); ?>" class="btn btn-xs btn-warning popovers" data-toggle="popover" data-content="Download Attachment" data-placement="bottom" data-trigger="hover" data-original-title="" title=""><i class="fa fa-download"></i></a>
                                                        </p>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>


                            </div>
                        <?php endif; ?>



                    </div>
                </div>
        </div>
    </div>
<?php endforeach;?>
    <div class="panel panel-danger">
        <div class="panel-heading">
            <strong>Subject :  <?= ucwords($communication['Communication']['subject']); ?></strong>
        </div>
        <div class="panel-body">
            <div class="alert alert-warning">
                <div class="row">
                    <div class="col-lg-12"> 
                        <div class="pull-left">
                            From:
                            <?php if ($communication['User']['id'] != null): ?>
                                <?= $salutations[$communication['User']['salutation']] . " " . $communication['User']['first_name'] . " " . $communication['User']['last_name'] ?>
                            <?php else: ?>                  
                                Admin
                            <?php endif; ?> 
                        </div>
                        <div class="pull-right">
                            <?= date('d-M-Y h:i A', strtotime($communication['Communication']['created'])); ?>
                        </div>


                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-lg-12"> 
                        <div class="pull-left">
                            <?= $communication['Communication']['message']; ?>
                        </div>


                    </div>
                </div>
                <?php if (!empty($communication['Communication']['uploaded_files'])): ?>
                    <div class="row">
                        <div class="col-lg-12"> 
                            <div id="gallery" class="media-gal isotope">
                                <?php $files = explode(',', $communication['Communication']['uploaded_files']); ?>

                                <?php foreach ($files as $file): ?>
                                    <?php $ext = pathinfo($file, PATHINFO_EXTENSION); ?>
                                    <div class="images item  isotope-item col-sm-2 col-lg-2 col-sm-2 col-xs-2">
                                        <a href="#">
                                            <?= $this->Html->image('file_types/' . strtolower($ext) . '.png', array('alt' => '')) ?>

                                        </a>
                                        <p>
                                            <a href="<?= Router::url(array('controller' => 'communications', 'action' => 'download_attachment', $file)); ?>" class="btn btn-xs btn-warning popovers" data-toggle="popover" data-content="Download Attachment" data-placement="bottom" data-trigger="hover" data-original-title="" title=""><i class="fa fa-download"></i></a>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>









  
</div>

<style type="text/css">
    .drp_width{
        width: 100% !important;
    }
    .alert{
        font-size: 14px !important;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $('#reply-msg').bValidator();
        var row_cnt = 1;
        $('#add_more_file').click(function () {
            var append_desg = '<tr id=tr' + row_cnt + '><td><input type="file" name="data[Communication][file_attachment][' + row_cnt + ']" /></td><td><a class="btn btn-xs btn-danger" onclick=delete_row(' + row_cnt + ') row_id=' + row_cnt + ' ><i class="fa fa-minus"></i></a></td></tr>';

            $(append_desg).appendTo("#appened_tr_totable");
            row_cnt++;

        });
        $("#reply").click(function () {
            $('#reply_form').show();
            $('#reply').hide();
        });
        $("#close_reply").click(function () {
            $('#reply_form').hide();
            $('#reply').show();

        });

    });

    function delete_row(row_id) {
        $("#tr" + row_id).remove();
    }

    //communication validations
    $('.send_btn').on('click', function (e) {

        var text = $('.msg_body').val();
//        var digit_err = $('.msg_body').attr('digit-err');
        get_contact_length = get_numbers(text);
        if (checkIfEmailInString(text) || contact_found) {
            $('.msg_body').addClass('bvalidator_invalid');
            alert("Message can not contain Email or Contact number");
            return false;
        } else {
            $('.msg_body').removeClass('bvalidator_invalid');
        }
    });

    var get_numbers = function (text) {
        var contact_found = false;
        contact = text.match(/(\d+)/g);
        contact.forEach(function (value, index) {
            if (value.length == 10) {
                return contact_found = true;
            }
        }, this);
        return contact_found;
    }

    function checkIfEmailInString(text) {
        var re = /(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/;
        return re.test(text);
    }

    var new_val = [];
    //Function to restrict 10 digit numbers to textbox
    function validate(key)
    {
        //getting key code of pressed key
        var keycode = (key.which) ? key.which : key.keyCode;
        var phn = $('.msg_body');
        //comparing pressed keycodes
        if ((keycode < 48 || keycode > 57))
        {
//            $('.msg_body').attr('digit-err','true');
            new_val = [];
            return true;
        } else
        {
            value = $(this);
            new_val.push(value);
            //Condition to check textbox contains ten numbers or not
            if (new_val.length < 10)
            {
                $('.msg_body').removeClass('bvalidator_invalid');
                return true;
            } else
            {
                $('.msg_body').addClass('bvalidator_invalid');
//                alert("Message can not contain Email or Contact number");
//                $('.msg_body').attr('digit-err','true');
            }
        }
    }
</script>

