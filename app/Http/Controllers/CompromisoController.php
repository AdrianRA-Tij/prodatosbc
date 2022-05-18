<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use App\Models\Accion;
use App\Models\Compromiso;
use App\Models\Estrategia;
use App\Models\Problematica;
use App\Models\Eje;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;
use Illuminate\Support\Facades\Auth;

class CompromisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       
        $user  = Auth::user()->id;
        $estrategias = Estrategia::all();
        $problematicas = Problematica::all();
        $ejes = Eje::all();
        $acciones = Accion::all();
       // $data = User::where('slug', $user)->get();

        $compromisos = Compromiso::where('user_id', Auth::user()->id)->orderBy('accion_id','asc')->paginate(8);
        //dd(User::all());
        //dd(Auth::user()->id, Compromiso::where('user_id', Auth::user()->id)->get());
        return view('sujeto.compromisos', compact('problematicas', 'compromisos', 'user','ejes', 'acciones', 'estrategias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sujeto.nuevo_compromiso');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'action_plan' => ['required', 'string'],
            'user_id' =>['required'],
            'accion_id' =>['required'],
        ],[
            'action_plan.required' => 'El campo descripción de la actividad es obligatorio.'
        ]);

        Compromiso::create([

            'action_plan' => $request->action_plan,
            'user_id' =>$request->user_id,
            'state' => '1',
            'accion_id' =>$request->accion_id,

        ]);
        
        return redirect()->route('compromiso.index')->with('status', 'Guardado con exito');


        /*$data = BD::table('accions')->where('id');
        DB::table('users')->where('votes', '>', 100)->dd();*/

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
    public function update(Request $request, Compromiso $compromiso)
    {
        $request->validate([

            'action_plan' => ['required', 'string'],
        ],[
            'action_plan.required' => 'El campo descripción de la actividad es obligatorio.'
        ]);
        $compromiso->update([
            'action_plan' => request('action_plan'),
            'state' => '1',
 
         ]);
         return  redirect()->route('compromiso.index')->with('status_update', 'Actualizado con éxito');

        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($compromiso)
    {
        $data = Compromiso::find($compromiso);//Encuentra el dato con el id
        $data->delete();
        return back()->with('status_delete', 'Eliminado con éxito');
    }
    public function subirCompromiso(Request $request, Compromiso $compromiso)
    {
        $request->validate([

            'action_plan' => ['required', 'string'],
        ],[
            'action_plan.required' => 'El campo descripción de la actividad es obligatorio.'
        ]);
        $compromiso->update([
            'action_plan' => request('action_plan'),
            'state' => '1',
 
         ]);
         return back()->with('status_update', 'Actualizado con éxito');
    }


    /*public function compromisos($id){
        $data = FacadesDB::table('accions')->where('estrategia_id', $id)->get();
        echo json_encode($data);

        return view('sujeto.implementacion', ['data' => $data]);
    }*/
}
