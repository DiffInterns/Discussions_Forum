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

// Dsicussions
Route::get('discussions','ThreadController@index')->name('home');
Route::get('discussions/{id}','ReplyController@index')->name('threads.detail');;
Route::post('discussions','ThreadController@store')->name('threads.create');
Route::post('discussions/{id}','ThreadController@edit')->name('threads.edit');

// Delete thread or reply
Route::get('thread/{id}','ThreadController@delete')->name('threads.delete');
Route::get('reply/{id}','ReplyController@delete')->name('replies.delete');