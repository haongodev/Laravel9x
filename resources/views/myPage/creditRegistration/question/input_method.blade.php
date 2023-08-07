@foreach($questionSettingChild as $key => $questionSetting)
    @php
        $answerData = $answerInfoData[$questionSetting->id] ?? '';
    @endphp
    @if($questionSetting->input_method ==0)
        <div class="input-group">
            <div class="w-100 group-control">
                <label for="email" class="w-25">{{$questionSetting->title}}</label>
                <input class="w-75" type="text" name="question[{{$questionSetting->id}}]"
                       placeholder="本協会の認定SVR"
                       value="{{$answerData->answer ?? ''}}"/>
            </div>
        </div>
        @if(isset($questionSettingChildData[$questionSetting->id]))
            @include('myPage.creditRegistration.question.input_method',['questionSetting'=>$questionSettingChildData[$questionSetting->id]])
        @endif
    @endif
    @if($questionSetting->input_method ==1)
        <div class="input-group">
            <div class="w-100 group-control">
                <label for="email" class="w-25">{{$questionSetting->title}}</label>
                {{--                                <input class="w-75" type="text" name="SVR_attributes" placeholder="本協会の認定SVR"--}}
                {{--                                       value="{{ session('popup_confirm')['SVR_attributes'] ?? ''}}"/>--}}
                <textarea class="w-75" name="question[{{$questionSetting->id}}]"
                          oninput="auto_grow(this)">{{$answerData->answer ?? ''}}</textarea>
            </div>
        </div>
    @endif
    @if($questionSetting->input_method ==7)
        <div class="input-group">
            <div class="w-100 group-control">
                <label for="email" class="w-25">{{$questionSetting->title}}</label>
                <div class="w-75 date-group second">
                    <input type="datetime-local" name="question[{{$questionSetting->id}}]"
                           value="{{$answerData->answer ?? ''}}"/>
                </div>
            </div>
        </div>
    @endif
    @if($questionSetting->input_method ==8)
        @php
            $arrAnswer =explode(',',$answerData->answer ?? '');
        @endphp
        <div class="input-group">
            <div class="w-100 group-control">
                <label for="email" class="w-25">{{$questionSetting->title}}</label>
                <div class="w-75 date-group">
                    <input type="datetime-local" name="question[{{$questionSetting->id}}][start]"
                           value="{{!empty($arrAnswer[0]) ? date('Y-m-d H:i:s',strtotime($arrAnswer[0])) : ''}}"/>
                    <span>~</span>
                    <input type="datetime-local" name="question[{{$questionSetting->id}}][end]"
                           value="{{!empty($arrAnswer[1]) ? date('Y-m-d H:i:s',strtotime($arrAnswer[1])) : ''}}"/>
                </div>
            </div>
        </div>
    @endif
@endforeach
@foreach($questionSettingChild as $key => $questionSetting)
    @php
        $answerData = $answerInfoData[$questionSetting->id] ?? '';
        $arrAnswer = explode(',',$answerData->answer ?? '');
    @endphp
    @if($questionSetting->input_method ==2)
        <div class="first-child-question-id-{{$questionSetting->id}} first-div">
            <div class="input-group before-question-id-{{$questionSetting->parent_question_option_id}}"
                 {{--                             data-before-question-id="0"--}}
                 data-current-question-id="{{$questionSetting->id}}"
            >
                <div class="w-100 group-control">
                    <label for="email" class="w-25">{{$questionSetting->title}}</label>
                    <div class="w-75 table-group">
                        <table>
                            <tr>
                                @foreach($questionSetting->question_option_setting as $questionOption)
                                    <td><input class="branch-question" type="checkbox"
                                               name="question[{{$questionSetting->id}}][]"
                                               value="{{$questionOption->id}}"
                                               id="checkbox{{$questionOption->id}}"
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
        </div>
    @endif
    @if($questionSetting->input_method ==3)
        @php
            $groupQuestionOptionData = groupClassQuestionOption($questionSetting->question_option_setting);

            $index = 0;
            $currentClass = '';
        @endphp
        <div class="first-child-question-id-{{$questionSetting->id}} first-div">
            <div
                class="input-group before-question-id-{{$questionSetting->parent_question_option_id}}"
                data-current-question-id="{{$questionSetting->id}}"
            >
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
                                                   name="question[{{$questionSetting->id}}][]"
                                                   value="{{$questionOption->id}}"
                                                   id="checkbox{{$questionOption->id}}"
                                                   data-question-option-setting-id="{{$questionOption->id}}"
                                                {{in_array($questionOption->option_name, $arrAnswer) ? 'checked' : ''}}
                                            >
                                            <label
                                                for="checkbox{{$questionOption->id}}">({{$keyOption+1}}
                                                )
                                                {{$questionOption->option_name}}</label></td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($questionSetting->input_method ==4)
        <div class="first-child-question-id-{{$questionSetting->id}} first-div">
            <div class="input-group before-question-id-{{$questionSetting->parent_question_option_id}}"
                 {{--                             data-before-question-id="0"--}}
                 data-current-question-id="{{$questionSetting->id}}">
                <div class="w-100 group-control">
                    <label for="email" class="w-25">{{$questionSetting->title}}</label>
                    <div class="w-75 table-group">
                        <table>
                            <tr>
                                @foreach($questionSetting->question_option_setting as $questionOption)
                                    <td><input class="branch-question" type="radio"
                                               name="question[{{$questionSetting->id}}]"
                                               value="{{$questionOption->id}}"
                                               id="checkbox{{$questionOption->id}}"
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
        </div>
    @endif
    @if($questionSetting->input_method ==5)
        <div class="first-child-question-id-{{$questionSetting->id}} first-div">
            <div class="input-group before-question-id-{{$questionSetting->parent_question_option_id}}"
                 data-current-question-id="{{$questionSetting->id}}"
            >
                <div class="w-100 group-control">
                    <label for="email" class="w-25">{{$questionSetting->title}}</label>
                    <select class="w-75 select-branch-question select-chosen"
                            id="question_select_{{$questionSetting->id}}"
                            name="question[{{$questionSetting->id}}]">
                        <option value="">Blank</option>
                        @foreach($questionSetting->question_option_setting as $questionOption)
                            <option
                                value="{{$questionOption->id}}"
                                {{in_array($questionOption->option_name, $arrAnswer) ? 'selected' : ''}}
                                data-question-option-setting-id="{{$questionOption->id}}">{{$questionOption->option_name}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>
    @endif
    @if($questionSetting->input_method ==6)
        <div class="first-child-question-id-{{$questionSetting->id}} first-div">
            <div class="input-group after-question-id-{{$questionSetting->id}} before-question-id-0"
                 data-current-question-id="{{$questionSetting->id}}">
                <div class="w-100 group-control">
                    <label for="email" class="w-25">{{$questionSetting->title}}</label>
                    <select class="w-75 select-branch-question select-chosen" multiple
                            id="question_select_{{$questionSetting->id}}"
                            name="question[{{$questionSetting->id}}][]">
                        <option value="">Blank</option>
                        @foreach($questionSetting->question_option_setting as $questionOption)
                            <option
                                value="{{$questionOption->id}}"
                                {{in_array($questionOption->option_name, $arrAnswer) ? 'selected' : ''}}
                                data-question-option-setting-id="{{$questionOption->id}}">{{$questionOption->option_name}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>
    @endif
@endforeach


