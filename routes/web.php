<?php

/*
|--------------------------------------------------------------------------
| Web R!outes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Notifications\SilosVolume;

Route::get('/*', function(){
	if (!Auth::check()){
		return redirect('login');
	}
});

Route::get('/', function () {
	return view('/auth/login');
});

/*Route::get('/blokken', function() {
	if(Auth::user()){
		return view('blokken');
	}else{
		return redirect('login');
	}
});*/

route::get('/logout', function(){
	// session data wegdoen en redirecten naar login :)
	Session::flush();
	return redirect('login');
});

Route::get('/herstel-wachtwoord', function(){
	return view('auth/passwords/email');
});

/**
* SILO ROUTES
**/
Route::get('/silos', 				'SilosController@index');
Route::get('/silos/{type}/add', 	'SilosController@create');
Route::get('/silos/{id}/delete', 	'SilosController@destroy');
Route::get('/silos/{id}/edit',		'SilosController@edit');
Route::post('/silos', 				'SilosController@store');
Route::post('/silos/{id}/edit', 	'SilosController@update');
Route::post('/silos/{type}/add',	'SilosController@store');
Route::post('/silos/{id}/editjson', 'SilosController@update_json');

/**
* STOCK ROUTES
**/
Route::get('/stock', 				'StockController@index');
Route::get('/stock/{id}/edit',		'StockController@edit');
Route::post('/stock/{id}/edit',		'StockController@update');
Route::get('/stock/add',			'StockController@create');
Route::post('/stock/add',			'StockController@store');
Route::get('/stock/{id}/delete',	'StockController@destroy');
Route::get('/stock/{id}/increase', 	'StockController@increase');
Route::get('/stock/{id}/decrease',	'StockController@decrease');
Route::post('/stock/instellingen/StockAvatar', 'StockController@update_StockAvatar');

/**
* BLOCK ROUTES
*/
//Route::get('/blocks',				'BlockController@index');
Route::resource('/blocks', 					'BlockController', ['except' => ['destroy', 'update']]);
Route::get('/blocks/{id}/create_length',	'BlockController@create_length');
Route::get('/blocks/{id}/destory_length',	'BlockController@destroy_length');
Route::get('/blocks/delete/{id}', 			'BlockController@destroy');
Route::post('/blocks/{id}',					'BlockController@update');
Route::post('/blocks/{id}/length',			'BlockController@update_length');
Route::post('/blocks/length/{id}',			'BlockController@store_length');
Route::get('/blocks/edit_length/{id}', 		'BlockController@edit_length');
Route::get('/blocks/length/{id}/increase',	'BlockController@increaseLength');
Route::get('/blocks/length/{id}/decrease',	'BlockController@decreaseLength');

// TEST ROUTE | NO LONGER NECESSARY
//Route::get('/email', 'EmailController@checkVolume');

/**
* PROFILE ROUTES
**/
Route::get('/profiel', function(){
	if(Auth::check()){
		return view('profile')->with('title', 'Profile');
	}else{
		return redirect('login');
	}

});
Route::get('/profiel/updateNotiPrime', 'ProfileController@ClickUpdateNotification_prime');
Route::get('/profiel/updateNotiWaste', 'ProfileController@ClickUpdateNotification_waste');

Route::get('/profiel/gebruikers_beheren', 'ProfileController@ManageUsers');

Route::get('/profiel/instellingen', function(){
	return view('profile_settings')->with('title', 'Profile settings');
});

// profiel instellingen wijzigen
Route::post('/profiel/instellingen/persoonlijk', 'ProfileController@PersonalData');
Route::post('/profiel/instellingen/avatar', 'ProfileController@UserAvatar');
Route::post('/profiel/instellingen/wachtwoord', 'ProfileController@UserPassword');
// user toevoegen
Route::post('/profiel/addUser', 'ProfileController@AddUser');
Route::post('/profiel/UpdateUser', 'ProfileController@UpdateUser');
Route::get('/profiel/DeleteUser/{id}', 'ProfileController@DeleteUser');

Auth::routes();

Route::get('/home', 'HomeController@index');
//Route::get('/home/notifications', 'NotificationController@dashboardNotification');

/**
 * RAPPORTEN ROUTES
 **/


Route::get('/rapporten', function(){
	return view('rapporten')->with('title', 'Reports');
});

Route::get('/rapporten', 'RapportenController@index');
