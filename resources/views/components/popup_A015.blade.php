<div class="popup-wrapper hidden popup-a015">
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
                <button class="title-popup btn-eff-ora btn-hov download-template">ダウンロードする</button>
                <button class="title-popup btn-eff-ora btn-hov open-A015-save-share">保存・共有する</button>
                <button class="title-popup btn-eff-ora btn-hov pick-date-next">次回の振り返り予定日を選択する</button>
            </div>
        </div>
    </div>
</div>
@include('components.sub_popup_A015.popup_choose_date')
@include('components.sub_popup_A015.popup_save_share')
@push('js')
    <script>
        $('.download-template').click(function () {
            // URL of the file you want to download
            var fileURL = '{{ asset('templates/initiative/initiativesheet.xlsx') }}';
            console.log(fileURL);
            // Create a link element
            var link = document.createElement('a');
            link.id = 'downloadLink';
            link.style.display = 'none';
            link.href = fileURL;
            link.download = 'initiativesheet.xlsx';
            
            // Append the link to the document
            document.body.appendChild(link);
            
            // Simulate a click on the link to trigger the download
            link.click();
            
            // Clean up by removing the link from the document
            document.body.removeChild(link);
        })
        $('.pick-date-next').click(function(){
            $('.popup-A015-choose_date').removeClass('hidden');
            $('.popup-a015').addClass('hidden');
        })
        $('.open-A015-save-share').click(function(){
            $('.popup-A015-save-share').removeClass('hidden');
            $('.popup-a015').addClass('hidden');
        })
    </script>
@endpush
