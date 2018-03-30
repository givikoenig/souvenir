<h4 class="spage-header text-center"><i class="fa fa-universal-access"></i> Роли пользователя {{$user->email}}</h4>
<hr>
<div class="row">
<div class="col-sm-8 col-sm-offset-2">
	<table class="table table-hover table-striped stext-center">
		<thead>
			<tr>
				<th class="text-center"><i class="fa fa-universal-access"></i> Роль</th>
				<th class="text-center"><i class="fa fa-file-o"></i> Описание</th>
				<th class="text-center">{{-- <i class="fa fa-cogs"></i>  --}}Да/Нет</th>
			</tr>
		</thead>
		<tbody>
			@if(isset($roles) )
				@foreach($roles as $role)
				{!! Form::open([ 'url' => route('userEdit', ['user'=>$data['id']]), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
				{!! Form::hidden('role_id', $role->id) !!}
				{!! Form::hidden('role_name', $role->name) !!}
				<tr>
					<td>{{ $role->display_name }}</td>
					<td>{{ $role->description }}</td>
					<td>
						@if( $user->hasRole($role->name) ) 
							{{ method_field('detach') }}
			                {!! Form::button('<i class="fa fa-thumbs-o-up"></i>', ['class'=>'btn btn-success','type'=>'submit', 'title'=>'Запретить']) !!}
						@else
							{{ method_field('attach') }}
			                {!! Form::button('<i class="fa fa-thumbs-o-down"></i>', ['class'=>'btn btn-danger','type'=>'submit', 'title'=>'Разрешить']) !!}
						@endif
					</td>
				</tr>
				{!! Form::close() !!}
				@endforeach
			@endif
		</tbody>
	</table>
</div>
</div>
<hr>
<h3 class="spage-header"><i class="fa fa-user-o"></i> Редактирование профиля {{$user->email}}</h3>
<hr>
<div class="wrapper">
{!! Form::open(['url' => route('userEdit', ['user'=>$data['id']]),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data', 'id'=>'prodform' ]) !!}
	{{-- {!! Form::hidden('id', $data['id'], array('id' => 'goods_id') ) !!} --}}
	{!! Form::hidden('id', $data['id']) !!}
	{!! Form::hidden('redirects_to', URL::previous()) !!}

	<div class="form-group">
		{!! Form::label('name','Nickname :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('name',$data['name'] ,['class'=>'form-control','placeholder'=>'Введите nickname …']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('fio','Ф.И.О. :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('fio',$data['fio'] ,['class'=>'form-control','placeholder'=>'Введите Ф.И.О.']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('email','Email :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('email',$data['email'] ,['class'=>'form-control','placeholder'=>'Введите Email']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('phone','Телефон :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('phone',$data['phone'] ,['class'=>'form-control','placeholder'=>'Контактный телефон (10 цифр)']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('address','Адрес доставки :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::textarea('address',$data['address'] ,['class'=>'form-control','placeholder'=>'Введите адрес…', 'rows' => 2]) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('new_password','Изменить пароль :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::password('new_password', ['class'=>'form-control','placeholder'=>'Введите пароль (не менее 6 символов)…' , 'style' => 'width:50%']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('avatar','Текущий аватар :',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-8">
			<img src="{{ asset('assets')}}/img/author/{{ $user->avatar ? $user->avatar : '12.jpg'}}" alt="{{ $user->avatar }}" width="50">
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('avatar','Изменить аватар :',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::file('avatar', ['class' => 'filestyle', 'data-buttonText'=>'&nbsp;&nbsp;Выберите изображение', 'data-buttonName'=>"btn-info", 'data-iconName'=>'fa fa-image'  ,'data-placeholder'=>"Файла нет"] ) !!}
		</div>
	</div>

<div class="form-group text-center">
        <div class="col-sm-offset-2 col-sm-8">
            {!! Form::button('Сохранить', ['class' => 'btn btn-info','type'=>'submit']) !!}
        </div>
    </div>
{!! Form::close() !!}

</div>