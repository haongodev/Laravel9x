@extends('layouts.web.main', ['pageSlug' => '選択した類型'])
@push('styles')
    <link href="{{ asset('assets') }}/css/registry.css" rel="stylesheet"/>
@endpush
@section('content')
    {{ Breadcrumbs::render('typeSelected') }}
    <div class="container">
        <div class="contain1">
            @if(!empty($guidanceData[1]))
                @if($guidanceData[1]->sentence_class)
                    {!! $guidanceData[1]->guidance !!}
                @else
                    {!! $guidanceData[1]->guidance !!}
                @endif
            @endif
        </div>
        <div class="form-registry">
            <form action="{{route('searchTypeSelected')}}" method="post" id="formTypeSelected">
                @csrf
                <div class="vertical-button">
                    <div class="redirect">
                        <button type="button" class="redirect-btn"
                                onclick="window.location.href='{{route('creditRegistry')}}'">
                            単位登録する
                        </button>
                    </div>
                    <div class="credited">
                        <button type="button" class="credited-btn">
                            単位登録済み
                        </button>
                    </div>
                </div>
                <div class="input-group">
                    <div class="w-50 group-control">
                        <label for="registration_year">登録年度</label>
                        <select id="registration_year" name="registration_year" style="width:80%;margin-right: 20px;">
                            <option value="0">（登録年度）</option>
                            @foreach($registrationYearData as $value)
                                <option value="{{$value}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-50 group-control">
                        <label for="title">項目</label>
                        <select id="title" name="title" style="width:80%;">
                            <option value="0">（項目）</option>
                            @foreach($titleData as $value)
                                <option value="{{$value}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="action">
                    <button type="button" class="action-btn">確認</button>
                </div>
                <div class="area-input">
                    {{--                    <textarea id="w3review" name="w3review" rows="10">--}}
                    {{--                        2023年1月～ 2023年  8月 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX研修--}}
                    {{--                        2023年9月～ 2023年12月 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX研修--}}
                    {{--                    </textarea>--}}

                    <div style="height: 200px; border: 1px solid; overflow: auto; padding: 5px" id="w3review">

                    </div>
                </div>
            </form>
        </div>
        <div class="contain2">
            @if(!empty($guidanceData[2]))
                @if($guidanceData[2]->sentence_class)
                    {!! $guidanceData[2]->guidance !!}
                @else
                    {!! $guidanceData[2]->guidance !!}
                @endif
            @endif
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('.action-btn').click(function () {
                var data = $('#formTypeSelected').serialize();
                var url = $('#formTypeSelected').attr('action');
                $.ajax({
                    url: url,
                    data: data,
                    type: 'post',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (res) {
                        show(res.data)
                    },
                    error: function (request, status, error) {
                        console.log(request, status, error);
                    }
                });
            });

            function show(data) {
                console.log(data, data == '')
                $('#w3review').html('');
                if (data == '') {
                    toastr.options = {
                        "target": "#w3review",
                        'fadeOut': 5000,
                        'timeOut': 5000,
                        'extendedTimeOut': 5000
                    }
                    toastr.success('該当する単位はありません');
                } else {
                    $.each(data, function (index, value) {
                        var html = '<a href="#">' + value.answer1 + ' ' + value.answer2 + '</a><br>';
                        $('#w3review').append(html);
                    });
                }

            }
        })
    </script>
@endpush
