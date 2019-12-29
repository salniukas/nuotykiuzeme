<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/oauth/discord', 'Auth\LoginController@redirectToProvider')->name('auth.discord');
Route::get('/oauth/discord/callback', 'Auth\LoginController@handleProviderCallback')->name('auth.discord.callback');

Route::get('/', function () {
    return view('welcome');
})->name('Sveiki');;
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

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

	Route::get('anketos', 'HomeController@Anketos')->name('Anketos');
	Route::get('anketos/atmestos', 'HomeController@Atmestos')->name('Atmestos-Anketos');
	Route::get('anketos/patvirtintos', 'HomeController@Patvirtintos')->name('patvirtintos-anketos');
	Route::get('anketos/show/{id}', 'HomeController@Show')->name('show-anketa');
});



Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

