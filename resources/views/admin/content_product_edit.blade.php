<h3 class="page-header"><i class="fa fa-shopping-bag"></i> Редактирование товара</h3>
<hr>

<div class="wrapper">

{!! Form::open(['url' => route('prodEdit', array('prod'=>$data['id']) ),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data', 'id'=>'prodform' ]) !!}
	{!! Form::hidden('id', $data['id'], array('id' => 'goods_id') ) !!}
	{{-- {!! Form::hidden('id', $data['id']) !!} --}}
	{!! Form::hidden('redirects_to', URL::previous()) !!}

	<div class="form-group">
		{!! Form::label('visible','Показывать на сайте',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<input name="visible" type="checkbox" value="1" {{$data['visible'] ? 'checked' : ''}}>
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('available','Есть в наличии',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<input name="available" type="checkbox" value="1" {{$data['available'] ? 'checked' : ''}}>
		</div>
	</div>

	<div class="form-group">
        {!! Form::label('subbrand_id', 'Субкатегория :',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
			<select name="subbrand_id" class="form-control" style="width: 30%;">
				@foreach ($brands as $brand)
					<option value="" disabled="" style="background: #eeeeee;">{{$brand->name}}</option>
					@if($brand->subbrands)
						@foreach($brand->subbrands as $subbrand)
							<option value="{{$subbrand->id}}" {{ $subbrand->id == $data['subbrand_id'] ? 'selected=""' : '' }}>&nbsp;&nbsp;&nbsp;- {{ $subbrand->name }}</option>
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
			{!! Form::text('name',$data['name'] ,['class'=>'form-control','placeholder'=>'Введите название …']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('articul','Артикул :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('articul',$data['articul'] ,['class'=>'form-control','placeholder'=>'Введите артикул …']) !!}
		</div>
	</div>
	<div class="form-group">
        {!! Form::label('old_images', 'Текущее изображение:',['class'=>'col-xs-2 control-label']) !!}
        <div class="col-sm-offset-2 col-sm-10">
            {!! Html::image('assets/img/product/'.json_decode($data['images'],true )['min'],'',['class'=>'img-responsive','width'=>'80px']) !!}
            {!! Form::hidden('old_images', $data['images']) !!}
        </div>
    </div>
    <div class="form-group">
		{!! Form::label('images', 'Изменить изображение:',['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::file('images', ['class' => 'filestyle', 'data-buttonText'=>'&nbsp;&nbsp;Выберите изображение', 'data-buttonName'=>"btn-info", 'data-iconName'=>'fa fa-image'  ,'data-placeholder'=>"Файла нет"] ) !!}
			<small class="help-block">(Для общего отображения на страницах сайта в группе с другими товарами)</small>
		</div>
	</div>

	<div class="form-group">
        <label for="img_slide[]" class="col-sm-2 control-label">Текущие изображения галереи товара:<br />
            <small>(кликните по картинке для удаления)</small>
         </label>
        <div class="col-sm-offset-2 col-sm-10">
             @if (isset($img_slides))
             <table>
                <tr>
                    <td>
                        
                    </td>
                </tr>
                <tr>
                @foreach($img_slides as $l => $imgslide)
                    <td style="padding-left: 10px;"  class="delimg" >
                        <img src="{{ asset('assets') }}/img/product/slides/{{ $imgslide }}" alt='{{ $imgslide }}' attr-loop="{{ $l }}"  attr-id="{{ $data['id'] }}" attr-route="{{route('delProdSlide',$data['id'])}}" width="50" type="button" style="cursor: pointer;"  class="slideimg slide_{{$l}}">
                    </td>
                @endforeach
                </tr>
             </table>
             <meta name="csrf-token" content="{{csrf_token()}}">
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="galleryimg[]" class="col-sm-2 control-label">Добавить изображение:<br /> </label>
        <div class="col-sm-8" id="btnimg">
            <div><input class="btn btn-sm btn-info" type="file" data-bfi-disabled name="galleryimg[]" /></div>
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
                {!! Form::input('number','price', $data['price'], ['step' => 'any', 'class' => 'form-control', 'style' => 'width:20%', 'placeholder'=>'Введите цену…']) !!}
            </div>
    </div>
    <div class="form-group">
            {!! Form::label('old_price','Прежняя цена [&#8381;]',['class'=>'col-xs-2 control-label']) !!}   
            <div class="col-sm-8">
                {!! Form::input('number','old_price',$data['old_price'], ['step' => 'any', 'class' => 'form-control', 'style' => 'width:20%', 'placeholder'=>'Введите цену…']) !!}
                <small class="help-block">(Для уцененных товаров)</small>
            </div>
    </div>
    <div class="form-group">
		{!! Form::label('anons','Анонс :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<small class="help-block">Краткое описание товара<br /></small>
			{!! Form::textarea('anons', $data['anons'],['class'=>'form-control','placeholder'=>'Введите текст…', 'rows' => 3]) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('content','Описание :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<small class="help-block">Подробное описание товара.<br /></small>
			{!! Form::textarea('content', $data['content'],['class'=>'form-control','placeholder'=>'Введите текст…', 'rows' => 5]) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('techs','Тех.характеристики :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<small class="help-block">Технические характеристики товара<br /></small>
			{!! Form::textarea('techs', $data['techs'],['class'=>'form-control ckeditor','placeholder'=>'Введите текст…']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('hits','Хит продаж',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<input name="hits" type="checkbox" value="1" {{$data['hits'] ? 'checked' : ''}}>
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('sale','Распродажа (уценка)',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<input name="sale" type="checkbox" value="1" {{$data['sale'] ? 'checked' : ''}}>
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('new','Новинка',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<input name="new" type="checkbox" value="1" {{$data['new'] ? 'checked' : ''}}>
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('spec','Спец.предложение',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<input name="spec" type="checkbox" value="1" {{$data['spec'] ? 'checked' : ''}}>
		</div>
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

	<div class="form-group text-center">
        <div class="col-sm-offset-2 col-sm-8">
            {!! Form::button('Сохранить', ['class' => 'btn btn-info','type'=>'submit']) !!}
        </div>
    </div>
{!! Form::close() !!}

</div>

