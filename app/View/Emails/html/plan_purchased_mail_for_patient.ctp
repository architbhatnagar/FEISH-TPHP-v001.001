<table style="border-collapse:collapse"  cellpadding="5px" cellspacing="0" width="600px">
  <tbody>
     <tr>
      <td>
        <p>Dear  <?= $details['user_name'];?>, </p>
        <p>you have ordered a plan <strong><?= $details['package_name'];?> </strong> & ID <strong>Plan-<?= $details['patient_package_id'];?> </strong> For <strong> Rs:<?= $details['price']?></strong> On<strong> <?= date('d-M-Y h:i:s A',strtotime($details['created']));?></strong>
            from doctor <strong><?= $details['doctor_name'];?></strong> at clinic <strong><?= $details['address']; ?></strong>
        </p>
        <p>Please call on 01204164011 or support@feish.online for help.</p>
    <br/>
        <p><i> Thanks & Regards</i>
          <br>Feish <span class="il">Team</span></p>
      </td>
    </tr>
  </tbody>
</table>
