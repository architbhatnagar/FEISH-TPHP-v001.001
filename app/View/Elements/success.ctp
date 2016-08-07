<script type="text/javascript">
    $(document).ready(function() {
        $(".flash_re").animate({opacity: 1.0}, 3000).fadeOut("slow");
    });
</script>
<div class="alert alert-success flash_re">
    <button type="button" class="close" data-dismiss="alert"><i class="icon-remove">X</i></button>
    <i class="icon-ok-sign"></i><strong>Success!</strong> <?php echo $message; ?>
</div>