<?php

namespace App\Library;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Commond
{

    public function Profil(){
        $profil = DB::table('kontak')->first();
        return $profil;
    }

    public function Kategori_detail($id){
        $kategori = DB::table('kategori')->where('id', $id)->first();
        return $kategori;
    }

    public function Pelanggan($id){
        $pelanggan = DB::table('users')->where('id',$id)->first();
        return $pelanggan;
    }

    public function Alamat($id){
        $alamat = DB::table('alamat')->where('id',$id)->first();
        return $alamat;
    }

    public function DetailProduk($id){
        $produk = DB::table('produk')->where('id',$id)->first();
        return $produk;
    }

    public function ProdukBelanja($id){
        $detailpemesanan = DB::table('detail_pemesanan')->where('pemesanan_id',$id)->get();
        return $detailpemesanan;
    }

    public function CekKonfirmasi($invoice){
        $data = DB::table('konfirmasi')->where('invoice',$invoice)->first();
        return $data;
    }

    public function InfoPemesanan(){
        $pemesanan = DB::table('pemesanan')->where('konfirmasi', 0)->get();
        return $pemesanan;
    }

    public function InfoStok(){
        $stok = DB::table('produk')->where('stok','<=',5)->get();
        return $stok;
    }

    public function ProdukPopuler(){
        $data = DB::table('detail_pemesanan')->select('produk_id',  DB::raw('SUM(jumlah) as total'))->groupby('produk_id')->limit(3)->orderby('total','desc')->get();
        return $data;
    }
}
