<?php
use App\Task;
use App\Trip;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'TripController@index');
Route::get('/home', 'TripController@index');
Route::post('/', 'TripController@searchTrips');
Route::post('/home', 'TripController@searchTrips');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// Authentication Routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/user', ['middleware' => 'auth', 'uses' => 'UserController@index']);
Route::delete('/user/{id}', 'UserController@destroy');

// JSON Routes
// show all trips
// Route::get('/api/trips', 'APIController@trips');
// show all trips and etc. by user
Route::post('/api/trips', 'APIController@synchronize');
Route::get('/api/sync', 'APIController@synchronize');
//Route::post('/api/sync', 'APIController@synchronize');
// show all locations
// Route::get('/api/locations', 'APIController@locations');
// show all budgeted expenses
// Route::get('/api/budgeted', 'APIController@budgeted');
//show all actual expenses
// Route::get('/api/actual', 'APIController@actual');


// take user submission & populate the Trip table
Route::post('/trip', ['middleware' => 'auth', 'uses' => 'TripController@store']);

// show a trip by its id
Route::get('/tripshow/{tid}', 'TripController@show');
// edit a trip by its id
Route::get('/tripedit/{tid}', 'TripController@edit');
// update a trip by its id
Route::post('/tripupdate/{tid}', 'TripController@update');
Route::post('/tripdestroy/{tid}', ['middleware' => 'auth', 'uses' => 'TripController@destroy']);

// add a new budget to a trip
Route::post('/trip/{id}/budget', 'TripController@createBudget');

Route::delete('/tripedit/{id}', 'TripController@destroy');

Route::get('/location/{tid}', ['middleware' => 'auth', 'uses' => 'LocationController@create']);
Route::post('/location/{tid}', ['middleware' => 'auth', 'uses' => 'LocationController@searchLocations']);
//Route::post('/locationdestroy/{lid} {tid}', ['middleware' => 'auth', 'uses' => 'LocationController@destroy']);
Route::get('/locationcancel', 'TripController@index');
Route::post('/locationstore/{id}', 'LocationController@store');
Route::get('/location', ['middleware' => 'auth', 'uses' => 'LocationController@index']);
Route::get('/locationshow/{id} {tid}', ['middleware' => 'auth', 'uses' => 'LocationController@show']);
//Route::get('/locationedit/{id} {tid}', ['middleware' => 'auth', 'uses' => 'LocationController@edit']);
//Route::post('/locationupdate/{id} {tid}', ['middleware' => 'auth', 'uses' => 'LocationController@update']);

Route::get('budgetplain/{bid} {lid} {tid}', 'BudgetController@plain');
Route::get('/budgetshow/{bid} {lid} {tid}', 'BudgetController@show');
Route::get('/budgetview/{bid} {lid} {tid}', 'BudgetController@view');
Route::get('/budget/{lid} {tid}', ['middleware' => 'auth', 'uses' => 'BudgetController@create']);
Route::post('/budgetstore/{lid} {tid}', ['middleware' => 'auth', 'uses' => 'BudgetController@store']);
Route::get('/budgetedit/{bid} {lid} {tid}', ['middleware' => 'auth', 'uses' => 'BudgetController@edit']);
Route::post('/budgetupdate/{bid} {lid} {tid}', ['middleware' => 'auth', 'uses' => 'BudgetController@update']);
Route::post('/budgetdestroy/{bid} {lid} {tid}', ['middleware' => 'auth', 'uses' => 'BudgetController@destroy']);

Route::get('actualplain/{bid}', 'ActualController@plain');
Route::get('/actualedit/{bid} {lid} {tid}', ['middleware' => 'auth', 'uses' => 'ActualController@edit']);
Route::get('/actual/{bid} {lid} {tip}', ['middleware' => 'auth', 'uses' => 'ActualController@create']);
Route::post('/actualstore/{bid}', ['middleware' => 'auth', 'uses' => 'ActualController@store']);
Route::get('/actualshow/{bid}', 'ActualController@show');
Route::post('/actualupdate/{aid} {lid} {tid}', ['middleware' => 'auth', 'uses' => 'ActualController@update']);
Route::post('/actualdestroy/{aid} {lid} {tid}', ['middleware' => 'auth', 'uses' => 'ActualController@destroy']);

Route::get('/search', 'SearchController@index');
Route::post('/search', 'SearchController@search');