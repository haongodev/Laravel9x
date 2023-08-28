<div class="popup-wrapper hidden a015-popup-child popup-A015-save-share">
    <div class="layout-popup">
        <div class="popup-header">
            <div class="title"></div>
            <div class="close-side close-A015-save-share">
                <img class="close-icon" src="{{ asset('assets') }}/images/menu-icon/close.png" alt="close icon">
            </div>
        </div>
        <div class="popup-content">
            <div class="header-content not-remove">
                <button class="title-popup">保存・共有する <img src="{{ asset('assets') }}/images/icon/upload.png" class="upload" data-popup="A015" alt=""></button>
                <input type="file" class="hidden" name="a013_upload" id="a015_upload">
                <div class="a015-initive-list">
                    @foreach($initiativetableManagerData as $initiativetableData)
                        @include('components.sub_popup_A015.data_upload',['initiativetableManager' => $initiativetableData])
                    @endforeach
                </div>
            </div>
        </div>
        <div class="popup-footer">
            <button class="button-close close-A015-save-share btn-eff-bla btn-hov">戻る</button>
        </div>
    </div>
</div>
@include('components.sub_popup_A015.popup_confirm')
@push('js')
    <script>
        $('.close-A015-save-share').click(function () {
            $('.popup-a015').removeClass('hidden');
            $('.popup-A015-save-share').addClass('hidden');
        })
        $('.upload').click(function () {
            var data_popup = $(this).attr('data-popup');
            if (data_popup == 'A015') {
                $('#a015_upload').trigger('click');
            }

        })
        $('#a015_upload').on('change', function () {
            var url = '{{ route("sakuraUpload") }}';
            var files = $(this)[0].files;
            var fd = new FormData();

            fd.append('file', files[0]);
            fd.append('type', 'initiative');
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
                        $('.a015-initive-list').append(response.html);
                    }
                },
                error: function (xhr) {
                    alert('error')
                }
            });
        })

        $('.popup-A015-save-share').on('click', '.share-initiativetable', function () {
            var id = $(this).data('id');
            var current_share = $(this).attr('data-current-share');
            var display_name = $(this).attr('data-display-name');
            var url = '{{route('updateShareInitiativeTable')}}';
            //Check exist file share
            if (current_share == 1) {
                //show popup 25
                var html = 'さくらセット取り組み表（' + display_name + '）の共有を解除しますか？';
            } else {
                if (isExistsShare()) {
                    //Show popup 33
                    var html = 'さくらセット取り組み表（' + display_name + '）に共有を変更しますか？';
                } else {
                    //Show popup 21
                    var html = 'さくらセット取り組み表（' + display_name + '）を共有しますか？';
                }
            }

            $('.popup-A015-confirm').find('input[name="id"]').val(id);
            $('.popup-A015-confirm').find('input[name="share_flg"]').val(current_share == 1 ? 0 : 1);
            $('.popup-A015-confirm').find('input[name="url"]').val(url);
            //if turn off share use last confirm
            $('.popup-A015-confirm').find('input[name="last_confirm"]').val(current_share);
            // if exsits file share
            $('.popup-A015-confirm').find('input[name="is_remove"]').val(0);
            $('.popup-A015-confirm').find('input[name="is_exist_share"]').val(isExistsShare() ? 1 : 0);
            $('.popup-A015-confirm').find('.header-content').html(html)
            $('.popup-A015-confirm').removeClass('hidden');
            $('.popup-A015-save-share').addClass('hidden');
        })

        $('.popup-A015-save-share').on('click','.remove',function (){
            var id = $(this).data('id');
            var display_name = $(this).attr('data-display-name');
            var url = '{{route('sakuraRemoveInitiativeTable')}}';
            var html = 'さくらセット取り組み表（'+display_name+'）を削除しますか？';

            $('.popup-A015-confirm').find('input[name="id"]').val(id);
            $('.popup-A015-confirm').find('input[name="url"]').val(url);
            $('.popup-A015-confirm').find('input[name="is_remove"]').val(1);
            $('.popup-A015-confirm').find('.header-content').html(html)
            //Show popup 24
            $('.popup-A015-confirm').removeClass('hidden');
            $('.popup-A015-save-share').addClass('hidden');
        })

        function isExistsShare() {
            var isShare = false;
            $('.a015-initive-list').children('div').each(function () {
                if ($(this).children('button').hasClass('sharing')) {
                    isShare = true;
                }
            });
            return isShare;
        }
    </script>
@endpush
