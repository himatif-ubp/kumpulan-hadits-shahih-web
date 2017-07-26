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

Route::get('/search/random', 'UserUndianCT@searchRandom');
Route::get('/undian/simpan', 'UserUndianCT@insertUndian');
Route::get('/notif/all', 'NotifCT@all');
Route::get('/notif/kirim', 'NotifCT@sentNotif');