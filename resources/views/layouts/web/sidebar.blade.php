<div class="left-side">
    <div class="side-top">
        <div class="container">
            <div class="row">
                <div class="title-sign">
                    <span class="member_num">構成員番号：{{auth()->user()->user_add_info->login_id ?? auth()->user()->id}}</span>
                    <span class="welcom">ようこそ、{{auth()->user()->name}}さん</span>
                </div>
                <form action="/logout" method="post" class="logoutForm">
                    @csrf
                    <button class="close-btn btn-eff-bla btn-hov">閉じる</button>
                </form>
                <button class="registed-btn">現在の単位登録数</button>
                @php
                    $answerInfoPattern = answerInfoPattern();
                @endphp
                <ul class="list-info">
                    <li>
                        <a href="{{route('typeSelected',['type_native_id'=>0])}}" class="bg-primary">スーパービジョン</a><span>{{$answerInfoPattern[0]['score_total'] ?? 0}}</span>
                    </li>
                    <li>
                        <a href="{{route('typeSelected',['type_native_id'=>1])}}" class="bg-yellow">研修・学会等</a><span>{{$answerInfoPattern[1]['score_total'] ?? 0}}</span>
                    </li>
                    <li>
                        <a href="{{route('typeSelected',['type_native_id'=>2])}}" class="bg-green">社会的活動</a><span>{{$answerInfoPattern[2]['score_total'] ?? 0}}</span>
                    </li>
                </ul>
                @if(auth()->user()->user_add_info->membership_type == '認定保健福祉士')
                    <div class="cert-box">
                        <button class="handle-btn">認定期限</button>
                        <span>{{getCertificationYear()}}年度</span>
                    </div>
                @endif
                @php $scheduledDate = scheduledDate() @endphp
                @if($scheduledDate)
                    <button class="scheduled-btn">次回のさくらセット<br>取り組み予定</button>
                    <p class="current-time">{{$scheduledDate}}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="side-bot">
        <div class="container">
            <div class="row">
                <ul>
                    <li>
                        <a href="#">
                            <img class="icon" src="{{ asset('assets') }}/images/menu-icon/menu-1.svg">
                            <span>私の研鑽データ</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('creditRegistration')}}">
                            <img class="icon" src="{{ asset('assets') }}/images/menu-icon/menu-2.svg">
                            <span>研鑽を記録する (単位登録)</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('cls')}}">
                            <img class="icon" src="{{ asset('assets') }}/images/menu-icon/menu-3.svg">
                            <span>現在の研鑽状況 (単位登録状況)</span>
                        </a>
                    </li>
                    <li class="{{ (request()->is('mypage/sakuraSet')) ? 'active' : '' }}">
                        <a href="{{ route('sakuraSet') }}">
                            <img class="icon" src="{{ asset('assets') }}/images/menu-icon/menu-4.svg">
                            <span>自己研鑽支援ツール「さくらセット」に取り組む</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="javascript:void(0)" style="color: #808080">
                            <img class="icon" src="{{ asset('assets') }}/images/menu-icon/menu-5.svg">
                            <span>認定更新手続き</span>
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
    <div class="sub-desc">
        <ul class="text-danger">
            <li>
                <p>本協会の受講履歴を確認したい場合はマイページの「研修受講履歴」を選択 してください。</p>
            </li>
        </ul>
    </div>
    @if (isset($sidebarInclude))
        {!! $sidebarInclude !!}
    @endif
    @if (isset($guidanceInclude))
    <div class="guidance-desc">
        @foreach($guidanceInclude as $guidance)
            @if($guidance->sentence_class === 1)
                {!! $guidance->guidance !!}
            @else
                {{ $guidance->guidance }}
            @endif
        @endforeach
    </div>
    @endif
</div>
