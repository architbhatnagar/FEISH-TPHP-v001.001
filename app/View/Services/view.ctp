<div class="row">
    <div class="col-sm-12">
        <ul class="breadcrumbs-alt">
            <li>
                <?php if ($this->Session->read('Auth.User.user_type') == 1) { ?>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'admin_dashboard')) ?>">Dashboard</a>
            <?php } else if($this->Session->read('Auth.User.user_type') == 2){ ?>
                <a href="<?= Router::url(array('controller' => 'users', 'action' => 'doctors_dashboard')) ?>">Dashboard</a>
            <?php } ?>
            </li>
            <li>
                <a class="" href="<?= Router::url(array('controller' => 'services', 'action' => 'index')) ?>">Services</a>
            </li>
            <li>
                <a class="current" href="">Service Details</a>
            </li>
             <li class="pull-right">
                 <a class="active-trail current  goBack"onclick="goBack();"><i class="fa fa-backward"></i> &nbsp;Back</a>
            </li>
        </ul>
        <section class="panel">
            <header class="panel-heading">
                <?= ucwords($service['Service']['title'])?>
            </header>
            <div class="panel-body">
                <table class="table table-bordered">
                    <tr>
                        <td> Logo</td>
                        <td>
                            <?php if(!empty($service['Service']['logo'])):?>
                              <?= $this->Html->image('services/'.$service['Service']['logo'],array('class'=>'img-thumbnail','width'=>'150','height'=>'150'));?>
                            <?php else:?>
                            <?= $this->Html->image('services/service.png',array('class'=>'img-thumbnail','width'=>'150','height'=>'150'));?>
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Address</strong>
                        </td>
                        <td>
                            <?= ucwords($service['Service']['address']).",".ucwords($service['Service']['locality']).",".ucwords($service['Service']['city']).",".$service['Service']['pin_code']?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Contact</strong>
                        </td>
                        <td>
                            <?= $service['Service']['phone']?>
                        </td>
                    </tr>
                    <tr>
                        <td> <strong> Active Status</strong></td>
                        <td><?=$yes_no[$service['Service']['is_active']]?></td>
                    </tr>
                     <tr>
                        <td> <strong> Deleted Status</strong></td>
                        <td><?=$yes_no[$service['Service']['is_deleted']]?></td>
                    </tr>
                    <tr>
                        <td><strong>Description</strong></td>
                        <td>
                            <?= $service['Service']['description']?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Timing</strong></td>
                        <td>
                            <?php foreach($timing_arr as $key=>$time):?>
                            <strong><?= $days[$key]?></strong><br>
                            <?php foreach($time as $ind_time):?>
                              &nbsp;&nbsp;&nbsp;<?= date('h:i a',strtotime($ind_time['open_time']))."  - ".date('h:i a',strtotime($ind_time['close_time']))?><br/>
                            <?php endforeach;?>
                          
                            <?php endforeach;?>
                        </td>
                    </tr>
                    <tr>
                        <td> <strong>Speciality</strong> </td>
                        <td>
                            <ul>
                            <?php foreach($specialities as $spe):?>
                                <li>  <?= ucwords($spe);?></li>
                            <?php endforeach;?>
                            </ul>
                        </td>
                    </tr>
                    
                    
                </table>
                <div class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-primary" href="<?= Router::url(array('controller'=>'services','action'=>'index'))?>">Back</a>
                        
                    </div>
                    
                </div>
            </div>
                
        </section>
    </div>
</div>
