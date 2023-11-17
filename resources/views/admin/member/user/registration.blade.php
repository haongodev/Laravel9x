@extends('admin.layouts.main', [
    'pageSlug' => '管理ユーザー詳細',
    ])

@push('styles')
    <link href="{{ asset('assets/admin/css/index.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div class="breadcrumb-title">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <button class="btn-title btn-success">管理ユーザー詳細</button>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <form class="formRegister form" action="{{ route('admin.member.user.confirm_create') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>ID</label>
                    <input type="text" maxlength="10" class="w-full" name="login_id" value="{{$old->login_id ?? ''}}">
                </div>
                <div class="form-group">
                    <label>氏名</label>
                    <input type="text" maxlength="200" class="w-full" name="name" value="{{$old->name ?? ''}}">
                </div>
                <div class="form-group">
                    <label>属性</label>
                    <select name="attribute" class="w-full">
                        <option value=""></option>
                        <option {{$old->attribute == 0 ? 'selected' : ''}} value="0">事務局</option>
                        <option {{$old->attribute == 1 ? 'selected' : ''}} value="1">研修委員</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>管理者区分</label>
                    <select name="manager_class" class="w-full">
                        <option {{$old->manager_class == 0 ? 'selected' : ''}} value="0">権限 1</option>
                        <option {{$old->manager_class == 1 ? 'selected' : ''}} value="1">権限 2</option>
                        <option {{$old->manager_class == 2 ? 'selected' : ''}} value="2">権限 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>パスワード</label>
                    <input type="password" class="password" name="password">
                </div>
                <div class="form-group">
                    <label>パスワード（確認）</label>
                    <input type="password" class="password_confirm" name="password_confirm">
                </div>
                <div class="form-group align-center mt-4">
                    <button type="submit" class="button-submit">確認</button>
                </div>
            </form>
        </div>
        <button type="button" class="button-back">戻る</button>
    </div>
@endsection

@push('js')
    <script>
        $(".formRegister").submit(function (e) { 
            var password = $('.password').val();
            var password_confirm = $('.password_confirm').val();
            var state = true;
            if(password !== password_confirm){
                e.preventDefault();
                toastr.options.timeOut = 3000;
                toastr.info('パスワードとパスワード（確認用）が異なっています。')
                state = false;
            }else if(password == '' && password_confirm == ''){
                e.preventDefault();
                toastr.options.timeOut = 3000;
                toastr.info('パスワードを入力して下さい')
                state = false;
            }
        });
    </script>
@endpush
