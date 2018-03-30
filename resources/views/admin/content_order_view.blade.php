{!! Form::open(['url' => route('orderView',array('order'=>$data['id'])),'class'=>'form-horizontal','method'=>'POST']) !!}
<h3 class="spage-header"><i class="fa fa-first-order"></i> Заказ № {{ $data['order_num'] }}</h3>

<hr>
	<div class="form-group text-center">
		<div class="col-sm-offset-2 col-sm-8">
			<input type="submit" name="ch_status" value="{{ $data['status'] == 0 ? 'Пометить заказ как обработанный' : 'Пометить заказ как необработанный'}}" class="btn btn-info">
			&nbsp;&nbsp;&nbsp;
			<input type="submit" name="just_back" value="Вернуться к списку заказов" class="btn btn-default">
		</div>
	</div>

	<div class="wrapper">
		{!! Form::hidden('id', $data['id']) !!}
		{!! Form::hidden('customer_id', $customer->id) !!}
		{!! Form::hidden('redirects_to', URL::previous()) !!}

		<div class="form-group">
			{!! Form::label('email','Email :',['class'=>'col-xs-2 control-label']) !!}  
			<div class="col-sm-8">
				<h4><a href="mailto:{{ $order->user->email }}?Subject=Заказ%20через%20Интернет-магазин" target="_top"> {{ $order->user->email }}</a></h4>
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('fio','Заказчик:',['class'=>'col-xs-2 control-label']) !!}  
			<div class="col-sm-8">
				{!! Form::text('fio',$customer->fio ,['class'=>'form-control','placeholder'=>'Ф.И.О. заказчика', 'disabled' => '']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('phone','Контактный телефон :',['class'=>'col-xs-2 control-label']) !!}  
			<div class="col-sm-8">
				{!! Form::text('phone',$customer->phone ,['class'=>'form-control','placeholder'=>'Телефон', 'disabled' => '']) !!}
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('delivery_address','Адрес доставки :',['class'=>'col-xs-2 control-label']) !!}  
			<div class="col-sm-8">
				{!! Form::textarea('delivery_address', $data['delivery_address'], ['class'=>'form-control','placeholder'=>'Введите адрес…', 'rows' => 2, 'disabled' => '']) !!}
			</div>
		</div>
		<div class="form-group">
	        {!! Form::label('delivery', 'Способ доставки :',['class'=>'col-sm-2 control-label']) !!}
	        <div class="col-sm-8">
				{!! Form::text('delivery',$delivery ,['class'=>'form-control','placeholder'=>'Способ доставки', 'disabled' => '']) !!}
	        </div>
	    </div>
	    <div class="form-group">
			{!! Form::label('prim','Примечания :',['class'=>'col-xs-2 control-label']) !!}  
			<div class="col-sm-8">
				{!! Form::textarea('prim', $data['prim'],['class'=>'form-control','placeholder'=>'Введите адрес…', 'rows' => 2, 'disabled' => '']) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-8 col-sm-offset-2">
				<hr>
				<h4 class="text-center">Детали заказа</h4>
				<br>
				@if (isset($order->zakaz_tovar))
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th>Товар</th>
								<th>Артикул</th>
								<th>Изображение</th>
								<th>Цена, &#8381;</th>
								<th>Кол-во</th>
								<th>Сумма</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($order->zakaz_tovar as $key => $tovar)
								@php
									$product = App\Product::where('id',$tovar->product_id)->first();
									$tovar_sum = $tovar->price * $tovar->quantity;
								@endphp
								@if(is_object($product))
								<tr>
									<td>{{ $product->name }}</td>
									<td>{{ $product->articul }}</td>
									<td>{!! Html::image('assets/img/product/'.json_decode($product->images,true )['min'],'',['class'=>'img-responsive','width'=>'80px']) !!}</td>
									<td>
										<div class="form-group">
									            <div class="col-sm-8">
									                {!! Form::text('price[]', $tovar->price, ['step' => 'any', 'class' => 'form-control', 'style' => 'width:70%', 'placeholder'=>'Введите цену…', 'disabled' => '']) !!}
									            </div>
									    </div>
									</td>
									<td>
										<div class="form-group">
									            <div class="col-sm-8">
									                {!! Form::text('quantity[]', $tovar->quantity, ['step' => 'any', 'class' => 'form-control', 'style' => 'width:50%', 'placeholder'=>'Кол-во', 'disabled' => '']) !!}
									            </div>
									    </div>
									</td>
									<td>{{ $tovar_sum }}</td>
									{{-- {!! Form::hidden('tovar', $customer->id) !!} --}}
								</tr>
								@endif
							@endforeach
						</tbody>
					</table>
					<div class="row">
						<div class="form-group  text-right">
							<div class="col-sm-9 col-xs-6">
								{!! Form::label('order_total','Сумма заказа :',['class'=>'control-label']) !!}
							</div>
							<div class="col-sm-3 col-xs-6" style="padding-right: 60px;">
								<span class="tovar_sum_red">{{ $order->order_total }}</span>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="form-group  text-right">
							<div class="col-sm-9 col-xs-6">
								{!! Form::label('shipping','Стоимость доставки :',['class'=>'control-label']) !!}
							</div>
							<div class="col-sm-3 col-xs-6">
								{!! Form::text('shipping', $data['shipping'], ['step' => 'any', 'class' => 'form-control', 'style' => 'width:50%;margin-left:40%;', 'placeholder'=>'Стоимость доставки :', 'disabled' => '']) !!}
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="form-group  text-right">
							<div class="col-sm-9 col-xs-6">
								{!! Form::label('order_itogo','Итого :',['class'=>'control-label']) !!}
							</div>
							<div class="col-sm-3 col-xs-6" style="padding-right: 60px;">
								<span class="tovar_sum_red">{{ $order->order_total + $data['shipping'] }}</span>
							</div>
						</div>
					</div>
				@endif
			</div>
		</div>
		
		<div class="form-group text-center">
			<div class="col-sm-offset-2 col-sm-8">
				<input type="submit" name="ch_status" value="{{ $data['status'] == 0 ? 'Пометить заказ как обработанный' : 'Пометить заказ как необработанный'}}" class="btn btn-info">
				&nbsp;&nbsp;&nbsp;
				<input type="submit" name="just_back" value="Вернуться к списку заказов" class="btn btn-default">
			</div>
		</div>		

		{!! Form::close() !!}

	</div>	
