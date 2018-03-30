<div class="breadcrumbs-section plr-200 mb-80">
    <div class="breadcrumbs overlay-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs-inner">
                        <h1 class="breadcrumbs-title">{{ $category->title or 'Блог' }}</h1>
                        <ul class="breadcrumb-list">
                            <li><a href="{{ route('home') }}"><i class="zmdi zmdi-home" style="font-size: 20px;"></i> домой</a></li>
                            @if ($category)
                            <li><a href="{{route('articles')}}">Блог</a></li>
                            <li>{{ $category->title}}</li>
                            @else
                            <li>Блог</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="page-content" class="page-wrapper">

    <div class="blog-section mb-50">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-option box-shadow mb-30  clearfix">
                        @if(isset($cats))
                            <div class="dropdown f-left">
                                <button class="option-btn">
                                    Темы
                                    <i class="zmdi zmdi-chevron-down"></i>
                                </button>
                                <div class="dropdown-menu dropdown-width mt-30">
                                    <aside class="widget widget-categories box-shadow">
                                        <h6 class="widget-title border-left mb-20">Темы</h6>
                                        <div id="cat-treeview" class="product-cat">
                                            <ul>
                                                @foreach($cats as $key => $cat)
                                                <li class="closed"><a href="#">{{ $cat->title }}</a>
                                                    @if($cat->articles)
                                                    <ul>
                                                        @foreach ($cat->articles as $article)
                                                        <li><a href="{{ route('article', $article->alias) }}">{{ $article->title }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </li> 
                                                @endforeach

                                            </ul>
                                        </div>
                                    </aside>
                                </div>
                            </div>
                        @endif
                        @if(isset($comments))
                        <div class="dropdown f-left">
                            <button class="option-btn">
                                Блог-новости
                                <i class="zmdi zmdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu dropdown-width mt-30">
                                <aside class="widget widget-product box-shadow">
                                    <h6 class="widget-title border-left mb-20">последние комментарии</h6>
                                    <!-- product-item start -->
                                    @foreach ($comments as $comment)
                                    <div class="product-item">
                                        <div class="media-left pr-30">
                                            <a href="{{route('article',$comment->article->alias)}}#comment-{{$comment->id}}">
                                                <img src="{{asset('assets')}}/img/author/{{ $comment->user->avatar ? $comment->user->avatar : '12.jpg' }}" width="35"  alt="{{$comment->user->name}}"/>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                        <p><a href="{{route('article',$comment->article->alias)}}#comment-{{$comment->id}}">{{$comment->user->name}}</a> о статье</p>
                                            <h6 class="product-title multi-line mt-10">
                                                <a href="{{route('article',$comment->article->alias)}}">{{$comment->article->title}}</a>
                                            </h6>
                                            <p class="mb-0">{{ str_limit($comment->text,70) }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </aside>      
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($articles as $article)
                <div class="col-sm-6 col-xs-12">
                    <div class="blog-item-2">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="blog-image">
                                <a href="{{ route('article', $article->alias) }}"><img src="{{ asset('assets') }}/img/blog/{{ json_decode($article->img, true)['mini'] }}" alt="{{ $article->alias }}"></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="blog-desc">
                                    <h5 class="blog-title-2"><a href="{{ route('article', $article->alias) }}">{{ $article->title }}</a></h5>
                                    {!! str_limit($article->desc, 160) !!}
                                    <div class="read-more">
                                        <a href="{{ route('article', $article->alias) }}">Читать далее…</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach 
            </div>

            <div class="row">
                <div class="col-xs-12">
                    {{$articles->links()}}            
                </div>
            </div>

        </div>
    </div>
    
</div>
