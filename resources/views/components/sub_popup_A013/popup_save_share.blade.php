<?php
/*
 * Popup 15 of A013
 * */
?>
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
                <button class="title-popup upload">保存・共有する css mui ten upload</button>
                <input type="file" class="hidden" name="a013_upload" id="a013_upload">
                <table class="facesheet-manage">
                    @foreach($faceSheetManagerData as $faceSheetManager)
                        <tr>
                            <td>
                                <button class="share-facesheet title-popup {{$faceSheetManager->share_flg ? 'share' : ''}}" data-current-share="{{$faceSheetManager->share_flg}}" data-id="{{$faceSheetManager->id}}">
                                @if($faceSheetManager->share_flg)
                                    共有 share
                                @else
                                    共有 khong share
                                @endif
                                </button>
                            </td>
                            <td>
                                {{$faceSheetManager->display_name}}
                            </td>
                            <td>
                                @if(!$faceSheetManager->share_flg)
                                    xot rac
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
{{--                <button class="title-popup">Excel</button>--}}
{{--                <button class="title-popup">PDF</button>--}}
            </div>
        </div>
        <div class="popup-footer">
            <button class="button-close close-A013-save-share">戻る</button>
        </div>
    </div>
</div>
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

        $('.share-facesheet').on('click', function () {
            var id = $(this).data('id');
            var current_share = $(this).data('current-share')

            //Check exist file share
            if(isExistsShare()){

            }
            console.log(id,current_share,);
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
