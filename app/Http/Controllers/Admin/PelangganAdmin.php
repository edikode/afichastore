<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Image;

use App\Models\User;

class PelangganAdmin extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $jumlah = User::count();
        $pelanggan = User::paginate(20);

        return view('admin/pelanggan/home', compact('pelanggan','jumlah'));
    }

    public function store(Request $request)
    {
    
    }

    public function edit($id)
    {
        $pelanggan = User::findorfail($id);
        return view('admin/pelanggan/edit',compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $pelanggan = User::find($id);

        $this->validate($request, [
            'nama'  	=> 'required|unique:users,nama,'.$pelanggan['id'],
            'email'  	=> 'required|unique:users,email,'.$pelanggan['id'],
            'password'  => 'required|min:6',
            'password'  => 'required|min:6|same:konfirmasiPassword'
        ]);

        $pelanggan->nama = $request->nama;
        $pelanggan->email = $request->email;
        $pelanggan->status    = false;
        $pelanggan->activation_token = str_random(255);
        $gambar =  Str::slug($request->nama);

        if($request->hasFile('gambar')) {
            $pelanggan->gambar = $this->UploadGambar($request, $gambar);
        }

        if ($request->password != $pelanggan->password) {
            $pelanggan->password = bcrypt($request->password);
        }

        $pelanggan->save();

        Session::flash('flash_message', 'Data Pelanggan berhasil di perbarui');

        return redirect('admin/pelanggan/'.$id.'/edit');

    }

    private function UploadGambar(Request $request, $link)
    {
        $gambar = $request->file('gambar');
        $ext    = $gambar->getClientOriginalExtension();

        if($request->file('gambar')->isValid()) {

            $gambar_nama = $link . ".$ext";
            $upload_path = "upload/pelanggan/kecil";
            $upload_path2 = "upload/pelanggan/sedang";
            $request->file('gambar')->move($upload_path, $gambar_nama);
            
            copy($upload_path. "/" .$gambar_nama, $upload_path2. "/" .$gambar_nama);

            $imgkecil = Image::make($upload_path. "/" .$gambar_nama);
            $imgkecil->fit(400, 400);
            $imgkecil->save();

            $imgsedang = Image::make($upload_path2. "/" .$gambar_nama);
            $imgsedang->fit(600, 600);
            $imgsedang->save();

            return $gambar_nama;
        }

        return false;
    }

    public function destroy($id)
    {
        $pelanggan = User::find($id);

        if($pelanggan->gambar != ""){

            if(file_exists(public_path('upload/pelanggan/kecil').$pelanggan->gambar)) {
                unlink(public_path('upload/pelanggan/kecil').$pelanggan->gambar);
            }

            if(file_exists(public_path('upload/pelanggan/sedang').$pelanggan->gambar)) {
                unlink(public_path('upload/pelanggan/sedang').$pelanggan->gambar);
            }
        }

        $pelanggan->delete();

        Session::flash('flash_message', 'Data '. $pelanggan->nama .' Berhasil Dihapus');

        return redirect('admin/pelanggan');
    }

    public function hapusGambar($id)
    {
        $pelanggan = User::find($id);

        if(file_exists(public_path('upload/pelanggan/kecil/').$pelanggan->gambar)) {
            unlink(public_path('upload/pelanggan/kecil/').$pelanggan->gambar);

            if(file_exists(public_path('upload/pelanggan/sedang/').$pelanggan->gambar)) {
                unlink(public_path('upload/pelanggan/sedang/').$pelanggan->gambar);
            }
            
            $pelanggan->gambar = "";
            $pelanggan->save();
        }

        return redirect('admin/pelanggan/'.$id.'/edit');
    }
}
