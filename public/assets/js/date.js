$.datepicker.setDefaults($.datepicker.regional['jp']);
$( ".datepicker" ).datepicker({
    dateFormat: "yy-mm-dd",
    showMonthAfterYear:true,
    beforeShow: function (elem, inst){
        console.log($('#ui-datepicker-div').find('.ui-datepicker-year').html());
        $('#ui-datepicker-div').find('.ui-datepicker-year').append('axx');
    }
});

$('.date-icon').on('click', function() {
    $(this).closest('div').find('.datepicker').focus();
})

