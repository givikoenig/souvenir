<h3 class="page-header"><i class="fa fa-bookmark-o"></i> Категории товаров</h3>

<hr>

<p style="color: #ff0000;">Внимание !</p>
<p>При удалении категории товаров нужно иметь в виду, что вместе с ней будут удалены и все ее подкатегории вместе с товарами, а также слайды с главной страницы, если ссылка на кнопке этих слайдов указывает на данную категорию.</p>
<p>Удалить отдельные подкатегории можно в разделе "Магазин->Подкатегории".</p>
<p>Удалить отдельные товары можно в разделе "Магазин->Товары".</p>
<hr>

<div class="text-center">
	<a class="btn btn-info" href="{{route('brandsAdd')}}" title="Add Brand"><span class="fa fa-plus"></span> Добавить категорию</a>
</div>
<br />

@if(isset($brands))
<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th><i class="fa fa-sort-numeric-asc"></i> ID</th>
			<th><i class="fa fa-flag-o"></i> Название</th>
			<th><i class="fa fa-tags"></i> Псевдоним</th>
			<th><i class="fa fa-calendar-o"></i> Дата</th>
			<th colspan="2"><i class="fa fa-cogs"></i> Действие</th>
		</tr>
	</thead>
	<tbody>
		@foreach($brands as $brand)
			<tr>
				<td>{{ $brand->id }}</td>
				<td><a href="{{ route('brandEdit', $brand->id) }}">{{ $brand->name }}</a></td>
				<td>{{ $brand->alias }}</td>
				<td>{{ $brand->created_at->format('d-m-Y') }}</td>
				<td>
					<a class="btn btn-success" href="{{ route('brandEdit', $brand->id) }}"><i class="fa fa-edit" title="Редактировать"></i></a>
				</td>
				<td>
					{!! Form::open(['url'=>route('brandEdit',['brand'=>$brand->id]), 'class'=>'form-horizontal', 'method'=>'POST']) !!}
					{{ method_field('delete') }}
					{!! Form::button('<i class="fa fa-close"></i>', ['class'=>'btn btn-danger','type'=>'submit','title'=>'Удалить']) !!}
					{!! Form::close() !!}
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

<br />
<div class="text-center">
	<a class="btn btn-info" href="{{route('brandsAdd')}}" title="Add Brand"><span class="fa fa-plus"></span> Добавить категорию</a>
</div>
@endif