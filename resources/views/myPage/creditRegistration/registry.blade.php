@extends('layouts.web.main', ['pageSlug' => 'myPage.myPage'])
@push('styles')
    <link href="{{ asset('assets') }}/css/registry.css" rel="stylesheet"/>
    <link href="{{ asset('assets') }}/css/cdnjs.cloudflare.com_ajax_libs_toastr.js_latest_toastr.min.css"
          rel="stylesheet"/>
    <style>
        textarea {
            resize: none;
            overflow: hidden;
            min-height: 50px;
            max-height: 100px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

@endpush
@section('content')
    {{ Breadcrumbs::render('creditRegistry') }}
    <div class="container">
        <div class="contain1">
            @if(!empty($guidanceData[1]))
                @if($guidanceData[1]->sentence_class)
                    {!! $guidanceData[1]->guidance !!}
                @else
                    {!! $guidanceData[1]->guidance !!}
                @endif
            @endif
        </div>
        <div class="form-registry">
            <form action="{{ route('handleCreditRegistry') }}" method="post" id="registry">
                @csrf
                <input type="hidden" value="1" name="confirm">
                @foreach($questionSettingData as $key => $questionSetting)
                    @if($questionSetting->input_method ==0)
                        <div class="input-group">
                            <div class="w-100 group-control">
                                <label for="email" class="w-25">{{$questionSetting->title}}</label>
                                <input class="w-75" type="text" name="SVR_attributes" placeholder="本協会の認定SVR"
                                       value="{{ session('popup_confirm')['SVR_attributes'] ?? ''}}"/>
                            </div>
                        </div>
                        @php unset($questionSettingData[$key])@endphp
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
                                <textarea class="w-75"
                                          oninput="auto_grow(this)">{{ session('popup_confirm')['SVR_attributes'] ?? ''}}</textarea>
                            </div>
                        </div>
                        @php unset($questionSettingData[$key])@endphp
                        @if(isset($questionSettingChildData[$questionSetting->id]))
                            @include('myPage.creditRegistration.question.input_method',['questionSetting'=>$questionSettingChildData[$questionSetting->id]])
                        @endif
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
                        @php unset($questionSettingData[$key])@endphp
                        @if(isset($questionSettingChildData[$questionSetting->id]))
                            @include('myPage.creditRegistration.question.input_method',['questionSetting'=>$questionSettingChildData[$questionSetting->id]])
                        @endif
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
                        @php unset($questionSettingData[$key])@endphp
                        @if(isset($questionSettingChildData[$questionSetting->id]))
                            @include('myPage.creditRegistration.question.input_method',['questionSetting'=>$questionSettingChildData[$questionSetting->id]])
                        @endif
                    @endif
                @endforeach
                @foreach($questionSettingData as $key => $questionSetting)
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
                                                <td><input class="branch-question" type="checkbox" name="PAAP[]"
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
                                                                       name="study_purpose[]" value="1"
                                                                       id="checkbox{{$questionOption->id}}"
                                                                       data-question-option-setting-id="{{$questionOption->id}}"
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
                    @endif
                    @if($questionSetting->input_method ==5)
                            <div class="first-child-question-id-{{$questionSetting->id}} first-div">
                        <div class="input-group before-question-id-{{$questionSetting->parent_question_option_id}}"
                             data-current-question-id="{{$questionSetting->id}}"
                        >
                            <div class="w-100 group-control">
                                <label for="email" class="w-25">{{$questionSetting->title}}</label>
                                <select class="w-75 select-branch-question"
                                        id="question_select_{{$questionSetting->id}}" name="own_position">
                                    <option value="">Choose Option</option>
                                    @foreach($questionSetting->question_option_setting as $questionOption)
                                        <option
                                            value="{{$questionOption->id}}"
                                            data-question-option-setting-id="{{$questionOption->id}}">{{$questionOption->option_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                            </div>
                    @endif
                    @if($questionSetting->input_method ==6)
                        <div class="input-group after-question-id-{{$questionSetting->id}} before-question-id-0">
                            <div class="w-100 group-control">
                                <label for="email" class="w-25">{{$questionSetting->title}}</label>
                                <select class="w-75 select-branch-question" multiple
                                        id="question_select_{{$questionSetting->id}}" name="own_position">
                                    <option value="">Choose Option</option>
                                    @foreach($questionSetting->question_option_setting as $questionOption)
                                        <option
                                            value="{{$questionOption->id}}"
                                            data-question-option-setting-id="{{$questionOption->id}}">{{$questionOption->option_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    @endif
                @endforeach


                <div class="action">
                    <button type="submit" class="accept-btn">確認</button>
                    <button type="button" class="decline-btn">戻る</button>
                </div>
            </form>
        </div>
        <div class="contain2">
            @if(!empty($guidanceData[2]))
                @if($guidanceData[2]->sentence_class)
                    {!! $guidanceData[2]->guidance !!}
                @else
                    {!! $guidanceData[2]->guidance !!}
                @endif
            @endif
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('assets/js-lib/toastr.min.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        //window.jsPDF = window.jspdf.jsPDF;

        $('.decline-btn').click(function () {
            var isValid = true;
            $('.form-registry input').each(function () {
                var value = $(this).val();
                if (value.trim() !== '' && $(this).is(':checked')) {
                    isValid = false;
                    return false;
                }
            });
            if (!isValid) {
                $('.popup-wrapper .popup-content .content').html('入力途中のデータが破棄されますがよろしいですか？');
                $('.popup-wrapper').removeClass('hidden');
                window.scrollTo(0, 0)
            } else {
                window.location.href = "{{ route('typeSelected')}}";
            }
        })
        $('.popup-wrapper').click(function (e) {
            if (e.target.className === 'popup-wrapper') {
                $('.popup-wrapper .popup-content .content').html('');
                $('.popup-wrapper').addClass('hidden');
                $('.btn-popup-accept').removeAttr('last-confirm');
            }
        })
        $('.close-icon,.btn-popup-decline').click(function (e) {
            $('.popup-wrapper .popup-content .content').html('');
            $('.popup-wrapper').addClass('hidden');
            $('.btn-popup-accept').removeAttr('last-confirm');
        })
        $('.btn-popup-accept').click(function () {
            if ($(this).attr('last-confirm') !== undefined) {
                window.location.href = "{{ route('typeSelected')}}";
            }
            if ($(this).attr('register') !== undefined) {
                $.ajax({
                    url: '{{ route('handleCreditRegistry') }}', // Replace with the appropriate route URL
                    type: 'POST',
                    data: {"_token": "{{ csrf_token() }}"},
                    success: function (response) {
                        toastr.options.timeOut = 3000;
                        toastr.options.onHidden = function () {
                            $('.confirm-popup').addClass('hidden');
                        }
                        toastr.info('単位登録を実行しました。')
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
                return false;
            }
            $('.popup-wrapper .popup-content .content').html('本当に廃棄しますか？');
            $('.btn-popup-accept').attr('last-confirm', true);
        })
        $('.btn-export-pdf').click(function () {
            $('.btn-export-pdf').addClass('hidden');
            html2canvas($('#table-confirm-registry')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("registry-details.pdf");

                    $('.btn-export-pdf').removeClass('hidden');
                }
            });
        })
        $('#registry').on('click', '.branch-question', function (e) {
            var this_choose = $(this);
            var isGetQuestion = true;
            var question_setting_id = this_choose.data('question-option-setting-id');
            var parent_question_id = this_choose.data('parent-question-id');
            if (this_choose.attr('type') == 'checkbox') {
                if (this_choose.is(':checked') == false) {
                    removeQuestion(this_choose)
                    // $('.question-option-setting-id-'+question_setting_id).remove()
                    //$('.before-question-id-' + question_setting_id).html('')
                 //   $('.before-question-id-' + question_setting_id).remove()
                    isGetQuestion = false;
                }
            }
            if (this_choose.attr('type') == 'radio') {
                var parent_div = this_choose.closest('div.input-group');
                // $(parent_div).find('input[type="radio"]').each(function () {
                //     if ($(this).is(':checked') == false) {
                //         var current_id = $(this).data('question-option-setting-id');
                //         $('.before-question-id-' + current_id).remove()
                //     }
                // })
            }
            if (this_choose.attr('type') == 'radio') {
                var parent_div = this_choose.closest('div.input-group');
                $(parent_div).find('input[type="radio"]').each(function () {
                    if ($(this).is(':checked') == false) {
                        // var current_id = $(this).data('question-option-setting-id');
                        // $('.before-question-id-' + current_id).remove()
                        removeQuestion($(this))
                    }
                })
            }


            if (isGetQuestion) {
                getQuestionBranch(this_choose, question_setting_id)
            }
        })
        $('#registry').on('change', '.select-branch-question', function (e) {
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

        })

        function getQuestionBranch(this_choose, question_setting_id) {
            $.ajax({
                type: "post",
                url: '{{route('getBranchQuestion')}}',
                cache: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {question_setting_id: question_setting_id},
                success: function (data) {
                    console.log(data);
                    nextQuestion(this_choose, data)
                },
            });
        }

        function nextQuestion(this_choose, data) {
            var current_question_id = this_choose.closest('div.input-group').data('current-question-id');

            $('.first-child-question-id-'+current_question_id).append(data.html)
          //  this_choose.closest('div.input-group').after(data.html)
        }

        function removeQuestion(this_choose){
            var current_question_id = this_choose.closest('div.input-group').data('current-question-id');
            var current_id = this_choose.data('question-option-setting-id');
            //if checkbox exist child when remove
            if($('.first-child-question-id-'+current_question_id).find('.before-question-id-'+current_id).html()){
                $('.first-child-question-id-'+current_question_id).find('.first-div').each(function(index, obj){
                    $(this).remove();
                });
            }

        }
        function auto_grow(element) {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight) + "px";
        }

        $('.select-branch-question').select2({
            placeholder: 'Select an option',
            minimumResultsForSearch: -1,
            disableSearch: true
        });
    </script>
@endpush
