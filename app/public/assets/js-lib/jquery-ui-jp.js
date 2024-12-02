jQuery(function($){
    $.datepicker.regional['jp'] = {
        closeText: '閉じる',
        prevText: '&#x3c;前月', prevStatus: '',
        nextText: '翌月&#x3e;', nextStatus: '',
        currentText: '今日', currentStatus: '',
        monthNames: ['1月', '2月', '3月', '4月', '5月', '6月',
            '7月', '8月', '9月', '10月', '11月', '12月'],
        monthNamesShort: ['1月', '2月', '3月', '4月', '5月', '6月',
            '7月', '8月', '9月', '10月', '11月', '12月'],
        dayNames: ['日', '月', '火', '水', '木', '金', '土'],
        dayNamesShort: ['日', '月', '火', '水', '木', '金', '土'],
        dayNamesMin: ['日', '月', '火', '水', '木', '金', '土'],
        weekHeader: '7日間',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '年'};
});
