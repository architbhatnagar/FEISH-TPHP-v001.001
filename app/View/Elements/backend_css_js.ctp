<?=
$this->Html->css(array(
    'back_end/bootstrap.min.css',
    'back_end/jquery-ui/jquery-ui-1.10.1.custom.min.css',
    'back_end/bootstrap-reset.css',
    'back_end/font-awesome.css',
    'back_end/jvector-map/jquery-jvectormap-1.2.2.css',
    'back_end/clndr.css',
    'back_end/css3clock/css/style.css',
    'back_end/morris-chart/morris.css',
    'back_end/jquery-multi-select/css/multi-select.css',
    'back_end/select2/select2.css',
    'back_end/advanced-datatable/css/demo_page.css',
    'back_end/advanced-datatable/css/demo_table.css',
    'back_end/data-tables/DT_bootstrap.css',
    'back_end/style.css',
    'back_end/style-responsive.css',
    'back_end/fuelux/css/tree-style.css',
    'back_end/bvalidator.css',
    'back_end/jquery.raty.css',
    'back_end/fuelux/css/tree-style.css',
    
    /*added by yogesh*/
    'back_end/jquery-ui-timepicker-0.3.3/jquery.ui.timepicker.css',
    
));
?>
<?=
$this->Html->script(array(
    'back_end/jquery.js',
    'back_end/jquery-ui/jquery-ui-1.10.1.custom.min.js',
    
    /*added by yogesh*/
        'back_end/jquery-ui-timepicker-0.3.3/jquery.ui.timepicker.js',
        
    
    'back_end/bootstrap.min.js',
    'back_end/jquery.dcjqaccordion.2.7.js',
    'back_end/jquery.scrollTo.min.js',
    'back_end/jQuery-slimScroll-1.3.0/jquery.slimscroll.js',
    'back_end/jquery.nicescroll.js',
    'back_end/skycons/skycons.js',
    'back_end/jquery.scrollTo/jquery.scrollTo.js',
    'back_end/calendar/clndr.js',
    'back_end/calendar/moment-2.2.1.js',
    'back_end/evnt.calendar.init.js',
    'back_end/css3clock/js/css3clock.js',
    'back_end/dashboard.js',
    'back_end/jquery.customSelect.min.js',
    'back_end/select2/select2.js',
    'back_end/advanced-datatable/js/jquery.dataTables.js',
    'back_end/data-tables/DT_bootstrap.js',
    'back_end/fuelux/js/tree.min.js',
    'back_end/scripts.js',
    'back_end/combodate.js',
    'back_end/ckeditor/ckeditor.js',
    'back_end/jquery.bvalidator-yc.js',
    'back_end/bootbox/bootbox.js',
    'back_end/jquery.raty.js'
));
?>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<?php
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>
<script type="text/javascript">
    function goBack() { 
        window.history.back();
        
    }
</script>
<style type="text/css">
    .goBack{
        margin-left: 5px;
    }
</style>