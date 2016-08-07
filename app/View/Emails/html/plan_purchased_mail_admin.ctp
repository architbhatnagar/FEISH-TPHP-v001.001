<table style="border-collapse:collapse"  cellpadding="5px" cellspacing="0" width="600px">
  <tbody>
   
    <tr>
      <td>
        <p>User  <?= $details['user_name'];?>, </p>
        <p>has made a purchase of plan <strong><?= $details['package_name']?> </strong> & <strong> <?= $details['id']?> </strong> for <strong> Rs:<?= $details['price']?></strong> On<strong> <?= date('d-M-Y h:i:s A',strtotime($details['created']));?></strong></p>
        <p>Please call on 01204164011 or support@feish.online for help.</p>
    <br/>
        <p><i> Thanks & Regards</i>
          <br>Feish <span class="il">Team</span></p>
      </td>
    </tr>
  </tbody>
</table>
<!--User<registration number> has made a purchase of plan <plan name> & <id> for <amount> on <date:time>.-->