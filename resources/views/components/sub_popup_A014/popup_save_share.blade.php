<?php
/*
 * Popup 17 of A014
 * */
?>
<style>

</style>
<div class="popup-wrapper hidden a012-popup-child popup-A014-save-share">
    <div class="layout-popup">
        <div class="popup-header">
            <div class="title"></div>
            <div class="close-side close-A014-save-share">
                <img class="close-icon" src="{{ asset('assets') }}/images/menu-icon/close.png" alt="close icon">
            </div>
        </div>
        <div class="popup-content">
            <div class="header-content not-remove">
                <button class="title-popup">保存・共有する</button>
                <button class="title-popup btn-success btn-list upload btn-eff-gre btn-hov" data-click="0" data-popup="A014">6か月目 <img
                        src="{{ asset('assets') }}/images/icon/upload.png" alt=""></button>
                <input type="file" class="hidden" name="a014_upload" id="a014_upload" upload-class="12">
                <table class="table-manager w-500px table-manager-class-0" data-class="0">
                    @foreach($reflectionSheetManagerData as $reflectionSheetManager)
                        @if($reflectionSheetManager->class == 0)
                            @include('components.sub_popup_A014.data_upload',['reflectionSheetManager' => $reflectionSheetManager])
                        @endif
                    @endforeach
                </table>

                <button class="title-popup btn-success btn-list upload btn-eff-gre btn-hov" data-click="1" data-popup="A014">12か月目<img
                        src="{{ asset('assets') }}/images/icon/upload.png" alt=""></button>
                {{--                <input type="file" class="hidden" name="a014_upload" id="a014_upload">--}}
                <table class="table-manager w-500px table-manager-class-1" data-class="1">
                    @foreach($reflectionSheetManagerData as $reflectionSheetManager)
                        @if($reflectionSheetManager->class == 1)
                            @include('components.sub_popup_A014.data_upload',['reflectionSheetManager' => $reflectionSheetManager])
                        @endif
                    @endforeach
                </table>

                <button class="title-popup btn-success btn-list upload btn-eff-gre btn-hov" data-popup="A014" data-click="2">随時<img
                        src="{{ asset('assets') }}/images/icon/upload.png" alt=""></button>
                {{--                <input type="file" class="hidden" name="a014_upload" id="a014_upload">--}}
                <table class="table-manager w-500px table-manager-class-2" data-class="2">
                    @foreach($reflectionSheetManagerData as $reflectionSheetManager)
                        @if($reflectionSheetManager->class == 2)
                            @include('components.sub_popup_A014.data_upload',['reflectionSheetManager' => $reflectionSheetManager])
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
        <div class="popup-footer">
            <button class="button-close close-A014-save-share btn-eff-bla btn-hov">戻る</button>
        </div>
    </div>
</div>
@include('components.sub_popup_A014.popup_confirm')
@push('js')
    <script>
        $('.close-A014-save-share').click(function () {
            $('.popup-a014').removeClass('hidden');
            $('.popup-A014-save-share').addClass('hidden');
        })
        $('.upload').click(function () {
            var data_click = $(this).attr('data-click');
            var data_popup = $(this).attr('data-popup');
            if (data_popup == 'A014') {
                $('#a014_upload').attr('upload-class', data_click)
                $('#a014_upload').trigger('click');

            }

        })
        $('#a014_upload').on('change', function () {
            var url = '{{ route("sakuraUpload") }}';
            var files = $(this)[0].files;
            var fd = new FormData();
            var upload_class = $(this).attr('upload-class');

            fd.append('file', files[0]);
            fd.append('class', upload_class);
            fd.append('type', 'reflectionsheet');
            $.ajax({
                url,
                data: fd,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        $('.table-manager-class-'+upload_class).append(response.html)
                    }
                },
                error: function (xhr) {
                    alert('error')
                }
            });
        })

        $('.popup-A014-save-share').on('click', '.share-reflectionsheet', function () {
            var id = $(this).data('id');
            var current_share = $(this).attr('data-current-share');
            var display_name = $(this).attr('data-display-name');
            var url = '{{route('updateShareReflectionSheet')}}';
            var reflection_class = $(this).closest('.table-manager').attr('data-class');
            var is_exist_share = false;
            $('.table-manager-class-' + reflection_class).find('.manager').each(function () {
                if ($(this).hasClass('sharing')) {
                    is_exist_share = true
                }
            });
            //Check exist file share
            if (current_share == 1) {
                //show popup 36
                var html = '振り返りシート（' + display_name + '）の共有を解除しますか？';
            } else {
                if (is_exist_share) {
                    //Show popup 44
                    var html = '振り返りシート（' + display_name + '）に共有を変更しますか？';
                } else {
                    //Show popup 32
                    var html = '振り返りシート（' + display_name + '）を共有しますか？';

                }
            }

            $('.popup-A014-confirm').find('input[name="id"]').val(id);
            $('.popup-A014-confirm').find('input[name="share_flg"]').val(current_share == 1 ? 0 : 1);
            $('.popup-A014-confirm').find('input[name="url"]').val(url);
            {{--            //if turn off share use last confirm--}}
            $('.popup-A014-confirm').find('input[name="last_confirm"]').val(current_share);
            {{--            // if exsits file share--}}
            $('.popup-A014-confirm').find('input[name="is_exist_share"]').val(is_exist_share ? 1 : 0);
            $('.popup-A014-confirm').find('input[name="is_remove"]').val(0);
            $('.popup-A014-confirm').find('input[name="reflection_class"]').val(reflection_class);
            $('.popup-A014-confirm').find('.header-content').html(html)
            $('.popup-A014-confirm').removeClass('hidden');
            $('.popup-A014-save-share').addClass('hidden');

        })

        $('.popup-A014-save-share').on('click','.remove',function (){
            var id = $(this).data('id');
            var display_name = $(this).attr('data-display-name');
            var url = '{{route('sakuraRemoveReflectionSheet')}}';
            var html = '振り返りシート（'+display_name+'）を削除します？';

            $('.popup-A014-confirm').find('input[name="id"]').val(id);
            $('.popup-A014-confirm').find('input[name="url"]').val(url);
            $('.popup-A014-confirm').find('input[name="is_remove"]').val(1);
            $('.popup-A014-confirm').find('.header-content').html(html)
            //Show popup 24
            $('.popup-A014-confirm').removeClass('hidden');
            $('.popup-A014-save-share').addClass('hidden');
        })

    </script>
@endpush
