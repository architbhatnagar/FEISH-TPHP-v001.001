<table style="border-collapse:collapse" cellpadding="5px" cellspacing="0" width="600px">
  <tbody>
    
    <tr>
      <td>
        <p>Hello  Admin, </p>
        <p>The plan <?= $fetch_data['PatientPackageLog']['package_name']?> Of user <strong><?= $fetch_data['User']['salutation'].". ".$fetch_data['User']['first_name']." ".$fetch_data['User']['last_name']?></strong> has expired on <?= date('d-M-Y',strtotime($fetch_data['PatientPackageLog']['end_date']))?>.Please request the user to buy a new plan  to continue using the services.</p>
        <p><i> Thanks & Regards</i>
          <br>Feish <span class="il">Team</span></p>
      </td>
    </tr>
  </tbody>
</table>
