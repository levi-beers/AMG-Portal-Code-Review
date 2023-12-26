<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| Now create something great!
|
*/

Route::prefix('data-storage')->group(function () {
    Route::get('/', 'DataStorageController@index')->middleware('auth');
});
