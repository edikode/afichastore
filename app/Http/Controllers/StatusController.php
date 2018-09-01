<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use Session;
use Cart;
use Image;
use Auth;
use App\Models\Profil;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Konfirmasi;
use App\Models\Pemesanan;
use App\Models\User;

class StatusController extends Controller
{
    public function index()
    {
    	$profil = Profil::first();
        $kategori = Kategori::all();
        $populer = Produk::all();
        $pemesanan = Pemesanan::where('pelanggan_id',Auth::user()->id)->get();

        if(count($pemesanan)<1){
        	$pemesanan = "kosong";
        }

    	return view('tema/status', compact('profil','populer','kategori','pemesanan'));
    }

    public function uploadpembayaran(Request $request)
    {
    	$cek = Konfirmasi::where("invoice",$request->invoice)->first();
    	if(count($cek)){
			$cek->invoice = $request->invoice;
			$gambar = $cek->invoice;
	    	if($request->hasFile('gambar')) {
	            $cek->gambar = $this->UploadGambar($request, $gambar);
                $cek->konfirmasi = 0;
	        }

            $pemesanan = Pemesanan::where('invoice',$cek->invoice)->first();
            $pemesanan->konfirmasi = 0;
            $pemesanan->save();
            $pelanggan = User::findorfail(Auth::user()->id);

            $data = array(
                'invoice'       => $pemesanan->invoice, 
                'tanggal_pesan' => date("d-m-Y"),
                'pemesanan_id'  => $pemesanan->id, 
                'pelanggan_id'  => $pemesanan->pelanggan_id, 
                'alamat_id'     => $pemesanan->alamat_id, 
                'jumlah'        => $pemesanan->jumlah, 
                'total'         => $pemesanan->total, 
                'ongkir'        => $pemesanan->ongkir, 
                'kurir'         => $pemesanan->kurir,
                'layanan'       => $pemesanan->layanan
            );
            
            Mail::send('emails.notifikasiadmin', $data, function($kirimpesan) use($pelanggan) {
                $kirimpesan->to('wildanmadrawi@gmail.com', 'mas wildan')->from('cs@afichastore', 'cs@afichastore')->subject('Email Detail Pemesanan');
            });

            if (Mail::failures()) {
                return redirect()->back();        
            } else {
                $cek->save();
            }
	        
    	} else {
			$konfirmasi = new Konfirmasi;
			$konfirmasi->invoice = $request->invoice;
			$gambar = $konfirmasi->invoice;
	    	if($request->hasFile('gambar')) {
	            $konfirmasi->gambar = $this->UploadGambar($request, $gambar);
	        }

            $pemesanan = Pemesanan::where('invoice',$konfirmasi->invoice)->first();
            $pelanggan = User::findorfail(Auth::user()->id);

            $data = array(
                'invoice'       => $pemesanan->invoice, 
                'tanggal_pesan' => date("d-m-Y"),
                'pemesanan_id'  => $pemesanan->id, 
                'pelanggan_id'  => $pemesanan->pelanggan_id, 
                'alamat_id'     => $pemesanan->alamat_id, 
                'jumlah'        => $pemesanan->jumlah, 
                'total'         => $pemesanan->total, 
                'ongkir'        => $pemesanan->ongkir, 
                'kurir'         => $pemesanan->kurir,
                'layanan'       => $pemesanan->layanan
            );
            
            Mail::send('emails.notifikasiadmin', $data, function($kirimpesan) use($pelanggan) {
                $kirimpesan->to('wildanmadrawi@gmail.com', 'mas wildan')->from('cs@afichastore', 'cs@afichastore')->subject('Email Detail Pemesanan');
            });

            if (Mail::failures()) {
                return redirect()->back();        
            } else {
	            $konfirmasi->save();
            }
       }

    	return redirect('status');
    }

    private function UploadGambar(Request $request, $link)
    {
        $gambar = $request->file('gambar');
        $ext    = $gambar->getClientOriginalExtension();

        if($request->file('gambar')->isValid()) {

            $gambar_nama = $link . ".$ext";
            $upload_path = "upload/pembayaran/kecil";
            $upload_path2 = "upload/pembayaran/sedang";
            $request->file('gambar')->move($upload_path, $gambar_nama);
            
            copy($upload_path. "/" .$gambar_nama, $upload_path2. "/" .$gambar_nama);

            $imgkecil = Image::make($upload_path. "/" .$gambar_nama);
            $imgkecil->fit(400, 400);
            $imgkecil->save();

            $imgsedang = Image::make($upload_path2. "/" .$gambar_nama);
            $imgsedang->save();

            return $gambar_nama;
        }

        return false;
    }
}
