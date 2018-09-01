@extends('layouts.template')

@section('title', 'Data Konfirmasi')

@section('bread')
<li><a href="{{ url('admin') }}"><i class="icon-laptop"></i> Home</a></li>
<li class="active">Data Konfirmasi</li>
@endsection

@section('button', '<a class="btn btn-large btn-green item" href="#"  data-target="#tambah" data-toggle="modal">Tambah</a>')
@section('main')

	<div class="row">
		<div class="col-sm-12">	
			@include('pesan/flash_message')				
			<div class="clear panel panel-default">						
				<div class="panel-body">
					<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
						<thead>
							<tr>		
								<th class="no">No</th>	
								<th class="tanggal">Tanggal Konfirmasi</th>
								<th>Invoice</th>
								<th>DP</th>
								<th class="pilihan2">Status</th>
								<th class="pilihan">Pilihan</th>								
							</tr>
						</thead>
						<tbody>

							@php 
								$cek = "0"; 
								$i 	 = 1;
							@endphp
							@foreach($konfirmasi as $r)
							<!-- cek jika sudah di  konfirm maka tampilkan keterangan -->
							@php $ada = count(cekKonfirmasi($r->invoice)) @endphp
							@if($ada > 1)
								@php $cek = count(cekKonfirmasi2($r->invoice)) @endphp

								@if($r->konfirm == 1)
									<tr>
										<td>{{$i}}</td>
										<td class='center'>{{tgl_id($r->created_at)}}</td>
										<td>{{$r->invoice}}</td>
										<td>{{angkaRupiah($r->jumlah)}}</td>
										<td>
											<span class="label label-success"> Sukses Divalidasi</span>
										</td>
										<td>
											<a data-original-title='Lihat Detail' class='btn btn-green tooltips' href='{{ url('admin/konfirmasi/lihat', $r->id)}}'>
												<i class='clip-eye'></i>
											</a>
											<a data-original-title='Edit' class='btn btn-blue tooltips' href='{{ url('admin/konfirmasi/edit', $r->id)}}'>
												<i class='clip-pencil'></i>
											</a>
											<a data-original-title='Hapus' class='btn btn-red tooltips' href='{{ url('admin/konfirmasi/hapus', $r->id)}}' onclick='return konfirmasi()'>
												<i class='clip-remove'></i>
											</a>
										</td>											
									</tr>
								@else
									<tr>
										<td>{{$i}}</td>
										<td class='center'>{{tgl_id($r->created_at)}}</td>
										<td>{{$r->invoice}}</td>
										<td>{{angkaRupiah($r->jumlah)}}</td>
										<td>
											@if($r->konfirm == 0 && $cek > 0)
												<span class="label label-warning"> Data Sudah Dikonfirmasi</span>
											@elseif($r->konfirm == 0)
												<span class="label label-warning">  Belum Dilihat</span>
											@elseif($r->konfirm == 1)
												<span class="label label-success"> Sukses Divalidasi</span>		
											@elseif($r->konfirm == 2)
												<span class="label label-danger"> Tidak Valid</span>	
											@endif
										</td>
										<td>
											<a data-original-title='Lihat Detail' class='btn btn-green tooltips' href='{{ url('admin/konfirmasi/lihat', $r->id)}}'>
												<i class='clip-eye'></i>
											</a>
											<a data-original-title='Edit' class='btn btn-blue tooltips' href='{{ url('admin/konfirmasi/edit', $r->id)}}'>
												<i class='clip-pencil'></i>
											</a>
											<a data-original-title='Hapus' class='btn btn-red tooltips' href='{{ url('admin/konfirmasi/hapus', $r->id)}}' onclick='return konfirmasi()'>
												<i class='clip-remove'></i>
											</a>
										</td>											
									</tr>
								@endif
							@else
								<tr>
									<td>{{$i}}</td>
									<td class='center'>{{tgl_id($r->created_at)}}</td>
									<td>{{$r->invoice}}</td>
									<td>{{angkaRupiah($r->jumlah)}}</td>
									<td>
										@if($r->konfirm == 0)
											<span class="label label-warning"> Belum dilihat</span>
										@elseif($r->konfirm == 1)
											<span class="label label-success"> Sukses Divalidasi</span>		
										@elseif($r->konfirm == 2)
											<span class="label label-danger"> Tidak Valid</span>	
										@endif
									</td>
									<td>
										<a data-original-title='Lihat Detail' class='btn btn-green tooltips' href='{{ url('admin/konfirmasi/lihat', $r->id)}}'>
											<i class='clip-eye'></i>
										</a>
										<a data-original-title='Edit' class='btn btn-blue tooltips' href='{{ url('admin/konfirmasi/edit', $r->id)}}'>
											<i class='clip-pencil'></i>
										</a>
										<a data-original-title='Hapus' class='btn btn-red tooltips' href='{{ url('admin/konfirmasi/hapus', $r->id)}}' onclick='return konfirmasi()'>
											<i class='clip-remove'></i>
										</a>
									</td>											
								</tr>
							@endif
							
							@php $i = $i+1; @endphp

							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>

	<div id="tambah" class="modal fade" tabindex="-1" data-width="760" style="display:none;">
		<form action="konfirmasi/tambah" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Data Konfirmasi</h4>
			</div>		
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">Invoice</label>
							<input type="text" placeholder="Invoice" class="form-control" id="invoice" name="invoice" maxlength="60" value='@if(count($errors) > 0){{old('invoice')}}@endif' required>
						</div>
						<div class="form-group">
							<label class="control-label">Jumlah</label>
							<input type="text" placeholder="Jumlah" class="form-control" id="jumlah" name="jumlah" maxlength="60" value='@if(count($errors) > 0){{old('jumlah')}}@endif' required>
						</div>
						<div class="form-group">
							<div class="fileupload fileupload-new" data-provides="fileupload">
								<div class="fileupload-new thumbnail" style="max-width:334px; max-height:253px;"><img src="{{ asset('assets/images/400x300.jpg') }}" alt=""/>
								</div>
								<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 400px; max-height: 300px; line-height: 20px;"></div>
								<div>
									<span class="btn btn-orange btn-file"><span class="fileupload-new">Pilih Gambar</span><span class="fileupload-exists">Ganti</span>
										<input type="file" name="gambar">
									</span>
									<a href="#" class="btn fileupload-exists btn-orange" data-dismiss="fileupload">
										Hapus
									</a>
								</div>
							</div>
						</div>						
					</div>
				</div>
			</div>
			<div class="modal-footer">				
				<input name="simpan" value="Simpan" type="submit" class="btn btn-green">
			</div>
		</form>	
	</div>

@endsection
