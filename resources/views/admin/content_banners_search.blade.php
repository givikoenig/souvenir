<h3 class="page-header"><i class="fa fa-file-text-o"></i> Добавление баннера</h3>
<hr>
<div class="wrapper">
	{!! Form::open(['url' => route('bannersSearch',['alias' => $fromctl]),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}
	<div class="form-group">
		{!! Form::label('text', 'Выбор товара для баннера:',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-8">
			<div>
				<input type="text" placeholder="Поиск товара..."  name="keyword" class="form-control" style="width: 30%; float: left;">
				{!! Form::button('<i class="fa fa-search" ></i>', ['class' => 'btn btn-default','type'=>'submit']) !!}
			</div>
		</div>
	</div>
	<br /><br />
	{!! Form::close() !!}
	@if (!is_null($keyword))
		@if ($fromctl && $fromctl == 'upcommings')
			{!! Form::open(['url' => route('upcommingsAdd'),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}
		@else
			{!! Form::open(['url' => route('bannersAdd'),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}
		@endif
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th> ID</th>
					<th> Артикул</th>
					<th><i class="fa fa-link"></i> Наименование</th>
					<th><i class="fa fa-rouble"></i> Цена</th>
					<th class="text-center"><i class="fa fa-image"></i> Изображение</th>
					<th><i class="fa fa-calendar-o"></i> Дата</th>
					<th><i class="fa fa-cogs"></i> Выбрать</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($searches as $link)
					<tr>
						<td>{{ $link['id'] }}</td>
						<td>{{ $link['articul'] }}</td>
						<td class="a-active">{!! Html::link( route('product',$link['id']), $link['name'], ['alt'=>$link['name'], 'target' => '_blank' ] ) !!}</td>
						<td>{{ $link['price'] }}</td>
						<td class="text-center">
							<img src="{{ asset('assets')}}/img/product/{{ json_decode($link['images'], true)['min'] }}" alt="" width="75">
						</td>
						<td>{!! $link['created_at'] !!}</td>
						<td>
							<input type="hidden" name="prod_id" value="{{$link['id']}}">
							{!! Form::button('<i class="fa fa-check" ></i>', ['class' => 'btn btn-success','type'=>'submit', 'title' => 'Выбрать' ]) !!}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{!! Form::close() !!}
	@endif
</div>
