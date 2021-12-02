<?php

Route::get('/library','LibraryController@index')
    ->middleware('can:view library')
    ->name('cms.library');

Route::get('/pages','PageController@index')
    ->middleware('can:view pages')
    ->name('cms.pages');
Route::get('/create-page','PageController@create')
    ->middleware('can:create page')
    ->name('cms.pages.create');
Route::post('/create-page','PageController@store')
    ->middleware('can:create page')
    ->name('cms.pages.store');
Route::get('update-page/{slug}','PageController@edit')
    ->middleware('can:update pages')
    ->name('cms.pages.edit');
Route::post('update-page/{slug}','PageController@update')
    ->middleware('can:update pages')
    ->name('cms.pages.update');
Route::get('delete-page/{slug}','PageController@destroy')
    ->middleware('can:delete pages')
    ->name('cms.pages.delete');

Route::get('sliders','SliderController@index')
    ->middleware('can:view sliders')
    ->name('cms.sliders');
Route::post('create-sliders','SliderController@store')
    ->middleware('can:create sliders')
    ->name('cms.sliders.create');
Route::get('/update-slider/{id}','SliderController@edit')
    ->middleware('can:update sliders')
    ->name('cms.sliders.edit');
Route::post('/update-slider/{id}','SliderController@update')
    ->middleware('can:update sliders')
    ->name('cms.sliders.update');
Route::get('delete-slider/{id}','SliderController@destroy')
    ->middleware('can:delete sliders')
    ->name('cms.sliders.delete');
