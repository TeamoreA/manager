@extends('layouts.app')

@section('content')

		<div class="row">
			<div class="col-sm-9 col-md-9 col-lg-9">
				<div class="row">
						<div class="col-md-12 col-lg-12 col-sm-12">
							<h2>Create New Genre</h2>
							<hr>
							
							<form action="{{ route('genres.store')}}" method="POST">
								{{csrf_field()}}

								<div class="form-group">
									<label for="name">Name <span class="required danger">*</span></label>
									<input type="text" id="name" required="required" name="name" spellcheck="false" class="form-control" placeholder="Enter Name">
								</div>

								<div class="form-group">
									<label for="description">Description <span class="required">*</span></label>
									<textarea id="description" required="required" name="description" spellcheck="false" rows="6" style="resize: vertical;" class="form-control autosize-target text-left" placeholder="Enter Company Description">
									</textarea>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>

						</div>
				</div>
			</div>
				
		</div>
		
@stop