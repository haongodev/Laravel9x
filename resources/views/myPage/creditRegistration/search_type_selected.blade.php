@foreach($creditsData as $credits)
    <a href="javascript:void(0)"
       class="registered"
       data-answer-manage-id="{{$credits->answer_manage_id}}"
       data-original-question-id="{{$credits->original_question_id}}"
    >
        {{$credits->answer1}}  {{$credits->answer2}}</a><br>
@endforeach

<script>
    $(document).ready(function () {
        $('.registered').click(function () {
            var answer_manage_id = $(this).data('answer-manage-id');
            var original_question_id = $(this).data('original-question-id');
            console.log(answer_manage_id,original_question_id)
            $.ajax({
                type: "post",
                url: '{{route('popupRegistered')}}',
                cache: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {answer_manage_id: answer_manage_id, original_question_id:original_question_id},
                success: function (data) {
                    console.log(data);
                    $('body').append(data);
                },
            });
        })
    })
</script>
