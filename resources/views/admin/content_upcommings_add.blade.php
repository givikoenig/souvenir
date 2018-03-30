<h3 class="page-header"><i class="fa fa-file-text-o"></i>Добавление баннера</h3>
<hr>
<div class="wrapper">
{!! Form::open(['url' => route('upcommingsAdd'),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}
	<div class="form-group">
		{!! Form::label('img_362x350', 'Изображение upcomming-а:',['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::file('img_362x350', ['class' => 'filestyle', 'data-buttonText'=>'&nbsp;&nbsp;Выберите изображение', 'data-buttonName'=>"btn-info", 'data-iconName'=>'fa fa-image'  ,'data-placeholder'=>"Файла нет"] ) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('title','Заголовок upcomming-а:',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('title',old('title'),['class'=>'form-control','placeholder'=>'Введите заголовок']) !!}
		</div>
		<br />
	</div>
	<div class="form-group">
		{!! Form::label('until_date', 'Время таймера upcomming-а:',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-8">
			<small class="help-block">Дата наступления события</small><br />
			<input id="datepicker" class="form-control" name="until_date" type="text" value="{{ old('until_date') }}" placeholder="Щелкните для выбора даты…" required=""  style="width: 27.4%; cursor: pointer;">
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('text', 'Текст upcomming-а:',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-8">
			<small class="help-block">Небольшой рекламный текст (описание планируемого события, слоган, тезис, часть описания товара и т.п.)</small><br />
			{!! Form::textarea('text', old('text'), ['class' => 'form-control','placeholder'=>'Рекламный текст','rows' => 3]) !!}
		</div>
		<br /><br />
	</div>
	<!-- Accordion Start -->
	<div class="form-group">
		{!! Form::label('banner_text', 'Ссылка upcomming-а:',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-8">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
							<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								Произвольная ссылка
							</a>
						</h4>
					</div>
					<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
							{!! Form::text('link1',old('link1'),['class'=>'form-control','placeholder'=>'Введите ссылку…']) !!}
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingTwo">
						<h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								Ссылка на раздел или статью блога
							</a>
						</h4>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						<div class="panel-body">
							<select name="link2" class="form-control"{{--  style="width: 50%;" --}}>
								<option value="">Выберите статью</option>
								@if (isset($categories))
								@foreach ($categories as $category)
								<option value="{{ route('articles',$category->alias) }}">{{ $category->title }}</option>
								@foreach($category->articles as $article)
								<option value="{{ route('article', $article->alias) }}">&nbsp;&nbsp;&nbsp;- {{ $article->title}}</option>
								@endforeach
								@endforeach
								@endif
							</select>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingThree">
						<h4 class="panel-title">
							<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								Ссылка на динамическую страницу сайта
							</a>
						</h4>
					</div>
					<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
						<div class="panel-body">
							<select name="link3" class="form-control" style="width: 50%;">
								<option value="">Выберите страницу</option>
								@if (isset($mitems))
								@foreach ($mitems as $mitem)
								<option value="{{ route($mitem->alias)}}">{{$mitem->title}}</option>
								@if ($mitem->mtype_id == 2)
								@foreach($mitem->pages as $page)
								@if($page->alias <> $mitem->alias)
								<option value="{{route($mitem->alias, $page->alias)}}">&nbsp;&nbsp;&nbsp;- {{$page->name}}</option>
								@endif
								@endforeach
								@endif
								@endforeach
								@endif
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <!-- Accordion End --> 
    <hr>

    <div class="form-group">
    	{!! Form::label('product_id','ID товара баннера:',['class'=>'col-xs-2 control-label']) !!}  
    	<div class="col-sm-8">
    		<input type="text" name="product_id" value="{{ $prod_id }}" class="form-control text-center"  readonly="" style="width: 10%; float: left;" />
    		<small class="help-block">{{ App\Product::where('id', $prod_id)->first()->name }}</small><br />
    	</div>
    	<br />
    </div>
    <div class="form-group">
    	{!! Form::label('banner_image', 'Изображение баннера:',['class'=>'col-sm-2 control-label']) !!}
    	<div class="col-sm-8">
    		{!! Form::file('banner_image', ['class' => 'filestyle', 'data-buttonText'=>'&nbsp;&nbsp;Выберите изображение', 'data-buttonName'=>"btn-info", 'data-iconName'=>'fa fa-image'  ,'data-placeholder'=>"Файла нет"] ) !!}
    	</div>
    </div>
    <div class="form-group">
    	{!! Form::label('banner_text', 'Текст баннера:',['class'=>'col-xs-2 control-label']) !!}
    	<div class="col-sm-8">
    		<small class="help-block">Небольшой рекламный текст (слоган, тезис, часть описания товара и т.п.)</small><br />
    		{!! Form::textarea('banner_text', old('banner_text'), ['class' => 'form-control','placeholder'=>'Рекламный текст','rows' => 3]) !!}
    		<small class="help-block">( 5 пар слов )</small>
    	</div>
    	<br /><br />
    </div>
    <div class="form-group text-center">
    	<div class="col-sm-offset-2 col-sm-8">
    		{!! Form::button('Сохранить', ['class' => 'btn btn-info','type'=>'submit']) !!}
    	</div>
    </div>
	{!! Form::close() !!}
</div>
