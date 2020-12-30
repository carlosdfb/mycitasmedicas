@extends('layouts.panel')
@section('styles')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection



@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Nuevo Médico</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('doctors') }}" class="btn btn-sm btn-default">Cancelar y Volver</a>
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

            <form action="{{ url('doctors') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre del médico</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control"
                           value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="text" id="dni" name="dni" class="form-control"
                           value="{{old('dni')}}">
                </div>
                <div class="form-group">
                    <label for="adress">Teléfono</label>
                    <input type="text" id="phone" name="phone" class="form-control"
                           value="{{old('phone')}}">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="text" id="password" name="password" class="form-control"
                           value="{{ Str::random(6) }}">
                </div>
                <div class="form-group">
                    <label for="specialties">Especialidades</label>
                    <select id="specialties" name="specialties[]" class="form-control selectpicker" data-style="btn-primary"
                            multiple title="Seleccione sus especialidades...">>
                        @foreach($specialties as $specialty)
                            <option value="{{$specialty->id}}">{{$specialty->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection
