<?php
$answerData = $answerInfoData[$questionSetting->id] ?? [];
$arrAnswer = $answerData ? explode(',',$answerData->answer) : [];
?>
<div class="first-child-question-id-{{$questionSetting->id}} first-div question-input">
    <div class="input-group question-input">
        <div class="w-100 group-control">
            <label for="email" class="w-25 title-required-{{$questionSetting->required_flg}}" data-question-id="{{$questionSetting->id}}">{{$questionSetting->title}}</label>
            {{--                                <input class="w-75" type="text" name="SVR_attributes" placeholder="本協会の認定SVR"--}}
            {{--                                       value="{{ session('popup_confirm')['SVR_attributes'] ?? ''}}"/>--}}
            <textarea class="w-75 auto_grow" rows="10" name="question[{{$questionSetting->id}}]"
                      >{{$answerData->answer ?? ''}}</textarea>
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
