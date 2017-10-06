<div class="panel panel-primary">
	<div class="panel-heading"><span class="icon-menu"> Menú</span></div>

	<div class="panel-body">
		@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
		@endif

		<ul class="nav nav-pills nav-stacked">
			@if (auth()->check())
			<li @if(request()->is('home')) class="active" @endif>
				<a href="/home"><span class="icon-dashboard"> Dashboard</span></a>
			</li>
			
			@if (! auth()->user()->is_client)
			<li @if(request()->is('ver')) class="active" @endif>
				<a href="/ver"><span class="icon-healing"> Ver incidencias</span></a>
			</li>
			@endif

			<li @if(request()->is('reportar')) class="active" @endif>
				<a href="/reportar" > <span class="icon-report"> Reportar incidencia</span></a>
			</li>

			@if (auth()->user()->is_admin)
			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				<span class="icon-assignment"> Administración</span> <span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
					<li><a href="/usuarios"><span class="icon-person"> Usuarios</span></a></li>
					<li><a href="/proyectos"><span class="icon-work"> Proyectos</span></a></li>
					<li><a href="/config"><span class="icon-settings"> Configuración</span></a></li>
				</ul>
			</li>
			@endif

			@else
			<li>
				<a href="/" ><span class="icon-public"> Bienvenido</span></a>
			</li>

			<li>
				<a href="/instrucciones" ><span class="icon-info"> Instrucciones</span></a>
			</li>

			<li>
				<a href="/acerca-de" ><span class="icon-stars"> Créditos</span></a>
			</li>

			@endif

		</ul>
		
	</div>
</div>

