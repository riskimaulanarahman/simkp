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



Route::group( ['middleware' => ['auth','roleAdmin']], function() {

    Route::get('/dashboard-admin', function () {
        return view('pages/superadmin/home_admin');
    })->name('dashboard-admin');


    //Start Route Master User
    Route::get('/master-user', 'SA_MasterUserController@index')->name('sa-user-index');
    Route::get('/master-user/tambah', 'SA_MasterUserController@tambah')->name('sa-user-tambah');
    Route::post('/master-user/store', 'SA_MasterUserController@store')->name('sa-user-store');
    Route::get('/master-user/edit/{id}', 'SA_MasterUserController@edit')->name('sa-user-edit');
    Route::post('/master-user/update/{id}', 'SA_MasterUserController@update')->name('sa-user-update');
    Route::get('/master-user/deleted/{id}', 'SA_MasterUserController@deleted')->name('sa-user-deleted');
    //End

    //Start Route Master Mahasiswa
    Route::get('/master-mahasiswa', 'SA_MasterMahasiswaController@index')->name('sa-mahasiswa-index');
    Route::get('/master-mahasiswa/edit/{id}', 'SA_MasterMahasiswaController@edit')->name('sa-mahasiswa-edit');
    Route::post('/master-mahasiswa/update/{id}', 'SA_MasterMahasiswaController@update')->name('sa-mahasiswa-update');
    //End

    //Start Route Master Dosen
    Route::get('/master-dosen', 'SA_MasterDosenController@index')->name('sa-dosen-index');
    Route::get('/master-dosen/edit/{id}', 'SA_MasterDosenController@edit')->name('sa-dosen-edit');
    Route::get('/master-dosen/wali/{id}', 'SA_MasterDosenController@wali')->name('sa-dosen-wali');
    Route::post('/master-dosen/update/{id}', 'SA_MasterDosenController@update')->name('sa-dosen-update');
    //End

      //Start Route Master Koordinator
      Route::get('/master-koordinator', 'SA_MasterKoordinatorController@index')->name('sa-koordinator-index');
      Route::get('/master-koordinator/edit/{id}', 'SA_MasterKoordinatorController@edit')->name('sa-koordinator-edit');
      Route::post('/master-koordinator/update/{id}', 'SA_MasterKoordinatorController@update')->name('sa-koordinator-update');
      //End
  
      //Start Route Master Tendik
      Route::get('/master-tendik', 'SA_MasterTendikController@index')->name('sa-tendik-index');
      Route::get('/master-tendik/edit/{id}', 'SA_MasterTendikController@edit')->name('sa-tendik-edit');
      Route::post('/master-tendik/update/{id}', 'SA_MasterTendikController@update')->name('sa-tendik-update');
      //End

    //Start Route Master Jurusan
    Route::get('/master-jurusan', 'SA_MasterJurusanController@index')->name('sa-jurusan-index');
    Route::get('/master-jurusan/tambah', 'SA_MasterJurusanController@tambah')->name('sa-jurusan-tambah');
    Route::post('/master-jurusan/store', 'SA_MasterJurusanController@store')->name('sa-jurusan-store');
    Route::get('/master-jurusan/edit/{id}', 'SA_MasterJurusanController@edit')->name('sa-jurusan-edit');
    Route::post('/master-jurusan/update/{id}', 'SA_MasterJurusanController@update')->name('sa-jurusan-update');
    Route::get('/master-jurusan/deleted/{id}', 'SA_MasterJurusanController@deleted')->name('sa-jurusan-deleted');
    //End

     //Start Route Master Prodi
     Route::get('/master-prodi', 'SA_MasterProdiController@index')->name('sa-prodi-index');
     Route::get('/master-prodi/tambah', 'SA_MasterProdiController@tambah')->name('sa-prodi-tambah');
     Route::post('/master-prodi/store', 'SA_MasterProdiController@store')->name('sa-prodi-store');
     Route::get('/master-prodi/edit/{id}', 'SA_MasterProdiController@edit')->name('sa-prodi-edit');
     Route::post('/master-prodi/update/{id}', 'SA_MasterProdiController@update')->name('sa-prodi-update');
     Route::get('/master-prodi/deleted/{id}', 'SA_MasterProdiController@deleted')->name('sa-prodi-deleted');
     //End
    
});

