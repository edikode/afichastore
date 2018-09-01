@extends('layouts.login-template')

@section('main')
<div class="main-login col-sm-4 col-sm-offset-4">
        <div class="logo"><img src="{{asset('assets/images/wisataalam.png')}}">
        </div>

        <div class="box-login">
            <h3>Reset Password</h3>  
            <p>Masukkan email anda saat pendaftaran</p>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-login" action="{{ route('referral.password.email') }}" method="post">
                    {{ csrf_field() }}

                 <fieldset>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <span class="input-icon">
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
                            <i class="icon-user"></i> 
                        </span>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-actions">
                        <a class="btn btn-orange" href="{{url('referral/login')}}">
                            <i class="fa fa-circle-arrow-left"></i> Kembali
                        </a>                          
                        <button name="submit" type="submit" class="btn btn-bricky pull-right">
                            Kirim link reset password <i class="icon-circle-arrow-right"></i>
                        </button>
                    </div>                      
                </fieldset>

                
            </form>
        </div>
    </div>
</div>
@endsection
