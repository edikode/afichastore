@extends('layouts.template') 

@section('judul', 'Pengelola') 

@section('bread')
<li>
  <a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a>
</li>
<li class="active">Pengelola</li>
@endsection 

@section('main')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
			    <div class="box-header with-border">
			    	<div class="pull-right hidden-xs">
				      <a href="{{url('admin/pengelola')}}" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i>&nbsp; Kembali</a>
				    </div>
			      	<h3 class="box-title">Edit Pengelola</h3>
			    </div>

			    <form role="form" action="{{ url('admin/pengelola/'.$pengelola->id) }}" method="post" enctype="multipart/form-data">
	              <div class="box-body">
	              	<div class="row">
	              		<div class="col-md-12">
	              			@include('pesan/error')
	              		</div>
						<div class="col-md-8">
			                <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
			                  <label for="nama">Nama</label>
			                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama pengelola" value="@if(count($errors) > 0){{old('nama')}}@else{{$pengelola->nama}}@endif" required="">
			                  @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
			                </div>
			                <div class="form-group">
			                  <label for="email">Email</label>
			                  <input type="email" class="form-control" id="email" name="email" placeholder="Email pengelola"  value="@if(count($errors) > 0){{old('email')}}@else{{$pengelola->email}}@endif" >
			                </div>
			                <div class="form-group">
			                  <label for="telepon">Telepon</label>
			                  <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Telepon pengelola" value="@if(count($errors) > 0){{old('telepon')}}@else{{$pengelola->telepon}}@endif" required="">
			                </div>
			                <div class="form-group">
								<div class="form-group">
									<label class="control-label">Alamat</label>
									<textarea class="form-control" id="alamat" cols="10" rows="4" name="alamat" style="height:75px; resize:none;">@if(count($errors) > 0){{old('alamat')}}@else{{$pengelola->alamat}}@endif</textarea>
								</div>
							</div>
							<div class='form-group'>
								<label class='control-label'>Password</label>
								<input type='password' placeholder='Password' class='form-control limited' id='password' name='password' maxlength='110' value='@if(count($errors) > 0){{old('password')}}@else{{$pengelola->password}}@endif'>
							</div>
							<div class='form-group'>
								<label class='control-label'>Ulangi Password</label>
								<input type='password' placeholder='Ulangi Password' class='form-control limited' id='konfirmasiPassword' name='konfirmasiPassword' maxlength='110' value='@if(count($errors) > 0){{old('konfirmasiPassword')}}@else{{$pengelola->password}}@endif'>
							</div>
			            </div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Upload Gambar</label>
								@if($pengelola->gambar)
									@if(file_exists("upload/pengelola/kecil/". $pengelola->gambar))
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<div class="fileupload-new thumbnail" style="max-width:334px; max-height:253px; position:relative;">
												<div class="hapus-gambar">
													<a data-original-title="Hapus" data-placement="left" class="btn btn-bricky btn-danger tooltips" href="{{ url('admin/pengelola/hapusgambar/'. $pengelola->id) }}" onclick="return hapusgambar()">
														<i class="fa fa-trash"></i>
													</a>
												</div>
												<img src="{{ url('/upload/pengelola/kecil/'. $pengelola->gambar) }}">
											</div>										
										</div>
									@else
										<div class='successHandler alert alert-danger display'>
											<i class='glyphicon glyphicon-remove'></i> Error. Gambar Kosong. Silahkan upload lagi.
										</div>
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<div class="fileupload-new thumbnail" style="max-width:334px; max-height:253px;"><img src="{{ asset('admins/img/400x300.jpg') }}" alt=""/>
											</div>
											<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 400px; max-height: 300px; line-height: 20px;"></div>
											<div>
												<span class="btn btn-warning btn-file"><span class="fileupload-new">Pilih Gambar</span><span class="fileupload-exists">Ganti</span>
													<input type="file" name="gambar">
												</span>
												<a href="#" class="btn fileupload-exists btn-warning" data-dismiss="fileupload">
													Hapus
												</a>
											</div>
										</div>	
									@endif
								@else
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail" style="max-width:334px; max-height:253px;"><img src="{{ asset('admins/img/400x300.jpg') }}" alt=""/>
									</div>
									<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 400px; max-height: 300px; line-height: 20px;"></div>
									<div>
										<span class="btn btn-warning btn-file"><span class="fileupload-new">Pilih Gambar</span><span class="fileupload-exists">Ganti</span>
											<input type="file" name="gambar">
										</span>
										<a href="#" class="btn fileupload-exists btn-warning" data-dismiss="fileupload">
											Hapus
										</a>
									</div>
								</div>
								@endif
							</div>
			            </div>
			        </div>
	                
	              </div>

	              <div class="box-footer">
	              	{{ csrf_field() }}
	              	<input type="hidden" name="_method" value="PUT">
	                <button type="submit" name="simpan" class="btn btn-primary pull-right">Simpan</button>
	              </div>
	            </form>
			   
			</div>
		</div>
	</div>
</section>
@endsection