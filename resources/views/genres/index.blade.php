
@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-md-8 col-lg-8">
			<div class="panel panel-primary">
				<div class="panel-heading">Genres <a href="{{ route('genres.create') }}" class="btn btn-default btn-sm pull-right">Add New Genre</a> </div>
				<div class="panel-body">
					<ul class="list-group">
					@foreach($genres as $genre)
					
						<li class="list-group-item">
							<a href="{{ route('genres.show', [$genre->id]) }}">{{$genre->name}}</a>
						</li>
					
					@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>

@stop
