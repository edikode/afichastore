@extends('layouts.login-template')

@section('main')
<div class="main-login col-sm-4 col-sm-offset-4">
        <div class="logo"><img src="{{asset('assets/images/wisataalam.png')}}">
        </div>
        <div class="box-login">
            <h3>Reset Password</h3>  
            <p>Masukkan email dan password baru</p>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form class="form-login" role="form" method="POST" action="{{ route('referral.password.request') }}">
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
</div>
@endsection
