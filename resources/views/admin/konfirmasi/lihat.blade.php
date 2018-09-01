@extends('layouts.template')

@section('title', 'Konfirmasi')

@section('bread')
<li><a href="{{ url('admin') }}"><i class="icon-laptop"></i> Dashboard</a></li>
<li class="active">Konfirmasi</li>
@endsection

@section('button')

	<a class="btn btn-large btn-red item" href="{{ url('admin/konfirmasi') }}">Kembali</a>

@endsection

@section('main')

	<div class="row">
		<div class="col-sm-12">				
			<div class="panel panel-default">
				<div class="panel-body">
					@php  
						$kadaluarsa = waktuTour($reservasi->tanggal_tour);
						$cekKonfirmasi = cekKonfirmasiStatus($konfirmasi->invoice);
					@endphp

					@if($cekKonfirmasi == "sudah")
						@if($konfirmasi->konfirm == 0 )
						<div class='successHandler alert alert-warning display'>
							<i class='icon-ok'></i> Duplikat konfirmasi, Pembayaran telah dikonfirmasi oleh admin 
						</div>
						@elseif($konfirmasi->konfirm == 2 )
						<div class='successHandler alert alert-danger display'>
							<i class='icon-ok'></i> Pembayaran Tidak Valid 
						</div>
						@else
						<div class='successHandler alert alert-success display'>
							<i class='icon-ok'></i> Pembayaran telah dikonfirmasi oleh admin
						</div>
						@endif
					@else
						@if($konfirmasi->konfirm == 0 )
							@if($kadaluarsa < 0)
								<div class='successHandler alert alert-danger display'>
								<i class='glyphicon glyphicon-remove'></i>Waktu konfirmasi sudah habis</div>
							@elseif($kadaluarsa == 0)
								<div class='successHandler alert alert-danger display'>
								<i class='glyphicon glyphicon-remove'></i>Waktu Konfirmasi oleh pelanggan terakhir hari ini</div>
							@elseif($kadaluarsa > 0)
								<div class='successHandler alert alert-danger display'>
								<i class='glyphicon glyphicon-remove'></i>Waktu Konfirmasi oleh pelanggan kurang {{$kadaluarsa}} Hari Lagi</div>
							@endif
							
						@elseif($konfirmasi->konfirm == 2 )
							<div class='successHandler alert alert-danger display'>
								<i class='glyphicon glyphicon-remove'></i> Data Pembayaran tidak valid
							</div>
						@else
							<div class='successHandler alert alert-success display'>
								<i class='icon-ok'></i> Pembayaran telah dikonfirmasi oleh admin
							</div>
						@endif
					@endif

					<div class="row">
						<div class="col-md-6">
							<h3>Detail Pemesanan</h3>
							<table class="table table-striped table-bordered table-hover" id="sample-table-2">
								<tbody>
									<tr>
										<td>Invoice</td>
										<td>{{$reservasi->invoice}}</td>
									</tr>
									<tr>
										<td>Tanggal pesan</td>
										<td>{{tgl_id($reservasi->created_at)}}</td>
									</tr>
									<tr>
										<td>Tanggal Tour</td>
										<td>{{tgl_id($reservasi->tanggal_tour)}}</td>
									</tr>
									<tr>
										<td>Nama</td>
										<td>{{$reservasi->nama}}</td>
									</tr>
									<tr>
										<td>Jumlah orang</td>
										<td>{{$reservasi->jml_dewasa}} Dewasa
											@if($reservasi->jml_anak>0)
											,{{$reservasi->jml_anak}} Balita
											@endif
										</td>
									</tr>
									@if($konfirmasi->konfirm == 1 )
										<tr>
											<td>DP Yang sudah di transfer</td>
											<td>{{angkaRupiah($reservasi->dp)}}</td>
										</tr>
									@else
										<tr>
											<td>DP Minimal</td>
											<td>
												<span class="label label-warning">{{angkaRupiah($reservasi->jumlah*30/100)}}</span>
											</td>
										</tr>
									@endif
									<tr>
										<td>Total Biaya</td>
										<td>{{angkaRupiah($reservasi->jumlah)}}</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-6">
							<h3>Detail Paket</h3>
							<table class="table table-striped table-bordered table-hover" id="sample-table-2">
								<!-- <thead>
									<tr>
										<th class="center" colspan="2">
											Detail Paket
										</th>
									</tr>
								</thead> -->
								<tbody>
									<tr>
										<td>Nama Paket</td>
										<td>{{$paket->nama}}</td>
									</tr>
									<tr>
										<td>Kategori</td>
										<td>{{$kategori->nama}}</td>
									</tr>
									<tr>
										<td>Hari</td>
										<td>{{$paket->hari}} Hari</td>
									</tr>
									<tr>
										<td>Harga/pax</td>
										<td>{{angkaRupiah($paket->harga)}}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-12">
							<h3>Detail Konfirmasi</h3>
						</div>
						<div class="col-md-8">
							<table class="table table-striped table-bordered table-hover" id="sample-table-2">
								<tbody>
									<tr>
										<td>Invoice</td>
										<td>{{$konfirmasi->invoice}}</td>
									</tr>
									<tr>
										<td>Tanggal Transfer</td>
										<td>{{tgl_id($konfirmasi->tgl_transfer)}}</td>
									</tr>
									<tr>
										<td>Jumlah Transfer</td>
										<td>
											<span class="label label-warning">{{angkaRupiah($konfirmasi->jumlah)}}
											</span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Bukti Pembayaran</label>
								@if($konfirmasi->gambar)
								<a href="{{ asset('upload/konfirmasi/sedang/'.$konfirmasi->gambar) }}" target="_blank">
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="fileupload-new thumbnail" style="max-width:380px; max-height:257px;"><img src="{{ asset('upload/konfirmasi/sedang/'.$konfirmasi->gambar) }}" alt="Bukti pembayaran - {{$konfirmasi->nama}}"/>
										</div>
										<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 400px; max-height: 300px; line-height: 20px;"></div>
									</div>	
								</a>
								@else
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail" style="max-width:380px; max-height:257px;"><img src="{{ asset('assets/images/400x300.jpg') }}" alt=""/>
									</div>
									<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 400px; max-height: 300px; line-height: 20px;">
									</div>
								</div>
								@endif
							</div>
						</div>
					</div>

					@if($konfirmasi->konfirm == 0 && $cekKonfirmasi != "sudah")
						<hr>
						<div class="row">
							<div class="col-md-12">
								<a href="{{ url('admin/konfirmasi/non-validasi', $konfirmasi->id)}}" class="btn btn-red fright" style="margin-left: 20px;">Tidak Valid</a>
								<a href="{{ url('admin/konfirmasi/validasi', $konfirmasi->id)}}" class="btn btn-green fright">Validasi</a>
							</div>
						</div>	
					@endif						
				</div>
			</div>				
		</div>		
	</div>

@endsection
