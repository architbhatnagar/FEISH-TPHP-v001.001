<style>
    .col-md-12.maincontent, .content, .leftList, .rightList {
        border: 1px solid #ccc;
        padding: 15px;
        margin-bottom: 5px;
    }

    .content {
        border: 1px solid #ccc;
        padding: 15px;
    }
    p {
        margin: 0;
        font-size: 12px;
        font-weight: 700;
    }

    .invoice-title h3{
        margin: 0px;
    }
    .padding-zero {
        padding: 0px;
    }

    .leftList {

        width: 99%;
    }

    .container {padding: 10px;

    }

    .red {
        color: red;
    }

    li, .maincontent span{
        font-size: 12px;
        font-weight: 700;
    }
    ol {
        padding-left: 5px;
    }

    .main11 {
        padding: 20px;
        border: 1px solid
    }

</style>
<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'doctors_dashboard')) ?>">Dashboard</a>
            </li>
            <li>
                <a href="<?= Router::url(array('controller' => 'appointments', 'action' => 'index')) ?>">Appointments</a>
            </li>
            <li>
                <a class="current" href="">View SOAP Details</a>
            </li>
            <li class="pull-right">
                <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                View SOAP Details
            </header>
            <div class="panel-body">
                <section class="panel">
                    <div class="panel-body invoice">
                        <div class="row">
                            <div class="box-body">
                                <div class="col-md-12 col-sm-12 main11">
                                    <?php if (!empty($users_soap_history)) { ?>
                                        <div class="row">
                                            <div class="col-xs-12 ">

                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <address>
                                                            <strong>Patient Name :</strong><span><?= $salutations[$users_details['User']['salutation']] . " " . $users_details['User']['first_name'] . " " . $users_details['User']['last_name']; ?></span><br>
                                                            <strong>Mobile Number :</strong><span><?= $users_details['User']['mobile']; ?></span><br>
                                                        </address>
                                                    </div>
                                                    
                                                    <div class="col-xs-6 text-right">
                                                        <div class="col-xs-12">
                                                            <address>
                                                                <strong>Doctor Name :</strong><span><?= $salutations[$users_details['Doctor']['salutation']] . " " . $users_details['Doctor']['first_name'] . " " . $users_details['Doctor']['last_name']; ?></span><br>
                                                                <strong>Mobile Number :</strong><span><?= $users_details['Doctor']['mobile']; ?></span><br>
                                                            </address>
                                                            <div style="clear:both;"></div>
                                                        </div>
                                                        
                                                    </div>
                                                   <h3>SOAP Notes</h3> 
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="row">
                                            <caption class="caption">Identified Problem/Disease</caption>
                                            <div class="col-md-12 maincontent">
                                                <p><?= $users_soap_history['SoapNote']['disease']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <caption class="caption">Observation</caption>
                                            <div class="col-md-12 content">
                                                <p> <span> <?= $users_soap_history['SoapNote']['observation']; ?></span>
                                                </p>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 padding-zero">
                                                <caption class="caption">Dignosis</caption>
                                                <div class="leftList">
                                                    <ol>
                                                        <li><?= $users_soap_history['SoapNote']['dignosis']; ?></li>
                                                    </ol>
                                                </div>
                                            </div>
                                            <div class="col-md-6 padding-zero">
                                                <caption class="caption">Comments</caption>
                                                <div class="rightList">
                                                    <ol>
                                                        <li><?= $users_soap_history['SoapNote']['comments']; ?></li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if ($users_soap_history['SoapNote']['is_reference'] == 1) { ?>
                                            <div class="row">
                                                <caption class="caption">Reference</caption>
                                                <div class="col-md-12 maincontent">

                                                    <p>
                                                        <?= $users_soap_history['SoapNote']['reference_name']; ?>
                                                        <?= $users_soap_history['SoapNote']['reference_address']; ?>
                                                        <?= $users_soap_history['SoapNote']['reference_comments']; ?>

                                                    </p>

                                                </div>
                                            </div>
                                        <?php } ?>

                                        <a data-content="Report" data-placement="top" data-trigger="hover"  href="<?= Router::url(array('controller' => 'appointments', 'action' => 'print_report', $users_soap_history['SoapNote']['id'])) ?>" class="btn btn-info pull-right" target="_blank"><i class="fa fa-file-excel-o"></i> Print</a>
                                    <?php } else { ?>
                                        <div class="alert alert-danger">
                                            <i class="fa fa-exclamation-circle mrl"></i>No records found
                                        </div>
                                    <?php } ?>    
                                </div>
                            </div>
                        </div>

                    </div>

                    <?php echo $this->Form->end(); ?>
                </section>

            </div>
        </section>
    </div>
