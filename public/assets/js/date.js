$( ".datepicker" ).datepicker({
    dateFormat: "yy-mm-dd"
});
$('.date-icon').on('click', function() {
    $(this).closest('div').find('.datepicker').focus();
})
