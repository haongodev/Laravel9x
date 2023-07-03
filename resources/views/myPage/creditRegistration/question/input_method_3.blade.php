@php
    $groupQuestionOptionData = groupClassQuestionOption($questionSetting->question_option_setting);

    $index = 0;
    $currentClass = '';
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
                                <td><input class="branch-question" type="checkbox"
                                           name="study_purpose[]" value="1"
                                           id="checkbox{{$questionOption->id}}"
                                           data-question-option-setting-id="{{$questionOption->id}}"
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
