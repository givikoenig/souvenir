<h3 class="page-header"><i class="fa fa-file-text-o"></i> Баннер - I</h3>
<hr>

<p>Баннер состоит из трех блоков, каждый из которых рекламирует один конкретный товар. Рекламируемый товар уже должен быть занесен в базу данных в разделе "Товары".</p>
<p>Блоки нумеруются слева направо (Position 1-3)</p>
<p>Блоки 1 и 3 не включают в себя рекламный текст.</p>
<p>Рекламный текст блока 2 должен содержать 5 пар слов, разделенных одиночными пробелами. В смысловом выражении каждая пара является независимой и может представлять из себя краткую (из 2-х слов) характеристику товара. Например:</p>
<p>"оптимальная цена высокое качество ваш выбор отличный подарок новинка сезона "</p>
<p>Изображения для рекламируемых товаров должны заготавливаться отдельно от изображений раздела "Товары".</p>
<p>Размеры изображений: 370х280 пикселей со смещением влево для блока 1 и вправо - для блоков 2 и 3, с таким расчетом, чтобы текстовые элементы блока (название товара, рекламный текст, цена) не накладывались на изображение.</p>
<p>При добавлении нового блока, для правильного формирования ссылок на страницу рекламируемого товара, нужно найти этот товар в появившемся поисковом окне. Поиск товара можно осуществлять по ключевому слову из названия товара, его артикулу, цене или тех.характеристикам.</p>

<hr>
@if (isset($banners))
<div class="text-center">
	@if ($banners->count() < 3)
	<a class="btn btn-info" href="{{route('bannersSearch')}}" title="Добавить баннер"><span class="fa fa-plus"></span> Добавить баннер</a>
	@else 
	<a class="btn btn-info btn-disabled" href="javascript: void()" title="Максимальное количество блоков"><span class="fa fa-close"></span> Блок баннера полностью укомплектован</a>
	@endif
</div>
<br />
<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th><i class="fa fa-sort-numeric-asc"></i> Позиция</th>
			<th><i class="fa fa-file-text-o"></i> Текст</th>
			<th><i class="fa fa-link"></i> Товар</th>
			<th class="text-center"><i class="fa fa-image"></i> Изображение</th>
			<th><i class="fa fa-calendar-o"></i> Дата</th>
			<th colspan="2"><i class="fa fa-cogs"></i> Действие</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($banners as $banner)
		<tr>
			<td>{{ $banner->position }}</td>
			<td>{{ str_limit($banner->text,50) }}</td>
			@if ($banner->product)
			<td>{{$banner->product->name}}</td>
			@else
			<td>Нет</td>
			@endif

			<td>
				@if ($banner->images)
				<a href="{{ route('bannerEdit', $banner->id) }}"><img src="{{ asset('assets')}}/img/banner/{{ $banner->images }}" alt="banner" width="75"></a>
				@endif
			</td>

			<td>{{ $banner->created_at->format('d-m-Y') }}</td>
			<td>
				<a class="btn btn-success" href="{{ route('bannerEdit', $banner->id) }}" title="Редактировать"><i class="fa fa-edit" ></i></a>
			</td>
			<td>
				{!! Form::open(['url'=>route('bannerEdit',['banner'=>$banner->id]), 'class'=>'form-horizontal', 'method'=>'POST']) !!}
				{!! Form::hidden('id', $banner->id ) !!}
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
	@if ($banners->count() < 3)
	<a class="btn btn-info" href="{{route('bannersSearch')}}" title="Добавить баннер"><span class="fa fa-plus"></span> Добавить баннер</a>
	@else 
	<a class="btn btn-info btn-disabled" href="javascript: void()" title="Максимальное количество блоков"><span class="fa fa-close"></span>  Блок баннера полностью укомплектован</a>
	@endif
</div>