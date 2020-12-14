<?php

use GuzzleHttp\Middleware;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


// we use route group to applique some middleware to a lot of routes
Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('/posts', 'PostsController');
    Route::resource('/tags', 'TagsController');
    Route::resource('/categorie', 'CategorieController');
    Route::get('/trashed-posts', 'PostsController@trashed')->name('trashed.index');
    Route::get('/trashed-posts/{id}', 'PostsController@restore')->name('trashed.restore');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::get('/users/create', 'UsersController@create')->name('users.create');
    Route::get('/users/update', 'UsersController@update')->name('users.update');
    Route::post('/users/store', 'UsersController@store')->name('users.store');
    Route::post('/users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
    Route::post('/users/{user}/make-writer', 'UsersController@makeWriter')->name('users.make-writer');
});
