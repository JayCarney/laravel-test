<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
//    $user = new User();
//    $user->email = 'jason@dashmedia.com.au';
//    $user->name = 'Jason Carney';
//    $user->password = Hash::make('jason1989');
//	$user->save();
});

Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');
Route::get('signup', 'UsersController@create');
Route::get('admin', function(){
    return "Admin only";
})->before('auth');

Route::resource('sessions', 'SessionsController');
Route::resource('users', 'UsersController');
Route::resource('articles', 'ArticlesController');