@extends('layouts.web.main',
    [
        'pageSlug' => 'らセットに取り組む',
        'header_button' => '<button type="button" class="header-buttom btn-eff-yel btn-hov" style="background:#FFFF00;color:#000;">さくらセットについて</button>',
        'sidebarInclude' => view('components.sakuraSet_sideBar',['sakuraReviewManage'=>$sakuraReviewManage])
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
                        @if($sakuraMemberManage && $sakuraMemberManage->reviewer_member !== null && $sakuraMemberManage->reviewer_status !== 1)
                            <button class="in-active">担当者</button>
                        @else
                            <a href="{{ route('registerReviewer') }}"><button class="active">担当者</button></a>
                        @endif
                    </li>
                    <li>
                        @if($sakuraMemberManage !== null && $sakuraMemberManage->reviewer_member !== null)
                            {{ $sakuraMemberManage->reviewer_member->name1.' '.$sakuraMemberManage->reviewer_member->name2 }}
                        @else
                            未申請
                        @endif
                    </li>
                </ul>
            </div>
            <div class="pull-right">
                @if($sakuraMemberManage)
                    @if($sakuraMemberManage->reviewer_member !== null && ($sakuraMemberManage->reviewer_status !== 3))
                        @if($sakuraMemberManage->reviewer_status === 1)
                        <button class="btn-eff-red btn-hov">申請中</button>
                        @else
                        <button class="cancal-sharing btn-eff-red btn-hov" data-id="{{ $sakuraMemberManage->reviewer_member->login_id}}">共有解除</button>
                        @endif
                    @else
                        <button class="had-change btn-eff-ora btn-hov">解除依頼中</button>
                    @endif
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
@push('js')
    <script>
        var num_of_visit = '{{ $num_of_visit }}';
        console.log(num_of_visit);
        if(num_of_visit == 1 && $('.side-bot .row li').hasClass('active')){
            var url = '{{ route("sakuraUnCheckMark") }}';
            $.ajax({
                url,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                success: function(response) {
                    if(response.success){
                        $('.side-bot .row li').removeClass('active');
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
       
    </script>
@endpush
