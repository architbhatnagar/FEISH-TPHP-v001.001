<table class="table table-bordered">
    <tbody>
        <tr>
            <td> <strong>Service Name : </strong> <span id="view_test_date"><?= $doctor_patient_package['Service']['title']; ?></span></td>
        </tr>
        <tr>
            <td> <strong>Plan Name : </strong> <span id="view_test_date"><?= $doctor_patient_package['PatientPackage']['name']; ?></span></td>
        </tr>
        <tr>
            <td> <strong>Plan Price : </strong> <span id="view_test_id"><?= $doctor_patient_package['PatientPackage']['price']; ?></span></td>
        </tr>
        <tr>
            <td> <strong>Valid Visits : </strong> <span id="view_observed_value"><?= $doctor_patient_package['PatientPackage']['valid_visits']; ?></span></td>
        </tr>
        <tr>
            <td> <strong>Validity (in days) : </strong>  <span id="view_description"><?= $doctor_patient_package['PatientPackage']['validity']; ?></span></td>
        </tr>
        <tr>
            <td> <strong>Plan Details : </strong> <span id="view_report"><?= $doctor_patient_package['PatientPackage']['plan_details']; ?></span></td>
        </tr>
    </tbody>
</table>