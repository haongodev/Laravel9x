<div class="popup-wrapper hidden popup-a014">
    <div class="layout-popup">
        <div class="popup-header">
            <div class="title"></div>
            <div class="close-side">
                <img class="close-icon" src="{{ asset('assets') }}/images/menu-icon/close.png" alt="close icon">
            </div>
        </div>
        <div class="popup-content">
            <div class="header-content not-remove">
                <button class="title-popup">作成・保存・共有する</button>
                <button class="title-popup open-A014-create btn-eff-ora btn-hov">作成する</button>
                <button class="title-popup open-A014-save-share btn-eff-ora btn-hov">保存・共有する（アップロード）</button>
            </div>
        </div>
    </div>
</div>
@include('components.sub_popup_A014.popup_create')
@include('components.sub_popup_A014.popup_save_share')
@push('js')
    <script>
        $('.open-A014-create').click(function () {
            $('.popup-A014-create').removeClass('hidden');
            $('.popup-a014').addClass('hidden');
        })
        $('.open-A014-save-share').click(function () {
            $('.popup-A014-save-share').removeClass('hidden');
            $('.popup-a014').addClass('hidden');
        })
    </script>
@endpush
