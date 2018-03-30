<h3 class="page-header"><i class="fa fa-file-text-o"></i> Пункты главного меню</h3>

<p>В данном разделе вы можете создавать, редактировать и удалять дополнительные пункты главного меню и относящиеся к ним страницы.</p>
<p>Пункты меню "Главная", "Магазин" и "Блог" являются статичными. Их названия и положение неизменны.</p>

<hr>
<p style="color: #ff0000;">Внимание !</p>
<p>Для меню типа "Drop Down" (выпадающее меню) никаких субменю специально создавать не нужно.</p>
<p>Они будут создаваться автоматически каждый раз при добавлении страницы в соответствующий пункт главного меню ("Доп.страницы" &rarr; "Страницы").</p>

<br /><br />

<div class="text-center">
   <a class="btn btn-info" href="{{route('mitemsAdd')}}" title="Add Menu Item"><span class="fa fa-plus"></span> Добавить пункт меню</a>
</div>
<br />

@if(isset($mitems))
<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th><i class="fa fa-sort-numeric-asc"></i> ID</th>
			<th><i class="fa fa-flag-o"></i> Заголовок</th>
			<th><i class="fa fa-tags"></i> Псевдоним</th>
			<th><i class="fa fa-key"></i> Тип меню</th>
			<th><i class="fa fa-calendar-o"></i> Date</th>
			<th colspan="2"><i class="fa fa-cogs"></i> Действие</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($mitems as $item)
			<tr>
				<td>{{ $item->id }}</td>
				<td><a href="{{ route('mitemEdit', $item->id) }}">{{ $item->title }}</a></td>
				<td>{{ $item->alias }}</td>
				<td>{{ $item->mtype_id == 1 ? 'SINGLE' : 'DROP_DOWN' }}</td>
				<td>{{ $item->created_at }}</td>
				<td>
					<a class="btn btn-success" href="{{ route('mitemEdit', $item->id) }}"><i class="fa fa-edit" title="Редактировать"></i></a>
				</td>
				<td>
					{!! Form::open(['url'=>route('mitemEdit',['mitem'=>$item->id]), 'class'=>'form-horizontal', 'method'=>'POST']) !!}
					{{ method_field('delete') }}
					{!! Form::button('<i class="fa fa-close"></i>', ['class'=>'btn btn-danger','type'=>'submit','title'=>'Удалить']) !!}
					{!! Form::close() !!}
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
@endif

<br />
<div class="text-center">
   <a class="btn btn-info" href="{{route('mitemsAdd')}}" title="Add Menu Item"><span class="fa fa-plus"></span> Добавить пункт меню</a>
</div>