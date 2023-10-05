<div class="main-header">
    <div class="left-side">
        <span class="main-title">研鑽管理システム</span>
        <span class="container ml-10px"><button class="header-buttom">PWD変更</button></span>
    </div>
    @if(auth()->check())
    <div class="right-side">
        <div class="container">
            <button type="button" class="header-buttom">ログアウト</button>
        </div>
    </div>
    @endif
</div>
