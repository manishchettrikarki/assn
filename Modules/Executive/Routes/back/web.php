<?php
Route::prefix('executives')->group(function(){
    Route::get('/','ExecutiveController@index')
        ->middleware('can:view executive members')
        ->name('executives.index');
    Route::get('/data','ExecutiveController@getMemberData')
        ->middleware('can:view executive members')
        ->name('executive.members.data');
    Route::get('/create','ExecutiveController@create')
        ->middleware('can:add executive members')
        ->name('executive.members.create');
    Route::post('/store','ExecutiveController@store')
        ->middleware('can:add executive members')
        ->name('executive.members.store');
    Route::get('/update/{id}','ExecutiveController@edit')
        ->middleware('can:update executive members')
        ->name('executive.members.edit');
    Route::post('/update/{id}','ExecutiveController@update')
        ->middleware('can:update executive members')
        ->name('executive.members.update');
    Route::get('/delete/{id}','ExecutiveController@destroy')
        ->middleware('can:delete executive members')
        ->name('executive.members.delete');
});

Route::prefix('members')->group(function(){
    Route::get('/','MemberController@index')
        ->middleware('can:view members')
        ->name('members.index');
    Route::get('/data','MemberController@getMemberData')
        ->middleware('can:view members')
        ->name('members.data');
    Route::get('/create','MemberController@create')
        ->middleware('can:add members')
        ->name('members.create');
    Route::post('/store','MemberController@store')
        ->middleware('can:add members')
        ->name('members.store');
    Route::get('/update/{id}','MemberController@edit')
        ->middleware('can:update members')
        ->name('members.edit');
    Route::post('/update/{id}','MemberController@update')
        ->middleware('can:update members')
        ->name('members.update');
    Route::get('/delete/{id}','MemberController@destroy')
        ->middleware('can:delete members')
        ->name('members.delete');
});

Route::prefix('regional-coordinators')->group(function(){
    Route::get('/','CoordinatorController@index')
        ->middleware('can:view regional coordinators')
        ->name('coordinators.index');
    Route::get('/data','CoordinatorController@getMemberData')
        ->middleware('can:view regional coordinators')
        ->name('coordinators.data');
    Route::get('/create','CoordinatorController@create')
        ->middleware('can:add regional coordinators')
        ->name('coordinators.create');
    Route::post('/store','CoordinatorController@store')
        ->middleware('can:add regional coordinators')
        ->name('coordinators.store');
    Route::get('/update/{id}','CoordinatorController@edit')
        ->middleware('can:update regional coordinators')
        ->name('coordinators.edit');
    Route::post('/update/{id}','CoordinatorController@update')
        ->middleware('can:update regional coordinators')
        ->name('coordinators.update');
    Route::get('/delete/{id}','CoordinatorController@destroy')
        ->middleware('can:delete regional coordinators')
        ->name('coordinators.delete');
});


Route::get('executive-message','ExecutiveMessageController@index')->name('executive.message');
Route::post('executive-message','ExecutiveMessageController@update')->name('executive.message.update');
Route::get('executive-message/create','ExecutiveMessageController@create')->name('executive.message.create');
Route::post('executive-message/store','ExecutiveMessageController@store')->name('executive.message.store');
Route::get('executive-message/update/{id}', 'ExecutiveMessageController@edit')->name('executive.message.edit');
Route::post('executive-message/update{id}', 'ExecutiveMessageController@update')->name('executive.message.update');
Route::get('executive-message/delete/{id}', 'ExecutiveMessageController@delete')->name('executive.message.delete');


Route::get('past-president','PastPresidentController@index')->name('past.president.index');
Route::post('past-president','PastPresidentController@update')->name('past.president.update');
Route::get('past-president/create','PastPresidentController@create')->name('past.president.create');
Route::post('past-president/store','PastPresidentController@store')->name('past.president.store');
Route::get('past-president/update/{id}','PastPresidentController@edit')->name('past.president.edit');
Route::post('past-president/update/{id}', 'PastPresidentController@update')->name('past.president.update');
Route::get('past-president/delete/{id}','PastPresidentController@delete')->name('past.president.delete');

Route::get('executive-bodies','ExecutiveBodyController@index')->name('executive.bodies.index');
Route::post('executive-bodies','ExecutiveBodyController@update')->name('executive.bodies.update');
Route::get('executive-bodies/create','ExecutiveBodyController@create')->name('executive.bodies.create');
Route::post('executive-bodies/store','ExecutiveBodyController@store')->name('executive.bodies.store');
Route::get('executive-bodies/update/{id}','ExecutiveBodyController@edit')->name('executive.bodies.edit');
Route::post('executive-bodies/update/{id}','ExecutiveBodyController@update')->name('executive.bodies.update');
Route::get('executive-bodies/delete/{id}','ExecutiveBodyController@delete')->name('executive.bodies.delete');

Route::get('past-general-secretary','PastGeneralController@index')->name('past.general.secretary.index');
Route::post('past-general-secretary','PastGeneralController@update')->name('past.general.secretary.update');
Route::get('past-general-secretary/create','PastGeneralController@create')->name('past.general.secretary.create');
Route::post('past-general-secretary/store','PastGeneralController@store')->name('past.general.secretary.store');
Route::get('past-general-secretary/update/{id}','PastGeneralController@edit')->name('past.general.secretary.edit');
Route::post('past-general-secretary/update/{id}','PastGeneralController@update')->name('past.general.secretary.update');
Route::get('past-general-secretary/delete/{id}','PastGeneralController@delete')->name('past.general.secretary.delete');

Route::get('scientific-committee','ScientificCommitteeController@index')->name('scientific.committee.index');
Route::post('scientific-committee','ScientificCommitteeController@update')->name('scientific.committee.update');
Route::get('scientific-committee/create','ScientificCommitteeController@create')->name('scientific.committee.create');
Route::post('scientific-committee/store','ScientificCommitteeController@store')->name('scientific.committee.store');
Route::get('scientific-committee/update/{id}','ScientificCommitteeController@edit')->name('scientific.committee.edit');
Route::post('scientific-committee/update/{id}','ScientificCommitteeController@update')->name('scientific.committee.update');
Route::get('scientific-committee/delete/{id}','ScientificCommitteeController@delete')->name('scientific.committee.delete');


Route::get('provincial-representative','ProvincialRepresentativeController@index')->name('provincial.representative.index');
Route::post('provincial-representative','ProvincialRepresentativeController@update')->name('provincial.representative.update');
Route::get('provincial-representative/create','ProvincialRepresentativeController@create')->name('provincial.representative.create');
Route::post('provincial-representative/store','ProvincialRepresentativeController@store')->name('provincial.representative.store');
Route::get('provincial-representative/update/{id}','ProvincialRepresentativeController@edit')->name('provincial.representative.edit');
Route::post('provincial-representative/update/{id}','ProvincialRepresentativeController@update')->name('provincial.representative.update');
Route::get('provincial-representative/delete/{id}','ProvincialRepresentativeController@delete')->name('provincial.representative.delete');

