<?php
/*
 * Popup 10 of A013
 * */
?>
<div class="popup-wrapper hidden a012-popup-child popup-A013-download">
    <div class="layout-popup">
        <div class="popup-header">
            <div class="title"></div>
            <div class="close-side close-A013-download">
                <img class="close-icon" src="{{ asset('assets') }}/images/menu-icon/close.png" alt="close icon">
            </div>
        </div>
        <div class="popup-content">
            <div class="header-content not-remove">
                <button class="title-popup">ダウンロードする</button>
                <button class="title-popup button-link btn-eff-ora btn-hov"><a download href="/templates/facesheet/facesheet.xlsx">Excel</a></button>
                <button class="title-popup button-link btn-eff-ora btn-hov"><a download href="/templates/facesheet/facesheet.pdf">PDF</a></button>
            </div>
        </div>
        <div class="popup-footer">
            <button class="button-close close-A013-download btn-eff-bla btn-hov">戻る</button>
        </div>
    </div>
</div>
@push('js')
    <script>
        $('.close-A013-download').click(function () {
            $('.popup-A013-create').removeClass('hidden');
            $('.popup-A013-download').addClass('hidden');
        })

    </script>
@endpush
