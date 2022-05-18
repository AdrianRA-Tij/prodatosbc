<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eje;
use App\Models\Problematica;
use Illuminate\Support\Facades\DB;

class ProblematicasController extends Controller
{
    public function __construct()
    {

        $this->middleware('EsAdmin');
        $this->middleware('auth');
    }

    public function index()
    {

        $ejes = Eje::all();
        $problematicas = Problematica::orderBy('eje_id','asc')->paginate(8);
        return view('administrador.problematicas.problematicas', compact('problematicas', 'ejes'));
    }

    public function create()
    {
        $ejes= Eje::all();
        return view('administrador.problematicas.nueva_problematica', compact('ejes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => ['required', 'string', 'max:255',],
            'name' => ['required', 'string', 'max:255', 'unique:problematicas'],
            'eje_id' => ['required'],
        ],[
            'number.required'=> 'El campo numero de la problematica es obligatorio.',
            'eje_id.required' => 'El campo eje es obligatorio',
            'name.unique' => 'La Problematica ya existe'
        ]);

        Problematica::create([
            'number' => $request->number,
            'name' => $request->name,
            'eje_id' => $request->eje_id,
            'state' => '1',
        ]);
        return redirect()->route('problematicas.index')->with('status', 'Guardado con exito');

    }

    public function edit($id)
    {
        $problematica = Problematica::find($id);
        $ejes = Eje::all();
        return view('administrador.problematicas.editar_problematica', compact('problematica', 'ejes'));
        
    }

    public function update(Request $request, Problematica $problematica)
    {

        $request->validate([
            'number' => ['required', 'string', 'max:255',],
            'name' => ['required', 'string', 'max:255'],
            'eje_id' => ['required'],
        ],[
            'number.required'=> 'El campo numero de la problematica es obligatorio.',
            'eje_id.required' => 'El campo eje es obligatorio',
        ]);
        $problematica->update([
            'number' => request('number'),
            'name' => request('name'),
            'eje_id' =>request('eje_id'),

        ]);

        return  redirect()->route('problematicas.index')->with('status_update', 'Actualizado con éxito');

    }

    public function destroy(Request $request, $problematica_id)
    {
        $problematica = Problematica::find($problematica_id);//Encuentra el dato con el id
        $problematica->delete();
        return back()->with('status_delete', 'Eliminado con éxito');
    }
}
