@extends('layouts.login-template')

@section('judul', 'Lupa Password') 

@section('main')
<div class="login-box-body">
    <h3>Reset Password</h3>  
    
    @if (session('status'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
            {{ Session::get('status')}}
        </div>
    @else
        <p>Masukkan email anda !</p>
    @endif

    <form class="form-login" action="{{ url('/password/email') }}" method="post">
        {{ csrf_field() }}

        @include('pesan/error') 
        <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" name="email" required autofocus>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                <button name="submit" type="submit" class="btn btn-success">
                    Kirim link reset password <i class="icon-circle-arrow-right"></i>
                </button>
            </div>
            <div class="col-xs-4">
                <a class="btn btn-danger" href="{{url('/login')}}" style="float: right;">
                   Kembali
                </a>                         
            </div>
        </div>
    </form>
</div>

@endsection
