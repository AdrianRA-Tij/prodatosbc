@extends('layouts.template_admin')

@section('content')
    <div class="SeguimientoEncabezado">
        <div>
            <table class="ListaSujeto" cellspacing="0" cellpadding="0"  width="100%" >
                <tr style="background-color: #FFFFFF;">
                    <td style="width: 5%">
                        <p></p>
                    </td>
                    <td style="width: 25%">
                        <p>Archivos</p>
                    </td>
                    <td style="width: 30%">
                        <p>Fecha</p>
                    </td>
                    <td style="width: 20%">
                        <p>Tipo</p>
                    </td>
                    <td style="width: 20%">
                        <p>Tamaño</p>
                    </td>
                </tr>
                <tr style="background-color: #F1F1F1;">
                    @php
                    $stringconversor2 = (string)$compromiso->archive;
                    @endphp
                    <td>
                        @php
                        $separador = explode('.',$stringconversor2);
                        @endphp
                        @if (count($separador) -1 > 0)
                            @if ($separador[1] == "png" || $separador[1] == "jpg")
                                <p><img src="{{url('images/Icon_File_Image.png')}}" alt=""></p>
                            @elseif ($separador[1] == "pdf")
                                <p><img src="{{url('images/Icon_File_Pdf.png')}}" alt=""></p>
                            @elseif ($separador[1] == "mp3" || $separador[1] == "wav" || $separador[1] == "ogg")
                                <p><img src="{{url('images/Icon_File_Audio.png')}}" alt=""></p>
                            @elseif ($separador[1] == "mp4" || $separador[1] == "mov" || $separador[1] == "wmv" || $separador[1] == "avi")
                                <p> <img src="{{url('images/Icon_File_Video.png')}}" alt=""></p>
                            @elseif ($separador[1] == "zip" || $separador[1] == "rar" || $separador[1] == "7z")
                                <p><img src="{{url('images/Icon_File_Zip.png')}}" alt=""></p>
                            @elseif ($separador[1] == "txt" || $separador[1] == "docx" || $separador[1] == "ppt" || $separador[1] == "xlsx")
                                <p><img src="{{url('images/Icon_File_Text.png')}}" alt=""></p>
                            @else
                                <p><img src="{{url('images/Icon_File_Vacio.png')}}" alt=""></p>
                            @endif
                        @else
                        @endif
                    </td>
                    <td>
                        <p>{{ $stringconversor2 }}</p>
                    </td>
                    <td>
                        <p>{{ $compromiso->updated_at }}</p>
                    </td>
                    <td>
                    @if (count($separador) -1 > 0)
                        <p>{{ $separador[1] }} </p>
                    @endif
                    </td>
                    <td>
                        <p>{{$peso}}</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="SeguimientoEncabezado">
        <table class="ListaSujeto" cellspacing="0" cellpadding="0"  width="100%" >
            <tr style="background-color: #FFFFFF;">
                <td style="width: 25%">
                    <p>Estado</p>
                </td>
                <td style="width: 40%">
                    <p>Detalle</p>
                </td>
                <td style="width: 35%">
                    <p>Descarga</p>
                </td>
            </tr>
            <tr style="background-color: #F1F1F1;">
                <td style="width: 25%">
                    @if ($compromiso->detail == NULL && $compromiso->state == 1)
                        <p><img src="{{url('images/Icon_estado0.png')}}" alt=""></p>
                    @elseif ($compromiso->detail == "Incompleto" && $compromiso->state == 1)
                        <p><img src="{{url('images/Icon_estado2.png')}}" alt=""></p>
                    @elseif ($compromiso->detail == "Fuera de Tiempo" && $compromiso->state == 0)
                        <p><img src="{{url('images/Icon_estado3.png')}}" alt=""></p>
                    @elseif ($compromiso->detail == "Aceptado" && $compromiso->state == 1)
                        <p><img src="{{url('images/Icon_estado1.png')}}" alt=""></p>
                    @endif
                </td>
                <td style="width: 40%">
                    @if ($compromiso->detail == NULL && $compromiso->state == 1)
                        <p>Sin Revision</p>
                    @else
                        <p>{{ $compromiso->detail }} </p>
                    @endif
                </td>
                <td style="width: 35%">
                    <form action="{{ route('descargar_archivo', (int)$compromiso->id) }}" method="POST">
                        @csrf
                        <input type="image" src="{{url('images/Icon_descarga.png')}}" alt="">
                    </form>
                </td>
            </tr>
        </table>
    </div>
    <div>
        <form action="{{ route('sujeto.seguimiento.eje.accion', ['user' => $usuario, 'eje' => $supereje, 'compromiso' => $compromiso]) }}" method="POST">
            @csrf
            <input type="hidden" name="campox" value="Todo">
            <input type="hidden" name="datapack" value="regreso">
            <input type="hidden" name="analisis_accion" value="{{(string)$compromiso->id}}">
            <select name="Campo" id="">
                <option value="Incompleto">Incompleto</option>
                <option value="Aceptado">Aceptado</option>
            </select>
            <input type="submit" value="Guardar" class="EvidenciaCapsula"> <br><br>
            <textarea name="Text1" cols="40" rows="5" style="width:80%; height:100px;" placeholder="Comentarios">{{(string)$compromiso->comment}}</textarea>
        </form>
    </div>
@endsection

<!-- -->
