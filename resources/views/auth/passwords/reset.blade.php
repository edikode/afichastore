@extends('layouts.login-template')

@section('judul', 'Ganti Password') 

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
        <p>Masukkan password baru !</p>
    @endif

    <form class="form-login"  method="POST" action="{{ url('/password/reset') }}">
        @include('pesan/error')

        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}"> 
        <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" name="email" required autofocus>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" value="{{ old('password') }}" name="password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Ketik Ulang Password" value="{{ old('password_confirmation') }}" name="password_confirmation" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                
            </div>
            <div class="col-xs-4">
                <button class="btn btn-success" type="submit" name="simpan" style="float: right;">
                   Reset Password
                </button>                         
            </div>
        </div>
    </form>
</div>

<!-- <div class="main-login col-sm-4 col-sm-offset-4">
        <div class="logo"><img src="{{asset('assets/images/wisataalam.png')}}">
        </div>
        <div class="box-login">
            <h3>Reset Password</h3>  
            @if (session('status'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                    {{ Session::get('status')}}
                </div>
            @endif
            <form class="form-login" role="form" method="POST" action="{{ url('/password/reset') }}">
                @include('pesan/error')

                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">

                <fieldset>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <span class="input-icon">
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $email or old('email') }}" required autofocus>
                            <i class="icon-user"></i> 
                        </span>
                         @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <span class="input-icon">
                            <input type="password" class="form-control password" name="password" placeholder="Password baru">
                            <i class="icon-lock"></i>
                        </span>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                     <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <span class="input-icon">
                            <input type="password" class="form-control password" name="password_confirmation" placeholder="Ulangi Password baru">
                            <i class="icon-lock"></i>
                        </span>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-actions">                          
                        <button name="submit" type="submit" class="btn btn-bricky pull-right">
                            Reset Password <i class="icon-circle-arrow-right"></i>
                        </button>
                    </div>                      
                </fieldset>
            </form>
        </div>
    </div>
</div> -->
@endsection
