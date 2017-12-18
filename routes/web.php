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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::resource('company', 'CompanyController',['except' => 'show']);
Route::get('company/show-all','CompanyController@showAll');
Route::get('company/search','CompanyController@search');
Route::resource('halaman', 'HalamanController',['except' => 'show']);
Route::get('halaman/show-all','HalamanController@showAll');
Route::get('halaman/search','HalamanController@search');
Route::resource('/menu', 'MenuController', ['except' => 'show']);
Route::get('menu/show-all','MenuController@showAll');
Route::get('menu/search','MenuController@search');
Route::get('getmenu', 'MenuController@getmenu');

Route::get('{path}', function () {
    return view('welcome');
})->where( 'path', '[\/\w\.-]*' );
