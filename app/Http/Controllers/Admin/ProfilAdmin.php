<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Image;

use App\Models\Profil;

class ProfilAdmin extends Controller
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
        $profil = Profil::first();

        return view('admin/profil-store', compact('profil'));
    }

    public function update(Request $request, $id)
    {
        $profil = Profil::find(1);

        $this->validate($request, [
            'telepon'     => 'numeric|min:11',
            'gambar'    => 'sometimes|image|max:1000|mimes:jpeg,jpg,bmp,png',
        ]);

        $profil->nama = $request->nama;
        $profil->telepon = $request->telepon;
        $profil->email = $request->email;
        // $profil->facebook = $request->facebook;
        $profil->website = $request->website;
        $profil->alamat = $request->alamat;
        $profil->deskripsi = $request->deskripsi;
        $profil->teks = $request->teks;

        $gambar = Str::slug($request->nama);

        if($request->hasFile('gambar')) {
            $profil->gambar = $this->UploadGambar($request, $gambar);
        }

        $profil->save();
        Session::flash('flash_message', 'Data Profil Store berhasil Diperbarui');

        return redirect('admin/profil-store');
    }

    private function UploadGambar(Request $request, $link)
    {
        $gambar = $request->file('gambar');
        $ext    = $gambar->getClientOriginalExtension();

        if($request->file('gambar')->isValid()) {

            $gambar_nama = $link . ".$ext";
            $upload_path = "upload/profil/kecil";
            $upload_path2 = "upload/profil/sedang";
            $request->file('gambar')->move($upload_path, $gambar_nama);
            
            copy($upload_path. "/" .$gambar_nama, $upload_path2. "/" .$gambar_nama);

            $imgkecil = Image::make($upload_path. "/" .$gambar_nama);
            $imgkecil->fit(400, 300);
            $imgkecil->save();

            $imgsedang = Image::make($upload_path2. "/" .$gambar_nama);
            $imgsedang->fit(600, 600);
            $imgsedang->save();

            return $gambar_nama;
        }

        return false;
    }

    public function hapusGambar($id)
    {
        $profil = Profil::find($id);

        if(file_exists(public_path('upload/profil/kecil/').$profil->gambar)) {
            unlink(public_path('upload/profil/kecil/').$profil->gambar);
        }

        if(file_exists(public_path('upload/profil/sedang/').$profil->gambar)) {
            unlink(public_path('upload/profil/sedang/').$profil->gambar);
        }

        $profil->gambar = "";
        $profil->save();

        Session::flash('flash_message', 'Gambar Berhasil Dihapus');

        return redirect('admin/profil-store');
    }
}
