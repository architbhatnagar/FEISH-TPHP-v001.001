<table style="border-collapse:collapse" cellpadding="5px" cellspacing="0" width="600px">
  <tbody>
    <tr>
      <td>
        <p>Hello  <?= $salutations[$fetch_data['User']['salutation']]." ".ucfirst($fetch_data['User']['first_name'])." ".ucfirst($fetch_data['User']['last_name']); ?>, </p>
        <p>
            Doctor <strong> <?= $salutations[AuthComponent::user('salutation')].". ".ucfirst(AuthComponent::user('first_name'))." ".ucfirst(AuthComponent::user('last_name'))?>
            </strong>
            has <strong><?= $appointment_status[$status]; ?></strong> appointment
            <strong><?= date('d-M-Y H:i A',strtotime($apt_data))?></strong>.
            for requested service <strong><?= $service_name;?></strong>
        </p>
        <p><i> Thanks & Regards</i>
          <br>Feish <span class="il">Team</span>
        </p>
      </td>
    </tr>
  </tbody>
</table>
