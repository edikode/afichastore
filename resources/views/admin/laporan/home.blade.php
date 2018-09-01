@extends('layouts.template') 

@section('judul', 'Pemesanan') 

@section('bread')
<li>
  <a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a>
</li>
<li class="active">Pemesanan</li>
@endsection 

@section('main')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
			    <div class="box-header with-border">
			    	<div class="pull-right hidden-xs">
				      <!-- <a href="{{url('admin/pemesanan/create')}}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Tambah Pemesanan</a> -->
				    </div>
			      	<h3 class="box-title">Laporan Pemesanan</h3>
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
					          <th>Invoice</th>
					          <th>Tanggal Pesan</th>
					          <th>Nama</th>
					          <th>Telepon</th>
					          <th>Alamat</th>
					          <th>Produk</th>
					          <th>QTY</th>
					          <th>Total</th>
					        </tr>

					        <?php $i = ($pemesanan->currentpage()-1)* $pemesanan->perpage() + 1;
					        $qty = 0;
					        $total = 0;
					        ?>
					        @if($pemesanan)
						        @foreach($pemesanan as $p)

						        @php 

						        	$pelanggan = Pelanggan($p->pelanggan_id);
						        	$alamat    = Alamat($p->alamat_id);

						        @endphp
						        <tr valign="center">
						          <td>{{$i}}.</td>
						          <td>{{$p->invoice}}</td>
						          <td>{{tgl_id($p->created_at)}}</td>
						          <td>{{$pelanggan->nama}}</td>
						          <td>{{$pelanggan->telepon}}</td>
						          <td>kab. {{$alamat->n_kabupaten}} - {{$alamat->n_kabupaten}}</td>

						          <td><?php $produk = ProdukBelanja($p->id); echo $produk; ?></td>

						          <td align="center">{{$p->jumlah}}</td>
						          <td align="right">Rp. {{angkaRupiah($p->total)}}</td>
						        </tr>
						        @php 
						        	$i = $i+1; 
						        	$qty = $qty+$p->jumlah; 
						        	$total = $total+$p->total; @endphp
					        	@endforeach
					        @endif

					        	<tr>
					        		<td colspan="7" >Total</td>
					        		<td align="center">{{$qty}}</td>
					        		<td align="right">Rp. {{angkaRupiah($total)}}</td>
					        	</tr>
					      </tbody>
					  </table>
			    </div>
			    
			    <div class="box-footer clearfix">
			    	{{$pemesanan->links()}}

			    	<div class="pull-right hidden-xs">
				      <h4>Jumlah Pemesanan: {{$jumlah}}</h4>
				    </div>
			    </div>
			</div>
		</div>
	</div>
</section>
@endsection