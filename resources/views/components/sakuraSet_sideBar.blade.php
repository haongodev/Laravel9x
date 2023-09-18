<div class="sakuraSet-sideBar">
    <p>あなたが振り返りを担当を 実施しているメンバー</p>
    <ul>
        @if(isset($sakuraManage))
            @switch($sakuraManage->reviewer_status)
                @case(1)
                    <li class="flex-between" status="{{$sakuraManage->made_member}}">
                        <span>{{ $sakuraManage->made_member->name1 ?? ''}} {{ $sakuraManage->made_member->name2 ?? ''}}</span>
                        <button data-id="{{ $sakuraManage->made_member->login_id}}" class="reviewer btn-eff-gre btn-hov">振返り担当受付</button>
                    </li>
                    @break
                @case(2)
                    <li class="flex-between" status="{{$sakuraManage->made_member}}">
                        <span class="become-manager">{{ $sakuraManage->made_member->name1 ?? ''}} {{ $sakuraManage->made_member->name2 ?? ''}}</span>
                        <button data-id="{{ $sakuraManage->made_member->login_id}}" class="sharing btn-eff-pri btn-hov">共有中</button>
                    </li>
                    @break
                @case(3)
                    <li class="flex-between" status="{{$sakuraManage->made_member}}">
                        <span>{{ $sakuraManage->made_member->name1 ?? ''}} {{ $sakuraManage->made_member->name2 ?? ''}}</span>
                        <button data-id="{{ $sakuraManage->made_member->login_id}}" class="cancel btn-eff-red btn-hov">解除申請</button>
                    </li>
                    @break
                @default
                    <li class="flex-between" status="{{$sakuraManage->made_member}}">
                        <span>{{ $sakuraManage->made_member->name1 ?? ''}} {{ $sakuraManage->made_member->name2 ?? ''}}</span>
                        <button data-id="{{ $sakuraManage->made_member->login_id }}" class="accept-cancel btn-eff-ora btn-hov">解除受付</button>
                    </li>
            @endswitch
        @endif
    </ul>
</div>


{{-- status 1 là đơn phương, status 2 là đồng thuận, status 3 là bãi bỏ đơn phương, status 4 là bãi bỏ --}}