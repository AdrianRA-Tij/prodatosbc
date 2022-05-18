@extends('layouts.template_sujeto')

@section('content')
<div class="text-left col-md-5 mt-2">
    <label style="color: #848483 ;font-size:200%;font-family:inter;" for="">R. Compromisos</label>
</div>
<div class="container-fluid">
    <div class="form-group">
        <div class="row  mt-3">
            <div class="text-left col ms-2">
                <label style="font-size:25px; font-family:inter; font-weight: bold;" for="">Sujeto Obligado: {{ Auth::user()->username}}</label>
            </div>
            <div class="text-right col-sm-2 ">
                <a type="button" class="btn btn-primary" style="background: #059B97;" href="{{ route('compromiso.create') }}"><i class="fas fa-plus"></i>
                    Agregar compromiso</a>

            </div>
        </div>
        @if($compromisos->count())
        <div class="mt-3 row" style="background-color: white;">
            <div class="text-left col ms-2">
                <label style="color: #848483 ;font-size:180%;font-family:inter;" for="">Lista de compromisos</label>
            </div>
            <div class="col-sm-12 mt-3">
                @include('alertas.alerta')

                <table class="table table-striped table-bordered">

                    <thead>
                        <tr>
                            <th>Eje</th>
                            <th>Problematica</th>
                            <th>Estrategia</th>
                            <th>Accion</th>
                            <th>Descripción de la actividad</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compromisos as $compromiso)
                        <tr>
                            <td class="align-top" style="width:10%;">{{$compromiso -> accion -> estrategia -> problematica -> eje ->number}}</td>
                            <td class="align-top" style="width:10%;">{{$compromiso -> accion -> estrategia -> problematica ->number}}</td>
                            <td class="align-top" style="width:10%;">{{$compromiso -> accion -> estrategia ->number}}</td>
                            <td class="align-top" style="width:10%;">{{$compromiso -> accion ->number}}</td>
                            <td class="align-top" style="width:60%;">{{$compromiso -> action_plan}}</td>
                            <td style="width:5%;">
                                <button type="button" class="btn btn-primary md-2" data-toggle="tooltip" title="Editar compromiso" data-bs-toggle="modal" data-bs-target="#modal-editar-compromiso-{{ $compromiso->id }}" style="background: #059B97;"> <i class="fas fa-edit"></i></button>
                            </td>
                            <td style="width:5%;">
                                <button type="button" class="btn btn-danger" data-toggle="tooltip" title="Eliminar compromiso" data-bs-toggle="modal" data-bs-target="#modal-eliminar-compromiso-{{ $compromiso->id }}"><i class="fas fa-trash-alt"></i></button>
                                @include('sujeto.eliminar_compromiso')
                            </td>
                            @include('sujeto.editar_compromiso')
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">{{$compromisos->links()}}</li>
                    </ul>
                </nav>

                @else
                <div class="mt-5 text-center">
                    <label style="font-size:30px; font-family:inter; font-weight: bold;">No hay compromisos en la lista. De click al botón +Agregar compromisos</label>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection