<div class="sakuraSet-sideBar">
    <p>あなたが振り返りを担当を 実施しているメンバー</p>
    <ul>  
        @if(isset($sakuraManage))
            <li class="flex-between" status="{{$sakuraManage->reviewer_status}}">
                <span>{{ $sakuraManage->reviewer_member->name1}} {{ $sakuraManage->reviewer_member->name2}}</span>
                <button class="reviewer">振返り担当受付</button>
            </li>
            <li class="flex-between" status="{{$sakuraManage->reviewer_status}}">
                <span class="{{ $sakuraManage->reviewer_status === 2 ? 'become-manager' : '' }}">{{ $sakuraManage->reviewer_member->name1}} {{ $sakuraManage->reviewer_member->name2}}</span>
                <button class="sharing">共有中</button>
            </li>
            <li class="flex-between" status="{{$sakuraManage->reviewer_status}}">
                <span>{{ $sakuraManage->reviewer_member->name1}} {{ $sakuraManage->reviewer_member->name2}}</span>
                <button class="cancel">解除申請</button>
            </li>
            <li class="flex-between" status="{{$sakuraManage->reviewer_status}}">
                <span>{{ $sakuraManage->reviewer_member->name1}} {{ $sakuraManage->reviewer_member->name2}}</span>
                <button class="accept-cancel">解除受付</button>
            </li>
        @endif
    </ul>
</div>


