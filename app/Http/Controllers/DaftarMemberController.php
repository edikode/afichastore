<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Mail;
use App\Models\User;
use App\Models\Profil;
use App\Models\Kategori;
use App\Models\Produk;

class DaftarMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = Profil::first();
        $kategori = Kategori::all();
        $populer = ProdukPopuler();
        
        return view('tema/daftar-member', compact('profil','kategori','populer'));
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
        $pengguna->status    = false;

        $data = array(
            'nama'   => $pengguna->nama,
            'token'  => $pengguna->activation_token,
            'email'  => $pengguna->email
        );
        
        Mail::send('emails.pendaftaran', $data, function($kirimpesan) use($pengguna) {
            $kirimpesan->to($pengguna->email, $pengguna->nama)->from('cs@afichastore', 'cs@afichastore')->subject(' Email Aktivasi Akun Member');
        });

        if (Mail::failures()) {
            return redirect('login');        
        } else {
             $pengguna->save();
             Session::flash('flash_message', 'Pendaftaran Berhasil, Aktifasi akun anda melalui email pendaftaran');
        }

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
        //
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
        //
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
}
