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

Route::prefix('')->group(function() {

    Route::get('/update-password', 'UserController@changePassword')
    ->name('change.password');

    Route::post('/update-password','UserController@updatePassword')
        ->name('update.password');
});

Auth::routes(['verify'=>true]);
Route::middleware('auth')->group(function(){
    Route::get('profile','UserController@dashboard')
        ->name('user.dashboard');
});

