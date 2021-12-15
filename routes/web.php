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


Route::get('/','HomeController@home')->name('welcome');
Route::get('/contact','ContactController@contact')->name('contact');
Route::post('/contact','ContactController@sendContactMail')->name('contact.send');


