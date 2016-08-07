<table style="border-collapse:collapse" cellpadding="5px" cellspacing="0" width="600px">
  <tbody>
    <tr>
      <td>
        <p>Hello  <?= $salutations[$appointment_data['User']['salutation']].". ".ucfirst($appointment_data['User']['first_name'])." ".ucfirst($appointment_data['User']['last_name'])?>( ID:<strong><?= 'PA-'.$appointment_data['User']['registration_no']?></strong>) , </p>
        
        <?php if($update_by==2):?>
        <p>
            Your appointment ID:<strong><?= 'APT-'.$appointment_data['Appointment']['id']?></strong> has been <strong><?= $appointment_status[$appointment_data['Appointment']['status']]; ?></strong> by doctor <?= $salutations[$appointment_data['Doctor']['salutation']].". ".ucfirst($appointment_data['Doctor']['first_name'])." ".ucfirst($appointment_data['Doctor']['last_name'])?> ( ID:<strong><?= 'DOC-'.$appointment_data['Doctor']['registration_no']?></strong>)
            
           <br/>
           <?php if($appointment_data['Appointment']['status']!=3):?>
           <?php if($appointment_data['Appointment']['status']==2):?>
            Appointment date is <strong><?= date('d-M-Y H:i A',strtotime($appointment_data['Appointment']['scheduled_date']))?></strong>.
           <?php else:?>
            Appointment date is <strong><?= date('d-M-Y H:i A',strtotime($appointment_data['Appointment']['appointed_timing']))?></strong>.
           <?php endif;?>
           <?php endif;?>
            
            for your service <strong><?= $appointment_data['Service']['title'];?></strong>
        </p>
        <?php else:?>
        <p>
            Your appointment ID:<strong><?= 'APT-'.$appointment_data['Appointment']['id']?></strong> has been <strong><?= $appointment_status[$appointment_data['Appointment']['status']]; ?></strong> by assistant <?= $salutations[AuthComponent::user('salutation')].". ".ucfirst(AuthComponent::user('first_name'))." ".ucfirst(AuthComponent::user('last_name')).".( ID:". 'ASS-'.AuthComponent::user('registration_no').")"?> for doctor <?= $salutations[$appointment_data['Doctor']['salutation']].". ".ucfirst($appointment_data['Doctor']['first_name'])." ".ucfirst($appointment_data['Doctor']['last_name'])?> ( ID:<strong><?= 'DOC-'.$appointment_data['Doctor']['registration_no']?></strong>)
            
           <br/>
           <?php if($appointment_data['Appointment']['status']!=3):?>
           <?php if($appointment_data['Appointment']['status']==2):?>
            Appointment date is <strong><?= date('d-M-Y H:i A',strtotime($appointment_data['Appointment']['scheduled_date']))?></strong>.
           <?php else:?>
            Appointment date is <strong><?= date('d-M-Y H:i A',strtotime($appointment_data['Appointment']['appointed_timing']))?></strong>.
           <?php endif;?>
           <?php endif;?>
            
            for your service <strong><?= $appointment_data['Service']['title'];?></strong>
        </p>
        <?php endif;?>
        
        
        
        
        
        
        
        
        
        <p><i> Thanks & Regards</i>
          <br>Feish <span class="il">Team</span>
        </p>
      </td>
    </tr>
  </tbody>
</table>
