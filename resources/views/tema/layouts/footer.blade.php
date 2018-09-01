<footer id="footer">
  <div class="container">         
    <div class="infoblocks_container">
      <ul class="infoblocks_wrap">
        <li>
          <a class="infoblock type_1">
            <i class="icon-paper-plane"></i>
            <span class="caption"><b>Pengiriman Cepat &amp; Jelas </b></span>
          </a>
        </li>
        <li>
          <a class="infoblock type_1">
            <i class="icon-lock"></i>
            <span class="caption"><b>Pembayaran Mudah &amp; Aman</b></span>
          </a>
        </li>
        <li>
          <a class="infoblock type_1">
            <i class="icon-money"></i>
            <span class="caption"><b>Garansi 100% Uang Kembali</b></span>
          </a>
        </li>
      </ul>
    </div>      
  </div>        

  <div class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-6">
          <section class="widget">                  
            <img width="200px"  src="{{asset('upload/profil/sedang/'.$profil->gambar)}}" alt="{{$profil->nama}}" class="footer_logo" style="border-radius: 30%;">
            <p class="about_us">{{$profil->deskripsi}}</p>
            <!-- <ul class="social_btns">
              <li>
                <a href="#" class="icon_btn middle_btn social_facebook tooltip_container"><i class="icon-facebook-1"></i><span class="tooltip top">Facebook</span></a>
              </li>
              <li>
                <a href="#" class="icon_btn middle_btn  social_twitter tooltip_container"><i class="icon-twitter"></i><span class="tooltip top">Twitter</span></a>
              </li>
              <li>
                <a href="#" class="icon_btn middle_btn social_googleplus tooltip_container"><i class="icon-gplus-2"></i><span class="tooltip top">GooglePlus</span></a>
              </li>
              <li>
                <a href="#" class="icon_btn middle_btn social_instagram tooltip_container"><i class="icon-instagram-4"></i><span class="tooltip top">Instagram</span></a>
              </li>
            </ul>    -->          
          </section>              
        </div>
        <div class="col-md-4 col-sm-6">
          <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            <div class="fb-page" data-href="https://web.facebook.com/EqualiTi-1083308711680012/" data-width="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://web.facebook.com/EqualiTi-1083308711680012/" class="fb-xfbml-parse-ignore"><a href="https://web.facebook.com/EqualiTi-1083308711680012/">AfichaStore</a></blockquote></div>
          <!-- <section class="widget">
            <h4>Testimoni</h4>
            <div class="owl_carousel widgets_carousel">
              <blockquote>
                <div class="author_info"><b>Edo Nugroho</b></div>
                <p>Toko Online terpercaya, barang bagus dan berkualitas.</p>
              </blockquote>               
              <blockquote>
                <div class="author_info"><b>Yusma Anwar</b></div>
                <p>Rekomendasi buat teman-teman yang ingin membeli baju atau sepatu</p>
              </blockquote>
              <blockquote>
                <div class="author_info"><b>Boim</b></div>
                <p>Mantap Bang... pesen aja disini pasti barang nyampek dan g kecewa</p>
              </blockquote>                                       
            </div>
          </section>   -->            
        </div>            

        <div class="col-md-3 col-sm-6">
          <section class="widget">
            <h4>Kontak Kami</h4>
            <ul class="c_info_list">
              <li class="c_info_location">{{$profil->alamat}}</li>
              <li class="c_info_phone">{{$profil->telepon}}</li>
              <li class="c_info_mail"><a href="mailto:#">{{$profil->email}}</a></li>
            </ul>
          </section>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="footer_section_3 align_center">
    <div class="container">
      <p class="copyright">&copy; {{date('Y')}} <a href="{{url('/')}}">{{$profil->nama}}</a>. All Rights Reserved. Website by <a>Wildan Gusti Mahardika</a></p>
    </div>
  </div>
</footer>