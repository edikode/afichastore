@extends('tema.layouts.template')

@section('judul', 'Checkout')

@section('main')

<div class="secondary_page_wrapper">
  <div class="container">
    <ul class="breadcrumbs">
      <li><a href="index.html">Home</a></li>
      <li>Checkout</li>

    </ul>
    <!-- KONTEN -->
    <div class="section_offset">
      <div class="row">
        <!-- MAIN -->
          @if(Cart::count() == 0)
            <main class="col-md-9 col-sm-8">
              <section class="section_offset">
                <div class="theme_box clearfix">
                  <br>
                  <h1>Keranjang Belanja masih kosong</h1>
                </div>
              </section>
            </main>
          @else
            <main class="col-md-9 col-sm-8">
              <h1>Selesai Belanja</h1>
              @if(count($alamat) < 1)
              <form name="form" action="{{url('checkout')}}" method="post" enctype="multipart/form-data">  
                {{ csrf_field() }}
                <div class="theme_box clearfix">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                          <label>Simpan Alamat Sebagai</label>
                          <input type="text" class="form-control" id="sebagai" name="sebagai" placeholder="Simpan Sebagai" value="@if(count($errors) > 0){{old('sebagai')}}@endif" required="">
                          @if ($errors->has('sebagai'))
                              <span class="help-block">
                                  <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('sebagai') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-4">
                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                          <label>Nama Penerima</label>
                          <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Penerima" value="@if(count($errors) > 0){{old('nama')}}@endif" required="">
                          @if ($errors->has('nama'))
                              <span class="help-block">
                                  <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('nama') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group{{ $errors->has('telepon') ? ' has-error' : '' }}">
                          <label>Telepon</label>
                          <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Telepon" value="@if(count($errors) > 0){{old('telepon')}}@endif" required="">
                          @if ($errors->has('telepon'))
                              <span class="help-block">
                                  <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('telepon') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="col-md-4">
                        
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <label>Provinsi</label>
                      <?php 

                      $curl = curl_init();

                      curl_setopt_array($curl, array(
                        CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_HTTPHEADER => array(
                          "key: 563b6d1fe883cc55cb374d08692ab9e0"
                        ),
                      ));

                      $response = curl_exec($curl);
                      $err = curl_error($curl);

                      echo "<select name='provinsi' id='provinsi'>";
                      echo "<option>Pilih Provinsi Tujuan</option>";
                      $data = json_decode($response, true);
                      for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
                        // echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."'>".$data['rajaongkir']['results'][$i]['province']."</option>";
                        echo '<option value="'.$data['rajaongkir']['results'][$i]['province_id'].','.$data['rajaongkir']['results'][$i]['province'].'">'.$data['rajaongkir']['results'][$i]['province'].'</option>';
                      }
                      echo "</select><br><br>";
                      ?>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group{{ $errors->has('kabupaten') ? ' has-error' : '' }}">
                        <label>Pilih Kota / Kabupaten</label>
                        <select id="kabupaten" name="kabupaten">
                           <option value="" disabled selected>-- Kota / Kabupaten --</option>
                        </select>

                        @if ($errors->has('kabupaten'))
                            <span class="help-block">
                                <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('kabupaten') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group{{ $errors->has('kode_pos') ? ' has-error' : '' }}">
                        <label>Kode Pos</label>
                        <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="Kode Pos" value="@if(count($errors) > 0){{old('kode_pos')}}@endif" required="">
                        @if ($errors->has('kode_pos'))
                            <span class="help-block">
                                <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('kode_pos') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                          <label>Alamat</label>
                          <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat">@if(count($errors) > 0){{old('alamat')}}@endif</textarea>

                          @if ($errors->has('alamat'))
                              <span class="help-block">
                                  <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('alamat') }}</strong>
                              </span>
                          @endif
                        </div>
                    </div>
                  </div>
                </div>

                <footer class='bottom_box on_the_sides'>
                  <div class='left_side'>
                    <span class='prompt'>Dibutuhkan</span>
                  </div>
                  <div class='right_side'>
                    <button type='submit' name="submit" class='button_blue middle_btn'>Tambah</button>
                  </div>              
                </footer>
              </form>
              @else

              <div class="theme_box clearfix">
                <h4>Nama Produk</h4>
                  <table class="table table-hover table-bordered">
                    @foreach(Cart::content() as $row)
                      <tr>
                        <td>{{$row->name}}</td> 
                        <td width="10%" align="center">{{$row->qty}}x</td>
                        <td width="30%" align="right">Rp.{{angkaRupiah($row->price)}},-</td>
                      </tr>
                    @endforeach  
                      <tr>
                        <td colspan="2">Total</td>
                        <td align="right">Rp.{{angkaRupiah(angkaBiasa(Cart::subtotal()))}},-</td>
                      </tr>
                  </table>
              </div>
              <div class="theme_box clearfix">
                <div class="row">
                  <div class="col-md-4">
                      <h4>Tujuan Pengiriman</h4>
                  </div>
                  <div class="col-sm-8" style="text-align: right">
                    <form style="display: inline;" method="post" action="{{url('pilih-alamat')}}">
                      {{ csrf_field() }}
                      <select name="id_alamat" style="width: 30%; padding: 0px" required="">
                        <option value="">Pilih Alamat Lain</option>
                        @foreach($alamatsemua as $a)
                          <option value="{{$a->id}}">{{$a->sebagai}}</option>
                        @endforeach
                      </select> &nbsp; <button type="submit" name="pilih">Pilih</button>
                    </form> 
                    / 
                    <a href="{{url('tambah-alamat')}}" class="">Tambah Alamat Baru</a>
                  </div>
                </div>

                <p>{{$alamat->nama}} <br> {{$alamat->alamat}}, Kab. {{kabupaten($alamat->provinsi,$alamat->kabupaten)}}, {{$alamat->kode_pos}} <br> {{provinsi($alamat->provinsi)}}</p>

              </div>
              <form action="{{url('selesai-belanja')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="alamat_id" value="{{$alamat->id}}">
                <div class="theme_box clearfix">
                    <div class="row">
                        <div class="col-md-4">
                          <div class="form-group{{ $errors->has('kurir') ? ' has-error' : '' }}">
                            <label for="kurir">Pilih  Kurir</label>
                            <select name="kurir" id="kurir" required="">
                                <option value="" disabled selected>Pilih Kurir</option>
                                <option value="pos">POS</option>
                                <option value="jne">JNE</option>
                            </select>

                            @if ($errors->has('kurir'))
                                <span class="help-block">
                                    <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('kurir') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group{{ $errors->has('layanan') ? ' has-error' : '' }}">
                            <label for="layanan">Pilih Layanan</label>
                            <select name="layanan" id="layanan" required="">
                              <option value="" disabled selected>Pilih Layanan</option>
                            </select>

                            @if ($errors->has('layanan'))
                                <span class="help-block">
                                    <i class="fa fa-times-circle-o"></i> <strong>{{ $errors->first('layanan') }}</strong>
                                </span>
                            @endif
                          </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <label>Ongkos Kirim</label>
                        <input type="number" name="ongkir" value="0" id="ongkir"  readonly="readonly" style="color:black">
                      </div>
                      <div class="col-md-4">
                        <label>Total Biaya</label>
                        <b>  <input type="number" name="total" value="{{angkaBiasa(Cart::subtotal())}}" id="total"  readonly="readonly" style="color:black;"></b>
                      </div>  
                    </div>
                </div>
                <footer class="bottom_box on_the_sides">
                  <div class="right_side">
                    <a class="button_blue middle_btn" href="{{url('keranjang-belanja')}}">Keranjang Belanja</a>
                    <button type="submit" class="button_blue middle_btn" >Selesai Belanja</button> 
                  </div>
                </footer>
              </form>

              @endif
            </main>
          @endif

        @include('tema/layouts/sidebar')
      </div>
    </div>
  </div>
