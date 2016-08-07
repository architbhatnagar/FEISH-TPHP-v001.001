<table style="border-collapse:collapse"  cellpadding="5px" cellspacing="0" width="600px">
  <tbody>
   
    <tr>
      <td>
        <p>Hello  <?= $salutations[$user['User']['salutation']].". ".$user['User']['first_name']." ".$user['User']['last_name']?>, </p>
        <p>Your Password Has been reset successfully.</p>
        <p>Your New  Password : <strong><?= $user['User']['password']?></strong> </p>
        <p>You can login to our site using these details at the following link:  </p>
        <p> <a  target="_blank" href="<?php echo Router::url('/', true) . 'users' . '/login'; ?>"> <?php echo Router::url('/', true) . 'users' . '/login'; ?>
            </a></p>
        <br/>
        <p><i> Thanks & Regards</i>
          <br>Feish <span class="il">Team</span></p>
      </td>
    </tr>
  </tbody>
</table>

