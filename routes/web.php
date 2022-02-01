<?php

use App\Events\MessageCreated;
use Illuminate\Support\Facades\Auth;
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
Route::get('/symlink', function () {
    Artisan::call('storage:link');
});

Route::get('/', 'AuthController@index')->name('auth');

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');        
    Route::resource('/user', 'UserController');
    Route::resource('/profile', 'ProfileController');
    Route::resource('/produk', 'ProdukController');
    Route::resource('/detailtransaksi', 'DetailTransferController');
    Route::resource('/kategori', 'KategoriController');
    Route::get('/transaksi', 'TransaksiController@index')->name('transaksi');
    Route::get('/transaksi/batal/{id}', 'TransaksiController@batal')->name('transaksiBatal');
    Route::get('/transaksi/proses/{id}', 'TransaksiController@proses')->name('transaksiProses');
    Route::get('/transaksi/kirim/{id}', 'TransaksiController@kirim')->name('transaksiKirim');
    Route::get('/transaksi/selesai/{id}', 'TransaksiController@selesai')->name('transaksiSelesai');
    Route::get('/transaksi/detail/{id}', 'TransaksiController@detail')->name('detailtransaksi');
    Route::get('/daftartoko', 'DaftarTokoController@index')->name('daftartoko');
});