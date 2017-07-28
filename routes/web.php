<?php

Route::get('/', function () {
    return view('login');
});

Route::group(['middleware' => 'checklogin'], function () {
	Route::resource('imam', 'ImamCT');
});
Route::group(['middleware' => 'checklogin'], function () {
	Route::resource('kitab', 'KitabCT');
});
Route::group(['middleware' => 'checklogin'], function () {
	Route::resource('bab', 'BabCT');
});
Route::group(['middleware' => 'checklogin'], function () {
	Route::resource('hadits', 'HaditsCT');
});
Route::group(['middleware' => 'checklogin'], function () {
	Route::resource('notif', 'NotifCT');
});
Route::post('/adm/login', 'AdmCT@login');
Route::get('/adm/logout', 'AdmCT@logout');