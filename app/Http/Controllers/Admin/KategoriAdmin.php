<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;

use App\Models\Kategori;

class KategoriAdmin extends Controller
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
        $jumlah = kategori::count();
        $kategori = kategori::paginate(20);

        return view('admin/kategori/home', compact('kategori','jumlah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/kategori/tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kategori = new  kategori;

        $this->validate($request, [
            'nama'      => 'unique:kategori,nama,'.$kategori['id'],
        ]);

        $kategori->nama = $request->nama;
        $kategori->link = Str::slug($request->nama);

        $kategori->save();

        Session::flash('flash_message', 'Data kategori Berhasil ditambah');

        return redirect('admin/kategori');
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
        $kategori = kategori::findorfail($id);
        return view('admin/kategori/edit',compact('kategori'));
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
        $kategori = kategori::findorfail($id);

        $this->validate($request, [
            'nama'      => 'unique:kategori,nama,'.$kategori['id'],
        ]);

        $kategori->nama = $request->nama;
        $kategori->link = Str::slug($request->link);

        $kategori->save();

        Session::flash('flash_message', 'Data kategori Berhasil diperbarui');

        return redirect('admin/kategori/'.$kategori->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = kategori::find($id);

        if($kategori->gambar != ""){
            unlink(public_path('upload/kategori/kecil/').$kategori->gambar);
            unlink(public_path('upload/kategori/sedang/').$kategori->gambar);
        }

        $kategori->delete();
        Session::flash('flash_message', 'Data '. $kategori->nama .' Berhasil Dihapus');
        return redirect('admin/kategori');
    }

    private function UploadGambar(Request $request, $link)
    {
        $gambar = $request->file('gambar');
        $ext    = $gambar->getClientOriginalExtension();

        if($request->file('gambar')->isValid()) {

            $gambar_nama = $link . ".$ext";
            $upload_path = "upload/kategori/kecil";
            $upload_path2 = "upload/kategori/sedang";
            $request->file('gambar')->move($upload_path, $gambar_nama);
            
            copy($upload_path. "/" .$gambar_nama, $upload_path2. "/" .$gambar_nama);

            $imgkecil = Image::make($upload_path. "/" .$gambar_nama);
            $imgkecil->fit(450, 300);
            $imgkecil->save();

            $imgsedang = Image::make($upload_path2. "/" .$gambar_nama);
            $imgsedang->fit(750, 350);
            $imgsedang->save();

            return $gambar_nama;
        }

        return false;
    }

    public function hapusGambar($id)
    {
        $kategori = kategori::find($id);

        if(file_exists(public_path('upload/kategori/kecil/').$kategori->gambar)) {
            unlink(public_path('upload/kategori/kecil/').$kategori->gambar);
        }

        if(file_exists(public_path('upload/kategori/sedang/').$kategori->gambar)) {
            unlink(public_path('upload/kategori/sedang/').$kategori->gambar);
        }

        $kategori->gambar = "";
        Session::flash('flash_message', 'Gambar berhasil di hapus');
        $kategori->save();

        return redirect('admin/kategori/' . $id . '/edit');
    }
}
