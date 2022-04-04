@extends('layouts.template_sujeto')

@section('content')
<div>
    <div class="SeguimientoAcomodo, SeguimientoCentrado" style="margin: 20px;">

        @php
        $boton = 0
        @endphp
        @foreach ($ejes as $eje)
            @php
            $boton += 1
            @endphp
            @if ($eje->state == 1)
                <form action="{{ route('evidencias_eje', ['user' => $usuario, 'eje' => $eje]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="{{ $usuario }}" value="{{ $usuario }}">
                    @if (empty($supereje))
                    <input type="submit" value="Eje {{ $boton }}" class="SeguimientoBoton" name="Eje {{ $boton }}">
                    @else
                    @if ($supereje->Id == $boton)
                    <input type="button" value="Eje {{ $boton }}" class="SeguimientoBotonSeleccionado" name="Eje {{ $boton }}">
                    @else
                    <input type="submit" value="Eje {{ $boton }}" class="SeguimientoBoton" name="Eje {{ $boton }}">
                    @endif
                    @endif
                </form>
            @endif
        @endforeach
    </div>
    @yield('Evidencias_Sujeto_Obligado_Eje')
</div>


@endsection
