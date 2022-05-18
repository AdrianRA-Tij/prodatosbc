@extends('administrador.panel')

@section('panel_content')
<div class="row justify-content-end  mt-3">
    <div class="text-left col ms-2 ">
        <label style="color: #848483 ;font-size:180%;font-family:inter;" for="">Ejes registrados</label>
    </div>
    <div class="text-right col-sm-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-create-eje" style="background: #059B97;"><i class="fas fa-plus"></i>
            Agregar eje
        </button>
    </div>
</div>
<div class="row justify-content-end mt-2">
    <div class="col-2 align-self-end">
    <div class="form-check form-switch">
        <input class="form-check-input" style="width: 50px; height: 25px;" type="checkbox" value="" id="myCheckBoxID">
            <label class="form-check-label" for="myCheckBoxID" style="color: #848483 ;font-size:20px;font-family:inter;">
            Activar eliminar
            </label>
        </div>

    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
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
        <!-- or use any other number .col-md- -->
        <table class="table table-striped table-bordered" id="myTable">
            <thead>
                <tr>
                    <th style="width:20%;">Numero del Eje</th>
                    <th style="width:20%;">Nombre del Eje</th>
                    <th style="width:70%;">Objetivo</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                $row = 0;
                $buttonName = "button_eliminar_";
                @endphp
                @foreach($ejes as $eje)
                <tr>
                    <td>{{ $eje->number }}</td>
                    <td>{{ $eje->name }}</td>
                    <td class="align-top"> {{ $eje->description}}</td>
                    <td style="width:5%;">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-editar-eje-{{ $eje->id }}" style="background: #059B97;"> <i class="fas fa-edit"></i></button>
                    </td>
                    <td style="width:5%;">
                        @php
                        $btnNameRow = $buttonName.$row;
                        $row += 1;
                        @endphp
                        <button type="button" id="<?php echo $btnNameRow; ?>" disabled class="btn btn-danger" data-toggle="tooltip" title="Eliminar" data-bs-toggle="modal" data-bs-target="#modal-eliminar-eje-{{ $eje->id }}"><i class="fas fa-trash-alt"></i></button>
                        @include('administrador.ejes.eliminar_eje')
                    </td>
                    @include('administrador.ejes.editar_eje')
                </tr>

                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item">{{$ejes->links()}}</li>
            </ul>
        </nav>

    </div>
</div>
@include('administrador.ejes.nuevo_eje')

<!----------MODAL-ELIMINAR/EJE--------->
@endsection