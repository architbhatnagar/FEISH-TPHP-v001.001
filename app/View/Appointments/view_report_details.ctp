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

    .container {
        padding: 10px;
    }

    .main1 {
        padding: 20px;
        border: 1px solid
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

</style>

<div class="container">
    <div class="row ptxxl">

        <div class="col-md-9 col-sm-9 main1">
            <?php if (!empty($users_soap_history)) { ?>
                <div class="row ">
                    <div class="col-xs-12">

                        <div class="row ">
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
                        </div>
                        <div class="invoice-title text-center">
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


                <a data-content="Report" data-placement="top" data-trigger="hover"  href="<?= Router::url(array('controller' => 'appointments', 'action' => 'print_report_details', $users_soap_history['SoapNote']['id'])) ?>" class="btn btn-info pull-right" target="_blank"><i class="fa fa-file-excel-o"></i> Print</a>
            <?php } else { ?>
                <div class="alert alert-danger">
                    <i class="fa fa-exclamation-circle mrl"></i>No records found
                </div>
            <?php } ?>    
        </div>

        <?= $this->element('front_layout_rightbar'); ?>
    </div>         

</div>

<?=
$this->Html->css(array(
    'front_end/pages/our_team.css',
));
?>