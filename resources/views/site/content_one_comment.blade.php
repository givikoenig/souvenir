<ul>
	<li id="li-comment-{{$data['id']}}" class="comment even borGreen">
		<div id="comment-{{$data['id']}}" class="comment-container">
			<div class="media-left pr-30">
                <a href="#"><img class="media-object" src="{{asset('assets')}}/img/author/12.jpg" width="40" alt="#"></a>
            </div>

			<div class="media-body">
                    <div class="clearfix">
                        <div class="name-commenter f-left">
                            <h6 class="media-heading"><a href="#">{{ $data['name'] }}</a></h6>
                        </div>
                        <div>
                            
                        </div>
                    </div>
                    <p class="mb-0"> {{ $data['text'] }}</p>
            </div>		                           
		</div>
	</li>
</ul>
