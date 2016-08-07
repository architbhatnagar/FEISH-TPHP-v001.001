<div class="header-bg-wrapper">
    <div id="header-bg">
        <div class="container">
            <div class="header-bg-content">
                <h2 class="title">FAQ</h2>
                <ol class="breadcrumb"><li><a href="">FAQ`s Detail</a></li><li class="active"><?php echo "FAQ";?></li></ol>
            </div>
        </div>
    </div>
</div>

<section class="center-section">
<div class="container">
<div class="row">
<div class="col-xs-12 col-md-8 col-lg-9">
<div class="faqs-box">
<div class="panel-group my-pannel-accor" id="accordion">
  <?php $i=0; foreach($faqs as $faq){?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<? echo $i;?>">
        <?php echo ($i+1).'. ';?> <?php echo ucfirst(strtolower(mb_convert_encoding($faq['Faq']['title'], "UTF-7", "EUC-JP")));?>  
        </a><i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
      </h4>
    </div>
    <div id="collapse<?php echo $i;?>" class="panel-collapse collapse <?php if(!$i++) echo "in"; ?>">
      <div class="panel-body">
        <div>
            <?php // echo  $str = mb_convert_encoding($faq['Faq']['content'], "UTF-7", "EUC-JP");
                echo html_entity_decode($faq['Faq']['content']);?>
        </div>
      </div>
    </div>
  </div>
  <?php }?>
  
  
</div>
</div>
</div>

<div class="col-xs-12 col-md-4 col-lg-3">
    <div class="box box-left">
        <div class="theme-heading">FAQ</div>
        <div class="box-body">
          <div class="news-list">
          <ul>



          <li><a href="<?php echo $this->webroot?>users/user_faq/individuals"><img src="<?php echo $this->webroot?>img/invidual.jpg" /></a></li>
          <li><a href="<?php echo $this->webroot?>users/user_faq/corporates"><img src="<?php echo $this->webroot?>img/for-doctor.jpg" /></a></li>
          </ul>
          </div>
        </div>
    </div>
    </div>
</div>
</div>
<section>

<script>function toggleChevron(e) {
    $(e.target)
        .prev('.panel-heading')
        .find("i.indicator")
        .toggleClass('glyphicon-chevron-down glyphicon-chevron-right');
}
$('#accordion').on('hidden.bs.collapse', toggleChevron);
$('#accordion').on('shown.bs.collapse', toggleChevron);</script>