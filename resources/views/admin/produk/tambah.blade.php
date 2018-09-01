@extends('layouts.template') 

@section('judul', 'Produk') 

@section('bread')
<li>
  <a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a>
</li>
<li class="active">Produk</li>
@endsection 

@section('main')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
			    <div class="box-header with-border">
			    	<div class="pull-right hidden-xs">
				      <a href="{{url('admin/produk')}}" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i>&nbsp; Kembali</a>
				    </div>
			      	<h3 class="box-title">Tambah Produk Baru</h3>
			    </div>

			    <form role="form" action="{{ url('admin/produk') }}" method="post" enctype="multipart/form-data">
	              <div class="box-body">
	              	<div class="row">
						<div class="col-md-8">
			                <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
			                  <label for="nama">Nama</label>
			                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Produk" value="@if(count($errors) > 0){{old('nama')}}@endif" required="">
			                  @if ($errors->has('nama'))
                                    <span class="help-block">
                                        <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
			                </div>
			                <!-- <div class="form-group">
			                  <label for="link">Link</label>
			                  <input type="link" class="form-control" id="link" name="link" placeholder="Link Produk">
			                </div> -->
			                <div class="form-group">
			                  <label for="judul">Judul</label>
			                  <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul Produk" value="@if(count($errors) > 0){{old('judul')}}@endif" required="">
			                </div>
			                <div class="form-group">
			                  	<label for="teks">Teks</label>
			                  	<textarea id="teks" name="teks" rows="10" cols="80">@if(count($errors) > 0){{old('teks')}}@endif</textarea>
			                </div>
			            </div>
						<div class="col-md-4">
							<div class="form-group{{ $errors->has('berat') ? ' has-error' : '' }}">
				                  <label for="berat">Berat (Gram)</label>
				                  <input type="text" class="form-control" id="berat" name="berat" placeholder="Berat Produk Satuan Gram" value="@if(count($errors) > 0){{old('berat')}}@endif" required="">
				                  @if ($errors->has('berat'))
	                                <span class="help-block">
	                                    <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('berat') }}</strong>
	                                </span>
	                            @endif
			                </div>
			                <div class="form-group{{ $errors->has('harga') ? ' has-error' : '' }}">
				                  <label for="harga">Harga</label>
				                  <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga Produk" value="@if(count($errors) > 0){{old('harga')}}@endif" required="">
				                  @if ($errors->has('harga'))
	                                <span class="help-block">
	                                    <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('harga') }}</strong>
	                                </span>
	                            @endif
			                </div>
			                <div class="form-group">
			                  <label>Kategori Produk</label>
			                  <select name="kategori" class="form-control" required>
			                  	<option value="">Pilih Kategori</option>
			                    <option value="1" @if(old('kategori') == '1')selected @endif>Baju</option>
			                    <option value="2" @if(old('kategori') == '2')selected @endif>Rok Mini</option>
			                    <option value="3" @if(old('kategori') == '3')selected @endif>Rok Panjang</option>
			                  </select>
			                </div>
							<label for="nama">Upload Gambar</label>
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
			            </div>
			        </div>
	                
	              </div>

	              <div class="box-footer">
	              	{{ csrf_field() }}
	                <button type="submit" name="simpan" class="btn btn-primary pull-right">Simpan</button>
	              </div>
	            </form>
			   
			</div>
		</div>
	</div>
</section>
@endsection