<!----------MODAL-EDITAR/ACCION--------->
<div class="modal fade" id="modal-editar-compromiso-{{ $compromiso->id }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modificar compromiso</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" arial-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('compromiso.update', $compromiso) }}" method="POST">
                 @csrf @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="accion_id" class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;">Acción</label>
                            <select name="accion_id" id="accion_id" class="form-select" aria-label="Default select example" disabled>
                                <option >--  Elige una accion --</option>
                                @foreach ($acciones as $accion)
                                <option  value="{{$accion -> id}}" {{$accion ->id == $compromiso -> accion_id ? 'selected' : '' }}>{{ $accion -> name }}</option>
                                @endforeach
                                @error('accion_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </select>
                        </div>
                        <div>
                            <label for="action_plan">Plan de accion</label>
                            <textarea  name="action_plan" id="action_plan"  class="form-control @error('action_plan') is-invalid @enderror" type="text" rows="8" >{{$compromiso->action_plan}}</textarea>
                            @error('action_plan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer" justify-content-between>
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-outline-primary" data-dismiss="modal" style="color: white; background:#059B97;">Actualizar</button>
                    </div>
            </form>
        </div>
    </div>
</div>