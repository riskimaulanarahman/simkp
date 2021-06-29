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

// Route::get('/panduan', function () {
//     return view('pages/panduan');
// });
// Route::get('/cek-jadwal', 'HomeController@cekjadwal')->name('home.cekjadwal');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/register-mahasiswa', 'SA_MasterUserController@registermhs')->name('register-mahasiswa');
Route::post('/register-mahasiswa/store', 'SA_MasterUserController@storeregistermhs')->name('register-mahasiswa-store');

Route::get('/api/progresskp/{id}', 'ApprovalController@progresskp')->name('progresskp');
Route::get('/api/rollbackkp/{status}/{id}', 'ApprovalController@rollbackkp')->name('rollbackkp');
Route::get('/api/donekp/{id}', 'ApprovalController@donekp')->name('donekp');

Route::get('/api/seminar/{id}', 'TendikController@seminar')->name('seminar');
Route::get('/api/finish/{id}', 'TendikController@finish')->name('finish');

Route::group( ['middleware' => ['auth','cors','roleAdmin']], function() {

});