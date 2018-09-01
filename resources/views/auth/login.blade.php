@extends('layouts.login-template')

@section('judul', 'Login Member') 

@section('main')
<div class="login-box-body">
    <p class="login-box-msg">Login dengan akun anda untuk masuk area member</p>

    <form action="{{ url('/login') }}" method="post">
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

    <a href="{{ url('/password/reset') }}">Lupa Password</a><br>
    <a href="{{url('daftar')}}" class="text-center">Belum Punya Akun</a>
</div>
@endsection

