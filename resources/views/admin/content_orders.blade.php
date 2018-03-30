@if(isset($orders))

<div class="col-md-10 col-md-push-2 col-sm-12">

	<div class="row">
		<div class="col-sm-5">
			@if ( basename(request()->path() ) == 'new' )
			<h3 class="spage-header"><i class="fa fa-exclamation-circle"></i> Новые заказы</h3>
			@elseif ( basename(request()->path() ) == 'old' )
			<h3 class="spage-header"><i class="fa fa-check-square-o"></i> Обработанные заказы</h3>
			@else
			<h3 class="spage-header"><i class="fa fa-first-order"></i> Заказы</h3>
			@endif
		</div>
		<div class="col-sm-7" style="padding-left: 60px;">
			{{ $orders->links('vendor.pagination.bootstrap-4') }}
		</div>
	</div>
	<hr>


	<table class="table table-hover table-striped">
		<thead>
			<tr>
				{{-- <th><i class="fa fa-sort-numeric-asc"></i> ID</th> --}}
				<th><i class="{{-- fa fa-flag-o --}}"></i> № заказа</th>
				<th><i class="fa fa-rouble"></i> Сумма заказа</th>
				<th><i class="fa fa-user-o"></i> Заказчик</th>
				<th><i class="fa fa-phone"></i> Телефон</th>
				<th><i class="fa fa-envelope-o"></i> Email</th>
				<th><i class="fa fa-calendar-o"></i> Дата</th>
				<th><i class="fa fa-truck"></i> Способ доставки</th>
				<th><i class="fa fa-check-square-o"></i> Статус</th>
				<th colspan="3"><i class="fa fa-cogs"></i> Действие</th>
			</tr>
		</thead>
		<tbody>
			@foreach($orders as $order)
			<tr>
				<td>{{ $order->order_num }}</td>
				<td>{{ $order->order_total }} </td>
				<td>{{ $order->user->fio }} </td>
				<td>{{ $order->user->phone }} </td>
				<td><a href="mailto:{{ $order->user->email }}?Subject=Заказ%20через%20Интернет-магазин" target="_top"> {{ $order->user->email }}</a></td>
				<td>{{ $order->created_at }} </td>
				<td>{{ $order->delivery->name }} </td>
				<td>{!! $order->status == 0 ? '<i class="fa fa-exclamation-circle text-danger"  title="новый"><small style="font-family:sans-serif"> новый</small></i>' : '<i class="fa fa-check-circle text-success" title="обработан"><small style="font-family:sans-serif"> обработан</small></i>' !!} </td>
				<td>
					<a class="btn btn-info" href="{{ route('orderView', $order->id) }}"><i class="fa fa-eye" title="Смотреть"></i></a>
				</td>
				<td>
					<a class="btn btn-success" href="{{ route('orderEdit', $order->id) }}"><i class="fa fa-edit" title="Редактировать"></i></a>
				</td>
				<td>
					{!! Form::open(['url'=>route('orderEdit',['order'=>$order->id]), 'class'=>'form-horizontal', 'method'=>'POST']) !!}
					{!! Form::hidden('id', $order->id ) !!}
					{{ method_field('delete') }}
					{!! Form::button('<i class="fa fa-close"></i>', ['class'=>'btn btn-danger','type'=>'submit','title'=>'Удалить']) !!}
					{!! Form::close() !!}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	<br />

</div>

<div class="col-md-2 col-md-pull-10 col-sm-12" style="height: 350px; overflow-y: scroll; scroll-behavior: smooth;">
	{{-- {{ basename(request()->path() ) }} --}}
	<h4 class="widget-title">Статус заказов</h4>
	<div class="product-cat">
		<ul>
			<br />
			<li {{ (basename(request()->path() ) == 'new') ? 'class=products-active' : '' }}><a href="{{ route('orders', ['status' => 'new']) }}"> Новые ({{ $ords_new }})</a></li>
			<li {{ (basename(request()->path() ) == 'old'  ) ? 'class=products-active' : '' }}><a href="{{ route('orders', ['status' => 'old']) }}"> Обработанные ({{ $ords_old }})</a></li>
			<li {{ (basename(request()->path() ) == 'orders') ? 'class=products-active' : '' }}><a href="{{ route('orders') }}"> Все ({{ $ords_total }})</a></li>
		</ul>
	</div>
</div>

@endif