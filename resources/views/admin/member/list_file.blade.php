@extends('admin.layouts.main', [
    'pageSlug' => '私の研鑽データ',
    'button_operation_manual' => true
    ])

@push('styles')
    <link href="{{ asset('assets/admin/css/index.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <div class="breadcrumb-title">
        <button class="btn-title btn-success">構成員氏名</button>
        <span class="ms-3">{{$member->name1}} {{$member->name2}}</span>
    </div>
    <div class="container">
        <div class="row">
            <table class="">
                <tr class="text-center">
                    <th>No</th>
                    <th>種別</th>
                    <th>ファイル名</th>
                    <th>アップロード日</th>
                    <th>DL</th>
                </tr>
                @php $i=0; @endphp
                @foreach($fileUploadData as $fileUpload)
                    @php
                        $i++;
                        $page = request('page',1);
                    @endphp
                    <tr class="text-center">
                        <td>{{($page-1)*15 + $i}}</td>
                        <td>1</td>
                        <td>{{$fileUpload->file_name}}</td>
                        <td>{{$fileUpload->update_date ? date('Y年m月d日', strtotime($fileUpload->update_date)) : ''}}</td>
                        <td><a download class="download" href="{{config('constants.path_upload').'/'.$fileUpload->member_id.'/facesheet/'.$fileUpload->file_name}}"><img src="{{ asset('assets/images/icon/download.png') }}" alt=""></a></td>
                    </tr>
                @endforeach
            </table>
            <div class="table-footer row mt-3">
                <div class="col-sm-12 col-md-2">
                    <div class="row">
                        <button class="btn btn-white" onclick="window.location.href='{{route('admin.member.detail',['login_id'=>$member->login_id])}}'">戻る</button>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 offset-md-3">
                    <div class="pagination">
                        {{ $fileUploadData->appends(request()->query())->links('admin.layouts.paging') }}
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

