@extends('layouts.template') 

@section('judul', 'Profil Store') 

@section('bread')
<li>
  <a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a>
</li>
<li class="active">Profil Store</li>
@endsection 

@section('main')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
			    <div class="box-header with-border">
			      	<h3 class="box-title">Edit Profil Store</h3>
			    </div>

			    <form role="form" action="{{ url('admin/profil-store/1') }}" method="post" enctype="multipart/form-data">
	              <div class="box-body">
	              	<div class="row">
	              		<div class="col-md-12">
	              			@include('pesan/error')
	              		</div>
						<div class="col-md-8">
			                <div class="form-group">
			                  	<label for="nama">Nama</label>
			                  	<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Produk" value="@if(count($errors) > 0){{old('nama')}}@else{{$profil->nama}}@endif" required="">
			                </div>
			                <div class="form-group">
								<div class="form-group">
									<label class="control-label">Deskripsi</label>
									<textarea class="form-control" id="deskripsi" cols="10" rows="4" name="deskripsi" style="height:75px; resize:none;">@if(count($errors) > 0){{old('deskripsi')}}@else{{$profil->deskripsi}}@endif</textarea>
								</div>
							</div>
			                <div class="form-group">
								<div class="form-group">
									<label class="control-label">Alamat</label>
									<textarea class="form-control" id="alamat" cols="10" rows="4" name="alamat" style="height:75px; resize:none;">@if(count($errors) > 0){{old('alamat')}}@else{{$profil->alamat}}@endif</textarea>
								</div>
							</div>
			                <div class="form-group{{ $errors->has('telepon') ? ' has-error' : '' }}">
			                  <label for="telepon">Telepon</label>
			                  <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Telepon" value="@if(count($errors) > 0){{old('telepon')}}@else{{$profil->telepon}}@endif" required="">
			                  @if ($errors->has('telepon'))
                                    <span class="help-block">
                                        <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('telepon') }}</strong>
                                    </span>
                                @endif
			                </div>
			                <div class="form-group">
			                  <label for="email">Email</label>
			                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="@if(count($errors) > 0){{old('email')}}@else{{$profil->email}}@endif" required="">
			                </div>
			                <!-- <div class="form-group">
			                  <label for="facebook">Facebook</label>
			                  <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook" value="@if(count($errors) > 0){{old('facebook')}}@else{{$profil->facebook}}@endif" required="">
			                </div> -->
			                <div class="form-group">
			                  <label for="website">Website</label>
			                  <input type="text" class="form-control" id="website" name="website" placeholder="Website" value="@if(count($errors) > 0){{old('website')}}@else{{$profil->website}}@endif" required="">
			                </div>
			                <div class="form-group">
			                  	<label for="teks">Teks</label>
			                  	<textarea id="teks" name="teks" rows="10" cols="80">@if(count($errors) > 0){{old('teks')}}@else{{$profil->teks}}@endif</textarea>
			                </div>
			            </div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Upload Gambar</label>
								@if($profil->gambar)
									@if(file_exists("upload/profil/kecil/". $profil->gambar))
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<div class="fileupload-new thumbnail" style="max-width:334px; max-height:253px; position:relative;">
												<div class="hapus-gambar">
													<a data-original-title="Hapus" data-placement="left" class="btn btn-bricky btn-danger tooltips" href="{{ url('admin/profil-store/hapusgambar/'. $profil->id) }}" onclick="return hapusgambar()">
														<i class="fa fa-trash"></i>
													</a>
												</div>
												<img src="{{ url('/upload/profil/kecil/'. $profil->gambar) }}">
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