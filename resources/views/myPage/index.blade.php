@extends('layouts.web.main', ['pageSlug' => 'myPage.myPage'])

@section('content')
    {{ Breadcrumbs::render('mypage') }}
    <div class="container">
        <div class="row">
            @if($guidanceData)
                @if($guidanceData->sentence_class)
                    {!! $guidanceData->guidance !!}
                @else
                    {{$guidanceData->guidance}}
                @endif
            @endif
        </div>
    </div>
@endsection
@push('js')
@endpush
