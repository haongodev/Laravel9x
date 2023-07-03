<div class="first-child-question-id-{{$questionSetting->id}} first-div">
    <div
        class="input-group after-question-id-{{$questionSetting->id}}
            before-question-id-{{$questionSetting->parent_question_option_id}}"
{{--        data-before-question-id="{{$questionSetting->parent_question_option_id}}"--}}
        data-current-question-id="{{$questionSetting->id}}">
        <div class="w-100 group-control">
            <label for="email" class="w-25">{{$questionSetting->title}}</label>
            <div class="w-75 table-group">
                <table>
                    <tr>
                        @foreach($questionSetting->question_option_setting as $questionOption)
                            <td><input class="branch-question" type="radio" name="question_{{$questionSetting->id}}[]"
                                       value="5" id="checkbox{{$questionOption->id}}"
                                       data-question-option-setting-id="{{$questionOption->id}}"
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
</div>
