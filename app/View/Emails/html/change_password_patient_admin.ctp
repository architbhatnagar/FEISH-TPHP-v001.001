<table style="border-collapse:collapse" cellpadding="5px" cellspacing="0" width="600px">
  <tbody>
    <tr>
      <td>
        <p>Hello Admin, </p>
        <p>
            User <strong><?= $salutations[$users['User']['salutation']].". ".ucfirst($users['User']['first_name'])." ".ucfirst($users['User']['last_name'])?></strong> 
            has changed the password on <strong><?= date('d-M-Y h:i A',strtotime($users['User']['modified']))?></strong>.
        </p>
        <p><i> Thanks & Regards</i>
          <br>Feish <span class="il">Team</span></p>
      </td>
    </tr>
  </tbody>
</table>