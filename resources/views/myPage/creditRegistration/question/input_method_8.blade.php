<?php
$answerData = $answerInfoData[$questionSetting->id] ?? [];
$arrAnswer = $answerData ? explode(',',$answerData->answer) : [];

?>
<div class="input-group">
    <div class="w-100 group-control">
        <label for="email" class="w-25">実施期間</label>
        <div class="w-75 date-group">
            <input type="datetime-local" name="question[{{$questionSetting->id}}][start]"
                   value="{{!empty($arrAnswer[0]) ? date('Y-m-d H:i:s',strtotime($arrAnswer[0])) : ''}}"/>
            <span>~</span>
            <input type="datetime-local" name="question[{{$questionSetting->id}}][end]"
                   value="{{!empty($arrAnswer[0]) ? date('Y-m-d H:i:s',strtotime($arrAnswer[1])) : ''}}"/>
        </div>
    </div>
</div>
