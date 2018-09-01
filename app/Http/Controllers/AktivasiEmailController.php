<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Session;
use Auth;

class AktivasiEmailController extends Controller
{
    public function aktivasi(Request $request)
    {
    	$user = User::where('email', $request->email)->where('activation_token', $request->token)->firstOrFail();
        
    	$user->status = true;
    	$user->activation_token = null;
    	$user->save();

    	Auth::login($user);

    	// dd(Auth::check());
        Session::flash('flash_message', 'Aktivasi akun anda berhasil, silahkan login untuk memulai  !');

    	return redirect('login');
    }
}
