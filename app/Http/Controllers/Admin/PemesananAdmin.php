<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;

use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use App\Models\Konfirmasi;

class PemesananAdmin extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/pemesanan/tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p = pemesanan::findorfail($id);
        $pelanggan = Pelanggan($p->pelanggan_id);
        $alamat = Alamat($p->alamat_id);
        $detail = DetailPemesanan::where('pemesanan_id',$id)->get();
        return view('admin/pemesanan/lihat',compact('p','pelanggan','alamat','detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pemesanan = pemesanan::findorfail($id);
        return view('admin/pemesanan/edit',compact('pemesanan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pemesanan = pemesanan::findorfail($id);

        $this->validate($request, [
            'telepon'     => 'numeric|required'
        ]);

        $pemesanan->nama = $request->nama;
        $pemesanan->email = $request->email;
        $pemesanan->telepon = $request->telepon;
        $pemesanan->alamat = $request->alamat;

        $pemesanan->save();

        Session::flash('flash_message', 'Data pemesanan Berhasil diperbarui');

        return redirect('admin/pemesanan/'.$pemesanan->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pemesanan = pemesanan::find($id);

        $detailpemesanan = DetailPemesanan::where("pemesanan_id",$pemesanan->id)->get();
        if(count($detailpemesanan)>0){
            foreach ($detailpemesanan as $detail) {
                $detail->delete();
            }
        }

        $konfirmasi = Konfirmasi::where('invoice',$pemesanan->invoice)->get();
        if(count($konfirmasi)>0){
            foreach ($konfirmasi as $k) {
                $k->delete();
            }
        }

        $pemesanan->delete();
        Session::flash('flash_message', 'Data '. $pemesanan->nama .' Berhasil Dihapus');
        return redirect('admin/pemesanan');
    }

}
