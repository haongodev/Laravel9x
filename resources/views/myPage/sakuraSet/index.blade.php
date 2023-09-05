@extends('layouts.web.main',
    [
        'pageSlug' => 'らセットに取り組む',
        'header_button' => '<button type="button" class="header-buttom btn-eff-yel btn-hov" style="background:#FFFF00;color:#000;">さくらセットについて</button>',
        'sidebarInclude' => view('components.sakuraSet_sideBar',['sakuraManage'=>$sakuraManage])
    ])
@push('styles')
    <link href="{{ asset('assets') }}/css/sakuraSet.css" rel="stylesheet" />
@endpush
@section('content')
    {{ Breadcrumbs::render('sakuraSet') }}
    <div class="container sakura-set">
        @foreach($guidance as $guidanceData)
            <div class="top-contain without">
                @if($guidanceData->sentence_class === 1)
                    {!! $guidanceData->guidance !!}
                @else
                    {{ $guidanceData->guidance }}
                @endif
            </div>
        @endforeach
        <div class="button-list">
            <button type="button" class="btn-eff-ora btn-hov"><a href="https://www.jamhsw.or.jp/ugoki/kensyu/sakura-set.html" target="_blank">さくらセットを理解する</a></button>
            <button type="button" class="btn-eff-ora btn-hov"><a href="{{ route('yourTry') }}">あなたの取り組み状況</a></button>
            <button type="button" class="btn btn-eff-ora btn-hov"><a href="{{ route('registerReviewer') }}">振返り担当者の申請</a></button>
        </div>
        <div class="botton-navigate">
            <div class="pull-left">
                <ul>
                    <li>
                        @if($sakuraManage !== null)
                        <button class="{{ $sakuraManage->reviewer_member !== null ? 'in-active btn-eff-bla btn-hov' : 'active btn-eff-pri btn-hov' }}">担当者</button>
                        @endif
                    </li>
                    <li>
                        @if(!$sakuraManage || $sakuraManage->reviewer_member === null)
                            未申請
                        @else
                            {{ $sakuraManage->reviewer_member->name1.' '.$sakuraManage->reviewer_member->name2 }}
                        @endif
                    </li>
                </ul>
            </div>
            <div class="pull-right">
                @if($sakuraManage && $sakuraManage->reviewer_member !== null)
                    <button class="cancal-sharing {{ $sakuraManage->reviewer_status === 3 ? 'had-change btn-eff-ora btn-hov' : 'btn-eff-red btn-hov'}}"> {{ $sakuraManage->reviewer_status === 3 ? '解除依頼中' : '共有解除'}}</button>
                @endif
            </div>
        </div>
        @foreach($guidance as $guidanceData)
            <div class="bottom-contain without">
                @if($guidanceData->sentence_class === 1)
                    {!! $guidanceData->guidance !!}
                @else
                    {{ $guidanceData->guidance }}
                @endif
            </div>
        @endforeach
    </div>
@endsection
@include('components.sakuraScript')
