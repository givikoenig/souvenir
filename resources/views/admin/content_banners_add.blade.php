<h3 class="page-header"><i class="fa fa-file-text-o"></i> Добавление баннера</h3>
<hr>
<div class="wrapper">
	{!! Form::open(['url' => route('bannersAdd'),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}
	<div class="form-group">
		{!! Form::label('position','Позиция блока:',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<input type="text" name="position" value="{{$manqued}}" class="form-control text-center" readonly="" style="width: 10%;">
			<small class="help-block">( слева направо )</small>
		</div>
		<br />
	</div>
	<div class="form-group">
		{!! Form::label('product_id','ID товара:',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<input type="text" name="product_id" value="{{$prod_id}}" class="form-control text-center" readonly="" style="width: 10%;">
		</div>
		<br />
	</div>
	<div class="form-group">
		{!! Form::label('images', 'Изображение:',['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::file('images', ['class' => 'filestyle', 'data-buttonText'=>'&nbsp;&nbsp;Выберите изображение', 'data-buttonName'=>"btn-info", 'data-iconName'=>'fa fa-image'  ,'data-placeholder'=>"Файла нет"] ) !!}
		</div>
	</div>
	@if ($manqued == 2)
	<div class="form-group">
		{!! Form::label('text', 'Текст:',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-8">
			<small class="help-block">Небольшой рекламный текст (слоган, тезис, часть описания товара и т.п.)</small><br />
			{!! Form::textarea('text', old('text'), ['class' => 'form-control','placeholder'=>'Рекламный текст']) !!}
			<small class="help-block">( не менее 10 слов )</small>
		</div>
		<br /><br />
	</div>
	@endif
	<div class="form-group text-center">
		<div class="col-sm-offset-2 col-sm-8">
			{!! Form::button('Сохранить', ['class' => 'btn btn-info','type'=>'submit']) !!}
		</div>
	</div>
	{!! Form::close() !!}
</div>