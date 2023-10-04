
<div class="popup-wrapper hidden a015-popup-child popup-A015-confirm">
    <div class="layout-popup">
        <div class="popup-header">
            <div class="title"></div>
            <div class="close-side close-A015-confirm">
                <img class="close-icon" src="{{ asset('assets') }}/images/menu-icon/close.png" alt="close icon">
            </div>
        </div>
        <div class="popup-content">
            <div class="header-content not-remove fz-24">

            </div>
        </div>
        <input type="hidden" name="id">
        <input type="hidden" name="share_flg">
        <input type="hidden" name="url">
        <input type="hidden" name="last_confirm">
        <input type="hidden" name="is_exist_share">
        <input type="hidden" name="is_remove">
        <div class="popup-footer">
            <button type="button" class="btn-popup-accept initiativetable-accept btn-eff-ora btn-hov">はい</button>
            <button type="button" class="btn-popup-decline close-A015-confirm btn-eff-ora btn-hov">いいえ</button>
        </div>
    </div>
</div>
@push('js')
    <script>
        $('.close-A015-confirm').click(function (){
            //Remove class delete initiativetable
            $('.popup-A015-confirm').find('.initiativetable-accept').removeClass('initiativetable-accept-remove');
            $('.popup-A015-confirm').addClass('hidden');
            $('.popup-A015-save-share').removeClass('hidden');
        })

        $('.popup-A015-confirm').on('click','.initiativetable-accept',function (){
            var id = $('.popup-A015-confirm').find('input[name="id"]').val();
            var share_flg = $('.popup-A015-confirm').find('input[name="share_flg"]').val();
            var url = $('.popup-A015-confirm').find('input[name="url"]').val();
            var last_confirm = $('.popup-A015-confirm').find('input[name="last_confirm"]').val();
            var is_exist_share = $('.popup-A015-confirm').find('input[name="is_exist_share"]').val();
            var is_remove = $('.popup-A015-confirm').find('input[name="is_remove"]').val();

            if(is_remove == 1){
                //Popup 26
                $('.popup-A015-confirm').find('.header-content').html('本当に削除しますか？');
                $('.popup-A015-confirm').find('.initiativetable-accept').addClass('initiativetable-accept-remove');
                return false;
            }else{
                // If change not share confirm final
                if(last_confirm == 1){
                    //Show popup 37
                    $('.popup-A015-confirm').find('.header-content').html('本当に共有を解除しますか？');
                    $('.popup-A015-confirm').find('input[name="last_confirm"]').val(0);
                    $('.popup-A015-confirm').find('input[name="is_exist_share"]').val(0);
                    return false;
                }else if(is_exist_share == 1){
                    //if exist file share confirm final
                    //Popup 46
                    $('.popup-A015-confirm').find('.header-content').html('本当に共有を切り替えますか？');
                    $('.popup-A015-confirm').find('input[name="is_exist_share"]').val(0);
                    return false;
                }
                var data = {
                    id : id,
                    share_flg: share_flg

                }
                $.ajax({
                    url: url,
                    data: data,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'POST',
                    success: function (response) {
                        if (response.success) {
                            // Update giao dien
                            if(share_flg == 1){
                                $('.a015-initive-list').children('div').each(function(){
                                    $(this).find('.sharing').attr('data-current-share',0).removeClass('sharing').addClass('none-share').removeClass('btn-eff-pri').addClass('btn-eff-ora');
                                    if(!$(this).find('img').length){
                                        $(this).find('div').remove();
                                        $(this).append('<img class="remove" src="/assets/images/icon/delete.png" alt="close icon">');
                                    }
                                })

                                $('.initiativetable-id-'+id).find('.share-initiativetable').addClass('sharing').removeClass('none-share');
                                $('.initiativetable-id-'+id).find('.share-initiativetable').addClass('btn-eff-pri').removeClass('btn-eff-ora');
                                $('.initiativetable-id-'+id).find('img').remove('');
                                $('.initiativetable-id-'+id).append('<div style="width:50px"></div>');
                            }else{
                                $('.initiativetable-id-'+id).find('.share-initiativetable').removeClass('sharing').addClass('none-share');
                                $('.initiativetable-id-'+id).find('.share-initiativetable').removeClass('btn-eff-pri').addClass('btn-eff-ora');
                                $('.initiativetable-id-'+id).find('div').remove();
                                $('.initiativetable-id-'+id).append('<img class="remove" src="/assets/images/icon/delete.png" alt="close icon">');
                            }
                            $('.initiativetable-id-'+id).find('.share-initiativetable').attr('data-current-share',share_flg);
                            $('.popup-A015-confirm').addClass('hidden');
                            $('.popup-A015-save-share').removeClass('hidden');
                        }
                    },
                    error: function (xhr) {
                        alert('error');
                    }
                });
            }
        })

        $('.popup-A015-confirm').on('click','.initiativetable-accept-remove',function (){
            var id = $('.popup-A015-confirm').find('input[name="id"]').val();
            var url = $('.popup-A015-confirm').find('input[name="url"]').val();
            var data = {id:id}
            $.ajax({
                url: url,
                data: data,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                success: function (response) {
                    if (response.success) {
                        $('.initiativetable-id-'+id).remove();
                        $('.popup-A015-confirm').find('.initiativetable-accept').removeClass('initiativetable-accept-remove');
                        $('.popup-A015-confirm').addClass('hidden');
                        $('.popup-A015-save-share').removeClass('hidden');
                    }
                },
                error: function (xhr) {
                    alert('error');
                }
            });
        })
    </script>
@endpush
