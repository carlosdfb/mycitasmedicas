@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar Especialidad</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('specialties') }}" class="btn btn-sm btn-default">Cancelar y Volver</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('specialties/'.$specialty->id) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">Nombre de la especialidad</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{old('name',$specialty->name)}}">
                </div>
                <div class="form-group">
                    <label for="name">Descipci&oacute;n de la especialidad</label>
                    <input type="text" id="descripcion" name="descripcion" class="form-control"
                           value="{{old('descripcion',$specialty->descripcion)}}">
                </div>
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
            </form>
        </div>
    </div>
@endsection
