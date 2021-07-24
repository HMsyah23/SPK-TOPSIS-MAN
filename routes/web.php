<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
})->name('awal');


Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/cek', 'KriteriaController@cek')->name('cekStatus');
Route::get('/cek/{id}', 'KriteriaController@ketemu')->name('ketemu');


Route::get('/pelamar/register', 'PelamarController@daftar')->name('pelamar.daftar');
Route::post('/pelamar/register', 'PelamarController@kirim')->name('pelamar.kirim');

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'admin','middleware' => 'auth'], function()
    {
        Route::get('dashboard', 'HomeController@index')->name('admin.dashboard');
        Route::get('users', 'AkunController@index')->name('users.index');
        Route::post('users', 'AkunController@store')->name('users.store');
        Route::get('users/{id}', 'AkunController@show')->name('admin.password');
        Route::post('users/delete/{id}', 'AkunController@destroy')->name('admin.user.destroy');
        Route::resource('calon','CalonPenerimaController');
        Route::resource('kriteria', 'KriteriaController');
        Route::get('topsis/ranking', 'HomeController@topsis')->name('ranking.detail');
        Route::get('topsis', 'HomeController@rank')->name('ranking.index');
        Route::post('gantiPassword/{id}', 'AkunController@ganti')->name('admin.ganti');

        // Laporan
        Route::get('/laporan/ranking','LaporanController@laporanRanking')->name('laporan.ranking');
        Route::get('/laporan/pelamar/{id}','LaporanController@laporanPelamar')->name('laporan.pelamar');
    });
    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
