<?php
$answerData = $answerInfoData[$questionSetting->id] ?? [];
$arrAnswer = $answerData ? explode(',', $answerData->answer) : [];
?>
<div class="first-child-question-id-{{$questionSetting->id}} first-div question-input">
    <div class="input-group question-input current-question-id-{{$questionSetting->id}}
        before-question-id-{{$questionSetting->parent_question_option_id}}"
         data-current-question-id="{{$questionSetting->id}}">
        <div class="w-100 group-control">
            <label for="email" class="w-25 title-required-{{$questionSetting->required_flg}} {{$questionSetting->description_flg == 1 ? "is_desc" : ""}} {{$questionSetting->description_flg == 2 ? "is_desc_blank" : ""}}" data_desc="{{ $questionSetting->description }}"
                   data-question-id="{{$questionSetting->id}}">{{$questionSetting->title}}
            </label>
            <div style="width: 75%;">
                <textarea {{$questionSetting->character_limit > 0 ? "maxlength=$questionSetting->character_limit" : '' }} class="auto_grow count-length textarea creditInput" rows="10" name="question[{{$questionSetting->id}}]"
                >{{$answerData->answer ?? ''}}</textarea>
                <p class="input-length"><span class="number">0</span>文字</p>
            </div>
        </div>
    </div>
    <div class="question-link question-link-id-{{$questionSetting->id}}"
         data-current-question-id="{{$questionSetting->id}}">

    </div>
</div>
@if($questionSetting->terminal_flg==1)
    <input type="hidden" class="terminal_flg" value="1">
    <script>
        showButton()
    </script>
@else
    <script>
        $('#registry').find('.question-link-id-{{$questionSetting->id}}').each(function () {
            var this_choose = $(this);
            var current_id = this_choose.data('current-question-id')
            getQuestionLink(current_id)
        })
    </script>
@endif
<script>
    $('#registry').find('.count-length').each(function(){
        var value = $(this).val();
        $(this).closest('div').find('.input-length').find('.number').html(value.length);
    })
</script>
