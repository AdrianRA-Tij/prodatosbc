<?php

namespace App\Http\Controllers;
use App\Models\Accion;
use App\Models\Estrategia;
use App\Models\Eje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->middleware('EsAdmin');
        $this->middleware('auth');
    }
    public function index()
    {
        $estrategias = Estrategia::all();
        $acciones = Accion::orderBy('estrategia_id','asc')->paginate(8);
        return view('administrador.acciones.acciones', ['acciones' => $acciones, 'estrategias' => $estrategias]);
        //return view('ejes.nueva_accionx', compact('acciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estrategias = Estrategia::all();
        return view('administrador.acciones.nueva_accion', compact('estrategias'));
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
            'name' => ['required', 'string', 'max:500', 'unique:accions'], //'max:255',
            'estrategia_id' => ['required'],
        ],[
             'estrategia_id.required' => 'El campo línea estratégica es obligatorio',
             'name.unique' => 'La línea de acción ya existe'
        ]);

        Accion::create([
            'name' => $request->name,
            'estrategia_id' => $request->estrategia_id,
            'state' => '1',
        ]);
        return redirect()->route('acciones.index')->with('status', 'Guardado con exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accion = Accion::find($id);
        $estrategias = Estrategia::all();
        return view('administrador.acciones.editar_accion', compact('estrategias', 'accion'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accion $accion)
    {
        $request->validate([
            'name' => ['required', 'max:500', 'string'], //, 'max:255'
            'estrategia_id' => ['required'],
        ],[
             'estrategia_id.required' => 'El campo línea estratégica es obligatorio'
        ]);

        $accion->update([
            'name' => request('name'),
            'description' => request('description'),
            'estrategia_id' =>request('estrategia_id'),

        ]);
        return  redirect()->route('acciones.index')->with('status_update', 'Actualizado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $accion_id)
    {

        $accion = Accion::find($accion_id); //Encuentra el dato con el id
        $accion->delete();
        return back()->with('status_delete', 'Eliminado con éxito');
    }
}
