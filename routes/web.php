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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return redirect('/main');
});

Auth::routes();
Route::get('/main', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard');

Route::get('/map', 'HomeController@map');

//semiAPI
Route::get('/user/list', 'UserController@list');
Route::get('/user/profile/{email}', 'UserController@profile');
Route::delete('/user/list/{id}', 'UserController@destroy');

Route::get('/report/list/{startdate}/{enddate}', 'ReportController@list');
Route::get('/print/{startdate}/{enddate}', 'ReportController@print')->name('print');

Route::get('/report/list', 'ReportController@reportToday');
Route::put('/report/responded/{id}/{status}', 'ReportController@responded');
Route::put('/report/responded/{id}/{status}/{note}', 'ReportController@respondedNote');
Route::delete('/report/list/{id}', 'ReportController@destroy');
