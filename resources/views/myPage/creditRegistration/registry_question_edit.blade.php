
@foreach($questionSettingData as $key => $questionSetting)
    @php
        if($questionSetting->level !=1){
            continue;
        }
        $answerData = $answerInfoData[$questionSetting->id];

    @endphp
    @if($questionSetting->input_method ==0)
        <div class="input-group">
            <div class="w-100 group-control">
                <label for="email" class="w-25 title-required-{{$questionSetting->required_flg}}" data-question-id="{{$questionSetting->id}}">{{$questionSetting->title}}</label>
                <div class="w-75">
                    <input class="count-length" type="text" name="question[{{$questionSetting->id}}]"
                           placeholder=""
                           value="{{$answerData->answer ?? ''}}"/>
                    <p class="input-length"><span class="number">0</span>文字</p>
                </div>
            </div>
        </div>
        @php unset($questionSettingData[$key])@endphp
        @if(isset($questionSettingChildData[$questionSetting->id]))
            @include('myPage.creditRegistration.question.input_method_link',['questionSettingId'=>$questionSetting->id])
        @endif
    @endif
    @if($questionSetting->input_method ==1)
        <div class="input-group">
            <div class="w-100 group-control">
                <label for="email" class="w-25 title-required-{{$questionSetting->required_flg}}" data-question-id="{{$questionSetting->id}}">{{$questionSetting->title}}</label>
                <div class="w-75">
                    <textarea class="auto_grow count-length" rows="10" name="question[{{$questionSetting->id}}]">
                        {{$answerData->answer ?? ''}}
                    </textarea>
                        <p class="input-length"><span class="number">0</span>文字</p>
                </div>
            </div>
        </div>
        @php unset($questionSettingData[$key])@endphp
        @if(isset($questionSettingChildData[$questionSetting->id]))
            @include('myPage.creditRegistration.question.input_method_link',['questionSettingId'=>$questionSetting->id])
        @endif
    @endif
    @if($questionSetting->input_method ==7)
        <div class="input-group">
            <div class="w-100 group-control">
                <label for="email" class="w-25 title-required-{{$questionSetting->required_flg}}" data-question-id="{{$questionSetting->id}}">{{$questionSetting->title}}</label>
                <div class="w-75 date-group second">
                    <div class="date-container">
                        <input type="text" class="datepicker" name="question[{{$questionSetting->id}}]" readonly
                               value="{{$answerData->answer}}"/>
                        <i class="date-icon fa fa-calendar" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
        @php unset($questionSettingData[$key])@endphp
        @if(isset($questionSettingChildData[$questionSetting->id]))
            @include('myPage.creditRegistration.question.input_method_link',['questionSettingId'=>$questionSetting->id])
        @endif
    @endif
    @if($questionSetting->input_method ==8)
        @php
            $arrAnswer =explode(',',$answerData->answer);
        @endphp

        <div class="input-group">
            <div class="w-100 group-control">
                <label for="email" class="w-25 title-required-{{$questionSetting->required_flg}}" data-question-id="{{$questionSetting->id}}">{{$questionSetting->title}}</label>
                <div class="w-75 date-group">
                    <div class="date-container">
                        <input class="date-register datepicker" type="text" readonly
                               name="question[{{$questionSetting->id}}][start]"
                               value="{{!empty($arrAnswer[0]) ? date('Y-m-d',strtotime($arrAnswer[0])) : ''}}"/>
                        <i class="date-icon fa fa-calendar" aria-hidden="true"></i>
                    </div>
                    <span>~</span>
                    <div class="date-container">
                        <input class="date-register datepicker" type="text" readonly
                               name="question[{{$questionSetting->id}}][end]"
                               value="{{!empty($arrAnswer[1]) ? date('Y-m-d',strtotime($arrAnswer[1])) : ''}}"/>
                        <i class="date-icon fa fa-calendar" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
        @php unset($questionSettingData[$key])@endphp
        @if(isset($questionSettingChildData[$questionSetting->id]))
            @include('myPage.creditRegistration.question.input_method_link',['questionSettingId'=>$questionSetting->id])
        @endif
    @endif
    @if($questionSetting->input_method ==10)
        <div class="first-child-question-id-{{$questionSetting->id}} first-div">
            <div class="input-group before-question-id-{{$questionSetting->parent_question_option_id}}"
                 data-current-question-id="{{$questionSetting->id}}"
            >
                <div class="w-100 group-control">

                    <label for="email" class="w-25 title-required-{{$questionSetting->required_flg}}" data-question-id="{{$questionSetting->id}}">{{$questionSetting->title}}</label>
                    <select class="w-75 select-branch-question select-chosen"
                            id="question_select_{{$questionSetting->id}}"
                            name="question[{{$questionSetting->id}}]">
                        <option value=""></option>
                        @foreach(rangeYear() as $year)
                            <option
                                id="checkbox{{$year}}"
                                value="{{$year}}"
                                {{!empty($answerData->answer) && $answerData->answer == $year ? 'selected' : ''}}
                                data-question-option-setting-id="0">{{$year}}年度</option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>
        @php unset($questionSettingData[$key])@endphp
        @if(isset($questionSettingChildData[$questionSetting->id]))
            @include('myPage.creditRegistration.question.input_method_link',['questionSettingId'=>$questionSetting->id])
        @endif
    @endif
