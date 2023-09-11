@php
    $groupQuestionOptionData = groupClassQuestionOption($questionSetting->question_option_setting);
    $index = 0;
    $currentClass = '';
    $answerData = $answerInfoData[$questionSetting->id] ?? [];
    $arrAnswer = $answerData ? explode(',',$answerData->answer) : [];
@endphp
<div class="first-child-question-id-{{$questionSetting->id}} first-div">
    <div
        class="input-group before-question-id-{{$questionSetting->parent_question_option_id}}"
        data-current-question-id="{{$questionSetting->id}}">
        <div class="w-100 group-control">
            <label for="email" class="w-25 title-required-{{$questionSetting->required_flg}}"
                   data-question-id="{{$questionSetting->id}}">{{$questionSetting->title}}</label>
            <div class="w-75 table-group">
                <table>

                    @foreach($groupQuestionOptionData as $className => $groupQuestionOption)
                        @php
                            $index += $currentClass == $className ? 0 : 1;
                            $currentClass = $className
                        @endphp
                        <tr>
                            <th class="bg-red">{{$index}} {{$className}}</th>
                            @foreach($groupQuestionOption as $keyOption => $questionOption)
                                <td><input class="branch-question branch-question-{{$questionSetting->id}}"
                                           type="checkbox"
                                           name="question[{{$questionSetting->id}}][]" value="{{$questionOption->id}}"
                                           id="checkbox{{$questionOption->id}}"
                                           data-question-option-setting-id="{{$questionOption->id}}"
                                        {{in_array($questionOption->option_name, $arrAnswer) ? 'checked' : ''}}
                                    >
                                    <label
                                        for="checkbox{{$questionOption->id}}">({{$keyOption+1}})
                                        {{$questionOption->option_name}}</label></td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="question-link question-link-id-{{$questionSetting->id}}"
             data-current-question-id="{{$questionSetting->id}}">

        </div>
    </div>
</div>
@if($questionSetting->terminal_flg==1)
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
                        removeQuestion(this_choose)
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
