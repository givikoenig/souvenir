<h3 class="page-header"><i class="fa fa-twitch"></i> Добавление темы блога</h3>
<hr>

<div class="wrapper">

{!! Form::open(['url' => route('categoriesAdd'),'class'=>'form-horizontal','method'=>'POST']) !!}

	<div class="form-group">
		{!! Form::label('title','Заголовок :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('title',old('title'),['class'=>'form-control','placeholder'=>'Введите заголовок темы…']) !!}
		</div>
		<br />
	</div>
	<div class="form-group">
		{!! Form::label('alias','Alias (псевдоним):',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('alias',old('alias'),['class'=>'form-control','placeholder'=>'Введите alias']) !!}
			<small class="help-block">Короткий псевдоним (alias) темы блога, необходимый для формирования ссылки. Может состоять из нескольких слов, лучше на латинице. При кириллическом написании псевдоним все равно сохранится как транскрипция на латинице. Например из "наши рекорды" получится "nashi-rekordy"<br />
			</small>
		</div>
		<br />
	</div>
	<div class="form-group">
		{!! Form::label('keywords','Keywords (ключевые слова) :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('keywords',old('keywords'),['class'=>'form-control','placeholder'=>'Введите keywords…']) !!}
			<small class="help-block">Keywords - ключевые слова (ключевые запросы, ключи, ключевики) – это слова и словосочетания, представляющие собой поисковые запросы, по которым продвигается сайт в ТОП поисковой выдачи, и составляющие часть контентного наполнения страницы продвигаемого сайта.<br />
			</small>
		</div>
		<br />
	</div>
	<div class="form-group">
		{!! Form::label('meta_desc','Мета тег description :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('meta_desc',old('meta_desc'),['class'=>'form-control','placeholder'=>'Введите мета тег…']) !!}
			<small class="help-block">Мета тег description предназначен для создания краткого описания страницы. Его содержимое может использоваться поисковыми системами для формирования сниппета. Данный тег не влияет на внешний вид страницы, так как является служебной информацией.<br />
			</small>
		</div>
		<br />
	</div>
	<div class="form-group text-center">
        <div class="col-sm-offset-2 col-sm-8">
            {!! Form::button('Сохранить', ['class' => 'btn btn-info','type'=>'submit']) !!}
        </div>
    </div>

	{!! Form::close() !!}

</div>