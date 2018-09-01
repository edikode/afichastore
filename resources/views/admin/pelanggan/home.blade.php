@extends('layouts.template') 

@section('judul', 'Pelanggan') 

@section('bread')
<li>
  <a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a>
</li>
<li class="active">Pelanggan</li>
@endsection 

@section('main')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
			    <div class="box-header with-border">
			    	<div class="pull-right hidden-xs">
				      <!-- <a href="{{url('admin/pelanggan/create')}}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp; Tambah Pelanggan</a> -->
				    </div>
			      	<h3 class="box-title">Data Pelanggan</h3>
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
					          <th>Email</th>
					          <th>Telepon</th>
					          <th>Alamat</th>
					          <th>Foto</th>
					          <!-- <th style="width: 50px">Opsi</th> -->
					        </tr>

					        <?php $i = ($pelanggan->currentpage()-1)* $pelanggan->perpage() + 1;?>
					        @if($pelanggan)
						        @foreach($pelanggan as $p)

						        <tr valign="center">
						          <td>{{$i}}.</td>
						          <td>{{$p->nama}}</td>
						          <td>{{$p->email}}</td>
						          <td>{{$p->telepon}}</td>
						          <td>{{$p->alamat}}</td>
						          <td><img src="{{asset('upload/pelanggan/kecil/'.$p->gambar)}}" width="100px"></td>
						        <!--   <td>
						          	<!-- <a href="{{url('admin/pelanggan/'.$p->id.'/edit')}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> -->
						          	<!-- <form action="{{url('admin/pelanggan', $p->id)}}" method="post" style="display: inline-block;">
										{{ csrf_field() }}	
										<input type="hidden" name="_method" value="DELETE">
										<button type="submit" data-original-title='Hapus' class="btn btn-danger btn-sm tooltips" onclick='return konfirmasi()'><i class="fa fa-trash"></i></button>
									</form> -->
						          <!-- </td>  -->
						        </tr>
						        @php $i = $i+1; @endphp
					        	@endforeach
					        @endif
					      </tbody>
					  </table>
			    </div>
			    
			    <div class="box-footer clearfix">
			    	{{$pelanggan->links()}}

			    	<div class="pull-right hidden-xs">
				      <h4>Jumlah Pelanggan: {{$jumlah}}</h4>
				    </div>
			    </div>
			</div>
		</div>
	</div>
</section>
@endsection