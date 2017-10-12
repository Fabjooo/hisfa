@extends('layouts.app')

@section('content')

<div class="col-md-6 col-md-offset-3">

<?php if( $block != '' ): ?>
<form method="post" class="row flex-row edit-silo silo-edit" action="{{ action('BlockController@update', $block->id) }}">
<input type="hidden"  id="id" value="{{ $block->id }}">
<?php else: ?>
<form method="post" class="row flex-row edit-silo silo-edit" action="{{ action('BlockController@store', $block->id) }}">
<?php endif; ?>

		{{ csrf_field() }}

		<div class="input-control">
			{!! Form::label('Block name:') !!}
			{!! Form::text('name', (isset($block->name) ? $block->name : '')) !!}
		</div>

		@if( isset($block) )
		{!! Form::submit('SAVE', array('class' => 'btn btn-success')) !!}
		@else
		{!! Form::submit('ADD', array('class' => 'btn btn-success')) !!}
		@endif

	</form>
</div>

@endsection