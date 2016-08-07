<table style="border-collapse:collapse" cellpadding="5px" cellspacing="0" width="600px">
  <tbody>
    <tr>
      <td>
        <p>Hello  Admin , </p>
        <p>
            User <strong><?= $salutations[$fetch_data['User']['salutation']].". ".ucfirst($fetch_data['User']['first_name'])." ".ucfirst($fetch_data['User']['last_name'])?></strong> has registered on <strong><?= date('d-M-Y H:i A',strtotime($fetch_data['User']['created']))?></strong>. Registration number:<strong> <?= $registration_no ?> </strong> Please verify the details and approve.
        </p>
        <p><i> Thanks & Regards</i>
          <br>Feish <span class="il">Team</span></p>
      </td>
    </tr>
  </tbody>
</table>
