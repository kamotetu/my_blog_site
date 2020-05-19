var startPos = 0,winScrollTop = 0;
$(window).on('scroll',function(){
    winScrollTop = $(this).scrollTop();

    if (winScrollTop >= startPos && winScrollTop > "413") {
        $('.back_logo_image_home').addClass('hide');
    } else {
        if(winScrollTop < "413"){
            $('.back_logo_image_home').removeClass('hide');
        }
    }
    startPos = winScrollTop;
});