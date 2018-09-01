@extends('tema.layouts.template')

@section('judul', 'Informasi Akun')

@section('main')

<div class="secondary_page_wrapper">
	<div class="container">					
		<ul class="breadcrumbs">
			<li><a href="{{url('/')}}">Home</a></li>
			<li>Informasi Akun</li>
		</ul>
		<!-- KONTEN -->
		<div class="section_offset">
			<div class="row">
				<!-- MAIN -->
				<main class="col-md-9 col-sm-8">
					<section class="section_offset">
						<div class="theme_box">
							<form action="{{ url('akun/'.$pelanggan->id) }}" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-sm-5">
										<div class="form-group">
											@if($pelanggan->gambar)
												@if(file_exists("upload/pelanggan/kecil/". $pelanggan->gambar))
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="fileupload-new thumbnail" style="max-width:334px; position:relative;">
															
															<img src="{{ url('/upload/pelanggan/kecil/'. $pelanggan->gambar) }}">
														</div>										
													</div>
													<a class="btn btn-bricky btn-danger tooltips" href="{{ url('akun/hapusgambar/'. $pelanggan->id) }}" onclick="return hapusgambar()">
														Hapus
													</a>
												@else
													<div class='successHandler alert alert-danger display'>
														<i class='glyphicon glyphicon-remove'></i> Error. Gambar Kosong. Silahkan upload lagi.
													</div>
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="fileupload-new thumbnail" style="max-width:334px; max-height:253px;"><img src="{{ asset('admins/img/400x300.jpg') }}" alt=""/>
														</div>
														<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 400px; max-height: 300px; line-height: 20px;"></div>
														<div>
															<span class="btn btn-warning btn-file"><span class="fileupload-new">Pilih Gambar</span><span class="fileupload-exists">Ganti</span>
																<input type="file" name="gambar">
															</span>
															<a href="#" class="btn fileupload-exists btn-warning" data-dismiss="fileupload">
																Hapus
															</a>
														</div>
													</div>	
												@endif
											@else
											<div class="fileupload fileupload-new" data-provides="fileupload">
		                                        <div class="fileupload-new thumbnail" style="max-width:334px; max-height:253px;"><img src="{{ asset('admins/img/400x300.jpg') }}" alt=""/>
		                                        </div>
		                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 400px; max-height: 300px; line-height: 20px;"></div>
		                                        <div>
		                                          <span>
		                                            <input type="file" name="gambar" class="form-control" required="">
		                                          </span>
		                                        </div>
		                                    </div>
											@endif
										</div>
									</div>

									<div class="col-sm-7">
										<div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
						                  <label for="nama">Nama</label>
						                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="@if(count($errors) > 0){{old('nama')}}@else{{$pelanggan->nama}} @endif" required="">
						                  @if ($errors->has('nama'))
						                      <span class="help-block">
						                          <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('nama') }}</strong>
						                      </span>
						                  @endif
						                </div>
						                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						                  <label for="email">Email</label>
						                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="@if(count($errors) > 0){{old('email')}}@else {{$pelanggan->email}}@endif" required="">
						                  @if ($errors->has('email'))
						                      <span class="help-block">
						                          <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('email') }}</strong>
						                      </span>
						                  @endif
						                </div>
						                <div class="form-group{{ $errors->has('telepon') ? ' has-error' : '' }}">
						                  <label for="telepon">Telepon</label>
						                  <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Telepon" value="@if(count($errors) > 0){{old('telepon')}}@else{{$pelanggan->telepon}}@endif" 
						                  required="">
						                  @if ($errors->has('telepon'))
						                      <span class="help-block">
						                          <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('telepon') }}</strong>
						                      </span>
						                  @endif
						                </div>
						                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
						                  <label for="password">Password</label>
						                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="@if(count($errors) > 0){{old('password')}} @else {{$pelanggan->password}}@endif" required="">
						                  @if ($errors->has('password'))
						                      <span class="help-block">
						                          <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('password') }}</strong>
						                      </span>
						                  @endif
						                </div>

						                {{ csrf_field() }}
						                <input type="hidden" name="_method" value="PUT">
						                <button type="submit" name="simpan" class='button_blue'>Simpan</button>
						                <a href="{{url('akun')}}" class='' style="float: right;">Kembali</button>
									</div>
								</div>
							</form>
						</div>
					</section>
				</main>

				@include('tema/layouts/sidebar')
			</div>
		</div>
	</div>
</div>

@endsection