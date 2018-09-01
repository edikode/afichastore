<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Mail;

use App\Models\Konfirmasi;
use App\Models\Pemesanan;
use App\Models\Detailpemesanan;
use App\Models\Produk;
use App\Models\User;

class KonfirmasiAdmin extends Controller
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

        return view('admin/pemesanan/home', compact('pemesanan','jumlah'));
    }

    public function validasi($id)
    {
        $konfirmasi = Konfirmasi::where('id',$id)->first();
        $konfirmasi->konfirmasi = 1;
        

        $pemesanan = Pemesanan::where('invoice', $konfirmasi->invoice)->first();
        $pemesanan->konfirmasi = 1;
        $pemesanan->save();

        $detailpemesanan = Detailpemesanan::where("pemesanan_id",$pemesanan->pemesanan_id)->get();

        foreach ($detailpemesanan as $d) {
            $produk = Produk::findorfail($d->produk_id);
            $produk->stok = $produk->stok - $d->jumlah;
            $produk->save();
        }

        $pelanggan = User::findorfail($pemesanan->pelanggan_id);
        
        $data = array(
            'invoice'   => $konfirmasi->invoice, 
            'tgl_transfer' => $konfirmasi->created_at,
            'nama'      => $pelanggan->nama, 
            'total'     => $pemesanan->total+$pemesanan->ongkir
        );

        Mail::send('emails.admin.konfirmasi', $data, function($kirimpesan) use($pelanggan) {
            $kirimpesan->to($pelanggan->email, $pelanggan->nama)->from('cs@afichastore', 'cs@afichastore')->subject(' Email Konfirmasi Pembayaran');
        });

        if (Mail::failures()) {
            return redirect()->back();        
        } else {
           $konfirmasi->save();
           $pemesanan->save();
        }

        return redirect('admin/pemesanan');
    }

    public function nonvalidasi($id)
    {
        $konfirmasi = Konfirmasi::where('id',$id)->first();
        $konfirmasi->konfirmasi = 2;
        

        $pemesanan = Pemesanan::where('invoice', $konfirmasi->invoice)->first();
        $pemesanan->konfirmasi = 2;
        $pemesanan->save();

        $pelanggan = User::findorfail($pemesanan->pelanggan_id);
        
        $data = array(
            'invoice'   => $konfirmasi->invoice, 
            'tgl_transfer' => $konfirmasi->created_at,
            'nama'      => $pelanggan->nama, 
            'total'     => $pemesanan->total+$pemesanan->ongkir
        );

        Mail::send('emails.admin.tidakvalid', $data, function($kirimpesan) use($pelanggan) {
            $kirimpesan->to($pelanggan->email, $pelanggan->nama)->from('cs@afichastore', 'cs@afichastore')->subject(' Email Konfirmasi Pembayaran');
        });

        if (Mail::failures()) {
            return redirect()->back();        
        } else {
           $konfirmasi->save();
           $pemesanan->save();
        }

        return redirect('admin/pemesanan');
    }


}
