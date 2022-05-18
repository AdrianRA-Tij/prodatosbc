@extends('layouts.template_sujeto')

@section('content')

<h1 style="color: #848483;font-family:inter;">Subir Evidencias</h1>
<p>Puede subir sus evidencias en formato .rar, .zip o .7z</p>
<div  class="row justify-content-end mt-2"> 
    <div col-2 align-self-center>
    <form action="{{ route('cargar_evidencia', ['user' => $usuario, 'eje' => $supereje, 'id' => $compromiso_id]) }}" method="POST" enctype="multipart/form-data" id="Forma">
        @csrf
        @method('PUT')
        <input type="hidden" name="Archivo" id="Archivo">
        <input type="hidden" name="Compromiso_id" id="Compromiso_id" value="{{$compromiso_id}}">
        <input type="file" name="Buscador" id="Buscador" accept=".rar,.zip,.7z" class="EvidenciaCargar" onchange="this.form.submit()">
        <label for="Buscador" class="EvidenciaCapsula" name="Buscar" id="Archivo_Boton">Subir</label>
    </form>
    </div>
    
</div>
@endsection