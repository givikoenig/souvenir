<div class="breadcrumbs-section plr-200 mb-80">
    <div class="breadcrumbs overlay-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs-inner">
                        <h1 class="breadcrumbs-title">{{ $title or 'Блог' }}</h1>
                        <ul class="breadcrumb-list">
                            <li><a href="{{ route('home') }}"><i class="zmdi zmdi-home" style="font-size: 20px;"></i> домой</a></li>
                            <li><a href="{{route('articles')}}">Блог</a></li>
                            @if (isset($article->category))
                                <li><a href="{{route('articles',$article->category->alias)}}">{{$article->category->title}}</a></li>
                            @endif
                            @if (isset($article))
                                <li>{{$article->title}}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Start page content -->
        @if (isset($article))
        <section id="page-content" class="page-wrapper">
        
            <!-- BLOG SECTION START -->
            <div class="blog-section mb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-xs-12">
                            <div class="blog-details-area">
                                <!-- blog-details-photo -->
                                <div class="blog-details-photo bg-img-1 p-20 mb-30">
                                    <img src="{{ asset('assets') }}/img/blog/{{ json_decode($article->img, true)['max'] }}" alt="">
                                    <div class="today-date bg-img-1">
                                        <span class="meta-date">{{ $article->created_at->format('d') }}</span>
                                        <span class="meta-month">{{ $article->created_at->format('M') }}</span>
                                    </div>
                                </div>
                                <!-- blog-like-share -->
                                <ul class="blog-like-share mb-20">
                                    <li data-article_id="{{$article->id}}" data-user_id="{{ Auth::check() ? Auth::user()->id : 0 }}" class="like-li">
                                        <form action="{{ route('like.store')}}" method="post" id="likeform">
                                            <span class="like-span" title="{{Auth::check() ? '' : 'Зарегистрируйтесь или войдите, чтобы оставить "лайк"' }}"><i class="zmdi zmdi-favorite"></i></span>&nbsp;&nbsp;
                                            <span class="like-count" title="{{Auth::check() ? '' : 'Зарегистрируйтесь или войдите, чтобы оставить "лайк"' }}">{{$likes_count}}</span>
                                            <input id="like_article_ID" type="hidden" name="like_article_ID" value="{{  $article->id}}" />
                                            <input id="like_user_ID" type="hidden" name="like_user_ID" value="{{ Auth::check() ? Auth::user()->id : 0 }}" />
                                            {{ csrf_field() }}
                                            @if (Auth::check())
                                                <input type="submit" class="like-click" id="likesubmit" name="submit" value="Like" />
                                            @endif
                                        </form> 
                                    </li>
                                    <li>
                                        <a href="#comments-treeview"><i class="zmdi zmdi-comments"></i>{{ $comments_count }}</a>
                                    </li>

                                </ul>
                               
                                <!-- blog-details-title -->
                                <h3 class="blog-details-title mb-30">{{ $article->title }}</h3>
                                <!-- blog-description -->
                                <div class="blog-description mb-60">
                                    {!! $article->desc !!}

                                    <div class="quote-author pl-60 quote-border">
                                        {!! $article->excerption !!}
                                    </div>

                                    {!! $article->text !!}    
                                </div>
                                <!-- blog-share-tags -->
                                <div class="blog-share-tags box-shadow clearfix mb-60">
                                    <div class="blog-share f-left">
                                        <p class="share-tags-title f-left">поделиться</p>
                                        <ul class="footer-social f-left">
                                            @set($ttl,urlencode($article->title))
                                            @set($url, urlencode( Request::fullUrl() ) )
                                            @set($summary,urlencode($article->desc))
                                            {{-- @set($image,urlencode(json_decode($article->img, true)['mini'])) --}}
                                            @set($image,  urlencode( asset('assets') . '/img/blog/' . json_decode($article->img, true)['max'] )  )
                                            <li>
                                                   
<meta property="og:url"                content="{{ $url }}" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="{{$ttl}}" />
<meta property="og:description"        content="{{$summary}}" />
<meta property="og:image"              content="{{ $image }}" />

