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
    Route::post('/review/shows', 'ReviewController@shows')->name('shows');
    Route::get('reviewshow', 'ReviewController@reviewshow')->name('reviewshow');
    Route::delete('/destroy{id}', 'ReviewController@destroy')->name('destroy');
    Route::get('usersreview', 'ReviewController@usersreview')->name('usersreview');
    Route::get('edit{id}', 'ReviewController@edit')->name('edit');
    Route::put('/update{id}', 'ReviewController@update')->name('update');
    Route::get('user', 'UsersController@user')->name('user');
    
    Route::group(['prefix' => 'reviews/{id}'], function () {
        // reviews/{id}/favorite
        Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');

        // microposts/{id}/unfavorite
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
    });
    
    Route::group(['prefix' => 'users/{id}'], function () {
        // users/{id}/favorites
        Route::get('favorites', 'UsersController@favorites')->name('favorites');
    });

});

