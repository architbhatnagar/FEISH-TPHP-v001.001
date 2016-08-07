<table style="border-collapse:collapse" cellpadding="5px" cellspacing="0" width="600px">
    <tbody>
        <tr>
            <td>
                <p>Hello  Admin,
                    , </p>
                <p>Doctor assistant <strong><?= $salutations[AuthComponent::user('salutation')].". ".ucfirst(AuthComponent::user('first_name'))." ".ucfirst(AuthComponent::user('last_name'))?></strong>
                    has booked doctor <strong><?= $salutations[$appointment_data['Doctor']['salutation']] . ". " . ucfirst($appointment_data['Doctor']['first_name']) . " " . ucfirst($appointment_data['Doctor']['last_name']) ?> </strong>
                    appointment for user <strong> <?= $salutations[$appointment_data['User']['salutation']] . " " . ucfirst($appointment_data['User']['first_name']) . " " . ucfirst($appointment_data['User']['last_name']); ?>
                    </strong>
                    <?php if(!empty($appointment_data['Service']['title'])) { ?>   
                   doctor service is <strong><?= $appointment_data['Service']['title']; ?></strong> and
                    <?php } ?>
                    appointment date <strong><?= date('d-M-Y H:i A', strtotime($appointment_data['Appointment']['appointed_timing'])) ?></strong>.
                </p>
                <p><i> Thanks & Regards</i>
                    <br>Feish <span class="il">Team</span>
                </p>
            </td>
        </tr>
    </tbody>
</table>
