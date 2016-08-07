<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <?php if ($this->Session->read('Auth.User.user_type') == 1) { ?>
                    <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>
                <?php } else if ($this->Session->read('Auth.User.user_type') == 2) { ?>
                    <a href="<?= Router::url(array('controller' => 'users', 'action' => 'doctors_dashboard')) ?>">Dashboard</a>
                <?php } ?>
            </li>
            <li>
                <a href="<?= Router::url(array('controller' => 'services', 'action' => 'index')) ?>">Services</a>
            </li>
            <li>
                <a href="javascript:void(0);"><?= $service_name['Service']['title'] ?></a>
            </li>
            <li>
                <a class="current" href="">Add Working Hours</a>
            </li>
             <li class="pull-right">
                 <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <?php echo $this->Session->flash(); ?>
        <div class="col-lg-5">
            <section class="panel" id="section">
                <header class="panel-heading">
                    Add Working Hours <a class="btn btn-xs btn-default pull-right" id="clear_edit">Clear Edit</a>
                </header>
                <div class="panel-body">
                    <?= $this->Form->create('ServicesWorkingTiming', array('class' => 'cmxform form-horizontal bucket-form', 'role' => 'form')); ?>

                    <?= $this->Form->input('open_time', array('id' => 'open_time', 'type' => 'hidden', 'label' => false)); ?>
                    <?= $this->Form->input('close_time', array('id' => 'close_time', 'type' => 'hidden', 'label' => false)); ?>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Day</label>
                        <div class="col-lg-9">
                            <?= $this->Form->input('day_of_week', array('options' => $week_days, 'id' => 'week_day', 'class' => 'form-control populate', 'label' => false)); ?>
                            <?= $this->Form->input('id', array('type' => 'hidden', 'id' => 'time_id')); ?>
                            <div style="padding-top:5px;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Time range</label>
                        <div class="col-lg-9">
                            <div id="range-slider" class="range-slider"></div>
                            <span id="range-time" class="range-time"></span>
                            <div style="padding-top:5px;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-4 col-lg-8">
                            <?= $this->Form->submit('Add', array('class' => 'btn btn-primary')); ?>
                        </div>
                    </div>
                    <?= $this->Form->end(); ?>       
                </div>                 
            </section>
        </div>
        <div class="col-lg-7">
            <section class="panel" id="section">
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked col-md-3">
                        <?php foreach ($week_days as $key => $week_day): ?>

                            <?php if ($key == 0):
                                ?>
                                <li class="active"><a data-toggle="pill" href="#day<?= $key; ?>"><?= $week_day; ?></a></li>
                            <?php else: ?>
                                <li><a data-toggle="pill" href="#day<?= $key; ?>"><?= $week_day; ?></a></li>
                            <?php endif; ?>

                        <?php endforeach; ?>

                    </ul>
                    <div class="tab-content col-md-9">
                        <?php foreach ($day_wise_timimg as $key => $day_timings): ?>
                            <?php
                            if ($key == 0): $active = 'active';
                            else: $active = '';
                            endif;
                            ?>
                            <div id="day<?= $key ?>" class="tab-pane fade in <?= $active ?>">
                                <h4>Working Hours for <b><?= $week_days[$key] ?></b></h4>
                                <div id="table">
                                    <span id="span_msg<?= $key; ?>" style="color:red;" hidden> Sorry..!! Time slot could not be deleted;</span>
                                    <table id="editable-sample" class="table table-hover general-table">
                                        <thead>
                                            <tr>
                                                <th>Open Time</th>
                                                <th>Close Time</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
    <?php if (!empty($day_timings) && is_array($day_timings)): ?>
        <?php foreach ($day_timings as $time_slot): ?>
                                                    <tr id="wr_tr<?= $time_slot['ServicesWorkingTiming']['id'] ?>">
                                                        <td><?= date('h:i a', strtotime($time_slot['ServicesWorkingTiming']['open_time'])); ?></td>
                                                        <td><?= date('h:i a', strtotime($time_slot['ServicesWorkingTiming']['close_time'])); ?></td>
                                                        <td>
                                                            <a onclick="edit_timing(<?= $time_slot['ServicesWorkingTiming']['id'] ?>,<?= $time_slot['ServicesWorkingTiming']['day_of_week'] ?>,<?= "'" . $time_slot['ServicesWorkingTiming']['open_time'] . "'" ?>,<?= "'" . $time_slot['ServicesWorkingTiming']['close_time'] . "'" ?>);" class="btn btn-xs btn-primary popovers" data-content="Edit" data-placement="top" data-trigger="hover" data-original-title="" title=""><i class="fa fa-pencil"></i></a>
                                                            <a onclick="delete_timing(<?= $time_slot['ServicesWorkingTiming']['id'] ?>,<?= $key ?>);" class="btn btn-xs btn-danger popovers" data-content="Delete" data-placement="top" data-trigger="hover" data-original-title="" title=""><i class="fa fa-trash-o"></i></a>
                                                        </td>
                                                    </tr>
        <?php endforeach; ?>
    <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
