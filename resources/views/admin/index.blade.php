@extends('admin.layouts.main', [
    'pageSlug' => '私の研鑽データ',
    ])

@push('styles')
    <link href="{{ asset('assets/admin/css/index.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div class="breadcrumb-title">
        <button class="btn-title btn-success" style="cursor: unset">構成員一覧</button>
        <div><button class="btn-title btn-pinkin" style="cursor: unset">利用率</button> {{ $percentUse }}％</div>
    </div>
    <div class="bread-crumb">
        <div class="container">
            <form class="row m-3" action="" method="GET" id="formSearch">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="row">
                            <label for="login_id" class="col-sm-3 col-md-3 col-form-label">構成員ID</label>
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
                            <label for="membership_type" class="col-sm-3 col-md-3 col-form-label">会員種別</label>
                            <div class="col-sm-9 col-md-9">
                                <select name="membership_type" id="membership_type" class="form-select">
                                    <option value=""></option>
                                    @foreach(config('constants.membershipType') as $key => $value)
                                        <option value="{{$value}}" {{request('membership_type')==$value ? 'selected' : ''}}>{{$value}}</option>
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
                    <th>構成員ID</th>
                    <th>氏名</th>
                    <th>会員種別</th>
                    <th>メールアドレス</th>
                </tr>
                @php $i=0; @endphp
                @foreach($memberData as $member)
                    @php
                        $i++;
                        $page = request('page',1);
                    @endphp
                    <tr class="text-center">
                        <td><a href="{{route('admin.member.detail',['login_id'=>$member->login_id])}}">{{($page-1)*15 + $i}}</a></td>
                        <td><a href="{{route('admin.member.detail',['login_id'=>$member->login_id])}}">{{$member->login_id}}</a></td>
                        <td><a href="{{route('admin.member.detail',['login_id'=>$member->login_id])}}">{{$member->name1}} {{$member->name2}}</a></td>
                        <td>{{$member->membership_type}}</td>
                        <td>{{$member->email}}</td>
                    </tr>
                @endforeach
            </table>
            <div class="table-footer row mt-3">
                <div class="col-sm-12 col-md-6 offset-md-3">
                    <div class="pagination">
                        {{ $memberData->appends(request()->query())->links('admin.layouts.paging') }}
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="button">
                        <button>CSVアップロード</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

