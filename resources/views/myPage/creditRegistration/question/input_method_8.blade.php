<?php
$answerData = $answerInfoData[$questionSetting->id] ?? [];
$arrAnswer = $answerData ? explode(',', $answerData->answer) : [];

?>
<div class="first-child-question-id-{{$questionSetting->id}} first-div">
    <div class="input-group before-question-id-{{$questionSetting->parent_question_option_id}}"
         data-current-question-id="{{$questionSetting->id}}">
        <div class="w-100 group-control">
            <label for="email" class="w-25 title title-required-{{$questionSetting->required_flg}} {{$questionSetting->description_flg == 1 ? "is_desc" : ""}} {{$questionSetting->description_flg == 2 ? "is_desc_blank" : ""}}" data_desc="{{ $questionSetting->description }}"
                   data-question-id="{{$questionSetting->id}}">{{$questionSetting->title}}</label>
            <div class="w-75 date-group">
                <div class="date-container">
                    <input class="date-register datepicker validate-date input-method-8-start" type="text" readonly name="question[{{$questionSetting->id}}][start]"
                           value="{{!empty($arrAnswer[0]) ? date('Y-m-d',strtotime($arrAnswer[0])) : ''}}" />
                    <i class="date-icon fa fa-calendar" aria-hidden="true"></i>
                </div>
                <span>~</span>
                <div class="date-container">
                    <input class="date-register datepicker validate-date input-method-8-end" type="text" readonly name="question[{{$questionSetting->id}}][end]"
                           value="{{!empty($arrAnswer[0]) ? date('Y-m-d',strtotime($arrAnswer[1])) : ''}}"/>
                    <i class="date-icon fa fa-calendar" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="question-link question-link-id-{{$questionSetting->id}}"
         data-current-question-id="{{$questionSetting->id}}">

    </div>
</div>
<script src="{{asset('assets/js/date.js')}}"></script>
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
