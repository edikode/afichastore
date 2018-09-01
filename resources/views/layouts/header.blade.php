<header class="main-header">
	<!-- Logo -->
	<a href="{{url('')}}" class="logo">
	<!-- mini logo for sidebar mini 50x50 pixels -->
	<span class="logo-mini"><b>A</b>STR</span>
	<!-- logo for regular state and mobile devices -->
	<span class="logo-lg"><b>Aficha</b>STORE</span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><span class="sr-only">Toggle navigation</span></a>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- Messages: style can be found in dropdown.less-->
				<li class="dropdown messages-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-fw fa-info-circle"></i>
					<span class="label label-danger">
						<?php $stok = InfoStok();
							  echo count($stok);
						 ?>
					</span>
					</a>
					<ul class="dropdown-menu">
						<li class="header">Info Stok Produk Kurang Dari 5</li>
						<li>
							<ul class="menu">
								<?php foreach ($stok as $stok): 
								?>
									<li>
										<a href="{{url('admin/produk/stokdarurat')}}">
										<h4>{{$stok->nama}} <small><i class="fa fa-fw fa-database"></i> </small></h4>
										<p>
											Jumlah Stok : {{$stok->stok}}
										</p>
										</a>
									</li>
								<?php endforeach ?>
							</ul>
						</li>
						<li class="footer">
							<a href="{{url('admin/produk/stokdarurat')}}">Lihat Semua Stok Kurang dari 5</a>
						</li>
					</ul>
				</li>
				<li class="dropdown messages-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-envelope-o"></i>
					<span class="label label-success">
						<?php 
						$pemesanan = InfoPemesanan();
						$jmlpemesanan = 0;
						foreach ($pemesanan as $s) {
							$kadaluarsa = waktu($s->created_at); 

							if($s->konfirmasi == 0){
								if($kadaluarsa < -1){
									
								} else {
									$jmlpemesanan = $jmlpemesanan+1;
								}
							}				
							
						}
						
						echo $jmlpemesanan;
						
						?>
					</span>
					</a>
					<ul class="dropdown-menu">
						<li class="header"><?php if($jmlpemesanan == 0){ echo "Tidak Ada "; } else { echo "Ada ".$jmlpemesanan; } ?> pembelian baru</li>
						<li>
							<ul class="menu">
								<?php 
								if($jmlpemesanan != 0){
								foreach ($pemesanan as $pesan){
										$pelanggan = Pelanggan($pesan->pelanggan_id)
								?>
									<li>
										<a href="{{url('admin/pemesanan/'.$pesan->id)}}">
										<!-- <div class="pull-left">
											<img src="{{asset('admin/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
										</div> -->
										<h4>{{$pelanggan->nama}} <small><i class="fa fa-clock-o"></i> 5 mins</small></h4>
										<p>
											Melakukan pembelian dengan total Rp. {{angkaRupiah($pesan->total)}},-
										</p>
										</a>
									</li>
								<?php  
								}}
								?>
							</ul>
						</li>
						<li class="footer">
							<a href="{{url('admin/pemesanan')}}">Lihat Semua Pembelian</a>
						</li>
					</ul>
				</li>
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="{{asset('upload/pengelola/sedang/'.Auth::user()->gambar)}}" class="user-image" alt="User Image">
					<span class="hidden-xs">{{Auth::user()->nama}}</span>
					</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
							<img src="{{asset('upload/pengelola/sedang/'.Auth::user()->gambar)}}" class="img-circle" alt="User Image">
							<p>
								 {{Auth::user()->nama}} - Admin Store
							</p>
						</li>
						<!-- Menu Body -->
						<!-- <li class="user-body">
							<div class="row">
								<div class="col-xs-4 text-center">
									<a href="#">Followers</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#">Sales</a>
								</div>
								<div class="col-xs-4 text-center">
									<a href="#">Friends</a>
								</div>
							</div>
						</li> -->
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="{{url('admin/pengelola/'.Auth::user()->id.'/edit')}}" class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
								<a href="{{ url('/logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
	                                Logout
	                            </a>

	                            <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
	                                {{ csrf_field() }}
	                            </form>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>