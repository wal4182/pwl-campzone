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
Route::get('/', 'HomeController@client');
Route::get('home', 'HomeController@client')->name('home');
Route::group(['middleware' => 'is_admin'], function () {
  Route::get('admin', 'HomeController@admin')->name('admin.home')->middleware('is_admin');
  
  Route::resource('admin/brand','BrandController');
  Route::resource('admin/kategori','KategoriController');
  Route::resource('admin/list-produk','ProdukController');
  Route::resource('admin/rekening','RekeningController');
  Route::resource('admin/member', 'MemberController');

  Route::get('admin/pesanan', 'PesananController@index');
  Route::post('admin/pesanan/konfirmasi-pembayaran/{id}', 'PesananController@konfirmasiPembayaran');
  Route::post('admin/pesanan/batal-konfirmasi-pembayaran/{id}', 'PesananController@batalKonfirmasiPembayaran');
  Route::post('admin/pesanan/konfirmasi-pengambilan/{id}', 'PesananController@konfirmasiPengambilan');
  Route::post('admin/pesanan/batal-konfirmasi-pengambilan/{id}', 'PesananController@batalKonfirmasiPengambilan');
  Route::post('admin/pesanan/konfirmasi-pengembalian/{id}', 'PesananController@konfirmasiPengembalian');
  Route::post('admin/pesanan/batal-konfirmasi-pengembalian/{id}', 'PesananController@batalKonfirmasiPengembalian');
  
  Route::get('admin/pesanan-detail/{id}','PesananController@pesananDetail');

  Route::get('admin/laporan','LaporanController@index');
});

Route::resource('produk','Client\ProdukController');
Route::get('produk/brand/{brand}','Client\ProdukController@showBrand')->name('produk.show_brand');
Route::get('produk/brand/kategori/{kategori}','Client\ProdukController@showKategori')->name('produk.show_kategori');



Route::get('kontak', 'KontakController@index');

Route::get('profil','Client\ProfilController@index')->name('profil.index');
Route::get('profil/edit', 'Client\ProfilController@edit')->name('profil.edit');
Route::get('profil/avatar/edit', 'Client\ProfilController@editAvatar')->name('profil.edit_avatar');
Route::post('profil/update', 'Client\ProfilController@update')->name('profil.update');
Route::post('profil/avatar/update', 'Client\ProfilController@updateAvatar')->name('profil.update_avatar');
Route::post('profil/avatar/destroy', 'Client\ProfilController@destroyAvatar')->name('profil.destroy_avatar');


Route::get('rental/{id}', 'RentalController@index');
Route::post('rental/{id}', 'RentalController@store');


Route::get('checkout', 'RentalController@checkout');
Route::delete('checkout/{id}', 'RentalController@delete');


Route::get('pembayaran', 'PembayaranController@index');
Route::post('upload-bukti-pembayaran', 'PembayaranController@uploadBukti');

Route::get('pesanan', 'Client\PesananController@index');
Route::get('pesanan-detail/{id}','Client\PesananController@show');
