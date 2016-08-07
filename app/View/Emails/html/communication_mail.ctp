<table style="border-collapse:collapse"  cellpadding="5px" cellspacing="0" width="600px">
  <tbody>
    
    <tr>
      <td>
        <p>Hello  <?= $to?>, </p>
        <p>You have mail from <?= $from?>.
        </p>
        <p> 
                                                        <?=
                                                        $this->Text->truncate(ucfirst($message), 20, array(
                                                            'ellipsis' => '...',
                                                            'exact' => false
                                                        ));
?> <a href="<?= $link?> " target="_blank">
    Read More
</a></p>
        <br/>
        <p><i> Thanks & Regards</i>
          <br>Feish <span class="il">Team</span></p>
      </td>
    </tr>
  </tbody>
</table>

