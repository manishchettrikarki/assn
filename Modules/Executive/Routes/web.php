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

    Route::get('/executive-members', 'ExecutiveCommitteeController@executives')->name('executives');
    Route::get('/members-directory','MemberController@members')->name('members');
    Route::get('/membership','MembershipController@showForm')->name('membership.form');
    Route::post('/membership','MembershipController@sendRegistrationRequest')->name('membership.submit');
    Route::get('/message/{post}','ExecutiveMessageController@message')->name('member.message');
    Route::get('/executive-body','ExecutiveBodyController@message')->name('executive.body');
    Route::get('/past-presidents','PastPresidentController@message')->name('past.president');
    Route::get('/past-gs','PastGsController@message')->name('past.general.secretary');
    Route::get('/scientific-committees', 'ScientificCommitteeController@message')->name('scientific.committees');
    Route::get('/provincial-representatives','ProvincialRepresentativeController@message')->name('provincial.representative');

