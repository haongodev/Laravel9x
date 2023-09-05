@extends('layouts.web.main',
    [
        'pageSlug' => 'らセットに取り組む',
        'header_button' => '<button type="button" class="header-buttom btn-eff-yel btn-hov" style="background:#FFFF00;color:#000;">さくらセットについて</button>',
        'sidebarInclude' => view('components.sakuraSet_sideBar')
    ])
@push('styles')
    <link href="{{ asset('assets') }}/css/sakuraSet.css" rel="stylesheet" />
@endpush
@section('content')
    {{ Breadcrumbs::render('yourTry') }}
    <div class="container yourTry">
        <div class="button-list">
            <button type="button" class="btn-eff-ora btn-hov"><a href="https://www.jamhsw.or.jp/ugoki/kensyu/document/sakura_set/01_Carrier_rudder.pdf" target="_blank">キャリアラダーを確認する</a></button>
            <button type="button" class="open-A013 btn-eff-ora btn-hov">フェイスシート（研鑽計画）を作成・保存・共有する</button>
            <button type="button" class="open-A014 btn-eff-ora btn-hov">振り返りシートを作成・保存・共有する</button>
            <button type="button" class="open-A015 btn-eff-ora btn-hov">さくらセット取り組み表を作成・保存・共有する</button>
            {{-- <button type="button" class="open-A016 btn-eff-red btn-hov">更新研修フェイスシート（研鑽計画）を作成・提出する</button> --}}
        </div>
    </div>

    @include('components.popup_A013')
    @include('components.popup_A014')
    @include('components.popup_A015')
@endsection
@push('js')
    <script>
        $('.open-A013').click(function () {
            $('.popup-a013').removeClass('hidden');
        })
        $('.open-A014').click(function () {
            $('.popup-a014').removeClass('hidden');
        })
        $('.open-A015').click(function () {
            $('.popup-a015').removeClass('hidden');
        })
    </script>
@endpush
