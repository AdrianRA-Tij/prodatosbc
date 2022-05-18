@extends('layouts.template_sujeto')

@section('content')
<div class="card">
<h5 class="card-title text-center"  style="color: #848483 ;font-size:200%;font-family:inter;">Nuevo compromiso</h5>
    <div class="card-body">
        <form action="{{ route('compromiso.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <div>
                    <input type="hidden" name="user_id" class="form-control" id="user_id" value="{{ Auth::user()->id}}" readonly></input>
                </div>
                @livewire('eje-estrategia-accion')
                <div class="mt-2">
                    <label for="action_plan" class=" col-form-label" style="font-size:120%;font-family:inter;">Descripción de la actividad</label>
                    <textarea name="action_plan" id="action_plan" type="text" class="form-control @error('action_plan') is-invalid @enderror" rows="8" placeholder="Descripción de la actividad que da cumplimiento a la línea de acción">{{old('action_plan')}}</textarea>
                    @error('action_plan')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer" justify-content-between>
                <a type="button" class="btn btn-outline-danger"  href="{{ route('compromiso.index') }}">Cancelar</a>
                @csrf
                <button type="submit" class="btn btn-outline-primary"  style="color: white; background:#059B97;">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection