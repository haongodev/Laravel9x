<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    {{-- <title>{{ isset($pageSlug) ? $pageSlug : config('app.name', 'Training Management') }}</title> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>研鑽管理システム</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0 , user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link href="{{ asset('assets') }}/css/cdnjs.cloudflare.com_ajax_libs_toastr.js_latest_toastr.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet" />
{{--    <link href="{{ asset('assets') }}/css/components.css" rel="stylesheet" />--}}
    <meta class="base_url" value="{{url('/admin')}}" />
</head>

<body class="{{ (isset($page_name)) ? $page_name : 'about-us' }} sidebar-collapse">
@stack('styles')
@include('admin.layouts.header')
<div class="wrapper-container">
    @include('admin.layouts.sidebar')

    <div class="main-content">
        @yield('content')
    </div>
</div>

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
<script src="{{asset('assets/js/common.js')}}"></script>
<script src="{{ asset('assets/js-lib/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/js-lib/jquery-ui-jp.js') }}"></script>
<script src="{{ asset('assets/js-lib/jquery-ui-vi.js') }}"></script>
<script src="{{ asset('assets/js-lib/bootstrap.bundle.min.js')}}"></script>
@stack('js')
<script>
    var url = '{{ route("sakuraCheckMark") }}';
    $.ajax({
        url,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        success: function(response) {
            if(response.status){
                $('.side-bot .row li').removeClass('active');
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
</script>
@stack('sub_js')

</body>

</html>
