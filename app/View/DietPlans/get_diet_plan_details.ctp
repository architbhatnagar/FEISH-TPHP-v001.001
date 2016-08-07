<table class="table table-bordered">
    <tbody>
        <tr>
            <td> <strong>Plan Name : </strong> <span id="view_plan_name"><?= $result['DietPlan']['plan_name']?></span></td>
        </tr>
        <tr>
            <td> <strong>Start Date : </strong> <span id="view_start_date"><?= date('d M Y',strtotime($result['DietPlan']['start_date']))?></span></td>
        </tr>
        <tr>
            <td> <strong>End Date : </strong> <span id="view_end_date"><?= date('d M Y',strtotime($result['DietPlan']['end_date']))?></span></td>
        </tr>
    </tbody></table>


<table class="table table-bordered" >
    <thead>
        <tr>
            <th>Weekday</th>
            <th>Time</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody id="appened_diet_view">
        <?php foreach ($result['DietPlansDetail'] as $value) : ?>
        <tr>
            <td><?= $weekdays[$value['weekday']];?></td>
            <td><?= date('h:i A', strtotime($value['time'])); ?></td>
            <td><?= $value['description'];?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>