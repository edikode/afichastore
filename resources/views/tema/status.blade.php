@extends('tema.layouts.template')

@section('judul', 'Konfirmasi Pembayaran')

@section('main')

<div class="secondary_page_wrapper">
  <div class="container">
    <ul class="breadcrumbs">
      <li><a href="{{url('/')}}">Home</a></li>
      <li>Konfirmasi Pembayaran</li>

    </ul>
    <!-- KONTEN -->
    <div class="section_offset">
      <div class="row">
        <!-- MAIN -->
        <aside  class="col-md-4 col-sm-4 has_mega_menu">
          <section class="section_offset">
            <h3>Alur Konfirmasi</h3>
            <ul class="products_list_widget">
              <li><label><strong>Cek Pemesanan : </strong></label>
                <p align="justify">
                  Proses konfirmasi harus segera dilakukan maksimal 1 hari setelah pemesanan. pertama cek data pemesanan anda pada email yang telah kami kirimkan ke email anda
                </p>
              </li>
              <li><label><strong>Transfer : </strong></label>
                <p align="justify">
                  Setelah anda memeriksa data pemesanan sesuai, silahkan transfer biaya sejumlah yang tertera pada email anda. <br>
                  Pembayaran dapat di transfer melalui Rekening <strong> Mandiri xxx.xx. xxxx.xxxx an. Aficha Store</strong> atau <strong>BCA xxxxxxxxx an. Wildan.</strong>
                </p>
              </li>
              <li><label><strong>Upload Bukti Transfer : </strong></label>
                <p align="justify">
                  Lakukan Konfirmasi pembayaran dengan mengupload bukti pembayaran pada menu pembayaran anda. dan pilih sesuai tanggal pemesanan anda
                </p>
              </li>
              <li><label><strong>Tunggu Proses Verifikasi : </strong></label>
                <p align="justify">
                  Setelah anda melakukan upload bukti pembayaran, langkah selanjutnya adalah menunggu proses verifikasi dari admin. jika pembayaran anda dianggap valid, maka produk akan dikirim melalui kurir yang telah anda pilih. Namun jika konfirmasi anda tidak sesuai anda harus mengupload bukti pembayaran ulang sampai data dianggap valid oleh admin.
                </p>
              </li>
            </ul>
          </section>
        </aside>

        <main class="col-md-8 col-sm-8">
          @if($pemesanan == "kosong")
            <br>
            <h1>Belum Ada Pemesanan</h1>
          @else
            <h1>Konfirmasi Pembayaran</h1>

            <ul class="nav nav-tabs">
              <li class="active"><a href="#konfirmasi" data-toggle="tab">Konfirmasi Pembayaran</a></li>
              <li><a href="#pembayaran" data-toggle="tab">Status Pembayaran</a></li>
              <li><a href="#daftartransaksi" data-toggle="tab">Daftar Transaksi</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="konfirmasi">
                <br>
                <h2>Belanja belum konfirmasi</h2>
                <div class="table_wrap">
                  <table class="table_type_1 shopping_cart_table">
                    <thead>
                      <tr>
                        <th width="20%">Tanggal </th>
                        <th width="">Produk</th>
                        <th width="20%">Total Belanja</th>
                        <th width="25%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @foreach($pemesanan as $p)
                          @if($p->konfirmasi == 0)
                            <tr>
                              <td>
                                {{tgl_id($p->created_at)}}
                              </td>
                              <td>
                                @php echo ProdukBelanja($p->id) @endphp
                              </td>
                              <td style="text-align: right;">
                                {{angkaRupiah($p->total+$p->ongkir)}}
                              </td>
                              <td>
                                <a class='button_blue' href='#' data-target="#tambah{{$p->id}}" data-toggle="modal">
                                  Upload Pembayaran
                                </a>
                                @php $konfirmasi = CekKonfirmasi($p->invoice) @endphp
                                @if(count($konfirmasi))
                                <a class='button_blue' href="{{asset('upload/pembayaran/sedang/'.$konfirmasi->gambar)}}" target="_blank" style="margin-top: 10px">
                                  Lihat Bukti
                                </a>
                                @endif
                              </td>
                            </tr>
                            @php $i = $i+1; @endphp
                          @elseif($p->konfirmasi == 2 )
                            <tr>
                              <td>
                                {{tgl_id($p->created_at)}}
                              </td>
                              <td>
                                @php echo ProdukBelanja($p->id) @endphp
                              </td>
                              <td style="text-align: right;">
                                {{angkaRupiah($p->total+$p->ongkir)}}
                              </td>
                              <td>

                                <a class='button_blue' href='#' data-target="#tambah{{$p->id}}" data-toggle="modal">
                                  Upload ulang
                                </a>
                                @php $konfirmasi = CekKonfirmasi($p->invoice) @endphp
                                @if(count($konfirmasi))
                                <a class='button_blue' href="{{asset('upload/pembayaran/sedang/'.$konfirmasi->gambar)}}" target="_blank" style="margin-top: 10px;margin-bottom: 10px">
                                  Lihat Bukti
                                </a>
                                <br>
                                  @if($konfirmasi->konfirmasi == 2)
                                  (Bukti Tidak Valid)
                                  @endif
                                @endif
                              </td>
                            </tr>
                            @php $i = $i+1; @endphp
                          @endif

                          <div id="tambah{{$p->id}}" class="modal fade" tabindex="-1" data-width="760" style="display:none;">
                            <form action="{{url('upload-pembayaran')}}" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="modal-header">
                                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                                <h4 class="modal-title">Upload bukti transfer</h4>
                              </div>    
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-12">
                                    <input type="hidden" name="invoice" value="{{$p->invoice}}">
                                    <div class="form-group">
                                      <label>Bukti Transfer</label>
                                      <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail" style="max-width:334px; max-height:253px;"><img src="{{ asset('admins/img/400x300.jpg') }}" alt=""/>
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 400px; max-height: 300px; line-height: 20px;"></div>
                                        <div>
                                          <span>
                                            <input type="file" name="gambar" class="form-control" required="">
                                          </span>
                                        </div>
                                      </div>
                                    </div>            
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">        
                                <input name="simpan" value="Simpan" type="submit" class="button_blue middle_btn">
                              </div>
                            </form> 
                          </div>
                        @endforeach

                        @if($i == 0)
                        <tr>
                          <td colspan="4" align="center">Data Kosong</td>
                        </tr>
                        @endif
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane" id="pembayaran">
                <br>
                <h2>Pemesanan sudah dikonfirmasi</h2>
                <div class="table_wrap">
                  <table class="table_type_1 shopping_cart_table">
                    <thead>
                      <tr>
                        <th width="20%">Tanggal </th>
                        <th width="">Produk</th>
                        <th width="20%">Total Belanja</th>
                        <th width="25%">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @foreach($pemesanan as $p)
                          @if($p->konfirmasi == 1)
                            <tr>
                              <td>
                                {{tgl_id($p->created_at)}}
                              </td>
                              <td>
                                @php echo ProdukBelanja($p->id) @endphp
                              </td>
                              <td style="text-align: right;">
                                {{angkaRupiah($p->total+$p->ongkir)}}
                              </td>
                              <td>
                                Sudah dikonfirmasi, Barang dalam antrian pengiriman
                              </td>
                            </tr>
                            @php $i = $i+1; @endphp
                          @elseif($p->konfirmasi == 2)
                            <tr>
                              <td>
                                {{tgl_id($p->created_at)}}
                              </td>
                              <td>
                                @php echo ProdukBelanja($p->id) @endphp
                              </td>
                              <td style="text-align: right;">
                                {{angkaRupiah($p->total+$p->ongkir)}}
                              </td>
                              <td>
                                Data Pembayaran tidak valid, ulangi proses konfirmasi pembayaran
                              </td>
                            </tr>
                            @php $i = $i+1; @endphp
                          @endif 
                          


                          <div id="tambah{{$p->id}}" class="modal fade" tabindex="-1" data-width="760" style="display:none;">
                            <form action="{{url('upload-pembayaran')}}" method="post" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <div class="modal-header">
                                <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                                <h4 class="modal-title">Upload bukti transfer</h4>
                              </div>    
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-12">
                                    <input type="hidden" name="invoice" value="{{$p->invoice}}">
                                    <div class="form-group">
                                      <label>Bukti Transfer</label>
                                      <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail" style="max-width:334px; max-height:253px;"><img src="{{ asset('admins/img/400x300.jpg') }}" alt=""/>
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 400px; max-height: 300px; line-height: 20px;"></div>
                                        <div>
                                          <span>
                                            <input type="file" name="gambar" class="form-control" required="">
                                          </span>
                                        </div>
                                      </div>
                                    </div>            
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">        
                                <input name="simpan" value="Simpan" type="submit" class="button_blue middle_btn">
                              </div>
                            </form> 
                          </div>
                        @endforeach
                        @if($i == 0)
                        <tr>
                          <td colspan="4" align="center">Data Kosong</td>
                        </tr>
                        @endif
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane" id="daftartransaksi">
                <br>
                <h2>Daftar transaksi</h2>
                <div class="table_wrap">
                  <table class="table_type_1 shopping_cart_table">
                    <thead>
                      <tr>
                        <th width="7%" align="center">No </th>
                        <th width="20%">Tanggal </th>
                        <th width="10%">Invoice </th>
                        <th width="">Produk </th>
                        <th width="20%">Total Belanja </th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i = 1 @endphp
                        @foreach($pemesanan as $p)
                          @if($p->konfirmasi == 1)
                          <tr>
                            <td align="center">{{$i}}</td>
                            <td>
                              {{tgl_id($p->created_at)}}
                            </td>
                            <td>
                              {{$p->invoice}}
                            </td>
                            <td>
                              @php echo ProdukBelanja($p->id) @endphp
                            </td>
                            <td style="text-align: right;">
                              {{angkaRupiah($p->total+$p->ongkir)}}
                            </td>
                          </tr>
                            @php $i = $i+1 @endphp
                          @endif 
                        @endforeach

                        @if($i == 0)
                        <tr>
                          <td colspan="4" align="center">Data Kosong</td>
                        </tr>
                        @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          @endif  
        </main>
      </div>
    </div>
  </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>