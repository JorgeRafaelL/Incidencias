@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Dashboard</div>

    <div class="panel-body">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

         @if (session('notification'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">
                &times;
            </button>
            {{ session('notification') }}
        </div>
        @endif

         @if (session('info'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">
                &times;
            </button>
            {{ session('info') }}
        </div>
        @endif

        <table class="table table-bordered">
         <caption><strong>Incidencia</strong></caption>
         <thead>
             <tr>
                 <th>Código</th>
                 <th>Proyecto</th>
                 <th>Categoría</th>
                 <th>Fecha de envio</th>
             </tr>
         </thead>
         <tbody>
             <tr>
                 <td id="incident_key">{{ $incident->id }}</td>
                 <td id="incident_project">{{ $incident->project->name }}</td>
                 <td id="incident_category">{{ $incident->category_name }}</td>
                 <td id="incident_created_at">{{ $incident->created_at }}</td>
             </tr>
         </tbody>
         <thead>
             <tr>
                 <th>Asignada a</th>
                 <th>Nivel</th>
                 <th>Estado</th>
                 <th>Severidada</th>
             </tr>
         </thead>
         <tbody>
             <tr>
                 <td id="incident_responsible">{{ $incident->support_name }}</td>
                 <td >{{ $incident->level->name }}</td>
                 <td id="incident_state">{{ $incident->state }}</td>
                 <td id="incident_severity">{{ $incident->severity_full }}</td>
             </tr>
         </tbody>
     </table>

     <table class="table table-bordered">
         <caption>Datos extra</caption>
         <tbody>
             <tr>
                 <th>Titulo</th>
                 <td id="incident_summary">{{ $incident->title }}</td>
             </tr>
             <tr>
                 <th>Descripción</th>
                 <td id="incident_description">{{ $incident->description }}</td>
             </tr>
             <tr>
                 <th>Adjuntos</th>
                 <td id="incident_attachment"></td>
             </tr>
         </tbody>
     </table>
     @if ($incident->support_id == null && $incident->active && auth()->user()->canTake($incident))
     <a href="/incidencia/{{ $incident->id }}/atender" class="btn btn-primary btn-sm" id="incident_btn_apply">Atender incidencia</a>
     @endif

     @if (auth()->user()->id == $incident->client_id)
        @if ($incident->active)
        <a href="/incidencia/{{ $incident->id }}/resolver" class="btn btn-info btn-sm" id="incident_btn_solve">Marcar como resuelto</a>
        <a href="/incidencia/{{ $incident->id }}/editar" class="btn btn-success btn-sm" id="incident_btn_edit" >Editar incidencia</a>
        @else
        <a href="/incidencia/{{ $incident->id }}/abrir" class="btn btn-warning btn-sm" id="incident_btn_open" >Volver a abrir incidencia</a>
        @endif
     @endif

     @if (auth()->user()->id == $incident->support_id && $incident->active)
     <a href="/incidencia/{{ $incident->id }}/derivar" class="btn btn-danger btn-sm" id="incident_btn_derive">Derivar al siguiente nivel</a>
     @endif
 </div>
</div>

 @include('layouts.chat')
@endsection
