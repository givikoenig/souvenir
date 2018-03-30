<h3 class="page-header"><i class="fa fa-user-plus"></i> Добавление пользователя</h3>
<hr>

<div class="wrapper">

{!! Form::open(['url' => route('userAdd'),'class'=>'form-horizontal','method'=>'POST']) !!}
	{!! Form::hidden('redirects_to', URL::previous()) !!}

	<div class="form-group">
		{!! Form::label('name','Nickname :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('name', old('name') ,['class'=>'form-control','placeholder'=>'Введите nickname …']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('fio','Ф.И.О. :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('fio',old('fio') ,['class'=>'form-control','placeholder'=>'Введите Ф.И.О.']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('email','* Email :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('email',old('email') ,['class'=>'form-control','placeholder'=>'Введите Email']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('phone','Телефон :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('phone',old('phone') ,['class'=>'form-control','placeholder'=>'Контактный телефон (10 цифр)']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('address','Адрес доставки :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::textarea('address',old('address') ,['class'=>'form-control','placeholder'=>'Введите адрес…', 'rows' => 2]) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('password','* Пароль :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<small class="help-block">Если оставить поле пустым, то пароль сгенерируется автоматически.</small>
			{!! Form::input('password', 'password' ,old('password') ,['id' => 'password' ,'class'=>'form-control showpassword','placeholder'=>'Введите пароль (не менее 6 символов)…' , 'style' => 'width:50%']) !!}
		</div>
	</div>

	<div class="form-group text-center">
        <div class="col-sm-offset-2 col-sm-8">
            {!! Form::button('Сохранить', ['class' => 'btn btn-info','type'=>'submit']) !!}
        </div>
    </div>

	{!! Form::close() !!}

</div>