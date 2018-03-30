<h3 class="page-header"><i class="fa fa-file-text-o"></i> блоки на главной странице </h3>
<hr>
<div class="wrapper">
	<table class="table table-hover table-striped text-center">
		<thead>
			<tr>
				<th class="text-center"><i class="fa fa-cubes"></i> Блок</th>
				<th class="text-center"><i class="fa fa-cogs"></i> Действие</th>
			</tr>
		</thead>
		<tbody>
			@if(isset($available_bl_ids) )
				@foreach($available_blocks as $val)
				{!! Form::open([ 'url' => route('pageblocksEdit',['block'=>$val->id]), 'class'=>'form-horizontal','method'=>'POST' ]) !!}
				<tr>
					<td>{{ $val->name }}</td>
					<td>
						@if( in_array($val->id, $fact_blocks)) 
							{{ method_field('detach') }}
			                {!! Form::button('<i class="fa fa-eye"></i>', ['class'=>'btn btn-success','type'=>'submit', 'title'=>'Скрыть']) !!}
						@else
							{{ method_field('attach') }}
			                {!! Form::button('<i class="fa fa-eye-slash"></i>', ['class'=>'btn btn-danger','type'=>'submit', 'title'=>'Показать']) !!}
						@endif
					</td>
				</tr>
				{!! Form::close() !!}
				@endforeach
			@endif
		</tbody>
	</table>
</div>