<a class="facebook b-xfbml-parse-ignore" onClick="window.open('http://www.facebook.com/sharer.php?u={{$url}}')" href="javascript: void(0)"><i class="zmdi zmdi-facebook"></i></a>

                                                {{-- <a class="facebook b-xfbml-parse-ignore" onClick="window.open('http://www.facebook.com/sharer.php?s=100&p[title]={{$ttl}}&p[summary]={{$summary}}&p[url]={{$url}}&&p[images][0]={{$image}}','sharer','toolbar=0,status=0,width=700,height=500');"  href="javascript: void(0)" title="Facebook"><i class="zmdi zmdi-facebook"></i></a> --}}

                                                
                                            
                                            </li>
                                            <li>
                                                <a class="google-plus" onClick="window.open('https://plusone.google.com/_/+1/confirm?hl=ru&amp;url={{$url}}','sharer','toolbar=0,status=0,width=700,height=500');" href="javascript: void(0)" title="Google Plus"><i class="zmdi zmdi-google-plus"></i></a>
                                            </li>
                                            <li>
                                                <a class="twitter" onClick="window.open('https://twitter.com/share?url={{url()->current()}}','sharer','toolbar=0,status=0,width=700,height=500');" href="javascript: void(0)" title="Twitter"><i class="zmdi zmdi-twitter"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @if($article->post)
                                <!-- author-post -->
                                <div class="media author-post box-shadow mb-60">
                                    <div class="media-left pr-20">
                                        <a href="javascript:void(0);">
                                            <img class="media-object" src="{{asset('assets')}}/img/author/{{ $article->user->avatar ? $article->user->avatar : '12.jpg' }}" width="70" alt="#">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h6 class="media-heading">
                                            <a href="javascript:void(0);">{{$article->user->name}}</a>
                                        </h6>
                                        <p class="mb-10">{{ $article->created_at->format('d-m-Y ') }}</p>
                                        {!! $article->post !!}
                                    </div>
                                </div>
                                @endif
                                <!-- comments on this post -->
                                <div id="comments-treeview" class="post-comments mb-60 product-cat">
                                   <h4 class="blog-section-title border-left mb-30">комментарии&nbsp;&nbsp;&nbsp;<small>({{$article->comments->count()}})</small></h4>
                                    @if(count($article->comments) > 0)
                                        @set($com,$article->comments->groupBy('parent_id'))
                                        <ul class="commentlist">
                                        @foreach ($com as $k => $comments)
                                            @if($k !== 0)
                                            @break
                                            @endif
                                               @include('site.comment',['items' => $comments])
                                        @endforeach
                                        </ul>
                                     @endif   
                                </div>
                                
                                @if (Auth::check())
                                <div  id="respond" class="leave-comment">
                                    <h4 id="reply-title" class="blog-section-title border-left mb-30"><span>оставьте комментарий</span>&nbsp;&nbsp;&nbsp;
                                    <small><a rel="nofollow" id="cancel-comment-reply-link" href="#respond" style="display:none;">отмена</a></small>
                                    </h4>
                                    <form action="{{ route('comment.store')}}" method="post" id="commentform">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="name" placeholder="Ваше имя…" disabled="" value="{{Auth::user()->name}}">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="subject" placeholder="Тема сообщения…" disabled="" value="Re: {{$article->title}}">
                                            </div>
                                            <div class="col-md-12">
                                                <textarea id="comment"  name="text" class="custom-textarea" placeholder="Ваш комментарий…"></textarea>
                                            </div>
                                        </div>
                                        {{ csrf_field() }}
                                        <div id="comment_captcha" class="center">{!! $captcha !!}</div>
                                        <input type="text" id="captcha" name="captcha" placeholder="Введите символы с картинки…">
                                        <input id="comment_post_ID" type="hidden" name="comment_post_ID" value="{{  $article->id}}" />
                                        <input id="comment_parent" type="hidden" name="comment_parent" value="0" />
                                        
                                        <input  class="submit-btn-1 black-bg mt-30 btn-hover-2" name="submit" type="submit" id="submit" value="Отправить комментарий" />
                                    
                                    </form>
                                </div>
                                
                                @else
                                    <a href="#">
                                        <i class="zmdi zmdi-account-add"></i>
                                        <span data-toggle="modal"  data-target="#modalRegister">
                                            Зарегистрируйтесь
                                        </span>
                                    </a>&nbsp;&nbsp;или&nbsp;&nbsp;
                                    <a href="#">
                                        <i class="zmdi zmdi-lock"></i>
                                        <span data-toggle="modal"  data-target="#modalLogin">
                                            войдите
                                        </span>
                                    </a>
                                    ,&nbsp;&nbsp;чтобы оставить комментарий
                                @endif
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-12">
                            <aside class="widget-search mb-30">
                                <form action="{{ route('articles') }}">
                                    <input type="text" placeholder="Искать статью..." name="keyword">
                                    <button type="submit"><i class="zmdi zmdi-search"></i></button>
                                </form>
                            </aside>
                            @if(isset($cats))
                            <aside class="widget widget-categories box-shadow mb-30">
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
                            @endif
                            @if (isset($new_arrivals))
                            <aside class="widget widget-product box-shadow mb-30">
                                <h6 class="widget-title border-left mb-20">последние поступления</h6>
                                <!-- product-item start -->
                                @foreach ($new_arrivals as $new_arrival)
                                    @if ($new_arrival->visible)
                                        <div class="product-item">
                                            <div class="product-img">
                                                <a href="{{ route('product',['id' => $new_arrival['id']]) }}">
                                                    <img src="{{ asset('assets') }}/img/product/{{ json_decode($new_arrival['images'],true)['med'] }}" alt="{{ $new_arrival['name'] }}"/>
                                                </a>
                                            </div>
                                            <div class="product-info">
                                                <h6>
                                                    <a href="{{ route('product',['id' => $new_arrival['id']]) }}" title="{{ $new_arrival['name'] }}" >{{ $new_arrival['name'] }}</a>
                                                </h6>
                                                <h3 class="pro-price">{{$new_arrival['price']}} <span>&#8381;</span></h3>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </aside>
                            @endif
                    </div>
                </div>
            </div>
        </section>
        @endif


