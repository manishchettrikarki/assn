<?php
Route::get('subscribers','SubscriberController@index')
    ->middleware('can:view subscribers')
    ->name('newsletter.subscribers');
Route::get('subscribers-data','SubscriberController@getSubscriberData')
    ->middleware('can:view subscribers')
    ->name('newsletter.subscribers.data');

Route::get('email-templates','TemplateController@index')
    ->middleware('can:create email templates')
    ->name('newsletter.templates');
Route::post('email-templates','TemplateController@store')
    ->middleware('can:create email templates')
    ->name('newsletter.templates.create');
Route::get('email-template/{slug}','TemplateController@show')
    ->middleware('can:create email templates')
    ->name('newsletter.templates.show');
Route::get('email-templates-update/{slug}','TemplateController@edit')
    ->middleware('can:update email templates')
    ->name('newsletter.templates.edit');
Route::post('email-templates-update/{slug}','TemplateController@update')
    ->middleware('can:update email template')
    ->name('newsletter.templates.update');
Route::get('email-templates-delete/{slug}','TemplateController@destroy')
    ->middleware('can:delete email templates')
    ->name('newsletter.templates.delete');
Route::get('email-template','TemplateController@template')
    ->middleware('can:send newsletter')
    ->name('newsletter.template.get');

Route::get('newsletter-create','NewsletterController@create')
    ->middleware('can:send newsletter')
    ->name('newsletter.create');
Route::post('newsletter-send','NewsletterController@send')
    ->middleware('can:send newsletter')
    ->name('newsletter.send');
