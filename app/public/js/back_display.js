var startPos = 0,winScrollTop = 0;
$(window).on('scroll',function(){
    winScrollTop = $(this).scrollTop();

    if (winScrollTop >= startPos && winScrollTop > "413") {
        $('.header_sub_title').addClass('hide');
    } else {
        if(winScrollTop < "413"){
            $('.header_sub_title').removeClass('hide');
        }
    }
    startPos = winScrollTop;
});