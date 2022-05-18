<!----------MODAL-NUEVO/EJE--------->
<div class="modal fade" id="modal-create-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Sujeto Obligado </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" arial-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="form-group">

                        <div  class="mt-2">
                            <label for="number_user"  class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;">ID </label>
                            <input name="number_user" type="text" id="number_user"  class="form-control  @error('number_user') is-invalid @enderror"  placeholder="ID del sujeto obligado" value="{{ old('number_user') }}" required>
                            @error('number_user')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div  class="mt-2">
                            <label for="username"  class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;">Sujeto obligado</label>
                            <textarea type="text"  id="username" name="username" cols="20" rows="1" class="form-control @error('username') is-invalid @enderror" placeholder="Nombre del sujeto obligado"  required>{{ old('username') }}</textarea>
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div  class="mt-2">
                            <label for="user"  class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;">Usuario del SO</label>
                            <input type="text"  id="user" name="user" class="form-control @error('user') is-invalid @enderror" placeholder="Usuario del sujeto obligado" value="{{ old('user') }}" required>
                            @error('user')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div  class="mt-3"  >
                            <label for="password" class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;">Contraseña</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Contraseña" autocomplete="new-password" required >
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mt-3" >
                            <label for="password-confirm" class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;">Confirmar contraseña</label>
                            <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirmar contraseña" autocomplete="new-password" required>
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div  class="mt-2">
                            <label for="name" class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;">Nombre del oficial</label>
                            <input type="text" minlength="8" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre del oficial de protección de datos personales " value="{{ old('name') }}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div  class="mt-2">
                            <label for="email"  class="col-md-4 col-form-label" style="font-size:120%;font-family:inter;">Correo electónico </label>
                            <input name="email" type="email" id="email"  class="form-control  @error('email') is-invalid @enderror"  placeholder="Correo electónico del sujeto obligado" value="{{ old('email') }}" required>
                            @error('email')
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
                <button type="submit" class="btn btn-outline-primary" data-dismiss="modal" style="color: white; background:#059B97;">Crear</button>
            </div>
            </form>
        </div>
    </div>
</div>
