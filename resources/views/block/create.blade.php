@extends('layouts.app')

@section('content')

<div class="col-md-6 col-md-offset-3">

<form method="post" class="row flex-row edit-silo silo-edit" action="{{ action('BlockController@store') }}">

		{{ csrf_field() }}

		<div class="input-control">
			{!! Form::label('Block name:') !!}
			{!! Form::text('name', (isset($block->name) ? $block->name : '')) !!}
		</div>

		{!! Form::submit('ADD', array('class' => 'btn btn-success')) !!}

	</form>
</div>

@endsection