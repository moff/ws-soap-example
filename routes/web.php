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

Route::get('/', 'SearchController@index')->name('main');
Route::get('/search', 'SearchController@search');
Route::get('/ping', 'SearchController@ping');
Route::get('/info', 'SearchController@info');
Route::post('/result', 'SearchController@result')->name('result');
