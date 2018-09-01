<?php 

use App\Library\Commond;

function Profil(){
	$profil = new Commond();
	$data = $profil->Profil();
	return $data;
}

//mencari kategori untuk detail : artikel, paket wisata
function Kategori_detail($id){
	$kategori = new Commond();
	$data = $kategori->Kategori_detail($id);
	return $data;
}

//untuk menampilkan data pemesanan
function Pelanggan($id){
	$pelanggan = new Commond();
	$data = $pelanggan->Pelanggan($id);
	return $data;
}

function Alamat($id){
	$alamat = new Commond();
	$data = $alamat->Alamat($id);
	return $data;
}

// untuk menampilkan detail produk
function DetailProduk($id){
	$detail = new Commond();
	$data = $detail->DetailProduk($id);
	return $data;
}

function ProdukBelanja($id){
	$detail = new Commond();
	$teks 	= "";
	$data = $detail->ProdukBelanja($id);
	$no = 1;
	foreach ($data as $d) {
		$produk = DetailProduk($d->produk_id);
		$teks .= $no++.'. '.$produk->nama . " x". $d->jumlah . "<br>";
	}
	// return die($id);
	return $teks;
}

// untuk cek konfirmasi
function CekKonfirmasi($invoice){
	$konfirmasi = new Commond();
	$data = $konfirmasi->CekKonfirmasi($invoice);
	return $data;
}

//menampilkan data info pemesanan
function InfoPemesanan(){
	$pemesanan = new Commond();
	$data = $pemesanan->InfoPemesanan();
	return $data;
}


//menampilkan data info stok
function InfoStok(){
	$stok = new Commond();
	$data = $stok->InfoStok();
	return $data;
}

//menampilkan data produk populer
function ProdukPopuler(){
	$produk = new Commond();
	$data = $produk->ProdukPopuler();
	return $data;
}
?>