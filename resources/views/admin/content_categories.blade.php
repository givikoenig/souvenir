<h3 class="page-header"><i class="fa fa-file-text-o"></i> Темы блога</h3>

<hr>
<p style="color: #ff0000;">Внимание !</p>
<p>При удалении темы блога нужно иметь в виду, что вместе с темой будут удалены все статьи по этой теме со всеми комментариями и "лайками".</p>
<p>Если Вы хотите удалить отдельные статьи из темы, то делайте это в разделе "Блог->Статьи".</p>

<div class="text-center">
   <a class="btn btn-info" href="{{route('categoriesAdd')}}" title="Add Category"><span class="fa fa-plus"></span> Добавить тему</a>
</div>
<br />

@if(isset($categories))
<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th><i class="fa fa-sort-numeric-asc"></i> ID</th>
			<th><i class="fa fa-flag-o"></i> Заголовок</th>
			<th><i class="fa fa-tags"></i> Псевдоним</th>
			<th><i class="fa fa-key"></i> Keywords</th>
			<th><i class="fa fa-search"></i> Meta-description</th>
			<th><i class="fa fa-calendar-o"></i> Date</th>
			<th colspan="2"><i class="fa fa-cogs"></i> Действие</th>
		</tr>
	</thead>
	<tbody>
		@foreach($categories as $category)
			<tr>
				<td>{{ $category->id }}</td>
				<td><a href="{{ route('categoryEdit', $category->id) }}">{{ $category->title }}</a></td>
				<td>{{ $category->alias }}</td>
				<td>{{ $category->keywords }}</td>
				<td>{{ $category->meta_desc }}</td>
				<td>{{ $category->created_at }}</td>
				<td>
					<a class="btn btn-success" href="{{ route('categoryEdit', $category->id) }}"><i class="fa fa-edit" title="Редактировать"></i></a>
				</td>
				<td>
					{!! Form::open(['url'=>route('categoryEdit',['category'=>$category->id]), 'class'=>'form-horizontal', 'method'=>'POST']) !!}
					{{ method_field('delete') }}
					{!! Form::button('<i class="fa fa-close"></i>', ['class'=>'btn btn-danger','type'=>'submit','title'=>'Удалить']) !!}
					{!! Form::close() !!}
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
@endif
<br />
<div class="text-center">
   <a class="btn btn-info" href="{{route('categoriesAdd')}}" title="Add Category"><span class="fa fa-plus"></span> Добавить тему</a>
</div>