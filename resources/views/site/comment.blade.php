@foreach ($items as $k => $item)
    <ul>
        <li id="li-comment-{{$item->id}}" class="open comment even">
            <div id="comment-{{$item->id}}" class="media mt-30 comment-container">
                <div class="media-left pr-30">
                    <a href="javascript:void(0);"><img class="media-object" src="{{asset('assets')}}/img/author/{{ $item->user->avatar ? $item->user->avatar : '12.jpg' }}" width="{{ $item->parent_id == 0 ? 60 : 45 }}" alt="#"></a>
                </div>
                <div class="media-body">
                    <div class="clearfix">
                        <div class="name-commenter f-left">
                            <div class="blog-details-area">
                               
                                <span class="small">{{ is_object($item->created_at) ? $item->created_at->diffForHumans() : ''}}</span>&nbsp;&nbsp;
                                <span class="reply-details"> 
                                {{ ($item->parent_id) ? \App\Comment::find($item->parent_id)->user->name : $article->title }}
                                <i class="zmdi zmdi-long-arrow-return"></i>
                                 </span>
                            </div>
                            <h6 class="media-heading"><a href="javascript:void(0);">{{ $item->user->name }}</a></h6>
                        </div>
                        <div>
                            <ul class="reply-delate f-right">
                                <li style="padding-right: 30px;">
                                    <div class="commentNumber">#&nbsp;</div>
                                </li>
                                <li>
                                    <a class="comment-reply-link" href="#respond" onclick="return addComment.moveForm(&quot;comment-{{$item->id}}&quot;, &quot;{{$item->id}}&quot;, &quot;respond&quot;, &quot;{{$item->article_id}}&quot;)">Ответить</a> 
                                </li>
                            </ul>
                        </div>
                    </div>
                    <p class="mb-0"> {!! $item->text !!}</p>
                </div>
            </div>
            <ul  class="">
                @if(isset($com[$item->id]))
                    <div class="media mt-30 children">
                        @include('site.comment',['items'=>$com[$item->id]])
                    </div>
                @endif
            </ul>
        </li>
    </ul>  
@endforeach





