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
			      	<h3 class="box-title">Data Pemesanan</h3>
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
					          <th>QTY</th>
					          <th>Total</th>
					          <th>Status</th>
					          <th style="width: 130px">Opsi</th>
					        </tr>

					        <?php $i = ($pemesanan->currentpage()-1)* $pemesanan->perpage() + 1;?>
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
						          <td align="center">{{$p->jumlah}}</td>
						          <td>Rp. {{angkaRupiah($p->total+$p->ongkir)}}</td>
						          <td>
						          	@if($p->konfirmasi == 1)
						          		<div class="alert alert-success" style="padding: 5px;margin-bottom: 0px">
						          			Sukses
						          		</div>
						          	@elseif($p->konfirmasi == 2)
						          		<div class="alert alert-danger" style="padding: 5px;margin-bottom: 0px">
						          			Pembayaran tidak valid
						          		</div>
						          	@else
							          	@php $kadaluarsa = waktu($p->created_at); @endphp
										
										@if($kadaluarsa < -1)
											<div class="alert alert-danger" style="padding: 5px;margin-bottom: 0px">
												Kadaluarsa
											</div>
										@else
											<div class="alert alert-warning" style="padding: 5px;margin-bottom: 0px">
												Belum Konfirmasi
											</div>
										@endif

						          	@endif
						          </td>
						          <td>
						          	@php $cek = CekKonfirmasi($p->invoice) @endphp
						          	@if(count($cek) > 0)
						          		<a data-toggle="modal" data-target="#{{$p->invoice}}" title="Konfirmasi" class="btn btn-warning btn-sm">
						          			<i class="fa fa-bookmark"></i>
						              	</a>

						          		<div class="modal fade" id="{{$p->invoice}}">
								          <div class="modal-dialog">
								            <div class="modal-content">
								              <div class="modal-header">
								                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								                  <span aria-hidden="true">&times;</span></button>
								                <h4 class="modal-title">Bukti Konfirmasi</h4>
								              </div>
								              <div class="modal-body">
								                <p>Tanggal Transfer : {{tgl_id($cek->created_at)}}</p>
								                <img src="{{asset('upload/pembayaran/sedang/'.$cek->gambar)}}" class="img-responsive">
								              </div>
								              <div class="modal-footer">
								              	@if($cek->konfirmasi == 0)
									                <a href="{{url('admin/validasi/'.$cek->id)}}" class="btn btn-success pull-left">Validasi</a>
									                <a href="{{url('admin/nonvalidasi/'.$cek->id)}}" class="btn btn-danger">Tidak Valid</a>
									            @endif
								              </div>
								            </div>
								          </div>
								        </div>

						          	@endif
						          	<a href="{{url('admin/pemesanan/'.$p->id)}}" title="Lihat" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
						          	<!-- <a href="{{url('admin/pemesanan/'.$p->id.'/edit')}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> -->
						          	<form action="{{url('admin/pemesanan', $p->id)}}" method="post" style="display: inline-block;">
										{{ csrf_field() }}	
										<input type="hidden" name="_method" value="DELETE">
										<button type="submit"  title="Hapus" class="btn btn-danger btn-sm tooltips" onclick='return konfirmasi()'><i class="fa fa-trash"></i></button>
									</form>
						          </td>
						        </tr>


						        

						        @php $i = $i+1; @endphp
					        	@endforeach
					        @endif
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