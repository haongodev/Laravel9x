<div
    class="input-group after-question-id-{{$questionSetting->id}} before-question-id-{{$questionSetting->parent_question_option_id}}"
    data-after-question-id="{{$questionSetting->id}}" data-before-question-id="{{$questionSetting->parent_question_option_id}}"
>
    <div class="w-100 group-control">
        <label for="email" class="w-25">研鑽目的</label>
        <div class="w-75 table-group">
            <table>

                {{-- 3 --}}
                <tr rowspan="{{count($questionSetting->question_option_setting)}}">
                    <th>3 専門職・実践者としての力</th>
                    @foreach($questionSetting->question_option_setting as $questionOption)
                        <td><input class="branch-question" type="checkbox" name="PAAP[]" value="5" id="checkbox{{$questionOption->option_name}}"
                                   data-question-option-setting-id="{{$questionOption->id}}"
                                   data-parent-question-id="{{$questionSetting->id}}"
                            > <label
                                for="checkbox{{$questionOption->option_name}}">{{$questionOption->option_name}}</label></td>
                    @endforeach
                </tr>

            </table>
        </div>
    </div>
</div>
