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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index');

Route::get('/users', ['as' => 'users', 'uses' => 'HomeController@users']);
Route::get('/cards', ['as' => 'cards', 'uses' => 'HomeController@cards']);

Route::get('/datatable-users', 'DatatableController@getUsers')->name('cdvi.users');
Route::get('/datatable-allusers', 'DatatableController@allUsers')->name('cdvi.allusers');

Route::post('/datatable-update-dates', 'DatatableController@updateDates')->name('cdvi.updateDates');

