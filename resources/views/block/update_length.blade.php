@extends('layouts.app')

@section('content')


<div class="col-md-6 col-md-offset-3">

<form method="post" class="row flex-row edit-silo silo-edit" action="{{ action('BlockController@update_length', $block->id) }}">

		{{ csrf_field() }}

		<div class="col-md-12">
		<div class="input-control">
			{!! Form::label('Length:') !!}
			{!! Form::number('length', $block->length) !!}
			<p>Fill in the length in milimeters</p>
		</div>
		</div>
		<div class="col-md-12">
		<div class="input-control">
			{!! Form::label('In Stock:') !!}
			{!! Form::number('stock', $block->stock) !!}
		</div>
		</div>

		<input type="hidden" name="block_id" value="<?=$block->id?>">

		{!! Form::submit('SAVE', array('class' => 'btn btn-success')) !!}

	</form>
</div>

@endsection