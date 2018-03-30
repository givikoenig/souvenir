@if(isset($brands))
<div class="row">
	<div class="col-sm-5">
		<h3 class="spage-header"><i class="fa fa-folder-o"></i> Субкатегории в категории товаров "{{ $brands->items()[0]->name }}"</h3>
	</div>
	<div class="col-sm-7" style="padding-left: 60px;">
		{{ $brands->links('vendor.pagination.bootstrap-4') }}
	</div>
</div>
<hr>
<p style="color: #ff0000;">Внимание !</p>
<p>При удалении субкатегории нужно иметь в виду, что вместе с ней будут удалены и все относящиеся к ней товары.</p>
<hr>

<div class="text-center">
	<a class="btn btn-info" href="{{route( 'subbrandsAdd', $brands->items()[0]->id )}}" title="Add Subbrand"><span class="fa fa-plus"></span> Добавить субкатегорию</a>
</div>
<br />

<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th><i class="fa fa-sort-numeric-asc"></i> ID</th>
			<th><i class="fa fa-flag-o"></i> Название</th>
			<th><i class="fa fa-tags"></i> Псевдоним</th>
			<th><i class="fa fa-star-half-o"></i> Кол-во товаров</th>
			<th><i class="fa fa-calendar-o"></i> Дата</th>
			<th colspan="2"><i class="fa fa-cogs"></i> Действие</th>
		</tr>
	</thead>
	<tbody>
		@foreach($brands as $brand)
			@if($brand->subbrands)
				@foreach($brand->subbrands as $subbrand)
					<tr>
						<td>{{ $subbrand->id }}</td>
						<td><a href="{{route('subbrandEdit',['subbrand'=>$subbrand->id])}}">{{ $subbrand->name }}</a></td>
						<td>{{ $subbrand->alias }}</td>
						<td>{{ $subbrand->products->count() }}</td>
						<td>{{ $subbrand->created_at ? $subbrand->created_at->format('d-m-Y') : $subbrand->created_at }}</td>
						<td>
	                        <a class="btn btn-success" href="{{ route('subbrandEdit', $subbrand->id) }}"><i class="fa fa-edit" title="Редактировать"></i></a>
		                 </td>
		                <td>
		                    {!! Form::open(['url'=>route('subbrandEdit',['subbrand'=>$subbrand->id]), 'class'=>'form-horizontal', 'method'=>'POST']) !!}
		                    {!! Form::hidden('id', $subbrand->id ) !!}
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
	<a class="btn btn-info" href="{{route( 'subbrandsAdd', $brands->items()[0]->id )}}" title="Add Subbrand"><span class="fa fa-plus"></span> Добавить субкатегорию</a>
</div>

@endif