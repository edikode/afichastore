@extends('tema.layouts.template')

@section('judul', 'Home')

@section('main')

<div class="secondary_page_wrapper">
	<div class="container">
		<ul class="breadcrumbs">
			<li><a href="index.html">Home</a></li>
			<li>Kerangjang Belanja</li>

		</ul>
		<!-- KONTEN -->
		<section class="section_offset">
		<form role="form" action="{{ url('updateqty') }}" method="post">
			{{ csrf_field() }}
			<h1>Keranjang Belanja</h1>		
			@include('pesan/flash_message')
			<br>				
			<div class="table_wrap">
				
				<table class="table_type_1 shopping_cart_table">
					<thead>
						<tr>
							<th class="product_image_col">Gambar </th>
							<th class="product_title_col">Nama Produk</th>										
							<th>Harga</th>
							<th class="product_qty_col">Jumlah</th>
							<th>Total</th>
							<th class="product_actions_col">Aksi</th>
						</tr>

					</thead>

					<tbody>

						@if(Cart::count() != 0)
							@foreach(Cart::content() as $row)
							<input type="hidden" name="rowId[]" value="{{$row->rowId}}">
							<input type="hidden" name="id[]" value="{{$row->id}}">
							<tr>
								<td class="product_image_col" data-title="Product Image">
									<a href="#"><img src="{{asset('upload/produk/kecil/'.$row->gambar)}}" alt=""></a>
								</td>
								<td data-title="Product Name">
									<a href="#" class="product_title">{{$row->name}}</a> <br>
									<a class='button_blue' href='#' data-target="#ubah{{$row->id}}" data-toggle="modal">
	                                  Ubah Detail
	                                </a>
									<!-- <ul class="sc_product_info">
										<li>Ukuran: L</li>
										<li>Warna: Merah</li>
									</ul> -->
								</td>
								<td class="subtotal" data-title="Price">											
									Rp. {{angkaRupiah($row->price)}},-
								</td>
								<td data-title="Quantity">
									<div class="qty min clearfix">
										<button class="theme_button" data-direction="minus">&#45;</button>
										<input type="text" name="qty[]" value="{{$row->qty}}">
										<button class="theme_button" data-direction="plus">&#43;</button>
									</div>
								</td>
								<td class="total" data-title="Total">
									Rp. {{angkaRupiah($row->subtotal)}},-
								</td>
								<td data-title="Action" style="text-align: center">
									<a href="{{url('hapusitem/'.$row->rowId)}}" class="button_dark_grey icon_btn remove_product"><i class="icon-cancel-2"></i></a>
								</td>
							</tr>

							@endforeach
						@else
							<tr>
								<td colspan="6">
									Keranjang masih kosong
								</td>
							</tr>
						@endif
					</tbody>
				</table>
			</div>
			<footer class="bottom_box on_the_sides">

				<div class="left_side">
					<a href="{{url('produk')}}" class="button_blue middle_btn">Lanjut Berbelanja</a>								
				</div>				
				<div class="right_side">							
					<a href="{{url('hapuskeranjang')}}" class="button_blue middle_btn">Kosongkan Keranjang</a>
				</div>
			</footer>
		</form>
		</section>

		@foreach(Cart::content() as $row)

		<div id="ubah{{$row->id}}" class="modal fade" tabindex="-1" data-width="760" style="display:none;">
            <form action="{{url('ubahdetail')}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                <h4 class="modal-title">Ubah Detail Barang</h4>
              </div>    
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" name="rowId" value="{{$row->rowId}}">
                    <div class="form-group">
                      <label>Ukuran</label>
                      <input type="text" name="size" class="form-control"  value="{{$row->size}}">
                    </div>
                    <div class="form-group">
                      <label>Keterangan Untuk Detail Barang</label>
                      <textarea name="keterangan">{{$row->keterangan}}</textarea>
                    </div>            
                  </div>
                </div>
              </div>
              <div class="modal-footer">        
                <input name="simpan" value="Simpan" type="submit" class="button_blue middle_btn">
              </div>
            </form> 
          </div>

		@endforeach

		<div class="section_offset">
			<div class="row">
				<section class="col-sm-8">
					
				</section>

				<section class="col-sm-4">
					<h3>Total Belanja</h3>
					<div class="table_wrap">
						<table>
							<tfoot>
								<tr>												
									<td>Subtotal</td>
									<td class="subtotal">Rp. {{(Cart::subtotal())}},-</td>
								</tr>
							</tfoot>
						</table>
					</div>

					<footer class="bottom_box on_the_sides">
						<div class="right_side">
							<a class="button_blue middle_btn" href="{{url('checkout')}}">Selesai Belanja</a>
						</div>
					</footer>

				</section><!-- / [col] -->

			</div><!--/ .row -->

		</div>
	</div>
</div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>