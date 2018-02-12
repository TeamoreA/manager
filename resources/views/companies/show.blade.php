@extends('layouts.app');

@section('content');

		<div class="jumbotron">
			<h1>{{$company->name}}</h1>
			<p class="lead">{{$company->description}}</p>
		</div>

		<div class="row">
			<div class="col-sm-9 col-md-9 col-lg-9">
				<div class="row">
					@foreach($company->projects as $project)
						<div class="col-md-4 col-lg-4">
							<h2>{{$project->name}}</h2>
							<p>{{$project->description}}</p>
							<p><a class="btn btn-primary" href="{{ route('projects.show', [$project->id]) }}" role="button">View Project</a></p>
						</div>
					@endforeach
				</div>
			</div>
			<div class="col-sm-3 col-md-3 col-lg-3 blog-sidebar">
				<div class="sidebar-module">
					<h4>Actions</h4>
					<ol class="list-unstyled">
						<li><a href="{{ route('companies.edit', [$company->id]) }}">Edit Company</a></li>
						<li><a href="{{ route('companies.index') }}">List of Companies</a></li>
						<li><a href="{{ route('projects.create', $company->id) }}">Add project</a></li>

						<li>
							<a href="#"
								onclick="
									var result = confirm('Are you sure to delete?.This action cant be revorked later!');
									if (result) {
										event.preventDefault();
										document.getElementById('delete-form').submit();
									}
								" >
								Delete
							</a>
							<form action="{{ route('companies.destroy', $company->id) }}" id="delete-form" method="POST" style="display: none;">
								{{csrf_field()}}
								{{ method_field('DELETE') }}
							</form>

						</li>
						{{-- <li><a href="#">Add Member</a></li> --}}
					</ol>
				</div>
			</div>	
		</div>
		
@stop