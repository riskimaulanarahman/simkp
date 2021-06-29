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

Route::get('/detail-bimbingan-mahasiswa/{id_mhs}/{id_dosen}', ['uses' => 'BimbinganController@detailbimbinganmhs', 'as' => 'dosen.detailbimbinganmhs']);
Route::get('/tahapanaccmhs/{idformkp}', ['uses' => 'BimbinganController@tahapanaccmhs', 'as' => 'dosen.tahapanaccmhs']);

Route::group( ['middleware' => ['auth','cors','roleDosen']], function() {

    Route::get('/dashboard-dosen', function () {
        return view('pages/dosen/home_dosen');
    })->name('dashboard-dosen');

    Route::post('/dosen-sendberkasdosen', 'BerkasController@sendberkasdosen')->name('dosen.sendberkasdosen');

    Route::get('/dosen-request', 'ApprovalController@reqdosenwali')->name('dosen.request.index');
    Route::get('/dosen-approval', 'ApprovalController@accdosenwali')->name('dosen.request.approval');

    Route::get('/data-mahasiswa', 'BimbinganController@dosenindex')->name('dosen.bimbingan');
    Route::get('/dosen-bimbingan-reply/{id}', 'BimbinganController@dosenreply')->name('dosen.bimbingan.reply');
    Route::post('/dosen-bimbingan-update/{id}', 'BimbinganController@dosenreplyupdate')->name('dosen.bimbingan.update');
    Route::post('/dosen-bimbingan-updateacc', 'BimbinganController@dosenreplyupdateacc')->name('dosen.bimbingan.updateacc');

    // nilai
    Route::get('/nilai-seminar', ['uses' => 'DosenController@nilaiseminar', 'as' => 'dosen.nilaiseminar']);
    Route::get('/nilai-seminar-edit/{id}', ['uses' => 'DosenController@editnilaiseminar', 'as' => 'dosen.editnilaiseminar']);
    Route::post('/nilai-seminar-update/{id}', ['uses' => 'DosenController@updatenilaiseminar', 'as' => 'dosen.updatenilaiseminar']);
    //end nilai

});

