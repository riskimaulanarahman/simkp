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

Route::get('/cek-jadwal-seminar', 'KoordinatorController@cekjadwalseminar')->name('home.cekjadwalseminar');

Route::group( ['prefix' => 'koor','as' => 'koor.', 'middleware' => ['auth','cors','roleKoordinator']], function() {

    Route::get('/dashboard-koordinator', ['as' => 'index', 'uses' => 'KoordinatorController@index']);

    Route::get('/koor-datamhs', 'KoordinatorController@datamhs')->name('datamhskoor');
    Route::post('/koor-datamhs-updpembimbing', 'KoordinatorController@updpembimbing')->name('updpembimbing');

    Route::get('/koor-cekjadwal/{id}', 'KoordinatorController@cekjadwal')->name('cekjadwal');
    Route::post('/koor-storejadwal', 'KoordinatorController@storejadwal')->name('storejadwal');

    //nilai
    Route::get('/nilai-seminar-koor', ['uses' => 'DosenController@nilaiseminar2', 'as' => 'nilaiseminar']);
    Route::get('/nilai-seminar-koor-edit/{id}', ['uses' => 'DosenController@editnilaiseminar2', 'as' => 'editnilaiseminar']);
    Route::post('/nilai-seminar-koor-update/{id}', ['uses' => 'DosenController@updatenilaiseminar2', 'as' => 'updatenilaiseminar']);
    //end nilai

    Route::get('/bimbingan-mahasiswa', 'BimbinganController@koorindex')->name('bimbingan');
    Route::get('/bimbingan-reply/{id}', 'BimbinganController@koorreply')->name('bimbingan.reply');
    Route::post('/bimbingan-update/{id}', 'BimbinganController@koorreplyupdate')->name('bimbingan.update');
    Route::post('/bimbingan-updateacc', 'BimbinganController@koorreplyupdateacc')->name('bimbingan.updateacc');

    Route::post('/koor-sendberkasdosen', 'BerkasController@sendberkasdosen')->name('sendberkasdosen');


});

