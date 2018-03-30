<h3 class="spage-header"><i class="fa fa-file-text-o"></i> Редактирование страницы "{{ $mitem->title }}" <br />
Тип меню: {{ $mitem->mtype_id == 1 ? 'SINGLE' : 'DROP_DOWN' }}</h3>
<hr>
<div class="wrapper">
{!! Form::open(['url' => route('pageEdit',array('page'=>$data['id'])),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}
	{!! Form::hidden('id', $data['id']) !!}
	{!! Form::hidden('redirects_to', URL::previous()) !!}

    @if ($mitem->mtype_id == 2)
    <div class="form-group">
		{!! Form::label('name','Название выпадающего пункта меню :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('name',$data['name'],['class'=>'form-control','placeholder'=>'Название…']) !!}
			<small class="help-block">Актуально только для страниц меню  типа DROP_DOWN</small>
		</div>
		<br /><br />
	</div>
	@endif
	<div class="form-group">
        {!! Form::label('old_img', 'Текущее изображение:',['class'=>'col-xs-2 control-label']) !!}
        <div class="col-sm-offset-2 col-sm-10">
            {!! Html::image('assets/img/others/'.json_decode($data['img'],true )['max'],'',['class'=>'img-responsive','width'=>'200px']) !!}
            {!! Form::hidden('old_img', $data['img']) !!}
        </div>
    </div>
    <div class="form-group">
		{!! Form::label('img', 'Изменить изображение:',['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::file('img', ['class' => 'filestyle', 'data-buttonText'=>'&nbsp;&nbsp;Выберите изображение', 'data-buttonName'=>"btn-info", 'data-iconName'=>'fa fa-image'  ,'data-placeholder'=>"Файла нет"] ) !!}
		</div>
	</div>
	@if ($mitem->mtype_id == 2)
	<div class="form-group">
		{!! Form::label('alias',' Alias (псевдоним) :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('alias',$data['alias'],['class'=>'form-control','placeholder'=>'Псевдоним для ссылки']) !!}
			<small class="help-block">Короткий псевдоним (alias) статьи блога, необходимый для формирования ссылки. Может состоять из нескольких слов, лучше на латинице. При кириллическом написании псевдоним все равно сохранится как транскрипция на латинице. Например из "наши рекорды" получится "nashi-rekordy"<br />
			</small>
		</div>
		<br /><br />
	</div>
	@endif
    <div class="form-group">
		{!! Form::label('title','Заголовок :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('title',$data['title'],['class'=>'form-control','placeholder'=>'Заголовок…']) !!}
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('desc',' Введение (первая часть статьи) :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<small class="help-block">Введение или первая, самая верхняя часть статьи<br /></small>
			{!! Form::textarea('desc',$data['desc'],['class'=>'form-control ckeditor','placeholder'=>'Введите текст…']) !!}
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('excerption','Excerption (выделенный фрагмент) :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<small class="help-block">Excerption - выдержка, выписка, отрывок и т.п. Это выделенный фрагмент, вторая сверху часть статьи<br /></small>
			{!! Form::textarea('excerption',$data['excerption'],['class'=>'form-control ckeditor','placeholder'=>'Введите текст…']) !!}
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('text','Основной текст :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::textarea('text',$data['text'],['class'=>'form-control ckeditor','placeholder'=>'Введите текст…']) !!}
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('keywords', 'Ключевые слова:',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::text('keywords', $data['keywords'], ['class' => 'form-control','placeholder'=>'Введите keywords']) !!}
			<small class="help-block">Ключевые слова для поисковых систем (до 255 символов)</small>
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('meta_desc', 'Meta-описание:',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::text('meta_desc', $data['meta_desc'], ['class' => 'form-control','placeholder'=>'Введите Meta-description']) !!}
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