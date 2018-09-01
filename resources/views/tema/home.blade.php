@extends('tema.layouts.template')

@section('judul', 'Home')

@section('main')

<div class="page_wrapper">
  <div class="container">
    <!-- SLIDER -->
    <div class="section_offset">
      <div class="row">           
        <div class="col-md-9 col-sm-8">
          <div id="flexslider-home" class="flex-container">
            <div class="flexslider">
              <ul class="slides">
                <li>
                  <img src="tema/gambar/slide3.jpg" alt=""> 
                </li>
                <li>
                  <img src="tema/gambar/slide2.jpg" alt="">
                </li>
              </ul>
            </div>
          </div>                
        </div>              
        
        <div class="col-md-3 col-sm-4">             
          <a class="banner" href="{{url('produk')}}"><img src="tema/gambar/ongkir.jpg" alt=""></a>        
          <!-- <a class="banner" href="{{url('produk')}}"><img src="tema/images/banner_img_11.png" alt=""></a>                 -->
        </div>              
      </div>
    </div>
    
    <!-- KONTEN -->
    <div class="section_offset">
      <div class="row">
        <!-- MAIN -->
        <main class="col-md-9 col-sm-8">
          <section class="section_offset">
            <h3 class="offset_title">Produk Terbaru</h3>
            <div class="owl_carousel carousel_in_tabs">
              @if($produk_terbaru)
                @foreach($produk_terbaru as $p)
                  <div class="product_item type_2">
                    <div class="image_wrap">
                      <img src="{{asset('upload/produk/sedang/'.$p->gambar)}}" alt="{{$p->judul}}">
                      <div class="actions_wrap">
                        <div class="centered_buttons">
                          <a href="{{url('produk-detail/'.$p->link)}}" class="button_dark_grey middle_btn quick_view">Produk Detail</a>
                        </div>
                      </div>
                    </div>
                    <div class="label_hot">Hot</div>
                    <div class="description">
                      <center><a href="{{url('produk-detail/'.$p->link)}}" class="judulproduk align_center" title="{{$p->judul}}">{{$p->nama}}</a></center>
                      <div class="clearfix product_info">
                      <p class="product_price align_center"><b>Rp. {{angkaRupiah($p->harga)}}</b></p>
                      </div>
                    </div>
                    <center>
                      <a href="{{url('pesan/'.$p->link)}}">
                        <button class="button_blue middle_btn">Beli Produk</button>
                      </a>  
                    </center>
                  </div>
                @endforeach
              @endif
            </div>  
          </section>

          <!-- <div class="section_offset">    
            <h3 class="offset_title">Produk Kami</h3>              
            <header class="top_box on_the_sides">
              <div class="clearfix v_centered">               
                <p>Beberapa Produk yang kami jual</p>
              </div>
            </header>
            <div class="table_layout" id="products_container">
              @php $i = 1 @endphp
              @foreach($semuaproduk as $p)

                @if($i > 3)
                  <div class="table_row">
                @endif

                  <div class="table_cell">
                    <div class="product_item">
                      <div class="image_wrap">
                        <img src="upload/produk/sedang/{{$p->gambar}}" alt="{{$p->judul}}">
                        <div class="actions_wrap">
                          <div class="centered_buttons">
                            <a href="{{url('produk-detail/'.$p->link)}}" class="button_dark_grey middle_btn quick_view">Produk Detail</a>
                          </div>
                        </div>
                      </div>
                      <div class="description">
                        <center>
                          <a href="{{url('produk-detail/'.$p->link)}}" class="judulproduk align_center" title="{{$p->judul}}">{{$p->nama}}</a>
                        </center>
                        <div class="clearfix product_info">
                          <p class="product_price align_center"><b>Rp. {{angkaRupiah($p->harga)}}</b></p>
                        </div>
                      </div>
                      <center>
                        <a href="{{url('pesan/'.$p->link)}}">
                          <button class="button_blue middle_btn">Beli Produk</button>
                        </a>  
                      </center>                        
                    </div>
                  </div>

                @if($i > 3)
                  </div>
                  @php $i = 0 @endphp
                @endif

                @php $i = $i+1 @endphp

              @endforeach

            </div>
            <footer class="bottom_box on_the_sides">
              <div class="left_side">
                <p>Dapatkan Discount Menarik Dari Kami.</p>
              </div>                    
            </footer> 
          </div> -->
        </main>
        
        @include('tema/layouts/sidebar')           
      </div>
    </div>          
  </div>
</div>

@endsection