<?php
$answerData = $answerInfoData[$questionSetting->id] ?? [];
$arrAnswer = $answerData ? explode(',',$answerData->answer) : [];
?>
<div class="first-child-question-id-{{$questionSetting->id}} first-div">
<div class="input-group">
    <div class="w-100 group-control">
        <label for="email" class="w-25">{{$questionSetting->title}}</label>
        <input class="w-75" type="text" name="question[{{$questionSetting->id}}]"
               placeholder="本協会の認定SVR"
               value="{{$answerData->answer ?? ''}}"/>
    </div>
</div>
    <div class="question-link question-link-id-{{$questionSetting->id}}" data-current-question-id="{{$questionSetting->id}}">

    </div>
</div>
<script>
    $('#registry').find('.question-link-id-{{$questionSetting->id}}').each(function (){
        var this_choose = $(this);
        var current_id = this_choose.data('current-question-id')
        console.log(current_id,'aa');
        getQuestionLink(current_id)
    })
</script>
