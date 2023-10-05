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
    <link href="{{ asset('assets') }}/css-lib/jquery-ui/jquery-ui.css" rel="stylesheet"/>
    <link href="{{ asset('assets') }}/css/main.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/components.css" rel="stylesheet" />
    <meta class="base_url" value="{{url('/')}}" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/vue/2.6.14/vue.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/socket.io/2.4.0/socket.io.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.common.min.js"></script>
    
</head>

<body class="{{ (isset($page_name)) ? $page_name : 'about-us' }} sidebar-collapse">
@stack('styles')
@include('components.popup')
@if (!empty(session('show_popup_confirm')))
    @include('components.popup_confirm')
@endif
@include('layouts.web.header')
<div class="wrapper-container">
    @include('layouts.web.sidebar')

    <div class="main-content">
        @yield('content')
    </div>
    <div id="app">
        <button @click="sendMessage" class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
    </div>
</div>

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/common.js')}}"></script>
<script src="{{asset('assets/js/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('assets/js-lib/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/js-lib/jquery-ui-jp.js') }}"></script>
<script src="{{ asset('assets/js-lib/jquery-ui-vi.js') }}"></script>
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
<script>
    new Vue({
      el: "#app",
      data() {
        return {
          message: "dưqdqdqwdqwdqwdqw",
          users: [],
        }
      },
      methods: {
        sendMessage() {
          axios.post('/mypage/message', { message: this.message })
          this.message = ""
        }
      },
      mounted() {
        const echo = new Echo({
          broadcaster: "socket.io",
          host: window.location.hostname + ':6001'
        })

        echo.join('chat').here((users) => {
          this.users = users
        }).listen('MessageSent', (event) => {
          console.log(event);
        });
      },
    })
</script>
@stack('sub_js')

</body>

</html>