</div>


<script type="text/javascript">
    var counter;
    var count = 0;
    $(document).ready(function () {
        $('#add_medicines').click(function (event)
        {
            counter = ($('#medicines_table tbody tr').length) / 2;
            counter += count;
            var newRow = $('<tr id="tr_' + counter + '">\n\
                    <td class="text-center" rowspan="2"><a class="btn btn-danger" id="row_' + counter + '" onclick="remove_medicine(' + counter + ',-1)"><i class="fa fa-trash-o"></i></a></td>\n\
                    <td><input name="data[Prescription][' + counter + '][medicine_name]" placeholder="Enter medicine name" class="form-control" maxlength="255" type="text" id="PrescriptionMedicineName' + counter + '"><?php //echo $this->Form->input('', array('placeholder' => "Enter medicine name", 'class' => 'form-control', 'div' => false, 'label' => false));          ?></td>\n\
                    <td><input name="data[Prescription][' + counter + '][unit_qty]" placeholder="Enter unit quantity. e.g. 2 spoon / 1 tab" class="form-control" type="text" id="PrescriptionUnitQty' + counter + '"><?php //echo $this->Form->input('', array('placeholder' => "Enter unit quantity. e.g. 2 spoon / 1 tab", 'class' => 'form-control', 'div' => false, 'label' => false));          ?></td>\n\
                    <td><input name="data[Prescription][' + counter + '][total_qty]" placeholder="Enter total quantity. e.g. 100 ml / 10 tabs" class="form-control" type="text" id="PrescriptionToatalQty' + counter + '"><?php // echo $this->Form->input('', array('placeholder' => "Enter total quantity. e.g. 100 ml / 10 tabs", 'class' => 'form-control', 'div' => false, 'label' => false));          ?></td></tr>\n\
                    <tr id="tra_' + counter + '">\n\
                    <td><input name="data[Prescription][' + counter + '][comments]" placeholder="Enter additional comment" class="form-control" type="text" id="PrescriptionComments' + counter + '"><?php // echo $this->Form->input('', array('placeholder' => "Enter additional comment", 'class' => 'form-control', 'div' => false, 'label' => false));          ?></td>\n\
                    <td class="text-center">\n\
                        <input type="checkbox" name="data[Prescription][' + counter + '][medicine_time][0]" value="mt_morning" checked="checked"> Morning &nbsp;\n\
                        <input type="checkbox" name="data[Prescription][' + counter + '][medicine_time][1]" value="mt_noon"> Afternoon &nbsp;\n\
                        <input type="checkbox" name="data[Prescription][' + counter + '][medicine_time][3]" value="mt_eve">  Evening &nbsp;\n\
                        <input type="checkbox" name="data[Prescription][' + counter + '][medicine_time][4]" value="mt_night" checked="checked"> Night &nbsp;</td>\n\
                    <td class="text-center">\n\
                        <input type="radio" name="data[Prescription][' + counter + '][after_meal]" id="medicine_time_0" value="0"> Before Meal &nbsp;\n\
                        <input type="radio" name="data[Prescription][' + counter + '][after_meal]" id="medicine_time_1" value="1"> After Meal </td>\n\
                    </tr>');
            $('#medicines_table').append(newRow);
            // after adding medicine row in modal height will be autoresized.
            $('.modal').css("overflow", "auto");
            var maxHeight = -1;
            $('.invoice').each(function () {
                maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
            });
            if ((maxHeight + 375) < $(document).height())
            {
                $('.modal-backdrop').css("height", $(document).height());
            } else
            {
                $('.modal-backdrop').css("height", maxHeight + 375);
            }
            //$('.modal').data('bs.modal').handleUpdate();
            counter++;
        });

    });
    function remove_medicine(key, id)
    {
        bootbox.confirm("Are you sure about to remove?", function (result) {
            if (result == true)
            {
                if (id !== -1) {
                    $.ajax({
                        dataType: "html",
                        type: "POST",
                        url: "<?php echo Router::url(array('controller' => 'appointments', 'action' => 'delete_drug')); ?>",
                        data: {'id': id},
                        success: function (data, textStatus) {
                            //                        $("#div1").html(data);
                            console.log(data);
                        }
                    });
                }
                $("#tr_" + key).remove();
                $("#tra_" + key).remove();
            }
        });
        $('.modal').css("overflow", "auto");
        var maxHeight = -1;
        $('.invoice').each(function () {
            maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
        });
        if ((maxHeight + 375) < $(document).height())
        {
            $('.modal-backdrop').css("height", $(document).height());
        } else
        {
            $('.modal-backdrop').css("height", maxHeight + 375);
        }
        count++;
    }

</script>