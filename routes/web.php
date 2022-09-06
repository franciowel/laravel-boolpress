<?php

use Illuminate\Support\Facades\Route;

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
    return view('guest.home');
});

Auth::routes();


// Route::get('admin', 'Admin\HomeController@index')->middleware('auth')->name('admin.home');
// Route::get('admin/about', 'Admin\HomeController@about')->middleware('auth')->name('admin.about');
Route::middleware('auth')
->namespace('Admin')
->name('admin.')
->prefix('admin')
->group(function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('about', 'HomeController@about')->name('about');
});
