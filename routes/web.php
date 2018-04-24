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

Route::get('/',                     'BlogController@listPosts');
Route::get('/create',               'AdminController@createPost');
Route::get('/edit/{postId}',        'AdminController@editPost');
Route::post('/save',                'AdminController@savePost');
Route::post('/delete/{postId}',     'AdminController@deletePost');
Route::post('/publish/{postId}',    'AdminController@publishPost');
Route::post('/un-publish/{postId}', 'AdminController@unPublishPost');
Route::get('/post/{postId}',        'BlogController@getPost');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
