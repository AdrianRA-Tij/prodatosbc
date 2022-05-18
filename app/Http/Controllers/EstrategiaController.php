<?php

namespace App\Http\Controllers;
use App\Models\Estrategia;
use App\Models\Problematica;
use App\Models\Eje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstrategiaController extends Controller
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
        $ejes = Eje::all();
        $problematicas = Problematica::all();
        $estrategias = Estrategia::orderBy('problematica_id','asc')->paginate(8);
        return view('administrador.estrategias.estrategias', compact('estrategias', 'problematicas'));
        

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $problematicas= Problematica::all();
        return view('administrador.estrategias.nueva_estrategia', compact('problematicas'));
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
            'number' => ['required', 'string', 'max:255',],
            'name' => ['required', 'string', 'max:255', 'unique:estrategias'],
            'problematica_id' => ['required'],
        ],[
            'number.required'=> 'El campo numero de la estrategia es obligatorio.',
            'problematica_id.required' => 'El campo problematica es obligatorio',
            'name.unique' => 'La línea estratégica ya existe'
        ]);

        Estrategia::create([
            'number' => $request->number,
            'name' => $request->name,
            'problematica_id' => $request->problematica_id,
            'state' => '1',
        ]);
        return redirect()->route('estrategias.index')->with('status', 'Guardado con exito');

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
        $estrategia = Estrategia::find($id);
        $problematicas = Problematica::all();
        return view('administrador.estrategias.editar_estrategia', compact('estrategia', 'problematicas'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Responses
     */
    public function update(Request $request, Estrategia $estrategia)
    {

        $request->validate([
            'number' => ['required', 'string', 'max:255',],
            'name' => ['required', 'string', 'max:255'],
            'problematica_id' => ['required'],
        ],[
            'number.required'=> 'El campo numero de la estrategia es obligatorio.',
            'problematica_id.required' => 'El campo problematica es obligatorio',
        ]);
        $estrategia->update([
            'number' => request('number'),
            'name' => request('name'),
            'problematica_id' =>request('problematica_id'),

        ]);

        return  redirect()->route('estrategias.index')->with('status_update', 'Actualizado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $estrategia_id)
    {
        $estrategia = Estrategia::find($estrategia_id);//Encuentra el dato con el id
        $estrategia->delete();
        return back()->with('status_delete', 'Eliminado con éxito');
    }
    public function byProject($id){
        return Estrategia::where('problematica_id', $id)->get();
    }
}