@endforeach
@foreach($questionSettingData as $key => $questionSetting)
    @php
        if($questionSetting->level !=1) {
    continue;
}
$answerData = $answerInfoData[$questionSetting->id];
$arrAnswer = explode(',',$answerData->answer);


@endphp
    @if($questionSetting->input_method ==2)
        <div class="first-child-question-id-{{$questionSetting->id}} first-div">
            <div class="input-group before-question-id-{{$questionSetting->parent_question_option_id}}"
                 {{--                             data-before-question-id="0"--}}
                 data-current-question-id="{{$questionSetting->id}}"
            >
                <div class="w-100 group-control">
                    <label for="email" class="w-25 title-required-{{$questionSetting->required_flg}}" data-question-id="{{$questionSetting->id}}">{{$questionSetting->title}}</label>
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
                    <label for="email" class="w-25 title-required-{{$questionSetting->required_flg}}" data-question-id="{{$questionSetting->id}}">{{$questionSetting->title}}</label>
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
                    <label for="email" class="w-25 title-required-{{$questionSetting->required_flg}}" data-question-id="{{$questionSetting->id}}">{{$questionSetting->title}}</label>
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
                    <label for="email" class="w-25 title-required-{{$questionSetting->required_flg}}" data-question-id="{{$questionSetting->id}}">{{$questionSetting->title}}</label>
                    <select class="w-75 select-branch-question select-chosen"
                            id="question_select_{{$questionSetting->id}}"
                            name="question[{{$questionSetting->id}}]">
                        <option value=""></option>
                        @foreach($questionSetting->question_option_setting as $questionOption)
                            <option
                                id="checkbox{{$questionOption->id}}"
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
                    <label for="email" class="w-25 title-required-{{$questionSetting->required_flg}}" data-question-id="{{$questionSetting->id}}">{{$questionSetting->title}}</label>
                    <select class="w-75 select-branch-question select-chosen" multiple
                            id="question_select_{{$questionSetting->id}}"
                            name="question[{{$questionSetting->id}}][]">
                        <option value=""></option>
                        @foreach($questionSetting->question_option_setting as $questionOption)
                            <option
                                id="checkbox{{$questionOption->id}}"
                                value="{{$questionOption->id}}"
                                {{in_array($questionOption->option_name, $arrAnswer) ? 'selected' : ''}}
                                data-question-option-setting-id="{{$questionOption->id}}">{{$questionOption->option_name}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>
    @endif
    @if(isset($questionSettingChildData[$questionSetting->id]))
        @include('myPage.creditRegistration.question.input_method_link',['questionSettingId'=>$questionSetting->id])
    @endif
@endforeach
@push('js')
<script>
$(document).ready(function(){
    $('#registry').find('.branch-question').each(function (){
        var this_choose = $(this);
        var isGetQuestion = true;
        var question_option_setting_id = this_choose.data('question-option-setting-id');
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

        console.log(question_option_setting_id);
        if (isGetQuestion) {
            getQuestionBranch(this_choose, question_option_setting_id)
        }
    })

    $('#registry').find('.select-branch-question').each(function (){
        var this_choose = $(this);
        var id = $(this).attr('id');
        $('#' + id + '>option').each(function (index) {
            var current_id = $(this).data('question-option-setting-id');

            if (!$(this).is(':selected')) {
                removeQuestion($(this))
            } else {
                if ($('#registry').find('.before-question-id-' + current_id).length == 0) {
                    console.log('add', current_id);
                    getQuestionBranch(this_choose, current_id)
                }

            }

        });
        $('#registry').find('.count-length').each(function(){
            var value = $(this).val();
            $(this).closest('div').find('.input-length').find('.number').html(value.length);
        })
    })
})
</script>
@endpush
