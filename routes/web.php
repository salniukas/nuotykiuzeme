<?php

//Discord Login
Route::get('/oauth/discord', 'Auth\LoginController@redirectToProvider')->name('auth.discord');
Route::get('/oauth/discord/callback', 'Auth\LoginController@handleProviderCallback')->name('auth.discord.callback');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/private', function () {
    return view('privacy');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Aleradas

Route::get('zaidejai', 'PlayerAddController@players')->name('zaidejai');
Route::get('video', 'VideoController@index')->name('video');
Route::get('donate', 'PaymentController@index')->name('donate');

//Anketos

Route::get('atranka', 'FormsController@create')->name('Atranka');
Route::post('anketele/store', 'FormsController@store')->name('atrankaS');

Route::group(['middleware' => 'auth'], function () {
	Route::get('manoanketos', 'FormsController@Mano')->name('ManoAnketos');
	Route::get('atranka/pildyti', 'FormsController@create')->name('pildyti');
	Route::get('manoanketos/{id}', 'FormsController@Manoa')->name('ManoAnketa');

	Route::get('anketos', 'HomeController@Anketos')->name('Anketos');
	Route::get('anketos/atmestos', 'HomeController@Atmestos')->name('Atmestos-Anketos');
	Route::get('anketos/patvirtintos', 'HomeController@Patvirtintos')->name('patvirtintos-anketos');

	Route::get('anketos/email', 'FormsController@response')->name('anketosMail');

	Route::get('atranka/trash/{id}', 'FormsController@trash');
	Route::get('atranka/approve/{id}', 'FormsController@etapas');
	Route::get('atranka/aleradas/{id}', 'FormsController@alerade');

	Route::get('anketos/vote/{id}', 'FormsController@vote');
	Route::get('anketos/vote2/{id}', 'FormsController@vote2');
	Route::get('anketos/show/{id}', 'HomeController@Show')->name('show-anketa');

});

//Video & Žaidėjai
Route::group(['middleware' => 'auth'], function () {
	//prideti

	Route::get('zaidejai/add', 'PlayerAddController@register')->name('addzaidejai');
	Route::post('zaidejai/store', 'PlayerAddController@store')->name('storez');
	Route::get('zaidejai/edit', 'PlayerAddController@edit');
	Route::post('zaidejai/update', 'PlayerAddController@update')->name('Zupdate');
	//parodyti

	Route::get('zaidejas/show/{id}', 'PlayerAddController@show')->name('zaidejas');
	//moderuoti

	Route::get('zaidejas/suspend/{id}', 'PlayerAddController@suspenduoti')->name('suspenduoti');
	Route::get('zaidejas/unsuspend/{id}', 'PlayerAddController@atspenduoti')->name('atspenduoti');
	Route::get('zaidejas/add/all', 'PlayerAddController@addAll')->name('addAll');
	Route::get('zaidejas/remove/all', 'PlayerAddController@removeAll')->name('removeAll');
	Route::get('zaidejas/add/penality/{id}', 'PlayerAddController@penality')->name('penalityAdd');
	Route::get('zaidejas/penality/check', 'PlayerAddController@CheckSuspension');
	
	//video
	Route::get('video/add', 'VideoController@create')->name('videoAdd');
	Route::post('video/store', 'VideoController@store')->name('videoStore');

});

//Donations
Route::get('donate/select', 'OrderController@donate')->name('dselect');
Route::post('/paysera/redirect', 'PayseraGatewayController@redirect')->name('paysera-redirect');
Route::get('/paysera/callback', 'PayseraGatewayController@callback')->name('paysera-callback');
Route::get('/uzsakymas-pavyko', function () { return view('donate.accept'); });
Route::get('/uzsakymas-nepavyko', function () { return view('donate.cancel'); });


Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', 'HomeController@players')->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});



Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});