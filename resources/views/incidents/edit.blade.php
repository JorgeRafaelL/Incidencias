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

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
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

        <form action="" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="category_id">Categoría</label>
                <select name="category_id" class="form-control">
                    <option value="0">General</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($incident->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="severity">Severidad</label>
                <select name="severity" class="form-control">
                    <option value="M" @if ($incident->severity == 'M') selected @endif>Menor</option>
                    <option value="N" @if ($incident->severity == 'N') selected @endif>Normal</option>
                    <option value="A" @if ($incident->severity == 'A') selected @endif>Alta</option>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Titulo</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $incident->title) }}">
            </div>
            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea name="description" cols="20" rows="5" class="form-control">{{ old('description', $incident->description) }}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection
