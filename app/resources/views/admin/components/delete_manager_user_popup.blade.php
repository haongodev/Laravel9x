<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-center m-auto fw-bold"></h5>
                <button type="button" class="close btn-redirect" data-bs-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-center">
                                <p class="content">管理ユーザー：XXXXXX　XXXX　を変更しました。</p>
                                <div class="d-grid gap-2 d-md-block">
                                    <button class="btn btn-white delete-confirm" type="button">はい</button>
                                    <button class="btn btn-white delete-submit d-none btn-redirect" type="button">はい
                                    </button>
                                    <button class="btn btn-white btn-cancel ms-2" data-bs-dismiss="modal" type="button">
                                        いいえ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('sub_js')
    <script>
        $('.delete-confirm').click(function () {
            $('#deleteUserModal').find('.content').html('本当に削除してもよろしいでしすか？')
            $('#deleteUserModal').find('.delete-confirm').addClass('d-none');
            $('#deleteUserModal').find('.delete-submit').removeClass('d-none');
        });

        $('.delete-submit').click(function () {
            var name = $('input[name="name"]').val();
            var id = $('input[name="id"]').val();
            $.ajax({
                type: "post",
                url: '{{route('admin.member.user.delete')}}',
                cache: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {user_id: id},
                success: function (data) {
                    if (data.success) {
                        $('#deleteUserModal').find('.content').html('管理ユーザー：' + name + '　を削除しました。')
                        $('#deleteUserModal').find('.delete-submit').html('はい');
                        $('#deleteUserModal').find('.delete-submit').removeClass('delete-submit');
                        $('#deleteUserModal').find('.btn-cancel').addClass('d-none');
                        $('#deleteUserModal').find('.btn-redirect').addClass('redirect-M005');
                    }
                },
            });

        });

        $('#deleteUserModal').on('click', '.redirect-M005', function (e) {
            window.location.href = '{{route('admin.member.user.manage')}}'
        })
    </script>
@endpush
