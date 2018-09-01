@if(count($errors) > 0)
	<div class='successHandler alert alert-danger display'>
		@foreach($errors->all() as $error)
		<i class='glyphicon glyphicon-remove'></i> {{ $error }}
		@endforeach
	</div>
@elseif(Session::has('flash_message'))
	<section class="infoblock type_3">
		<div class="clearfix">
			<!-- <i class="icon-thumbs-up-1"></i> -->
			<h4 class="caption">{{ Session::get('flash_message')}}</h4>
		</div>
	</section>
@endif