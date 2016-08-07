(function($) {
    "use strict";

    $(".menu-responsive").on('click', function(){
        $('.menu').addClass('active');
        $('.menu-responsive').css({'background':'transparent'});
        $('.menu-responsive .glyphicon').css({'color':'transparent'});
    });
    $('body').click(function(){
        $(".menu").removeClass('active');
        $('.menu-responsive .glyphicon').css({'color':'#fff'});
    });

    /* Clicks within the dropdown won't make
     it past the dropdown itself */
    $(".menu,.menu-responsive").click(function(e){
        e.stopPropagation();
    });

    $(window).scroll(function(){
        if ($(this).scrollTop() < 200) {
            $('#totop') .fadeOut();
        } else {
            $('#totop') .fadeIn();
        }
    });
    $('#totop').on('click', function(){
        $('html, body').animate({scrollTop:0}, 'fast');
        return false;
    });

    $(window).scroll(function() {
        if ($(this).scrollTop() > 90) {
            $("body").addClass("page-header-scroll");
        } else {
            $("body").removeClass("page-header-scroll");
        }
    });

    $('.carousel').carousel();

})(jQuery);
