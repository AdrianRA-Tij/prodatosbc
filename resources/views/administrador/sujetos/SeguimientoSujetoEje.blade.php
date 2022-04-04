@extends('administrador.sujetos.SeguimientoSujeto')

@section('Seguimiento_Sujeto_Obligado_Ejes')
    <div class="SeguimientoEncabezado">
        <div class="SeguimientoAcomodo">
            <div class="SeguimientoBordeado3">
                <p class="SeguimientoTextual">{{ $supereje->name }}</p>
            </div>
        </div>
        <div class="SeguimientoAcomodo" style="background-color: #E9ECEF;">
            <div class="SeguimientoBordeado1">
                <p class="SeguimientoTextual">Objetivo</p>
            </div>
            <div class="SeguimientoBordeado2">
                <p class="SeguimientoTextual">{{ $supereje->description }}</p>
            </div>
        </div>
    </div>

    <div class="">
        <div class="" style="background-color: #FFFFFF;">
            <form action="{{ route('sujeto.seguimiento.eje', ['user' => $user, 'eje' => $supereje]) }}" method="POST">
                @csrf
                <select name="campox" id="">
                    <option value="Todo">Todo</option>
                    <option value="Sin Revision">Sin Revision</option>
                    <option value="Incompleto">Incompleto</option>
                    <option value="Aceptado">Aceptado</option>
                </select>
                <input type="submit" value="Buscar" class="EvidenciaCapsula"> <br><br>
            </form>
        </div>
    </div>
    <div class="SeguimientoEncabezado">
        <div>
            <table class="ListaSujeto" cellspacing="0" cellpadding="0"  width="100%" >
                <tr style="background-color: #FFFFFF;">
                    <td style="width: 15%">
                        <p>Accion</p>
                    </td>
                    <td style="width: 10%">
                        <p></p>
                    </td>
                    <td style="width: 40%">
                        <p>Actividad a Desarrollar</p>
                    </td>
                    <td style="width: 25%">
                        <p>Fecha Implementacion</p>
                    </td>
                    <td style="width: 10%">
                        <p>Estado</p>
                    </td>
                </tr>
                @foreach ($compromisos as $compromiso)
                @foreach ($acciones as $accion)
                @foreach ($estrategias as $estrategia)
                @if ($compromiso->accion_id == $accion->id && $accion->estrategia_id == $estrategia->id && $estrategia->eje_id == $supereje->id)
                <tr style="background-color: #F1F1F1;">
                    <td>
                        <p>{{$accion->name}}</p>
                    </td>
                    <td>
                        @if ($compromiso->archive != NULL)
                        <form action="{{ route('sujeto.seguimiento.eje.accion', ['user' => $usuario, 'eje' => $supereje, 'compromiso' => $compromiso]) }}" method="POST">
                            @csrf
                            <input type="image" src="{{url('images/Visible.png')}}" alt="">
                        </form>
                        @endif
                    </td>
                    <td>
                        <p>{{$compromiso->action_plan}}</p>
                    </td>
                    <td>
                        <p>Fecha...</p>
                    </td>
                    <td>
                      @if ($compromiso->detail == NULL && $compromiso->state == 1)
                          <p><img src="{{url('images/Icon_estado0.png')}}" alt=""></p>
                      @elseif ($compromiso->detail == "Incompleto" && $compromiso->state == 1)
                          <p><img src="{{url('images/Icon_estado2.png')}}" alt=""></p>
                      @elseif ($compromiso->detail == "Fuera de Tiempo" && $compromiso->state == 1)
                          <p><img src="{{url('images/Icon_estado3.png')}}" alt=""></p>
                      @elseif ($compromiso->detail == "Aceptado" && $compromiso->state == 1)
                          <p><img src="{{url('images/Icon_estado1.png')}}" alt=""></p>
                      @endif
                    </td>
                </tr>
                @endif
                @endforeach
                @endforeach
                @endforeach
            </table>
        </div>
    </div>
    <!--@if (!empty($archivos))
        @yield('Seguimiento_Sujeto_Obligado_Ejes_Accion')
    @endif-->
@endsection
