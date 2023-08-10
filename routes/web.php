<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'RapidApi', 'prefix' => 'rapidapi'], function() {
	Route::get('/', 'CountryController@index')->name('index');
	Route::get('leagues', 'LeagueController@index');
	Route::get('seasons', 'SeasonController@index');
	//Route::get('teams', 'LeagueTeamController@index');
});

Route::group(['namespace' => 'Standings'], function() {
	Route::get('/standings/{country}/{league}', 'IndexController@index')->name('standings.index');
	Route::get('/standings/', 'IndexController@getStandings');
	Route::get('/results/{country}/{league}', 'ResultsController@index')->name('results');
	Route::get('/results/', 'ResultsController@results');
	Route::get('/fixtures/{country}/{league}', 'FixturesController@index')->name('fixtures');
	Route::get('/fixtures/', 'FixturesController@fixtures');
});

Route::group(['namespace' => 'Index',], function() {
	Route::get('/', 'IndexController@index')->name('index');
	Route::get('leagues/{country}', 'LeagueController@leagueByCountry')->name('leagueByCountry');
	Route::get('seasons', 'SeasonController@index');
	Route::get('live', 'FixturesController@liveFixtures')->name('liveFixtures');
	Route::get('fixturesByDate', 'FixturesController@fixturesByDate')->name('fixturesByDate');
	Route::get('scheduledFixtures', 'FixturesController@scheduledFixtures')->name('scheduledFixtures');
	Route::get('finishedFixtures', 'FixturesController@finishedFixtures')->name('finishedFixtures');
});
Route::get('/m', function () {
	return view('stat-match.m');
});


Route::group(['namespace' => 'StatFixture',], function() {
	Route::get('/match/{id}/', 'IndexController@index')->where('id', '[0-9]+')->name('match');
	Route::get('/fixture', 'FixtureByIdController@index');
});

Route::group(['middleware => auth'], function() {
	Route::get('/dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::view('profile', 'profile')->name('profile');
	Route::put('profile', 'ProfileController@update')->name('profile.update');
});

Route::group(['middleware' => 'admin'], function() {
	Route::get('post', function () {
		return view('layouts.admin');
	});
});
Route::group(['namespace' => 'Admin', 'middleware' => 'admin'], function() {
	Route::get('admin', 'UserController@index')->name('admin.users.index');
	Route::delete('admin/delete/{id}', 'UserController@destroy')->name('admin.users.destroy');
});

require __DIR__.'/auth.php';
