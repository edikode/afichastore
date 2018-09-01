<?php

Auth::routes();


Route::get('/', 'HomeController@index');
Route::get('pencarian', 'PencarianController@index');

// $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// $this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('daftar-reff', 'Daftar@FormReff');
Route::post('daftar-reff', 'Daftar@DaftarReff');

Route::get('/{link}', 'HalamanController@index');
Route::get('artikel/{link}', 'ArtikelController@kategori');
Route::get('detail-artikel/{link}', 'ArtikelController@index');
Route::get('paket-wisata/{link}', 'PaketController@kategori');
Route::get('detail-paket/{link}', 'PaketController@index');
Route::post('daftar-tour/{invoice}', 'Daftar@DaftarTour');
Route::get('detail-pemesanan/{invoice}', 'Daftar@DetailPemesanan');
Route::post('detail-pemesanan/{invoice}', 'Daftar@SimpanPemesanan');
Route::get('konfirmasi/{invoice}', 'Daftar@konfirmasi');
Route::post('konfirmasi/{invoice}', 'Daftar@SimpanKonfirmasi');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () 
{
    Route::get('home', 'Admin\HomeAdmin@index');

    Route::get('/login', 'AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');
    Route::get('/password/reset', 'AuthAdmin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'AuthAdmin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'AuthAdmin\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'AuthAdmin\ResetPasswordController@reset');

    Route::get('halaman/', 'Admin\HalamanAdmin@index');
	Route::get('halaman/aktif/{id}', 'Admin\HalamanAdmin@aktif');
	Route::get('halaman/nonaktif/{id}', 'Admin\HalamanAdmin@nonaktif');
	Route::post('halaman/tambah', 'Admin\HalamanAdmin@tambah');
	Route::get('halaman/edit/{id}', 'Admin\HalamanAdmin@edit');
	Route::put('halaman/edit/{id}', 'Admin\HalamanAdmin@update');
	Route::get('halaman/hapus/{id}', 'Admin\HalamanAdmin@hapus');
	Route::get('halaman/hapusgambar/{id}', 'Admin\HalamanAdmin@hapusGambar');

	Route::post('halaman/uploads/{id}', 'Admin\HalamanAdmin@UploadGambarBanyak');
	Route::get('halaman/hapusgambarbanyak/{halaman_id}/{id}', 'Admin\HalamanAdmin@hapusGambarBanyak');

	Route::put('halaman/tambah-fitur/{id}', 'Admin\FiturAdmin@tambah');
	Route::get('halaman/hapusfitur/{id}/{halaman_id}', 'Admin\FiturAdmin@hapus');
	Route::get('fitur/edit/{id}/{halaman_id}', 'Admin\FiturAdmin@edit');
	Route::put('fitur/edit/{id}/{halaman_id}', 'Admin\FiturAdmin@update');
	Route::post('fitur/sortir', 'Admin\FiturAdmin@sortir');

	Route::get('galeri/', 'Admin\GaleriAdmin@index');
	Route::post('galeri/edit', 'Admin\GaleriAdmin@update');
	Route::post('galeri/uploads/', 'Admin\GaleriAdmin@UploadGambarBanyak');
	Route::get('galeri/hapusgambarbanyak/{id}', 'Admin\GaleriAdmin@hapusGambarBanyak');

	Route::get('pengaturan-menu/', 'Admin\PengaturanMenuAdmin@index');
	Route::post('pengaturan-menu/sortir', 'Admin\PengaturanMenuAdmin@sortir');
	Route::post('pengaturan-menu/tambah', 'Admin\PengaturanMenuAdmin@tambah');
	Route::put('pengaturan-menu/edit/{id}', 'Admin\PengaturanMenuAdmin@update');
	Route::get('pengaturan-menu/hapus/{id}', 'Admin\PengaturanMenuAdmin@hapus');

	Route::get('pengaturan-kontak/', 'Admin\PengaturanKontakAdmin@index');
	Route::post('pengaturan-kontak/edit', 'Admin\PengaturanKontakAdmin@update');
	Route::get('pengaturan-kontak/hapusgambar/{id}', 'Admin\PengaturanKontakAdmin@hapusGambar');

	Route::get('sidebar-1/', 'Admin\SidebarAdmin@index');
	Route::post('sidebar-1/tambah', 'Admin\SidebarAdmin@tambah');
	Route::put('sidebar-1/edit/{id}', 'Admin\SidebarAdmin@update');
	Route::get('sidebar-1/hapus/{id}', 'Admin\SidebarAdmin@hapus');
	Route::post('sidebar-1/sortir', 'Admin\SidebarAdmin@sortir');

	Route::get('sidebar-2/', 'Admin\SidebarAdmin@tampil');
	Route::post('sidebar-2/tambah', 'Admin\SidebarAdmin@tambah2');
	Route::put('sidebar-2/edit/{id}', 'Admin\SidebarAdmin@update2');
	Route::get('sidebar-2/hapus/{id}', 'Admin\SidebarAdmin@hapus2');
	Route::post('sidebar-2/sortir', 'Admin\SidebarAdmin@sortir');

	Route::get('paket/', 'Admin\PaketAdmin@index');
	Route::get('paket/aktif/{id}', 'Admin\PaketAdmin@aktif');
	Route::get('paket/nonaktif/{id}', 'Admin\PaketAdmin@nonaktif');
	Route::post('paket/tambah', 'Admin\PaketAdmin@tambah');
	Route::get('paket/edit/{id}', 'Admin\PaketAdmin@edit');
	Route::put('paket/edit/{id}', 'Admin\PaketAdmin@update');
	Route::get('paket/hapus/{id}', 'Admin\PaketAdmin@hapus');
	Route::get('paket/hapusgambar/{id}', 'Admin\PaketAdmin@hapusGambar');

	Route::post('paket/uploads/{id}', 'Admin\PaketAdmin@UploadGambarBanyak');
	Route::get('paket/hapusgambarbanyak/{paket_id}/{id}', 'Admin\PaketAdmin@hapusGambarBanyak');

	Route::get('reservasi/', 'Admin\ReservasiAdmin@index');
	Route::get('reservasi/lihat/{id}', 'Admin\ReservasiAdmin@lihat');
	Route::get('reservasi/bayar/{id}', 'Admin\ReservasiAdmin@bayar');
	Route::get('reservasi/arsip/{id}', 'Admin\ReservasiAdmin@arsip');
	Route::get('reservasi/hapus/{id}', 'Admin\ReservasiAdmin@hapus');

	Route::get('konfirmasi/', 'Admin\KonfirmasiAdmin@index');
	Route::get('konfirmasi/lihat/{id}', 'Admin\KonfirmasiAdmin@lihat');
	Route::get('konfirmasi/validasi/{id}', 'Admin\KonfirmasiAdmin@validasi');
	Route::get('konfirmasi/non-validasi/{id}', 'Admin\KonfirmasiAdmin@nonvalidasi');	
	Route::get('konfirmasi/hapus/{id}', 'Admin\KonfirmasiAdmin@hapus');
	Route::get('konfirmasi/edit/{id}', 'Admin\KonfirmasiAdmin@edit');
	Route::put('konfirmasi/edit/{id}', 'Admin\KonfirmasiAdmin@update');
	Route::get('konfirmasi/hapusgambar/{id}', 'Admin\KonfirmasiAdmin@hapusGambar');

	Route::get('laporan/cetak/{bulan}/{tahun}', 'Admin\LaporanAdmin@cetakLaporan');
	Route::get('laporan/', 'Admin\LaporanAdmin@index');
	Route::post('laporan/', 'Admin\LaporanAdmin@Tampil');
	Route::get('laporan/cetak/{bulan}', 'Admin\LaporanAdmin@cetakLaporan');
	Route::get('analisa/', 'Admin\LaporanAdmin@Analisa');

	Route::get('artikel/', 'Admin\ArtikelAdmin@index');
	Route::get('artikel/aktif/{id}', 'Admin\ArtikelAdmin@aktif');
	Route::get('artikel/nonaktif/{id}', 'Admin\ArtikelAdmin@nonaktif');
	Route::post('artikel/tambah', 'Admin\ArtikelAdmin@tambah');
	Route::get('artikel/edit/{id}', 'Admin\ArtikelAdmin@edit');
	Route::put('artikel/edit/{id}', 'Admin\ArtikelAdmin@update');
	Route::get('artikel/hapus/{id}', 'Admin\ArtikelAdmin@hapus');
	Route::get('artikel/hapusgambar/{id}', 'Admin\ArtikelAdmin@hapusGambar');

	Route::get('kategori-paket/', 'Admin\KategoriPaketAdmin@index');
	Route::get('kategori-paket/aktif/{id}', 'Admin\KategoriPaketAdmin@aktif');
	Route::get('kategori-paket/nonaktif/{id}', 'Admin\KategoriPaketAdmin@nonaktif');
	Route::post('kategori-paket/tambah', 'Admin\KategoriPaketAdmin@tambah');
	Route::get('kategori-paket/edit/{id}', 'Admin\KategoriPaketAdmin@edit');
	Route::put('kategori-paket/edit/{id}', 'Admin\KategoriPaketAdmin@update');
	Route::get('kategori-paket/hapus/{id}', 'Admin\KategoriPaketAdmin@hapus');

	Route::get('kategori-artikel/', 'Admin\KategoriArtikelAdmin@index');
	Route::get('kategori-artikel/aktif/{id}', 'Admin\KategoriArtikelAdmin@aktif');
	Route::get('kategori-artikel/nonaktif/{id}', 'Admin\KategoriArtikelAdmin@nonaktif');
	Route::post('kategori-artikel/tambah', 'Admin\KategoriArtikelAdmin@tambah');
	Route::get('kategori-artikel/edit/{id}', 'Admin\KategoriArtikelAdmin@edit');
	Route::put('kategori-artikel/edit/{id}', 'Admin\KategoriArtikelAdmin@update');
	Route::get('kategori-artikel/hapus/{id}', 'Admin\KategoriArtikelAdmin@hapus');

	Route::get('pengguna/', 'Admin\UserAdmin@index');
	Route::get('pengguna/aktif/{id}', 'Admin\UserAdmin@aktif');
	Route::get('pengguna/nonaktif/{id}', 'Admin\UserAdmin@nonaktif');
	Route::post('pengguna/tambah', 'Admin\UserAdmin@tambah');
	Route::get('pengguna/edit/{id}', 'Admin\UserAdmin@edit');
	Route::put('pengguna/edit/{id}', 'Admin\UserAdmin@update');
	Route::get('pengguna/hapus/{id}', 'Admin\UserAdmin@hapus');
	Route::get('pengguna/hapusgambar/{id}', 'Admin\UserAdmin@hapusGambar');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () 
{
	Route::get('referral/', 'Admin\ReferralAdmin@index');
	Route::get('referral/aktif/{id}', 'Admin\ReferralAdmin@aktif');
	Route::get('referral/nonaktif/{id}', 'Admin\ReferralAdmin@nonaktif');
	Route::post('referral/tambah', 'Admin\ReferralAdmin@tambah');
	Route::get('referral/edit/{id}', 'Admin\ReferralAdmin@edit');
	Route::put('referral/edit/{id}', 'Admin\ReferralAdmin@update');
	Route::get('referral/hapus/{id}', 'Admin\ReferralAdmin@hapus');
	Route::get('referral/hapusgambar/{id}', 'Admin\ReferralAdmin@hapusGambar');
	Route::get('referral/lihat/{id}', 'Admin\ReferralAdmin@Detail');
	Route::get('referral/bayar/{id}', 'Admin\ReferralAdmin@BayarKomisi');
});
