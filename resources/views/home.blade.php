@extends('layouts.app')

@section('content')

<div class="panel panel-primary">
    <div class="panel-heading">Dashboard</div>
    @if (session('notification'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">
            &times;
        </button>
        {{ session('notification') }}
    </div>
    @endif

    <div class="panel-body">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        
        @if (auth()->user()->is_support)
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Incidencias asignada a mí</h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <caption>Lista de incidencias a mí</caption>
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Categoría</th>
                            <th>Severidad</th>
                            <th>Estado</th>
                            <th>Fecha de creación</th>
                            <th>Titulo</th>
                        </tr>
                    </thead>
                    <tbody id="dashboard_my_incidents">
                        @foreach ($my_incidents as $incident)
                        <tr>
                            <td>
                                <a href="/ver/{{ $incident->id }}">
                                    {{ $incident->id }}
                                </a>
                                
                            </td>
                            <td>{{ $incident->category->name }}</td>
                            <td>{{ $incident->severity_full }}</td>
                            <td>{{ $incident->state }}</td>
                            <td>{{ $incident->created_at }}</td>
                            <td>{{ $incident->title_short }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Incidencias sin asignar</h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <caption>Lista de incidencias sin asignar</caption>
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Categoría</th>
                            <th>Severidad</th>
                            <th>Estado</th>
                            <th>Fecha de creación</th>
                            <th>Titulo</th>
                            <th>Opción</th>
                        </tr>
                    </thead>
                    <tbody id="dashboard_pending_incidents">
                          @foreach ($pending_incidents as $incident)
                        <tr>
                             <td>
                                <a href="/ver/{{ $incident->id }}">
                                    {{ $incident->id }}
                                </a>
                                
                            </td>
                            <td>{{ $incident->category->name }}</td>
                            <td>{{ $incident->severity_full }}</td>
                            <td>{{ $incident->state }}</td>
                            <td>{{ $incident->created_at }}</td>
                            <td>{{ $incident->title_short }}</td>
                            <td><a href="" class="btn btn-primary btn-sm">Atender</a></td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Incidencias asignadas a otros</h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <caption>Lista de incidencias asignadas a otros</caption>
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Categoría</th>
                            <th>Severidad</th>
                            <th>Estado</th>
                            <th>Fecha de creación</th>
                            <th>Titulo</th>
                            <th>Responsable</th>
                        </tr>
                    </thead>
                    <tbody id="dashboard_by_me">
                         @foreach ($incidents_by_me as $incident)
                        <tr>
                             <td>
                                <a href="/ver/{{ $incident->id }}">
                                    {{ $incident->id }}
                                </a>
                                
                            </td>
                            <td>{{ $incident->category_name }}</td>
                            <td>{{ $incident->severity_full }}</td>
                            <td>{{ $incident->state }}</td>
                            <td>{{ $incident->created_at }}</td>
                            <td>{{ $incident->title_short }}</td>
                            <td>{{ $incident->support_id ?: 'Sin asignar' }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection
