<h3 class="page-header"><i class="fa fa-bookmark-o"></i> Редактирование категории товаров</h3>
<hr>
<div class="wrapper">
{!! Form::open(['url' => route('brandEdit',array('brand'=>$data['id'])),'class'=>'form-horizontal','method'=>'POST']) !!}
	{!! Form::hidden('id', $data['id']) !!}

	<div class="form-group">
		{!! Form::label('name','Название категории :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('name',$data['name'],['class'=>'form-control','placeholder'=>'Введите название …']) !!}
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('alias',' Alias (псевдоним) :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('alias',$data['alias'],['class'=>'form-control','placeholder'=>'Псевдоним для ссылки']) !!}
			<small class="help-block">Короткий псевдоним (alias) категории товаров, необходимый для формирования ссылки. Может состоять из нескольких слов, лучше на латинице. При кириллическом написании псевдоним все равно сохранится как транскрипция на латинице. Например из "подарки и сувениры" получится "podarki-i-suveniry"<br />
			</small>
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('keywords',' Keywords (ключевые слова) :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('keywords',$data['keywords'],['class'=>'form-control','placeholder'=>'Введите keywords…']) !!}
			<small class="help-block">Keywords - ключевые слова (ключевые запросы, ключи, ключевики) – это слова и словосочетания, представляющие собой поисковые запросы, по которым продвигается сайт в ТОП поисковой выдачи, и составляющие часть контентного наполнения страницы продвигаемого сайта.<br />
			</small>
		</div>
		<br /><br />
	</div>
	<div class="form-group">
		{!! Form::label('meta_desc','Мета тег description :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('meta_desc',$data['meta_desc'],['class'=>'form-control','placeholder'=>'Введите мета тег…']) !!}
			<small class="help-block">Мета тег description предназначен для создания краткого описания страницы. Его содержимое может использоваться поисковыми системами для формирования сниппета. Данный тег не влияет на внешний вид страницы, так как является служебной информацией.<br />
			</small>
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