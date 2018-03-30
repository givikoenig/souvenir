<h3 class="page-header"><i class="fa fa-folder-o"></i> Редактирование пункта меню</h3>
<hr>

<div class="wrapper">
{!! Form::open(['url' => route('mitemEdit',array('mitem'=>$data['id'])),'class'=>'form-horizontal','method'=>'POST']) !!}
	{!! Form::hidden('id', $data['id']) !!}
	{!! Form::hidden('redirects_to', URL::previous()) !!}

	<div class="form-group">
        {!! Form::label('subbrand_id', 'Тип меню :',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
			<select name="mtype_id" class="form-control" style="width: 30%;">
				@if($mtypes)
					@foreach($mtypes as $mtype)
						<option value="{{$mtype->id}}" {{ $mtype->id == $data['mtype_id'] ? 'selected=""' : '' }}>{{ $mtype->name }}</option>
					@endforeach
				@endif
			</select>
            <small class="help-block">SINGLE - без выпадающего списка (по ссылке будет открываться одна страница),<br />
				DROP_DOWN - с выпадающим списком (будут ссылки на несколько страниц одной тематики) 
            </small>
        </div>
    </div>
    <div class="form-group">
		{!! Form::label('title','Заголовок :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('title',$data['title'],['class'=>'form-control','placeholder'=>'Введите заголовок темы…']) !!}
		</div>
		<br />
	</div>

	<hr>
		<h4><i class="fa fa-cubes"></i> Дополнительные блоки и виджеты на странице данного пункта меню.</h4>
		<p style="color: #ff0000;">Внимание !</p>
		<p>Дополнительные блоки страниц для пунктов меню типа SINGLE можно также менять непосредственно при редактировании соответствующей страницы ("Доп.страницы" &rarr; "Страницы" &rarr; Кнопка "Редактировать")</p>
		<br />
		<br />
		@if(isset($bottom_available_bl_ids) )
		<div class="form-group">
	        {!! Form::label('bottom_block_id', 'Дополнительный блок внизу страницы:',['class'=>'col-sm-2 control-label']) !!}
	        <div class="col-sm-8">
				<select name="bottom_block_id" class="form-control" style="width: 30%;">
					<option value="">Нет блока</option>
					@foreach ($bottom_available_blocks as $b_block)
						<option value="{{$b_block->id}}" {{ in_array($b_block->id, $fact_blocks) ? "selected=" : '' }}>{{$b_block->name}}</option>
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
					{{-- <option value="" selected="">Нет блоков</option> --}}
					@foreach ($aside_available_blocks as $a_block)
						<option value="{{$a_block->id}}" {{ in_array($a_block->id, $fact_blocks) ? "selected=" : '' }}>{{$a_block->name}}</option>
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