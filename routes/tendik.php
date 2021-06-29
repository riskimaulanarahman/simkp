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

Auth::routes();

Route::group( ['prefix' => 'tendik','as' => 'tendik.', 'middleware' => ['auth','cors','roleTendik']], function() {

    Route::get('/dashboard-tendik', ['as' => 'index', 'uses' => 'TendikController@index']);

    Route::get('/tendik-request', 'ApprovalController@reqtendik')->name('request.index');
    Route::get('/tendik-approval', 'ApprovalController@acctendik')->name('request.approval');
    Route::get('/tendik-datamhs', 'TendikController@datamhs')->name('datamhs');
    Route::post('/tendik-datamhs-updpembimbing', 'TendikController@updpembimbing')->name('updpembimbing');
    Route::post('/tendik-sendberkastendik', 'BerkasController@sendberkastendik')->name('sendberkastendik');

    Route::get('/tendik-accberkas/{id}/{status}', 'TendikController@accberkas')->name('accberkas');

    Route::get('/tendik-mitrakp/edit/{id}', 'TendikController@editmitra')->name('mitra-edit');
    Route::post('/tendik-mitrakp/update/{id}', 'TendikController@updatemitra')->name('mitra-update');

    Route::get('/nilai-mahasiswa-edit/{id}', ['uses' => 'TendikController@editnilaimahasiswa', 'as' => 'editnilaimahasiswa']);
    Route::post('/nilai-mahasiswa-update/{id}', ['uses' => 'TendikController@updatenilaimahasiswa', 'as' => 'updatenilaimahasiswa']);



});

