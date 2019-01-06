<?php

/*
|--------------------------------------------------------------------------
| [[module]] Module Routes
|--------------------------------------------------------------------------
|
| Here you can add routes that belongs to [[module]] module
| Only make sure not to add any routes that does not belong here in
| [[module]] Module ...
|
*/
Route::get('/', 'HomeController@index')->name('admin_[[module_lower]]');
Route::get('get', 'HomeController@get')->name('admin_[[module_lower]]_get');
Route::get('edit/{id?}', 'HomeController@edit')->name('admin_[[module_lower]]_edit');
Route::post('edit/{id?}', 'HomeController@submit')->name('admin_[[module_lower]]_edit');
Route::get('delete/{id}', 'HomeController@delete')->name('admin_[[module_lower]]_delete');