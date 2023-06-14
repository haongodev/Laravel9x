@extends('layouts.web.main', ['pageSlug' => 'myPage.myPage'])
@push('styles')
    <link href="{{ asset('assets') }}/css/registry.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/cdnjs.cloudflare.com_ajax_libs_toastr.js_latest_toastr.min.css" rel="stylesheet" />
@endpush
@section('content')
    {{ Breadcrumbs::render('creditRegistry') }}
    <div class="container">
        <div class="contain1">
        </div>
        <div class="form-registry">
            <form action="{{ route('handleCreditRegistry') }}" method="post">
                @csrf
                <input type="hidden" value="1" name="confirm">
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
                        <input class="w-75" type="text" name="SVR_attributes" placeholder="本協会の認定SVR" value="{{ session('popup_confirm')['SVR_attributes'] ?? ''}}"/>
                    </div>
                </div>
                <div class="input-group">
                    <div class="w-100 group-control">
                        <label for="email" class="w-25">相手の氏名</label>
                        <input class="w-75" type="text" name="TOPL" placeholder="本協会の認定SVR" value="{{ session('popup_confirm')['TOPL'] ?? ''}}"/>
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
                            <input type="datetime-local" name="s_period" value="{{ session('popup_confirm')['s_period'] ?? ''}}"/>
                            <span>~</span>
                            <input type="datetime-local" name="e_period" value="{{ session('popup_confirm')['e_period'] ?? ''}}"/>
                        </div>
                    </div>
                </div>
                <div class="input-group">
                    <div class="w-100 group-control">
                        <label for="email" class="w-25">SV契約</label>
                        <div class="w-75 date-group second">
                            <input type="datetime-local" name="SV_contract" value="{{ session('popup_confirm')['SV_contract'] ?? ''}}"/>
                        </div>
                    </div>
                </div>
                <div class="input-group">
                    <div class="w-100 group-control">
                        <label for="email" class="w-25">研鑽目的</label>
                        <div class="w-75 table-group">
                            <table>
                                {{-- 1 --}}
                                <tr>
                                    <th class="bg-red" rowspan="2">1 仕事と暮らしの調和</th>
                                    <td ><input type="checkbox" name="study_purpose[]" value="1" id="checkbox1"> <label for="checkbox1">(1)健康状態の自己管理</label></td>
                                </tr>
                                <tr>
                                    <td ><input type="checkbox" name="study_purpose[]" value="2" id="checkbox2"> <label for="checkbox2">(2)仕事と家庭のバランス</label></td>
                                </tr>
                                {{-- 2 --}}
                                <tr>
                                    <th rowspan="2">2 社会人・組織人としての力</th>
                                    <td><input type="checkbox" name="SAAMOS[]" value="3" id="checkbox3"> <label for="checkbox3">(1)基本姿勢やマナー</label></td>
                                </tr>
                                <tr>
                                    <td ><input type="checkbox" name="SAAMOS[]" value="4" id="checkbox4"> <label for="checkbox4">(2)組織人としての役割遂行</label></td>
                                </tr>
                                {{-- 3 --}}
                                <tr>
                                    <th rowspan="5">3 専門職・実践者としての力</th>
                                    <td><input type="checkbox" name="PAAP[]" value="5" id="checkbox5"> <label for="checkbox5">(1)専門的支援関係形成力（個人、小集団、地域等）</label></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="PAAP[]" value="6" id="checkbox6"> <label for="checkbox6">(2)アセスメント力</label></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="PAAP[]" value="7" id="checkbox7"> <label for="checkbox7">(3)支援・介入・調整力</label></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="PAAP[]" value="8" id="checkbox8"> <label for="checkbox8">(4)連携・協働・チーム形成力<</label>/td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="PAAP[]" value="9" id="checkbox9"> <label for="checkbox9">(5)コミュニティへのアプローチ・ソーシャルアクションの力</label></td>
                                </tr>
                                {{-- 4 --}}
                                <tr>
                                    <th>4 自己研鑽</th>
                                    <td><input type="checkbox" name="brainstorming[]" value="10" id="checkbox10"> <label for="checkbox10">(1)専門性を養うために学び続ける力</label></td>
                                </tr>
                                {{-- 5 --}}
                                <tr>
                                    <th rowspan="2">5 専門職教育・研究</th>
                                    <td><input type="checkbox" name="PEAR[]" value="11" id="checkbox11"> <label for="checkbox11">(1)ソーシャルワーカーを育てる力</label></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="PEAR[]" value="12" id="checkbox12"> <label for="checkbox12">(2)研究、実践成果を示す力</label></td>
                                </tr>
                                <tr>
                                    <th>6 ソーシャルワーカー意識</th>
                                    <td><input type="checkbox" name="SWA[]" value="13" id="checkbox13"> <label for="checkbox13">(1)ソーシャルワーカーアイデンティティ・モチベーションを維持する力</label></td>
                                </tr>
                            </table>
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
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('assets/js-lib/toastr.min.js')}}"></script>
    <script>
        window.jsPDF = window.jspdf.jsPDF;

        $('.decline-btn').click(function (){
            var isValid = true;
            $('.form-registry input').each(function() {
                var value = $(this).val();
                if (value.trim() !== '' && $(this).is(':checked')) {
                    isValid = false;
                    return false;
                }
            });
            if(!isValid){
                $('.popup-wrapper .popup-content .content').html('入力途中のデータが破棄されますがよろしいですか？');
                $('.popup-wrapper').removeClass('hidden');
            }else{
                window.location.href = "{{ route('typeSelected')}}";
            }
        })
        $('.popup-wrapper').click(function (e){
            if(e.target.className === 'popup-wrapper'){
                $('.popup-wrapper .popup-content .content').html('');
                $('.popup-wrapper').addClass('hidden');
                $('.btn-popup-accept').removeAttr('last-confirm');
            }
        })
        $('.close-icon,.btn-popup-decline').click(function (e){
            $('.popup-wrapper .popup-content .content').html('');
            $('.popup-wrapper').addClass('hidden');
            $('.btn-popup-accept').removeAttr('last-confirm');
        })
        $('.btn-popup-accept').click(function (){
            if($(this).attr('last-confirm') !== undefined){
                window.location.href = "{{ route('typeSelected')}}";
            }
            if($(this).attr('register') !== undefined){
                $.ajax({
                    url: '{{ route('handleCreditRegistry') }}', // Replace with the appropriate route URL
                    type: 'POST',
                    data: { "_token": "{{ csrf_token() }}" },
                    success: function(response) {
                        toastr.options.timeOut = 3000;
                        toastr.options.onHidden = function() {
                            $('.confirm-popup').addClass('hidden');
                        }
                        toastr.info('単位登録を実行しました。')
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
                return false;
            }
            $('.popup-wrapper .popup-content .content').html('本当に廃棄しますか？');
            $('.btn-popup-accept').attr('last-confirm',true);
        })
        $('.btn-export-pdf').click(function () {
            exportPDF('table-confirm-registry');
        })
        var specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '.no-export': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true;
            }
        };
        function exportPDF(id) {
            var doc = new jsPDF('p', 'pt', 'a4');
            //A4 - 595x842 pts
            //https://www.gnu.org/software/gv/manual/html_node/Paper-Keywords-and-paper-size-in-points.html

            doc.autoTable({ html: '#'+id })
            doc.save('table.pdf')
        }
    </script>
@endpush
