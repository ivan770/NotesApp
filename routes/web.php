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

/* GET's */

Route::get('/', 'ViewController@Main')->name('index');

Route::get('/account', 'ViewController@Account')->name('account');

Route::get('/register', 'ViewController@Register')->name('register');

Route::get('/public/{id}', 'ViewController@Public')->name('public');

Route::get('/settings', 'ViewController@Settings')->name('profile');

Route::get('/edit/{id}', 'ViewController@Edit')->name('edit');

/* POST's */

Route::post('/login', 'AuthController@Login')->name('login');

Route::post('/logout', 'AuthController@Logout')->name('logout');

Route::post('/register', 'AuthController@Register')->name('create');

Route::post('/settings', 'AuthController@Settings')->name('settings');

Route::post('/password', 'AuthController@Password')->name('password');

Route::post('/new', 'NoteController@New')->name('new');

Route::post('/delete', 'NoteController@Delete')->name('delete');

Route::post('/get', 'NoteController@Get')->name('get');

Route::post('/edit', 'NoteController@Edit')->name('editing');