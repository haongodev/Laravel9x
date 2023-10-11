
<script>
    showButton()
    var question_option_id = '{{$questionSetting->parent_question_option_id}}';
    var title = '{{$questionSetting->title}}';

    var this_choose = $('#checkbox'+question_option_id);
    {{--this_choose.addClass('alert-input-method-9');--}}
    {{--this_choose.attr('alert-title','{{$questionSetting->title}}');--}}
    this_choose.prop('checked',false);
    this_choose.closest("select");

    var this_select = this_choose.closest("select");

    if(this_select.html() != undefined){
        this_select.val(this_select.find('option:first').val()).trigger('chosen:updated');
        this_select.trigger("chosen:updated");

    }
    toastr.options.timeOut = 6000;
    toastr.info(title)
</script>

