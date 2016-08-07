<section class="panel">
    <div class="twt-feed turquoise-theme">
        <div class="col-md-4">
            <a>
                <?php if (!empty($user['User']['avatar'])) { ?>
                    <?= $this->Html->image('user_avtar/' . $user['User']['avatar'], array('alt' => '')); ?>
                    <?php
                } else {
                    if ($user['User']['gender'] == 1) {
                        ?>
                        <?= $this->Html->image('patient-male.png', array('class' => 'img-responsive', 'alt' => '')) ?>
                        <?php
                    } else {
                        ?>
                        <?= $this->Html->image('patient-female.png', array('class' => 'img-responsive', 'alt' => '')) ?>
                        <?php
                    }
                }
                ?>
            </a>
            <h1><?= ucwords($salutations[$user['User']['salutation']] . " " . $user['User']['first_name'] . " " . $user['User']['last_name']) ?></h1>

        </div>
        <div class="col-md-4">
            <p><b>Patient id</b> : <?php
                if (!empty($user['User']['registration_no'])) {
                    echo "PA-" . $user['User']['registration_no'];
                } else {
                    echo "-";
                }
                ?> </p>
            <p> <i class=""></i> <b>Registered On</b> : <?= date('d-M-y', strtotime($user['User']['created'])); ?></p>
        </div>
        <div class="col-md-4">
            <?php $genders = array(1 => 'Male', '2' => 'Female'); ?>
            <p><b>Gender</b> : <?php echo $genders[$user['User']['gender']] ?></p>
            <p><b>Birth Date</b> : 
                <?php
                if (!empty($user['User']['birth_date']))
                    echo date('d-M-Y', strtotime($user['User']['birth_date']));
                else
                    echo "No Data";
                ?>
            </p>
            <p><b>Blood Group</b> : 
                <?php
                    if(!empty($user['User']['blood_group'])){
                        echo $blood_groups[$user['User']['blood_group']];
                    }else{
                        echo 'No Data';
                    }
                ?>
            </p>
        </div>
    </div>
</section>