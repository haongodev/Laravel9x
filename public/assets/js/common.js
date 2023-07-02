$('.popup-wrapper').click(function (e){
    if(e.target.className.includes('popup-wrapper')){
        $('.popup-wrapper .popup-content .content').html('');
        $('.popup-wrapper').addClass('hidden');
        $('.btn-popup-accept').removeAttr('last-confirm');
    }
})

$('.close-icon,.btn-popup-decline').click(function (e){
    $('.popup-wrapper .popup-content .header-content').html('');
    $('.popup-wrapper .popup-content .content').html('');
    $('.popup-wrapper').addClass('hidden');
    $('.btn-popup-accept').removeAttr('last-confirm');
})
