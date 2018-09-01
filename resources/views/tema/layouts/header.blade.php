<header id="header" class="type_6">
  <div class="top_part">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <!--p>Email. info@shopyan.com</p-->
        </div>            
      </div>
    </div>
  </div>        
  <hr>
  <div class="bottom_part" style="
    background-image: url('{{asset('tema/gambar/banner1.jpg')}}');
    background-repeat: repeat-x;
    background-position: center; height: 149px" >
    <div class="container">
      <div class="row">
        <div class="main_header_row">
          
          
          <div class="col-sm-3">
            <!-- <a href="{{url('/')}}" class="logo" style="">
              <img src="{{asset('tema/images/logo1copy.png')}}" height="120px" alt="{{$profil->nama}}">
            </a> -->
          </div>
          <div class="col-sm-3">
            <!--  <form class="clearfix search">
              <input type="text" name="" tabindex="1" placeholder="Cari Barang Disini..." class="alignleft">
              <button class="button_blue def_icon_btn alignleft"></button>
            </form>  -->  
          </div>
          <!-- <div class="col-sm-6">
            <div class="call_us" style="float: right;">
              <b>{{$profil->nama}}</b><br>
              <b>{{$profil->alamat}}</b><br>
              <span>Telepon :</span> <b>{{$profil->telepon}}</b><br>
              <span>Email :</span> <b>{{$profil->email}}</b>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>

  <div id="main_navigation_wrap">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="sticky_inner type_2">                 
            <div class="nav_item">
              <nav class="main_navigation">
                <ul>
                  <li class="{{ set_current('/') }}"><a href="{{url('/')}}">Home</a></li>
                  <li class="{{ set_current('tentang-kami') }}"><a href="{{url('tentang-kami')}}">Tentang Kami</a></li>
                  <li class="has_submenu {{ set_current(['produk', Request::is('kategori/*')]) }}"><a href="{{url('produk')}}">Produk</a>             
                    <ul class="theme_menu submenu"> 
                      @foreach($kategori as $k)                          
                      <li>
                        <a href="{{url('kategori/'.$k->link)}}">{{$k->nama}}</a>
                      </li>
                      @endforeach
                    </ul>
                  </li>
                  <li class="{{ set_current('pencarian') }}"><a href="{{url('pencarian')}}">Pencarian</a></li>
                  @if (Auth::guest())
                    <li class="{{ set_current('daftar') }}"><a href="{{url('daftar')}}">Daftar</a></li>
                    <li class="{{ set_current('login') }}"><a href="{{url('login')}}">Login</a></li>
                  @else
                    <li class="{{ set_current('checkout') }}"><a href="{{url('checkout')}}">Selesai Belanja</a></li>
                    <li class="{{ set_current('status') }}"><a href="{{url('status')}}">Pembayaran</a></li>
                    <li class="{{ set_current('akun') }}"><a href="{{url('akun')}}">Informasi Akun</a></li>
                  @endif
                </ul>

              </nav>

            </div>

            @if (Auth::guest())

            @else
              <div class="nav_item size_3">
                <button id="open_shopping_cart" class="open_button" data-amount="{{count(Cart::content())}}">
                  <b class="title">Beli</b>
                  <b class="total_price">Rp.{{Cart::subtotal()}},-</b>
                </button>
                <div class="shopping_cart dropdown">
                  @if(Cart::count() != 0)
                    @foreach(Cart::content() as $row)
                      <div class="animated_item">
                        <div class="clearfix sc_product">
                          <a href="#" class="product_thumb"><img src="{{asset('upload/produk/kecil/'.$row->gambar)}}" height="50px" alt=""></a>
                          <a href="#" class="product_name">{{$row->name}}</a>
                          <p>{{$row->qty}} x Rp.{{angkaRupiah($row->price)}},-</p>
                          <!-- <button class="close"></button> -->
                          <a href="{{url('hapusitem/'.$row->rowId)}}" class="close"></a>
                        </div>                          
                      </div>
                    @endforeach
                  @endif
                  <div class="animated_item">
                    <a href="{{url('keranjang-belanja')}}" class="button_grey">Lihat</a>
                    <a href="{{url('checkout')}}" class="button_blue">Selesai Belanja</a>
                  </div>
                </div>  
              </div>
            @endif

          </div>
        </div>
      </div>
    </div>
  </div>
</header>