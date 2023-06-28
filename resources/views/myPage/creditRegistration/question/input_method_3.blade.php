@php
    $groupQuestionOptionData = groupClassQuestionOption($questionSetting->question_option_setting);

    $index = 0;
    $currentClass = '';
@endphp
<div
    class="input-group after-question-id-{{$questionSetting->id}} before-question-id-{{$questionSetting->parent_question_option_id}}">
    <div class="w-100 group-control">
        <label for="email" class="w-25">研鑽目的</label>
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
                            <td><input type="checkbox" name="study_purpose[]" value="1" id="checkbox{{$questionOption->option_name}}">
                                <label
                                    for="checkbox{{$questionOption->option_name}}">({{$keyOption+1}}){{$questionOption->option_name}}</label></td>
                        @endforeach
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