</div>



@endsection

@if(Cart::count() > 0)
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@if(count($alamat) < 1)
<script type="text/javascript">

    $(document).ready(function(){
        $('#provinsi').change(function(){

            //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax 
            var prov = $('#provinsi').val();
            var province = prov.split(',');

            $.ajax({
                url : 'http://localhost/afichastore/public/rajaongkir/cek_kabupaten/' + province[0], 
                method: "GET",
                success: function (obj) {

                    //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
                    $("#kabupaten").html(obj);
                }
            });
        });

        
    });
</script> 
@else
<script type="text/javascript">

    $(document).ready(function() {
            
      $('#kurir').change(function() {
        // var kota = $('#kota').val();
        // var dest = kota.split(',');
        var dest = <?=$alamat->kabupaten;?>;
        var kurir = $('#kurir').val()

        $.ajax({
           url: 'http://localhost/afichastore/public/rajaongkir/getcost/' + dest + '/' + kurir ,
           method: "GET",
           success: function(obj) {
              $('#layanan').html(obj);
           }
        });
      });

      $('#layanan').change(function() {
        var layanan = $('#layanan').val();

        $.ajax({
           url: "http://localhost/afichastore/public/rajaongkir/cost/" + layanan,
           method: "GET",
           success: function(obj) {
              var hasil = obj.split(",");

              $('#ongkir').val(hasil[0]);
              $('#total').val(hasil[1]);
           }
        });
      });
    });
</script>
@endif 
@endif