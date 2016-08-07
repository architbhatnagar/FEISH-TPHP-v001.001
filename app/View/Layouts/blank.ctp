<?= $this->Html->css(array(
            'back_end/bootstrap.min.css',
            'back_end/jquery-ui/jquery-ui-1.10.1.custom.min.css',
           
            
        ));?>
        <?= $this->Html->script(array(
            'back_end/jquery.js',
            'back_end/jquery-ui/jquery-ui-1.10.1.custom.min.js',
            'back_end/bootstrap.min.js',
          
            
        ));?>
 <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
 <script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<?php
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>

        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
