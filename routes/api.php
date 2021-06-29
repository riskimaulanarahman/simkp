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

Route::get('/form-kp', 'PendaftaranController@all');
Route::get('/form-kp-check', 'PendaftaranController@check');
Route::post('/form-kp-storekp', 'PendaftaranController@storekp')->name('form-kp-storekp');

Route::get('/detailberkas/{id}/{idkp}', 'BerkasController@detailberkas')->name('detailberkas');
Route::get('/detailnilai/{id}', 'BerkasController@detailnilai')->name('detailnilai');

//pindah ke web.php
// Route::get('/progresskp/{id}', 'ApprovalController@progresskp')->name('progresskp');
// Route::get('/rollbackkp/{status}/{id}', 'ApprovalController@rollbackkp')->name('rollbackkp');
// Route::get('/donekp/{id}', 'ApprovalController@donekp')->name('donekp');

Route::get('/seminar/{id}', 'TendikController@seminar')->name('seminar');
Route::get('/finish/{id}', 'TendikController@finish')->name('finish');

Route::get('/dosenbase/{id}', 'KoordinatorController@dosenbase')->name('dosenbase');


