<?php
$answerData = $answerInfoData[$questionSetting->id] ?? [];
$arrAnswer = $answerData ? explode(',', $answerData->answer) : [];

?>
<div class="first-child-question-id-{{$questionSetting->id}} first-div">
    <div class="input-group before-question-id-{{$questionSetting->parent_question_option_id}}"
         data-current-question-id="{{$questionSetting->id}}">
        <div class="w-100 group-control">
            <label for="email" class="w-25 title-required-{{$questionSetting->required_flg}}" data-question-id="{{$questionSetting->id}}">{{$questionSetting->title}}</label>
            <div class="w-75 date-group">
                <input class="date-register" type="date" name="question[{{$questionSetting->id}}][start]"
                       value="{{!empty($arrAnswer[0]) ? date('Y-m-d',strtotime($arrAnswer[0])) : ''}}"/>
                <span>~</span>
                <input class="date-register" type="date" name="question[{{$questionSetting->id}}][end]"
                       value="{{!empty($arrAnswer[0]) ? date('Y-m-d',strtotime($arrAnswer[1])) : ''}}"/>
            </div>
        </div>
    </div>
    <div class="question-link question-link-id-{{$questionSetting->id}}" data-current-question-id="{{$questionSetting->id}}">

    </div>
</div>
<script>
    $('#registry').find('.question-link-id-{{$questionSetting->id}}').each(function (){
        var this_choose = $(this);
        var current_id = this_choose.data('current-question-id')
        getQuestionLink(current_id)
    })
</script>
