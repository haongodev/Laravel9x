<div class="main-header">
    <div class="left-side">
        <span class="main-title">研鑽管理システム</span>
        <span class="container ml-10px"><button data-bs-toggle="modal" data-bs-target="#changePassModal" class="header-buttom">PWD変更</button></span>
    </div>
    @if(auth()->check())
        <div class="right-side">
            <div class="container">
                <form action="{{route('admin.logout')}}" method="POST">
                    @csrf
                    <button type="submut" class="header-buttom">ログアウト</button>
                </form>
            </div>
        </div>
    @endif
</div>
@include('admin.components.change_password')
