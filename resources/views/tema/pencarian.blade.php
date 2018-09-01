@extends('tema.layouts.template')

@section('judul', 'Tentang Aficha Store')

@section('main')

<div class="secondary_page_wrapper">
	<div class="container">					
		<ul class="breadcrumbs">
			<li><a href="{{url('/')}}">Home</a></li>
			<li>Pencarian</li>
		</ul>
		<!-- KONTEN -->
		<div class="section_offset">
			<div class="row">
				<!-- MAIN -->
				<main class="col-md-9 col-sm-8">
					<section class="section_offset">
						<div class="theme_box clearfix">
							<h3 class="widget_title offset_title">Cari Produk</h3>
				            <form class="clearfix search" action="{{url('pencarian')}}" method="post">
				            	{{ csrf_field() }}
				              	<input type="text" name="keyword" tabindex="1" placeholder="Cari Barang Disini..." class="alignleft" value="@if(isset($keyword)){{$keyword}}@endif">
				              	<button class="button_blue def_icon_btn alignleft" type="submit"></button>
				            </form>                 
						</div>
					</section>
					<div class="section_offset">
						@if(isset($keyword))
							<h1>Hasil Pencarian dengan kata kunci "{{$keyword}}"</h1>
						@else
							<h1>Semua Produk</h1>
						@endif
					</div>	
					<div class="section_offset">    
			            <!-- <h3 class="offset_title">Produk Kami</h3>               -->
			            <header class="top_box on_the_sides">
			              <div class="clearfix v_centered">               
			                @if(isset($keyword))
								<p>Hasil Pencarian produk</p>
							@else
								<p>Semua Produk</p>
							@endif
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

			              @if(count($semuaproduk) == 0)
			              	<div class="table_layout" id="products_container">
			              		<div class="table_cell">
			                    	<div class="product_item">
			              				Tidak ditemukan
			              			</div>
			              		</div>
			              	</div>
			              @endif


			            </div>
			            {{$semuaproduk->links()}}
		          	</div>
				</main>
				
				<!-- SIDEBAR -->
				@include('tema/layouts/sidebar')					
			</div>
		</div>					
	</div>
	</div>
@endsection