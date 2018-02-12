
@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-md-8 col-lg-8">
			<div class="panel panel-primary">
				<div class="panel-heading">Companies <a href="{{ route('companies.create') }}" class="btn btn-default btn-sm pull-right">Add New Company</a> </div>
				<div class="panel-body">
					<ul class="list-group">
					@foreach($companies as $company)
					
						<li class="list-group-item">
							<a href="{{ route('companies.show', [$company->id]) }}">{{$company->name}}</a>
						</li>
					
					@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>

@stop
