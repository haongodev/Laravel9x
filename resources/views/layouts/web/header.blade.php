<div class="main-header">
    <div class="left-side">
        <div class="main-logo">
            <img src="{{ asset('assets') }}/images/logo/title_logo.png" alt="training_management_logo">
        </div>
    </div>
    @if(auth()->check())
    <div class="right-side">
        <div class="container">
            @if(!empty($button_central_study))
                <a href="https://www.jamhsw.or.jp/ugoki/kensyu.htm" target="_blank">
                    <button type="button" class="header-buttom btn-pur btn-hov btn-eff-pur">研修センター</button>
                </a>
            @endif
            @if(!empty($button_unit_guidelines))
                <a href="/templates/sidebar/単位ガイドライン（20230926改訂）.pdf" target="_blank">
                    <button type="button" class="header-buttom accept-btn btn-hov btn-eff-pri">単位ガイドライン</button>
                </a>
            @endif
            @if(!empty($button_operation_manual))
                <a href="/templates/sidebar/操作マニュアル_本運用版.pdf" target="_blank">
                    <button type="button" class="header-buttom action-btn btn-hov btn-eff-ora">操作マニュアル</button>
                </a>
            @endif
            @if (isset($header_button))
                {!! $header_button !!}
            @endif
            <button type="button" class="header-buttom btn-hov btn-eff-gre" onclick="window.location.href='{{route('mypage')}}'">私の研鑽データ</button>
        </div>
    </div>
    @endif
</div>
