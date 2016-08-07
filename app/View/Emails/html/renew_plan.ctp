<table style="border-collapse:collapse" cellpadding="5px" cellspacing="0" width="600px">
  <tbody>
    
    <tr>
      <td>
        <p>Hello  <?= $user_data['salutation'].". ".$user_data['first_name']." ".$user_data['last_name']?>, </p>
        <p>Your Plan <strong><?= $user_data['plan_name']?></strong>  is going to expired on <strong> <?= date('d-M-Y',strtotime($user_data['end_date']))?></strong> .Please buy a new plan to continue using the services. </p>
        <p><i> Thanks & Regards</i>
          <br>Feish <span class="il">Team</span></p>
      </td>
    </tr>
  </tbody>
</table>
