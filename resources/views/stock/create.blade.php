@extends('layouts.app')

@if(Auth::user()->account_type == "admin" || Auth::user()->account_type == "normal" && strpos($account_options, "3") && $account_id = "[".Auth::user()->id."]")

@section('content')

<div class="stock-edit">

	<form method="POST" class="stock-edit__form">
		{{ csrf_field() }}

		<div class="input-control">
			{!! Form::label('Material type:') !!}
			{!! Form::text('type', (isset($stock->type) ? $stock->type : '')) !!}
		</div>

		<div class="input-control">
			{!! Form::label('Material tonnage:') !!}
			{!! Form::text('tonnage', (isset($stock->stock->tonnage) ? $stock->stock->tonnage : 0)) !!}
		</div>

		@if( isset($stock) )
		{!! Form::submit('Save', array('class' => 'btn btn-success')) !!}
		@else
		{!! Form::submit('Add', array('class' => 'btn btn-success')) !!}
		@endif

	</form>
	<form method="POST" class="stock-edit__form" action="/stock/instellingen/StockAvatar">
		{{ csrf_field() }}
		<div class="input-control">
			{!! Form::label('Add stock avatar') !!}
			{!! Form::file('image') !!}
		</div>
	</form>


</div>

@endsection

@else
	@include('layouts.noaccess')
@endif
