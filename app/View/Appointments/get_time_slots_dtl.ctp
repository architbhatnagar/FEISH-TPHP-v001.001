<?php if (!empty($working_hours)): ?>
    <div class="form-group">
        <label for="inputPassword1" class="col-lg-6 col-sm-6 control-label">Select Timing</label>

    </div>
    <table class="table table-bordered">
        <?php $i = 0; ?>
        <tr>

            <td>
                <?php foreach ($working_hours as $key => $slot): ?>

                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-sm btn-success all_tmi" id='slot_div<?= $i ?>'  slot_id="<?= $i ?>" slot_value="<?= $key ?>" style="color:#000; margin-bottom: 10px;"><?= $slot ?></label>
                        <?php $i++; ?>
                    </div>

                <?php endforeach; ?>
            </td>
        </tr>
        <?= $this->Form->input('Appointment][time_slot]', array('type' => 'hidden', 'id' => 'time_slot', 'label' => false)); ?>
    </table>
    <style type="text/css">
        .active_li{
            background-color: #ec6459 !important;
            border-color: #ec6459 !important;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#submit_btn").show();
            $("#no_submit_btn").hide();
            $(".all_tmi").click(function () {
                var slot = $(this).attr('slot_id');
                var slot_value = $(this).attr('slot_value');
                $("#time_slot").val(slot_value);
                $(".all_tmi").removeClass('active_li');
                $(".all_tmi").removeClass('active');
                $("#slot_div" + slot).addClass('active_li');
            });
        });
    </script>

<?php else: ?>
    <div class='alert alert-warning'>
        Sorry...!! Time Slot Not Available.
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#submit_btn").hide();
            $("#no_submit_btn").show();
        });
    </script>

<?php endif; ?>
