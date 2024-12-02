<?php
/*
 * Popup 5 of A013
 * */
?>
<div class="popup-wrapper hidden a012-popup-child popup-A013-create">
    <div class="layout-popup">
        <div class="popup-header">
            <div class="title"></div>
            <div class="close-side close-A013-create">
                <img class="close-icon" src="{{ asset('assets') }}/images/menu-icon/close.png" alt="close icon">
            </div>
        </div>
        <div class="popup-content">
            <div class="header-content not-remove">
                <button class="title-popup">作成する</button>
                <button class="title-popup button-link btn-eff-ora btn-hov"><a href="https://www.jamhsw.or.jp/ugoki/kensyu/document/sakura_set/02-3.pdf" target="_blank">ワークシート作成要綱を確認する</a></button>
                <button class="title-popup open-A013-download btn-eff-ora btn-hov">ダウンロードする</button>
            </div>
        </div>
        <div class="popup-footer">
            <button class="button-close close-A013-create btn-eff-bla btn-hov">戻る</button>
        </div>
    </div>
</div>
@include('components.sub_popup_A013.popup_download')
@push('js')
    <script>
        $('.close-A013-create').click(function () {
            $('.popup-A013-create').addClass('hidden');
            $('.popup-a013').removeClass('hidden');
        })

        $('.open-A013-download').click(function () {
            $('.popup-A013-download').removeClass('hidden');
            $('.popup-A013-create').addClass('hidden');
        })

    </script>
@endpush
