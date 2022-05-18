<?php

namespace App\Http\Controllers;
use App\Models\Eje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EjeController extends Controller
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
        $ejes = Eje::orderBy('name','asc')->paginate(8);//Consulto los datos
        return view('administrador.ejes.ejes', [//Cargo la vista 
            'ejes'=> $ejes//Pasamos los datos
        ]);
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
            'number' => ['required', 'string', 'max:255', 'unique:ejes', ],
            'name' => ['required', 'string', 'max:255', 'unique:ejes', ],
            'description' => ['required', 'string'],
        ],[
            'number.required'=> 'El campo numero del eje es obligatorio.',
            'description.required'=> 'El campo objetivo es obligatorio.',
            'name.unique' => 'El eje ya existe',
            'number.unique' => 'El eje ya existe'
        ]);

        Eje::create([
            'number' => $request->number,
            'name' => $request->name,
            'description' => $request->description,
            'state' => '1',
        ]);

        return back()->with('status', 'Creado con éxito');
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
    public function edit(Eje $eje)
    {
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Eje $eje)
    {
        $request->validate([
            'number' => ['required', 'string', 'max:255',],
            'name' => ['required', 'string', 'max:255',],
            'description' => ['required', 'string'],
        ],[
            'number.required'=> 'El campo numero del eje es obligatorio.',
            'description.required'=> 'El campo objetivo es obligatorio.',
        ]);
        $eje->update([
            'number' => $request->number,
            'name' => request('name'),
            'description' => request('description'),

        ]);
        return back()->with('status_update', 'Actualizado con éxito');
        
    }



        // Update the post...

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $eje_id)
    {
        $ejes= Eje::find($eje_id);//Encuentra el dato con el id
        $ejes->delete();
        return back()->with('status_delete', 'Eliminado con éxito');
    }
}
