@if($paginator->hasPages())
    <ul class="pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a href="javascript:void(0)" class="page-link"><</a>
            </li>
        @else
            <li class="page-item">
                <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="page-link"><</a>
            </li>
        @endif
        @if($paginator->currentPage() > 3)
            <li class="page-item"><a class="page-link" href="{{ $paginator->url(1) }}">1</a></li>
        @endif
        @if($paginator->currentPage() > 3)
            <li class="page-item"><span class="page-link">...</span></li>
        @endif
        @foreach(range(1, $paginator->lastPage()) as $page)
            @if($page >= $paginator->currentPage() - 1 && $page <= $paginator->currentPage() + 1)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active">
                        <a href="javascript:void(0)" class="page-link">{{ $page }}</a>
                    </li>
                @else
                    <li class="page-item ">
                        <a href="{{ $paginator->url($page) }}" class="page-link">{{ $page }}</a>
                    </li>
                @endif
            @endif
        @endforeach
        @if($paginator->currentPage() < $paginator->lastPage() - 3)
            <li class="page-item"><span class="page-link">...</span></li>
        @endif
        @if($paginator->currentPage() < $paginator->lastPage() - 2)
            <li class="page-item"><a class="page-link"
                                     href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
            </li>
        @endif

        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a href="{{ $paginator->nextPageUrl() }}" class="page-link">></a>
                {{--                <a href="{{ $paginator->nextPageUrl() }}" class="page-link">{{__('cms::translation.next')}}</a>--}}
            </li>
        @else
            <li class="page-item disabled">
                {{--                <a href="javascript:void(0)" class="page-link">{{__('cms::translation.next')}}</a>--}}
                <a href="javascript:void(0)" class="page-link">></a>
            </li>
        @endif

    </ul>
@endif
