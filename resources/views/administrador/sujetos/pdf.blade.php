<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Reporte</title>

    <link href="css/pdf.css" rel="stylesheet" type="text/css">
    
    <style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  table-layout: fixed;
}

th, td {
    width: 100px;
    word-wrap: break-word;
}

th{
  text-align:left;
}
</style>
  </head>
  
  <body>
    <header>

      <div class="container">
      
      <img src="{{ storage_path('/app/public/logos/1647372823-new.jpg') }}" style="width: 300px; height: 150px;">
  
      <!-- <h1>Reporte de {{$user->username}}</h1> -->

      </div>

    </header>
    
    <footer></footer>
    
    <!-- <img src="{{ asset('/images/logo_PRODATOS.fw.png') }}"> -->
    <!-- <table style="width=100%">
      <tbody>
        <tr>
          <td><h1>Reporte de {{$user->username}}</h1></td>
          <td><img src="{{ public_path('Logo3.png') }}" style="width: 400px; height: 200px"></td>
        </tr>
      </tbody>
    </table> -->
    @php 
        $date = date('d-m-Y');
    @endphp 
    <h3 style="text-align: right">Fecha del reporte: {{$date}}</h3>
    <table style="width:100%">
  <tr>
    <th>No.	</th>
    <th style="width:75%">Nombre del sujeto obligado:	</th>
    <th>ID</th>
  </tr>
  <tr>
    <td>1000</td>
    <td>{{$user->username}}</td>
    <td>{{$user->number_user}}</td>
  </tr>
  </table>
  <br> 
  <table style="width:100%">
  <tr>
    <th style="width:65%">Nombre del oficial de protección de datos personales:	</th>
    <th>Correo electrónico: </th>
  </tr>
  <tr>
    <td>{{$user->name}}</td>
    <td>{{$user->email}}</td>
  </tr>
    </table>

    <p>Resumen de compromisos adquiridos:</p>
    <!-- <table style="width:100%">
    @foreach ($compromisos as $compromiso)
        <tr>
          <td id="titulo">Compromisos: </td>
          <td id="subtitulo">{{$compromiso->action_plan}}</td>
        </tr>
        <tr>
          <td id="titulo">Fecha: </td>
          <td id="subtitulo">{{$compromiso->created_at}}</td>
        </tr>
        <tr>
          <td id="titulo">Status: </td>
          <td id="subtitulo">{{$compromiso->detail}}</td>
          
        </tr>   
        @if($loop->iteration % 8 == 0)
        <p style="page-break-before: always;"></p>
        @endif
      @endforeach
    </table> -->
    
    <table style="width:100%">
  <tr>
    <th>Ejes</th>
    <td style="width:7%">Cant.</td>
    <th>Problemáticas</th>
    <td style="width:7%">Cant.</td>
    <th>Estrategias</th>
    <td style="width:7%">Cant.</td>
    <th>Acciones</th>
    <td style="width:7%">Cant.</td>
  </tr>
  @php 
        $total = count($compromisos);
    @endphp 
  @foreach ($compromisos as $compromiso)
  @foreach ($acciones as $accion)
  @foreach ($estrategias as $estrategia)
  @foreach ($problematicas as $problematica)
  @foreach ($ejes as $eje)
  @if ($compromiso->accion_id == $accion->id && $accion->estrategia_id == $estrategia->id && $estrategia->problematica_id == $problematica ->id && $problematica-> eje_id == $eje->id)
  <tr>
    <td>{{$eje->number}}</td>
    <td>1</td>
    <td>{{$problematica->number}}</td>
    <td>1</td>
    <td>{{$estrategia->number}}</td>
    <td>1</td>
    <td>{{$accion->number}}</td>
    <td>1</td>
  </tr>
  @endif
  @endforeach
  @endforeach
  @endforeach
  @endforeach
  @endforeach
<!-- <tr>
<td colspan="2">Eje</td>
    <td colspan="2">Estrategia</td>
    <td colspan="2">Línea de acción</td>
</tr>
<tr>
<td colspan="2">Eje</td>
    <td colspan="2">Estrategia</td>
    <td colspan="2">Línea de acción</td>
</tr> -->
  <tr>
    <th>Total</th>
    <td>{{$total}}</td>
    <th>Total</th>
    <td>{{$total}}</td>
    <th>Total</th>
    <td>{{$total}}</td>
    <th>Total</th>
    <td>{{$total}}</td>
  </tr>
    </table>

  <br>

  <p>Desglose:</p>

    @foreach ($compromisos as $compromiso)
    @foreach ($acciones as $accion)
    @foreach ($estrategias as $estrategia)
    @foreach ($problematicas as $problematica)
    @foreach ($ejes as $eje)
    @if ($compromiso->accion_id == $accion->id && $accion->estrategia_id == $estrategia->id && $estrategia->problematica_id == $problematica ->id && $problematica-> eje_id == $eje->id)
    <table style="width:100%">
    
  <tr>
    <th>Eje</th>
    <th>Problematica</th>
    <th>Estrategia</th>
    <th>Línea de acción</th>
</tr>
<tr>
    <td>{{$eje->name}}</td>
    <td>{{$problematica->name}}</td>
    <td>{{$estrategia->name}}</td>
    <td>{{$accion->name}}</td>
</tr>
<tr>
    <th colspan="4">Descripción de la actividad </th>
</tr>
<tr>
    <td colspan="4">{{$compromiso->action_plan}}</td>
</tr>
<tr>
    <th colspan="3">Fecha en que se adquirió el compromiso:</th>
    <td>{{$compromiso->created_at}}</td>
</tr>
<tr>
    <th colspan="3">Fecha de entrega de la evidencia:</th>
    <td>{{$compromiso->date_delivery}}</td>
</tr>
<tr>
    <td><b>Fecha en que se validó la evidencia:</b></td>
    <td>FECHA</td>
    <td><b>Estatus:</b></td>
    <td>
    @if ($compromiso->detail == NULL)
      Sin revisar
    @else
      {{$compromiso->detail}}
    @endif
    </td>
</tr>
    </table>
    <br>
    @endif
    @endforeach
    @endforeach
    @endforeach
    @endforeach
    @endforeach
  </body>
</html>
