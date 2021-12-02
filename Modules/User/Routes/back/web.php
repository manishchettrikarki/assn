<?php

Route::get('card-data','UserDashboardController@getCardData')
    ->middleware('can:view dashboard')
    ->name('user.card.data');

Route::get('users','UserController@index')
    ->middleware('can:view users')
    ->name('users');
Route::get('users-data','UserController@getUserData')
    ->middleware('can:view users')
    ->name('users.data');

Route::get('users-details/{id}','UserController@show')
    ->middleware('can:view user details')
    ->name('users.view');

/**
 * user update routes
 */

Route::get('users-edit/{id}','UserController@edit')
    ->middleware('can:update users')
    ->name('users.edit');
Route::post('users-edit/{id}','UserController@update')
    ->middleware('can:update users')
    ->name('users.update');

/**
 * user delete routes
 */

Route::get('users-delete/{id}','UserController@destroy')
    ->middleware(['can:delete users','password.confirm'])
    ->name('users.delete');
Route::get('users-permanent-delete/{id}','UserController@delete')
    ->middleware(['can:delete users','password.confirm'])
    ->name('users.permanent.delete');
Route::get('users-restore/{id}','UserController@restore')
    ->middleware('can:restore users')
    ->name('users.restore');

Route::get('users-deleted','UserController@deletedUsers')
    ->middleware('can:view deleted users')
    ->name('users.deleted');
Route::get('users-deleted-data','UserController@deletedUserData')
    ->middleware('can:view deleted users')
    ->name('users.deleted.data');

/**
 * user suspended routes
 */

Route::get('users-suspended','UserSuspendController@suspendedUsers')
    ->middleware('can:view suspended users')
    ->name('users.suspended');
Route::get('users-suspended-data','UserSuspendController@getSuspendedUsers')
    ->middleware('can:view suspended users')
    ->name('users.suspended.data');

Route::get('user-suspend/{id}','UserSuspendController@suspendUser')
    ->middleware('can:suspend users')
    ->name('user.suspend');
Route::get('user-unsuspend//{id}','UserSuspendController@unsuspendUser')
    ->middleware('can:unsuspend users')
    ->name('user.unsuspend');

/**
 * acl routes
 */

Route::get('/roles','RoleController@index')
    ->middleware('can:view roles')
    ->name('user.roles');
Route::post('/add-role','RoleController@store')
    ->middleware('can:add roles')
    ->name('user.add.roles');
Route::get('/edit-role/{name}','RoleController@edit')
    ->middleware('can:update roles')
    ->name('user.edit.roles');
Route::post('/update-role/{id}','RoleController@update')
    ->middleware('can:update roles')
    ->name('user.update.roles');
Route::get('/delete-role/{name}','RoleController@destroy')
    ->middleware('can:delete roles')
    ->name('user.delete.roles');

Route::post('add-permission','RoleController@addPermission')
    ->name('user.add.permission');

Route::post('/assign-user-role','RoleController@assignUserRole')
    ->middleware('can:assign user roles')
    ->name('user.assign.role');
Route::post('/detach-user-role','RoleController@revokeUserRole')
    ->middleware('can:revoke user roles')
    ->name('user.detach.role');

