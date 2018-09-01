@extends('layouts.login-template')

@section('judul', 'Login Admin') 

@section('main')
<div class="login-box-body">
    <p class="login-box-msg">Login Sebagai Admin Store</p>

    <form action="{{ route('admin.login.submit') }}" method="post">
        {{ csrf_field() }}

        @include('pesan/error') 
        <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" name="email" required autofocus>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" value="{{ old('password') }}" name="password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
            </div>
            <div class="col-xs-4">
                <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Login</button>
            </div>
        </div>
    </form>

    <!-- <a href="{{ route('admin.login.submit') }}">Lupa Password</a><br> -->
    <!-- <a href="#" class="text-center">Belum Punya Akun</a> -->
</div>
@endsection

