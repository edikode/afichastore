<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pemesanan;
use App\Models\Produk;
use App\Models\User;

class HomeAdmin extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
    	$admin = Auth::user()->name;
    	$produk = Produk::count();
    	$stok = Produk::where('stok','<=',5)->get();
    	$pelanggan = User::count();
    	$pemesanan = Pemesanan::where("konfirmasi",0)->count();
        $detailpemesanan = Pemesanan::orderby('id','desc')->paginate(5);
        return view('admin/dashboard',compact('admin','pemesanan','pelanggan','produk','stok','detailpemesanan'));
    }
}
