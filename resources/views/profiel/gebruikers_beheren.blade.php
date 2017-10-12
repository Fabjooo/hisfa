@extends('layouts.app')

@if(Auth::user()->account_type == "admin" || Auth::user()->account_type == "normal" && strpos($account_options, "7") && $account_id = "[".Auth::user()->id."]")

@section('content')
	<div class="col-md-12 user-rights">

		<div class="table">
			<div class="tr table-header">
				<div class="flex1">Name</div>
				<div class="flex1">Dashboard access</div>
				<div class="flex1">Block/stock access</div>
				<div class="flex1">Block/stock management</div>
				<div class="flex1">Prime/waste silo access</div>
				<div class="flex1">Waste silo management</div>
				<div class="flex1">Prime silo management</div>
				<div class="flex1">User management</div>
			</div>

			@foreach($users as $user)
					<form class="tr table-data" action="{{ URL('/profiel/UpdateUser') }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="text" style="display:none" name="userId" value="{{$user->id}}">
						<div class="flex1">{{$user->name}}</div>
						<div class="flex1"><input type="checkbox" name="options[]" id="optie2" value="2" /></div>
						<div class="flex1"><input type="checkbox" name="options[]" id="optie3" value="3" /></div>
						<div class="flex1"><input type="checkbox" name="options[]" id="optie4" value="4" /></div>
						<div class="flex1"><input type="checkbox" name="options[]" id="optie5" value="5" /></div>
						<div class="flex1"><input type="checkbox" name="options[]" id="optie6" value="6" /></div>
						<div class="flex1"><input type="checkbox" name="options[]" id="optie7" value="7" /></div>
						<div class="flex1 buttons">
							<input type="submit" name="submit" class="btn btn-success btn-xs" id="updateUser_submit" value="Change roles">
							<a href="{{ action('ProfileController@DeleteUser', [$user->id])}}" class="btn btn-danger btn-xs">Delete user</a>
						</div>
					</form>
			@endforeach
		</div>
	</div>
@endsection
@else
	@include('layouts.noaccess')
@endif
