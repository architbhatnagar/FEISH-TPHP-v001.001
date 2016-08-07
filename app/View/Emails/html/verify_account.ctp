<table style="border-collapse:collapse" cellpadding="5px" cellspacing="0" width="600px">
  <tbody>
  
    <tr>
      <td>
        <p>Hello  <?= $salutations[$fetch_data['User']['salutation']].". ".$fetch_data['User']['first_name']." ".$fetch_data['User']['last_name']?>, </p>
        <p>Welcome to Feish.online.</p>
        <p>Please save your registration number:<strong><?= 'REG-'.$registration_no ?></strong> for future use.
        </p>
        <p>
            Please note to use <br/>
            <strong>Email:</strong><?= $fetch_data['User']['email'];?> <br/>
            <strong>password: </strong><?= $password;?><br/>
            details for login.
        </p>
        
        
        <p> Please Click below link to verify your account.</p>
       
        <p><a href="<?= $verify_link;?>" target="_blank"> <?= $verify_link?></a></p>
        <p><i> Thanks & Regards</i>
          <br>Feish <span class="il">Team</span></p>
      </td>
    </tr>
  </tbody>
</table>
