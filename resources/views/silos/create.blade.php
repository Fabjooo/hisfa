@extends('layouts.app')

<!--@include('silos.nav')-->

@if($type == "Prime")
	@if(Auth::user()->account_type == "admin" || Auth::user()->account_type == "normal" && strpos($account_options, "5") && $account_id = "[".Auth::user()->id."]")

		@include('silos.partials.create')

	@else
		@include('layouts.noaccess')
	@endif
@else

	@if(Auth::user()->account_type == "admin" || Auth::user()->account_type == "normal" && strpos($account_options, "6") && $account_id = "[".Auth::user()->id."]")

		@include('silos.partials.create')

	@else
		@include('layouts.noaccess')
	@endif
@endif
