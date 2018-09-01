@extends('tema.layouts.template')

@section('judul', 'Kategori Aficha Store')

@section('main')

<div class="secondary_page_wrapper">
	<div class="container">					
		<ul class="breadcrumbs">
			<li><a href="{{url('/')}}">Home</a></li>
			<li><a href="{{url('produk')}}">Semua Produk</a></li>
			<li>{{$kat->nama}}</li>
		</ul>
		<div class="section_offset">
			<div class="row">
				<main class="col-md-9 col-sm-8">
					<div class="section_offset">    
			            <h3 class="offset_title">Kategori {{$kat->nama}}</h3>              
			            <header class="top_box on_the_sides">
			              <div class="clearfix v_centered">               
			                <p>Produk Berdasarkan <strong> Kategori {{$kat->nama}}</strong></p>
			              </div>
			            </header>
			            <div class="table_layout" id="products_container">
			              @if(count($produk) == 0 )
			              	<div class="table_row">
			              		<div class="table_cell">
				                    <div class="product_item">
			              				<h2>Produk kategori {{$kat->nama}} masih kosong</h2>
			              			</div>
			              		</div>
			              	</div>
			              @else

			              	@php $i = 1 @endphp
			            	@foreach($produk as $p)

				                @if($i == 1)
				                  	<div class="table_row">
				                  	@php $i = $i+1 @endphp
				                @endif

				                  <div class="table_cell">
				                    <div class="product_item">
				                      <div class="image_wrap">
				                        <img src="{{url('upload/produk/sedang/'.$p->gambar)}}" alt="{{$p->judul}}">
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

			              @endif

			            </div>

			            {{$produk->links()}}
			        </div>
				</main>
				
				@include('tema/layouts/sidebar')						
			</div>
		</div>					
	</div>
	</div>
@endsection