@include('site.content_literas_pbl')

<div id="page-content" class="page-wrapper">

    @if ($collect_pages)
        @include('site.content_collect_pages')
    @endif

    @if ($drop_down_pages || $single_pages)
        @include('site.content_single_pages')
    @endif

</div>