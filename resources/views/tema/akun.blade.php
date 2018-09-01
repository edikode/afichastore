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
											@else
												<div class='successHandler alert alert-danger display'>
													<i class='glyphicon glyphicon-remove'></i> Error. Gambar Kosong. Silahkan upload lagi.
												</div>
												<div class="fileupload fileupload-new" data-provides="fileupload">
													<div class="fileupload-new thumbnail" style="max-width:334px; max-height:253px;"><img src="{{ asset('admins/img/400x300.jpg') }}" alt=""/>
													</div>
													<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 400px; max-height: 300px; line-height: 20px;"></div>
												</div>	
											@endif
										@else
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<div class="fileupload-new thumbnail" style="max-width:334px; max-height:253px;"><img src="{{ asset('admins/img/400x300.jpg') }}" alt=""/>
											</div>
											<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 400px; max-height: 300px; line-height: 20px;"></div>
										</div>
										@endif
									</div>
								</div>

								<div class="col-sm-7">
									<a href="{{url('akun/'.$pelanggan->id.'/edit')}}" class='button_blue'>Edit Profil</a>

									<a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="button_blue">
		                                Keluar
		                            </a>

		                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
		                                {{ csrf_field() }}
		                            </form>

		                           <!--  <form action="{{ url('keluar') }}" method="POST">
		                                {{ csrf_field() }}
		                                <button type="submit">Keluar</button>
		                            </form> -->

									<br><br>
									<h2>{{$pelanggan->nama}}</h2>
									<ul class="c_info_list">
										<li class="c_info_location">{{$pelanggan->alamat}}</li>
										<li class="c_info_phone">{{$pelanggan->telepon}}</li>
										<li class="c_info_mail">{{$pelanggan->email}}</li>
									</ul>
								</div>
							</div>
						</div>
					</section>
				</main>

				@include('tema/layouts/sidebar')
			</div>
		</div>
	</div>
</div>

@endsection