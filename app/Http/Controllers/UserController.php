<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Accion;
use App\Models\Estrategia;
use App\Models\Eje;
use App\Models\Compromiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompromisoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
//PDF'S
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf; // Descargado composer require dompdf/dompdf
use Dompdf\Options;
// $options = $dompdf->getOptions();
//         $options->set(array('isRemoteEnabled' => true));
//         $dompdf->setOptions($options);
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->middleware('EsAdmin')->except('evidencias_sujeto','evidencias_sujeto_eje','cargar_evidencia', 'pantalla_evidencia', 'eliminar_evidencia');

    }
    public function index(Request $request)

    {
        $text = trim($request->get('text'));
        //$users = User::where('rol_id', '2')->get();

       $users= User::where('number_user','LIKE','%'.$text.'%')
                    ->orWhere('username', 'LIKE', '%'.$text.'%')
                    ->where('rol_id', '2')
                    ->orderBy('number_user','asc')
                    ->paginate(8);

        return view('administrador.sujetos.lista_sujetos', compact('users','text'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validqaciones de los datos del registro
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'number_user' => 'required|string|size:5|unique:users',
        ],[
            'number_user.required' => 'El campo ID es obligatorio.',
            'number_user.unique' => 'Ya existe un registro con este ID.',
            'number_user.size' => 'El campo ID debe contener al menos 5 caracteres.',

        ]);
        //Crear usuarios insersion en la BD
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'number_user' => $request->number_user,
            'slug' =>  Str::slug($request->username, "-"),
            'rol_id' => '2',
            'state' => '1'

            //Comando para incriptar las contrase;as bcrypt
        ]);

        return back()->with('status', 'Creado con exito');

        //return redirect()->route('users.lista_sujetos');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'number_user' => ['required', 'string'],
            'number_user' => ['required','string','size:5','unique:users'],
             Rule::unique('users')->ignore($user->id)
        ],[

            'number_user.required' => 'El campo ID es obligatorio.',
            'number_user.unique' => 'Ya existe un registro con este ID.',
            'number_user.size' => 'El campo ID debe contener al menos 5 caracteres.',


        ]);
        $user->update([
            'username' => request('username'),
            'email' => request('email'),
            'number_user' => request('number_user'),

         ]);

        return back()->with('status_update', 'Actualizado con éxito');
    }
    public function update_password(Request $request, User $user)
    {

        $request ->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $request ->merge([
            'password' => Hash::make($request ->input('password')),
        ]);
        $user ->update($request->all());

        return back()->with('status_update', 'Actualizado con éxito');
    }
    public function destroy(Request $request, $user_id)
    {
        $user = User::find($user_id);//Encuentra el dato con el id
        $user->delete();
        return back()->with('status_delete', 'Eliminado con éxito');

    }
    public function lista(){


    }
    public function seguimiento(User $user) {
        $ejes = Eje::all();
        $datos_eje = NULL;
        $plantilla = "Seguimiento Sujeto";
        return view('administrador.sujetos.SeguimientoSujeto', ['usuario' => $user, 'plantilla' => $plantilla, 'ejes' => $ejes, 'supereje' => $datos_eje, 'archivos' => NULL], compact('user'));
    }
    //Muestra acciones
    // public function seguimiento_eje(Request $request, User $user, Eje $eje) {
    //     $ejes = Eje::all();
    //     /*$acciones_1 = DB::select('SELECT e3.id, e3.name, e5.action_plan, e5.date_implementation, e5.state, e5.archive FROM ejes as e1, estrategias as e2, accions as e3, users as e4, compromisos as e5 WHERE
    //     (e1.id = e2.eje_id && e2.id = e3.estrategia_id && e3.id = e5.accion_id && e4.id = e5.user_id) && (:SujId = e4.id && :EjId = e1.id)', ['SujId' => $user->id, 'EjId' => $eje->id]);
    //
    //     $acciones = array();
    //
    //     foreach($acciones_1 as $prueba) {
    //         array_push($acciones, array('Id' => (int)$prueba->id, 'Nombre' => (string)$prueba->name, 'Plan_Accion' => (string)$prueba->action_plan, 'Fecha_Implementacion' => (string)$prueba->date_implementation, 'Estado' => (boolean)$prueba->state, 'Registro' => (string)$prueba->archive));
    //     }*/
    //     //Input::get('datapack'));
    //     $compromisos =null;
    //     if ($request->input('datapack') == "normal") {
    //
    //     }
    //     else if ($request->input('datapack') == "regreso") {
    //         //$compromisos =  Compromiso::where('id', $request->input('analisis_accion'))->get(); Separa el objeto de los nuevos campos, no puede haber save ni update
    //         $compromisos = Compromiso::find($request->input('analisis_accion')); // Acepta cambios en Save
    //         if ($request->input('Campo') == "Incompleto"){
    //             $compromisos->state = 0;
    //             $compromisos->detail = "Incompleto";
    //         }
    //         else {
    //             $compromisos->state = 1;
    //             $compromisos->detail = "Aceptado";
    //         }
    //         $compromisos->comment = $request->input('Text1');
    //         //dd($compromisos);
    //         $compromisos->save();
    //     }
    //
    //
    //     $acciones = array();
    //     $txt1 = "";
    //     if ($request->input('campox') == "Todo") {
    //         //
    //         $acciones_1 = DB::select('SELECT e3.id, e3.name, e5.action_plan, e5.date_implementation, e5.state, e5.archive, e5.detail FROM ejes as e1, estrategias as e2, accions as e3, users as e4, compromisos as e5 WHERE
    //         (e1.id = e2.eje_id && e2.id = e3.estrategia_id && e3.id = e5.accion_id && e4.id = e5.user_id) && (:SujId = e4.id && :EjId = e1.id)', ['SujId' => $user->id, 'EjId' => $eje->id]);
    //
    //         $acciones = array();
    //
    //         foreach($acciones_1 as $prueba) {
    //             array_push($acciones, array('Id' => (int)$prueba->id, 'Nombre' => (string)$prueba->name, 'Plan_Accion' => (string)$prueba->action_plan, 'Fecha_Implementacion' => (string)$prueba->date_implementation, 'Estado' => (boolean)$prueba->state, 'Registro' => (string)$prueba->archive, 'Detalle' => (string)$prueba->detail));
    //         }
    //     }
    //     else if ($request->input('campox') == "Sin Revision") {
    //
    //         $txt1 = "Aceptado";
    //         $txt2 = "Incompleto"; // <=> es !=
    //         $acciones_1 = DB::select('SELECT e3.id, e3.name, e5.action_plan, e5.date_implementation, e5.state, e5.archive, e5.detail FROM ejes as e1, estrategias as e2, accions as e3, users as e4, compromisos as e5 WHERE
    //         (e1.id = e2.eje_id && e2.id = e3.estrategia_id && e3.id = e5.accion_id && e4.id = e5.user_id) && (e5.detail IS NULL) && (e5.archive IS NOT NULL) && (:SujId = e4.id && :EjId = e1.id)', ['SujId' => $user->id, 'EjId' => $eje->id]);
    //         $acciones = array();
    //
    //         foreach($acciones_1 as $prueba) {
    //             array_push($acciones, array('Id' => (int)$prueba->id, 'Nombre' => (string)$prueba->name, 'Plan_Accion' => (string)$prueba->action_plan, 'Fecha_Implementacion' => (string)$prueba->date_implementation, 'Estado' => (boolean)$prueba->state, 'Registro' => (string)$prueba->archive, 'Detalle' => (string)$prueba->detail));
    //         }
    //         //dd($txt1, $acciones);
    //     }
    //     else if ($request->input('campox') == "Incompleto") {
    //         $txt1 = "Incompleto";
    //         $acciones_1 = DB::select('SELECT e3.id, e3.name, e5.action_plan, e5.date_implementation, e5.state, e5.archive, e5.detail  FROM ejes as e1, estrategias as e2, accions as e3, users as e4, compromisos as e5 WHERE
    //         (e1.id = e2.eje_id && e2.id = e3.estrategia_id && e3.id = e5.accion_id && e4.id = e5.user_id) && (e5.detail = :txt1) && (:SujId = e4.id && :EjId = e1.id)', ['txt1' => $txt1, 'SujId' => $user->id, 'EjId' => $eje->id]);
    //
    //         $acciones = array();
    //
    //         foreach($acciones_1 as $prueba) {
    //             array_push($acciones, array('Id' => (int)$prueba->id, 'Nombre' => (string)$prueba->name, 'Plan_Accion' => (string)$prueba->action_plan, 'Fecha_Implementacion' => (string)$prueba->date_implementation, 'Estado' => (boolean)$prueba->state, 'Registro' => (string)$prueba->archive, 'Detalle' => (string)$prueba->detail));
    //         }
    //     }
    //     else if ($request->input('campox') == "Aceptado") {
    //         $txt1 = "Aceptado";
    //         $acciones_1 = DB::select('SELECT e3.id, e3.name, e5.action_plan, e5.date_implementation, e5.state, e5.archive, e5.detail  FROM ejes as e1, estrategias as e2, accions as e3, users as e4, compromisos as e5 WHERE
    //         (e1.id = e2.eje_id && e2.id = e3.estrategia_id && e3.id = e5.accion_id && e4.id = e5.user_id) && (e5.detail = :txt1) && (:SujId = e4.id && :EjId = e1.id)', ['txt1' => $txt1, 'SujId' => $user->id, 'EjId' => $eje->id]);
    //
    //         $acciones = array();
    //
    //
    //         foreach($acciones_1 as $prueba) {
    //             array_push($acciones, array('Id' => (int)$prueba->id, 'Nombre' => (string)$prueba->name, 'Plan_Accion' => (string)$prueba->action_plan, 'Fecha_Implementacion' => (string)$prueba->date_implementation, 'Estado' => (boolean)$prueba->state, 'Registro' => (string)$prueba->archive, 'Detalle' => (string)$prueba->detail));
    //         }
    //     }
    //
    //     $plantilla = "Seguimiento Sujeto";
    //     return view('administrador.sujetos.SeguimientoSujetoEje', ['usuario' => $user, 'plantilla' => $plantilla, 'ejes' => $ejes, 'supereje' => $eje, 'acciones' => $acciones, 'archivos' => NULL]);
    // }
    //Muestra los archivos relacionados con las acciones que a su vez que relacionan con las estrategias y estas con los ejes
    public function seguimiento_eje(Request $request, User $user, Eje $eje) {
        $usuario = $user->id;
        $ejes = Eje::All();
        $estrategias = Estrategia::where('eje_id', $eje->id)->get();
        $acciones = Accion::all();
        $plantilla = "Seguimiento Sujeto";

        if ($request->input('campox') == "Todo") {
            $compromisos = Compromiso::where('user_id', $usuario)->get();
        }
        else if ($request->input('campox') == "Sin Revision") {
            $compromisos = Compromiso::where('user_id', $usuario)->where('state', 1)->where('detail', null)->get();
        }
        else if ($request->input('campox') == "Incompleto") {
            $compromisos = Compromiso::where('user_id', $usuario)->where('state', 1)->where('detail', 'Incompleto')->get();
        }
        else if ($request->input('campox') == "Aceptado") {
            $compromisos = Compromiso::where('user_id', $usuario)->where('state', 1)->where('detail', 'Aceptado')->get();
        }

        return view('administrador.sujetos.SeguimientoSujetoEje', ['usuario' => $user, 'user' => $usuario, 'plantilla' => $plantilla, 'ejes' => $ejes, 'supereje' => $eje, 'estrategias' => $estrategias, 'acciones' => $acciones, 'compromisos' => $compromisos]);

    }
    // public function seguimiento_eje_accion(Request $request, User $user, Eje $eje, Accion $accion) {
    //     $ejes = Eje::all();
    //     $txt1 = "";
    //     $pesox = 0;
    //     $pesof = 0;
    //     $subfijo = "bytes";
    //     //
    //     $acciones_1 = DB::select('SELECT e3.id, e3.name, e5.action_plan, e5.date_implementation, e5.state FROM ejes as e1, estrategias as e2, accions as e3, users as e4, compromisos as e5 WHERE
    //     (e1.id = e2.eje_id && e2.id = e3.estrategia_id && e3.id = e5.accion_id && e4.id = e5.user_id) && (:SujId = e4.id && :EjId = e1.id)', ['SujId' => $user->id, 'EjId' => $eje->id]);
    //
    //
    //     $acciones = array();
    //     $archivos = array();
    //
    //     foreach($acciones_1 as $prueba) {
    //         array_push($acciones, array('Id' => (int)$prueba->id, 'Nombre' => (string)$prueba->name, 'Plan_Accion' => (string)$prueba->action_plan, 'Fecha_Implementacion' => (string)$prueba->date_implementation, 'Estado' => (boolean)$prueba->state));
    //     }
    //
    //     $archivos_1 = DB::select('SELECT  e5.archive, e5.date_implementation, e5.id, e5.detail, e5.state FROM ejes as e1, estrategias as e2, accions as e3, users as e4, compromisos as e5 WHERE
    //     (e1.id = e2.eje_id && e2.id = e3.estrategia_id && e3.id = e5.accion_id && e4.id = e5.user_id) && (:SujId = e4.Id && :EjId = e1.Id && :AcId = e3.Id)', ['SujId' => $user->id, 'EjId' => $eje->id, 'AcId' => $accion->id]);
    //
    //     foreach($archivos_1 as $prueba2) { // Añadir Detalle en archivos
    //         if ($prueba2->archive != NULL) {
    //             $pesox = Storage::disk('compromisos')->size($prueba2->archive);
    //             if ($pesox > 0) {
    //                 if ($pesox < 1024) { $subfijo = "bytes"; }
    //                 else if ($pesox < 1024*1024) { $subfijo = "KB"; $pesof = $pesox/1024; }
    //                 else if ($pesox < 1024*1024*1024) { $subfijo = "MB"; $pesof = $pesox/1024/1024; }
    //                 else if ($pesox < 1024*1024*1024*1024) { $subfijo = "GB"; $pesof = $pesox/1024/1024/1024; }
    //             }
    //             array_push($archivos, array('Archivo' => (string)$prueba2->archive, 'Fecha' => (string)$prueba2->date_implementation, 'Registro' => (string)$prueba2->id, 'Detalle' => (string)$prueba2->detail, 'Estado' => (string)$prueba2->state, 'Peso' => (string)(round($pesof,2) . " " . $subfijo)));
    //         }
    //     }
    //
    //     $plantilla = "Seguimiento Sujeto";
    //
    //     return view('administrador.sujetos.SeguimientoSujetoEjeAccion', ['usuario' => $user, 'plantilla' => $plantilla, 'ejes' => $ejes, 'supereje' => $eje, 'acciones' => $acciones, 'archivos' => $archivos]);
    // }

    public function seguimiento_eje_accion(Request $request,User $user, Eje $eje, Compromiso $compromiso) {
        $peso = "";
        $pesox = 0;
        $pesof = 0;
        $subfijo = "bytes";

        if ($compromiso->archive != NULL) {
            $pesox = Storage::disk('compromisos')->size($compromiso->archive);
            if ($pesox > 0) {
                if ($pesox < 1024) { $subfijo = "bytes"; }
                else if ($pesox < 1024*1024) { $subfijo = "KB"; $pesof = $pesox/1024; }
                else if ($pesox < 1024*1024*1024) { $subfijo = "MB"; $pesof = $pesox/1024/1024; }
                else if ($pesox < 1024*1024*1024*1024) { $subfijo = "GB"; $pesof = $pesox/1024/1024/1024; }
            }
          $peso = (string)(round($pesof,2) . " " . $subfijo);
        }

        //logica para guardar el estado y detalle de un compromiso
        if ($request->input('datapack') == "normal") {
        }
        else if ($request->input('datapack') == "regreso") {
            //$compromisos =  Compromiso::where('id', $request->input('analisis_accion'))->get(); Separa el objeto de los nuevos campos, no puede haber save ni update
            $compromiso = Compromiso::find($request->input('analisis_accion')); // Acepta cambios en Save
            if ($request->input('Campo') == "Incompleto"){
                $compromiso->detail = "Incompleto";
            }
            else {
                $compromiso->state = 1;
                $compromiso->detail = "Aceptado";
            }
            $compromiso->comment = $request->input('Text1');
            //dd($compromisos);
            $compromiso->save();
        }

        $plantilla = "Seguimiento Sujeto";

        return view('administrador.sujetos.SeguimientoSujetoEjeAccion', ['usuario' => $user, 'supereje' => $eje, 'compromiso' => $compromiso, 'plantilla' => $plantilla, 'peso' => $peso]);
    }

    public function evidencias_sujeto(){
        $ejes = Eje::all();
        $user = Auth::user()->id;
        $plantilla = "Evidencias Sujeto";
        return view('sujeto.EvidenciasSujeto', ['usuario' => $user, 'plantilla' => $plantilla, 'ejes' => $ejes, 'acciones' => NULL, 'archivos' => NULL]);
    }
    // public function evidencias_sujeto_eje(Eje $eje){
    //     $ejes = Eje::all();
    //     $user = Auth::user()->id;
    //     $acciones_1 = DB::select('SELECT e5.id as Id2, e3.id, e3.name, e5.action_plan, e5.date_implementation, e5.state FROM ejes as e1, estrategias as e2, accions as e3, users as e4, compromisos as e5 WHERE
    //     (e1.id = e2.eje_id && e2.id = e3.estrategia_id && e3.id = e5.accion_id && e4.id = e5.user_id) && (:SujId = e4.id && :EjId = e1.id)', ['SujId' => $user, 'EjId' => $eje->id]);
    //
    //     $acciones = array();
    //     $archivos = array();
    //
    //     foreach($acciones_1 as $prueba) {
    //         array_push($acciones,array("Id2" => $prueba->Id2, "Id" => $prueba->id, "Nombre" => $prueba->name, "Plan_Accion" => $prueba->action_plan, "Fecha_Entrega" => $prueba->date_implementation, "Estado" => $prueba->state));
    //     }
    //     foreach($acciones_1 as $accion) {
    //         $archivos_1 = DB::select('SELECT e5.id as Id2, e3.id, e5.archive, e5.date_implementation, e5.comment, e5.detail, e5.state FROM ejes as e1, estrategias as e2, accions as e3, users as e4, compromisos as e5 WHERE
    //         (e1.id = e2.eje_id && e2.id = e3.estrategia_id && e3.id = e5.accion_id && e4.id = e5.user_id) && (:SujId = e4.id && :EjId = e1.id && :AcId = e3.id)', ['SujId' => $user, 'EjId' => $eje->id,'AcId' => $accion->id]);
    //
    //
    //         foreach($archivos_1 as $prueba2) {
    //             //dd((string)$prueba2->Id2, (string)$prueba2->id, (string)$prueba2->archive, (string)$prueba2->date_implementation);
    //             array_push($archivos, array('Id2' => (string)$prueba2->Id2, 'Id' => (string)$prueba2->id, 'Archivo' => (string)$prueba2->archive, 'Fecha' => (string)$prueba2->date_implementation,'Comentario' => (string)$prueba2->comment, 'Detalle' => (string)$prueba2->detail, 'Estado' => (string)$prueba2->state));
    //         }
    //     }
    //
    //
    //     //dd($acciones, $archivos);
    //     $plantilla = "Evidencias Sujeto";
    //     return view('sujeto.EvidenciasSujetoEje', ['usuario' => $user, 'plantilla' => $plantilla, 'ejes' => $ejes, 'supereje' => $eje, 'acciones' => $acciones, 'archivos' => $archivos]);
    // }

    public function evidencias_sujeto_eje(Eje $eje){
        // $user = User::where('id', $id)->first();
        $user = Auth::user()->id;
        $ejes = Eje::all();
        $estrategias = Estrategia::where('eje_id', $eje->id)->get();
        $acciones = Accion::all();
        $compromisos = Compromiso::where('user_id', $user)->get();
        $plantilla = "Evidencias Sujeto";

        return view('sujeto.EvidenciasSujetoEje', ['usuario' => $user, 'plantilla' => $plantilla, 'ejes' => $ejes, 'eje' => $eje, 'estrategias' => $estrategias, 'acciones' => $acciones, 'compromisos' => $compromisos]);
    }

    public function pantalla_evidencia(User $user, Eje $eje, $id){
        //dd($user, $eje, $id);
        $ejes = Eje::all();
        $user2 = Auth::user()->id;
        $compromiso = Compromiso::where('id', $id)->first();
        $date = date('Y-m-d H:i:s');

        // PASTE
        $acciones_1 = DB::select('SELECT e5.id as Id2, e3.id, e3.name, e5.action_plan, e5.date_implementation, e5.state FROM ejes as e1, estrategias as e2, accions as e3, users as e4, compromisos as e5 WHERE
        (e1.id = e2.eje_id && e2.id = e3.estrategia_id && e3.id = e5.accion_id && e4.id = e5.user_id) && (:SujId = e4.id && :EjId = e1.id)', ['SujId' => $user2, 'EjId' => $eje->id]);

        $acciones = array();
        $archivos = array();

        foreach($acciones_1 as $prueba) {
            array_push($acciones,array("Id2" => $prueba->Id2, "Id" => $prueba->id, "Nombre" => $prueba->name, "Plan_Accion" => $prueba->action_plan, "Fecha_Entrega" => $prueba->date_implementation, "Estado" => $prueba->state));
        }
        foreach($acciones_1 as $accion) {
            $archivos_1 = DB::select('SELECT e5.id as Id2, e3.id, e5.archive, e5.date_implementation, e5.comment, e5.detail, e5.state FROM ejes as e1, estrategias as e2, accions as e3, users as e4, compromisos as e5 WHERE
            (e1.id = e2.eje_id && e2.id = e3.estrategia_id && e3.id = e5.accion_id && e4.id = e5.user_id) && (:SujId = e4.id && :EjId = e1.id && :AcId = e3.id)', ['SujId' => $user2, 'EjId' => $eje->id,'AcId' => $accion->id]);


            foreach($archivos_1 as $prueba2) {
                array_push($archivos, array('Id2' => (string)$prueba2->Id2, 'Id' => (string)$prueba2->id, 'Archivo' => (string)$prueba2->archive, 'Fecha' => (string)$prueba2->date_implementation,'Comentario' => (string)$prueba2->comment, 'Detalle' => (string)$prueba2->detail, 'Estado' => (string)$prueba2->state));
            }
        }
        $plantilla = "Evidencias Sujeto";

        return view('sujeto.SubirEvidencia', ['compromiso_id' => $id, 'usuario' => $user2, 'plantilla' => $plantilla, 'ejes' => $ejes, 'supereje' => $eje, 'acciones' => $acciones, 'archivos' => $archivos]);
    }

    public function cargar_evidencia(CompromisoRequest $request, User $user, Eje $eje, $id){
        //$compromiso = Compromiso::all();
        $ejes = Eje::all();
        $user2 = Auth::user()->id;
        $compromiso = Compromiso::where('id', $id)->first();
        //dd($user, $eje, $id, $compromiso);
        //dd($compromiso,$id);
        //$compromiso->update($request->all());
        //$date = Carbon::now()->toDateTimeString();
        //$date = date('d/m/Y  H:i:s', time());
        //$date = Carbon::now();
        $date = date('Y-m-d H:i:s');
        //$date = date("G:i:s A"). ' '.date("M/d/Y");

        //dd($compromiso,$request->file('Buscador'));
        if ($request->file('Buscador')){
            Storage::disk('compromisos')->delete($compromiso->archive);
            //$compromiso->Archivo = $request->file('Buscador')->store('','compromisos'); // Nombre_Aleatorio de archivo
            $nombre_archivo = time().'-'.$request->file('Buscador')->getClientOriginalName();
            $compromiso->archive = $request->file('Buscador')->storeAs('',$nombre_archivo, 'compromisos');
            //$comprimiso->date_implementation = "$date";
            //$compromiso->Archivo = $request->file('Buscador')->store('public');
            $compromiso->state = 1;
            $compromiso->detail = NULL;
            $compromiso->comment = NULL;
            $compromiso->save();
        }
        //dd($compromiso,$request->file('Buscador'));
        //return back()->with('estado', 'Actualizado');

        // PASTE
        $user = Auth::user()->id;
        $ejes = Eje::all();
        $estrategias = Estrategia::where('eje_id', $eje->id)->get();
        $acciones = Accion::all();
        $compromisos = Compromiso::where('user_id', $user)->get();
        $plantilla = "Evidencias Sujeto";

        return view('sujeto.EvidenciasSujetoEje', ['usuario' => $user, 'plantilla' => $plantilla, 'ejes' => $ejes, 'eje' => $eje, 'estrategias' => $estrategias, 'acciones' => $acciones, 'compromisos' => $compromisos]);
    }

    public function eliminar_evidencia(User $user, Eje $eje, $id){
        $ejes = Eje::all();
        $user2 = Auth::user()->id;
        $compromiso = Compromiso::where('id', $id)->first();
        //Storage::disk('compromisos')->delete($compromiso->Archivo);
        //Storage::delete('compromisos/' . $compromiso->Archivo);
        Storage::disk('compromisos')->delete($compromiso->archive);
        $compromiso->state = 0;
        $compromiso->detail = NULL;
        $compromiso->archive = NULL;
        $compromiso->comment = NULL;
        $compromiso->save();


        // PASTE
        $user = Auth::user()->id;
        $ejes = Eje::all();
        $estrategias = Estrategia::where('eje_id', $eje->id)->get();
        $acciones = Accion::all();
        $compromisos = Compromiso::where('user_id', $user)->get();
        $plantilla = "Evidencias Sujeto";

        return view('sujeto.EvidenciasSujetoEje', ['usuario' => $user, 'plantilla' => $plantilla, 'ejes' => $ejes, 'eje' => $eje, 'estrategias' => $estrategias, 'acciones' => $acciones, 'compromisos' => $compromisos]);
        //return back()->with(['estado' => 'Eliminado', 'deteccion' => $id]);
    }
    public function descargar_archivo($id) {
        $compromiso = Compromiso::where('id', $id)->first();
        //dd($compromiso);
        $nombre = $compromiso->archive;
        //$archivo = Storage::disk('compromisos')->get($nombre);
        //dd($archivo);
        //$archivo = public_path('compromisos')."\\"."$nombre";
        $ruta = Storage::disk('compromisos')->getDriver()->getAdapter()->getPathPrefix();
        $archivo = $ruta."\\$nombre";

        return Response::download($archivo, $nombre, array('Content-Type: application/zip','Content-Length: '. filesize($archivo)));
        //return Response::download($archivo);
    }

    public function user_pdf($id)
    {

        $user = User::where('id', $id)->first();
        // $compromiso = Compromiso::where('user_id', $id)->first();
        $compromisos = Compromiso::where('user_id', $id)->get(); //si falla poner paginate();

        $pdf = PDF::loadView('administrador.sujetos.pdf', ['user'=>$user,'compromisos'=>$compromisos]);
        // $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
        // return view('administrador.sujetos.pdf', compact('user','compromisos'));
    }
}
