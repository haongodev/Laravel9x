@extends('layouts.web.main', ['pageSlug' => 'myPage.myPage'])
@push('styles')
    <link href="{{ asset('assets') }}/css/registry.css" rel="stylesheet" />
@endpush
@section('content')
    {{ Breadcrumbs::render('typeSelected') }}
    <div class="container">
        <div class="contain1">
        </div>
        <div class="form-registry">
            <form action="#">
                <div class="vertical-button">
                    <div class="redirect">
                        <button type="button" class="redirect-btn">
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
                    <div class="w-50">
                        <label for="email">登録年度</label>
                        <select id="email">
                            <option value="1">（登録年度）</option>
                            <option value="2">BMW</option>
                        </select>
                    </div>
                    <div class="w-50">
                        <label for="pwd">項目</label>
                        <select id="pwd">
                            <option value="1">（項目）</option>
                            <option value="2">BMW</option>
                        </select>
                    </div>
                </div>
                <div class="action">
                    <button type="submit" class="action-btn">確認</button>
                </div>
                <div class="area-input">
                    <textarea id="w3review" name="w3review" rows="10">
                        2023年1月～ 2023年  8月 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX研修
                        2023年9月～ 2023年12月 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX研修
                    </textarea>
                </div>
            </form>
        </div>
        <div class="contain2">
        </div>
    </div>
@endsection
@push('js')
    <script>
    </script>
@endpush
