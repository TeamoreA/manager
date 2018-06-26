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

Route::middleware(['auth'])->group(function() {
	Route::resource('genres', 'CompaniesController');
	Route::get('books/create/{genre_id?}','ProjectsController@create');
	Route::post('books/adduser','ProjectsController@adduser')->name('books.adduser');
	Route::resource('books', 'ProjectsController');
	Route::resource('roles', 'RolesController');
	Route::resource('tasks', 'TasksController');
	Route::resource('users', 'UsersController');
	Route::resource('comments', 'CommentsController');
});


