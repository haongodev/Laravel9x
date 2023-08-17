<?php
/*
 * Popup 15 of A013
 * */
?>
<style>
    .table-manager{
        width: 540px;
    }
    .table-manager th, td {
        border-style: none;
        padding: 10px 0px 0px 7px;
    }

    .table-manager .manager{
        border: 1px;
        border-radius: 50px;
        background-color: #FFB366;
        text-align: center;
        padding: 7px 5px;
        font-size: 26px;
    }

    .table-manager .share-facesheet.share{
        background-color: #3399FF;
    }

    .table-manager img{
        width: 32px;
    }
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
                                <div class="manager">{{$faceSheetManager->display_name}}</div>
                            </td>
                            <td style="width: 100px" class="remove">
                                @if(!$faceSheetManager->share_flg)
                                    <div><img class="close-icon" src="{{ asset('assets') }}/images/icon/delete.png" alt="close icon"></div>
                                @endif
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

                    }
                },
                error: function(xhr) {
                  //  console.log(xhr.responseText);
                }
            });
        })

        $('.popup-A013-save-share').on('click','.share-facesheet', function () {
            var id = $(this).data('id');
            var current_share = $(this).attr('data-current-share');
            var display_name = $(this).attr('data-display-name');
            var url = '{{route('sakuraUpdateShareFaceSheet')}}'
            //Check exist file share
            if (isExistsShare()) {

            }else{
                //show popup 30
                if(current_share == 0){
                    var html = 'フェイスシート（'+display_name+'）を共有しますか？';
                }else{
                    var html = 'フェイスシート（'+display_name+'）を共有を解除しますか？';

                }

                $('.popup-A013-confirm').find('input[name="id"]').val(id);
                $('.popup-A013-confirm').find('input[name="share_flg"]').val(current_share == 1 ? 0 : 1);
                $('.popup-A013-confirm').find('input[name="url"]').val(url);
                //if turn off share use last confirm
                $('.popup-A013-confirm').find('input[name="last_confirm"]').val(current_share);

                $('.popup-A013-confirm').find('.header-content').html(html)
                $('.popup-A013-confirm').removeClass('hidden');
                $('.popup-A013-save-share').addClass('hidden');
            }

        })

        function isExistsShare(){
            var isShare = false;
            $('.facesheet-manage').find('button').each(function (){
                if($(this).hasClass('share')){
                    isShare = true
                }
            });
            return isShare;
        }
    </script>
@endpush
