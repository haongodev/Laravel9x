@extends('admin.layouts.main', [
    'pageSlug' => '私の研鑽データ',
    ])

@push('styles')
    <link href="{{ asset('assets/admin/css/index.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div class="breadcrumb-title">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <button class="btn-title btn-success">管理ユーザー一覧</button>
            </div>
            <div class="col-sm-12 col-md-6 text-end">
                <button class="btn btn-white me-2" onclick="window.location.href='/M009'">登録</button>
            </div>
        </div>
    </div>
    <div class="bread-crumb">
        <div class="container">
            <form class="row m-3" action="" method="GET" id="formSearch">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="row">
                            <label for="login_id" class="col-sm-3 col-md-3 col-form-label">ユーザーID</label>
                            <div class="col-sm-9 col-md-9">
                                <input type="text" class="form-control" id="login_id" name="login_id" value="{{request('login_id')}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="row">
                            <label for="name" class="col-sm-3 col-md-3 col-form-label">氏名</label>
                            <div class="col-sm-9 col-md-9">
                                <input type="text" class="form-control" name="name" id="name" value="{{request('name')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 mt-3">
                        <div class="row">
                            <label for="attribute" class="col-sm-3 col-md-3 col-form-label">属性</label>
                            <div class="col-sm-9 col-md-9">
                                <select name="attribute" id="attribute" class="form-select">
                                    <option value="-1"></option>
                                    @foreach(config('constants.userAttribute') as $key => $value)
                                        <option value="{{$key}}" {{request('attribute',-1)==$key ? 'selected' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-6 offset-sm-6 col-md-3 offset-md-9 mt-3">
                        <button type="submit" class="btn btn-success w-100">検索</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <table class="">
                <tr class="text-center">
                    <th>No</th>
                    <th>ユーザーID</th>
                    <th>氏名</th>
                    <th>属性</th>
                    <th>管理者区分</th>
                </tr>
                @php $i=0; @endphp
                @foreach($userData as $user)
                    @php
                        $i++;
                        $page = request('page',1);
                    @endphp
                    <tr class="text-center">
                        <td><a href="{{route('admin.member.user.detail',['login_id'=>$user->login_id])}}">{{($page-1)*15 + $i}}</a></td>
                        <td><a href="{{route('admin.member.user.detail',['login_id'=>$user->login_id])}}">{{$user->login_id}}</a></td>
                        <td><a href="{{route('admin.member.user.detail',['login_id'=>$user->login_id])}}">{{$user->name}}</a></td>
                        <td>{{config('constants.userAttribute')[$user->attribute] ?? ''}}</td>
                        <td>{{config('constants.userManagerClass')[$user->manager_class] ?? ''}}</td>
                    </tr>
                @endforeach
            </table>
            <div class="table-footer row mt-3">
                <div class="col-sm-12 col-md-6 offset-md-3">
                    <div class="pagination">
                        {{ $userData->appends(request()->query())->links('admin.layouts.paging') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

