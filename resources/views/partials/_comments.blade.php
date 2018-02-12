<div class="row">
	<div class="col-sm-9 col-md-9 col-lg-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<span class="glyphicon glyphicon-comment"></span>
					Recent Comments
				</h3>
			</div>
			<div class="panel-body">
				<ul class="media-list">
					@foreach($comments as $comment)
					<li class="media">
						<div class="media-left">
							<img src="http://placehold.it/60x60" class="img-circle">
						</div>
						<div class="media-body">
							<h4 class="media-heading">{{$comment->user->name}}
								<br>
								<small>
									Commented on <a href="#">{{$project->name}}</a>
								</small>
							</h4>
							<p>
								{{$comment->body}}
							</p>
						</div>
					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>	
</div>