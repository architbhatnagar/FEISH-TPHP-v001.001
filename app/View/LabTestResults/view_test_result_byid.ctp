<table class="table table-bordered">
    <tbody><tr>
            <td> <strong>Date : </strong> <span id="view_test_date"><?= date('d M Y',  strtotime($result['LabTestResult']['test_date'])); ?></span></td>
        </tr>
        <tr>
            <td> <strong>Test Name : </strong> <span id="view_test_id"><?= $result['Test']['test_name']; ?></span></td>
        </tr>
        <tr>
            <td> <strong>Report File : </strong> <span id="view_report"><?= $result['LabTestResult']['report']; ?></span></td>
        </tr>
        <tr>
            <td> <strong>Observed Value : </strong> <span id="view_observed_value"><?= $result['LabTestResult']['observed_value']; ?></span></td>
        </tr>
        <tr>
            <td> <strong>Description : </strong>  <span id="view_description"><?= $result['LabTestResult']['description']; ?></span></td>
        </tr>
    </tbody></table>