@extends('tema.layouts.template')

@section('judul', 'Produk Aficha Store')

@section('main')

<div class="secondary_page_wrapper">
	<div class="container">					
		<ul class="breadcrumbs">
			<li><a href="{{url('/')}}">Home</a></li>
			<li>Semua Produk</li>
		</ul>
		<div class="section_offset">
			<div class="row">
				<main class="col-md-9 col-sm-8">
					@include('pesan/flash_message')
					<br><br>
					
					<div class="section_offset">    
			            <h3 class="offset_title">Produk Kami</h3>              
			            <header class="top_box on_the_sides">
			              <div class="clearfix v_centered">               
			                <p>Beberapa Produk yang kami jual</p>
			              </div>
			            </header>
			            <div class="table_layout" id="products_container">
			              @php $i = 1 @endphp
			              @foreach($semuaproduk as $p)

			                @if($i == 1)
			                  	<div class="table_row">
			                  	@php $i = $i+1 @endphp
			                @endif

			                <div class="table_cell">
			                    <div class="product_item">
			                      <div class="image_wrap">
			                        <img src="upload/produk/sedang/{{$p->gambar}}" alt="{{$p->judul}}">
			                        <div class="actions_wrap">
			                          <div class="centered_buttons">
			                            <a href="{{url('produk-detail/'.$p->link)}}" class="button_dark_grey middle_btn quick_view">Produk Detail</a>
			                          </div>
			                        </div>
			                      </div>
			                      <div class="description">
			                        <center>
			                          <a href="{{url('produk-detail/'.$p->link)}}" class="judulproduk align_center" title="{{$p->judul}}">{{$p->nama}}</a>
			                        </center>
			                        <div class="clearfix product_info">
			                          <p class="product_price align_center"><b>Rp. {{angkaRupiah($p->harga)}}</b></p>
			                        </div>
			                      </div>
			                      <center>
			                        <a href="{{url('pesan/'.$p->link)}}">
			                          <button class="button_blue middle_btn">Beli Produk</button>
			                        </a>  
			                      </center>                        
			                    </div>
			                </div>

			                @if($i == 4)
			                  	</div>
			                 	@php $i = 0 @endphp
			                @endif

			                @php $i = $i+1 @endphp

			              @endforeach

			            </div>
			            <!-- <footer class="bottom_box on_the_sides">
			              <div class="left_side">
			                <p>Dapatkan Discount Menarik Dari Kami.</p>
			              </div>                    
			            </footer> -->
			            {{$semuaproduk->links()}}
		          	</div>

		          	<section class="section_offset">
						<h3 class="widget_title offset_title">Produk Menarik</h3>
						<div class="owl_carousel widgets_carousel">
							@foreach($produk_menarik as $p)
							<div class="theme_box clearfix">
								<div class="single_product">
									<div class="image_preview_container">
										<img src="upload/produk/sedang/{{$p->gambar}}" alt="{{$p->judul}}">
									</div>												
								</div>
								<div class="single_product_description">
									<h3 class="offset_title"><a href="{{url('produk/', $p->link)}}">{{$p->judul}}</a></h3>
									<div class="description_section v_centered">
										
									</div>

									<div class="description_section">
										<table class="product_info">
											<tbody>
												<tr>
													<td>Dari</td>
													<td>: Admin Toko</td>
												</tr>
												<tr>
													<td>Stok Barang</td>
													<td><span class="in_stock">: {{$p->stok}} item</span></td>
												</tr>
											</tbody>
										</table>
									</div>
									<hr>
									<div class="description_section">
										@php echo $p->teks @endphp
									</div>

									<div class="description_section">
										<div class="table_wrap product_price_table">
											<table>													
												<tbody>
													<tr>																
														<td class="special_price">		
															Harga Spesial:
															<div class="price"> Rp. {{angkaRupiah($p->harga)}}</div>
														</td>
														<!-- <td class="old_price">
															Old Price:
															<div class="price"> Rp. 9.99</div>
														</td>
														<td class="save">		
															You Save:
															<div class="price"> Rp. 4.00</div>
														</td> -->
													</tr>
												</tbody>
											</table>
										</div>													
										<p class="hurry_message"><span>Cepetan! Jangan sampai kehabisan!</span> stok kami terbatas.</p>
									</div>												
									<div class="buttons_row">
										<a href="{{url('pesan/'.$p->link)}}" class="button_blue middle_btn">Beli Produk</a>
									</div>
								</div>
							</div>
							@endforeach
						</div>

						<footer class="bottom_box">

							<p class="hurry_message">Diskon Yang Kami Berikan <span>Tidak Ada Syarat Apapun.</span></p>

						</footer>

					</section>
				</main>
				
				@include('tema/layouts/sidebar')						
			</div>
		</div>					
	</div>
	</div>
@endsection