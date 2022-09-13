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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/' , 'ReviewController@index')->name('index');


Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
Route::get('/review/users', 'ReviewController@users')->name('users');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::get('/show/{id}', 'ReviewController@show')->name('show');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/review', 'ReviewController@create')->name('create');
    Route::post('/review/store', 'ReviewController@store')->name('store');
    Route::get('users', 'ReviewController@users')->name('users');
    Route::post('/review/shows', 'ReviewController@shows')->name('shows');
    Route::get('reviewshow', 'ReviewController@reviewshow')->name('reviewshow');
    
    
});

