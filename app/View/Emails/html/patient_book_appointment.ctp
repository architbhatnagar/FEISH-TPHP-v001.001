<table style="border-collapse:collapse" cellpadding="5px" cellspacing="0" width="600px">
  <tbody>
    <tr>
      <td>
          <p>Appoint ID <strong><?= $appointment_data['Appointment']['id']; ?></strong>,date Time is booked on <strong><?= date('d-M-Y H:i A',strtotime($appointment_data['Appointment']['appointed_timing']))?></strong> </p>
        <p>
            Please check personal email or <strong><?= $consultaion_link; ?></strong> to check further.
        </p>
        <p><i> Thanks & Regards</i>
          <br>Feish <span class="il">Team</span>
        </p>
      </td>
    </tr>
  </tbody>
</table>
<!--<table style="border-collapse:collapse" cellpadding="5px" cellspacing="0" width="600px">
  <tbody>
    <tr>
      <td>
        <p>Hello  <?= $salutations[AuthComponent::user('salutation')].". ".ucfirst(AuthComponent::user('first_name'))." ".ucfirst(AuthComponent::user('last_name'))?> , </p>
        <p>
            You have booked doctor <strong><?= $salutations[$appointment_data['Doctor']['salutation']]." ".ucfirst($appointment_data['Doctor']['first_name'])." ".ucfirst($appointment_data['Doctor']['last_name']); ?>
            </strong>
            appointment successfully.appointment date is <strong><?= date('d-M-Y H:i A',strtotime($appointment_data['Appointment']['appointed_timing']))?></strong>.
            for your service <strong><?= $appointment_data['Service']['title'];?></strong>
        </p>
        <p><i> Thanks & Regards</i>
          <br>Feish <span class="il">Team</span>
        </p>
      </td>
    </tr>
  </tbody>
</table>-->
