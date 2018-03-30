<script type="text/javascript" language="javascript">

	function limitOptions(oSel, howmany) {
		var opt, i = 0, msg = '', thismany = howmany, toomany = new Array();
		while (opt = oSel.options[i++]) {
			if (opt.selected) --howmany;
			if (howmany < 0) toomany[toomany.length] = opt;
		}
		if (howmany < 0) {
			msg += 'The maximum number of selections allowed in this list is ' + thismany + '.';
			msg += '\n\nPlease observe this limit.\n\n';
			alert(msg);
			i = 0;
			while (opt = toomany[i++]) opt.selected = false;
			return false;
		}
	}

</script>

<h3 class="spage-header"><i class="fa fa-file-text-o"></i> Добавление страницы для пункта меню "{{$mitem->title}}"</h3>
<hr>

<div class="wrapper">

{!! Form::open(['url' => route('pagesAdd', $mitem->id),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}
{!! Form::hidden('permanent', '0' ) !!}
{!! Form::hidden('mitem_id', $mitem->id ) !!}
{!! Form::hidden('redirects_to', URL::previous()) !!}

	@if($mitem->mtype_id == 2)
		<div class="form-group">
			{!! Form::label('name','Название подпункта выпадающего меню :',['class'=>'col-xs-2 control-label']) !!}  
			<div class="col-sm-8">
				{!! Form::text('name', old('name'), ['class'=>'form-control','placeholder'=>'Введите название…']) !!}
			</div>
			<br /><br />
		</div>
	@else
		{!! Form::hidden('name', 'single' ) !!}
	@endif
	@if($mitem->mtype_id == 2)
	<div class="form-group">
		{!! Form::label('alias',' Alias (псевдоним) :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('alias',old('alias'),['class'=>'form-control','placeholder'=>'Псевдоним для ссылки']) !!}
			<small class="help-block">Короткий псевдоним (alias) страницы, необходимый для формирования ссылки. Может состоять из нескольких слов, лучше на латинице. При кириллическом написании псевдоним все равно сохранится как транскрипция на латинице. Например из "наши рекорды" получится "nashi-rekordy"<br />
			</small>
		</div>
		<br /><br />
	</div>
	@else
		{!! Form::hidden('alias', $mitem->alias ) !!}
	@endif

	<div class="form-group">
		{!! Form::label('title','Заголовок :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('title', old('title'), ['class'=>'form-control','placeholder'=>'Введите заголовок…']) !!}
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('desc',' Введение (первая часть статьи) :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<small class="help-block">Введение или первая, самая верхняя часть статьи<br /></small>
			{!! Form::textarea('desc',old('desc'),['class'=>'form-control ckeditor','placeholder'=>'Введите текст…']) !!}
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('excerption','Excerption (выделенный фрагмент) :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<small class="help-block">Excerption - выдержка, выписка, отрывок и т.п. Это выделенный фрагмент, вторая сверху часть статьи<br /></small>
			{!! Form::textarea('excerption',old('excerption'),['class'=>'form-control ckeditor','placeholder'=>'Введите текст…']) !!}
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('text','Основной текст :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::textarea('text',old('text'),['class'=>'form-control ckeditor','placeholder'=>'Введите текст…']) !!}
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('img', 'Изображение:',['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::file('img', ['class' => 'filestyle', 'data-buttonText'=>'&nbsp;&nbsp;Выберите изображение', 'data-buttonName'=>"btn-info", 'data-iconName'=>'fa fa-image'  ,'data-placeholder'=>"Файла нет"] ) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('keywords', 'Ключевые слова:',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::text('keywords', old('keywords'), ['class' => 'form-control','placeholder'=>'Введите keywords']) !!}
			<small class="help-block">Ключевые слова для поисковых систем (до 255 символов)</small>
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('meta_desc', 'Meta-описание:',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::text('meta_desc', old('meta_desc'), ['class' => 'form-control','placeholder'=>'Введите Meta-description']) !!}
			<small class="help-block">Краткое описание для продвижения в поисковых системах (до 255 символов)</small>
		</div>
	</div>

	<hr>
	<h4><i class="fa fa-cubes"></i> Дополнительные блоки и виджеты на данной странице.</h4>
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
					{{-- <option value="" selected="">Нет блоков</option> --}}
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
