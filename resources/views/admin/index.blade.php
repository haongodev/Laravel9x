@extends('admin.layouts.main', [
    'pageSlug' => '私の研鑽データ',
    'button_operation_manual' => true
    ])

@push('styles')
    <link href="{{ asset('assets/admin/css/index.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div class="bread-crumb">
        <ol class="breadcrumb">
            <div class="breadcrumb-title">
                <button class="btn-title">構成員一覧</button>
            </div>
            <div class="form-search">
                <form action="" method="GET" id="formSearch">

                    <div class="row">
                        <div class="w-100 group-control">
                            <label for="email" class="w-25">構成員ID</label>
                            <div class="w-75">
                                <input class="count-length" type="text" name="login_id"
                                       placeholder=""
                                       value="{{request('login_id')}}"/>
                            </div>
                        </div>
                        <div class="w-100 group-control">
                            <label for="email" class="w-25">氏名</label>
                            <div class="w-75">
                                <input class="count-length" type="text" name="name"
                                       placeholder=""
                                       value="{{request('name')}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="w-50 group-control">
                            <label for="email" class="w-25">会員種別</label>
{{--                            <div class="w-75">--}}
                                <select class="w-75" name="membership_type" id="membership_type">
                                    <option value=""></option>
                                    @foreach(config('constants.membershipType') as $key => $value)
                                        <option value="{{$value}}" {{request('membership_type')==$value ? 'selected' : ''}}>{{$value}}</option>
                                    @endforeach
                                </select>
{{--                            </div>--}}
                        </div>
                    </div>

                    <div class="action button-search">
                        <button type="submit" class="decline-btn">検索</button>
                    </div>
                </form>
            </div>

        </ol>
    </div>
    <div class="container">
        <div class="row">
            <table class="">
                <tr>
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
                    <tr>
                        <td>{{($page-1)*15 + $i}}</td>
                        <td>{{$member->login_id}}</td>
                        <td>{{$member->name1}} {{$member->name2}}</td>
                        <td>{{$member->telephone_number}}</td>
                        <td>{{$member->publicationed_at}}</td>
                    </tr>
                @endforeach
            </table>
            {{ $memberData->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
@push('js')
@endpush
