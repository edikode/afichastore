<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Image;
use Auth;

use App\Models\User;
use App\Models\Profil;
use App\Models\Kategori;
use App\Models\Produk;

class AkunController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = Profil::first();
        $pelanggan =  Auth::user();
        $kategori = Kategori::all();
        $populer = ProdukPopuler();
        return view('tema/akun', compact('profil','kategori','populer','pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pengguna = new User;

        $this->validate($request, [
            'nama'      => 'required|unique:users,nama,'.$pengguna['id'],
            'email'     => 'required|unique:users,email,'.$pengguna['id'],
            'telepon'   => 'numeric|min:11',
        ]);

        $pengguna->nama = $request->nama;
        $pengguna->email = $request->email;
        $pengguna->telepon = $request->telepon;
        $pengguna->activation_token = str_random(255);
        $pengguna->password = bcrypt($request->password);

        $pengguna->save();

        Session::flash('flash_message', 'Pendaftaran Berhasil, Aktifasi akun anda melalui email pendaftaran');

        return redirect('login');
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
        $profil = Profil::first();
        $pelanggan =  Auth::user();
        $kategori = Kategori::all();
        $populer = ProdukPopuler();
        return view('tema/akun-edit', compact('profil','kategori','populer','pelanggan'));
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
        $pelanggan = User::findOrFail($id);

        $this->validate($request, [
            'nama'      => 'required|unique:users,nama,'.$pelanggan['id'],
            'email'     => 'required|unique:users,email,'.$pelanggan['id'],
            // 'telepon'   => 'numeric|min:11|max:13'
        ]);

        $pelanggan->nama = $request->nama;
        $pelanggan->email = $request->email;
        $pelanggan->telepon = $request->telepon;
        $pelanggan->activation_token = str_random(255);
        $gambar =  Str::slug($request->nama);

        if($request->hasFile('gambar')) {
            $pelanggan->gambar = $this->UploadGambar($request, $gambar);
        }

        if ($request->password != $pelanggan->password) {
            $pelanggan->password = bcrypt($request->password);
        }

        $pelanggan->save();

        Session::flash('flash_message', 'Akun Berhasil diperbarui');
        return redirect('akun/'.$id.'/edit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

        return redirect('akun/'.$id.'/edit');
    }
}
