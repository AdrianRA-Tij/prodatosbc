<!----------MODAL-NUEVO/EJE--------->
<div class="modal fade" id="modal-create-eje">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Nuevo eje </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" arial-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ route('eje.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="mt-2">
                            <label for="number" class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;"> Numero del eje</label>
                            <input type="text" name="number" class="form-control @error('number') is-invalid @enderror" id="number" placeholder="Numero del eje"  required>{{ old('number') }}</input>
                            @error('number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="name" class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;"> Nombre</label>
                            <textarea type="text" name="name" cols="20" rows="5" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nombre del eje"  required>{{ old('name') }}</textarea>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="description" class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;">Objetivo</label>
                            <textarea name="description" id="description" type="text" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10" placeholder="Objetivo del eje"  required>{{ old('description') }}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer" justify-content-between>
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                @csrf
                <button type="submit" class="btn btn-outline-primary" data-dismiss="modal" style="color: white; background:#059B97;">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>
