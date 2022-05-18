<div>
    <div class="form-group">
        <label for="eje" class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;">Eje</label>
        <select wire:model="selectedEje" class="form-control" required>
            <option selected>-- Elige un eje --</option>
            @foreach($ejes as $eje)
            <option value="{{ $eje->id }}"  >{{ $eje->number }}</option>
            @endforeach
        </select>
    </div>
    @if (!is_null($selectedEje))
    <div class="form-group select">
        <label for="problematica" class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;">Problematica</label>
        <select wire:model="selectedProblematica" class="form-control" required>
            <option  selected>-- Elige una Problematica --</option>
            @foreach($problematicas as $problematica)
            <option value="{{ $problematica->id }}">{{ $problematica->number }}</option>
            @endforeach
        </select>
    </div>

    @endif
    @if (!is_null($selectedProblematica))
    <div class="form-group select">
        <label for="estrategia" class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;">Línea estratégica</label>
        <select wire:model="selectedEstrategia" class="form-control" required>
            <option  selected>-- Elige una línea estratégica --</option>
            @foreach($estrategias as $estrategia)
            <option value="{{ $estrategia->id }}">{{ $estrategia->number }}</option>
            @endforeach
        </select>
    </div>
    @endif

    @if (!is_null($selectedEstrategia))
    <div class="form-group">
        <label for="accion" class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;">Línea de acción</label>
        
        <select wire:model="selectedAccion"  class="form-control @error('accion_id') is-invalid @enderror" name="accion_id" required> 
            <option value="" selected>-- Elige una línea de acción --</option>
            @foreach($acciones as $accion)
            <option value="{{ $accion->id }}">{{ $accion->number }}</option>
            @endforeach
        </select>
        @error('accion_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    @endif
</div>

