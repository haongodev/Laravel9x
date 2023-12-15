<?php
$answerData = $answerInfoData[$questionSetting->id] ?? [];
?>
<div class="first-child-question-id-{{$questionSetting->id}} first-div">
    <div class="input-group before-question-id-{{$questionSetting->parent_question_option_id}}"
         data-current-question-id="{{$questionSetting->id}}">
        <div class="w-100 group-control">
            <label for="email" class="w-25 title-required-{{$questionSetting->required_flg}} {{$questionSetting->description_flg == 1 ? "is_desc" : ""}} {{$questionSetting->description_flg == 2 ? "is_desc_blank" : ""}}" {{$questionSetting->description_flg == 2 ? "data_desc=".$questionSetting->description : ""}} data-question-id="{{$questionSetting->id}}">
                {{$questionSetting->title}}
                @if($questionSetting->description_flg == 1)
                    <div class="hidden tooltip_desc">
                        <p>{{$questionSetting->description}}</p>
                    </div>
                @endif
            </label>
            <div class="w-75 date-group second">
                <div class="date-container">
                    <input type="text" class="datepicker validate-date input-method-7" name="question[{{$questionSetting->id}}]" readonly
                           value="{{!empty($answerData->answer) ? date('Y-m-d', strtotime($answerData->answer)) : ''}}"/>
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
