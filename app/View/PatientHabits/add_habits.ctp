<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">

                            <div class="box last">
                                <div class="box-heading">Add Habits
                                    <div class="pull-right">
                                        <a href="/users/dashboard" class="btn btn-sm btn-success popovers home"><i class="fa fa-backward"></i> &nbsp;Home</a>
                                        <a class="btn btn-sm btn-success popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <form method="post" action="" id="add_habbit_frm" role="form" class="cmxform form-horizontal" novalidate>
                                        <div class="form-body">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>
                                                       
                                                          <div class="form-group-sm">
                                                              <div class="row">
                                                                    <div class="col-lg-2 ">
                                                                   Select Habits
                                                                    </div>
                                                                  <div class="col-lg-10 ">
                                                                      <div class="row">  
                                                                          <div class="col-lg-2 center">
                                                                             Frequency
                                                                          </div>
                                                                          <div class="col-lg-2" center>
                                                                              Unit
                                                                          </div>
                                                                          <div class="col-lg-2 center">
                                                                              
                                                                          </div>
                                                                          <div class="col-lg-2 center">
                                                                              Habit Since
                                                                          </div>
                                                                          <div class="col-lg-2 center">
                                                                              
                                                                          </div>
                                                                          <div class="col-lg-2 center">
                                                                              Stopped when?
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                    </th>
                                                   
                                                </tr>
                                                <?php foreach ($habits as $habit): ?>
                                                    <tr>
                                                        <td>
                                                            <div class="form-group-sm">
                                                                <div class="row">
                                                                    <?php if (array_key_exists($habit['Habit']['id'], $already_habit_arr)): ?>
                                                                        <div class="col-lg-2">
                                                                            <input type="checkbox" name="habits[<?= $habit['Habit']['id'] ?>][is_habit]" class="habit_click" habit_id="<?= $habit['Habit']['id'] ?>" checked=true value="1"> <?= $habit['Habit']['habit_name'] ?>  
                                                                            <input type="hidden" name="habits[<?= $habit['Habit']['id'] ?>][habit_id]" value="<?= $habit['Habit']['id'] ?>">
                                                                            <input type="hidden" name="habits[<?= $habit['Habit']['id'] ?>][id]" value="<?= $already_habit_arr[$habit['Habit']['id']]['id'] ?>">
                                                                        </div>
                                                                        <div class="col-lg-10">
                                                                            <div class="row">  
                                                                                <div id="habit_<?= $habit['Habit']['id'] ?>">
                                                                                    <div class="col-lg-4">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <input type="text" class="form-control" placeholder="Frequency" id="Frequency<?= $habit['Habit']['id'] ?>" value="<?= $already_habit_arr[$habit['Habit']['id']]['frequency'] ?>" name="habits[<?= $habit['Habit']['id'] ?>][frequency]">
                                                                                            </div>

                                                                                            <div class="col-lg-6">
                                                                                                <?= $this->Form->input('unit', array('name' => 'habits[' . $habit['Habit']['id'] . '][unit]', 'empty' => 'Select Unit', 'options' => $units, 'id' => 'Unit' . $habit['Habit']['id'], 'class' => 'form-control', 'label' => false, 'selected' => $already_habit_arr[$habit['Habit']['id']]['unit'])); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-lg-2">
                                                                                        <?= $this->Form->input('time_period', array('name' => 'habits[' . $habit['Habit']['id'] . '][time_period]', 'empty' => 'Select', 'options' => $time_period, 'id' => 'Time_period' . $habit['Habit']['id'], 'class' => 'form-control', 'label' => false, 'selected' => $already_habit_arr[$habit['Habit']['id']]['time_period'])); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-2">
                                                                                        <?= $this->Form->input('habit_since', array('name' => 'habits[' . $habit['Habit']['id'] . '][habit_since]', 'empty' => 'Habit Since', 'options' => $habit_since, 'id' => 'Habit_since' . $habit['Habit']['id'], 'class' => 'form-control', 'label' => false, 'selected' => $already_habit_arr[$habit['Habit']['id']]['habit_since'])); ?>
                                                                                    </div>

                                                                                    <div class="col-lg-2">
                                                                                        <input type="checkbox" id="Is_stopped<?= $habit['Habit']['id'] ?>" name=" habits[<?= $habit['Habit']['id'] ?>][is_stopped]" class="is_stoped" habit_id="<?= $habit['Habit']['id'] ?>" value="1" <?php if ($already_habit_arr[$habit['Habit']['id']]['is_stopped'] == 1) { ?> checked="checked" <?php } ?>> Is Stopped?
                                                                                    </div>
                                                                                    <div class="col-lg-2" id="stp_date<?= $habit['Habit']['id'] ?>"  <?php if ($already_habit_arr[$habit['Habit']['id']]['is_stopped'] != 1) { ?>hidden <?php } ?>>
                                                                                        <input type="text" id="Stopped_date<?= $habit['Habit']['id'] ?>" name="habits[<?= $habit['Habit']['id'] ?>][stopped_date]" class="form-control habbit_date" placeholder="mm/dd/yyyy" value="<?= date('m/d/Y',  strtotime($already_habit_arr[$habit['Habit']['id']]['stopped_date'])); ?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    <?php else: ?>
                                                                        <div class="col-lg-2">
                                                                            <input type="checkbox" name="habits[<?= $habit['Habit']['id'] ?>][is_habit]" class="habit_click" habit_id="<?= $habit['Habit']['id'] ?>" value="1" > <?= $habit['Habit']['habit_name'] ?>  
                                                                            <input type="hidden" name="habits[<?= $habit['Habit']['id'] ?>][habit_id]" value="<?= $habit['Habit']['id'] ?>">
                                                                        </div>
                                                                        <div class="col-lg-10">
                                                                            <div class="row">  
                                                                                <div id="habit_<?= $habit['Habit']['id'] ?>" hidden>
                                                                                    <div class="col-lg-4">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <input type="text" class="form-control" placeholder="Frequency" id="Frequency<?= $habit['Habit']['id'] ?>" name="habits[<?= $habit['Habit']['id'] ?>][frequency]">
                                                                                            </div>

                                                                                            <div class="col-lg-6">
                                                                                                <?= $this->Form->input('unit', array('name' => 'habits[' . $habit['Habit']['id'] . '][unit]', 'empty' => 'Select Unit', 'options' => $units, 'id' => 'Unit' . $habit['Habit']['id'], 'class' => 'form-control', 'label' => false)); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-lg-2">
                                                                                        <?= $this->Form->input('time_period', array('name' => 'habits[' . $habit['Habit']['id'] . '][time_period]', 'empty' => 'Select', 'options' => $time_period, 'id' => 'Time_period' . $habit['Habit']['id'], 'class' => 'form-control', 'label' => false)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-2">
                                                                                        <?= $this->Form->input('habit_since', array('name' => 'habits[' . $habit['Habit']['id'] . '][habit_since]', 'empty' => 'Habit Since', 'options' => $habit_since, 'id' => 'Habit_since' . $habit['Habit']['id'], 'class' => 'form-control', 'label' => false)); ?>
                                                                                    </div>
                                                                                    <div class="col-lg-2">
                                                                                        <input type="checkbox" id="Is_stopped<?= $habit['Habit']['id'] ?>" name=" habits[<?= $habit['Habit']['id'] ?>][is_stopped]" class="is_stoped" habit_id="<?= $habit['Habit']['id'] ?>" value="1"> Is Stopped?
                                                                                    </div>
                                                                                    <div class="col-lg-2" id="stp_date<?= $habit['Habit']['id'] ?>"  hidden>
                                                                                        <label>When</label>
                                                                                        <input type="text" id="Stopped_date<?= $habit['Habit']['id'] ?>" name="habits[<?= $habit['Habit']['id'] ?>][stopped_date]" class="form-control habbit_date" placeholder="mm/dd/yyyy">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>



                                                                    <?php endif; ?>
                                                                </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                            </table>
                                            <div class="form-group mtxxl text-center mbn"><input type="submit" class="btn btn-outlined btn-primary" name="add_patients_habits"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function () {
        $(".habit_click").click(function () {
            var checked_val = $(this).attr('checked');
            var open_row_id = $(this).attr('habit_id');
            if (checked_val == 'checked') {
                $("#add_habbit_frm").removeAttr("novalidate");
                $("#habit_" + open_row_id).show();
                //$("#Frequency"+open_row_id).addAttr('required');
                $("#Frequency" + open_row_id).attr('required', true);
                $("#Unit"+ open_row_id).attr('required', true);
                $("#Time_period"+ open_row_id).attr('required', true);
                $("#Habit_since"+ open_row_id).attr('required', true);
            } else {
//                                                                        
                $("#add_habbit_frm").attr("novalidate", "novalidate");
                $("#habit_" + open_row_id).hide();
            }
            //$("#Frequency"+open_row_id).attr('required', true);
        });
        $(".is_stoped").click(function () {
            var checked_val = $(this).attr('checked');
            var open_row_id = $(this).attr('habit_id');
            if (checked_val == 'checked') {
                $("#stp_date" + open_row_id).show();
            } else {
                $("#stp_date" + open_row_id).hide();
            }
        });
        
        $('.habbit_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            startDate: '-3m',
            maxDate: 0,
//            minDate: 0,
            
        });
        
    });

</script>
<style type="text/css">
    .check_bx_spce{
        width:10%;
    }
    .center{
        text-align:center;
    }
</style>