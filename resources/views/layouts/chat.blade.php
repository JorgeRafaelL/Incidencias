<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Discusión</h3>
	</div>
	<div class="panel-body">

		@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>
					{{ $error }}
					<button type="button" class="close" data-dismiss="alert">
						&times;
					</button>
				</li>
				@endforeach
			</ul>
		</div>
		@endif

		@if (session('info2'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert">
				&times;
			</button>
			{{ session('info2') }}
		</div>
		@endif
		
		<ul class="media-list">

			 @foreach ($messages as $message)
			<li class="media">
				<div class="media-body">
					<div class="media">
						<a href="#" class="pull-left">
							<img src="{{ $message->user->avatar_path }}" alt="" class="media-object img-circle" width="48">
						</a>
						<div class="media-body">
							{{ $message->message }}
							<br>
							<small class="text-muted">{{ $message->user->name }} | {{ $message->created_at }}</small>
							<hr>
						</div>
					</div>
				</div>
			</li>
			@endforeach

		</ul>

	</div>
	<div class="panel-footer">
		<form action="/mensajes" method="POST">
			{{ csrf_field() }}
			<input type="hidden" name="incident_id" value="{{ $incident->id }}">
			<div class="input-group">
				<input type="text" class="form-control" name="message" value="{{ old('message') }}">
				<span class="input-group-btn">
					<button class="btn btn-primary" type="submit">Enviar</button>
				</span>
			</div>
		</form>
		
	</div>
</div>