<?php

namespace App\Http\Controllers;
use App\Models\Estrategia;
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

        $estrategias = Estrategia::paginate(8);
        return view('administrador.estrategias.estrategias', compact('estrategias', 'ejes'));
        

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
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:estrategias'],
            'description' => ['required', 'string', 'max:255'],
            'eje_id' => ['required'],
        ],[
            'eje_id.required' => 'El campo eje es obligatorio',
             'name.unique' => 'La línea estratégica ya existe'
        ]);

        Estrategia::create([
            'name' => $request->name,
            'description' => $request->description,
            'eje_id' => $request->eje_id,
            'state' => '1',
        ]);
        return back()->with('status', 'Creado con exito');
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'eje_id' => ['required'],
        ],[
            'eje_id.required' => 'El campo eje es obligatorio',
        ]);
        $estrategia->update([
            'name' => request('name'),
            'description' => request('description'),
            'eje_id' =>request('eje_id'),

        ]);

        return back()->with('status_update', 'Editado con éxito');
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
        return Estrategia::where('eje_id', $id)->get();
    }
}
