<?php if(!empty($result['SoapNote']['appointment_id'])) { ?>
<table class="table table-bordered">
    <tbody> 
        <tr><td></td></tr>
        <tr>
            <td>
                <div class=""> 
                    <strong>Appointment ID - </strong> <?= $result['SoapNote']['appointment_id'];?>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class=""> 
                    <strong>Disease Name - </strong> <?= strip_tags($result['SoapNote']['disease']);?>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class=""> 
                    <strong>Observation Name - </strong> <?= strip_tags($result['SoapNote']['observation']);?>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class=""> 
                    <strong>Dignosis - </strong> <?= strip_tags($result['SoapNote']['dignosis']);?>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class=""> 
                    <strong>Comments - </strong> <?= strip_tags($result['SoapNote']['comments']);?>
                </div>
            </td>
        </tr>
        <?php if($result['SoapNote']['is_reference'] == 1) { ?>
        <tr>
            <td>
                <div class=""> 
                    <strong>Reference Name - </strong> <?= strip_tags($result['SoapNote']['reference_name']);?>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class=""> 
                    <strong>Reference Address - </strong> <?= strip_tags($result['SoapNote']['reference_address']);?>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class=""> 
                    <strong>Reference Comments - </strong> <?= strip_tags($result['SoapNote']['reference_comments']);?>
                </div>
            </td>
        </tr>
        <?php } ?>

    </tbody>
</table>
<?php } else { ?>
<h3>No report found.</h3>
<?php } ?>
