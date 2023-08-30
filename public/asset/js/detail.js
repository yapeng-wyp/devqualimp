$(function(){
    $('#moule_code').on('keyup',function () {
        // console.log(this);
        this.value = this.value.toUpperCase();
    });

    $('#cli_moule_code').on('keyup',function () {
        // console.log(this);
        this.value = this.value.toUpperCase();
    });

});

function showBig(url) {
    let big_div = $('#image_div');
    let big_image = $('#big_image');
    big_image.attr('src',url);
    $('<img />').attr('src',url).on('load',function () {
        var windowWidth = $(window).width();
        var windowHeight = $(window).height();
        var realWidth = this.width;
        var realHeight = this.height;
        var imgWidth ,imgHeight;
        var scale = 0.8;
        if (realHeight > windowHeight * scale){
            imgHeight = windowHeight * scale;
            imgWidth = imgHeight / realHeight * realWidth;
            if (imgWidth > windowWidth * scale){
                imgWidth = windowWidth * scale;
            }
        }else if (realWidth > windowWidth * scale){
            imgWidth = windowWidth * scale;
            imgHeight = imgWidth / realWidth * realHeight;
        }else {
            imgWidth = realWidth;
            imgHeight = realHeight;
        }

        $(big_image).css({'width':imgWidth});
        var left = (windowWidth - imgWidth) / 2;
        var top = (windowHeight - imgHeight) / 2;
        $(big_div).css({'top':top,'left':left});
        $('#back-curtain').css({
            'position':'fixed',
            'overflow-y':'auto',
            'width':'100%',
            'height':'100%',
            'z-index':'998'
        }).show();
    });
    $('#back-curtain').on('click',function () {
        $(this).fadeOut('fast');
    })
}
