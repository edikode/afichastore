@extends('layouts.template') 

@section('judul', 'Detail Pemesanan') 

@section('bread')
<li>
  <a href="{{url('admin')}}"><i class="fa fa-dashboard"></i> Home</a>
</li>
<li class="active">Pemesanan</li>
@endsection 

@section('main')

<section class="invoice">
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        Pemesanan Produk
        <div class="pull-right hidden-xs">
	      <a href="{{url('admin/pemesanan')}}" class="btn btn-danger" style="margin-top: -10px;"><i class="fa fa-arrow-circle-left"></i>&nbsp; Kembali</a>
	    </div>
      </h2>
    </div>
  </div>
  <div class="row invoice-info">
    <div class="col-sm-3 invoice-col">
      Pemesan
      <address>
        <strong>{{$pelanggan->nama}}</strong><br>
        {{$pelanggan->alamat}}<br>
        Telepon: {{$pelanggan->telepon}}<br>
        Email: {{$pelanggan->email}}
      </address>
    </div>
    <div class="col-sm-3 invoice-col">
      Alamat Tujuan
      <address>
        <strong>{{$alamat->nama}}</strong><br>
        {{$alamat->alamat}}<br>
        Prov. {{$alamat->n_provinsi}}, Kab. {{$alamat->n_kabupaten}}, {{$alamat->kode_pos}}<br>
        Telepon: {{$alamat->telepon}}<br>
      </address>

    </div>
    <div class="col-sm-3 invoice-col">
      <strong>Jasa Pengiriman</strong>
      <p>{{$p->kurir}} <br>{{$p->layanan}}</p>
    </div>
    <div class="col-sm-3 invoice-col">
      <b>Invoice #{{$p->invoice}}</b><br>
      <b>Tanggal Pesan:</b> {{tgl_id($p->created_at)}}<br>
      <b>Status:</b>
        @if($p->konfirmasi == 1)
            Sukses
        @elseif($p->konfirmasi == 2)
            Pembayaran tidak valid
        @else
            @php $kadaluarsa = waktu($p->created_at); @endphp
        
            @if($kadaluarsa < -1)
              Kadaluarsa
            @else
              Belum Konfirmasi
            @endif

        @endif
      <br>
      <!-- <b>Account:</b> 968-34567 -->
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th>Produk</th>
          <th>Size</th>
          <th>Deskripsi</th>
          <th>Qty</th>
          <th style="text-align: right;">Harga Produk</th>
        </tr>
        </thead>
        <tbody>
        @foreach($detail as $d)
        	@php $produk = DetailProduk($d->produk_id) @endphp
	        <tr>
	          <td>{{$produk->nama}}</td>
            <td>{{$d->size}}</td>
            <td>{{$d->keterangan}}</td>
            <td>{{$d->jumlah}}</td>
	          <td style="text-align: right;">Rp. {{angkaRupiah($produk->harga)}}</td>
	        </tr>
	    @endforeach

        </tbody>
      </table>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-6">
    </div>
    <div class="col-xs-6">
      <p class="lead">Total Pemesanan</p>

      <div class="table-responsive">
        <table class="table">
          <tr>
            <th style="width:50%">Subtotal:</th>
            <td>Rp. {{angkaRupiah($p->total)}}</td>
          </tr>
          <tr>
            <th>Ongkir</th>
            <td>Rp. {{angkaRupiah($p->ongkir)}}</td>
          </tr>
          <tr>
            <th>Total:</th>
            <td>Rp. {{angkaRupiah($p->total+$p->ongkir)}}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <!-- this row will not appear when printing -->
  <!-- <div class="row no-print">
    <div class="col-xs-12">
      <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
      <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
      </button>
      <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
        <i class="fa fa-download"></i> Generate PDF
      </button>
    </div>
  </div> -->
</section>
@endsection