<h3 class="page-header"><i class="fa fa-file-text-o"></i> Редактирование блока UPCOMMING </h3>
<hr>

	<div class="wrapper">

		{!! Form::open(['url' => route('upcommingEdit',array('upcomming'=>$data['id'])),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}
		{!! Form::hidden('id', $data['id']) !!}

		<div class="form-group">
			{!! Form::label('old_img_362x350', 'Текущее изображение upcomming-а:',['class'=>'col-xs-2 control-label']) !!}
			<div class="col-sm-offset-2 col-sm-10">
				{!! Html::image('assets/img/up-comming/'.$data['img_362x350'],'',['class'=>'img-responsive','width'=>'180px']) !!}
				{!! Form::hidden('old_img_362x350', $data['img_362x350']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('img_362x350', 'Изменить изображение upcomming-а:',['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
				{!! Form::file('img_362x350', ['class' => 'filestyle', 'data-buttonText'=>'&nbsp;&nbsp;Выберите изображение', 'data-buttonName'=>"btn-info", 'data-iconName'=>'fa fa-image'  ,'data-placeholder'=>"Файла нет"] ) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('title','Заголовок upcomming-а:',['class'=>'col-xs-2 control-label']) !!}  
			<div class="col-sm-8">
				{!! Form::text('title',$data['title'],['class'=>'form-control','placeholder'=>'Введите заголовок…']) !!}
				<small class="help-block">Короткий заголовок".</small>
			</div>
			<br /><br />
		</div>
		<div class="form-group">
			{!! Form::label('text', 'Текст upcomming-а:',['class'=>'col-xs-2 control-label']) !!}
			<div class="col-sm-8">
				<br />
				<small class="help-block">Небольшой рекламный текст (описание планируемого события, слоган, тезис, часть описания товара и т.п.)</small><br />
				{!! Form::textarea('text', $data['text'], ['class' => 'form-control','placeholder'=>'Рекламный текст', 'rows' => 3]) !!}
			</div>
			<br /><br />
		</div>
		<div class="form-group">
		{!! Form::label('until_date', 'Время таймера upcomming-а:',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-8">
			<small class="help-block">Дата наступления события</small><br />
			<input id="datepicker" class="form-control" name="until_date" type="text" value="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data['until_date'])->format('m/d/Y') }}" placeholder="Щелкните для выбора даты…" required=""  style="width: 27.4%; cursor: pointer;">
		</div>
		<br /><br />
	</div>

	<div class="form-group">
		{!! Form::label('link','Ссылка upcomming-а:',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('link',$data['link'],['class'=>'form-control','placeholder'=>'Введите ссылку…']) !!}
			<small class="help-block">Скопируйте нужную ссылку в браузере и вставьте сюда</small>
		</div>
		<br /><br />
	</div>

	<hr>

	<div class="form-group">
		{!! Form::label('banner_text', 'Текст баннера:',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-8">
			<small class="help-block">5 пар слов небольшого рекламного текста (напр. характиристики товара и т.п.)</small><br />
			{!! Form::textarea('banner_text', $data['banner_text'], ['class' => 'form-control','placeholder'=>'Рекламный текст', 'rows' => 3]) !!}
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('old_banner_image', 'Текущее изображение:',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-offset-2 col-sm-10">
			{!! Html::image('assets/img/banner/'.$data['banner_image'],'',['class'=>'img-responsive','width'=>'180px']) !!}
			{!! Form::hidden('old_banner_image', $data['banner_image']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('banner_image', 'Изменить изображение:',['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::file('banner_image', ['class' => 'filestyle', 'data-buttonText'=>'&nbsp;&nbsp;Выберите изображение', 'data-buttonName'=>"btn-info", 'data-iconName'=>'fa fa-image'  ,'data-placeholder'=>"Файла нет"] ) !!}
		</div>
	</div>

		<div class="form-group text-center">
			<div class="col-sm-offset-2 col-sm-8">
				{!! Form::button('Сохранить', ['class' => 'btn btn-info','type'=>'submit']) !!}
			</div>
		</div>

		{!! Form::close() !!}

	</div>