@set($is_alias,Route::current()->alias)
@if ($is_alias)
    @set ( $brandid, \App\Brand::where('alias',$is_alias)->first()->id )
@endif

@set($is_subalias, Route::current()->subalias)
@if ($is_subalias)
    @set( $subbrandid, \App\Subbrand::where('alias',$is_subalias)->first()->id )
@endif

@if(isset($products))

		<div class="col-md-9 col-md-push-3 col-sm-12">
			<div class="row">
				<div class="col-sm-5">
					<h4 class="spage-header"><i class="{{ $is_alias ? 'fa fa-bookmark-o' : 'fa fa-shopping-bag' }}"></i>
						{{ $is_alias ? ' Категория: ' .\App\Brand::where('alias',$is_alias)->first()->name : ' Все товары' }}
					</h4>
					<h4 class="spage-header"><i class="{{ $is_subalias ? 'fa fa-folder-o' : '' }}"></i>
                        {{ $is_subalias ? ' Субкатегория: ' .\App\Subbrand::where('alias',$is_subalias)->first()->name : '' }}
					</h4>
				</div>
				<div class="col-sm-7" style="padding-left: 60px;">
					{{ $products->links('vendor.pagination.bootstrap-4') }}
				</div>
			</div>
			<hr>
			<div class="text-right">
				<small>Показано : {{$products->firstItem() .'-'. $products->lastItem() }} из {{$products->total()}}</small>
			</div>

			<div class="text-center">
				@if ($is_alias && $is_subalias)
				<a class="btn btn-info" href="{{route( 'productsAdd', ['brandid' => $brandid, 'subbrandid' => $subbrandid] )}}" title="Add Product"><span class="fa fa-plus"></span> Добавить товар</a>
				@else
				<a class="btn btn-info btn-disabled" href="javascript: void()" title="Add Product"><span class="fa fa-close"></span> Нельзя добавить товар. Не выбрана субкатегория.</a>
				<small class="help-block"><span style="color: #ff0000;">Внимание! </span> При добавлении товара его нельзя отнести напрямую к категории, минуя субкатегорию. <br />
					Если субкатегории еще нет, то добавьте ее в разделе "Магазин->Субкатегории".
				</small>
				@endif
			</div>
			<br />

			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th><i class="fa fa-sort-numeric-asc"></i> ID</th>
						<th><i class="fa fa-flag-o"></i> Название</th>
						<th><i class="fa fa-star-o"></i> Артикул</th>
						<th><i class="fa fa-rouble"></i> Цена</th>
						<th><i class="fa fa-image"></i> Изображение</th>
						<th><i class="fa fa-calendar-o"></i> Дата</th>
						<th colspan="2"><i class="fa fa-cogs"></i> Действие</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($products as $product)
						<tr>
							<td>{{ $product->id }}</td>
							<td><a href="{{ route('prodEdit', ['prod' => $product->id ] ) }}">{{ $product->name }}</a></td>
							<td>{{ $product->articul }}</td>
							<td>{{ $product->price }}</td>
							<td><img src="{{asset('assets')}}/img/product/{{ json_decode($product->images,true)['med'] }}" alt="" width="50" /></td>
							<td>{{ $product->created_at->format('d-m-Y') }}</td>
							<td>
		                        <a class="btn btn-success" href="{{ route('prodEdit', $product->id) }}"><i class="fa fa-edit" title="Редактировать"></i></a>
		                 </td>
		                <td>
		                    {!! Form::open(['url'=>route('prodEdit',['prod'=>$product->id]), 'class'=>'form-horizontal', 'method'=>'POST']) !!}
		                    {!! Form::hidden('id', $product->id ) !!}
		                    {!! Form::hidden('subbrand_id', $product->subbrand->id ) !!}
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
				@if ($is_alias && $is_subalias)
				<a class="btn btn-info" href="{{route( 'productsAdd', ['brandid' => $brandid, 'subbrandid' => $subbrandid] )}}" title="Add Product"><span class="fa fa-plus"></span> Добавить товар</a>
				@else
				<a class="btn btn-info btn-disabled" href="javascript: void()" title="Add Product"><span class="fa fa-close"></span> Нельзя добавить товар. Не выбрана субкатегория.</a>
				<small class="help-block"><span style="color: #ff0000;">Внимание! </span> При добавлении товара его нельзя отнести напрямую к категории, минуя субкатегорию. <br />
					Если субкатегории еще нет, то добавьте ее в разделе "Магазин->Субкатегории".
				</small>
				@endif
			</div>

		</div>

		<div class="col-md-3 col-md-pull-9 col-sm-12" style="height: 650px; overflow-y: scroll; scroll-behavior: smooth;" >
			<h4 class="widget-title">Категории товаров</h4>
			<div class="product-cat">
				<ul>
					<br />
					<li {{ (basename(request()->path() ) == 'prods') ? 'class=products-active' : '' }}><a href="{{ route('products') }}"> Все товары ({{$products_count}})</a></li>
					@foreach ($brands as $brand)
					<br />
					<li {{ (basename(request()->path() ) == $brand->alias && is_null(request()->segment(4)) ) ? 'class=products-active' : '' }}><a href="{{ route('products', $brand->alias) }}">{{ $brand->name }} </a>
						<ul>
							@foreach ($brand->subbrands as $subbrand)
							<li {{ basename(request()->path() ) == $subbrand->alias ? 'class=products-active' : ''  }} ><a href="{{ route('products', [$brand->alias, $subbrand->alias] ) }}">- {{ $subbrand->name }} ({{count($subbrand->products)}})</a></li>
							@endforeach
						</ul>
					</li> 
					@endforeach
				</ul>
			</div>
		</div>
		

@endif