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
            <form class="form" action="{{ route('admin.member.user.postRegister') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>ID</label>
                    <input type="number" maxlength="10" class="w-full" name="id">
                </div>
                <div class="form-group">
                    <label>氏名</label>
                    <input type="text" maxlength="200" class="w-full" name="name">
                </div>
                <div class="form-group">
                    <label>属性</label>
                    <select name="attribute" class="w-full">
                        <option value=""></option>
                        <option value="0">事務局</option>
                        <option value="1">研修委員</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>管理者区分</label>
                    <select name="manager_class">
                        <option value="0">権限 1</option>
                        <option value="1">権限 2</option>
                        <option value="2">権限 3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>パスワード</label>
                    <input type="password" name="password">
                </div>
                <div class="form-group">
                    <label>パスワード（確認）</label>
                    <input type="password" name="password_confirm">
                </div>
                <div class="form-group align-center mt-4">
                    <button type="submit" class="button-submit">確認</button>
                </div>
            </form>
        </div>
        <button type="button" class="button-back">戻る</button>
    </div>
@endsection

