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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/user','UserController');
Route::get('/user/hapus/{id}','UserController@destroy');
Route::get('/user/edit/{id}','UserController@edit');
Route::resource('/barang','BarangController');
Route::get('/barang/hapus/{id}','BarangController@destroy');
Route::get('/barang/edit/{id}','BarangController@edit');
Route::resource('/supplier','SupplierController');
Route::get('/supplier/hapus/{id}','SupplierController@destroy');
Route::get('/supplier/edit/{id}','SupplierController@edit');
Route::resource('/akun','AkunController');
Route::get('/akun/edit/{id}','AkunController@edit');
Route::get('/akun/hapus/{kode}','AkunController@destroy');
Route::get('/setting','SettingController@index')->name('setting.transaksi');
Route::post('/setting/simpan','SettingController@simpan');
//Pemesanan
Route::get('/transaksi', 'PemesananController@index')->name('pemesanan.transaksi');
Route::post('/sem/store', 'PemesananController@store');
Route::get('/transaksi/hapus/{kd_brg}','PemesananController@destroy');
//Detail Pesan
Route::post('/detail/simpan', 'DetailPesanController@store');
//Pembelian
Route::get('/pembelian', 'PembelianController@index')->name('pembelian.transaksi');
Route::get('/pembelian-beli/{id}', 'PembelianController@edit');
Route::post('/pembelian/store', 'PembelianController@store');
//Retur 
Route::get('/retur','ReturController@index')->name('retur.transaksi');
Route::get('/retur-beli/{id}', 'ReturController@edit');
Route::post('/retur/store', 'ReturController@store');
Route::get('/transaksi/hapus/{no_beli}', 'ReturController@destroy');
//laporan
Route::resource( '/laporan' , 'LaporanController');
Route::resource( '/stok' , 'LapStokController');
//laporan cetak
Route::get('/laporancetak/cetak_pdf', 'LaporanController@cetak_pdf');
Route::get('Laporan/faktur/{invoice}', 'PembelianController@pdf')->name('cetak.order_pdf');
Route::get('Laporan/stok_pdf', 'LapstokController@pdf')->name('cetak.stok_pdf');
//Pilih Sepatu
Route::get('/transaksisepatu', 'PilihSepatuController@index')->name('pilihsepatu.transaksisepatu');
Route::post('/semsepatu/store', 'PilihSepatuController@store');
Route::get('/transaksisepatu/hapus/{kd_brg}','PilihSepatuController@destroy');
//Pilih Fashion Muslim
Route::get('/transaksimuslim', 'PilihMuslimController@index')->name('pilihmuslim.transaksimuslim');
Route::post('/semmuslim/store', 'PilihMuslimController@store');
Route::get('/transaksimuslim/hapus/{kd_brg}','PilihMuslimController@destroy');
//Pilih Handicraft
Route::get('/transaksicraft', 'PilihCraftController@index')->name('pilihcraft.transaksicraft');
Route::post('/semcraft/store', 'PilihCraftController@store');
Route::get('/transaksicraft/hapus/{kd_brg}','PilihCraftController@destroy');
//Detail Pilih
Route::post('/detail/store', 'DetailPilihController@store');
//keranjang
Route::get('/keranjang', 'KeranjangController@index')->name('keranjang.transaksi');
Route::get('/keranjang-checkout/{id}', 'KeranjangController@edit');
Route::post('/keranjang/store', 'KeranjangController@store');
Route::get('/transaksi/hapus/{kd_brg}', 'KeranjangController@destroy');
//laporan cetak
Route::get('Laporan/invoice/{invoice}', 'KeranjangController@pdf')->name('cetak.salesorder_pdf');

