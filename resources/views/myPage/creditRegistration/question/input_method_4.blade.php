<?php
$answerData = $answerInfoData[$questionSetting->id] ?? [];
$arrAnswer = $answerData ? explode(',', $answerData->answer) : [];
?>
<div class="first-child-question-id-{{$questionSetting->id}} first-div">
    <div
        class="input-group after-question-id-{{$questionSetting->id}}
            before-question-id-{{$questionSetting->parent_question_option_id}}"
        {{--        data-before-question-id="{{$questionSetting->parent_question_option_id}}"--}}
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
            <div class="w-75 table-group">
                <table>
                    <tr>
                        @foreach($questionSetting->question_option_setting as $questionOption)
                            <td><input class="creditInput branch-question branch-question-{{$questionSetting->id}}" type="radio"
                                       name="question[{{$questionSetting->id}}]"
                                       value="{{$questionOption->id}}" id="checkbox{{$questionOption->id}}"
                                       data-question-option-setting-id="{{$questionOption->id}}"
                                    {{in_array($questionOption->option_name, $arrAnswer) ? 'checked' : ''}}
                                >
                                <label
                                    for="checkbox{{$questionOption->id}}">{{$questionOption->option_name}}</label>
                            </td>
                        @endforeach
                    </tr>

                </table>
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
        $(document).ready(function () {
            $('#registry').find('.branch-question-{{$questionSetting->id}}').each(function () {

                var this_choose = $(this);
                var isGetQuestion = true;
                var question_setting_id = this_choose.data('question-option-setting-id');
                if (this_choose.attr('type') == 'checkbox') {
                    if (this_choose.is(':checked') == false) {
                        isGetQuestion = false;
                    }
                }

                if (this_choose.attr('type') == 'radio') {
                    if ($(this).is(':checked') == false) {
                        isGetQuestion = false;
                    }
                }


                if (isGetQuestion) {
                    getQuestionBranch(this_choose, question_setting_id)
                }
            })
            $('#registry').find('.question-link-id-{{$questionSetting->id}}').each(function () {
                var this_choose = $(this);
                var current_id = this_choose.data('current-question-id')
                getQuestionLink(current_id)
            })
        })
    </script>
@endif
