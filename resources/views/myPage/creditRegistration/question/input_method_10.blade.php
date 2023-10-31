<?php
$answerData = $answerInfoData[$questionSetting->id] ?? [];
$arrAnswer = $answerData ? explode(',', $answerData->answer) : [];
?>
<div class="first-child-question-id-{{$questionSetting->id}} first-div">
    <div class="input-group before-question-id-{{$questionSetting->parent_question_option_id}}"
         data-current-question-id="{{$questionSetting->id}}"
    >
        <div class="w-100 group-control">

            <label for="email" class="w-25 title title-required-{{$questionSetting->required_flg}}"
                   data-question-id="{{$questionSetting->id}}">{{$questionSetting->title}}</label>
            <select class="w-75 select-branch-question select-chosen validate-date input-method-10"
                    id="question_select_{{$questionSetting->id}}"
                    name="question[{{$questionSetting->id}}]">
                <option value=""></option>
                @foreach(rangeYear() as $year)
                    <option
                        id="checkbox{{$year}}"
                        value="{{$year}}"
                        {{!empty($answerData->answer) && $answerData->answer == $year ? 'selected' : ''}}
                        data-question-option-setting-id="0">{{$year}}年度
                    </option>
                @endforeach

            </select>
        </div>
    </div>
</div>
<div class="question-link question-link-id-{{$questionSetting->id}}"
     data-current-question-id="{{$questionSetting->id}}">

</div>
<script src="{{asset('assets/js/select.js')}}"></script>
@if($questionSetting->terminal_flg==1)
    <input type="hidden" class="terminal_flg" value="1">
    <script>
        showButton()
    </script>
@else
    <script>
        $('#registry').find('.select-branch-question-{{$questionSetting->id}}').each(function () {
            var this_choose = $(this);
            var id = $(this).attr('id');
            $('#' + id + '>option').each(function (index) {
                var current_id = $(this).data('question-option-setting-id');
                if (!$(this).is(':selected')) {
                    removeQuestion($(this))
                } else {
                    if ($('#registry').find('.before-question-id-' + current_id).length == 0) {
                        console.log('add', current_id);
                        getQuestionBranch(this_choose, current_id)
                    }

                }

            });
        })
        $('#registry').find('.question-link-id-{{$questionSetting->id}}').each(function () {
            var this_choose = $(this);
            var current_id = this_choose.data('current-question-id')
            getQuestionLink(current_id)
        })
    </script>
@endif
