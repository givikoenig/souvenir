@if(isset($articles))
    <div class="blog-section-2 pt-60 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-left mb-40">
                        <h2 class="uppercase">Последние статьи</h2>
                        <h6>Самые свежие материалы нашего блога</h6>
                    </div>
                </div>
            </div>
            <div class="blog">
                <div class="row active-blog-2">
                    @foreach ($articles as $article)
                    <div class="col-xs-12">
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
                                        {!! str_limit($article->desc,160) !!}
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
            </div>
        </div>
    </div>
@endif
