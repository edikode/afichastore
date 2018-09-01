@extends('tema.layouts.template')

@section('judul', 'Produk - '.$detail->judul)

@section('main')

@php $kategoris = Kategori_detail($detail->kategori_id); @endphp

<div class="secondary_page_wrapper">
	<div class="container">					
		<ul class="breadcrumbs">
			<li><a href="{{url('/')}}">Home</a></li>
			<li><a href="{{url('kategori/'.$kategoris->link)}}">{{$kategoris->nama}}</a></li>
			<li>{{$detail->nama}}</li>
		</ul>
		<!-- KONTEN -->
		<div class="section_offset">
			<div class="row">
				<!-- MAIN -->
				<main class="col-md-9 col-sm-8">
					<section class="section_offset">
						<div class="clearfix">									
							<div class="single_product">
								<div class="image_preview_container">
									<img id="img_zoom" data-zoom-image="{{asset('upload/produk/sedang/'.$detail->gambar)}}" src="{{asset('upload/produk/sedang/'.$detail->gambar)}}" alt="">
									<button class="button_grey_2 icon_btn middle_btn open_qv"><i class="icon-resize-full-6"></i></button>
								</div>
								<div class="product_preview">
									<div class="owl_carousel" id="thumbnails">											
										<a href="#" data-image="{{asset('upload/produk/sedang/'.$detail->gambar)}}" data-zoom-image="{{asset('upload/produk/sedang/'.$detail->gambar)}}">
											<img src="{{asset('upload/produk/sedang/'.$detail->gambar)}}" data-large-image="{{asset('upload/produk/sedang/'.$detail->gambar)}}" alt="{{$detail->judul}}">
										</a>
									</div>
								</div>										
							</div>
							<div class="single_product_description">
								<h3 class="offset_title"><a href="#">{{$detail->nama}}</a></h3>
								<!-- <div class="description_section v_centered">
									<ul class="rating">
										<li class="active"></li>
										<li class="active"></li>
										<li class="active"></li>
										<li></li>
										<li></li>
									</ul>													
									<ul class="topbar">
										<li><a href="#">3 Review</a></li>
										<li><a href="#">Tambah Review</a></li>
									</ul>
								</div> -->
								<div class="description_section">
									<table class="product_info">
										<tbody>
											<tr>
												<td>Dari</td>
												<td>: Admin Toko</td>
											</tr>
											<tr>
												<td>Stok Barang</td>
												<td><span class="in_stock">: {{$detail->stok}} item</span></td>
											</tr>
											<!-- <tr>
												<td>Kode Produk</td>
												<td>: PS06</td>
											</tr> -->
										</tbody>
									</table>
								</div>
								<hr>
								<div class="description_section">
									@php echo $detail->teks @endphp
								</div>
								<hr>
								<p class="product_price"><b class="theme_color">Rp. {{angkaRupiah($detail->harga)}}</b></p>
								<!-- <div class="description_section_2 v_centered">							
									<span class="title">Jumlah :</span>
									<div class="qty min clearfix">
										<button class="theme_button" data-direction="minus">&#45;</button>
										<input type="text" name="jumlah" value="1">
										<button class="theme_button" data-direction="plus">&#43;</button>
									</div>
								</div> -->
								<div class="buttons_row">
									<a href="{{url('pesan/'.$detail->link)}}" class="button_blue middle_btn">Tambahkan Ke keranjang</a>
								</div>

								<br><br>

								<script type="text/javascript" data-cfasync="false" src="//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js" data-shr-siteid="c0f42d6f2c13456fc7d6bd1a1dab2160" async="async"></script> <div class="shareaholic-canvas" data-app="share_buttons" data-app-id="27091963"></div> <div class="shareaholic-canvas" data-app="total_share_count"  data-services="facebook,pinterest,linkedin" /> <div class="shareaholic-canvas" data-app="recommendations" data-app-id="27092038"></div>
								
							</div>									
						</div>
					</section>

					<section class="section_offset">

						<h3 class="offset_title">Mungkin Anda Suka</h3>

						<div class="owl_carousel related_products">
							@foreach($produk as $p)
							<div class="product_item">											
								<div class="image_wrap">
									<img src="{{asset('upload/produk/sedang/'.$p->gambar)}}" alt="{{$p->judul}}">
									<div class="actions_wrap">
										<div class="centered_buttons">														
											<a href="{{url('pesan/'.$p->link)}}" class="button_blue add_to_cart">Tambahkan Ke keranjang</a>
										</div>
									</div>
								</div>
								<div class="label_new">New</div>
								<div class="description">
									<a href="{{url('produk-detail/'.$p->link)}}">{{$p->judul}}</a>
									<div class="clearfix product_info">
										<p class="product_price alignleft"><b>Rp. {{angkaRupiah($p->harga)}}</b></p>
									</div>

								</div>
							</div>
							@endforeach
						</div>
					</section>							
				</main>

				@include('tema/layouts/sidebar')
			</div>
		</div>					
	</div>
</div>

@endsection