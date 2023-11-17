$('.popup-wrapper').click(function (e){
    if(e.target.className.includes('popup-wrapper')){
        var hasLayer = $(this).attr('hasLayer');
        if (typeof hasLayer !== 'undefined' && hasLayer !== false) {
            $(this).find(".content").html('');
            $(this).addClass("hidden");
            $(this).find('.btn-popup-accept').removeAttr("last-confirm");
            return false;
        }
        $('.popup-wrapper .popup-content .content').html('');
        $('.popup-wrapper').addClass('hidden');
        $('.btn-popup-accept').removeAttr('last-confirm');
        $('body').removeClass('ovf-hidden');
    }
})

$('.close-icon,.btn-popup-decline').click(function (e){
    var hasLayer = $(this).parents('.popup-wrapper').attr('hasLayer');
    if (typeof hasLayer !== 'undefined' && hasLayer !== false) {
        $(this).parents('.popup-wrapper').find(".content").html('');
        $(this).parents('.popup-wrapper').addClass("hidden");
        $(this).prev().removeAttr("last-confirm");
        return false;
    }
    if(!$(this).parents('.popup-wrapper').find('.header-content').hasClass('not-remove')){
        $('.popup-wrapper .popup-content .header-content').html('');
    }
    $('.popup-wrapper .popup-content .content').html('');
    $('.popup-wrapper').addClass('hidden');
    $('.btn-popup-accept').removeAttr('last-confirm');
    $('body').removeClass('ovf-hidden');
})
