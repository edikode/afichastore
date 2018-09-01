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
				      <a href="{{url('admin/pemesanan')}}" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i>&nbsp; Kembali</a>
				    </div>
			      	<h3 class="box-title">Edit Pemesanan</h3>
			    </div>

			    <form role="form" action="{{ url('admin/pemesanan/'.$pemesanan->id) }}" method="post" enctype="multipart/form-data">
	              <div class="box-body">
	              	<div class="row">
	              		<div class="col-md-12">
	              			@include('pesan/error')
	              		</div>
						<div class="col-md-8">
			                <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
			                  <label for="nama">Nama</label>
			                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama pemesanan" value="@if(count($errors) > 0){{old('nama')}}@else{{$pemesanan->nama}}@endif" required="">
			                  @if ($errors->has('nama'))
	                                <span class="help-block">
	                                    <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('nama') }}</strong>
	                                </span>
	                            @endif
			                </div>
			                <div class="form-group">
			                  <label for="email">Email</label>
			                  <input type="email" class="form-control" id="email" name="email" placeholder="Email pemesanan"  value="@if(count($errors) > 0){{old('email')}}@else{{$pemesanan->email}}@endif" >
			                </div>
			                <div class="form-group{{ $errors->has('telepon') ? ' has-error' : '' }}">
			                  <label for="telepon">Telepon</label>
			                  <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Telepon pemesanan" value="@if(count($errors) > 0){{old('telepon')}}@else{{$pemesanan->telepon}}@endif" required="">
			                  @if ($errors->has('telepon'))
	                                <span class="help-block">
	                                    <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('telepon') }}</strong>
	                                </span>
	                            @endif
			                </div>
			                <div class="form-group">
								<div class="form-group">
									<label class="control-label">Alamat</label>
									<textarea class="form-control" id="alamat" cols="10" rows="4" name="alamat" style="height:75px; resize:none;">@if(count($errors) > 0){{old('alamat')}}@else{{$pemesanan->alamat}}@endif</textarea>
								</div>
							</div>
			            </div>
						<div class="col-md-4">
							<div class="form-group">
			                  <label for="email">QTY</label>
			                  <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Email pemesanan"  value="@if(count($errors) > 0){{old('jumlah')}}@else{{$pemesanan->jumlah}}@endif" readonly="">
			                </div>
			                <div class="form-group">
			                  <label for="total">Total</label>
			                  <input type="text" class="form-control" id="total" name="total" placeholder="Email pemesanan"  value="@if(count($errors) > 0){{old('total')}}@else{{$pemesanan->total}}@endif" readonly="">
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