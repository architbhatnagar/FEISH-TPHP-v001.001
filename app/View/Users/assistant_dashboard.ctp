<div class="row">
    <div class="col-md-4">
        <section class="panel event-calendar clearfix">
            <div class="panel-body">
                <div class="todo-action-bar">
                    <div class="row">
                        <div class="col-xs-6 btn-todo-select">
                            <a class="btn btn-md btn-default btn-danger" id="open_frm_appointment" data-toggle="modal" href="#addNewAppointment"><i class="fa fa-plus"></i> Book  Appointment</a>
                        </div>
                    </div>
                </div>
                <div class="cal-day">
                    <span>Today's Appointments <b id="apt_cnt">(<?= count($appointments) ?>)</b></span>
                </div>

                <ul class="event-list">
                    <?php foreach ($appointments as $apt): ?>

                        <li class=''>
                            <i class="fa fa-user"></i> <?= $salutations[$apt['User']['salutation']] . ". " . $apt['User']['first_name'] . " " . $apt['User']['last_name']; ?> <?php
                            if ($apt['Appointment']['status'] == 2) {
                                echo " @" . date('h:i a', strtotime($apt['Appointment']['scheduled_date']));
                            } else {
                                echo " @" . date('h:i a', strtotime($apt['Appointment']['appointed_timing']));
                            }
                            ?><a href="#" class="pull-right expand_li" apt_id="<?= $apt['Appointment']['id'] ?>"><i class="fa fa-expand"></i></a>
                        </li>
                        <div class="row" id="apt_dtl<?= $apt['Appointment']['id']; ?>" hidden>
                            <div class="col-lg-12">
                                <div class="alert alert-warning">
                                    <table class="table table-hover">
                                        <tr>
                                            <td>Service Name : <?= $apt['Service']['title'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Doctor Name:<?= $salutations[$apt['Doctor']['salutation']] . ". " . $apt['Doctor']['first_name'] . " " . $apt['Doctor']['last_name'] ?>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>

                        </div>

                    <?php endforeach; ?>

                </ul>
            </div>
        </section>
    </div>
    <div class="col-md-8">
        <section class="panel" id="book_appointment" hidden>
            <div class="panel-body">
                <!-- page start-->
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Book Appointment <a class="btn btn-default btn-sm pull-right" id="close_apt_frm"><i class="fa fa-times"></i></a>
                            </header>
                            <div class="panel-body">
                                <div class="">
                                    <?= $this->Form->create('Appointment', array('controller' => 'appointments', 'action' => 'book_appointment_by_ass', 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'book_appointment_frm', 'novalidate')); ?>
                                    <div class="form-body">
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12">
                                                <label class="control-label ">Mobile<span class="required">*</span></label>
                                                <?= $this->Form->input('mobile_no', array('id' => 'mobile', 'class' => 'form-control', 'label' => false, 'data-bvalidator' => 'required')); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-2 col-sm-2">
                                                <label class="control-label ">Salutation <span class="required">*</span></label>
                                                <?= $this->Form->input('salutation', array('id' => 'salutation', 'options' => $salutations, 'empty' => 'Select', 'label' => false, 'class' => 'form-control', 'tabindex' => 1, 'data-bvalidator' => 'required')); ?>
                                            </div>
                                            <div class="col-md-5 col-sm-5">
                                                <label class="control-label ">First Name <span class="required">*</span></label>
                                                <?= $this->Form->input('first_name', array('id' => 'first_name', 'class' => 'form-control', 'placeholder' => 'First Name', 'label' => false, 'tabindex' => 2, 'data-bvalidator' => 'alpha,minlength[3],required')); ?>
                                            </div>
                                            <div class="col-md-5 col-sm-5">
                                                <label class="control-label ">Last Name <span class="required">*</span></label>
                                                <?= $this->Form->input('last_name', array('id' => 'last_name', 'class' => 'form-control', 'placeholder' => 'Last Name', 'label' => false, 'tabindex' => 3, 'data-bvalidator' => 'alpha,minlength[3],required')); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12">
                                                <label class="control-label ">Email ID <span class="required">*</span></label>
                                                <?= $this->Form->input('email', array('id' => 'email_id', 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Email ID', 'label' => false, 'tabindex' => 4, 'data-bvalidator' => 'email,required')); ?> 
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12">
                                                <div style="margin-bottom: 20px; margin-top: 20px">
                                                    <label class="control-label ">Sex <span class="required">*</span></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <?php
                                                    $options = array(1 => '  Male', 2 => '  Female');
                                                    $attributes = array(
                                                        'id' => 'gender',
                                                        'legend' => false, 'separator' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                                                        'data-bvalidator' => 'required');
                                                    ?>
                                                    <?php echo $this->Form->radio('gender', $options, $attributes); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="service_show" hidden>
                                            <div class="col-md-12 col-sm-12">
                                                <label class="control-label ">Services <span class="required">*</span></label>
                                                <?= $this->Form->input('service_id', array('id' => 'service_id', 'options' => array('0' => 'No Service'), 'empty' => 'Select Service', 'class' => 'form-control', 'autocomplete' => 'off', 'label' => false, 'tabindex' => 4, 'onchange' => 'getPlanName(this.value)')); ?> 
                                            </div>
                                        </div>
                                        <div class="form-group" id="plan_type" hidden="">
                                            <div class="col-md-12 col-sm-12">
                                                <label class="control-label ">Plan Name <span class="required">*</span></label>
                                                <?= $this->Form->input('plan_id', array('id' => 'plan_id', 'options' => array('0' => 'No Plan'), 'empty' => 'Select Plan Name', 'class' => 'form-control', 'autocomplete' => 'off', 'label' => false, 'tabindex' => 5)); ?> 
                                            </div>
                                        </div>
                                        <?= $this->Form->input('user_id', array('type' => 'hidden', 'id' => 'id')); ?>
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6">
                                                <label class="control-label ">Date <span class="required">*</span></label>
                                                <?= $this->Form->input('appointment_date', array('id' => 'apt_date', 'type' => 'text', 'class' => 'form-control col-lg-4', 'label' => false, 'data-bvalidator' => 'required')); ?>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <?= $this->Form->input('redirect', array('type' => 'hidden', 'value' => 'doctors_dashboard')); ?>
                                            <div id="cant_purchase" hidden>
                                                <div class="alert alert-warning">
                                                    Sorry.. No Service is purchase by this patient.
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <div id="append_ts">

                                                    </div>

                                                </div>
                                            </div>


                                            <div class="form-group" id="submit_btn_div">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <button type="submit" id="submit_btn" class="btn btn-success">Book</button>
                                                    <a href="#" id="no_submit_btn" class="btn btn-success" hidden>Book</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?= $this->Form->end(); ?>
                                    </div>
                                </div>
                        </section>

                    </div>
                </div>
                <!-- page end-->
            </div>
        </section>
        <section class="panel">
            <div class="panel-body">
                <!-- page start-->
                <div class="row">
                    <aside class="col-lg-12">
                        <div id="calendar" class="has-toolbar"></div>
                    </aside>
                </div>
                <!-- page end-->
            </div>
        </section>
    </div>
</div>


<div class="modal fade" id="appointmentDetailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Appointment Details</h4>
            </div>  
            <div class="modal-body">
                <div id="append_detail">

                </div>
            </div>

        </div>

    </div>

</div>

<?= $this->html->css(array('back_end/fullcalendar/fullcalendar.min.css', 'back_end/bootstrap-datetimepicker/css/datetimepicker.css')); ?>
<?= $this->Html->script(array('back_end/fullcalendar/fullcalendar.js', 'back_end/bootbox/bootbox.js', 'back_end/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')); ?>
<script>
    function getPlanName(val){
    //alert(val);
    var base_path = "<?= Router::url('/', true) ?>";
            var urls = base_path + "users/get_user_purchased_plan";
            $.ajax({
            method: "POST",
                    url: urls,
                    type:'json',
                    data: { user_id:$('#id').val(), service_id:val},
                    success: function(result){
                    $('#plan_type').show();
                            //alert(result);
                            var list_arr = $.parseJSON(result);
                            if (list_arr.length != 0) {
                    $("#plan_id").empty();
                            $("#plan_id").append(
                            $("<option></option>").text('Select').val('')
                            );
                            //console.log(list_arr);
                            $.each(list_arr, function (i, val) {
                            $("#plan_id").append(
                                    $("<option></option>").text(val).val(i)
                                    );
                            });
                            $("#plan_id").attr('data-bvalidator', 'required');
                    } else{
                    $("#plan_type").hide();
                            //  $("#service_id").attr('data-bvalidator','');
                            $("#plan_id").attr('data-bvalidator', '');
                    }
                    }
            });
    }
</script>    
<script>
    var max_year = "<?= date('Y', strtotime('+1 year')) ?>";
            var min_year = "<?= date('Y') ?>";
            $(document).ready(function(){
    $("#no_submit_btn").hide();
            $('#book_appointment_frm').bValidator();
            $('#apt_date').datepicker({
    format: 'yyyy-mm-dd',
            autoclose: true,
            //  startDate: '-3m',
            minDate:new Date(),
    });
            $(".expand_li").click(function(){
    var apt_id = $(this).attr('apt_id');
            $(".all_li__div").hide();
            $("#apt_dtl" + apt_id).toggle();
    });
            $("#apt_date").change(function(){
    var s_date = $(this).val();
            var patient_id = $("#id").val();
            var service_id = '';
            service_id = $("#service_id").val();
            if (s_date != ''){
    var base_path = "<?= Router::url('/', true) ?>";
            var urls = base_path + "appointments/get_time_slots_ass_dashboard";
            $.ajax({
            method: "POST",
                    url: urls,
                    type:'html',
                    data: { apt_date: s_date, patient_id:patient_id, service_id:service_id},
                    success: function(result){
                    $('#append_ts').html('');
                            $('#append_ts').html(result);
                    }
            });
    }

    });
            $("#patient_id").change(function(){
    var patient_id = $(this).val();
            var s_date = $("#apt_date").val();
            if (s_date != '' && patient_id != ''){
    var base_path = "<?= Router::url('/', true) ?>";
            var urls = base_path + "appointments/get_time_slots";
            $.ajax({
            method: "POST",
                    url: urls,
                    type:'html',
                    data: { apt_date: s_date, patient_id:patient_id},
                    success: function(result){
                    $('#append_ts').html('');
                            $('#append_ts').html(result);
                    }
            });
    }

    });
            $("#open_frm_appointment").click(function(){
    $("#book_appointment").show();
    });
            $("#close_apt_frm").click(function(){
    $("#book_appointment").hide();
    });
            $('#calendar').fullCalendar({
    header: {
    left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
    },
            defaultDate: '<?= date('Y-m-d'); ?>',
            editable: false,
            /*eventResize: function(event, delta, revertFunc) {
             alert(event.id + " end is now " + event.end.format());
             if(!confirm("Are you sure about to change appointment duration?"))
             {
             revertFunc();
             }
             },*/
            slotEventOverlap: false,
            forceEventDuration: true,
            slotDuration: '00:10:00',
            defaultTimedEventDuration: '00:10:00',
            eventOverlap: false,
            eventDrop: function(event, delta, revertFunc) {
            bootbox.confirm("Are you sure about to change appointment timing?", function(result) {
            if (result == true)
            {
            $.ajax({
            method: "POST",
                    url: "http://www.feish.online/demo/assistant/dashboard/change_timing",
                    data: { id: event.id, start_time: event.start.format() },
                    success: function(result){
                    location.reload(); //alert('Appointment timing updated.');
                    }
            });
            }
            else if (result == false)
            {
            revertFunc();
            }
            });
            },
            droppable: false,
            timeFormat: 'hh(:mm)t',
            views: {
            day: {
            displayEventEnd: true
            }
            },
            eventClick: function(calEvent, jsEvent, view) {
            var base_path = "<?= Router::url('/', true) ?>";
                    var urls = base_path + "appointments/get_details";
                    $.ajax({
                    method: "POST",
                            url: urls,
                            data: { id: calEvent.id},
                            success: function(result){
                            $('#append_detail').html(result);
                                    $('#appointmentDetailModal').modal('show');
                            }
                    });
            },
            eventLimit: true, // allow "more" link when too many events
            views: {
            agenda: {
            eventLimit: 2 // adjust to 6 only for agendaWeek/agendaDay
            }
            },
            eventLimitText: 'more',
            eventTextColor: '#000',
            events: [
<?php
$i = 0;
foreach ($all_appointments as $val) {
    $diff = strtotime(date("Y-m-d", strtotime($val['Appointment']['appointed_timing']))) - strtotime(date("Y-m-d"));
    $i++;
    ?>{
                id: '<?php echo $val['Appointment']['id']; ?>',
                        title: '<?php echo 'APT-' . $val['Appointment']['id']; ?>',
                        start: '<?php
    if ($val['Appointment']['status'] == 2) {
        echo $val['Appointment']['scheduled_date'];
    } else {
        if(!empty($val['Appointment']['scheduled_date'])){
            echo $val['Appointment']['scheduled_date'];
        } else {
        echo $val['Appointment']['appointed_timing'];
        }
    }
    ?>',
                        url: '',
    <?php
    if ($val['Appointment']['status'] == 0) {
        ?>color:'#99CCFF',<?php
    } else if ($val['Appointment']['status'] == 1) {
        ?>color:'#CCFF99',<?php
    } elseif ($val['Appointment']['status'] == 2) {
        ?>color:'#CCFF99',<?php
    } elseif ($val['Appointment']['status'] == 3) {
        ?>color:'#FB9583',<?php
    }
    ?>
                        allDay: false
                        }<?php
    if (count($all_appointments) != $i) {
        echo ",";
    }
}
?>
                    ]
            });
                    $("#mobile").blur(function(){
            $("#append_ts").html('');
                    var mobile = $(this).val();
                    if (mobile != ''){
            var base_path = "<?= Router::url('/', true) ?>";
                    var urls = base_path + "users/check_user";
                    $.ajax({
                    method: "POST",
                            url: urls,
                            type:'json',
                            data: { mobile: mobile},
                            success: function(result){
                            //  alert(result['status']);
                            var json = $.parseJSON(result);
                                    if (json.status == 1){
                            $("#salutation").val(json.User.salutation);
                                    $("#first_name").val(json.User.first_name);
                                    $("#last_name").val(json.User.last_name);
                                    $("#email_id").val(json.User.email);
                                    //$('input[name="gender"][value="' + json.User.gender + '"]').prop('checked', true);
                                    // $("#gender").val(1);
                                    //alert(json.User.gender);
                                    if (json.User.gender == 1){
                            $('#gender1').attr('checked', 'checked');
                            } else{
                            $('#gender2').attr('checked', 'checked');
                            }
//                    var $radios = $('input:radio[name=gender]');
//                    $radios.filter('[value="' + json.User.gender + '"]').prop('checked', true);
                            // $('input[name=gender]').val(json.User.gender); 
                            $("#id").val(json.User.id);
                                    if (json.User.user_type == 4){
                            $("#service_id").attr('data-bvalidator', '');
                                    var urls = base_path + "patient_package_logs/get_user_services_ass_dashboard";
                                    $.ajax({
                                    method: "POST",
                                            url: urls,
                                            type:'json',
                                            data: { user_id: json.User.id},
                                            success: function(data){
                                            console.log(data);
                                                    var list_arr = $.parseJSON(data);
                                                    if (list_arr.length != 0) {
                                            $("#cant_purchase").hide();
                                                    $("#service_show").show();
                                                    //$("#service_id").prop('disabled', false);
                                                    $("#service_id").empty();
                                                    $("#service_id").append(
                                                    $("<option></option>").text('Select').val('')
                                                    );
                                                    //console.log(list_arr);
                                                    $.each(list_arr, function (i, val) {
                                                    $("#service_id").append(
                                                            $("<option></option>").text(val).val(i)
                                                            );
                                                    });
                                                    $("#service_id").attr('data-bvalidator', 'required');
                                                    $('#apt_date').prop('disabled', false);
                                                    $("#submit_btn_div").show();
                                            } else{
                                            $("#cant_purchase").show();
                                                    $("#service_show").hide();
                                                    $("#service_id").attr('data-bvalidator', '');
                                                    $('#apt_date').prop('disabled', true);
                                                    $("#submit_btn_div").hide();
                                                    // $("#service_id").prop('disabled', true);
                                            }



                                            }
                                    });
                            } else{
                            $("#cant_purchase").hide();
                                    $("#service_id").prop('disabled', true);
                            }
                            } else{
                            $("#book_appointment_frm").removeAttr("novalidate");
                                    $("#cant_purchase").hide();
                                    $("#salutation").val('');
                                    $("#first_name").val('');
                                    $("#last_name").val('');
                                    $("#email_id").val('');
                                    $("#gender").val('');
                                    $("#id").val('');
//                    $("#service_show").hide();
                                    $("#service_id").prop('disabled', true);
                            }
                            }
                    });
            }

            });
            });
</script>