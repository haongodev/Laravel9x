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
                <button class="btn-title btn-success">管理ユーザー詳細</button>
            </div>
            <div class="col-sm-12 col-md-6 text-end">
                <button class="btn btn-white me-2"
                        onclick="window.location.href='{{route('admin.member.user.edit',['user_id'=>$user->id])}}'">編集
                </button>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <table class="member">
                <tr>
                    <th>ID</th>
                    <td colspan="2">{{$user->login_id}}</td>
                </tr>
                <tr>
                    <th>氏名</th>
                    <td colspan="2">{{$user->name}}</td>
                </tr>
                <tr>
                    <th>属性</th>
                    <td colspan="2">{{config('constants.userAttribute')[$user->attribute] ?? ''}}</td>
                </tr>
                <tr>
                    <th>管理者区分</th>
                    <td colspan="2">{{config('constants.userManagerClass')[$user->manager_class] ?? ''}}</td>
                </tr>
            </table>
            <div class="table-footer row mt-3">
                <div class="col-sm-12 col-md-2">
                    <div class="row">
                        <button class="btn btn-white"
                                onclick="window.location.href='{{route('admin.member.user.manage')}}'">戻る
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
