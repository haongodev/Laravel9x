<?php
$answerData = $answerInfoData[$questionSetting->id] ?? [];
?>
<div class="first-child-question-id-{{$questionSetting->id}} first-div">
<div class="input-group before-question-id-{{$questionSetting->parent_question_option_id}}"
    data-current-question-id="{{$questionSetting->id}}">
    <div class="w-100 group-control">
        <label for="email" class="w-25">SV契約</label>
        <div class="w-75 date-group second">
            <input type="datetime-local" name="question[{{$questionSetting->id}}]"
                   value="{{$answerData->answer ?? ''}}"/>
        </div>
    </div>
</div>
</div>
