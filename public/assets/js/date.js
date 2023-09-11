$.datepicker.setDefaults($.datepicker.regional['jp']);
$( ".datepicker" ).datepicker({
    dateFormat: "yy-mm-dd",
    showMonthAfterYear:true,

});

$('.date-icon').on('click', function() {
    $(this).closest('div').find('.datepicker').focus();
})

