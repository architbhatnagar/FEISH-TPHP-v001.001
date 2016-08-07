<div id="main_content">
    <div id="content">
        <div id="section-news" class="section">
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-9 col-sm-9">
                            <?php echo $this->Session->flash(); ?>
                            <div class="box last">
                                <div class="box-heading">Welcome, <?php echo Authcomponent::user('first_name').' '.Authcomponent::user('last_name'); ?> 
                                    <div class="pull-right">
                                        <a href="/users/dashboard" class="btn btn-sm btn-success popovers home"><i class="fa fa-backward"></i> &nbsp;Home</a>
                                        <a class="btn btn-sm btn-success popovers goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
                                    </div>
                                    <a style="margin-right: 10px;" href="<?= Router::url(array('controller' => 'users', 'action' => 'profile')) ?>" class="btn btn-info pull-right" title="Edit Profile" ><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                                <div class="box-body">
                                    <div class="appointment-summary">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <?php
                                                if (!empty($user['User']['avatar'])) {
                                                    ?>
                                                    <?= $this->Html->image('user_avtar/' . $user['User']['avatar'], array('class' => 'img-responsive', 'alt' => '')) ?>

                                                    <?php
                                                } else {
                                                    if (Authcomponent::user('gender') == 1) {
                                                        ?>
                                                        <?= $this->Html->image('patient-male.png', array('class' => 'img-responsive', 'alt' => '')) ?>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <?= $this->Html->image('patient-female.png', array('class' => 'img-responsive', 'alt' => '')) ?>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="col-md-4">
                                                <table class="table mbn">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>Name</strong></td>
                                                            <td><?php echo Authcomponent::user('first_name')." ".Authcomponent::user('last_name'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Gender</strong></td>
                                                            <td><?php
                                                                if (Authcomponent::user('gender') == '1') {
                                                                    echo "Male";
                                                                } else {
                                                                    echo "Female";
                                                                }
                                                                ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Phone number</strong></td>
                                                            <td><?php echo Authcomponent::user('mobile'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Date of Birth</strong></td>
                                                            <td><?php echo date('d-M-Y', strtotime(Authcomponent::user('birth_date'))); ?></td>
                                                        </tr>
                                                        <tr> 
                                                            <td><strong>Account Status</strong></td>
                                                            <td><?php
                                                                if (Authcomponent::user('is_active') == 1) {
                                                                    echo "<b style='color:#449d44;'>Active</b>";
                                                                } else {
                                                                    echo "<b style='color:#f85b5b;'>Deactivated</b>";
                                                                }
                                                                ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <table class="table mbn">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>Patient id</strong></td>
                                                            <td><?php
                                                                if (!empty($user['User']['registration_no'])) {
                                                                    echo 'PA'.$user['User']['registration_no'];
                                                                } else {
                                                                    echo "-";
                                                                }
                                                                ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Registered Date</strong></td>
                                                            <td><?php echo date('d-M-y h:i A', strtotime(Authcomponent::user('created'))); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>last logged in</strong></td>
                                                            <td>
                                                                <?php
                                                                if (!empty($user['LoginDetail'][0]['created'])) {
                                                                    echo date('d-M-y h:i A', strtotime($user['LoginDetail'][0]['created']));
                                                                } else {
                                                                    echo "-";
                                                                }
                                                                ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Email</strong></td>
                                                            <td><?php echo Authcomponent::user('email'); ?></td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-info">
                                <i class="fa fa-ambulance "></i> Health Parameters
                                <a  class="btn btn-info pull-right" id="add_new_habit" href="<?= Router::url(array('controller' => 'patient_habits', 'action' => 'add_habits')) ?>">Add Parameter</a>

                            </div>

                            <div>

                                <table class="table table-bordered">
                                    <thead>
                                        <?php if (count($patient_habits) > 0) { ?>
                                            <tr>
                                                <th>Name</th>
                                                <th>Frequency</th>
                                                <th>Habit Since</th>
                                                <th>Is Stopped?</th>
                                                <th>Actions</th>
                                            </tr>
                                        <?php } ?>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (count($patient_habits) > 0) {
                                            foreach ($patient_habits as $habit):
                                                ?>
                                                <tr>
                                                    <td><?= ucwords($habit['Habit']['habit_name']) ?></td>
                                                    <td><?= $habit['PatientHabit']['frequency'] . ' ' . $habit['PatientHabit']['unit'] . ' ' . $habit['PatientHabit']['time_period'] ?></td>
                                                    <td><?= $habit['PatientHabit']['habit_since'] ?></td>
                                                    <td><?= ($habit['PatientHabit']['stopped_date']) ? 'YES' : 'NO' ?></td>
                                                    <td>
                                                       <!--<a href="#" class="btn btn-warning btn-xs"><i class="fa fa-search"></i></a>
                                                       <a href="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>-->
                                                        <a href="<?= Router::url(array('controller' => 'patient_habits', 'action' => 'add_habits')) ?>"  class="btn btn-xs btn-primary popovers" ><i class="fa fa-pencil"></i></a>
                                                        <a href="<?= Router::url(array('controller' => 'patient_habits', 'action' => 'view', $habit['PatientHabit']['id'])) ?>#patienthabitdetails_<?php echo $habit['PatientHabit']['id']; ?>" data-toggle="modal" class="btn btn-xs btn-success popovers" data-content="View" data-placement="top" data-trigger="hover"><i class="fa fa-expand"></i></a>
                                                    </td>
                                                    <!--show patient's details in pop up -->

                                                </tr>
                                            <div class="modal fade view_health" id="patienthabitdetails_<?php echo $habit['PatientHabit']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog" style="margin-top: 120px;">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title">Habit Details</h4>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="profile-desk">
                                                                <p>
                                                                <h4><?php echo ucwords($habit['Habit']['habit_name']); ?></h4><br>
                                                                <span class="text-muted"><strong>Frequency:</strong>&nbsp;<?php echo $habit['PatientHabit']['frequency']; ?></span><br>
                                                                <span class="text-muted"><strong>Unit:</strong>&nbsp;<?php echo $habit['PatientHabit']['unit']; ?></span><br>
                                                                <span class="text-muted"><strong>Per:</strong>&nbsp;<?php echo $habit['PatientHabit']['time_period']; ?></span><br>
                                                                <span class="text-muted"><strong>Habit Since:</strong>&nbsp;<?php echo $habit['PatientHabit']['habit_since']; ?></span><br>
                                                                <?php if (isset($habit['PatientHabit']['stopped_date'])) : ?>
                                                                    <span class="text-muted"><strong>Stopped Date:</strong>&nbsp;<?php echo $habit['PatientHabit']['stopped_date']; ?></span>
                                                                <?php endif; ?>
        <!--                                                                <p><strong>Mobile:</strong>&nbsp;<?php //echo $habit['PatientHabit']['mobile'];            ?></p>-->
                                                                </p>
                                                            </div>
                                                            <button class="btn btn-success pull-right" onclick="hideModal()">Cancel</button>
                                                        </div>
                                                        <div class="modal-footer">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        endforeach;
                                    } else {
                                        ?>
                                        <div class="alert alert-danger">
                                                            <i class="fa fa-exclamation-circle mrl"></i>No records found
                                                        </div>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                <?php if (count($patient_habits) > 0) { ?>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6" style="margin-top: 1em;">
                                                <p>
                                                    <?php
                                                    echo $this->Paginator->counter(array(
                                                        'format' => __('Showing {:current} to {:end} of {:count} entries')
                                                    ));
                                                    ?>
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="pagination pagination-sm  pull-right">
                                                    <?php
                                                    echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                                                    echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
                                                    echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                                                    ?>                                                                          
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?= $this->element('front_layout_rightbar'); ?>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">


    function hideModal() {
        $('.view_health').modal('hide');
    }
</script>
<style type="text/css">
    .check_bx_spce{
        width:10%;
    }
</style>
