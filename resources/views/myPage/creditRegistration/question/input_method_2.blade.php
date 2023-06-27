<div class="input-group question-setting-id={{$questionSetting->parent_question_option_id}}">
    <div class="w-100 group-control">
        <label for="email" class="w-25">研鑽目的</label>
        <div class="w-75 table-group">
            <table>

                {{-- 3 --}}
                <tr rowspan="{{count($questionSetting->question_option_setting)}}">
                    <th >3 専門職・実践者としての力</th>
                    @foreach($questionSetting->question_option_setting as $questionOption)
                        <td><input class="branch-question" type="checkbox" name="PAAP[]" value="5" id="checkbox5"> <label
                                for="checkbox5">{{$questionOption->option_name}}</label></td>
                    @endforeach
                </tr>

            </table>
        </div>
    </div>
</div>
