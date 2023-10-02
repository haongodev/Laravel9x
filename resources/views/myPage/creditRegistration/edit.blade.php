@extends('layouts.web.main', [
    'pageSlug' => '修正',
    'button_unit_guidelines' => true,
    'button_operation_manual' => true
    ])
@push('styles')
    <link href="{{ asset('assets') }}/css-lib/chosen/chosen.min.css" rel="stylesheet"/>
    <link href="{{ asset('assets') }}/css/registry.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/cdnjs.cloudflare.com_ajax_libs_toastr.js_latest_toastr.min.css" rel="stylesheet" />
@endpush
@section('content')
    {{ Breadcrumbs::render('creditEdit') }}
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
            <form action="{{ route('handleCreditUpdate') }}" method="post" id="registry">
                @csrf
                <input type="hidden" value="1" name="confirm">
                <input type="hidden" value="{{$answerManageId}}" name="answer_manage_id">
                <input type="hidden" id="urlGetLinkQuestion" value="{{route('getLinkQuestion')}}">
                <input type="hidden" id="urlGetQuestion" value="{{route('getBranchHisQuestion')}}">
                <input type="hidden" id="urlValidateViewVideo" value="{{route('validateViewVideoEdit')}}">
                <input type="hidden" name="type_native_id" value="{{$typeNativeId}}">
                <input type="hidden" name="question_manager_id" value="{{$questionManagerId}}">
                <input type="hidden" id="action" name="action" value="edit">
                @include('myPage.creditRegistration.registry_question_edit')
                <div class="action">
                    <button type="button" class="accept-btn submit-btn btn-eff-pri btn-hov hidden">確認</button>
                    <button type="button" class="decline-btn btn-eff-ora btn-hov">戻る</button>
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
    <script src="{{asset('assets/js-lib/chosen.jquery.js')}}"></script>
    <script src="{{asset('assets/js/registry.js')}}"></script>
    <script src="{{asset('assets/js/select.js')}}"></script>
    <script src="{{asset('assets/js/date.js')}}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script>
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
                $('#popup_confirm_back_register .popup-content .content').html('入力途中のデータが破棄されますがよろしいですか？');
                $('#popup_confirm_back_register').removeClass('hidden');
            }else{
                window.location.href = "{{ route('typeSelected',['type_native_id'=>$typeNativeId])}}";
            }
        })
        $('.btn-popup-accept').click(function (){
            if($(this).attr('last-confirm') !== undefined){
                window.location.href = "{{ route('typeSelected',['type_native_id'=>$typeNativeId])}}";
            }
            if($(this).attr('register') !== undefined){
                $.ajax({
                    url: '{{ route('handleCreditUpdate') }}', // Replace with the appropriate route URL
                    type: 'POST',
                    data: { "_token": "{{ csrf_token() }}" },
                    success: function(response) {
                        toastr.options.timeOut = 3000;
                        toastr.options.onHidden = function() {
                            $('.confirm-popup').addClass('hidden');
                            window.location.href = "{{ route('typeSelected',['type_native_id'=>$typeNativeId])}}";
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
    </script>
@endpush
