<div class="breadcrumbs-section plr-200 mb-80">
    <div class="breadcrumbs overlay-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs-inner">
                        <h1 class="breadcrumbs-title">{{ $title or $menu_item->title}}</h1>
                        <ul class="breadcrumb-list">
                            <li><a href="{{ route('home') }}"><i class="zmdi zmdi-home bread-crumbs"></i> домой</a></li>
                            @if ($collect_pages == true)
                                <li>{{$menu_item->title}}</li>
                            @elseif ($drop_down_pages == true)
                                <li><a href="{{route('alfa')}}">{{$menu_item->title}}</a></li>
                                <li>{{$title}}</li>
                            @elseif ($single_pages == true) 
                                <li>{{$title}}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>