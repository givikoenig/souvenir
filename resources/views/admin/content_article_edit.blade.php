<h3 class="page-header"><i class="fa fa-file-text-o"></i> Редактирование статьи блога</h3>
<hr>
<div class="wrapper">
{!! Form::open(['url' => route('articleEdit',array('article'=>$data['id'])),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}
	{!! Form::hidden('id', $data['id']) !!}
	{!! Form::hidden('user_id', Auth::user()->id ) !!}
	{!! Form::hidden('redirects_to', URL::previous()) !!}

	<div class="form-group">
        {!! Form::label('category_id', 'Тема блога :',['class'=>'col-sm-2 control-label']) !!}
        <div class="col-sm-8">
			<select name="category_id" class="form-control" style="width: 30%;">
				@foreach ($cats as $cat)
					<option value="{{$cat->id}}" {{ ($data['category_id'] == $cat->id) ? "selected=" : '' }} >{{$cat->title}}</option>
				@endforeach
			</select>
            <small class="help-block">Тема блога, к которой относится данная статья</small>
        </div>
    </div>
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
        {!! Form::label('old_img', 'Текущее изображение:',['class'=>'col-xs-2 control-label']) !!}
        <div class="col-sm-offset-2 col-sm-10">
            {!! Html::image('assets/img/blog/'.json_decode($data['img'],true )['max'],'',['class'=>'img-responsive','width'=>'200px']) !!}
            {!! Form::hidden('old_img', $data['img']) !!}
        </div>
    </div>
    <div class="form-group">
		{!! Form::label('img', 'Изменить изображение:',['class'=>'col-sm-2 control-label']) !!}
		<div class="col-sm-8">
			{!! Form::file('img', ['class' => 'filestyle', 'data-buttonText'=>'&nbsp;&nbsp;Выберите изображение', 'data-buttonName'=>"btn-info", 'data-iconName'=>'fa fa-image'  ,'data-placeholder'=>"Файла нет"] ) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('alias',' Alias (псевдоним) :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			{!! Form::text('alias',$data['alias'],['class'=>'form-control','placeholder'=>'Псевдоним для ссылки']) !!}
			<small class="help-block">Короткий псевдоним (alias) статьи блога, необходимый для формирования ссылки. Может состоять из нескольких слов, лучше на латинице. При кириллическом написании псевдоним все равно сохранится как транскрипция на латинице. Например из "наши рекорды" получится "nashi-rekordy"<br />
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
	<div class="form-group">
		{!! Form::label('post','Master Post :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			<small class="help-block">Master Post - первый пост к статье. Это может быть авторский текст, например о причинах, побудивших его к написанию статьи или чья-то рецензия на статью и т.п.<br /></small>
			{!! Form::textarea('post',$data['post'],['class'=>'form-control ckeditor','placeholder'=>'Введите текст…']) !!}
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