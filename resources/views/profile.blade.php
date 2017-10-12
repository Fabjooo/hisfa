@extends('layouts.app')

@section('content')
<div class="container profile">
	<div class="row">
		<div class="col-sm-6">
			<div class="pf-block user">
				<h1 class="pf-block__title">Personal information<a href="/profiel/instellingen" class="pf-block__title__edit">Update settings</a></h1>
				<div class="pf-block__body user-row">
					<div class="user__image-wrapper user-col">
						<img src="{{ Auth::user()->profilePic }}" class="user__image" alt="{{ Auth::user()->name }}'s profiel foto">
					</div>
					<div class=" user__info user-col">
							<h5 class="user__info__name">Name: <span>{{ Auth::user()->name }}</span></h5>
							<h5 class="user__info__email">Email: <span>{{ Auth::user()->email }}</span></h5>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="pf-block notifications">
				<h1 id="MeldingenNotificatiesTitel" class="pf-block__title">Notification settings</h1>
				<div class="pf-block__body">
					<!-- MELDINGEN & NOTIFICATIES -->
					<div class="notifications__row">
						<h5>Prime silo nearly full (90%):</h5>
						<div class="primeSwitch">
							<input type="checkbox" <?php if( Auth::user()->notification_prime == 1 ){ echo 'checked'; } ?> name="primeSwitch" class="primeSwitch-checkbox" id="primeSwitch" value="{{ Auth::user()->notification_prime }}" onclick="window.location.href='{{ action('ProfileController@ClickUpdateNotification_prime') }}'" >
							<label class="primeSwitch-label" for="primeSwitch">
								<span class="primeSwitch-inner"></span>
								<span class="primeSwitch-switch"></span>
							</label>
						</div>
					</div>

					<div class="notifications__row">
						<h5>Waste silo nearly full (90%):</h5>
						<div class="wasteSwitch">
							<input type="checkbox" <?php if( Auth::user()->notification_waste == 1 ){ echo 'checked'; } ?> name="wasteSwitch" class="wasteSwitch-checkbox" id="wasteSwitch" value="{{ Auth::user()->notification_waste }}" onclick="window.location.href='{{ action('ProfileController@ClickUpdateNotification_waste') }}'" >
							<label class="wasteSwitch-label" for="wasteSwitch">
								<span class="wasteSwitch-inner"></span>
								<span class="wasteSwitch-switch"></span>
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row secondrow">
		<div class="col-sm-6">
			<div class="pf-block adduser">
				<h1 class="pf-block__title">Add a new user
					@if(Auth::user()->account_type == "admin" || Auth::user()->account_type == "normal" && strpos($account_options, "7") && $account_id = "[".Auth::user()->id."]")
						<a href="profiel/gebruikers_beheren" class="pf-block__title__edit">Manage the users</a>
					@endif</h1>
				<div class="pf-block__body">
					<div class="row userrow">
						<!-- NIEUWE GEBRUIKER TOEVOEGEN -->
						@foreach (['danger', 'warning', 'success', 'info'] as $msg)
								@if(Session::has('user-' . $msg))
										<p class="alert alert-{{ $msg }}">{{ Session::get('user-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
								 @endif
						@endforeach

						@if(Auth::user()->account_type == "admin")
						<form class="" action="{{ URL('/profiel/addUser')}}" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="labelInputveld">
							<label for="name">Name</label>
							</div>
							<div class="labelInputveld">
							<input type="text" class="form-control" name="name" value="" >
							</div>

							<div class="labelInputveld">
							<label for="email">Email</label>
							</div>
							<div class="labelInputveld">
							<input type="text" class="form-control" name="email" value="">
							</div>

							<div class="labelInputveld">
							<label for="password">Password</label>
							</div>
							<div class="labelInputveld">
							<input type="password" class="form-control" name="password" value="">
							</div>

							<div class="labelInputveld">
							<label for="passwordRepeat">Repeat password</label>
							</div>
							<div class="labelInputveld">
							<input type="password" class="form-control" name="passwordRepeat" value="">
							</div>

								<p class="h6_melding vraagRollenGebruiker">
									Which roles should this user have?
								</p>

							<div class="labelInputBox">
							<input type="checkbox" name="options[]" id="optie1" value="1" />
								<label for="labelInputBox"></label>
							<label for="optie1">Dashboard access</label>
							</div>

							<div class="labelInputBox">
							<input type="checkbox" name="options[]" id="optie2" value="2" />
							<label for="optie2">Block/stock access</label>
							</div>

							<div class="labelInputBox">
							<input type="checkbox" name="options[]" id="optie3" value="3" />
							<label for="optie3">Block/stock management</label>
							</div>

							<div class="labelInputBox">
							<input type="checkbox" name="options[]" id="optie4" value="4" />
							<label for="optie4">Prime/waste silo access</label>
							</div>

							<div class="labelInputBox">
							<input type="checkbox" name="options[]" id="optie5" value="5" />
							<label for="optie5">Waste silo management</label>
							</div>

							<div class="labelInputBox">
							<input type="checkbox" name="options[]" id="optie6" value="6" />
							<label for="optie6">Prime silo management</label>
							</div>

							<div class="labelInputBox">
							<input type="checkbox" name="options[]" id="optie7" value="7" />
							<label for="optie7">User management</label>
							</div>

							<input type="submit" name="submit" class="submit btn btn-primary" id="userAdd_submit" value="Add user">

						</form>
					@endif

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
