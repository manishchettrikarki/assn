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

Route::get('subscribe','SubscriptionController@subscribe')->name('subscribe');

Route::get('verify-subscription/{subscriber}','SubscriptionController@verify')
    ->middleware('signed')
    ->name('subscription.verify');

Route::get('unsubscribe/{subscriber}','SubscriptionController@unsubscribe')
    ->middleware('signed')
    ->name('unsubscribe');
