<div class="sakuraSet-sideBar">
    <p>あなたが振り返りを担当を 実施しているメンバー</p>
    <ul>  
        @foreach($sakuraReview as $reviewData)
            <li class="flex-between" status="{{$reviewData->reviewer_status}}">
                <span class="{{ $reviewData->reviewer_status === 2 ? 'become-manager' : '' }}">{{ $reviewData->user_add_info->name1}} {{ $reviewData->user_add_info->name2}}</span>
                @switch($reviewData->reviewer_status)
                    @case(1)
                        <button class="reviewer">振返り担当受付</button>
                        @break
                    @case(2)
                        <button class="sharing">共有中</button>
                        @break
                    @case(3)
                        <button class="cancel">解除申請</button>
                        @break
                    @default
                        <button class="accept-cancel">解除受付</button>
                @endswitch
            </li>
        @endforeach
    </ul>
</div>
