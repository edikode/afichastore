@extends('tema.layouts.template')

@section('judul', 'Checkout Tambah Alamat')

@section('main')

<div class="secondary_page_wrapper">
  <div class="container">
    <ul class="breadcrumbs">
      <li><a href="index.html">Home</a></li>
      <li>Checkout Tambah Alamat</li>

    </ul>
    <!-- KONTEN -->
    <div class="section_offset">
      <div class="row">
        <!-- MAIN -->
        <main class="col-md-9 col-sm-8">
          <h1>Selesai Belanja</h1>
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
              <div class="row">
                
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
        </main>

        @include('tema/layouts/sidebar')
      </div>
    </div>
  </div>
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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