<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
	<!-- Sidebar user panel -->
		<!-- <div class="user-panel">
			<div class="pull-left image">
				<img src="img/user2-160x160.jpg" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>
					Alexander Pierce
				</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div> -->
		
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MENU AFICHASTORE</li>
			
			<li class="{{ set_active('admin/dashboard') }}">
				<a href="{{url('admin/dashboard')}}">
					<i class="fa fa-dashboard"></i><span>Dashboard</span>
				</a>
			</li>
			<li class="treeview {{ set_active(['admin/produk', Request::is('admin/produk/*'), 'admin/kategori', Request::is('admin/kategori/*')]) }}">
	          <a href="#">
	            <i class="fa fa-files-o"></i>
	            <span>Produk</span>
	          </a>
	          <ul class="treeview-menu">
	            <li class="{{ set_active(['admin/produk', Request::is('admin/produk/*')]) }}"><a href="{{url('admin/produk')}}"><i class="fa fa-circle-o"></i> Produk</a></li>
	            <li class="{{ set_active(['admin/kategori', Request::is('admin/kategori/*')]) }}"><a href="{{url('admin/kategori')}}"><i class="fa fa-circle-o"></i> Kategori</a></li>
	          </ul>
	        </li>
			<li class="{{ set_active('admin/pemesanan') }}">
				<a href="{{url('admin/pemesanan')}}">
					<i class="fa fa-files-o"></i><span>Pemesanan</span>
				</a>
			</li>
			<li class="{{ set_active('admin/laporan') }}">
				<a href="{{url('admin/laporan')}}">
					<i class="fa fa-files-o"></i><span>Laporan Pemesanan</span>
				</a>
			</li>
			<li class="header">Menu Umum</li>
			<li class="{{ set_active(['admin/profil-store', Request::is('admin/profil-store/*')]) }}">
				<a href="{{url('admin/profil-store')}}">
					<i class="fa fa-user"></i> Profil Store
				</a>
			</li>
			<li class="treeview {{ set_active(['admin/pelanggan', Request::is('admin/pelanggan/*'), 'admin/pengelola', Request::is('admin/pengelola/*')]) }}">
	          <a href="#">
	            <i class="fa fa-user"></i>
	            <span>Pengguna</span>
	          </a>
	          <ul class="treeview-menu">
	            <li class="{{ set_active(['admin/pengelola', Request::is('admin/pengelola/*')]) }}"><a href="{{url('admin/pengelola')}}"><i class="fa fa-circle-o"></i> Pengelola</a></li>
	            <li class="{{ set_active(['admin/pelanggan', Request::is('admin/pelanggan/*')]) }}"><a href="{{url('admin/pelanggan')}}"><i class="fa fa-circle-o"></i> Pelanggan</a></li>
	          </ul>
	        </li>
		</ul>
	</section>
</aside>