@extends('layouts.web.main',
    [
        'pageSlug' => 'らセットに取り組む',
        'header_button' => '<button type="button" class="header-buttom" style="background:#FFFF00;color:#000;">さくらセットについて</button>',
        'sidebarInclude' => view('components.sakuraSet_sideBar')
    ])
@push('styles')
    <link href="{{ asset('assets') }}/css/sakuraSet.css" rel="stylesheet" />
@endpush
@section('content')
    {{ Breadcrumbs::render('sakuraSet') }}
    <div class="container sakura-set">
        <div class="top-contain without">（文章）</div>
        <div class="button-list">
            <button type="button">さくらセットを理解する</button>
            <button type="button"><a href="{{ route('yourTry') }}">あなたの取り組み状況</a></button>
            <button type="button" class="btn">振返り担当者の申請</button>
        </div>
        <div class="botton-navigate">
            <div class="pull-left">
                <ul>
                    <li>
                        <button>共有解除</button>
                    </li>
                    <li>
                        振り返り
                    </li>
                    <li>
                        花子
                    </li>
                </ul>
            </div>
            <div class="pull-right">
                <button>共有解除</button>
            </div>
        </div>
        <div class="bottom-contain without">（文章）</div>
    </div>
@endsection
@push('js')
    <script>
        var manager_scre = `@include('components.sakuraSet_manager')`;
        $('.sharing').click(function (){
            $('.popup-wrapper .popup-content .content').html('振り返り担当者としての共有を解除しますか？');
            $('.popup-wrapper .popup-content .header-content').html('<button class="title-popup">確認</button>')
            $('.popup-wrapper').removeClass('hidden');
            $('.btn-popup-accept').addClass('btn-popup-accept-sharing');
            showPopupLastConfirm('btn-popup-accept-sharing','本当に共有を解除しますか？','<button class="title-popup">最終確認</button>')
        })

        $('.reviewer').click(function (){
            $('.popup-wrapper .popup-content .content').html('振り返り担当者の申請がありました。承認しますか？');
            $('.popup-wrapper .popup-content .header-content').html('<button class="title-popup">承認確認</button>')
            $('.popup-wrapper').removeClass('hidden');
            $('.btn-popup-accept').addClass('btn-popup-accept-reviewer');
            showPopupLastConfirm('btn-popup-accept-reviewer','振り返り担当者としての共有を解除しますか？','<button class="title-popup">確認</button>')
        })

        $('.accept-cancel').click(function () {
            $('.popup-wrapper .popup-content .content').html('実施者から振り返り担当者解除の申請がありました。承認しますか？');
            $('.popup-wrapper .popup-content .header-content').html('<button class="title-popup">承認確認</button>')
            $('.popup-wrapper').removeClass('hidden');
            $('.btn-popup-accept').addClass('btn-popup-accept-cancel');
            showPopupLastConfirm('btn-popup-accept-sharing','本当に承認しますか？','<button class="title-popup">最終確認</button>')
        })

        $('.become-manager').click(function () {
            $('.popup-wrapper .popup-content .header-content').html('');
            $('.popup-wrapper .popup-footer').addClass('hidden');
            $('.popup-wrapper .popup-content .content').html(manager_scre);
            $('.popup-wrapper').removeClass('hidden');
        })
        function showPopupLastConfirm(el,content,header){
            $('.layout-popup').on('click','.'+el,function (){
                const checkLast = $(this).attr('last-confirm');
                if(checkLast && checkLast === 'true'){
                    $('.pull-right button').addClass('had-change');
                    $('.popup-wrapper .popup-content .content').html('');
                    $('.popup-wrapper .popup-content .header-content').html('');
                    $('.popup-wrapper').addClass('hidden');
                    $(this).removeAttr('last-confirm');
                    $('.btn-popup-accept').removeClass(el);
                }else{
                    $('.popup-wrapper .popup-content .content').html(content);
                    $('.popup-wrapper .popup-content .header-content').html(header);
                    $(this).attr('last-confirm',true);
                }
            })
        }
    </script>
@endpush
