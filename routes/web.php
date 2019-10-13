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

Route::get('atranka', 'FormsController@index')->name('atranka');
Route::post('atranka/store', 'FormsController@store')->name('atrankaS');

Route::group(['middleware' => 'auth'], function () {
	Route::get('manoanketos', 'FormsController@Mano')->name('ManoAnketos');
	Route::get('atranka/pildyti', 'FormsController@create')->name('pildyti');
	Route::get('manoanketos/{id}', 'FormsController@Manoa')->name('ManoAnketa');
	Route::get('anketos', 'FormsController@lists')->name('anketos');
	Route::get('anketos/email', 'FormsController@response')->name('anketosMail');
	Route::get('anketos/approved', 'FormsController@Elists')->name('anketosApprove');
	Route::get('anketos/etapas', 'FormsController@Alists')->name('anketosEtapas');
	Route::get('atranka/trash/{id}', 'FormsController@trash');
	Route::get('atranka/approve/{id}', 'FormsController@etapas');
	Route::get('atranka/aleradas/{id}', 'FormsController@alerade');
	Route::get('anketos/{id}', 'FormsController@show')->name('anketa');
	Route::get('anketos/vote/{id}', 'FormsController@vote');
	Route::get('anketos/vote2/{id}', 'FormsController@vote2');
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