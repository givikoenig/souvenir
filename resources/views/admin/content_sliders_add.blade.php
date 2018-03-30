<h3 class="page-header"><i class="fa fa-file-text-o"></i> Добавление слайда</h3>
<hr>

<div class="wrapper">

{!! Form::open(['url' => route('slidersAdd'),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}

	<div class="form-group">
		{!! Form::label('images', 'Изображение:',['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::file('images', ['class' => 'filestyle', 'data-buttonText'=>'&nbsp;&nbsp;Выберите изображение', 'data-buttonName'=>"btn-info", 'data-iconName'=>'fa fa-image'  ,'data-placeholder'=>"Файла нет"] ) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('price_text','Заголовок 1:',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('price_text',old('price_text'),['class'=>'form-control','placeholder'=>'Введите заголовок']) !!}
			<small class="help-block">Короткий заголовок, например " Новая цена: 100 &#8381; ".<br />
			( Знак рубля на клавиатуре: <code>&amp;#8381;</code> )
			</small>
		</div>
		<br />
	</div>
	<div class="form-group">
		{!! Form::label('h1_text','Заголовок 2:',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('h1_text',old('h1_text'),['class'=>'form-control','placeholder'=>'Введите заголовок']) !!}
			<small class="help-block">Короткий (самый крупный) заголовок, напр. "ПОСЛЕДНИЕ ПОСТУПЛЕНИЯ".</small>
		</div>
		<br />
	</div>
	<div class="form-group">
		{!! Form::label('h2_text','Заголовок 3:',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('h2_text',old('h2_text'),['class'=>'form-control','placeholder'=>'Введите заголовок']) !!}
			<small class="help-block">Короткий (менее крупный) заголовок.</small>
		</div>
		<br />
	</div>

	<div class="form-group">
		{!! Form::label('text', 'Текст:',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-8">
		<small class="help-block">Небольшой рекламный текст (слоган, тезис, часть описания товара и т.п.)</small><br />
			{!! Form::textarea('text', old('text'), ['class' => 'form-control ckeditor','placeholder'=>'Рекламный текст']) !!}
		</div>
		<br /><br />
	</div>

	<div class="form-group">
		{!! Form::label('button_text','Надпись на кнопке:',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('button_text',old('button_text'),['class'=>'form-control','placeholder'=>'Введите текст']) !!}
			<small class="help-block">(До 100 символов).<br />
				Если оставить поле пустым, то кнопка отображаться на слайде не будет.
			</small>
		</div>
		<br /><br />
	</div>

	<div class="form-group">
        {!! Form::label('brand_id', 'Ссылка на категорию:',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
			<select name="brand_id" class="form-control" style="width: 30%;">
				<option value="" selected="">Выберите категорию</option>
				@foreach ($cats as $cat)
					<option value="{{$cat['id']}}">{{$cat['name']}}</option>
				@endforeach
			</select>
            <small class="help-block">
            	Какую категорию товара будет рекламировать слайд (т.е. куда перенаправить после нажатия на кнопку слайда). <br />
            	Если поле "Надпись на кнопке" пустое (т.е. кнопки не будет), то и это поле заполнять не нужно.
            </small>
        </div>
    </div>

	<div class="form-group text-center">
        <div class="col-sm-offset-2 col-sm-8">
            {!! Form::button('Сохранить', ['class' => 'btn btn-info','type'=>'submit']) !!}
        </div>
    </div>

	{!! Form::close() !!}

</div>