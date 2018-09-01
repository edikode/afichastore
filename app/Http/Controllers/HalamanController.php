<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Profil;
use App\Models\Kategori;
use App\Models\Produk;

class HalamanController extends Controller
{
    public function index()
    {
    	$profil = Profil::first();
        $kategori = Kategori::all();
        $populer = ProdukPopuler();
        $produk_terbaru = Produk::orderby('id', 'desc')->limit(6)->get();
        $semuaproduk = Produk::all();
        return view('tema/home', compact('profil','produk_terbaru','populer','kategori','semuaproduk'));
    }

    public function tentangkami()
    {
    	$profil = Profil::first();
        $produk = Produk::all();
        $populer = ProdukPopuler();
        $kategori = Kategori::all();
    	return view('tema/tentang-kami', compact('profil','produk','populer','kategori'));
    }

    public function produk()
    {
    	$profil = Profil::first();
        $kategori = Kategori::all();
        $produk_menarik = Produk::all();
        $semuaproduk = Produk::paginate(9);
        $populer = ProdukPopuler();

        return view('tema/produk', compact('profil','produk_menarik','populer','kategori','semuaproduk'));
    }

    public function kategori($link)
    {
    	$profil = Profil::first();
        $kategori = Kategori::all();
        $populer = ProdukPopuler();
        $kat = Kategori::where('link',$link)->first();
        $produk = Produk::where('kategori_id',$kat->id)->paginate(9);
        return view('tema/kategori', compact('profil','kat','kategori','populer','produk'));
    }

    public function detailproduk($link)
    {
        $profil = Profil::first();
        $detail = Produk::where('link',$link)->first();
        $detail->dilihat = $detail->dilihat+1;
        $detail->save();

        $produk = Produk::all();
        $populer = ProdukPopuler();
        $kategori = Kategori::all();
        return view('tema/detail-produk', compact('profil','detail','produk','kategori','populer'));
    }

    public function pencarian()
    {
        $profil = Profil::first();
        $kategori = Kategori::all();
        $produk_menarik = Produk::all();
        $populer = ProdukPopuler();
        $semuaproduk = Produk::paginate(9);
        return view('tema/pencarian', compact('profil','produk_menarik','populer','kategori','semuaproduk','populer'));
    }

    public function hasilcari(Request $request)
    {
        $keyword = $request->keyword;
        $profil = Profil::first();
        $kategori = Kategori::all();
        $produk_menarik = Produk::all();
        $populer = ProdukPopuler();
        $semuaproduk = Produk::where('judul','like','%'.$keyword.'%')->paginate(9);
        return view('tema/pencarian', compact('profil','produk_menarik','kategori','semuaproduk','populer','keyword'));
    }
}
