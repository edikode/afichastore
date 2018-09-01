@extends('themes.layouts.template')

@section('judul', "Halaman Tidak ditemukan")

@section('deskripsi', $pesan_error)

@section('main')

<section class="parallax_window_in" data-parallax="scroll" data-image-src="{{asset('themes/img/sub_header_about.jpg')}}" data-natural-width="1400" data-natural-height="470">
    <div id="sub_content_in">
        <div id="animate_intro">
            <h1>{{$pesan_error}}</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="icon-home-3"></i> Home</a></li>
              <li class="breadcrumb-item active">Error</li>
            </ol>
        </div>
    </div>
</section>

<section class="wrapper">
	<div class="container">
		<div class="row add_bottom_45">
			<div class="col-sm-12" style="text-align: center;">
				<img src="{{asset('themes/img/emot.png')}}"  width="80px">
	            <h1>404</h1>
	            <h3>{{$pesan_error}}</h3>
	            <p class="hero-text-alt mrg-top-30">Halaman yang anda tuju tidak ditemukan atau belum diaktifkan !</p>
	            <div class="text-center mrg-top-30">
	                <a href="javascript:history.back()" class="btn_1">Kembali</a>
	                <a href="{{url('/')}}" class="btn_1">Halaman Utama</a>
	            </div>
			</div>
		</div>
	</div>
</section>

<div class="container margin_60">
    <div class="banner">
        <h3>Spesialis Trip Ke Banyuwangi</h3>
        <p style="font-size: 20px">Wisata Alam Indonesia Tour Services khusus melayani perjalanan wisata ke Banyuwangi dan sekitarnya. Agar mampu mencatat setiap detail pengalaman dan menggunakannya sebagai penawaran terbaik untuk Anda</p>
        <a href="{{url('paket-wisata')}}" class="btn_1 white">Jelajahi Sekarang</a>
    </div>
</div>
@endsection