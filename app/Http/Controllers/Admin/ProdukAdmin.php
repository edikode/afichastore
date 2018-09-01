<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Image;

use App\Models\Kategori;
use App\Models\Produk;

class ProdukAdmin extends Controller
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
        $jumlah = produk::count();
        $produk = produk::paginate(5);


        return view('admin/produk/home', compact('produk','jumlah'));
    }

    public function stokdarurat()
    {
        $jumlah = Produk::where('stok','<=',5)->count();
        $produk = Produk::where('stok','<=',5)->paginate(5);

        return view('admin/produk/stokdarurat', compact('produk','jumlah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/produk/tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = new  produk;

        $this->validate($request, [
            'nama'      => 'unique:produk,nama,'.$produk['id'],
            'berat'     => 'numeric|required',
            'harga'     => 'numeric|required',
            'gambar'    => 'sometimes|image|max:1000|mimes:jpeg,jpg,bmp,png',
        ]);

        $produk->nama = $request->nama;
        $produk->link = Str::slug($request->nama);
        $produk->teks = $request->teks;
        $produk->judul= $request->judul;
        $produk->berat= $request->berat;
        $produk->harga= str_replace(".", "", $request->harga);
        $produk->kategori_id = $request->kategori;

        if($request->hasFile('gambar')) {
            $produk->gambar = $this->UploadGambar($request, $produk->link);
        }

        $produk->save();

        Session::flash('flash_message', 'Data Produk Berhasil ditambah');

        return redirect('admin/produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Produk::findorfail($id);
        $kategori = Kategori::all();
        return view('admin/produk/edit',compact('produk','kategori'));
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
        $produk = Produk::findorfail($id);

        $this->validate($request, [
            'nama'      => 'unique:produk,nama,'.$produk['id'],
            'berat'     => 'numeric|required',
            'harga'     => 'numeric|required',
            'gambar'    => 'sometimes|image|max:1000|mimes:jpeg,jpg,bmp,png',
        ]);

        $produk->nama = $request->nama;
        $produk->link = Str::slug($request->nama);
        $produk->teks = $request->teks;
        $produk->judul= $request->judul;
        $produk->berat= $request->berat;
        $produk->harga= str_replace(".", "", $request->harga);
        $produk->kategori_id = $request->kategori;

        if($request->hasFile('gambar')) {
            $produk->gambar = $this->UploadGambar($request, $produk->link);
        }

        $produk->save();

        Session::flash('flash_message', 'Data Produk Berhasil diperbarui');

        return redirect('admin/produk/'.$produk->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);

        if($produk->gambar != ""){
            unlink(public_path('upload/produk/kecil/').$produk->gambar);
            unlink(public_path('upload/produk/sedang/').$produk->gambar);
        }

        $produk->delete();
        Session::flash('flash_message', 'Data '. $produk->nama .' Berhasil Dihapus');
        return redirect('admin/produk');
    }

    private function UploadGambar(Request $request, $link)
    {
        $gambar = $request->file('gambar');
        $ext    = $gambar->getClientOriginalExtension();

        if($request->file('gambar')->isValid()) {

            $gambar_nama = $link . ".$ext";
            $upload_path = "upload/produk/kecil";
            $upload_path2 = "upload/produk/sedang";
            $request->file('gambar')->move($upload_path, $gambar_nama);
            
            copy($upload_path. "/" .$gambar_nama, $upload_path2. "/" .$gambar_nama);

            $imgkecil = Image::make($upload_path. "/" .$gambar_nama);
            $imgkecil->fit(300, 350);
            $imgkecil->save();

            $imgsedang = Image::make($upload_path2. "/" .$gambar_nama);
            $imgsedang->fit(500, 650);
            $imgsedang->save();

            return $gambar_nama;
        }

        return false;
    }

    public function hapusGambar($id)
    {
        $produk = produk::find($id);

        if(file_exists(public_path('upload/produk/kecil/').$produk->gambar)) {
            unlink(public_path('upload/produk/kecil/').$produk->gambar);
        }

        if(file_exists(public_path('upload/produk/sedang/').$produk->gambar)) {
            unlink(public_path('upload/produk/sedang/').$produk->gambar);
        }

        $produk->gambar = "";
        Session::flash('flash_message', 'Gambar berhasil di hapus');
        $produk->save();

        return redirect('admin/produk/' . $id . '/edit');
    }

    public function tambahstok(Request $request)
    {
        $produk = Produk::findorfail($request->id);

        $this->validate($request, [
            'stok'     => 'numeric|required'
        ]);

        $produk->stok = $produk->stok+$request->stok;

        $produk->save();

        Session::flash('flash_message', 'Stok Produk Berhasil Ditambah');

        return redirect('admin/produk');
    }

    public function tambahstokdarurat(Request $request)
    {

        $produk = Produk::findorfail($request->id);

        $this->validate($request, [
            'stok'     => 'numeric|required'
        ]);

        $produk->stok = $produk->stok + $request->stok;
        // dd($produk->stok);
        $produk->save();
        Session::flash('flash_message', 'Stok Produk Berhasil Ditambah');

        return redirect('admin/produk/stokdarurat');
    }

    
}
