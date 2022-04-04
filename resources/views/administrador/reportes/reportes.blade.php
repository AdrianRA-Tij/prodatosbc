@extends('layouts.template_admin')

@section('content')
<div class="row justify-content-end">
    <div class="text-left col ms-2">
        <label style="color: #848483 ;font-size:250%;font-family:inter;" for="">Sujetos Obligados</label>
    </div>
    <!-- <div class="text-right col-sm-2">
        <button type=" button" class="btn btn-primary" data-bs-toggle="modal" data-toggle="tooltip" title="generar pdf"  style="background: #059B97;"><i class="fa fa-file-image-o"></i>
            GENERAR PDF
        </button>
    </div> -->
    <div class="text-right col-sm-2">
        <button type=" button" class="btn btn-primary" data-bs-toggle="modal" data-toggle="tooltip" title="Subir marca de agua" data-bs-target="#modal-marcas-agua" style="background: #059B97;"><i class="fa fa-file-image-o"></i>
            Marcas de agua
        </button>
    </div>
    <div class="col-xl-12 my-3">
        <form action="{{ route('reportes.index') }}" method="GET">
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
                    <!-- <th>Seleccionar</th> -->
                    <th>ID</th>
                    <th>Sujeto Obligado</th>
                    <th>Correo electrónico</th>
                    <th>Acciones totales</th>
                    <th></th>
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
                      <!--<td style="width:5%;" class="align-top">--><!--cambiar esto para pasarlo-->
                        <!-- <input type="checkbox" class="check" id="" name="" value="" data-toggle="tooltip" title="">
                      </td> -->
                        <td style="width:5%;" class="align-top">
                            <p>{{$user->number_user}}</p>
                        </td>
                        <td style="width:50%;" class="align-top">
                            <p>{{$user->username}} </p>
                        </td>
                        <td style="width:25%;" class="align-top">
                            <p>{{$user->email}} </p>
                        </td>
                        <td>
                            <!-- acciones totales -->
                        </td>
                        <td style="width:5%;">
                          <!-- <button type="button" data-toggle="tooltip" title="Generar PDF" class="btn btn-primary" style="background: #059B97;"><i class="fa fa-file-text"></i></button> -->
                          <a type="button" data-toggle="tooltip" title="Generar PDF" class="btn btn-primary" style="background: #059B97;"  href="{{ route('sujeto.seguimiento.pdf', $user->id) }}"><i class="fa fa-file-pdf-o"></i></a>
                        </td>
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
<script src="{{ asset('js/checkbox.js') }}"></script>
@include('administrador.reportes.marcas_de_agua')
@endsection
