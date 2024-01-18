<?php
$answerData = $answerInfoData[$questionSetting->id] ?? [];
$arrAnswer = $answerData ? explode(',', $answerData->answer) : [];
?>
<div class="first-child-question-id-{{$questionSetting->id}} first-div">
    <div class="input-group current-question-id-{{$questionSetting->id}} 
        {{$questionSetting->duplicate_flg > 0 ? "is_duplicheck" : '' }} 
        before-question-id-{{$questionSetting->parent_question_option_id}}"
         data-current-question-id="{{$questionSetting->id}}">
        <div class="w-100 group-control">
            <label for="email" class="w-25 title-required-{{$questionSetting->required_flg}} {{$questionSetting->description_flg == 1 ? "is_desc" : ""}} {{$questionSetting->description_flg == 2 ? "is_desc_blank" : ""}}" {{$questionSetting->description_flg == 2 ? "data_desc=".$questionSetting->description : ""}} data-question-id="{{$questionSetting->id}}">
                @if ($questionSetting->description_flg == 2)
                    <i class="fa fa-external-link" aria-hidden="true"></i>
                @endif
                {{$questionSetting->title}}
                @if($questionSetting->description_flg == 1)
                    <div class="hidden tooltip_desc">
                        <p>{!! nl2br(str_replace('\n', '<br>', e($questionSetting->description))) !!}</p>
                    </div>
                @endif
            </label>
            <div class="w-75">
                <input class="count-length creditInput"  {{$questionSetting->character_limit > 0 ? "maxlength=$questionSetting->character_limit" : '' }} type="text" name="question[{{$questionSetting->id}}]"
                       placeholder=""
                       value="{{$answerData->answer ?? ''}}"/>
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
