<?php

Route::get('/dashboard','DashboardController@dashboard')
    ->middleware('can:view dashboard')
    ->name('dashboard');



Route::get('/file-contents','AdminController@getFileContents')
    ->name('get.file.content');


Route::get('/user','UserController@search')
    ->name('user.typeahead');

//module routes

Route::get('/module-toggle','ModuleController@toggleModule')
    ->middleware('can:enable/disable module')
    ->name('module.toggle');


Route::get('activity-log','ActivityLogController@index')
    ->middleware('can:view activity log')
    ->name('activity.log');
Route::get('activity-log/data','ActivityLogController@getActivities')
    ->middleware('can:view activity log')
    ->name('activity.log.data');

Route::get('site-settings','SettingController@index')
    ->middleware('can:update site settings')
    ->name('site.settings');
Route::post('site-settings','SettingController@update')
    ->middleware('can:update site settings')
    ->name('site.settings.update');

Route::get('social-links','SocialLinkController@index')
    ->middleware('can:view social links')
    ->name('social.links');
Route::post('social-links','SocialLinkController@store')
    ->middleware('can:add social links')
    ->name('social.links.store');
Route::get('social-links/{slug}','SocialLinkController@edit')
    ->middleware('can:update social links')
    ->name('social.links.edit');
Route::post('social-links/{slug}','SocialLinkController@update')
    ->middleware('can:update social links')
    ->name('social.links.update');
Route::get('social-links-delete/{slug}','SocialLinkController@destroy')
    ->middleware('can:delete social links')
    ->name('social.links.delete');
