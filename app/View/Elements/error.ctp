<script type="text/javascript">
    $(document).ready(function() {
        $(".flash_re").animate({opacity: 1.0}, 3000).fadeOut("slow");
    });
</script>
<div class="alert alert-danger alert-dismissable flash_re">
    <button type="button" class="close" data-dismiss="alert"><i class="icon-remove">X</i></button>
    <i class="icon-minus-sign"></i><strong>Error!</strong> <?php echo $message; ?>
</div>