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
					<form action="{{ url('admin/konfirmasi/edit', $konfirmasi->id) }}" method="post" enctype="multipart/form-data">				
						<div class="row">
							<div class="col-md-12">
								@include('pesan/flash_message')								
							</div>
							<div class="col-md-8">
								<div class='form-group'>
									<label class='control-label'>Jumlah Transfer</label>
									<input type='text' placeholder='Jumlah Transfer' class='form-control limited' id='jumlah' name='jumlah' maxlength='100' value='@if(count($errors) > 0){{old('jumlah')}}@else{{$konfirmasi->jumlah}}@endif'
									 required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Bukti Pembayaran</label>
									@if($konfirmasi->gambar)
										@if(file_exists("upload/konfirmasi/kecil/". $konfirmasi->gambar))
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="max-width:334px; max-height:253px; position:relative;">
													<div class="hapus-gambar">
														<a data-original-title="Hapus" data-placement="left" class="btn btn-bricky tooltips" href="{{ url('admin/konfirmasi/hapusgambar/'. $konfirmasi->id) }}" onclick="return hapusgambar()">
															<i class="icon-remove icon-white"></i>
														</a>
													</div>
													<img src="{{ url('/upload/konfirmasi/kecil/'. $konfirmasi->gambar) }}">
												</div>										
											</div>
										@else
											<div class='successHandler alert alert-danger display'>
												<i class='glyphicon glyphicon-remove'></i> Error. Gambar Kosong. Silahkan upload lagi.
											</div>
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
										@endif
									@else
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
									@endif
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								{{ csrf_field() }}
								<input type="hidden" name="_method" value="PUT">
								<input name="simpan" value="Simpan" type="submit" class="btn btn-green fright">
							</div>
						</div>							
					</form>
				</div>
			</div>				
		</div>		
	</div>

@endsection
