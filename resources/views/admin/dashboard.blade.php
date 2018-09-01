@extends('layouts.template') 

@section('judul', 'Dashboard') 

@section('bread')
<li>
  <a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a>
</li>
<li class="active">Dashboard</li>
@endsection 

@section('main')

<section class="content">
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3>
					<?php 
						$pemesanan = InfoPemesanan();
						$jmlpemesanan = 0;
						foreach ($pemesanan as $s) {
							$kadaluarsa = waktu($s->created_at); 

							if($s->konfirmasi == 0){
								if($kadaluarsa < -1){
									
								} else {
									$jmlpemesanan = $jmlpemesanan+1;
								}
							}				
							
						}
						
						echo $jmlpemesanan;
						?>
					</h3>
					<p>
						Pesanan Baru
					</p>
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
				<a href="{{url('admin/pemesanan')}}" class="small-box-footer">Lihat Semua <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-green">
				<div class="inner">
					<h3>{{$produk}}<sup style="font-size: 20px"></sup></h3>
					<p>
						Total Produk
					</p>
				</div>
				<div class="icon">
					<i class="ion ion-pie-graph"></i>
				</div>
				<a href="{{url('admin/produk')}}" class="small-box-footer">Lihat Semua <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3>{{$pelanggan}}</h3>
					<p>
						Pelanggan yang terdaftar
					</p>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
				<a href="{{url('admin/pelanggan')}}" class="small-box-footer">Lihat Semua <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-red">
				<div class="inner">
					<h3>
					<?php 
					$stok2 = $stok; 
					echo count($stok);
					?>
					</h3>
					<p>Sisa Stok kurang dari lima</p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
				<a href="{{url('admin/produk/stokdarurat')}}" class="small-box-footer">Lihat Semua <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<!-- ./col -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="box">
			    <div class="box-header with-border">
			      	<h3 class="box-title">Data Pemesanan Terakhir</h3>
			    </div>
			    <br>
			    <div class="col-md-12">
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
					          <th>QTY</th>
					          <th>Total</th>
					          <th>Status</th>
					        </tr>
					        <?php $no = 1; ?>
					        @foreach($detailpemesanan as $d)
					        <?php $pelanggan = Pelanggan($d->pelanggan_id); ?>
						        <tr>
						        	<td>{{$no++}}</td>
						        	<td>{{$d->invoice}}</td>
						        	<td>{{tgl_id($d->created_at)}}</td>
						        	<td>{{$pelanggan->nama}}</td>
						        	<td>{{$pelanggan->telepon}}</td>
						        	<td>{{$d->jumlah}}</td>
						        	<td>Rp. {{angkaRupiah($d->total+$d->ongkir)}}</td>
						        	<td>
						        		@if($d->konfirmasi == 1)
						        			<div class="alert alert-success" style="padding: 5px;margin-bottom: 0px">Sukses</div>
							          	@elseif($d->konfirmasi == 2)
							          		<div class="alert alert-danger" style="padding: 5px;margin-bottom: 0px">Pembayaran tidak valid</div>
							          	@else
								          	@php $kadaluarsa = waktu($d->created_at); @endphp
											
											@if($kadaluarsa < -1)
												<div class="alert alert-danger" style="padding: 5px;margin-bottom: 0px">Kadaluarsa</div>
											@else
												<div class="alert alert-warning" style="padding: 5px;margin-bottom: 0px">Belum Konfirmasi</div>
											@endif

							          	@endif
						        	</td>
						        </tr>
					        @endforeach
					      </tbody>
					  </table>
			    </div>
			</div>
			<!-- <div class="box-footer clearfix">
		    	{{$detailpemesanan->links()}}

		    	<div class="pull-right hidden-xs">
			      <h4>Jumlah Produk: {{$pemesanan}}</h4>
			    </div> -->
		    </div>
		</div>
	</div>
</section>

@endsection