<?php

Route::prefix('album')->group(function(){
    Route::get('/','AlbumController@index')
        ->middleware('can:view gallery albums')
        ->name('albums.index');
  Route::get('/data','AlbumController@getAlbumData')
    ->middleware('can:view gallery albums')
    ->name('albums.data');
    Route::get('/create','AlbumController@create')
      ->middleware('can:create gallery albums')
      ->name('albums.create');
    Route::post('/store','AlbumController@store')
      ->middleware('can:create gallery albums')
      ->name('albums.store');
    Route::get('/details/{id}','AlbumController@show')
      ->middleware('can:view gallery albums')
      ->name('albums.show');
    Route::get('/update/{id}','AlbumController@edit')
      ->middleware('can:update gallery albums')
      ->name('albums.edit');
  Route::post('/update/{id}','AlbumController@update')
    ->middleware('can:update gallery albums')
    ->name('albums.update');
  Route::post('/add-images/{id}','AlbumController@addImages')
    ->middleware('can:view gallery albums')
    ->name('album.images');
  Route::get('/delete-image/{id}','AlbumController@deleteImage')
    ->middleware('can:view gallery albums')
    ->name('album.images.delete');
  Route::get('/delete/{id}','AlbumController@destroy')
    ->middleware('can:delete gallery albums')
    ->name('albums.delete');
});
