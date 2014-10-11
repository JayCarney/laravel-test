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

Route::get('/', 'HomeController@index');
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');
Route::get('signup', 'UsersController@create');
Route::get('admin', function(){
    return "Admin only";
})->before('auth');

Route::resource('sessions', 'SessionsController');
Route::resource('users', 'UsersController');
Route::resource('articles', 'ArticlesController');
Route::get('articles/{article}/publish', array('as'=>'articles.publish', 'uses'=>'ArticlesController@publish'));
Route::get('articles/{article}/unpublish', array('as'=>'articles.unpublish', 'uses'=>'ArticlesController@unpublish'));
Route::get('articles/{article}/delete', array('as'=>'articles.delete', 'uses'=>'ArticlesController@destroy'));
Route::get('articles/author/{author_id}', array('as'=>'articles.author', 'uses'=>'ArticlesController@author'));