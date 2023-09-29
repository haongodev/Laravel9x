<?php
/*
 * Popup 10 of A014
 * */
?>
<div class="popup-wrapper hidden a012-popup-child popup-A014-download">
    <div class="layout-popup">
        <div class="popup-header">
            <div class="title"></div>
            <div class="close-side close-A014-download">
                <img class="close-icon" src="{{ asset('assets') }}/images/menu-icon/close.png" alt="close icon">
            </div>
        </div>
        <div class="popup-content">
            <div class="header-content not-remove">
                <button class="title-popup">ダウンロードする</button>
                <button class="title-popup button-link btn-eff-ora"><a download href="/templates/reflection/reflectionsheet.xlsx">Excel</a></button>
                <button class="title-popup button-link btn-primary">PDF</button>
                <button class="title-popup button-link btn-eff-ora"><a download href="/templates/reflection/reflectionsheet_6m.pdf">６か月目</a></button>
                <button class="title-popup button-link btn-eff-ora"><a download href="/templates/reflection/reflectionsheet_12m.pdf">12か月目</a></button>
                <button class="title-popup button-link btn-eff-ora"><a download href="/templates/reflection/reflectionsheet_at.pdf">随時</a></button>
            </div>
        </div>
        <div class="popup-footer">
            <button class="button-close close-A014-download btn-eff-bla">戻る</button>
        </div>
    </div>
</div>
@push('js')
    <script>
        $('.close-A014-download').click(function () {
            $('.popup-A014-create').removeClass('hidden');
            $('.popup-A014-download').addClass('hidden');
        })

    </script>
@endpush
