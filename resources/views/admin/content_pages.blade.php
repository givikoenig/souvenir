@if (isset($mitems))
<div class="row">
<div class="col-sm-5">
	<h3 class="spage-header"><i class="{{ $mitems->items()[0]->mtype_id == 2 ? 'fa fa-copy' : 'fa fa-file-text-o' }}"></i> Страниц{{ $mitems->items()[0]->mtype_id == 2 ? 'ы' : 'а' }}  пункта меню "{{ $mitems->items()[0]->title }}"<br />
	Тип меню: {{ $mitems->items()[0]->mtype_id == 2 ? 'выпадающее (DROP_DOWN)' : 'одиночное (SINGLE)' }}
	</h3>
</div>
<div class="col-sm-7" style="padding-left: 60px;">
	{{ $mitems->links('vendor.pagination.bootstrap-4') }}
</div>
</div>
<hr>
<div class="text-center">
	@if ($mitems->items()[0]->mtype_id == 1 && is_object( App\Page::where('alias', $mitems->items()[0]->alias )->first() ) )
		<a class="btn btn-info  btn-disabled" href="javascript: void(0)" title="Add Page"><span class="fa fa-close"></span> Нельзя добавлять более одной страницы для пункта меню типа SINGLE</a>
	@else
		<a class="btn btn-info" href="{{route('pagesAdd', ['mitem_id' => $mitems->items()[0]->id ] ) }}" title="Add Page"><span class="fa fa-plus"></span> Добавить страницу</a>
	@endif
</div>
<br />

	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th><i class="fa fa-sort-numeric-asc"></i> ID</th>
				<th><i class="fa fa-navicon"></i> Пункт меню</th>
				<th><i class="fa fa-flag-o"></i> Заголовок</th>
				<th><i class="fa fa-file-text-o"></i> Текст</th>
				<th class="text-center"><i class="fa fa-image"></i> Изображение</th>
				<th><i class="fa fa-calendar-o"></i> Дата</th>
				<th colspan="2"><i class="fa fa-cogs"></i> Действие</th>
			</tr>
		</thead>
		<tbody>

			@foreach ($mitems as $mitem)
				@if($mitem->pages)
					@foreach($mitem->pages as $page)
						@if (!($mitem->mtype_id == 2 && $mitem->alias == $page->alias))
						<tr>
							<td>{{$page->id}}</td>
							<td>{{$mitem->title}}</td>
							<td>{{$page->title}}</td>
							<td>{{ str_limit($page->text, 85 )}}</td>
							<td>
		                	<a href="{{ route('pageEdit',['page'=>$page->id]) }}"><img src="{{ asset('assets')}}/img/others/{{ json_decode($page->img, true)['mini'] }}" alt="" width="100"></a>
		                	</td>
		                	<td>{{$page->created_at->format('d-m-Y')}}</td>
			                <td>
		                        <a class="btn btn-success" href="{{ route('pageEdit', $page->id) }}"><i class="fa fa-edit" title="Редактировать"></i></a>
			                 </td>
			                <td>
			                    {!! Form::open(['url'=>route('pageEdit',['page'=>$page->id]), 'class'=>'form-horizontal', 'method'=>'POST']) !!}
			                    {!! Form::hidden('id', $page->id ) !!}
			                    {{ method_field('delete') }}
			                    {!! Form::button('<i class="fa fa-close"></i>', ['class'=>'btn btn-danger','type'=>'submit','title'=>'Удалить']) !!}
			                    {!! Form::close() !!}
			                </td>
						</tr>
						@endif
					@endforeach
				@endif
			@endforeach
		</tbody>
	</table>


<br />
	@if ($mitems->items()[0]->mtype_id == 2)
		<div class="text-center">
		   <a class="btn btn-info" href="{{route('pagesAdd', ['mitem_id' => $mitems->items()[0]->id ] ) }}" title="Add Page"><span class="fa fa-plus"></span> Добавить страницу</a>
		</div>
	@endif

@endif