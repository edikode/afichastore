<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Cart;
use Mail;
use Auth;
use RajaOngkir;
use App\Models\User;
use App\Models\Profil;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Alamat;
use App\Models\Pemesanan;
use App\Models\DetailPemesanan;

class PesanController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function simpankeranjang($link)
    {
    	$profil = Profil::first();
        $kategori = Kategori::all();
        $populer = ProdukPopuler();

        $detail = Produk::where('link',$link)->first();

        if($detail->stok > 0){
            Cart::add(['id' => $detail->id, 'name' => $detail->nama, 'gambar' => $detail->gambar, 'size' => 'L', 'keterangan' => 'KOSONG', 'price' => $detail->harga, 'qty' => 1, 'berat' => $detail->berat]);
        } else {
            Session::flash('flash_message', 'Stok '.$detail->link.' Habis, Silahkan pilih produk lain yang anda sukai.');

            // echo '<script type="text/javascript">alert("Stok '.$detail->nama.' Habis, Silahkan pilih produk lain yang anda sukai.");window.location.replace("'.url('produk').'")</script>';
            return redirect('produk');
        }
        return redirect('keranjang-belanja');
    }

    public function updateqty(Request $request)
    {
        $rowId = $request->rowId;
        $id = $request->id;
        $qty = $request->qty;
        $count = count($qty);

        for ($i=0; $i < $count; $i++) { 

            $detail = Produk::where('id', $id[$i])->first();

            if($detail->stok - $qty[$i] >= 0){
                Session::flash('flash_message', 'Jumlah Beli '.$detail->nama.' berhasil diperbarui');
                Cart::update($rowId[$i], $qty[$i]);
            } else {
                Session::flash('flash_message', 'Stok '.$detail->nama.' Sudah Habis, Menunggu Penambahan dari Admin');
                return redirect('keranjang-belanja');
            }
        }

        
        // die($berat);
        // Session::flash('flash_message', 'Jumlah Pesanan berhasil diperbarui');

        return redirect('keranjang-belanja');
    }

    public function ubahdetail(Request $request)
    {
        $rowId = $request->rowId;
        $id = $request->id;
        $qty = $request->qty;
        $size = $request->size;
        $keterangan = $request->keterangan;

        Cart::update($rowId, [
            'size' => $size,
            'keterangan' => $keterangan,
        ]);
         
        Session::flash('flash_message', 'Data Pesanan berhasil diperbarui');

        return redirect('keranjang-belanja');
    }

    public function hapusitem($id)
    {
        Cart::remove($id);

        return redirect('keranjang-belanja');
    }

    public function hapuskeranjang()
    {
        Cart::destroy();

        return redirect('keranjang-belanja');
    }

    public function detailkeranjang()
    {
		$profil = Profil::first();
        $kategori = Kategori::all();
        $produk = Produk::all();
        $semuaproduk = Produk::all();
        $populer = ProdukPopuler();
        return view('tema/keranjang-belanja', compact('profil','detail','produk','kategori','populer'));
    }

    public function selesaibelanja()
    {
		$profil = Profil::first();
        $kategori = Kategori::all();
        $produk = Produk::all();
        $semuaproduk = Produk::all();
        $populer = ProdukPopuler();
        $alamatsemua = Alamat::where('pelanggan_id', Auth::user()->id)->get();
        $alamat = Alamat::where('pelanggan_id', Auth::user()->id)->orderby('id','desc')->first();

        $pemesanan = Pemesanan::where('pelanggan_id',Auth::user()->id)->get();
        
        if(count($pemesanan)<1){
            $pemesanan = "kosong";
        }
        // dd($data);
        return view('tema/checkout', compact('profil','detail','produk','kategori','populer','alamatsemua','alamat','pemesanan'));
    }

    public function simpanalamat(Request $request)
    {
        $profil = Profil::first();
        $kategori = Kategori::all();
        $produk = Produk::all();
        $semuaproduk = Produk::all();
        $populer = ProdukPopuler();

        $provinsi = explode(",", $request->provinsi);
        $kabupaten = explode(",", $request->kabupaten);

        $alamat = new Alamat;
        $alamat->sebagai = $request->sebagai;
        $alamat->nama = $request->nama;
        $alamat->telepon = $request->telepon;
        $alamat->kode_pos = $request->kode_pos;
        $alamat->provinsi = $provinsi[0];
        $alamat->n_provinsi = $provinsi[1];
        $alamat->kabupaten = $kabupaten[0];
        $alamat->n_kabupaten = $kabupaten[1];
        $alamat->alamat = $request->alamat;
        $alamat->pelanggan_id = Auth::user()->id;
        $alamat->save();

        return redirect('checkout');
    }

    public function pilihalamat(Request $request)
    {
        $profil = Profil::first();
        $kategori = Kategori::all();
        $produk = Produk::all();
        $semuaproduk = Produk::all();
        $populer = ProdukPopuler();
        $alamatsemua = Alamat::where('pelanggan_id', Auth::user()->id)->get();
        $alamat = Alamat::where('pelanggan_id', Auth::user()->id)->where('id', $request->id_alamat)->first();

        $data = RajaOngkir::Provinsi()->find($alamat->provinsi);
        // dd($data);
        
        return view('tema/checkout', compact('profil','detail','produk','kategori','populer','alamatsemua','alamat'));
    }

    public function tambahalamat()
    {
        $profil = Profil::first();
        $kategori = Kategori::all();
        $produk = Produk::all();
        $semuaproduk = Produk::all();
        $populer = ProdukPopuler();
        $alamatsemua = Alamat::where('pelanggan_id', Auth::user()->id)->get();
        $alamat = Alamat::where('pelanggan_id', Auth::user()->id)->first();

        return view('tema/tambah-alamat', compact('profil','detail','produk','kategori','populer','alamatsemua','alamat'));
    }

    public function simpanbelanja(Request $request)
    {
        // dd($request);
        $layanan = explode(',',$request->layanan);
        $pemesanan = new Pemesanan;
        $pemesanan->invoice      = rand(000000,999999);
        $pemesanan->pelanggan_id = Auth::user()->id;
        $pemesanan->alamat_id    = $request->alamat_id;
        $pemesanan->jumlah       = Cart::count();
        $pemesanan->total        = angkaBiasa(Cart::subtotal());
        $pemesanan->ongkir       = $request->ongkir;
        $pemesanan->kurir        = $request->kurir;
        $pemesanan->layanan      = $layanan[1];
        $pemesanan->keterangan   = "";
        $pemesanan->save();

        //simpan detail belanja
        foreach(Cart::content() as $row){
            $detail = new DetailPemesanan;
            $detail->pemesanan_id = $pemesanan->id;
            $detail->produk_id = $row->id;
            $detail->jumlah = $row->qty;
            $detail->size = $row->size;
            $detail->keterangan = $row->keterangan;
            $detail->save();

            $produk = Produk::findorfail($row->id);
            $produk->stok = $produk->stok - $row->qty;
            $produk->save();
        }

        Cart::destroy();

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
        
        Mail::send('emails.pemesanan', $data, function($kirimpesan) use($pelanggan) {
            $kirimpesan->to($pelanggan->email, $pelanggan->nama)->from('cs@afichastore', 'cs@afichastore')->subject('Email Detail Pemesanan');
        });

        $stokdarurat = Produk::where('stok','<',5)->get();
        
        $datakirim = array(
            'stok'       => $stokdarurat, 
        );

        //notifikasi email stok darurat
        /*
        if(count($stokdarurat) > 0){

            Mail::send('emails.stokdarurat', $datakirim, function($kirimpesan) use($pelanggan) {
                $kirimpesan->to('wildanmadrawi@gmail.com', 'mas wildan')->from('cs@afichastore', 'cs@afichastore')->subject('Info Stok Kurang dari 5');
            });            
        }
        */
        
        if (Mail::failures()) {
            return redirect()->back();        
        } else {
            
        }

        return redirect('status');
    }

    public function cekkabupaten($prov)
    {
        $provinsi_id = $prov;
 
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$provinsi_id",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: 563b6d1fe883cc55cb374d08692ab9e0"
          ),
        ));
         
        $response = curl_exec($curl);
        $err = curl_error($curl);
         
        curl_close($curl);
         
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          //echo $response;
        }
         
        $data = json_decode($response, true);
        for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
            // echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
            echo '<option value="'.$data['rajaongkir']['results'][$i]['city_id'].','.$data['rajaongkir']['results'][$i]['city_name'].'">'.$data['rajaongkir']['results'][$i]['city_name'].'</option>';
        }
    }

    public function getcost(Request $request)
    {
        $asal = 42;
        
        $dest = $request->dest;
        $kurir = $request->kurir;
        $berat = 0;

        foreach(Cart::content() as $row){
            $berat = $berat + ($row->berat * $row->qty);
        }
        
        // die($berat);
        // die()

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=$asal&destination=$dest&weight=$berat&courier=$kurir",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 7df3af2c30f429201b702d80a6ce5ae2"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $data = json_decode($response, TRUE);

          echo '<option value="" selected disabled>Layanan yang tersedia</option>';

          for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {

                for ($l=0; $l < count($data['rajaongkir']['results'][$i]['costs']); $l++) {

                    echo '<option value="'.$data['rajaongkir']['results'][$i]['costs'][$l]['cost'][0]['value'].','.$data['rajaongkir']['results'][$i]['costs'][$l]['service'].'('.$data['rajaongkir']['results'][$i]['costs'][$l]['description'].')">';
                    echo $data['rajaongkir']['results'][$i]['costs'][$l]['service'].'('.$data['rajaongkir']['results'][$i]['costs'][$l]['description'].')</option>';

                }

          }
        }
    }

    public function cost(Request $request)
    {
        $biaya = explode(',', $request->layanan);
        $total = angkaBiasa(Cart::subtotal()) + $biaya[0];

        echo $biaya[0].','.$total;
    }
}
