<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Image;

use App\Models\Admin;

class PengelolaAdmin extends Controller
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
        $jumlah = Admin::count();
        $pengelola = Admin::paginate(20);

        return view('admin/pengelola/home', compact('pengelola','jumlah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/pengelola/tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pengelola = new Admin;

        $this->validate($request, [
            'nama'      => 'required|unique:admins,nama,'.$pengelola['id'],
            'email'     => 'required|unique:admins,email,'.$pengelola['id'],
            'telepon'   => 'numeric|min:11',
            'gambar'    => 'sometimes|image|max:1000|mimes:jpeg,jpg,bmp,png',
            'password'  => 'required|min:6|same:konfirmasiPassword'
        ]);

        $pengelola->nama = $request->nama;
        $pengelola->email = $request->email;
        $pengelola->telepon = $request->telepon;
        $pengelola->alamat = $request->alamat;
        $pengelola->activation_token = str_random(255);
        $gambar =  Str::slug($request->nama);
        $pengelola->password = bcrypt($request->password);

        if($request->hasFile('gambar')) {
            $pengelola->gambar = $this->UploadGambar($request, $gambar);
        }

        $pengelola->save();

        Session::flash('flash_message', 'Data pengelola Berhasil ditambah');

        return redirect('admin/pengelola');
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
        $pengelola = Admin::findorfail($id);

        return view('admin/pengelola/edit',compact('pengelola'));
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
        $pengelola = Admin::find($id);

        $this->validate($request, [
            'nama'      => 'required|unique:admins,nama,'.$pengelola['id'],
            'email'     => 'required|unique:admins,email,'.$pengelola['id'],
            'telepon'   => 'numeric|min:11',
            'gambar'    => 'sometimes|image|max:1000|mimes:jpeg,jpg,bmp,png',
            'password'  => 'required|min:6',
            'password'  => 'required|min:6|same:konfirmasiPassword'
        ]);

        $pengelola->nama = $request->nama;
        $pengelola->email = $request->email;
        $pengelola->telepon = $request->telepon;
        $pengelola->alamat = $request->alamat;
        $gambar =  Str::slug($request->nama);

        if($request->hasFile('gambar')) {
            $pengelola->gambar = $this->UploadGambar($request, $gambar);
        }

        if ($request->password != $pengelola->password) {
            $pengelola->password = bcrypt($request->password);
        }

        $pengelola->save();

        Session::flash('flash_message', 'Data pengelola berhasil di perbarui');

        return redirect('admin/pengelola/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengelola = Admin::find($id);

        if($pengelola->gambar != ""){

            if(file_exists(public_path('upload/pengelola/kecil').$pengelola->gambar)) {
                unlink(public_path('upload/pengelola/kecil').$pengelola->gambar);
            }

            if(file_exists(public_path('upload/pengelola/sedang').$pengelola->gambar)) {
                unlink(public_path('upload/pengelola/sedang').$pengelola->gambar);
            }
        }

        $pengelola->delete();

        Session::flash('flash_message', 'Data '. $pengelola->nama .' Berhasil Dihapus');

        return redirect('admin/pengelola');
    }

    private function UploadGambar(Request $request, $link)
    {
        $gambar = $request->file('gambar');
        $ext    = $gambar->getClientOriginalExtension();

        if($request->file('gambar')->isValid()) {

            $gambar_nama = $link . ".$ext";
            $upload_path = "upload/pengelola/kecil";
            $upload_path2 = "upload/pengelola/sedang";
            $request->file('gambar')->move($upload_path, $gambar_nama);
            
            copy($upload_path. "/" .$gambar_nama, $upload_path2. "/" .$gambar_nama);

            $imgkecil = Image::make($upload_path. "/" .$gambar_nama);
            $imgkecil->fit(400, 400);
            $imgkecil->save();

            $imgsedang = Image::make($upload_path2. "/" .$gambar_nama);
            $imgsedang->fit(600, 300);
            $imgsedang->save();

            return $gambar_nama;
        }

        return false;
    }

    public function hapusGambar($id)
    {
        $pengelola = Admin::find($id);

        if(file_exists(public_path('upload/pengelola/kecil/').$pengelola->gambar)) {
            unlink(public_path('upload/pengelola/kecil/').$pengelola->gambar);

            if(file_exists(public_path('upload/pengelola/sedang/').$pengelola->gambar)) {
                unlink(public_path('upload/pengelola/sedang/').$pengelola->gambar);
            }
            
            $pengelola->gambar = "";
            $pengelola->save();
        }

        return redirect('admin/pengelola/'.$id.'/edit');
    }
}
