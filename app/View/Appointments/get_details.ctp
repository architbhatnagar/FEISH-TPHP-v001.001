<table class="table table-hover">
     <tr>
        <td>Appointment Id: <?= 'APT-'.$fetch_data['Appointment']['id'];?></td>
    </tr>
    <tr>
        <td>Patient Name: <?= trim($salutations[$fetch_data['User']['salutation']] . " " . $fetch_data['User']['first_name'] . " " . $fetch_data['User']['last_name']);?></td>
    </tr>
    <tr>
        <td>
            Service :<?= $fetch_data['Service']['title']?>
        </td>
    </tr>
    <tr>
        <td>
            Doctor Name :<?= trim($salutations[$fetch_data['Doctor']['salutation']] . " " . $fetch_data['Doctor']['first_name'] . " " . $fetch_data['Doctor']['last_name']);?>
        </td>
    </tr>
    <tr>
        <td>
            Status :<?= $status[$fetch_data['Appointment']['status']];?>
        </td>
    </tr>
    <tr>
        <td> Timing :<?php
        if($fetch_data['Appointment']['status']==2){
             echo date('d M Y h:i a',strtotime($fetch_data['Appointment']['scheduled_date']));
        }else{
            if(!empty($fetch_data['Appointment']['scheduled_date'])) {
                echo date('d M Y h:i a',strtotime($fetch_data['Appointment']['scheduled_date']));
            } else {
            echo date('d M Y h:i a',strtotime($fetch_data['Appointment']['appointed_timing'])); 
            }
        }
        ?></td>
    </tr>
    <tr>
        <td>
            Reason : <?= ucfirst($fetch_data['Appointment']['reason']);?>
        </td>
    </tr>
</table>