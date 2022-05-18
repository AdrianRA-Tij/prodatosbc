<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Accion;
use App\Models\Estrategia;
use App\Models\Problematica;
use App\Models\Eje;


class EjeEstrategiaAccion extends Component
{
    public $ejes;
    public $problematicas;
    public $estrategias;
    public $acciones;

    public $selectedEje = NULL;
    public $selectedProblematica = NULL;
    public $selectedEstrategia = NULL;
    public $selectedAccion = NULL;

    public function mount($selectedAccion = null){
        $this->ejes = Eje::all();
        $this->problematicas = collect();
        $this->estrategias = collect();
        $this->acciones = collect();
        $this->selectedAcciones = $selectedAccion;
        
        if (!is_null($selectedAccion)) {
            $accion = Accion::with('estrategia.eje')->find($selectedAccion);
            if ($accion) {
                $this->acciones = Accion::where('estrategia_id', $accion->estrategia_id)->get();
                $this->estrategias = Estrategia::where('problematica_id', $accion->estrategia->problematica_id)->get();
                $this->Problematicas = Problematicas::where('eje_id', $accion->estrategia->problematica->eje_id)->get();
                $this->selectedEje = $accion->estrategia->problematica->eje_id;
                $this->selectedProblematica = $accion->estrategia->problematica_id;
                $this->selectedEstrategia = $accion->estrategia_id;
            }
        }
    }
    
    public function render()
    {

        return view('livewire.eje-estrategia-accion');
    }
    public function updatedSelectedEje($eje)
    {
        $this->problematicas = Problematica::where('eje_id', $eje)->get();
        $this->selectedProblematica = NULL;
    }

    public function updatedSelectedProblematica($problematica)
    {
        $this->estrategias = Estrategia::where('problematica_id', $problematica)->get();
        $this->selectedEstrategias = NULL;
    }

    public function updatedSelectedEstrategia($estrategia)
    {
        if (!is_null($estrategia)) {
            $this->acciones = Accion::where('estrategia_id', $estrategia)->get();
        }
    }
}
