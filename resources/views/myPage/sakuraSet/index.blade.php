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
            <button type="button">あなたの取り組み状況</button>
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
        $('.reviewer').click(function (){
            $('.popup-wrapper .popup-content .content').html('振り返り担当者との共有を解除しますか？');
            $('.popup-wrapper').removeClass('hidden');
        })
    </script>
@endpush
