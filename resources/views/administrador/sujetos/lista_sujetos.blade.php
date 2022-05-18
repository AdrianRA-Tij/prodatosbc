@extends('layouts.template_admin')

@section('content')
<div class="row justify-content-end">
    <div class="text-left col ms-2">
        <label style="color: #848483 ;font-size:250%;font-family:inter;" for="">Sujetos Obligados</label>
    </div>
    <div class="text-right col-sm-2">
        <button type=" button" class="btn btn-primary" data-bs-toggle="modal" data-toggle="tooltip" title="Agregar sujeto obligado" data-bs-target="#modal-create-user" style="background: #059B97;"><i class="fas fa-plus"></i>
            Agregar Sujeto
        </button>
    </div>
    <div class="col-xl-12 my-3">
        <form action="{{ route('user.index') }}" method="GET">
            @csrf
            <div class="form-row d-flex">
                <div class="col-sm-4">
                    <input class="form-control me-2" type="search" name="text" placeholder="Buscar" value="{{$text}}" aria-label="Search">

                </div>
                <div class="col-auto">
                    <input class="btn btn-primary" type="submit" data-toggle="tooltip" title="Buscar" style="background: #059B97;" value="Buscar">
                </div>
            </div>
        </form>
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

<div class="row">
    <div class="col-md-12 mt-3">
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
        <table class="table table-striped table-bordered" id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sujeto Obligado</th>
                    <th>Nombre del Oficial</th>
                    <th>Correo electrónico</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @if(count($users)<=0) <tr>
                    <td colspan="4">
                        <p>No hay resultados</p>
                    </td>
                    @else
                    @php
                    $row = 0;
                    $buttonName = "button_eliminar_";
                    @endphp

                    @forelse ($users as $user)
                    <tr>
                        <td style="width:5%;" class="align-top">
                            <p>{{$user->number_user}}</p>
                        </td>
                        <td style="width:15%;" class="align-top">
                            <p>{{$user->username}}</p>
                        </td>
                        <td style="width:50%;" class="align-top">
                            <p>{{$user->name}} </p>
                        </td>
                        <td style="width:25%;" class="align-top">
                            <p>{{$user->email}} </p>
                        </td>
                        <td style="width:5%;">

                            <form action="{{ route('sujeto.seguimiento', $user) }}" method="POST">
                                @csrf
                                <button type="submit" name="usuario" data-toggle="tooltip" title="Compromisos" class="btn btn-primary" style="background: #059B97;"><i class="far fa-plus-square"></i></button>
                            </form>
                        </td>
                        <td style="width:5%;">
                          <!-- <button type="button" data-toggle="tooltip" title="Generar PDF" class="btn btn-primary" style="background: #059B97;"><i class="fa fa-file-text"></i></button> -->
                          <a type="button" data-toggle="tooltip" title="Generar PDF" class="btn btn-primary" style="background: #059B97;"  href="{{ route('sujeto.seguimiento.pdf', $user->id) }}"><i class="fa fa-file-text"></i></a>
                        </td>
                        <td style="width:5%;">
                            <button type="button" class="btn" data-bs-toggle="modal" data-toggle="tooltip" title="Editar sujeto obligado" data-bs-target="#modal-update-user-{{ $user->id }}" style="background: #BD3284; color:white;"><i class="fas fa-edit"></i></button>
                        </td>
                        <td style="width:5%;">
                            <button type="button" class="btn btn-primary" data-toggle="tooltip" title="Editar contraseña" data-bs-toggle="modal" data-bs-target="#modal-update-password-{{ $user->id }}"><i class="fas fa-unlock"></i></button>
                        </td>

                        <td style="width:5%;">
                            @php
                            $btnNameRow = $buttonName.$row;
                            $row += 1;
                            @endphp
                            <button type="button" id="<?php echo $btnNameRow; ?>" disabled class="btn btn-danger" data-toggle="tooltip" title="Eliminar" data-bs-toggle="modal" data-bs-target="#modal-delete-user-{{ $user->id }}"><i class="fas fa-trash-alt"></i></button>
                            @include('administrador.sujetos.eliminar_sujeto')
                        </td>
                        @include('administrador.sujetos.editar_sujeto')
                        @include('administrador.sujetos.editar_password')
                    </tr>
                    @endforeach
                    @endif
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item">{{$users->links()}}</li>
            </ul>
        </nav>
    </div>
</div>
@include('administrador.sujetos.nuevo_sujeto')
@endsection
