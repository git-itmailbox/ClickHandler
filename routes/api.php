<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/clicks', 'Api\ClickController@getClicks');

Route::get('/bad-domain', 'Api\BadDomainController@getBadDomains');

Route::post('/bad-domain', 'Api\BadDomainController@store');

Route::delete('/bad-domain/{id}', 'Api\BadDomainController@delete');

Route::put('/bad-domain/{id}', 'Api\BadDomainController@update');
