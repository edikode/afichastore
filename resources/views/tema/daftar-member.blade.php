@extends('tema.layouts.template')

@section('judul', 'Home')

@section('main')

<div class="secondary_page_wrapper">
  <div class="container">
    <ul class="breadcrumbs">
      <li><a href="index.html">Home</a></li>
      <li>Daftar</li>

    </ul>
    <!-- KONTEN -->
    <div class="section_offset">
      <div class="row">
        <!-- MAIN -->
        <main class="col-md-9 col-sm-8">
          <h1>Daftar Member</h1>
          
          <form name="form" action="{{url('daftar')}}" method="post" enctype="multipart/form-data">  
            {{ csrf_field() }}
            <div class="theme_box clearfix">
                <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="@if(count($errors) > 0){{old('nama')}}@endif" required="">
                  @if ($errors->has('nama'))
                      <span class="help-block">
                          <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('nama') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="@if(count($errors) > 0){{old('email')}}@endif" required="">
                  @if ($errors->has('email'))
                      <span class="help-block">
                          <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('telepon') ? ' has-error' : '' }}">
                  <label for="telepon">Telepon</label>
                  <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Telepon" value="@if(count($errors) > 0){{old('telepon')}}@endif" required="">
                  @if ($errors->has('telepon'))
                      <span class="help-block">
                          <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('telepon') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="@if(count($errors) > 0){{old('password')}}@endif" required="">
                  @if ($errors->has('password'))
                      <span class="help-block">
                          <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>
            </div>

            <footer class='bottom_box on_the_sides'>
              <div class='left_side'>
                <span class='prompt'>Dibutuhkan</span>
              </div>
              <div class='right_side'>
                <button type='submit' name="submit" class='button_blue middle_btn'>Daftar</button>
              </div>              
            </footer>
          </form>
        </main>

        @include('tema/layouts/sidebar')
      </div>
    </div>
  </div>
</div>
@endsection