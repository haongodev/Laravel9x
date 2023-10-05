@extends('admin.layouts.main', [
    'pageSlug' => '私の研鑽データ',
    'button_operation_manual' => true
    ])

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
                                <input class="count-length" type="text" name="aaa"
                                       placeholder=""
                                       value="{{$answerData->answer ?? ''}}"/>
                            </div>
                        </div>
                        <div class="w-100 group-control">
                            <label for="email" class="w-25">構成員ID</label>
                            <div class="w-75">
                                <input class="count-length" type="text" name="aaa"
                                       placeholder=""
                                       value="{{$answerData->answer ?? ''}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="w-50 group-control">
                            <label for="email" class="w-25">構成員ID</label>
                            <div class="w-75">
                                <input class="count-length" type="text" name="aaa"
                                       placeholder=""
                                       value="{{$answerData->answer ?? ''}}"/>
                            </div>
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
{{--            @if($guidanceData)--}}
                ahihihihihii
{{--                @if($guidanceData->sentence_class)--}}
{{--                    {!! $guidanceData->guidance !!}--}}
{{--                @else--}}
{{--                    {{$guidanceData->guidance}}--}}
{{--                @endif--}}
{{--            @endif--}}
        </div>
    </div>
@endsection
@push('js')
@endpush
