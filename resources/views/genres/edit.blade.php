@extends('layouts.app');

@section('content');

		<div class="row">
			<div class="col-sm-9 col-md-9 col-lg-9">
				<div class="row">
						<div class="col-md-12 col-lg-12 col-sm-12">
							
							<form action="{{ route('genres.update', [$genre->id]) }}" method="POST">
								{{csrf_field()}}
								{{ method_field('PUT') }}

								<div class="form-group">
									<label for="name">Name <span class="required danger">*</span></label>
									<input type="text" id="name" required="required" name="name" spellcheck="false" class="form-control" value="{{$genre->name}}">
								</div>

								<div class="form-group">
									<label for="description">Description <span class="required">*</span></label>
									<textarea id="description" required="required" name="description" spellcheck="false" rows="6" style="resize: vertical;" class="form-control autosize-target text-left">{{$genre->description}}
									</textarea>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>

						</div>
				</div>
			</div>
			<div class="col-sm-3 col-md-3 col-lg-3 blog-sidebar">
				<div class="sidebar-module">
					<h4>Actions</h4>
					<ol class="list-unstyled">
						<li><a href="{{ route('genres.show', [$genre->id]) }}">Show Genre</a></li>
						<li><a href="{{ route('genres.index', [$genre->id]) }}">All Genres</a></li>
					</ol>
				</div>
			</div>	
		</div>
		
@stop