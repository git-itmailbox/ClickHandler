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

Route::get('/', function () {
    return view('index');
});

Route::get('/bad-domains', function () {
    return view('bad_domains');
})->name('bad_domains');


Route::get('/click/', 'ClickController@handleClick');

Route::get('/success/{id}', 'ClickController@success')->name('success');

Route::get('/error/{id}/{redirectGoogle}', 'ClickController@error')->name('error');

