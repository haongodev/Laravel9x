<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ isset($pageSlug) ? $pageSlug : config('app.name', 'Training Management') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ (isset($page)) ? $page : config('app.name', 'Training Management') }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0 , user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="{{ asset('assets') }}/css/main.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/components.css" rel="stylesheet" />
    <meta class="base_url" value="{{url('/')}}" />
</head>

<body class="{{ (isset($page_name)) ? $page_name : 'about-us' }} sidebar-collapse">
@stack('styles')
@include('components.popup')
@if (session('popup_confirm'))
    @include('components.popup_confirm')
@endif
@include('layouts.web.header')
<div class="wrapper-container">
    @include('layouts.web.sidebar')

    <div class="main-content">
        @yield('content')
    </div>
</div>

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/common.js')}}"></script>
@stack('js')

</body>

</html>
