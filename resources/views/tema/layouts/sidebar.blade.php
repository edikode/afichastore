<aside class="col-md-3 col-sm-4 has_mega_menu">
	<section class="section_offset">
		<h3>Produk Populer</h3>
		<ul class="products_list_widget">										
			@foreach($populer as $p)
				@php $detail = DetailProduk($p->produk_id) @endphp 
			<li>                    
				<a href="{{url('produk-detail/'.$detail->link)}}" class="product_thumb">                      
				  <img src="{{asset('upload/produk/kecil/'.$detail->gambar)}}" width="80px" alt="{{$detail->judul}}">
				</a>
				<div class="wrapper">
				  <a href="{{url('produk-detail/'.$detail->link)}}" class="product_title">{{$detail->judul}}</a>
				  <div class="clearfix product_info">
				  	<p class="product_price alignleft"><b>{{angkaRupiah($detail->harga)}}</b></p>
				  </div>
				</div>
			</li>
			@endforeach
		</ul>
		<footer class="bottom_box">
			<a href="{{url('produk')}}" class="button_grey middle_btn">Lihat Semua</a>
		</footer>
	</section>
	<!-- <div class="section_offset">
		<a class="banner" href="{{url('produk')}}">								
			<img src="tema/images/banner_img_11.png" alt="">
		</a>
	</div> -->
</aside>