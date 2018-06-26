@extends('layouts.app');

@section('content');

		<div class="jumbotron">
			<h1>{{$genre->name}}</h1>
			<p class="lead">{{$genre->description}}</p>
		</div>

		<div class="row">
			<div class="col-sm-9 col-md-9 col-lg-9">
				<div class="row">
					@foreach($genre->books as $book)
						<div class="col-md-4 col-lg-4">
							<h2>{{$book->name}}</h2>
							<p>{{$book->description}}</p>
							<p><a class="btn btn-primary" href="{{ route('books.show', [$book->id]) }}" role="button">View Book</a></p>
						</div>
					@endforeach
				</div>
			</div>
			<div class="col-sm-3 col-md-3 col-lg-3 blog-sidebar">
				<div class="sidebar-module">
					<h4>Actions</h4>
					<ol class="list-unstyled">
						<li><a href="{{ route('genres.edit', [$genre->id]) }}">Edit genre</a></li>
						<li><a href="{{ route('genres.index') }}">List of Books</a></li>
						<li><a href="{{ route('books.create', $genre->id) }}">Add book</a></li>

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
							<form action="{{ route('genres.destroy', $genre->id) }}" id="delete-form" method="POST" style="display: none;">
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