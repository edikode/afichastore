@extends('tema.layouts.template')

@section('judul', 'Tentang Aficha Store')

@section('main')

<div class="secondary_page_wrapper">
	<div class="container">
		<ul class="breadcrumbs">
			<li><a href="index.html">Home</a></li>
			<li>Tentang Kami</li>

		</ul>
		<!-- KONTEN -->
		<div class="section_offset">
			<div class="row">
				<!-- MAIN -->
				<main class="col-md-9 col-sm-8">
					<h1>Aficha Store</h1>
					<div class="theme_box clearfix">
						<img src="{{asset('upload/profil/sedang/'.$profil->gambar)}}" class="alignleft" width="310" alt="">
						@php echo $profil->teks @endphp

					</div>
				</main>
				
				<!-- SIDEBAR -->
				@include('tema/layouts/sidebar')						
			</div>
		</div>					
	</div>
	</div>
@endsection