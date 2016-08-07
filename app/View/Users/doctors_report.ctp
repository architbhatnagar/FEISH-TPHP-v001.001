<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>

            </li>
            <li>
                <a class="current" href="">Doctor Registration Reports</a>
            </li>
            <li class="pull-right">
                <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                Doctor Registration Reports
            </header>
            <div class="panel-body">
                <?= $this->Form->create('User', array('action' => 'doctors_report'), array('id' => 'fill_dates', 'class' => 'form-horizontal', 'role' => 'form')); ?>
                <div id="container">
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label class="col-sm-3 control-label text-right">From :</label>
                            <div class="row">
                                <div class="col-sm-7">
                                    <?php echo $this->Form->input('from_date', array('type' => 'text', 'placeholder' => "DD/MM/YYYY", 'id' => 'from_date', 'data-bvalidator' => 'required', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                </div>
                            </div>
                        </div>                       
                        <div class="col-sm-4 form-group">
                            <label class="col-sm-3 control-label text-right" >To :</label> 
                            <div class="row">
                                <div class="col-sm-7">
                                    <?php echo $this->Form->input('to_date', array('type' => 'text', 'id' => 'to_date', 'placeholder' => "DD/MM/YYYY", 'data-bvalidator' => 'required', 'class' => 'form-control', 'div' => false, 'label' => false)); ?>
                                </div>
                            </div>
                        </div> 
                        <div class="col-sm-4 form-group">
                            <div class="row">
                                <div class="col-sm-offset-8 col-sm-3">
                                    <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-primary btn-md', 'id' => 'get_results')); ?>
                                </div>                       
                            </div>
                        </div>   
                    </div>
                </div>
                <?= $this->Form->end(); ?>
                <div class="panel-body">
                    <div class="adv-table">
                        <table cellpadding="0" cellspacing="0" class="table table-bordered">
                            <?php if (count($users) > 0) { ?>
                                <tr>
                                    <th><?php echo $this->Paginator->sort('first_name', 'Name'); ?></th>
                                    <th><?php echo $this->Paginator->sort('email'); ?></th>

                                    <th><?php echo $this->Paginator->sort('created', 'Registration Date'); ?></th>
                                    <th><?php echo $this->Paginator->sort('DoctorPlanDetail.0.name', 'Plan Name'); ?></th>
                                    <th><?php echo $this->Paginator->sort('DoctorPlanDetail.0.end_date', 'Plan Expiration'); ?></th>
                                    <th><?php echo $this->Paginator->sort('DoctorPlanDetail.0.price', 'Cost of Plan'); ?></th>
                                    <th><?php echo $this->Paginator->sort('DoctorPlanDetail.0.is_deleted', 'Plan Status'); ?></th>
                                </tr>
                            <?php } ?>

                            <?php
                            if (count($users) > 0) {
                                foreach ($users as $user):
                                    ?>                  
                                    <tr>

                                        <td><?php echo ucwords($user['User']['first_name'] . " " . $user['User']['last_name']); ?>&nbsp;</td>

                                        <td><?php echo h($user['User']['email']); ?>&nbsp;</td>

                                        <td><?php echo h(date('d-M-Y', strtotime($user['User']['created']))); ?>&nbsp;</td>

                                        <td><?php echo h(!empty($user['DoctorPlanDetail']) ? $user['DoctorPlanDetail'][0]['name'] : "No plan purchased"); ?></td>
                                        <td><?php echo h(!empty($user['DoctorPlanDetail']) ? date('d-M-Y', strtotime($user['DoctorPlanDetail'][0]['end_date'])) : "-"); ?></td>
                                        <td><?php echo h(!empty($user['DoctorPlanDetail']) ? $user['DoctorPlanDetail'][0]['price'] : "-"); ?></td>
                                        <td>
                                            <?php if(!empty($user['DoctorPlanDetail'])) {
                                                if(date('Y-m-d', strtotime($user['DoctorPlanDetail'][0]['end_date'])) > date("Y-m-d", strtotime("now")) && $user['DoctorPlanDetail'][0]['is_deleted'] == 0)
                                                    echo "Active";
                                                else
                                                    echo "Expired";
                                            } else {
                                                echo '-';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            } else {
                                ?>
                                <div class="alert alert-block alert-danger">
                                    <p><span class="alert-icon"><i class="fa fa-check"></i></span>&nbsp;No records found.</p>
                                </div>
                            <?php } ?>
                        </table>

                        <?php if (count($users) > 0) { ?>
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="dataTables_info" id="dynamic-table_info">
                                        <?php
                                        echo $this->Paginator->counter(array(
                                            'format' => __(' Showing {:current} records out of {:count}.')
                                        ));
                                        ?>

                                    </div>
                                    <div class="span6">
                                        <div class="">
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
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#fill_dates').bValidator();
        $('#to_date').datepicker({
            changeMonth: true,
            changeYear: true,
            maxDate: "NOW",
            autoclose: true,
            dateFormat: "dd/mm/yy"
        });

        $('#from_date').datepicker({
            changeMonth: true,
            changeYear: true,
            maxDate: "NOW",
            dateFormat: "dd/mm/yy",
            onSelect: function (dt, dt_obj) {
                var minDate = $(this).datepicker('getDate');
//                    alert(minDate);
                $('#to_date').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "dd/mm/yy",
                });
                $("#to_date").datepicker("option", "minDate", minDate);
            }
        });
    });
</script>
<style>
    .ui-datepicker-year, .ui-datepicker-year option {
        color: black;
    }
    .ui-datepicker-month, .ui-datepicker-month option {
        color: black;
    }
</style>