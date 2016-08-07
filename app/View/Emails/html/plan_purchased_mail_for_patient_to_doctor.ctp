<table style="border-collapse:collapse"  cellpadding="5px" cellspacing="0" width="600px">
    
  <tbody>
     <tr>
      <td>
        <p>Dear  <?= $details['user_name'];?>, </p>
        <p>a plan is ordered <strong><?= $details['package_name'];?> </strong> & ID <strong>Plan-<?= $details['patient_package_id'];?> </strong> For <strong> Rs:<?= $details['price']?></strong> On<strong> <?= date('d-M-Y h:i:s A',strtotime($details['created']));?></strong>
            
        </p>
        <p>Please login to change the request.</p>
    <br/>
        <p><i> Thanks & Regards</i>
          <br>Feish <span class="il">Team</span></p>
      </td>
    </tr>
  </tbody>
</table>
