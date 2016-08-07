<?PHP
if (isset($appointment_history) && !empty($appointment_history)) {
    ?>
    <div class="desc">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Timing</th>
                    <th class="text-center">Options</th>
                </tr>
            </thead>
            <tbody>
                <?PHP
                $i = 0;
                foreach ($appointment_history as $key => $value) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td class="service_title"><a href="<?= "appointment_details/" . $value['Appointment']['id']; ?>"><?PHP echo $value['Service']['title']; ?></a></td>
                        <td><?PHP echo date('d-M-Y \a\t h:i a', strtotime($value['Appointment']['appointed_timing'])); ?></td>
                        <td>
                            <div class="pull-right">

                                <a data-content="Dignosis" data-placement="top" data-trigger="hover"  href="<?php //echo $this->config->item('patient_url').$this->config->item('dashboard')."/appointment_report" ?>" class="btn btn-xs btn-info no-upper"><i class="fa fa-file-excel-o"></i> Reports</a>
                                <?php echo $this->Html->link(__('<i class="fa fa-file"></i> Add Drug'), array('action' => 'add_drugs', $value['Appointment']['id']), array('escape' => false, 'data-content' => "Add Drugs", 'data-placement' => "bottom", 'data-trigger' => "hover", 'class' => "popovers btn btn-xs btn-success btn-sm")); ?>
                                <a data-content="Dignosis" data-placement="top" data-trigger="hover"  href="#" class="btn btn-xs btn-warning no-upper"><i class="fa fa-upload"></i> Upload Drugs</a>
                            </div>
                            <div class="modal fade" id="addPrescription_<?PHP echo $value['Appointment']["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="addPrescription" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Prescription</h4>
                                        </div>
                                        <section class="panel">
                                            <div class="row setup-content tab-pane fade in active" id="<?PHP echo $value['Appointment']["id"]; ?>-step-3">
                                                <div class="col-xs-12">
                                                    <div class="col-md-12">
                                                        <section class="panel">
                                                            <div class="panel-body invoice">

                                                                <div class="row invoice-to">
                                                                    <div class="col-lg-8 pull-left">
                                                                        <h4>
                                                                            <i>Rx, <?php echo $value['User']['first_name'] . " " . $value['User']['last_name']; ?></i>
                                                                        </h4>
                                                                    </div>
                                                                    <div class="col-lg-4 pull-right">
                                                                        <a class="btn btn-success btn-sm pull-right" id="add_medicines_<?PHP echo $value['Appointment']["id"]; ?>"><i class="fa fa-plus-square"></i> Add Medicine</a>
                                                                    </div>
                                                                </div>
                                                                <div id="prescription_table">
                                                                    <table class="table table-invoice" id="medicines_table_<?PHP echo $value['Appointment']["id"]; ?>">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>Medicine Name</th>
                                                                                <th class="text-center">Unit Quantity</th>
                                                                                <th class="text-center">Total Quantity</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr id="tr_<?php echo $i; ?>">
                                                                                <td class="text-center" rowspan="2">
                                                                                    <a class="btn btn-danger" id="row_<?php echo $i; ?>" onclick="remove_medicine(this.id)"><i class="fa fa-trash-o"></i></a>
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" class="form-control" placeholder="Enter medicine name." />
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" class="form-control" placeholder="Enter unit quantity. e.g. 2 spoon / 1 tab" />
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" class="form-control" placeholder="Enter total quantity. e.g. 100 ml / 10 tabs" />
                                                                                </td>
                                                                            </tr>
                                                                            <tr id="tra_<?php echo $i; ?>">
                                                                                <td>
                                                                                    <input type="text" class="form-control" placeholder="Enter additional comment." />
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <input type="checkbox" name="morning" value="Morning" checked="checked" /> Morning&nbsp;
                                                                                    <input type="checkbox" name="morning" value="Afternoon" checked="checked" /> Afternoon&nbsp;
                                                                                    <input type="checkbox" name="morning" value="Evening" /> Evening&nbsp;
                                                                                    <input type="checkbox" name="morning" value="Night" checked="checked" /> Night
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <input type="radio" name="morning" value="Morning" /> Before Meal&nbsp;
                                                                                    <input type="radio" name="morning" value="Afternoon" checked="checked" /> After Meal
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-3 payment-method">
                                                                        <h4 class="pull-right">Things to do</h4>
                                                                    </div>
                                                                    <div class="col-lg-9 payment-method">
                                                                        <textarea type="text" name="diagnosis" class="form-control" placeholder="Add important instruction." rows="5"></textarea>
                                                                    </div>
                                                                    <h3 class="text-center inv-label itatic">Thank you for your visit</h3>
                                                                </div>
                                                            </div>
                                                            <script type="text/javascript">
                                                                $('#add_medicines_<?PHP echo $value['Appointment']["id"]; ?>').click(function (event)
                                                                {
                                                                    var counter = $('#medicines_table_<?PHP echo $value['Appointment']["id"]; ?> tbody tr').length;
                                                                    counter++;
                                                                    var newRow = $('<tr id="tr_' + counter + '"><td class="text-center" rowspan="2"><a class="btn btn-danger" id="row_' + counter + '" onclick="remove_medicine(this.id)"><i class="fa fa-trash-o"></i></a></td><td><input type="text" class="form-control" placeholder="Enter medicine name." /></td><td><input type="text" class="form-control" placeholder="Enter unit quantity. e.g. 2 spoon / 1 tab" /></td><td><input type="text" class="form-control" placeholder="Enter total quantity. e.g. 100 ml / 10 tabs" /></td></tr><tr id="tra_' + counter + '"><td><input type="text" class="form-control" placeholder="Enter additional comment." /></td><td class="text-center"><input type="checkbox" name="morning" value="Morning" checked="checked" /> Morning&nbsp;<input type="checkbox" name="morning" value="Afternoon" checked="checked" /> Afternoon&nbsp;<input type="checkbox" name="morning" value="Evening" /> Evening&nbsp;<input type="checkbox" name="morning" value="Night" checked="checked" /> Night</td><td class="text-center"><input type="radio" name="morning" value="Morning" /> Before Meal&nbsp;<input type="radio" name="morning" value="Afternoon" checked="checked" /> After Meal</td></tr>');
                                                                    $('#medicines_table_<?PHP echo $value['Appointment']["id"]; ?>').append(newRow);
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
                                                                });
                                                            </script>
                                                        </section>
                                                        <div class="text-center">
                                                            <a class="btn btn-success" onclick="javascript:return submit_prescription('<?php echo $value['Appointment']["id"]; ?>', '');"><i class="fa fa-check"></i> Submit Prescription </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
        <?PHP
    }
    ?>
            </tbody>
        </table>
    </div>
    <div class="more">
        <div class="pull-left">
    <?PHP //echo $pagination;  ?>   
        </div>
        <div class="pull-right">
    <?php /* <a href="<?PHP echo $this->config->item('patient_url') . $this->config->item('appointments'); ?>" class="btn btn-warning btn-xs">View all Appointments</a> */ ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <?PHP
} else {
    ?>
    <div class="alert alert-danger">
        <i class="fa fa-exclamation-circle mrl"></i>No records found
    </div>
    <?php
}
?>
<?=
$this->Html->script(array(
    'front_end/bootbox/bootbox.js'
));
?>
<script type="text/javascript">
    $('.nextBtn').click(function () {
        $('.nav-pills > .active').next('li').find('a').trigger('click');
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
    });
    $('.prevBtn').click(function () {
        $('.nav-pills > .active').prev('li').find('a').trigger('click');
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
    });
    function submit_prescription(id, patient_id)
    {
        var appointment_id = id;
        var patient_id = patient_id;
        var prescription = $('#prescription_table').html();

        $.ajax({
            type: "post",
            url: '<?php echo Router::url(array('controller'=>'appointments','action'=>'add_drug'));?>',
            data: "appointment_id=" + appointment_id + "&patient_id=" + patient_id + "&prescription=" + prescription,
            success: function ()
            {
                window.location.reload();
            }
        });
    }
    function remove_medicine(id)
    {
        bootbox.confirm("Are you sure about to remove?", function (result) {
            if (result == true)
            {
                $("#tr_" + id.slice(4)).remove();
                $("#tra_" + id.slice(4)).remove();
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
        }
        else
        {
            $('.modal-backdrop').css("height", maxHeight + 375);
        }
        //$('.modal').data('bs.modal').handleUpdate();
    }
    function remove_observation(id)
    {
        bootbox.confirm("Are you sure about to remove?", function (result) {
            if (result == true)
            {
                $(".div_" + id).remove();
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
        }
        else
        {
            $('.modal-backdrop').css("height", maxHeight + 375);
        }
        //$('.modal').data('bs.modal').handleUpdate();
    }
    // after changing tabs in prescription modal height will be autoresized.
    $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
        /*var target = $(e.target).attr("href"); // tab href */
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
        $('.modal').find('[autofocus]').focus();
    });
    // Every time a modal is shown, if it has an autofocus element, focus on it.
    $('.modal').on('shown.bs.modal', function () {
        $(this).find('[autofocus]').focus();
    });
</script>
<style type="text/css">
    .modal-dialog {
        padding-top: 70px !important;
    }
    .position-center {
        width: 62%;
        margin: 0 auto;
    }
    @media (min-width:768px){
        .modal-dialog {
            width: 80% !important;
        }
        .bootbox .modal-dialog {
            width: 40% !important;
        }
    }
    .invoice-header {
        border: 1px solid #ddd;
        display: inline-block;
        width: 100%;
        margin-bottom: 40px;
    }
    .invoice-title {
        background: #31708F;
        color: #fff;
        display: inline-block;
    }
    .invoice-title a img {
        height: 90px;
        width: 90px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        border: 5px solid rgba(241,242,247,0.5);
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
    }
    .invoice-info {
        margin-top: 5px;
    }
    .modal-content .panel {
        border: none;
        padding-top: 10px;
    }
    .tab-content {
        margin-top: 30px;
    }
    .stepwizard-step p {
        margin-top: 10px;
    }
    .stepwizard-row {
        display: table-row;
    }
    .stepwizard {
        display: table;
        width: 100%;
        margin-top: 25px;
        position: relative;
    }
    .stepwizard-row:before {
        top: 100px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 2px;
        background-color: #ccc;
        z-order: 0;
    }
    .stepwizard-row .active:after {
        content: " ";
        position: absolute;
        left: 40%;
        top: 101px;
        padding-bottom: 10px;
        opacity:1;
        margin: 0 auto;
        bottom: 0px;
        border: 10px solid transparent;
        border-top-color: #ccc;
    }
    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
        text-decoration: none;
        background-color: #eee;
        margin-left: 75px;
        margin-right: 75px;
    }
    .stepwizard-step i {
        font-size: 25px;
    }
    .btn-circle {
        width: 50px;
        height: 50px;
        text-align: center;
        padding: 6px 0;
        font-size: 25px;
        line-height: 1.428571429;
        border-radius: 25px;
    }
    @media( max-width : 1340px ){
        .stepwizard-step {
            margin-left: 30px !important;
            margin-right: 30px !important;
        }
    }
    @media( max-width : 1075px ){
        .stepwizard-step {
            margin-left: 10px !important;
            margin-right: 10px !important;
        }
    }
    @media( max-width : 825px ){
        .stepwizard-step {
            margin-left: 2px !important;
            margin-right: 0px !important;
        }
        .stepwizard-row:before {
            background-color: #fff !important;
        }
    }
    .table-invoice {
        margin-top:30px;
        border-spacing:5px;
        border-collapse:separate;
    }
    .table-invoice>thead>tr>th {
        border-bottom:none;
    }
    .table-invoice>tbody>tr>td {
        border-top:none;
    }
    .table-invoice thead tr th {
        background:#e8e9f0;
        border-radius:5px;
        -webkit-border-radius:5px;
        vertical-align:middle;
    }
    .table-invoice thead tr th:first-child,.table-invoice tbody tr td:first-child {
        text-align:center;
    }
    .table-invoice tbody tr td {
        background:#f5f6f9;
        border-radius:5px;
        -webkit-border-radius:5px;
        vertical-align:middle;
    }
</style>