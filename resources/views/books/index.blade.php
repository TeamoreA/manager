
@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-md-8 col-lg-8">
			<div class="panel panel-primary">
				<div class="panel-heading">Books <a href="{{ route('books.create') }}" class="btn btn-default btn-sm pull-right">Add New Book</a> </div>
				<div class="panel-body">
					<ul class="list-group">
					@foreach($books as $book)
					
						<li class="list-group-item">
							<a href="{{ route('books.show', [$book->id]) }}">{{$book->name}}</a>
						</li>
					
					@endforeach
					</ul>
				</div>
			</div>
		</div>
	</div>

@stop
