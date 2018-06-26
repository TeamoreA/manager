@extends('layouts.app')

@section('content')

		<div class="row">
			<div class="col-sm-9 col-md-9 col-lg-9">
				<div class="row">
						<div class="col-md-12 col-lg-12 col-sm-12">
							<h2>Create New Project</h2>
							<hr>
							
							<form action="{{ route('book.store')}}" method="POST">
								{{csrf_field()}}

								<div class="form-group">
									<label for="name">Name <span class="required danger">*</span></label>
									<input type="text" id="name" required="required" name="name" spellcheck="false" class="form-control" placeholder="Enter Project Name">
								</div>
								@if($genres == null)
								<input class="form-control" type="hidden" name="company_id" value="{{$genre_id}}">
								@endif
								@if($genres != null)
								<div class="form-group">
									<label for="genre_id">Select genre</label>
									<select name="genre_id" id="#" class="form-control">
										@foreach($genres as $genre)
											<option value="{{$genre->id}}">{{$genre->name}}</option>
										@endforeach
									</select>
								</div>
								@endif

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