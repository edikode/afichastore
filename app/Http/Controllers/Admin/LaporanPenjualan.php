<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;

use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use App\Models\Konfirmasi;

class LaporanPenjualan extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jumlah = Pemesanan::count();
        $pemesanan = Pemesanan::orderby('id','desc')->paginate(20);

        return view('admin/laporan/home', compact('pemesanan','jumlah'));
    }
}