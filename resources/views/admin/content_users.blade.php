@if(isset($users))

<div class="col-md-10 col-md-push-2 col-sm-12">

	<div class="row">
		<div class="col-sm-5">
			@if ( basename(request()->path() ) == 'admins' )
			<h3 class="spage-header"><i class="fa fa-hand-o-up"></i> Администраторы</h3>
			@elseif ( basename(request()->path() ) == 'editors' )
			<h3 class="spage-header"><i class="fa fa-pencil-square-o"></i> Редакторы</h3>
			@elseif ( basename(request()->path() ) == 'commenters' )
			<h3 class="spage-header"><i class="fa fa-user-circle-o"></i> Зарегистрированные</h3>
			@elseif ( basename(request()->path() ) == 'guests' )
			<h3 class="spage-header"><i class="fa fa-user-secret"></i> Покупатели</h3>
			@else
			<h3 class="spage-header"><i class="fa fa-users"></i> Все</h3>
			@endif
		</div>
		<div class="col-sm-7" style="padding-left: 60px;">
			{{ $users->links('vendor.pagination.bootstrap-4') }}
		</div>
	</div>
	<hr>

	<div class="text-center">
		<a class="btn btn-info" href="{{route( 'userAdd')}}" title="Add User"><span class="fa fa-plus"></span> Добавить пользователя </a>
	</div>
	<br />

	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th><i class="fa fa-sort-numeric-asc"></i> ID</th>
				<th><i class="fa fa-user-secret"></i> Nickname</th>
				<th><i class="fa fa-file-image-o"></i> Аватара</th>
				<th><i class="fa fa-user-o"></i> Ф.И.О.</th>
				<th><i class="fa fa-phone"></i> Телефон</th>
				<th><i class="fa fa-envelope-o"></i> Email</th>
				<th><i class="fa fa-calendar-o"></i> Дата регистрации</th>
				<th colspan="2"><i class="fa fa-cogs"></i> Действие</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
			<tr>
				<td>{{$user->id}}</td>
				<td>{{$user->name}}</td>
				<td>
					@if ($user->avatar)
					<img src="{{ asset('assets')}}/img/author/{{ $user->avatar}}" alt="avatar" width="45">
					@endif
				</td>
				<td>{{$user->fio}}</td>
				<td>{{$user->phone}}</td>
				<td><a href="mailto:{{ $user->email }}?Subject=Заказ%20через%20Интернет-магазин" target="_top"> {{ $user->email }}</a></td>
				<td>{{$user->created_at}}</td>
				<td>
					<a class="btn btn-success" href="{{ route('userEdit', ['user' => $user->id] ) }}" title="Редактировать"><i class="fa fa-edit" ></i></a>
				</td>
				<td>
					{!! Form::open(['url'=>route('userEdit',['user'=>$user->id]), 'class'=>'form-horizontal', 'method'=>'POST']) !!}
					{!! Form::hidden('id', $user->id ) !!}
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
		<a class="btn btn-info" href="{{route( 'userAdd')}}" title="Add User"><span class="fa fa-plus"></span> Добавить пользователя </a>
	</div>
</div>

<div class="col-md-2 col-md-pull-10 col-sm-12" style="height: 350px; overflow-y: scroll; scroll-behavior: smooth;">
	<h4 class="widget-title">Пользователи сайта по ролям</h4>
	<div class="product-cat" style="margin-left: -20px;">
		<ul>
			<br />
			<li {{ (basename(request()->path() ) == 'users') ? 'class=products-active' : '' }}><a href="{{ route('users') }}"> Все ({{ $all_count }})</a></li>
			<li {{ (basename(request()->path() ) == 'guests'  ) ? 'class=products-active' : '' }}><a href="{{ route('users', ['role' => 'guests']) }}"> Покупатели ({{ $guests_count }})</a></li>
			<li {{ (basename(request()->path() ) == 'commenters'  ) ? 'class=products-active' : '' }}><a href="{{ route('users', ['role' => 'commenters']) }}"> Зарегистрированные ({{ $commenters_count }})</a></li>
			<li {{ (basename(request()->path() ) == 'editors'  ) ? 'class=products-active' : '' }}><a href="{{ route('users', ['role' => 'editors']) }}"> Редакторы ({{ $editors_count }})</a></li>
			<li {{ (basename(request()->path() ) == 'admins'  ) ? 'class=products-active' : '' }}><a href="{{ route('users', ['role' => 'admins']) }}"> Администраторы ({{ $admins_count }})</a></li>
		</ul>
	</div>
</div>

@endif