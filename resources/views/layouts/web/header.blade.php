<div class="main-header">
    <div class="left-side">
        <div class="main-logo">
            <img src="{{ asset('assets') }}/images/logo/title_logo.png" alt="training_management_logo">
        </div>
    </div>
    @if(auth()->check())
    <div class="right-side">
        <div class="container">
            @if (isset($header_button))
                {!! $header_button !!}
            @endif
            <button type="button" class="header-buttom btn-hov btn-eff-gre" onclick="window.location.href='{{route('mypage')}}'">私の研鑽データ</button>
        </div>
    </div>
    @endif
</div>
