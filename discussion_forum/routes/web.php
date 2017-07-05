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


//show discussion
Route::get('discussions','ThreadsController@index')->name('home');
Route::get('discussion/{topic}','ThreadsController@getThreadsByTopic');
Route::get('discussions/{id}','RepliesController@index')->name('threads.detail');;

//create or update
Route::post('discussions','ThreadsController@store')->name('threads.create');
Route::post('discussions/{thread}/replies', 'RepliesController@store')->name('threads.replies');
Route::post('discussions/{thread}','ThreadsController@update')->name('threads.update');
Route::post('reply/{reply}','RepliesController@update')->name('replies.update');

// Delete thread or reply
Route::get('thread/{id}','ThreadsController@delete')->name('threads.delete');
Route::get('reply/{reply}','RepliesController@delete')->name('replies.delete');