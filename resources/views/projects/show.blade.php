@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-sm-9 col-md-9 col-lg-9">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<div class="well well-lg well-primary">
					<h1>{{$project->name}}</h1>
					<p class="lead">{{$project->description}}</p>
				</div>
			</div>
		</div>

<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<form action="{{ route('comments.store')}}" method="POST">
			{{csrf_field()}}

			<input type="hidden" name="commentable_type" value="App\Project">
			<input type="hidden" name="commentable_id" value="{{$project->id}}">

			<div class="form-group">
				<label for="comment">Comment <span class="required">*</span></label>
				<textarea id="comment" required="required" name="body" spellcheck="false" rows="3" style="resize: vertical;" class="form-control autosize-target text-left" placeholder="Comment Here">
				</textarea>
			</div>

			<div class="form-group">
				<label for="url">Url <span class="required">*</span></label>
				<textarea id="url" required="required" name="url" spellcheck="false" rows="2" style="resize: vertical;" class="form-control autosize-target text-left" placeholder="Enter Url">
				</textarea>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
</div>{{-- end of .row --}}

@include('partials._comments')
</div> {{-- .col-md-9 --}}
	<div class="col-sm-3 col-md-3 col-lg-3">
		<div class="sidebar-module">
			<h4>Actions</h4>
			<ol class="list-unstyled">
				<li><a href="{{ route('projects.edit', [$project->id]) }}"><i class="fa fa-edit"></i> Edit Project</a></li>
				<li><a href="{{ route('projects.index') }}"><i class="fa fa-list-ol"></i> List of Projects</a></li>
				<li><a href="{{ route('projects.create') }}"><i class="fa fa-plus-square"></i> Add project</a></li>
				
				@if($project->user_id == Auth::user()->id)
				<li>
					<a href="#"
						onclick="
							var result = confirm('Are you sure to delete?.This action cant be revorked later!');
							if (result) {
								event.preventDefault();
								document.getElementById('delete-form').submit();
							}
						" ><i class="fa fa-times"></i>
						Delete Project
					</a>
					<form action="{{ route('projects.destroy', $project->id) }}" id="delete-form" method="POST" style="display: none;">
						{{csrf_field()}}
						{{ method_field('DELETE') }}
					</form>

				</li>
				@endif
			</ol>
			
			<h4>Add members</h4>

			<form action="{{ route('projects.adduser') }}" id="add-user" method="POST" >
				{{csrf_field()}}
				<div class="input-group">
					<input type="hidden" name="project_id" value="{{$project->id}}">
					<input type="text" class="form-control" name="email" placeholder="Email...">
					<span class="input-group-btn">
					  <button class="btn btn-default" type="submit"><i class="fas fa-list-ol"></i>Add</button>
					</span>
				</div>
			</form>

			<h4>Team members</h4>
			<ol class="list-unstyled">
				@foreach($project->users as $user)
					<li><a href="#">{{$user->name}}</a></li>
				@endforeach
			</ol>
		</div>
	</div>

</div>
		
		
@stop