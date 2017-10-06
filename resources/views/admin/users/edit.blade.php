@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Editar usuario</div>

    <div class="panel-body">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        @if (session('notification'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">
                &times;
            </button>
            {{ session('notification') }}
        </div>
        @endif

        @if (session('info'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">
                &times;
            </button>
            {{ session('info') }}
        </div>
        @endif

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="" method="POST">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control" readonly value="{{ old('email', $user->email) }}">
                
            </div>
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                
            </div>
            <div class="form-group">
                <label for="password">Contraseña <em>Ingresar sólo si se desea modificar</em></label>
                <input type="text" name="password" class="form-control" value="{{ old('password') }}">
                
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="icon-save"> Guardar usuario</span></button>
                
            </div>
            
        </form>
        
        <form action="/proyecto-usuario" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="row">
                <div class="col-md-4">
                    <select name="project_id" class="form-control" id="select-project">
                        <option value="">Seleccione proyecto</option>
                        @foreach ( $projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="level_id" class="form-control" id="select-level">
                        <option value="">Seleccione nivel</option>

                    </select>
                </div>
                <div class="col-md-4">
                   <button class="btn btn-primary btn-block"><span class="icon-assignment_turned_in"> Asignar proyecto</span></button>
               </div>
           </div>
       </form>


       <table class="table table-bordered">

        <caption><strong>Lista de proyectos</strong></caption>
        <thead>
            <tr>
                <th>Proyecto</th>
                <th>Nivel</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects_user as $project_user)
            <tr>
                <td>{{ $project_user->project->name }}</td>
                <td>{{ $project_user->level->name }}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-warning" title="Editar" data-projectuser="{{ $project_user->id }}">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </button>

                    <a href="/proyecto-usuario/{{ $project_user->id }}/eliminar" class="btn btn-sm btn-danger" title="Dar de baja">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

<div class="modal" id="modalEditProjectUser">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar proyecto y nivel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form action="<!--/proyecto-usuario/editar-->" method="POST">
    {{ csrf_field() }}
    <div class="modal-body">

     <div class="form-group">
        
        <label for="project_id">Proyecto</label>
        <select name="project_id" class="form-control" id="select-projectuser">
            <option value="">Seleccione proyecto</option>
            @foreach ( $projects as $project)
            <option value="{{ $project->id }}" >{{ $project->name }}</option>
            @endforeach
        </select> 
    </div>

    <div class="form-group">
        <select name="level_id" class="form-control" id="select-leveluser">
            <option value="">Seleccione nivel</option>
            
        </select>
    </div>

</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary">Guardar cambios</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
</div>
</form>
</div>
</div>
</div>

@endsection

@section('scripts')
<script src="/js/admin/users/edit.js"></script>
@endsection