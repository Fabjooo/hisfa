@extends('layouts.app')

@if($type == "prime")
    @if(Auth::user()->account_type == "admin" || Auth::user()->account_type == "normal" && strpos($account_options, "5") && $account_id = "[".Auth::user()->id."]")
        @include('silos.partials.add')
    @else
        @include('layouts.noaccess')
    @endif
@elseif($type == "waste")
    @if(Auth::user()->account_type == "admin" || Auth::user()->account_type == "normal" && strpos($account_options, "6") && $account_id = "[".Auth::user()->id."]")
        @include('silos.partials.add')
    @else
        @include('layouts.noaccess')
    @endif
@endif
