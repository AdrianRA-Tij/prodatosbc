@extends('layouts.template_admin')
@section('content')

<style>
        .active a {
            color: #BD3284 !important;
            font-weight: bold !important;
            text-decoration: none !important;
        }
</style>

<div class="text-left col-sm-8">
    <label style="color: #848483 ;font-size:250%;font-family:inter;" for="">Panel</label>
</div>
<div>

    <nav class="navbar navbar-expand-lg shadow-sm col-md-12" style="background-color: #059B97" >
            <ul class="navbar-nav">
                <li  class=" {{ setActive('ejes.index') }} " >
                   <a  class="nav-link" style="font-size:150%;font-family:inter; color: white"  href="{{ route('ejes.index') }}">Ejes</a>
                </li>
                <li  class="{{ setActive('estrategias.index') }} ">
                    <a  class="nav-link"  style="font-size:150%;font-family:inter; color: white"  href="{{ route('estrategias.index') }}">Estrategias</a>
                </li>
                <li  class=" {{ setActive('acciones.index') }} ">
                    <a  class="nav-link" style="font-size:150%;font-family:inter; color: white" href="{{ route('acciones.index') }}">Acciones</a>
                </li>
            </ul>

    </nav>
</div>

@yield('panel_content')

@endsection