<h3 class="page-header"><i class="fa fa-navicon"></i> Добавление пункта главного меню</h3>
<hr>

<div class="wrapper">

{!! Form::open(['url' => route('mitemsAdd'),'class'=>'form-horizontal','method'=>'POST']) !!}

	<div class="form-group">
        {!! Form::label('mtype_id', 'Тип меню :',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
			<select name="mtype_id" class="form-control" style="width: 30%;">
				<option value="1" >SINGLE</option>
				<option value="2" >DROP_DOWN</option>
			</select>
            <small class="help-block">Single - без выпадающего списка (по ссылке будет открываться одна страница) <br />
				Drop Down - с выпадающим списком (будут ссылки на несколько страниц одной тематики)
             </small>
        </div>
    </div>
	<div class="form-group">
		{!! Form::label('title','Заголовок :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('title',old('title'),['class'=>'form-control','placeholder'=>'Введите заголовок темы…']) !!}
		</div>
		<br />
	</div>

	<hr>
		<h4><i class="fa fa-cubes"></i> Дополнительные блоки и виджеты на странице данного пункта меню.</h4>
		<p style="color: #ff0000;">Внимание !</p>
		<p>Расположенные ниже поля формы для дополнительных блоков будут актуальны только если выше был выбран базовый пункт главного меню типа DROP_DOWN. Блоки для страниц из пунктов меню выпадающего списка и для страниц меню типа SINGLE можно будет добавлять непосредственно при создании страниц ("Доп.страницы" &rarr; "Страницы" &rarr; "Добавить")</p>
		<br />
		@if(isset($bottom_available_bl_ids) )
		<div class="form-group">
	        {!! Form::label('bottom_block_id', 'Дополнительный блок внизу страницы:',['class'=>'col-sm-2 control-label']) !!}
	        <div class="col-sm-8">
				<select name="bottom_block_id" class="form-control" style="width: 30%;">
					<option value="" selected="">Нет блока</option>
					@foreach ($bottom_available_blocks as $b_block)
						<option value="{{$b_block->id}}">{{$b_block->name}}</option>
					@endforeach
				</select>
	            <small class="help-block">Блоки BANNER, UP_COMMING_PRODUCT и NEWSLETTER - такие же, как на главной странице. <br />
				Блок GOOGLE_MAP подойдет для указания местоположения (напр. офиса на странице "Контакты").
	             </small>
	        </div>
    	</div>
		@endif

		<br />
		@if(isset($aside_available_bl_ids) )
		<div class="form-group">
	        {!! Form::label('aside_block_id', 'Дополнительные блоки справа на странице:',['class'=>'col-sm-2 control-label']) !!}
	        <div class="col-sm-8">
				<select name="aside_block_id[]" class="form-control" style="width: 30%;" multiple="multiple" onchange="return limitOptions(this, 2)">
					@foreach ($aside_available_blocks as $a_block)
						<option value="{{$a_block->id}}">{{$a_block->name}}</option>
					@endforeach
				</select>
	            <small class="help-block">
					Можно выбрать не более 2-х блоков для отображения справа.<br />
					 Удерживайте нажатой клавишу Ctrl для выбора двух блоков. <br />
					 SALE_PRODUCTS - уцененные товары <br >
					 NEW_PRODUCTS - новинки <br >
					 HITS_PRODUCTS - хиты продаж <br >
					 SPEC_PRODUCTS - спец.предложения
	             </small>
	        </div>
    	</div>
		@endif

	<hr>

	<div class="form-group text-center">
        <div class="col-sm-offset-2 col-sm-8">
            {!! Form::button('Сохранить', ['class' => 'btn btn-info','type'=>'submit']) !!}
        </div>
    </div>

	{!! Form::close() !!}

</div>