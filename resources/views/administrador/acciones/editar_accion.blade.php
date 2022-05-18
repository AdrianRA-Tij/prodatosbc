@extends('layouts.template_sujeto')

@section('content')
<div class="card">
    <h5 class="card-title text-center" style="color: #848483 ;font-size:200%;font-family:inter;">Modificar línea de acción</h5>
    <div class="card-body">
        @include('alertas.alerta')
        @if ($errors->any())
        <div class="alert alert-warning alert-dismissible fade show" id="error_alert" role="alert">
            <div class="errors">
                Por favor corrige los siguientes errores
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" arial-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <form action="{{ route('accion.update', $accion) }}" method="POST">
            @csrf @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <div class="mt-2">
                        <label for="number" class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;"> Numero de la accion</label>
                        <input type="text" name="number" class="form-control @error('number') is-invalid @enderror" id="number" placeholder="Numero de la Accion"  required value="{{ old('number', $accion->number) }}"></input>
                        @error('number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <label for="name" class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;"> Nombre</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $accion->name) }}" required>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="description" class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;">Línea estratégica</label>
                        <select name="estrategia_id" id="estrategia_id" class="form-control custom-select border @error('estrategia_id') is-invalid @enderror" aria-label="Default select example" required>>
                            <option value="">-- Elige una línea estratégica --</option>
                            @foreach ($estrategias as $estrategia)
                            <option value="{{$estrategia -> id}}" {{$estrategia ->id == $accion -> estrategia_id ? 'selected' : '' }}>{{ $estrategia -> name }}</option>
                            @endforeach
                        </select>
                        @error('estrategia_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer" justify-content-between>
                    <a type="button" class="btn btn-outline-danger" href="{{ route('acciones.index') }}">Cancelar</a>
                    <button type="submit" class="btn btn-outline-primary" data-dismiss="modal" style="color: white; background:#059B97;">Actualizar</button>
                </div>
        </form>
    </div>
</div>
@endsection