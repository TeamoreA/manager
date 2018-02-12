
@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-md-8 col-lg-8">
			<div class="panel panel-primary">
				<div class="panel-heading">Projects <a href="{{ route('projects.create') }}" class="btn btn-default btn-sm pull-right">Add New Project</a> </div>
				<div class="panel-body">
					<ul class="list-group">
					@foreach($projects as $project)
					
						<li class="list-group-item">
							<a href="{{ route('projects.show', [$project->id]) }}">{{$project->name}}</a>
						</li>
					
					@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>

@stop
