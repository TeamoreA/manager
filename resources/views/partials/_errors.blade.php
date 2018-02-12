@if (isset($errors)&&count($errors) > 0)

	<div class="alert alert-dismissable alert-danger ">
		<button class="close" type="button" data-dismiss="alert" aria-lable="close">
			<span aria-hidden="true">&times;</span>
		</button>
		@foreach($errors->all() as $error)
			<li><strong>{!! $error !!}</strong></li>
		@endforeach
	</div>

@endif