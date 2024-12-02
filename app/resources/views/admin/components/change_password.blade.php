<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="changePassModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-center m-auto fw-bold">パスワード変更</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-center">
                                <div class="success d-none">
                                    <p class="message">パスワードを変更しました。</p>
                                    <div class="row">
                                        <div class="col-sm-6 offset-sm-3 col-md-6 offset-md-3 mt-3 button-close">
                                            <button type="button" class="btn btn-white w-75"
                                                    data-bs-dismiss="modal" aria-hidden="true">OK</button>
                                        </div>
                                    </div>
                                </div>

                                <form class="row m-3" action="" method="GET" id="formChangePass">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="row">
                                                <label for="password"
                                                       class="col-sm-5 col-md-5 col-form-label">パスワード</label>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="password" class="form-control" id="password"
                                                           name="password" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 mt-3">
                                            <div class="row">
                                                <label for="password_confirm" class="col-sm-5 col-md-5 col-form-label">パスワード（確認）</label>
                                                <div class="col-sm-7 col-md-7">
                                                    <input type="password" class="form-control" id="password_confirm"
                                                           name="password_confirm" >
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 offset-sm-6 col-md-5 offset-md-6 mt-3">
                                            <button type="button" class="btn btn-white w-100 submit">パスワード変更</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>

        $('#changePassModal').on('hidden.bs.modal', function(){
            $('#formChangePass').find('input').val('');
            $('#formChangePass').show();
            $('#changePassModal').find('.success').addClass('d-none');
        })

        $('#formChangePass').find('.submit').click(function (){
            var password = $('#password').val();
            var password_confirm = $('#password_confirm').val();

            if(password !== password_confirm){
                toastr.options.timeOut = 3000;
                toastr.info('単位登録を実行しました。')
                return false;
            }else if(password == '' && password_confirm == ''){
                toastr.options.timeOut = 3000;
                toastr.info('パスワードを入力して下さい')
                return false;
            }

            $.ajax({
                url: '{{ route("admin.change.password") }}',
                data: {
                    password: password,
                    password_confirm: password_confirm
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                success: function(response) {
                    if(response.success){
                        if(response.message){
                            toastr.options.timeOut = 3000;
                            toastr.info(response.message)
                        }else{
                            $('#formChangePass').hide();
                            $('#changePassModal').find('.success').removeClass('d-none');
                        }
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        })
    </script>
@endpush
