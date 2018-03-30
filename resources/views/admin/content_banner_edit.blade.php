<h3 class="page-header"><i class="fa fa-file-text-o"></i> Редактирование блока баннера </h3>
<hr>

	<div class="wrapper">

		{!! Form::open(['url' => route('bannerEdit',array('banner'=>$data['id'])),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}
		{!! Form::hidden('id', $data['id']) !!}

		<div class="form-group">
			{!! Form::label('old_images', 'Текущее изображение:',['class'=>'col-xs-2 control-label']) !!}
			<div class="col-sm-offset-2 col-sm-10">
				{!! Html::image('assets/img/banner/'.$data['images'],'',['class'=>'img-responsive','width'=>'180px']) !!}
				{!! Form::hidden('old_images', $data['images']) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('images', 'Изменить изображение:',['class'=>'col-sm-2 control-label']) !!}
			<div class="col-sm-8">
				{!! Form::file('images', ['class' => 'filestyle', 'data-buttonText'=>'&nbsp;&nbsp;Выберите изображение', 'data-buttonName'=>"btn-info", 'data-iconName'=>'fa fa-image'  ,'data-placeholder'=>"Файла нет"] ) !!}
			</div>
		</div>
		@if ($data['position'] == 2)
		<div class="form-group">
			{!! Form::label('text', 'Текст:',['class'=>'col-xs-2 control-label']) !!}
			<div class="col-sm-8">
				<br />
				<small class="help-block">Небольшой рекламный текст (слоган, тезис, часть описания товара и т.п.)</small><br />
				{!! Form::textarea('text', $data['text'], ['class' => 'form-control','placeholder'=>'Рекламный текст']) !!}
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