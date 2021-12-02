<?php

  Route::get('/','EventController@index')
    ->middleware('can:view events')
    ->name('events.index');
  Route::get('/data','EventController@getEventData')
    ->middleware('can:view events')
    ->name('events.data');
  Route::get('/create','EventController@create')
    ->middleware('can:add events')
    ->name('events.create');
  Route::post('/create','EventController@store')
    ->middleware('can:add events')
    ->name('events.store');
  Route::get('/details/{id}','EventController@show')
    ->middleware('can:view events')
    ->name('events.show');
  Route::get('/update/{id}','EventController@edit')
    ->middleware('can:update events')
    ->name('events.edit');
  Route::post('/update/{id}','EventController@update')
    ->middleware('can:update events')
    ->name('events.update');
  Route::get('/delete/{id}','EventController@destroy')
    ->middleware('can:delete events')
    ->name('events.delete');
