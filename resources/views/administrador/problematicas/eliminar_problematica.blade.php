<!----------MODAL-ELIMINAR/ACCION--------->
<div class="modal fade" id="modal-eliminar-problematica-{{ $problematica->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Eliminar Problematica </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" arial-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('problematica.destroy', $problematica->id) }}" method="POST">
                {{ csrf_field() }} {{ method_field('DELETE') }}
                <div class="modal-body">
                    <div class="form-group">
                    ¿Esta seguro(a) que quiere eliminar {{$problematica->name}}?

                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer" justify-content-between>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-primary" data-dismiss="modal" style="color: white; background:#059B97;">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>