<table style="border-collapse:collapse" cellpadding="5px" cellspacing="0" width="600px">
  <tbody>
    <tr>
      <td>
        <p>Hello  <?= $salutations[$users['User']['salutation']].". ".ucfirst($users['User']['first_name'])." ".ucfirst($users['User']['last_name'])?> , </p>
        <p>
            You have changed the password on <strong><?= date('d-M-Y h:i A',strtotime($users['User']['modified']))?></strong>
            Please report on 01204164011 or support@feish.online if you haven't changed.
        </p>
        <p><i> Thanks & Regards</i>
          <br>Feish <span class="il">Team</span></p>
      </td>
    </tr>
  </tbody>
</table>