<?php
/*
 * Popup 5 of A014
 * */
?>
<div class="popup-wrapper hidden a012-popup-child popup-A014-create">
    <div class="layout-popup">
        <div class="popup-header">
            <div class="title"></div>
            <div class="close-side close-A014-create">
                <img class="close-icon" src="{{ asset('assets') }}/images/menu-icon/close.png" alt="close icon">
            </div>
        </div>
        <div class="popup-content">
            <div class="header-content not-remove">
                <button class="title-popup">作成する</button>
                <button class="title-popup button-link"><a href="https://www.jamhsw.or.jp/ugoki/kensyu/document/sakura_set/02-3.pdf" target="_blank">ワークシート作成要綱を確認する</a></button>
                <button class="title-popup open-A014-download">ダウンロードする</button>
            </div>
        </div>
        <div class="popup-footer">
            <button class="button-close close-A014-create">戻る</button>
        </div>
    </div>
</div>
@include('components.sub_popup_A014.popup_download')
@push('js')
    <script>
        $('.close-A014-create').click(function () {
            $('.popup-A014-create').addClass('hidden');
            $('.popup-a014').removeClass('hidden');
        })

        $('.open-A014-download').click(function () {
            $('.popup-A014-download').removeClass('hidden');
            $('.popup-A014-create').addClass('hidden');
        })

    </script>
@endpush
