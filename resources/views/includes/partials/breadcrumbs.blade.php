@if (isset($breadcrumbs))
    <ol class="breadcrumbs">
        @foreach ($breadcrumbs as $breadcrumb)
            @if($breadcrumb->url && $loop->first)
                <li><a href="{{ $breadcrumb->url }}"><i class="fas fa-home"></i>&nbsp;{{ $breadcrumb->title }}</a></li>
            @elseif($breadcrumb->url && !$loop->last)
                <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li><span>{{ $breadcrumb->title }}</span></li>
            @endif
        @endforeach
    </ol>
@endif
