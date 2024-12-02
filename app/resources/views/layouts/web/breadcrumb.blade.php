<div class="bread-crumb">
    @unless ($breadcrumbs->isEmpty())
        <ol class="breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)

                @if (!is_null($breadcrumb->url) && !$loop->last)
                    <li class="breadcrumb-item">{{ $breadcrumb->title }}</li>
                @else
                    <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                @endif

            @endforeach
        </ol>
    @endunless
</div>
