@extends('layouts.template') 

@section('judul', 'Stok Darurat') 

@section('bread')
<li>
  <a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a>
</li>
<li class="active">Stok Darurat</li>
@endsection 

@section('main')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
			    <div class="box-header with-border">
			    	<div class="pull-right hidden-xs">
				      <!-- <a href="{{url('admin/produk/create')}}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Tambah Produk</a> -->
				    </div>
			      	<h3 class="box-title">Stok Produk Darurat</h3>
			    </div>
			    <br>
			    <div class="col-md-12">
			    	@include('pesan/error')
			    </div>
			    <!-- /.box-header -->
			    <div class="box-body table-responsive">
              		<table class="table table-bordered">
				        <tbody>
				        	<tr>
					          <th style="width: 10px">#</th>
					          <th>Nama</th>
					          <th>Kategori</th>
					          <th>Gambar</th>
					          <th>Berat</th>
					          <th>Harga/Pcs</th>
					          <th style="width: 40px">stok</th>
					          <th style="width: 125px">Opsi</th>
					        </tr>

					        @php $i = 1; @endphp
					        @if($produk)
					        	<?php $i = ($produk->currentpage()-1)* $produk->perpage() + 1;?>
						        @foreach($produk as $p)

						        @php $kategori = Kategori_detail($p->kategori_id) @endphp
						        <tr valign="center">
						          <td>{{$i}}.</td>
						          <td>{{$p->nama}}</td>
						          <td>{{$kategori->nama}}</td>
						          <td><img src="{{asset('upload/produk/kecil/'.$p->gambar)}}" width="100px"></td>
						          <td>{{$p->berat}} Gram</td>
						          <td>{{angkaRupiah($p->harga)}}</td>
						          <td><span class="badge bg-red">{{$p->stok}} Pcs</span></td>
						          <td>
						          	<button type="button" data-toggle="modal" data-target="#{{$p->id}}" class="btn btn-success btn-sm"><i class="fa fa-calendar-plus-o"></i></button>
						          	<a href="{{url('admin/produk/'.$p->id.'/edit')}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
						          	<form action="{{url('admin/produk', $p->id)}}" method="post" style="display: inline-block;">
										{{ csrf_field() }}	
										<input type="hidden" name="_method" value="DELETE">
										<button type="submit" data-original-title='Hapus' class="btn btn-danger btn-sm tooltips" onclick='return konfirmasi()'><i class="fa fa-trash"></i></button>
									</form>
						          </td>
						        </tr>

						        <!-- modal -->
						        <div class="modal fade" id="{{$p->id}}">
								  <div class="modal-dialog">
								    <div class="modal-content">
								    	<form  action="{{ url('admin/produk/tambahstokdarurat') }}" method="post">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          <span aria-hidden="true">&times;</span></button>
									        <h4 class="modal-title">Tambah Stok</h4>
									      </div>
									      <div class="modal-body">
								        	<input type="text" name="stok" placeholder="Stok" class="form-control">
								        	<input type="hidden" name="id" value="{{$p->id}}">
								        	{{ csrf_field() }}
									      </div>
									      <div class="modal-footer">
									        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
									        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
									      </div>
									    </form>
								    </div>
								  </div>
								</div>

						        @php $i = $i+1; @endphp
					        	@endforeach
					        @endif
					      </tbody>
					  </table>
			    </div>

			    <div class="box-footer clearfix">
			    	{{$produk->links()}}

			    	<div class="pull-right hidden-xs">
				      <h4>Jumlah Produk: {{$jumlah}}</h4>
				    </div>
			    </div>
			</div>
		</div>
	</div>
</section>


@endsection