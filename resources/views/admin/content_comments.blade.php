@if(isset($articles) || isset($searches) )
<div class="row">

	<div class="col-sm-4">
		<h3 class="spage-header"><i class="fa fa-comments-o"></i>{{  !($searches) ? ' Комментарии к статье "' . $articles->items()[0]->title .'"' : ' Поиск статьи' }}</h3>
	</div>
	<div class="col-sm-4" style="padding-left: 60px;">
		{{ !($searches) ? $articles->links('vendor.pagination.bootstrap-4') : '' }}
	</div>

	<div class="col-sm-4">
	<br />
		{!! Form::open(['url' => route('comments'),'class'=>'form-horizontal','method'=>'POST']) !!}
			<input type="text" placeholder="Поиск по названию статьи..."  name="keyword" class="form-control" style="width: 50%; float: left;">
			{!! Form::button('<i class="fa fa-search" ></i>', ['class' => 'btn btn-default','type'=>'submit']) !!}
		{!! Form::close() !!}
		</div>
	

</div>
<hr>

	@if($searches)
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th><i class="fa fa-flag-o"></i> Заголовок</th>
					<th class="text-center"><i class="fa fa-image"></i> Изображение</th>
					<th><i class="fa fa-comments-o"></i> Кол-во комментариев</th>
					<th><i class="fa fa-cogs"></i> Выбрать {{$articles->count()}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($searches as $art)
					@foreach($articles as $key => $val)
						@if($val->alias == $art['alias'])
							@php
								$currentpos = $key + 1;
							@endphp
						@endif
					@endforeach
					<tr>
						{!! Form::open(['url' => url('/admin/comments?page=' . $currentpos ) ] , ['class'=>'form-horizontal','method'=>'POST'] ) !!}
						<td>{{$art['title']}}</td>
						<td>
		                	<a href="{{ route('article',$art['alias']) }}" target="_blank"><img src="{{ asset('assets')}}/img/blog/{{ json_decode($art['img'], true)['mini'] }}" alt="" width="75"></a>
		                </td>
						<td>{!! $articles->where('id', $art['id'])->first()->comments->count() !!}</td>
						<td>
							<input type="hidden" name="id" value="{{$art['id']}}">
							{!! Form::button('<i class="fa fa-check" ></i>', ['class' => 'btn btn-success','type'=>'submit', 'title' => 'Выбрать' ]) !!}
						</td>
						{!! Form::close() !!}
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
	<p style="color: #ff0000;">Внимание !</p>
	<p>В поле "Текст" ответы на комментарии (с отступом слева и значком <i class="fa fa-mail-reply"></i> перед текстом) должны находиться НИЖЕ основных комментариев.</p>
	<p>Если Вы видите, что ответ на комментарий стоит выше всех основных комментариев, то удалите его, чтобы комментарии и ответы на них правильно отображались на странице.</p>
	<p>Такие "оторванные" от комментария ответы могли остаться после удаления основного комментария, к которому они относились.</p>

		<table class="table table-hover table-striped">
			<thead>
				@foreach($articles as $article)
					@if($article->comments->count() > 0)
						<tr>
							<th class="text-center"><i class="fa fa-file-text-o"></i> Текст</th>
							<th class="text-center"><i class="fa fa-user-o"></i> Автор</th>
							<th class="text-center"><i class="fa fa-calendar-o"></i> Дата</th>
			                <th class="text-center" colspan="2"><i class="fa fa-cogs"></i> Действие</th>
						</tr>
					@else
						<tr>
							<th class="text-center" colspan="5">К этой статье нет комментариев</th>
						</tr>
					@endif
				@endforeach
			</thead>
			<tbody>
				@foreach($articles as $article)
					@if($article->comments)
						@foreach($article->comments as $comment)
							<tr>
								<td style="padding-left: {{ ($comment['parent_id'] <> 0 ) ? '30px' : 0  }};">{!! ($comment['parent_id'] <> 0 ) ? '<i class="fa fa-mail-reply"></i> ' : ''  !!} {{ str_limit($comment->text, 130) }}</td>
								<td>{{ $comment->user->name }}</td>
								<td>{{ $comment->created_at->format('d-m-Y') }}</td>
								<td>
			                        <a class="btn btn-success" href="{{ route('commentEdit', $comment->id) }}" title="Редактировать"><i class="fa fa-edit" ></i></a>
				                 </td>
				                <td>
				                    {!! Form::open(['url'=>route('commentEdit', $comment->id ), 'class'=>'form-horizontal', 'method'=>'POST']) !!}
				                    {!! Form::hidden('id', $comment->id ) !!}
				                    {{ method_field('delete') }}
				                    {!! Form::button('<i class="fa fa-close"></i>', ['class'=>'btn btn-danger','type'=>'submit','title'=>'Удалить']) !!}
				                    {!! Form::close() !!}
		                		</td>
							</tr>
						@endforeach
					@endif
				@endforeach
			</tbody>
		</table>
	@endif


@endif