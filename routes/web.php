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

Route::get('/','IndexController@index');

Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/login', 'Auth\LoginController@showLogin')->name('admin.show');
    Route::post('/login', 'Auth\LoginController@authenticate')->name('admin.login');
});

Route::prefix('admin')->namespace('Admin')->middleware('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.home');
});


