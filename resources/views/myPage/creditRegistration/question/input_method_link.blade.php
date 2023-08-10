<div class="question-link question-link-id-{{$questionSettingId}}" data-current-question-id="{{$questionSettingId}}">

</div>
@push('sub_js')
<script>
    $('#registry').find('.question-link-id-{{$questionSettingId}}').each(function (){
        var this_choose = $(this);
        var current_id = this_choose.data('current-question-id')
        console.log(current_id,'aa');
        getQuestionLink(current_id)
    })
</script>
@endpush
