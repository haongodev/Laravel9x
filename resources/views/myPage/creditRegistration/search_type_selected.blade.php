@foreach($creditsData as $credits)
    <a href="javascript:void(0)"
       class="registered"
       data-answer-manage-id="{{$credits->answer_manage_id}}"
       data-original-question-id="{{$credits->original_question_id}}"
       data-type-native-id = {{$typeNativeId}}
    >
        @php
            if(strpos($credits->answer2, '-') !== false){
                $arrAnswer =explode(',',$credits->answer2 ?? '');
                $answer2 = !empty($arrAnswer[0]) ? date('Y-m-d',strtotime($arrAnswer[0])) : '';
                $answer2 .= !empty($arrAnswer[1]) ? '~'.date('Y-m-d',strtotime($arrAnswer[1])) : '';
            }else{
                $answer2 = $credits->answer2;
            }

        @endphp
        {{$credits->answer1}}  {{$answer2}}</a><br>
@endforeach

<script>
    $(document).ready(function () {
        $('.registered').click(function () {
            var answer_manage_id = $(this).data('answer-manage-id');
            var original_question_id = $(this).data('original-question-id');
            var type_native_id = $(this).data('type-native-id');

            $.ajax({
                type: "post",
                url: '{{route('popupRegistered')}}',
                cache: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {answer_manage_id: answer_manage_id, original_question_id:original_question_id, type_native_id :type_native_id},
                success: function (data) {
                    console.log(data);
                    $('body').append(data);
                },
            });
        })
    })
</script>
