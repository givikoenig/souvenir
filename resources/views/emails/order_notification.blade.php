<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta charset="UTF-8">
      <title>Заказ через Интернет-магазин </title>
   </head>
   <body>

	<h5>Заказ №: {{ $dta['order_id'] }} </h5>
	<h5>Заказчик: {{ $dta['user_fio'] }}</h5>
	<h5>Телефон: {{ $dta['user_phone'] }}</h5>
	<h5>Email: {{ $dta['user_email'] }}
	</h5>
	<h5>Адрес доставки: <span>{{ $dta['user_address'] }}</span></h5>
	@if (isset($dta['user_prim']))
		<p>Примечание: {{ $dta['user_prim'] }}</p>
	@endif
	
	<h5>Заказ:</h5>
	<hr />
	@foreach($dta['cart'] as $key => $value)
		<p> - {{$value->name}}, {{$value->price}} &#8381;, {{$value->qty}} шт. - {{ ($value->price * $value->qty) }} &#8381;</p>
	@endforeach
	<h5>Стоимость товара: {{$dta['cart_total']}} &#8381;</h5>
	<h5>Стоимость доставки: {{$dta['shipping_sum']}} &#8381;</h5>
	<hr />
	<h5>Итого: {{$dta['order_total_sum']}} &#8381;</h5>

	</body>
</html>