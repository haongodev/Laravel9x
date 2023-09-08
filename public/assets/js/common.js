$('.popup-wrapper').click(function (e){
    if(e.target.className.includes('popup-wrapper')){
        $('.popup-wrapper .popup-content .content').html('');
        $('.popup-wrapper').addClass('hidden');
        $('.btn-popup-accept').removeAttr('last-confirm');
        $('body').removeClass('ovf-hidden');
    }
})

$('.close-icon,.btn-popup-decline').click(function (e){
    if(!$(this).parents('.popup-wrapper').find('.header-content').hasClass('not-remove')){
        $('.popup-wrapper .popup-content .header-content').html('');
    }
    $('.popup-wrapper .popup-content .content').html('');
    $('.popup-wrapper').addClass('hidden');
    $('.btn-popup-accept').removeAttr('last-confirm');
    $('body').removeClass('ovf-hidden');
})

$('.logoutForm').submit(function (e) { 
    if (window.opener && !window.opener.closed) {
        var event = new Event('logoutMemberNow');
        window.opener.dispatchEvent(event);
        window.close();
    }
});
window.addEventListener('logoutMemberNow', function (event) {
    $('.logoutForm').submit();
});