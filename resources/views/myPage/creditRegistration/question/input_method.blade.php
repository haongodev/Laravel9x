
@if($questionSetting->input_method ==0)
    <div class="input-group">
        <div class="w-100 group-control">
            <label for="email" class="w-25">{{$questionSetting->title}}</label>
            <input class="w-75" type="text" name="SVR_attributes" placeholder="本協会の認定SVR"
                   value="{{ session('popup_confirm')['SVR_attributes'] ?? ''}}"/>
        </div>
    </div>
@endif
@if($questionSetting->input_method ==1)
    <div class="input-group">
        <div class="w-100 group-control">
            <label for="email" class="w-25">{{$questionSetting->title}}</label>
            {{--                                <input class="w-75" type="text" name="SVR_attributes" placeholder="本協会の認定SVR"--}}
            {{--                                       value="{{ session('popup_confirm')['SVR_attributes'] ?? ''}}"/>--}}
            <textarea class="w-75"
                      oninput="auto_grow(this)">{{ session('popup_confirm')['SVR_attributes'] ?? ''}}</textarea>
        </div>
    </div>
@endif
@if($questionSetting->input_method ==2)

    <div class="input-group"
         data-before-question-id="0">
        <div class="w-100 group-control">
            <label for="email" class="w-25">{{$questionSetting->title}}</label>
            <div class="w-75 table-group">
                <table>
                    <tr>
                        @foreach($questionSetting->question_option_setting as $questionOption)
                            <td><input class="branch-question" type="checkbox" name="PAAP[]"
                                       value="5" id="checkbox{{$questionOption->option_name}}"
                                       data-question-option-setting-id="{{$questionOption->id}}"
                                >
                                <label
                                    for="checkbox{{$questionOption->option_name}}">{{$questionOption->option_name}}</label>
                            </td>
                        @endforeach
                    </tr>

                </table>
            </div>
        </div>
    </div>
@endif
@if($questionSetting->input_method ==3)
    @php
        $groupQuestionOptionData = groupClassQuestionOption($questionSetting->question_option_setting);

        $index = 0;
        $currentClass = '';
    @endphp
    <div
        class="input-group after-question-id-{{$questionSetting->id}} before-question-id-{{$questionSetting->parent_question_option_id}}">
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
                                           id="checkbox{{$questionOption->option_name}}"
                                           data-question-option-setting-id="{{$questionOption->id}}"
                                    >
                                    <label
                                        for="checkbox{{$questionOption->option_name}}">({{$keyOption+1}}
                                        ){{$questionOption->option_name}}</label></td>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endif
@if($questionSetting->input_method ==4)
    <div class="input-group"
         data-before-question-id="0">
        <div class="w-100 group-control">
            <label for="email" class="w-25">{{$questionSetting->title}}</label>
            <div class="w-75 table-group">
                <table>
                    <tr>
                        @foreach($questionSetting->question_option_setting as $questionOption)
                            <td><input class="branch-question" type="radio" name="PAAP[]"
                                       value="5" id="checkbox{{$questionOption->option_name}}"
                                       data-question-option-setting-id="{{$questionOption->id}}"

                                >
                                <label
                                    for="checkbox{{$questionOption->option_name}}">{{$questionOption->option_name}}</label>
                            </td>
                        @endforeach
                    </tr>

                </table>
            </div>
        </div>
    </div>
@endif
@if($questionSetting->input_method ==5)
    <div class="input-group after-question-id-{{$questionSetting->id}} before-question-id-0">
        <div class="w-100 group-control">
            <label for="email" class="w-25">{{$questionSetting->title}}</label>
            <select class="w-75 select-branch-question" id="question_select_{{$questionSetting->id}}" name="own_position">
                <option value="">Choose Option</option>
                @foreach($questionSetting->question_option_setting as $questionOption)
                    <option
                        value="{{$questionOption->id}}" data-question-option-setting-id="{{$questionOption->id}}">{{$questionOption->option_name}}</option>
                @endforeach

            </select>
        </div>
    </div>
@endif
@if($questionSetting->input_method ==6)
    <div class="input-group after-question-id-{{$questionSetting->id}} before-question-id-0">
        <div class="w-100 group-control">
            <label for="email" class="w-25">自身の立場</label>
            <select class="w-75 select-branch-question" multiple id="question_select_{{$questionSetting->id}}" name="own_position">
                <option value="">Choose Option</option>
                @foreach($questionSetting->question_option_setting as $questionOption)
                    <option
                        value="{{$questionOption->id}}" data-question-option-setting-id="{{$questionOption->id}}">{{$questionOption->option_name}}</option>
                @endforeach

            </select>
        </div>
    </div>
@endif
@if($questionSetting->input_method ==7)
    <div class="input-group">
        <div class="w-100 group-control">
            <label for="email" class="w-25">{{$questionSetting->title}}</label>
            <div class="w-75 date-group second">
                <input type="datetime-local" name="SV_contract"
                       value="{{ session('popup_confirm')['SV_contract'] ?? ''}}"/>
            </div>
        </div>
    </div>
@endif

@if($questionSetting->input_method ==8)
    <div class="input-group">
        <div class="w-100 group-control">
            <label for="email" class="w-25">{{$questionSetting->title}}</label>
            <div class="w-75 date-group">
                <input type="datetime-local" name="s_period"
                       value="{{ session('popup_confirm')['s_period'] ?? ''}}"/>
                <span>~</span>
                <input type="datetime-local" name="e_period"
                       value="{{ session('popup_confirm')['e_period'] ?? ''}}"/>
            </div>
        </div>
    </div>
@endif