<?php endforeach; ?>

                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#clear_edit").hide();
        $("#clear_edit").click(function () {
            $("#time_id").val('');
            $("#week_day").val(0);
            $(this).hide();
            $(".range-slider").slider({
        range: true,
        min: 0,
        max: 1440,
        values: [540, 1140],
        step: 30,
        slide: slideTime,
        //change: updateOpeningHours
    });
      $('.range-time').html('9:00 AM - 7:00 PM');
        $('#open_time').val('9:00 AM');
        $('#close_time').val('7:00 PM');
        });
    });
    $(".range-slider").slider({
        range: true,
        min: 0,
        max: 1440,
        values: [540, 1140],
        step: 30,
        slide: slideTime,
        //change: updateOpeningHours
    });
    slideTime({target: $('.range-slider')});
    function slideTime(event, ui)
    {
        if (ui !== undefined) {
            var hours1 = Math.floor(ui.values[0] / 60);
            var minutes1 = ui.values[0] - (hours1 * 60);

            var hours2 = Math.floor(ui.values[1] / 60);
            var minutes2 = ui.values[1] - (hours2 * 60);
        }
        else
        {
            var val0 = $(event.target).slider('values', 0);
            var val1 = $(event.target).slider('values', 1);

            var hours1 = Math.floor(val0 / 60);
            var minutes1 = val0 - (hours1 * 60);

            var hours2 = Math.floor(val1 / 60);
            var minutes2 = val1 - (hours2 * 60);
        }
        if (hours1.length == 1)
        {
            hours1 = '0' + hours1;
        }
        if (minutes1.length == 1)
        {
            minutes1 = '0' + minutes1;
        }
        if (minutes1 == 0)
        {
            minutes1 = '00';
        }

        if (hours1 >= 12)
        {
            if (hours1 == 12)
            {
                hours1 = hours1;
                minutes1 = minutes1 + " PM";
            }
            else
            {
                hours1 = hours1 - 12;
                minutes1 = minutes1 + " PM";
            }
        }
        else
        {

            hours1 = hours1;
            minutes1 = minutes1 + " AM";
        }
        if (hours1 == 0)
        {
            hours1 = 12;
            minutes1 = minutes1;
        }

        if (hours2.length == 1)
        {
            hours2 = '0' + hours2;
        }
        if (minutes2.length == 1)
            minutes2 = '0' + minutes2;
        if (minutes2 == 0)
            minutes2 = '00';
        if (hours2 >= 12) {
            if (hours2 == 12) {
                hours2 = hours2;
                minutes2 = minutes2 + " PM";
            }
            else if (hours2 == 24) {
                hours2 = 11;
                minutes2 = "59 PM";
            }
            else {
                hours2 = hours2 - 12;
                minutes2 = minutes2 + " PM";
            }
        }
        else {
            hours2 = hours2;
            minutes2 = minutes2 + " AM";
        }
        $('.range-time').html(hours1 + ':' + minutes1 + " - " + hours2 + ':' + minutes2);
        $('#open_time').val(hours1 + ':' + minutes1);
        $('#close_time').val(hours2 + ':' + minutes2);
    }
    function delete_timing(id, msg_key) {

        var ans = confirm('Are you sure you want to delete this time slot?');

        if (ans == true) {
            var base_path = "<?= Router::url('/', true) ?>";
            //  var id=$(this).attr()
            var urls = base_path + "services_working_timings/delete/" + id;
            $.ajax({
                url: urls,
                dataType: 'json'
            }).done(function (res_data) {
                if (res_data == 1) {
                    $("#wr_tr" + id).hide();
                    $("#span_msg" + msg_key).hide();
                } else {
                    $("#span_msg" + msg_key).show();
                }
            });
        }

    }
    function edit_timing(id, week_day, start, end) {
     $("#clear_edit").show();
        $("#time_id").val(id);
        $("#week_day").val(week_day);
        $("#open_time").val(start);
        $("#close_time").val(end);
        a = start.split(':');
        s_min = (+a[0]) * 60 + (+a[1]);
        a = end.split(':');
        e_min = (+a[0]) * 60 + (+a[1]);
        $(".range-slider").slider({
            range: true,
            min: 0,
            max: 1440,
            values: [s_min, e_min],
            step: 30,
            slide: slideTime
                    //change: updateOpeningHours
        });

        var val0 = s_min;
        var val1 = e_min;

        var hours1 = Math.floor(val0 / 60);
        var minutes1 = val0 - (hours1 * 60);

        var hours2 = Math.floor(val1 / 60);
        var minutes2 = val1 - (hours2 * 60);

        if (hours1.length == 1)
        {
            hours1 = '0' + hours1;
        }
        if (minutes1.length == 1)
        {
            minutes1 = '0' + minutes1;
        }
        if (minutes1 == 0)
        {
            minutes1 = '00';
        }

        if (hours1 >= 12)
        {
            if (hours1 == 12)
            {
                hours1 = hours1;
                minutes1 = minutes1 + " PM";
            }
            else
            {
                hours1 = hours1 - 12;
                minutes1 = minutes1 + " PM";
            }
        }
        else
        {

            hours1 = hours1;
            minutes1 = minutes1 + " AM";
        }
        if (hours1 == 0)
        {
            hours1 = 12;
            minutes1 = minutes1;
        }

        if (hours2.length == 1)
        {
            hours2 = '0' + hours2;
        }
        if (minutes2.length == 1)
            minutes2 = '0' + minutes2;
        if (minutes2 == 0)
            minutes2 = '00';
        if (hours2 >= 12) {
            if (hours2 == 12) {
                hours2 = hours2;
                minutes2 = minutes2 + " PM";
            }
            else if (hours2 == 24) {
                hours2 = 11;
                minutes2 = "59 PM";
            }
            else {
                hours2 = hours2 - 12;
                minutes2 = minutes2 + " PM";
            }
        }
        else {
            hours2 = hours2;
            minutes2 = minutes2 + " AM";
        }
        $('.range-time').html(hours1 + ':' + minutes1 + " - " + hours2 + ':' + minutes2);
        $('#open_time').val(hours1 + ':' + minutes1);
        $('#close_time').val(hours2 + ':' + minutes2);

    }
</script>