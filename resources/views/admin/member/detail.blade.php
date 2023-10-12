@extends('admin.layouts.main', [
    'pageSlug' => '私の研鑽データ',
    'button_operation_manual' => true
    ])

@push('styles')
    <link href="{{ asset('assets/admin/css/index.css') }}" rel="stylesheet"/>
@endpush
@section('content')
    <div class="breadcrumb-title">
        <button class="btn-title btn-success">構成員詳細</button>
        <span class="ms-3 text-primary">アップロードファイル一覧　＞</span>
    </div>
    <div class="container">
        <div class="row">
            <table class="member">
                <tr>
                    <th>構成員ID</th>
                    <td colspan="2">{{$member->login_id}}</td>
                </tr>
                <tr>
                    <th>氏名</th>
                    <td colspan="2">{{$member->name1}} {{$member->name2}} {{$member->kana1}} {{$member->kana2}}</td>
                </tr>
                <tr>
                    <th>会員種別・状況</th>
                    <td colspan="2">{{$member->membership_type}}</td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td colspan="2">{{$member->email}}</td>
                </tr>
                <tr>
                    <th>都道府県支部</th>
                    <td colspan="2">{{$member->prefectural_chapters}}</td>
                </tr>
                <tr>
                    <th>認定SVR登録-登録あり</th>
                    <td colspan="2">{{$member->certified_svr_registration}}</td>
                </tr>
                <tr>
                    <th>クローバー登録-登録あり</th>
                    <td colspan="2">{{$member->clover_registration}}</td>
                </tr>
                <tr>
                    <th>基幹研修修了状況</th>
                    <td colspan="2">{{$member->core_training_status}}</td>
                </tr>
                <tr>
                    <th>基幹研修修了年度</th>
                    <td colspan="2">{{$member->core_training_year}}</td>
                </tr>
                <tr>
                    <th>認定年度</th>
                    <td colspan="2">{{$member->certification_year}}</td>
                </tr>
                <tr>
                    <th>認定番号</th>
                    <td colspan="2">{{$member->certification_number}}</td>
                </tr>
                <tr>
                    <th>研修認定・認定状況</th>
                    <td colspan="2">{{$member->training_accreditation_certification_status}}</td>
                </tr>
                <tr>
                    <th>更新研修受講予定年度</th>
                    <td colspan="2">{{$member->training_accreditation_certification_year}}</td>
                </tr>
                <tr>
                    <th>更新研修受講延長状況</th>
                    <td colspan="2">{{$member->renewal_training_course_extension_status}}</td>
                </tr>
                <tr>
                    <th>更新研修受講延長年度</th>
                    <td colspan="2">{{$member->renewal_training_course_extension_year}}</td>
                </tr>
                <tr>
                    <th>入会承認日</th>
                    <td colspan="2">{{$member->approval_date ? date('Y年 m月 d日', strtotime($member->approval_date)) : ''}}</td>
                </tr>
                <tr>
                    <th>合理的配慮</th>
                    <td colspan="2">{{$member->reasonable_accommodation}}</td>
                </tr>
                <tr>
                    <th>休会開始年度</th>
                    <td colspan="2">{{$member->absence_year}}</td>
                </tr>
                <tr>
                    <th>復会予定年度</th>
                    <td colspan="2">{{$member->scheduled_reinstatement_year}}</td>
                </tr>
                <tr>
                    <th>復会年度</th>
                    <td colspan="2">{{$member->reinstatement_year}}</td>
                </tr>
            </table>
            <div class="table-footer row mt-3">
                <div class="col-sm-12 col-md-2">
                    <div class="row">
                        <button class="btn btn-white" onclick="window.location.href='{{route('admin.index')}}'">戻る</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
