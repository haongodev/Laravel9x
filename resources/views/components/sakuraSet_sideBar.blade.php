<div class="sakuraSet-sideBar">
    <p>あなたが振り返りを担当を 実施しているメンバー</p>
    <ul>
        @php //dd($sakuraManage->reviewer_member->name1 ?? '')@endphp
        @if(isset($sakuraManage))
            <li class="flex-between" status="{{$sakuraManage->reviewer_status}}">
                <span>{{ $sakuraManage->reviewer_member->name1 ?? ''}} {{ $sakuraManage->reviewer_member->name2 ?? ''}}</span>
                <button class="reviewer btn-eff-gre btn-hov">振返り担当受付</button>
            </li>
            <li class="flex-between" status="{{$sakuraManage->reviewer_status}}">
                <span class="{{ $sakuraManage->reviewer_status === 2 ? 'become-manager' : '' }}">{{ $sakuraManage->reviewer_member->name1 ?? ''}} {{ $sakuraManage->reviewer_member->name2 ?? ''}}</span>
                <button class="sharing btn-eff-pri btn-hov">共有中</button>
            </li>
            <li class="flex-between" status="{{$sakuraManage->reviewer_status}}">
                <span>{{ $sakuraManage->reviewer_member->name1 ?? ''}} {{ $sakuraManage->reviewer_member->name2 ?? ''}}</span>
                <button class="cancel btn-eff-red btn-hov">解除申請</button>
            </li>
            <li class="flex-between" status="{{$sakuraManage->reviewer_status}}">
                <span>{{ $sakuraManage->reviewer_member->name1 ?? ''}} {{ $sakuraManage->reviewer_member->name2 ?? ''}}</span>
                <button class="accept-cancel btn-eff-ora btn-hov">解除受付</button>
            </li>
        @endif
    </ul>
</div>


