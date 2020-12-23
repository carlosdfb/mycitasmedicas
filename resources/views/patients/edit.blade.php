@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar Paciente</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('patients') }}" class="btn btn-sm btn-default">Cancelar y Volver</a>
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

            <form action="{{ url('patients/'.$patient->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre del paciente</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{old('name',$patient->name)}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control"
                           value="{{old('email',$patient->email)}}">
                </div>
                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="text" id="dni" name="dni" class="form-control"
                           value="{{old('dni',$patient->dni)}}">
                </div>
                <div class="form-group">
                    <label for="adress">Teléfono</label>
                    <input type="text" id="phone" name="phone" class="form-control"
                           value="{{old('phone',$patient->phone)}}">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña </label>
                    <input type="text" id="password" name="password" class="form-control"
                           value="">
                    <p>Ingrese un valor si desea cambiar la contraseña</p>
                </div>
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
            </form>
        </div>
    </div>
@endsection
