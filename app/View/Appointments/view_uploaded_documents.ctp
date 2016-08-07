<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <a href="#">Dashboard</a>
            </li>
            <li>
                <a class="" href="<?= Router::url(array('controller' => 'appointments', 'action' => 'index')) ?>">Manage Encounters</a>
            </li>
            <li>
                <a class="current" href="">Uploaded Documents</a>
            </li>
            <li class="pull-right">
                <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                Encounters
            </header>
            <div class="appointments index">
                <div class="panel-body">
                    <table class="table table-bordered table-striped dataTable display">
                        <?php if (count($appointment_uploaded_doc) > 0) { ?>
                        <tr>
                            <th>#</th>
                            <th>Service Name</th>
                            <th>Appointment Timing</th>
                            <th>Uploaded By</th>
                            <th>Documents</th>
                        </tr>
                        <?php } ?>
                        <?php
                        if (count($appointment_uploaded_doc) > 0) {
                            $i = 1;
                            foreach ($appointment_uploaded_doc as $uploaded_doc):
                                ?>
                                <tr>
                                    <td><?php
                                        echo $i;
                                        $i++;
                                        ?>&nbsp;</td>
                                    <td><?= $appointment['Service']['title']; ?>&nbsp;</td>
                                    <td>
                                        <?PHP if($appointment['Appointment']['status'] != 2 ) {
                                        echo date('d-M-Y \a\t h:i a', strtotime($appointment['Appointment']['appointed_timing']));
                                        } else {
                                            echo date('d-M-Y \a\t h:i a', strtotime($appointment['Appointment']['scheduled_date']));
                                        }?>
                                    </td>
                                    <td>
                                        <?PHP echo $salutations[$uploaded_doc['User']['salutation']]." ".$uploaded_doc['User']['first_name']." ".$uploaded_doc['User']['last_name']; ?>
                                    </td>
                                    <td> <a href="<?= Router::url(array('controller' => 'appointments', 'action' => 'download_uploaded_file', $uploaded_doc['UploadDocument']['file_name'])) ?>" class="download_pdf popovers" data-content="Download">
                                                                                        <?= $uploaded_doc['UploadDocument']['file_name']; ?>
                                                                                    </a>
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

                    <?php /*if (count($appointments) > 0) { ?>
                        <ul class="pagination pagination-sm  pull-right">
                            <?php
                            echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                            echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
                            echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
                            ?>                                                                          
                        </ul>
                    <?php } */?>
                </div>
            </div>
        </section>
    </div>
</div>

<style type="text/css">
    .modal-dialog{
        width: 60%;
    }
    .error_text{
        color: red;
    }
</style>
