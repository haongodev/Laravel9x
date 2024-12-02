@extends('layouts.web.main',
    [
        'pageSlug' => 'らセットに取り組む',
        'header_button' => '<a href="https://www.jamhsw.or.jp/ugoki/kensyu/sakura-set.html" target="_blank"><button type="button" class="header-buttom btn-eff-yel btn-hov" style="background:#FFFF00;color:#000;">さくらセットについて</button></a>',
        'sidebarInclude' => view('components.sakuraSet_sideBar',['sakuraReviewManage'=>$sakuraReviewManage])
    ])
@push('styles')
<link href="{{ asset('assets') }}/css/sakuraSet.css" rel="stylesheet" />
@endpush
@section('content')
    {{ Breadcrumbs::render('registerReviewer') }}
    <div class="container registerReviewerForm">
        <form action="{{ route('searchMemberToReview') }}">
            <span class="form-title">振り返り担当者検索</span>
            <div class="form-group">
                <span>構成員番号</span>
                <input type="text" name="login_id" required class="login_id" placeholder="（完全一致）"/>
            </div>
            <div class="form-group">
                <span>姓</span>
                <input type="text" name="last_name" required class="last_name" placeholder="（完全一致）"/>
            </div>
            <div class="form-group">
                <span>名</span>
                <input type="text" name="first_name" required class="first_name" placeholder="（完全一致）"/>
            </div>
            <button type="submit" class="btn-eff-ora btn-hov action {{ $sakuraMemberManage !== null && $sakuraMemberManage->reviewer_id ? 'disabled' : '' }}">検索</button>
        </form>
    </div>
    <div class="resultReviewerInfo">
        <span class="result-title">検索結果</span>
        <input type="text" name="result" class="result_search" placeholder="（検索結果を表示）"/>
        <button type="button" class="btn-eff-ora btn-hov apply disabled">申請</button>
    </div>
@endsection
@include('components.sakuraScript')
