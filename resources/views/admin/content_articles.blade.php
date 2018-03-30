@if(isset($categories))
<div class="row">
<div class="col-sm-5">
	<h3 class="spage-header"><i class="fa fa-newspaper-o"></i> Статьи на тему "{{ $categories->items()[0]->title }}"</h3>
</div>
<div class="col-sm-7" style="padding-left: 60px;">
	{{ $categories->links('vendor.pagination.bootstrap-4') }}
</div>
</div>
<hr>

<p style="color: #ff0000;">Внимание !</p>
<p>При удалении статьи блога нужно иметь в виду, что вместе с ней будут удалены и все относящиеся к ней комментарии и "лайки".</p>
<p>Удалить отдельные комментарии можно в разделе "Блог->Комментарии.</p>
<hr>

<div class="text-center">
   <a class="btn btn-info" href="{{route( 'articlesAdd', $categories->items()[0]->id )}}" title="Add Article"><span class="fa fa-plus"></span> Добавить статью в тему</a>
</div>
<br />

	<table class="table table-hover table-striped">
	        <thead>
	            <tr>
	                <th>ID</th>
	                <th><i class="fa fa-flag-o"></i> Заголовок</th>
	                <th><i class="fa fa-file-text-o"></i> Краткий текст</th>
					<th class="text-center"><i class="fa fa-image"></i> Изображение</th>
	                <th><i class="fa fa-user-o"></i> Автор</th>
	                <th><i class="fa fa-calendar-o"></i> Дата</th>
	                <th colspan="2"><i class="fa fa-cogs"></i> Действие</th>
	            </tr>
	        </thead>
	        <tbody>
	        @foreach($categories as $category)
	        	@if($category->articles)
					@foreach($category->articles as $article)
		        	<tr>
		        		<td>{{$article->id}}</td>
		        		<td><a href="{{ route('articleEdit',['article'=>$article->id]) }}">{{$article->title}}</a></td>
		        		<td>{{ str_limit($article->desc, 150) }}</td>
		        		<td>
		                	<a href="{{ route('articleEdit',['article'=>$article->id]) }}"><img src="{{ asset('assets')}}/img/blog/{{ json_decode($article->img, true)['mini'] }}" alt="" width="75"></a>
		                </td>
		                <td>{{$article->user->name}}</td>
		                <td>{{$article->created_at->format('d-m-Y')}}</td>
		                <td>
	                        <a class="btn btn-success" href="{{ route('articleEdit', $article->id) }}"><i class="fa fa-edit" title="Редактировать"></i></a>
		                 </td>
		                <td>
		                    {!! Form::open(['url'=>route('articleEdit',['article'=>$article->id]), 'class'=>'form-horizontal', 'method'=>'POST']) !!}
		                    {!! Form::hidden('id', $article->id ) !!}
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

<br />
<div class="text-center">
   <a class="btn btn-info" href="{{ route('articlesAdd', $categories->items()[0]->id ) }}" title="Add Article"><span class="fa fa-plus"></span> Добавить статью в тему</a>
</div>

@endif