<table style="border-collapse:collapse"  cellpadding="5px" cellspacing="0" width="600px">
    <tbody>
        <tr>
            <td>
                <p>An order for the purchase of plan is made on  <?= date('d-M-Y h:i:s A', strtotime($details['created'])); ?>
                    by <strong><?= $details['user_name']; ?></strong> to <strong><?= $details['doctor_name']; ?></strong> </p>
                <p>Please login to change the request.</p>
                <br/>
                <p><i> Thanks & Regards</i>
                    <br>Feish <span class="il">Team</span></p>
            </td>
        </tr>
    </tbody>
</table>
