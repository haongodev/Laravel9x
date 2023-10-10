<div class="left-side">
    <div class="side-bot">
        <div class="container">
            <div class="row">
                <ul>
                    <li class="action">
                        <a href="javascript:void(0)">
                            <span>{{auth('admin')->user()->user_add_info->login_id ?? ''}}</span>
                        </a>
                    </li>
                </ul>
                <ul>
                    <li class="title">
                        <span>構成員管理</span>
                    </li>
                    <li class="action">
                        <a href="{{route('admin.index')}}">
                            <span>構成員一覧</span>
                        </a>
                    </li>

                </ul>
                <ul>
                    <li class="title">
                        <span>管理ユーザー管理</span>
                    </li>
                    <li class="action">
                        <a href="javascript:void(0)">
                            <span>ユーザー一覧</span>
                        </a>
                    </li>
                    <li class="action">
                        <a href="javascript:void(0)">
                            <span>ユーザー登録</span>
                        </a>
                    </li>

                </ul>
                <ul>
                    <li class="title">
                        <span>更新研修管理</span>
                    </li>
                    <li class="action">
                        <a href="javascript:void(0)">
                            <span>更新研修一覧</span>
                        </a>
                    </li>
                    <li class="action">
                        <a href="javascript:void(0)">
                            <span>更新研修登録</span>
                        </a>
                    </li>

                </ul>
                <ul>
                    <li class="title">
                        <span>単位項目管理</span>
                    </li>
                    <li class="action">
                        <a href="javascript:void(0)">
                            <span>類型一覧</span>
                        </a>
                    </li>
                    <li class="action">
                        <a href="javascript:void(0)">
                            <span>類型登録</span>
                        </a>
                    </li>
                    <li class="action">
                        <a href="javascript:void(0)">
                            <span>単位項目一覧</span>
                        </a>
                    </li>
                    <li class="action">
                        <a href="javascript:void(0)">
                            <span>単位項目登録</span>
                        </a>
                    </li>

                </ul>
                <ul>
                    <li class="title">
                        <span>システム設定</span>
                    </li>
                    <li class="action">
                        <a href="javascript:void(0)">
                            <span>ガイド設定</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
<style>
    .wrapper-container .left-side .side-bot .container .row ul li.title{
        background: #B9E0A5;
        padding: 10px;
    }
    .wrapper-container .left-side .side-bot .container .row ul li.action{
        border: 1px solid #cbd5e1;
        border-radius: 10px ;
        margin-top: 5px;
    }
</style>
