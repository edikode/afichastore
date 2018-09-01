@if(count($errors) > 0)
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Gagal!</h4>
		Terjadi Kesalahan Cek Data yang anda masukkan
	</div>
@elseif(Session::has('flash_message'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Berhasil!</h4>
		{{ Session::get('flash_message')}}
	</div>
@endif