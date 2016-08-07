<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>
            </li>
            <li>
                <a class="" href="">Specialities</a>
            </li>
            <li>
                <a class="current" href="">List Speciality</a>
            </li>
            <li class="pull-right">
                <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                Level <?php echo $flag + 1; ?> Specialties
            </header>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <section class="panel">
                            <header class="panel-heading">
                                <span id="change_action">Add</span> Level <?php echo $flag + 1; ?> Speciality
                                <a class="btn btn-default btn-sm pull-right" id="remove_edit">Cancel</a>
                            </header>
                            <div class="panel-body" style="border: 2px solid #EAEAEA;">
                                <div class="">
                                    <?= $this->Form->create('Specialty', array('class' => 'form-horizontal', 'role' => 'form')); ?>
                                    <?php if ($flag == 0) { ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="col-lg-5">
                                                        <?= $this->Form->input('specialty_name', array('id' => 'specialty_name', 'class' => 'form-control', 'label' => false, 'placeholder' => 'Enter Speciality Name')); ?>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <?= $this->Form->input('disease_id', array('id' => 'disease_id', 'type' => 'textarea', 'rows' => '4', 'class' => 'form-control', 'placeholder' => 'Add Diseases Under This Speciality In Comma Saperated Form', 'label' => false)) ?>
                                                    </div>
                                                    <?= $this->Form->input('id', array('type' => 'hidden', 'id' => 'sp_id', 'label' => false)); ?>
                                                    <div class="col-lg-2">
                                                        <?= $this->Form->input('Submit', array('type' => 'submit', 'class' => 'btn btn-success', 'label' => false)) ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div> 
                                    <?php } else { ?>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="col-lg-3">
                                                        <?= $this->Form->input('specialty_name', array('id' => 'specialty_name', 'class' => 'form-control', 'label' => false, 'placeholder' => 'Enter Speciality Name')); ?>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <?= $this->Form->input('parent_id', array('id' => 'parent_id', 'options' => $parent_specialties, 'class' => 'form-control', 'empty' => 'Select Speciality', 'label' => false)) ?>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <?= $this->Form->input('disease_id', array('id' => 'disease_id', 'type' => 'textarea', 'class' => 'form-control', 'rows' => '4', 'placeholder' => 'Add Diseases Under This Speciality In Comma Saperated Form', 'label' => false)) ?>
                                                    </div>
                                                    <?= $this->Form->input('id', array('type' => 'hidden', 'id' => 'sp_id', 'label' => false)); ?>
                                                    <div class="col-lg-2">
                                                        <?= $this->Form->input('Submit', array('type' => 'submit', 'class' => 'btn btn-success', 'label' => false)) ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    <?php }
                                    ?>



                                    <?= $this->Form->end(); ?>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
                <div class="adv-table">
                    <table cellpadding="0" cellspacing="0" class="table table-bordered">
                        <?php if(count($specialties) > 0) { ?>
                        <tr>
                            <th><?php echo $this->Paginator->sort('specialty_name'); ?></th>
                            <?php if ($flag == 1): ?>
                                <th><?php echo $this->Paginator->sort('parent_id', 'Parent Speciality'); ?></th>
                            <?php endif; ?>

                            <th><?php echo $this->Paginator->sort('disease_id'); ?></th>

                            <th class="actions"><?php echo __('Actions'); ?></th>
                        </tr>
                        <?php } ?>
                        <tr>
                            <?php if(count($specialties) > 0) {
                            foreach ($specialties as $specialty): ?>
                            <tr>
                                <td><?php echo ucwords($specialty['Specialty']['specialty_name']); ?>&nbsp;</td>
                                <?php if ($flag == 1): ?>
                                    <td><?php echo ucwords($specialty['ParentSpecialty']['specialty_name']); ?></td>
                                <?php endif; ?>
                                <td>
                                    <ul>
                                        <?php foreach ($specialty['diseases'] as $dise): ?>
                                            <li><?= $dise ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </td>

                                <td class="actions">
                                    <a class="btn btn-sm btn-primary fa fa-edit popovers edit_sp" data-content="Edit" data-placement="bottom" data-trigger="hover" spe_id="<?= $specialty['Specialty']['id'] ?>"></a>
                                    <?php if ($specialty['Specialty']['is_deleted'] == 0): ?>
                                        <?php echo $this->Form->postLink(__(''), array('action' => 'delete', $specialty['Specialty']['id'], $flag), array('class' => 'btn btn-sm btn-warning fa fa-trash-o popovers', 'data-content' => 'Delete', 'data-placement' => 'bottom', 'data-trigger' => 'hover'), null, __('Are you sure you want to delete # %s?', $specialty['Specialty']['specialty_name'])); ?>
                                    <?php else: ?>
                                        <?php echo $this->Form->postLink(__(''), array('action' => 'delete', $specialty['Specialty']['id'], $flag), array('class' => 'btn btn-sm btn-warning fa fa-refresh popovers', 'data-content' => 'Restore', 'data-placement' => 'bottom', 'data-trigger' => 'hover'), null, __('Are you sure you want to Restore # %s?', $specialty['Specialty']['specialty_name'])); ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; } else { ?>
                            <div class="alert alert-block alert-danger">
                                <p><span class="alert-icon"><i class="fa fa-check"></i></span>&nbsp;No records found.</p>
                            </div>
                            <?php } ?>

                        </tr>
                    </table>
                    
                     <?php if(count($specialties) > 0) { ?>
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
        </section>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $(".edit_sp").click(function () {
            var id = $(this).attr('spe_id');
            var base_path = "<?= Router::url('/', true) ?>";
            var urls_remove = base_path + "specialties/get_details";
            $.ajax({
                url: urls_remove,
                type: "POST",
                data: {id: id},
                dataType: 'json'
            }).done(function (res_data) {
                // alert(res_data['Specialty']['disease_id']);
                $("#change_action").text('Edit');
                $("#specialty_name").val(res_data['Specialty']['specialty_name']);
                $("#parent_id").val(res_data['Specialty']['parent_id']);
                $("#disease_id").val(res_data['Specialty']['disease_id']);
                $("#sp_id").val(res_data['Specialty']['id']);
                $("#remove_edit").show();
            });

        });
        $("#remove_edit").click(function () {
            $("#change_action").text('Add');
            $("#specialty_name").val('');
            $("#parent_id").val('');
            $("#disease_id").val('');
            $("#sp_id").val('');
            $("#remove_edit").hide();
        });
    });
</script>
