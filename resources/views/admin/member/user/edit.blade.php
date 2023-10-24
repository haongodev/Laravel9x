@extends('admin.layouts.main', [
    'pageSlug' => '私の研鑽データ',
    ])

@push('styles')
    <link href="{{ asset('assets/admin/css/index.css') }}" rel="stylesheet"/>
@endpush
@section('content')
    <div class="breadcrumb-title">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <button class="btn-title btn-success">管理ユーザー編集</button>
            </div>
            <div class="col-sm-12 col-md-6 text-end">
                <button class="btn btn-white me-2 user-delete">削除</button>
            </div>
        </div>
    </div>
    <div class="container">
        <form action="{{route('admin.member.user.confirm',['user_id'=>$user->id])}}" method="POST" id="formEdit">
            <div class="row">
                @csrf
                <input type="hidden" name="id" value="{{$user->id}}">
                <table class="member">
                    <tr>
                        <th>ID</th>
                        <td colspan="2"><input class="form-control" type="text" name="login_id"
                                               value="{{$user->login_id}}"></td>
                    </tr>
                    <tr>
                        <th>氏名</th>
                        <td colspan="2"><input class="form-control" type="text" name="name" value="{{$user->name}}">
                        </td>
                    </tr>
                    <tr>
                        <th>属性</th>
                        <td colspan="2">
                            <select name="attribute" id="" class="form-select">
                                @foreach(config('constants.userAttribute') as $key => $value)
                                    <option
                                        {{$user->attribute == $key ? 'selected' : ''}} value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>管理者区分</th>
                        <td colspan="2">
                            <select name="manager_class" id="" class="form-select w-50">
                                @foreach(config('constants.userManagerClass') as $key => $value)
                                    <option
                                        {{$user->manager_class == $key ? 'selected' : ''}}  value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>パスワード</th>
                        <td colspan="2"><input type="password" class="form-control w-50" name="password"
                                               value="{{config('constants.passwordDefault')}}"></td>
                    </tr>
                    <tr>
                        <th>パスワード（確認）</th>
                        <td colspan="2"><input type="password" class="form-control w-50" name="password_confirm"
                                               value="{{config('constants.passwordDefault')}}"></td>
                    </tr>
                </table>

                <div class="d-grid gap-2 col-2 mx-auto mt-3">
                    <button class="btn btn-white submit" type="submit">確認</button>
                </div>

                <div class="table-footer row mt-3">
                    <div class="col-sm-12 col-md-2">
                        <div class="row">
                            <button class="btn btn-white" type="button"
                                    onclick="window.location.href='{{route('admin.member.user.detail',['user_id'=>$user->id])}}'">
                                戻る
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('admin.components.delete_manager_user_popup')
@endsection
@push('js')
    <script>
        $('.submit').click(function () {
            var form = $(this).closest('form');
            var password = form.find('input[name="password"]').val()
            var password_confirm = form.find('input[name="password_confirm"]').val();
            if (password != password_confirm) {
                toastr.options.timeOut = 3000;
                toastr.info('パスワードとパスワード（確認用）が異なっています。')
                return false;
            } else if (password == '' && password_confirm == '') {
                toastr.options.timeOut = 3000;
                toastr.info('パスワードを入力して下さい')
                return false;
            }
            form.submit();
        })
        $('.user-delete').click(function () {
            var name = $('input[name="name"]').val();
            $('#deleteUserModal').find('.content').html('管理ユーザー：' + name + '　を削除しますか？')
            $('#deleteUserModal').find('.delete-confirm').removeClass('d-none');
            $('#deleteUserModal').find('.delete-submit').addClass('d-none');
            var myModal = new bootstrap.Modal(document.getElementById('deleteUserModal'))
            myModal.show();
        })
    </script>
@endpush
