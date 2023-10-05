@extends('admin.layouts.main', [
    'pageSlug' => '私の研鑽データ',
    'button_operation_manual' => true
    ])

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
