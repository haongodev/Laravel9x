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
                                <textarea class="w-75" oninput="auto_grow(this)">{{ session('popup_confirm')['SVR_attributes'] ?? ''}}</textarea>
                            </div>
                        </div>
                        @php unset($questionSettingData[$key])@endphp
                    @endif
                @endforeach
                @foreach($questionSettingData as $key => $questionSetting)
                    @if($questionSetting->input_method ==2)

                        <div class="input-group" data-after-question-id="{{$questionSetting->id}}" data-before-question-id="0">
                            <div class="w-100 group-control">
                                <label for="email" class="w-25">研鑽目的</label>
                                <div class="w-75 table-group">
                                    <table>
                                        <tr>
                                            @foreach($questionSetting->question_option_setting as $questionOption)
                                                <td><input class="branch-question" type="checkbox" name="PAAP[]"
                                                           value="5" id="checkbox5"
                                                           data-question-option-setting-id="{{$questionOption->id}}"
                                                           data-parent-question-id="{{$questionSetting->id}}"
                                                    >
                                                    <label
                                                        for="checkbox5">{{$questionOption->option_name}}</label>
                                                </td>
                                            @endforeach
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($questionSetting->input_method ==3)
                    <div
                        class="input-group after-question-id-{{$questionSetting->id}} before-question-id-{{$questionSetting->parent_question_option_id}}">
                        <div class="w-100 group-control">
                            <label for="email" class="w-25">研鑽目的</label>
                            <div class="w-75 table-group">
                                <table>
                                    {{-- 1 --}}
                                    <tr>
                                        <th class="bg-red" rowspan="2">1 仕事と暮らしの調和</th>
                                        <td><input type="checkbox" name="study_purpose[]" value="1" id="checkbox1">
                                            <label
                                                for="checkbox1">(1)健康状態の自己管理</label></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="study_purpose[]" value="2" id="checkbox2">
                                            <label
                                                for="checkbox2">(2)仕事と家庭のバランス</label></td>
                                    </tr>
                                    {{-- 2 --}}
                                    <tr>
                                        <th rowspan="2">2 社会人・組織人としての力</th>
                                        <td><input type="checkbox" name="SAAMOS[]" value="3" id="checkbox3"> <label
                                                for="checkbox3">(1)基本姿勢やマナー</label></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="SAAMOS[]" value="4" id="checkbox4"> <label
                                                for="checkbox4">(2)組織人としての役割遂行</label></td>
                                    </tr>
                                    {{-- 3 --}}
                                    <tr>
                                        <th rowspan="5">3 専門職・実践者としての力</th>
                                        <td><input type="checkbox" name="PAAP[]" value="5" id="checkbox5"> <label
                                                for="checkbox5">(1)専門的支援関係形成力（個人、小集団、地域等）</label></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="PAAP[]" value="6" id="checkbox6"> <label
                                                for="checkbox6">(2)アセスメント力</label></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="PAAP[]" value="7" id="checkbox7"> <label
                                                for="checkbox7">(3)支援・介入・調整力</label></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="PAAP[]" value="8" id="checkbox8"> <label
                                                for="checkbox8">(4)連携・協働・チーム形成力<</label>/td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="PAAP[]" value="9" id="checkbox9"> <label
                                                for="checkbox9">(5)コミュニティへのアプローチ・ソーシャルアクションの力</label></td>
                                    </tr>
                                    {{-- 4 --}}
                                    <tr>
                                        <th>4 自己研鑽</th>
                                        <td><input type="checkbox" name="brainstorming[]" value="10" id="checkbox10">
                                            <label
                                                for="checkbox10">(1)専門性を養うために学び続ける力</label></td>
                                    </tr>
                                    {{-- 5 --}}
                                    <tr>
                                        <th rowspan="2">5 専門職教育・研究</th>
                                        <td><input type="checkbox" name="PEAR[]" value="11" id="checkbox11"> <label
                                                for="checkbox11">(1)ソーシャルワーカーを育てる力</label></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="PEAR[]" value="12" id="checkbox12"> <label
                                                for="checkbox12">(2)研究、実践成果を示す力</label></td>
                                    </tr>
                                    <tr>
                                        <th>6 ソーシャルワーカー意識</th>
                                        <td><input type="checkbox" name="SWA[]" value="13" id="checkbox13"> <label
                                                for="checkbox13">(1)ソーシャルワーカーアイデンティティ・モチベーションを維持する力</label></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>


                @endif
                <div class="input-group">
                    <div class="w-100 group-control">
                        <label for="email" class="w-25">自身の立場</label>
                        <select class="w-75" id="email" name="own_position">
                            <option value="1">SVR</option>
                            <option value="2">BMW</option>
                        </select>
                    </div>
                </div>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
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
        $('#registry').on('click','.branch-question', function() {
            var this_choose = $(this);
            var isGetQuestion = true;
            var question_setting_id = this_choose.data('question-option-setting-id');
            var parent_question_id = this_choose.data('parent-question-id');
            if(this_choose.attr('type')=='checkbox'){
                if(this_choose.is(':checked') == false){
                   // $('.question-option-setting-id-'+question_setting_id).remove()
                    $('.before-question-id-'+question_setting_id).html('')

                    isGetQuestion = false;
                }
            }
            if(isGetQuestion){
                getQuestionBranch(this_choose,question_setting_id,parent_question_id)
            }
        })
        function getQuestionBranch(this_choose,question_setting_id)
        {
            $.ajax({
                type: "post",
                url: '{{route('getBranchQuestion')}}',
                cache: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {question_setting_id: question_setting_id},
                success: function (data) {
                    console.log(data);
                    nextQuestion(this_choose,data)
                },
            });
        }
        function nextQuestion(this_choose,data)
        {
            this_choose.closest('div.input-group').after(data.html)
        }

    </script>
@endpush
