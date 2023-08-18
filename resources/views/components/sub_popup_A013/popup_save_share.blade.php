<?php
/*
 * Popup 15 of A013
 * */
?>
<style>

</style>
<div class="popup-wrapper hidden a012-popup-child popup-A013-save-share">
    <div class="layout-popup">
        <div class="popup-header">
            <div class="title"></div>
            <div class="close-side close-A013-save-share">
                <img class="close-icon" src="{{ asset('assets') }}/images/menu-icon/close.png" alt="close icon">
            </div>
        </div>
        <div class="popup-content">
            <div class="header-content not-remove">
                <button class="title-popup upload">保存・共有する <img src="{{ asset('assets') }}/images/icon/upload.png" alt=""></button>
                <input type="file" class="hidden" name="a013_upload" id="a013_upload">
                <table class="table-manager" style="width: 500px">
                    @foreach($faceSheetManagerData as $faceSheetManager)
                        <tr class="facesheet-id-{{$faceSheetManager->id}}">
                            <td style="width: 100px">
                                <div class="share-facesheet manager {{$faceSheetManager->share_flg ? 'share' : ''}}"
                                        data-current-share="{{$faceSheetManager->share_flg}}"
                                        data-id="{{$faceSheetManager->id}}"
                                        data-display-name="{{$faceSheetManager->display_name}}"
                                     style=""
                                >共有</div>
                            </td>
                            <td>
                                <div class="manager"><a download class="download" href="{{config('constants.path_upload').'/'.auth()->user()->id.'/facesheet/'.$faceSheetManager->file_name}}">{{$faceSheetManager->display_name}}</a></div>
                            </td>
                            <td style="width: 100px">
                                    <div class="remove" data-id="{{$faceSheetManager->id}}"
                                         data-display-name="{{$faceSheetManager->display_name}}"
                                    >
                                        @if(!$faceSheetManager->share_flg)<img src="{{ asset('assets') }}/images/icon/delete.png" alt="close icon">@endif
                                    </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="popup-footer">
            <button class="button-close close-A013-save-share">戻る</button>
        </div>
    </div>
</div>
@include('components.sub_popup_A013.popup_confirm')
@push('js')
    <script>
        $('.close-A013-save-share').click(function () {
            $('.popup-a013').removeClass('hidden');
            $('.popup-A013-save-share').addClass('hidden');
        })
        $('.upload').click(function () {
            $('#a013_upload').trigger('click');
        })
        $('#a013_upload').on('change', function () {
            var url = '{{ route("sakuraUpload") }}';
            var files = $(this)[0].files;
            var fd = new FormData();
            fd.append('file', files[0]);
            $.ajax({
                url,
                data:fd,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if(response.success){
                        $('.table-manager').append(response.html)
                    }
                },
                error: function(xhr) {
                  alert('error')
                }
            });
        })

        $('.popup-A013-save-share').on('click','.share-facesheet', function () {
            var id = $(this).data('id');
            var current_share = $(this).attr('data-current-share');
            var display_name = $(this).attr('data-display-name');
            var url = '{{route('sakuraUpdateShareFaceSheet')}}';
            var is_exist_share = isExistsShare();
            //Check exist file share
            if(current_share == 1){
                //show popup 34
                var html = 'フェイスシート（'+display_name+'）を共有を解除しますか？';
            }else{
                if (isExistsShare()) {
                    //Show popup 43
                    var html = 'フェイスシート（'+display_name+'）に共有を変更しますか？';
                }else{
                    //Show popup 30
                    var html = 'フェイスシート（'+display_name+'）を共有しますか？';
                }
            }

            $('.popup-A013-confirm').find('input[name="id"]').val(id);
            $('.popup-A013-confirm').find('input[name="share_flg"]').val(current_share == 1 ? 0 : 1);
            $('.popup-A013-confirm').find('input[name="url"]').val(url);
            //if turn off share use last confirm
            $('.popup-A013-confirm').find('input[name="last_confirm"]').val(current_share);
            // if exsits file share
            $('.popup-A013-confirm').find('input[name="is_exist_share"]').val(is_exist_share ? 1 : 0);
            $('.popup-A013-confirm').find('input[name="is_remove"]').val(0);
            $('.popup-A013-confirm').find('.header-content').html(html)
            $('.popup-A013-confirm').removeClass('hidden');
            $('.popup-A013-save-share').addClass('hidden');

        })

        $('.popup-A013-save-share').on('click','.remove',function (){
            var id = $(this).data('id');
            var display_name = $(this).attr('data-display-name');
            var url = '{{route('sakuraRemoveShareFaceSheet')}}';
            var html = 'フェイスシート（'+display_name+'）を削除しますか？';

            $('.popup-A013-confirm').find('input[name="id"]').val(id);
            $('.popup-A013-confirm').find('input[name="url"]').val(url);
            $('.popup-A013-confirm').find('input[name="is_remove"]').val(1);
            $('.popup-A013-confirm').find('.header-content').html(html)
            //Show popup 22
            $('.popup-A013-confirm').removeClass('hidden');
            $('.popup-A013-save-share').addClass('hidden');
        })

        function isExistsShare(){
            var isShare = false;
            $('.table-manager').find('.manager').each(function (){
                if($(this).hasClass('share')){
                    isShare = true
                }
            });
            return isShare;
        }
    </script>
@endpush
