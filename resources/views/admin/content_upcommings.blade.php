<h3 class="page-header"><i class="fa fa-file-text-o"></i> Upcomming + баннер</h3>
<hr>
<p>Блок состоит из двух частей. Левая - широкая - т.н. Upcomming, т.е. реклама предстоящего события, ожидаемого в продажу товара, запуска новой линейки товаров и т.п., с устанавливаемым временем таймера обратного отсчета. Правая часть блока - собственно баннер, реклама одного товара из каталога.</p>
<p>При добавлении блока сначала через появившееся поисковое окно выбирается товар для правой части (поиск по названию товара, артикулу, цене или тех.характеристикам), затем заполняется форма для остальных элементов блока, как баннера, так и upcomming-а</p>
<p>Изображение для баннера должно заготавливаться отдельно от изображений раздела "Товары".</p>
<p>Размер изображения: 370х280 пикселей со смещением вправо, с таким расчетом, чтобы текстовые элементы блока (название товара, рекламный текст, цена) не накладывались на изображение.</p>
<p>Изображение для upcomming-а специально готовить не нужно, его размеры формируются автоматически</p>

<hr>
@if (!$upcommings)

<div class="text-center">
	<a class="btn btn-info" href="{{route('bannersSearch',['alias' =>'upcommings'])}}" title="Добавить баннер"><span class="fa fa-plus"></span> Добавить баннер</a>
</div>
@else
<br />
<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th><i class="fa fa-sort-numeric-asc"></i> ID</th>
			<th><i class="fa fa-flag-o"></i> Up-title</th>
			<th class="text-center"><i class="fa fa-image"></i> Up-img</th>
			<th><i class="fa fa-file-text-o"></i> Up-text</th>
			<th><i class="fa fa-calendar-o"></i> Up-until-date</th>
			<th><i class="fa fa-link"></i> Up-link</th>
			<th class="text-center"><i class="fa fa-image"></i> Ban-img</th>
			<th><i class="fa fa-file-text-o"></i> Ban-text</th>
			<th><i class="fa fa-link"></i> Ban-prod</th>
			<th><i class="fa fa-calendar-o"></i> Date</th>
			<th colspan="2"><i class="fa fa-cogs"></i> Action</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>{{ $upcommings->id }}</td>
			<td>{{ $upcommings->title }}</td>
			<td>
				<a href="{{ route('upcommingEdit', $upcommings->id) }}"><img src="{{ asset('assets')}}/img/up-comming/{{ $upcommings->img_362x350 }}" alt="upcomming-img" width="75"></a>
			</td>
			<td>{{ str_limit($upcommings->text, 250) }}</td>
			<td>{{$upcommings->until_date->format('Y/m/d') }}</td>
			<td>{{ $upcommings->link }}</td>
			<td>
				<a href="{!! $upcommings->link !!}"><img src="{{ asset('assets')}}/img/banner/{{ $upcommings->banner_image }}" alt="banner-img" width="75"></a>
			</td>
			<td>{{ $upcommings->banner_text }}</td>
			<td>{{ $upcommings->product->name }}</td>
			<td>{{ $upcommings->created_at }}</td>
			<td>
				<a class="btn btn-success" href="{{ route('upcommingEdit', $upcommings->id) }}"><i class="fa fa-edit" ></i></a>
			</td>
			<td>
				{!! Form::open(['url'=>route('upcommingEdit',['upcomming'=>$upcommings->id]), 'class'=>'form-horizontal', 'method'=>'POST']) !!}
				{!! Form::hidden('id', $upcommings->id ) !!}
				{{ method_field('delete') }}
				{!! Form::button('<i class="fa fa-close"></i>', ['class'=>'btn btn-danger','type'=>'submit']) !!}
				{!! Form::close() !!}
			</td>
		</tr>
</tbody>
</table>
@endif