<?php
/*
 * Popup 5 of A013
 * */
?>

<div class="popup-wrapper hidden a012-popup-child popup-A013-confirm">
    <div class="layout-popup">
        <div class="popup-header">
            <div class="title"></div>
            <div class="close-side close-A013-confirm">
                <img class="close-icon" src="{{ asset('assets') }}/images/menu-icon/close.png" alt="close icon">
            </div>
        </div>
        <div class="popup-content">
            <div class="header-content not-remove">

            </div>
        </div>
        <input type="hidden" name="id">
        <input type="hidden" name="share_flg">
        <input type="hidden" name="url">
        <input type="hidden" name="last_confirm">
        <div class="popup-footer">
            <button type="button" class="btn-popup-accept facesheet-accept">はい</button>
            <button type="button" class="btn-popup-decline close-A013-confirm">いいえ</button>
        </div>
    </div>
</div>
@push('js')
    <script>
        $('.close-A013-confirm').click(function (){
            $('.popup-A013-confirm').addClass('hidden');
            $('.popup-A013-save-share').removeClass('hidden');
        })

        $('.facesheet-accept').click(function (){
            var id = $('.popup-A013-confirm').find('input[name="id"]').val();
            var share_flg = $('.popup-A013-confirm').find('input[name="share_flg"]').val();
            var url = $('.popup-A013-confirm').find('input[name="url"]').val();
            var last_confirm = $('.popup-A013-confirm').find('input[name="last_confirm"]').val();

            // If change not share confirm final
            if(last_confirm == 1){
                $('.popup-A013-confirm').find('.header-content').html('本当に共有を解除しますか？');
                $('.popup-A013-confirm').find('input[name="last_confirm"]').val(0);
                return false;

            }
            var data = {
                id : id,
                share_flg:share_flg
            };

            $.ajax({
                url: url,
                data: data,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                success: function (response) {
                    if (response.success) {
                        // Update giao dien
                        if(share_flg == 1){
                            $('.popup-A013-save-share').find('.share-facesheet').each(function(){
                                $(this).attr('data-current-share',0)
                                $(this).removeClass('share');
                            })
                            $('.popup-A013-save-share').find('.remove').each(function(){

                                $(this).html('<img class="close-icon" src="https://cms-plative.local/assets/images/icon/delete.png" alt="close icon">')
                            })
                            $('.facesheet-id-'+id).find('.share-facesheet').addClass('share');
                            $('.facesheet-id-'+id).find('.remove').html('');

                        }else{
                            $('.facesheet-id-'+id).find('.share-facesheet').removeClass('share');
                            $('.facesheet-id-'+id).find('.remove').html('<img class="close-icon" src="https://cms-plative.local/assets/images/icon/delete.png" alt="close icon">');
                        }
                        $('.facesheet-id-'+id).find('.share-facesheet').attr('data-current-share',share_flg);
                        $('.popup-A013-confirm').addClass('hidden');
                        $('.popup-A013-save-share').removeClass('hidden');
                    }
                },
                error: function (xhr) {
                    //  console.log(xhr.responseText);
                }
            });
        })

    </script>
@endpush
