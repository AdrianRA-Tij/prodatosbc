@extends('layouts.template_admin')

@section('content')
<div class="card">
    <h5 class="card-title text-center" style="color: #848483 ;font-size:200%;font-family:inter;">Nueva Problematica </h5>
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
        <form action="{{ route('problematica.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="mt-2">
                    <label for="number" class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;"> Numero de la Problematica</label>
                    <input type="text" name="number" class="form-control @error('number') is-invalid @enderror" id="number" placeholder="Numero de la Problematica"  required>{{ old('number') }}</input>
                    @error('number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="name" class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;"> Nombre</label>
                    <textarea type="text" name="name" cols="20" rows="5" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nombre de la Problematica" required>{{ old('name') }}</textarea>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label for="eje_id" class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;">Eje</label>
                <div>
                    <select name="eje_id" id="eje_id" class="align-top form-control @error('eje_id') is-invalid @enderror" aria-label="Default select example" required>
                        <option value="">-- Elige un eje --</option>
                        @foreach ($ejes as $eje)
                        <option value="{{$eje -> id}}">{{ $eje -> name }}</option>
                        @endforeach
                    </select>
                    @error('eje_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
    </div>
    <!-- Modal footer -->
    <div class="modal-footer" justify-content-between>
    <a type="button" class="btn btn-outline-danger" href="{{ route('problematicas.index') }}">Cancelar</a>
        @csrf
        <button type="submit" class="btn btn-outline-primary" data-dismiss="modal" style="color: white; background:#059B97;">Guardar</button>
    </div>
    </form>
</div>
</div>
@endsection