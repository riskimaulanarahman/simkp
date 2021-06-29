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

Route::group( ['middleware' => ['auth','cors','roleMahasiswa']], function() {

    Route::get('/dashboard-mahasiswa', function () {
        return view('pages/mahasiswa/home_mahasiswa');
    })->name('dashboard-mahasiswa');
    
    Route::get('mahasiswa-bimbingan-koor', 'BimbinganController@mhskoorindex')->name('mahasiswa.bimbingan.koor');
    Route::post('mahasiswa-bimbingan-koor/store', 'BimbinganController@koorstore')->name('mahasiswa.bimbingan.koorstore');

    Route::post('mahasiswa-uploadberkas', 'BerkasController@uploadberkasmhs')->name('uploadberkasmhs');

    Route::get('mahasiswa-bimbingan-dosen', 'BimbinganController@mhsdosenindex')->name('mahasiswa.bimbingan.dosen');
    Route::post('mahasiswa-bimbingan-dosen/store', 'BimbinganController@dosenstore')->name('mahasiswa.bimbingan.dosenstore');
    
    Route::get('pengajuan-kp', 'PendaftaranController@index')->name('mahasiswa.pengajuan');
    Route::get('pengajuan-kp-tambah', 'PendaftaranController@add')->name('mahasiswa.pengajuan.add');
    Route::post('pengajuan-kp/store', 'PendaftaranController@storekp')->name('mahasiswa.pengajuan.store');

    Route::get('my-berkas', 'BerkasController@berkasmhs')->name('myberkas');
 
    Route::get('mhs-aksi-bimbingan', 'BimbinganController@aksibimbingan')->name('mhs.aksi.bimbingan');
    


});

