<h3 class="page-header"><i class="fa fa-shopping-bag"></i> Добавление товара</h3>
<hr>

<div class="wrapper">

{!! Form::open(['url' => route('productsAdd', ['brandid' => $brandid, 'subbrandid' => $subbrandid] ),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}
{!! Form::hidden('redirects_to', URL::previous()) !!}

	<div class="form-group">
		{!! Form::label('visible','Показывать на сайте',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::checkbox('visible', 1, true); !!}
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('available','Есть в наличии',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::checkbox('available', 1, true); !!}
		</div>
		<br /><br />
	</div>
	<div class="form-group">
        {!! Form::label('subbrand_id', 'Субкатегория товаров :',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
			<select name="subbrand_id" class="form-control" style="width: 30%;">
				@foreach ($brands as $brand)
					<option value="{{-- {{$brand->id}} --}}"  {{-- {{ $brand->id == $brandid ? 'selected=""' : '' }} --}} disabled="" style="background: #eeeeee;">{{$brand->name}}</option>
					@if($brand->subbrands)
						@foreach($brand->subbrands as $subbrand)
							<option value="{{$subbrand->id}}" {{ $subbrand->id == $subbrandid ? 'selected=""' : '' }}>&nbsp;&nbsp;&nbsp;- {{ $subbrand->name }}</option>
						@endforeach
					@endif
				@endforeach
			</select>
            <small class="help-block"><span style="color: #ff0000;">Внимание! </span> Товар нельзя отнести напрямую к категории, минуя субкатегорию. <br />
				Если субкатегории еще нет, то добавьте ее в разделе "Магазин->Субкатегории".
            </small>
        </div>
    </div>
	<div class="form-group">
		{!! Form::label('name','Название товара :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('name',old('name') ,['class'=>'form-control','placeholder'=>'Введите название …']) !!}
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('articul','Артикул :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('articul',old('articul') ,['class'=>'form-control','placeholder'=>'Введите артикул …']) !!}
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('images', 'Изображение:',['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::file('images', ['class' => 'filestyle', 'data-buttonText'=>'&nbsp;&nbsp;Выберите изображение', 'data-buttonName'=>"btn-info", 'data-iconName'=>'fa fa-image'  ,'data-placeholder'=>"Файла нет"] ) !!}
			<small class="help-block">(Для общего отображения на страницах сайта в группе с другими товарами )</small>
		</div>
	</div>

	<div class="form-group">
		<label for="galleryimg[]" class="col-sm-2 control-label">Галерея товара:<br /> <small>(до 10 изображений)</small> </label>
		<div class="col-sm-8" id="btnimg">
			<div><input class="btn btn-sm btn-info" type="file" data-bfi-disabled name="galleryimg[]" /></div>
			<small class="help-block">(Для детального отображения на странице конкретного товара )</small>
		</div>
	</div>

	<div class="form-group">
        <div class="col-sm-offset-2 col-sm-8">
            {!! Form::button('Добавить поле', ['id'=>'add' , 'class' => 'btn btn-sm btn-default']) !!}
            {!! Form::button('Удалить поле', ['id'=>'del' , 'class' => 'btn btn-sm btn-default']) !!}
        </div>
    </div>

	<div class="form-group">
            {!! Form::label('price','Цена [&#8381;]',['class'=>'col-xs-2 control-label']) !!}   
            <div class="col-sm-8">
                {!! Form::input('number','price',old('price'), ['step' => 'any', 'class' => 'form-control', 'style' => 'width:20%', 'placeholder'=>'Введите цену…']) !!}
            </div>
    </div>
    <div class="form-group">
            {!! Form::label('old_price','Прежняя цена [&#8381;]',['class'=>'col-xs-2 control-label']) !!}   
            <div class="col-sm-8">
                {!! Form::input('number','old_price',old('old_price'), ['step' => 'any', 'class' => 'form-control', 'style' => 'width:20%', 'placeholder'=>'Введите цену…']) !!}
                <small class="help-block">(Для уцененных товаров)</small>
            </div>
    </div>
    <div class="form-group">
		{!! Form::label('anons','Анонс :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<small class="help-block">Краткое описание товара<br /></small>
			{!! Form::textarea('anons', old('anons'),['class'=>'form-control','placeholder'=>'Введите текст…', 'rows' => 3]) !!}
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('content','Описание :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<small class="help-block">Подробное описание товара.<br /></small>
			{!! Form::textarea('content', old('content'),['class'=>'form-control','placeholder'=>'Введите текст…', 'rows' => 5]) !!}
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('techs','Тех.характеристики :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<small class="help-block">Технические характеристики товара<br /></small>
			{!! Form::textarea('techs', old('techs'),['class'=>'form-control ckeditor','placeholder'=>'Введите текст…']) !!}
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('hits','Хит продаж',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::checkbox('hits', '1', false); !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('sale','Распродажа (уценка)',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::checkbox('sale', '1', false); !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('new','Новинка',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::checkbox('new', '1', false); !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('spec','Спец.предложение',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::checkbox('spec', '1', false); !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('keywords', 'Ключевые слова:',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::text('keywords', old('keywords'), ['class' => 'form-control','placeholder'=>'Введите keywords']) !!}
			<small class="help-block">Ключевые слова для поисковых систем (до 255 символов)</small>
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('meta_desc', 'Meta-описание:',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::text('meta_desc', old('meta_desc'), ['class' => 'form-control','placeholder'=>'Введите Meta-description']) !!}
			<small class="help-block">Краткое описание для продвижения в поисковых системах (до 255 символов)</small>
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