@extends('layouts.web.main', ['pageSlug' => 'myPage.myPage'])

@section('content')
    {{ Breadcrumbs::render('mypage') }}
    <div class="container">
        <div class="row">
            this is my page
        </div>
    </div>
@endsection
@push('js')
@endpush
