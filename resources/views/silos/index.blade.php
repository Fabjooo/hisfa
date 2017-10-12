@extends('layouts.app')

<!--@include('silos.nav')-->

@if(Auth::user()->account_type == "admin" || Auth::user()->account_type == "normal" && strpos($account_options, "4") && $account_id = "[".Auth::user()->id."]")

@section('content')

	<div class="container">
		<div class="row">
                <div class="col-sm-6">
                    @include('silos.partials.prime')
                </div>
                <div class="col-sm-6">
                    @include('silos.partials.waste')
                </div>
            </div>
        </div>

@endsection
@else
	@include('layouts.noaccess')
@endif
