<?php

Auth::routes();

Route::get('aktivasi-akun/{token}/{email}', 'AktivasiEmailController@Aktivasi');

Route::get('/', 'HalamanController@index')->name('home');

Route::resource('akun', 'AkunController');
Route::get('akun/hapusgambar/{id}', 'AkunController@hapusGambar');
Route::get('tentang-kami', 'HalamanController@tentangkami');
Route::get('produk', 'HalamanController@produk');
Route::get('kategori/{link}', 'HalamanController@kategori');
Route::get('produk-detail/{link}', 'HalamanController@detailproduk');
Route::get('pencarian', 'HalamanController@pencarian');
Route::post('pencarian', 'HalamanController@hasilcari');

Route::get('pesan/{link}', 'PesanController@simpankeranjang');
Route::get('keranjang-belanja', 'PesanController@detailkeranjang');
Route::post('updateqty', 'PesanController@updateqty');
Route::get('hapuskeranjang', 'PesanController@hapuskeranjang');
Route::get('hapusitem/{id}', 'PesanController@hapusitem');
Route::post('ubahdetail', 'PesanController@ubahdetail');

Route::get('checkout', 'PesanController@selesaibelanja');
Route::post('checkout', 'PesanController@simpanalamat');

Route::post('pilih-alamat', 'PesanController@pilihalamat');
Route::get('tambah-alamat', 'PesanController@tambahalamat');
Route::post('selesai-belanja', 'PesanController@simpanbelanja');

Route::get('rajaongkir/cek_kabupaten/{prov}', 'PesanController@cekkabupaten');
Route::get('rajaongkir/getcost/{dest}/{kurir}', 'PesanController@getcost');
Route::get('rajaongkir/cost/{layanan}', 'PesanController@cost');

Route::get('status', 'StatusController@index');
Route::post('upload-pembayaran', 'StatusController@uploadpembayaran');

Route::resource('daftar', 'DaftarMemberController');

Route::group(['prefix' => 'admin'], function () 
{
    Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'AuthAdmin\LoginController@logout');
    Route::get('/password/reset', 'AuthAdmin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'AuthAdmin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'AuthAdmin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'AuthAdmin\ResetPasswordController@reset');

    Route::get('/dashboard', 'Admin\HomeAdmin@index')->name('admin.home');

    Route::get('produk/stokdarurat', 'Admin\ProdukAdmin@stokdarurat');
    Route::resource('produk', 'Admin\ProdukAdmin');
    Route::post('produk/tambahstok', 'Admin\ProdukAdmin@tambahstok');
    Route::post('produk/tambahstokdarurat', 'Admin\ProdukAdmin@tambahstokdarurat');
    Route::get('produk/hapusgambar/{id}', 'Admin\ProdukAdmin@hapusGambar');
    

    Route::resource('kategori', 'Admin\KategoriAdmin');

    Route::resource('profil-store', 'Admin\ProfilAdmin');
    Route::get('profil-store/hapusgambar/{id}', 'Admin\ProfilAdmin@hapusGambar');

    Route::resource('pengelola', 'Admin\PengelolaAdmin');
    Route::get('pengelola/hapusgambar/{id}', 'Admin\PengelolaAdmin@hapusGambar');

    Route::resource('pelanggan', 'Admin\PelangganAdmin');
    Route::get('pelanggan/hapusgambar/{id}', 'Admin\PelangganAdmin@hapusGambar');

    Route::resource('pemesanan', 'Admin\PemesananAdmin');
    Route::get('laporan', 'Admin\LaporanPenjualan@index');   
    Route::get('pemesanan/hapusgambar/{id}', 'Admin\PemesananAdmin@hapusGambar');   

    Route::get('validasi/{id}', 'Admin\KonfirmasiAdmin@validasi');
    Route::get('nonvalidasi/{id}', 'Admin\KonfirmasiAdmin@nonvalidasi'); 
});
