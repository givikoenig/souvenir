<h3 class="spage-header"><i class="fa fa-comment-o"></i> Редактирование комментария к статье "{{ $comment->article->title }}"</h3>
<hr>
<div class="wrapper">
	{!! Form::open(['url' => route('commentEdit',array('comment'=>$data['id'])),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}
	{!! Form::hidden('id', $data['id']) !!}
	{!! Form::hidden('art_id', $comment->article->id) !!}
	<div class="form-group">
		{!! Form::label('', 'Автор:',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-sm-offset-2 col-sm-10">
			{!! Html::image('assets/img/author/'. ($comment->user->avatar ? $comment->user->avatar : '12.jpg') ,'',['class'=>'img-responsive','width'=>'55px']) !!}
			<span class="help-block">{{ $comment->user->name }}</span>
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('text',' Текст комментария :',['class'=>'col-xs-2 control-label']) !!}  
		<div class="col-sm-8">
			
			{!! Form::textarea('text',$data['text'],['class'=>'form-control','placeholder'=>'Введите текст…','rows'=>4]) !!}
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