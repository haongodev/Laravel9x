<?php
$answerData = $answerInfoData[$questionSetting->id] ?? [];
$arrAnswer = $answerData ? explode(',', $answerData->answer) : [];
//dd($arrAnswer);
?>

<div class="first-child-question-id-{{$questionSetting->id}} first-div">
    <div
        class="input-group after-question-id-{{$questionSetting->id}}
            before-question-id-{{$questionSetting->parent_question_option_id}}"
        data-current-question-id="{{$questionSetting->id}}"
    >
        <div class="w-100 group-control">
            <label for="email" class="w-25 title-required-{{$questionSetting->required_flg}}"
                   data-question-id="{{$questionSetting->id}}">{{$questionSetting->title}}</label>
            <select class="w-75 select-branch-question select-branch-question-{{$questionSetting->id}} select-chosen"
                    id="question_select_{{$questionSetting->id}}"
                    name="question[{{$questionSetting->id}}]">
                <option value=""></option>
                @foreach($questionSetting->question_option_setting as $questionOption)
                    <option
                        id="checkbox{{$questionOption->id}}"
                        value="{{$questionOption->id}}"
                        {{in_array($questionOption->option_name, $arrAnswer) ? 'selected' : ''}}
                        data-viewing-flag="{{$questionOption->viewing_check_flg}}"
                        data-question-option-setting-id="{{$questionOption->id}}">{{$questionOption->option_name}}</option>
                @endforeach

            </select>
        </div>
    </div>
    <div class="question-link question-link-id-{{$questionSetting->id}}"
         data-current-question-id="{{$questionSetting->id}}">

    </div>
    {{--    @if(isset($questionSettingChildData[$questionSetting->id]))--}}
    {{--        @include('myPage.creditRegistration.question.input_method',['questionSettingChild'=>$questionSettingChildData[$questionSetting->id]])--}}
    {{--    @endif--}}

    <script src="{{asset('assets/js/select.js')}}"></script>

</div>
@if($questionSetting->terminal_flg==1)
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
