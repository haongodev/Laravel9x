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
                                <label for="email" class="w-25">SVRの属性</label>
                                <input class="w-75" type="text" name="SVR_attributes" placeholder="本協会の認定SVR"
                                       value="{{ session('popup_confirm')['SVR_attributes'] ?? ''}}"/>
                            </div>
                        </div>
                        @php unset($questionSettingData[$key])@endphp
                    @endif
                    @if($questionSetting->input_method ==1)
                        <div class="input-group">
                            <div class="w-100 group-control">
                                <label for="email" class="w-25">SVRの属性</label>
                                {{--                                <input class="w-75" type="text" name="SVR_attributes" placeholder="本協会の認定SVR"--}}
                                {{--                                       value="{{ session('popup_confirm')['SVR_attributes'] ?? ''}}"/>--}}
                                <textarea class="w-75"
                                          oninput="auto_grow(this)">{{ session('popup_confirm')['SVR_attributes'] ?? ''}}</textarea>
                            </div>
                        </div>
                        @php unset($questionSettingData[$key])@endphp
                    @endif
                @endforeach
                @foreach($questionSettingData as $key => $questionSetting)
                    @if($questionSetting->input_method ==2)

                        <div class="input-group" data-after-question-id="{{$questionSetting->id}}"
                             data-before-question-id="0">
                            <div class="w-100 group-control">
                                <label for="email" class="w-25">研鑽目的</label>
                                <div class="w-75 table-group">
                                    <table>
                                        <tr>
                                            @foreach($questionSetting->question_option_setting as $questionOption)
                                                <td><input class="branch-question" type="checkbox" name="PAAP[]"
                                                           value="5" id="checkbox{{$questionOption->option_name}}"
                                                           data-question-option-setting-id="{{$questionOption->id}}"
                                                           data-parent-question-id="{{$questionSetting->id}}"
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
                                                    <td><input class="branch-question" type="checkbox"
                                                               name="study_purpose[]" value="1"
                                                               id="checkbox{{$questionOption->option_name}}"
                                                               data-question-option-setting-id="{{$questionOption->id}}"
                                                               data-parent-question-id="{{$questionSetting->id}}"
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
                        <div class="input-group" data-after-question-id="{{$questionSetting->id}}"
                             data-before-question-id="0">
                            <div class="w-100 group-control">
                                <label for="email" class="w-25">研鑽目的x</label>
                                <div class="w-75 table-group">
                                    <table>
                                        <tr>
                                            @foreach($questionSetting->question_option_setting as $questionOption)
                                                <td><input class="branch-question" type="radio" name="PAAP[]"
                                                           value="5" id="checkbox{{$questionOption->option_name}}"
                                                           data-question-option-setting-id="{{$questionOption->id}}"
                                                           data-parent-question-id="{{$questionSetting->id}}"
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
                        <div class="input-group">
                            <div class="w-100 group-control">
                                <label for="email" class="w-25">自身の立場</label>
                                <select class="w-75 branch-question" id="email" name="own_position">
                                    <option value="">Choose Option</option>
                                    @foreach($questionSetting->question_option_setting as $questionOption)
                                        <option
                                            value="{{$questionOption->id}}">{{$questionOption->option_name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    @endif
                @endforeach


                <div class="input-group">
                    <div class="w-100 group-control">
                        <label for="email" class="w-25">SVRの属性</label>
                        <input class="w-75" type="text" name="SVR_attributes" placeholder="本協会の認定SVR"
                               value="{{ session('popup_confirm')['SVR_attributes'] ?? ''}}"/>
                    </div>
                </div>
                <div class="input-group">
                    <div class="w-100 group-control">
                        <label for="email" class="w-25">相手の氏名</label>
                        <input class="w-75" type="text" name="TOPL" placeholder="本協会の認定SVR"
                               value="{{ session('popup_confirm')['TOPL'] ?? ''}}"/>
                    </div>
                </div>
                <div class="input-group">
                    <div class="w-100 group-control">
                        <label for="email" class="w-25">SVの種類</label>
                        <select class="w-75" id="email" name="type_SV">
                            <option value="1">個別SV</option>
                            <option value="2">BMW</option>
                        </select>
                    </div>
                </div>
                <div class="input-group">
                    <div class="w-100 group-control">
                        <label for="email" class="w-25">SVの頻度</label>
                        <select class="w-75" id="email" name="SV_frequency">
                            <option value="2">継続（６回以上／１年）</option>
                        </select>
                    </div>
                </div>
                <div class="input-group">
                    <div class="w-100 group-control">
                        <label for="email" class="w-25">実施期間</label>
                        <div class="w-75 date-group">
                            <input type="datetime-local" name="s_period"
                                   value="{{ session('popup_confirm')['s_period'] ?? ''}}"/>
                            <span>~</span>
                            <input type="datetime-local" name="e_period"
                                   value="{{ session('popup_confirm')['e_period'] ?? ''}}"/>
                        </div>
                    </div>
                </div>
                <div class="input-group">
                    <div class="w-100 group-control">
                        <label for="email" class="w-25">SV契約</label>
                        <div class="w-75 date-group second">
                            <input type="datetime-local" name="SV_contract"
                                   value="{{ session('popup_confirm')['SV_contract'] ?? ''}}"/>
                        </div>
                    </div>
                </div>

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
        $('#registry').on('click', '.branch-question', function () {
            var this_choose = $(this);
            var isGetQuestion = true;
            var question_setting_id = this_choose.data('question-option-setting-id');
            var parent_question_id = this_choose.data('parent-question-id');
            if (this_choose.attr('type') == 'checkbox') {
                if (this_choose.is(':checked') == false) {
                    // $('.question-option-setting-id-'+question_setting_id).remove()
                    //$('.before-question-id-' + question_setting_id).html('')
                    $('.before-question-id-' + question_setting_id).remove()
                    isGetQuestion = false;
                }
            }
            if (this_choose.attr('type') == 'radio') {
                var parent_div = this_choose.closest('div.input-group');
                $(parent_div).find('input[type="radio"]').each(function () {
                    if ($(this).is(':checked') == false) {
                        var current_id = $(this).data('question-option-setting-id');
                        $('.before-question-id-' + current_id).remove()
                    }
                })
            }
            if (this_choose.attr('type') == 'radio') {
                var parent_div = this_choose.closest('div.input-group');
                $(parent_div).find('input[type="radio"]').each(function () {
                    if ($(this).is(':checked') == false) {
                        var current_id = $(this).data('question-option-setting-id');
                        $('.before-question-id-' + current_id).remove()
                    }
                })
            }
            if (isGetQuestion) {
                getQuestionBranch(this_choose, question_setting_id, parent_question_id)
            }
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
            this_choose.closest('div.input-group').after(data.html)
        }

        function auto_grow(element) {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight) + "px";
        }
    </script>
@endpush
