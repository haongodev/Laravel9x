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
            <label for="email" class="w-25">{{$questionSetting->title}}</label>
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
                                <td><input class="branch-question branch-question-{{$questionSetting->id}}" type="checkbox"
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
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#registry').find('.branch-question-{{$questionSetting->id}}').each(function (){
            console.log('sss');
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
                var parent_div = this_choose.closest('div.input-group');
                $(parent_div).find('input[type="radio"]').each(function () {
                    if ($(this).is(':checked') == false) {
                        removeQuestion($(this))
                    }
                })
            }


            if (isGetQuestion) {
                getQuestionBranch(this_choose, question_setting_id)
            }
        })
    })
</script>
