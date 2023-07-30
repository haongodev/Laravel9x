@extends('layouts.web.main',
    [
        'pageSlug' => 'らセットに取り組む',
        'header_button' => '<button type="button" class="header-buttom" style="background:#FFFF00;color:#000;">さくらセットについて</button>',
        'sidebarInclude' => view('components.sakuraSet_sideBar',['sakuraManage'=>$sakuraManage])
    ])
@push('styles')
    <link href="{{ asset('assets') }}/css/sakuraSet.css" rel="stylesheet" />
@endpush
@section('content')
    {{ Breadcrumbs::render('sakuraSet') }}
    <div class="container sakura-set">
        @foreach($guidance as $guidanceData)
            <div class="top-contain without">
                @if($guidanceData->sentence_class === 1)
                    {!! $guidanceData->guidance !!}
                @else
                    {{ $guidanceData->guidance }}
                @endif
            </div>
        @endforeach
        <div class="button-list">
            <button type="button"><a href="https://www.jamhsw.or.jp/ugoki/kensyu/sakura-set.html" target="_blank">さくらセットを理解する</a></button>
            <button type="button"><a href="{{ route('yourTry') }}">あなたの取り組み状況</a></button>
            <button type="button" class="btn">振返り担当者の申請</button>
        </div>
        <div class="botton-navigate">
            <div class="pull-left">
                <ul>
                    <li>
                        @if($sakuraManage !== null)
                        <button class="{{ $sakuraManage->reviewer_member !== null ? 'in-active' : 'active' }}">担当者</button>
                        @endif
                    </li>
                    <li>
                        @if(!$sakuraManage || $sakuraManage->reviewer_member === null)
                            未申請
                        @else
                            {{ $sakuraManage->reviewer_member->name1.' '.$sakuraManage->reviewer_member->name2 }}
                        @endif
                    </li>
                </ul>
            </div>
            <div class="pull-right">
                @if($sakuraManage && $sakuraManage->reviewer_member !== null)
                    <button class="cancal-sharing {{ $sakuraManage->reviewer_status === 3 ? 'had-change' : ''}}"> {{ $sakuraManage->reviewer_status === 3 ? '解除依頼中' : '共有解除'}}</button>
                @endif
            </div>
        </div>
        @foreach($guidance as $guidanceData)
            <div class="bottom-contain without">
                @if($guidanceData->sentence_class === 1)
                    {!! $guidanceData->guidance !!}
                @else
                    {{ $guidanceData->guidance }}
                @endif
            </div>
        @endforeach
    </div>
@endsection
@push('js')
    <script>
        var manager_scre = `@include('components.sakuraSet_manager')`;
        $('.cancal-sharing').click(function (){
            if($(this).hasClass('had-change')){
                return false;
            }
            $('.popup-wrapper .popup-content .content').html('振り返り担当者との共有を解除しますか？');
            $('.popup-wrapper .popup-content .header-content').html('<button class="title-popup">確認</button>');
            $('.popup-wrapper .popup-footer').removeClass('hidden');
            $('.popup-wrapper').removeClass('hidden');
            $('.btn-popup-accept').addClass('btn-popup-confirm_delete_sharing_from_pic');
            showPopupLastConfirm('btn-popup-confirm_delete_sharing_from_pic','本当に共有を解除しますか？','<button class="title-popup">最終確認</button>')
        })

        $('.reviewer').click(function (){
            $('.popup-wrapper .popup-content .content').html('振り返り担当者の申請がありました。承認しますか？');
            $('.popup-wrapper .popup-content .header-content').html('<button class="title-popup">承認確認</button>')
            $('.popup-wrapper .popup-footer').removeClass('hidden');
            $('.popup-wrapper').removeClass('hidden');
            $('.btn-popup-accept').addClass('btn-popup-agree_to_register_pic');
        })

        $('.sharing').click(function (){
            $('.popup-wrapper .popup-content .content').html('振り返り担当者としての共有を解除しますか？');
            $('.popup-wrapper .popup-content .header-content').html('<button class="title-popup">確認</button>')
            $('.popup-wrapper .popup-footer').removeClass('hidden');
            $('.popup-wrapper').removeClass('hidden');
            $('.btn-popup-accept').addClass('btn-popup-cancel_sharing_from_pic');
            showPopupLastConfirm('btn-popup-cancel_sharing_from_pic','本当に共有を解除しますか？','<button class="title-popup">最終確認</button>')
        })

        $('.accept-cancel').click(function () {
            $('.popup-wrapper .popup-content .content').html('実施者から振り返り担当者解除の申請がありました。承認しますか？');
            $('.popup-wrapper .popup-content .header-content').html('<button class="title-popup">承認確認</button>')
            $('.popup-wrapper .popup-footer').removeClass('hidden');
            $('.popup-wrapper').removeClass('hidden');
            $('.btn-popup-accept').addClass('btn-popup-cancel_sharing_from_member');
            showPopupLastConfirm('btn-popup-cancel_sharing_from_member','本当に承認しますか？','<button class="title-popup">最終確認</button>')
        })

        $('.become-manager').click(function () {
            $('.popup-wrapper .popup-content .header-content').html('');
            $('.popup-wrapper .popup-footer').addClass('hidden');
            $('.popup-wrapper .popup-content .content').html(manager_scre);
            $('.popup-wrapper').removeClass('hidden');
        })
        function showPopupLastConfirm(el,content,header){
            $('body').off('click').on('click','.'+el,function (){
                const checkLast = $(this).attr('last-confirm');
                if(checkLast && checkLast === 'true'){
                    $('.popup-wrapper .popup-content .content').html('');
                    $('.popup-wrapper .popup-content .header-content').html('');
                    $('.popup-wrapper').addClass('hidden');
                    $(this).removeAttr('last-confirm');
                    $('.btn-popup-accept').removeClass(el);
                    var isload = false;
                    var data = {};
                    if(el === 'btn-popup-confirm_delete_sharing_from_pic'){
                        data = {
                            reviewer_status : 3,
                            view:'confirm_delete_sharing_from_pic'
                        }
                        isload = true;
                    }
                    if(el === 'btn-popup-cancel_sharing_from_pic'){
                        data = {
                            reviewer_status : 4,
                            view:'cancel_sharing_from_pic'
                        }
                        isload = true;
                    }
                    if(el === 'btn-popup-cancel_sharing_from_member'){
                        data = {
                            view:'cancel_sharing_from_member'
                        }
                        $.ajax({
                            url: '{{ route("sakuraDelete") }}',
                            data: data,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            type: 'POST',
                            success: function(response) {
                                if(response.success){
                                    
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                    if(isload){
                        $.ajax({
                            url: '{{ route("sakuraUpdate") }}', 
                            data: data,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            type: 'POST',
                            success: function(response) {
                                if(response.success){
                                    if(el === 'btn-popup-confirm_delete_sharing_from_pic'){
                                        $('.pull-right button').addClass('had-change');
                                    }
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                }else{
                    $('.popup-wrapper .popup-content .content').html(content);
                    $('.popup-wrapper .popup-content .header-content').html(header);
                    $(this).attr('last-confirm',true);
                }
                    $(this).unbind('click');
            })
        }
        $('body').on('click','.btn-popup-agree_to_register_pic',function(){
            $.ajax({
                url: '{{ route("sakuraUpdate") }}', 
                data: {
                    reviewer_status : 2,
                    view:'agree_to_register_pic'
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                success: function(response) {
                    if(response.success){
                        
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        })
    </script>
@endpush
