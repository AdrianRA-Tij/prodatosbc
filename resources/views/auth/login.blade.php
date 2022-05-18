<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PRODATOSBC</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- <script>
window.addEventListener('popstate', function(event) {
	history.pushState(null, null, window.location.pathname);
	history.pushState(null, null, window.location.pathname);
	}, false);
</script> -->
</head>

<body style="background:#F3F3F3;">
<!-- <div class="alert alert-danger" role="alert">
  <h1> CIERRA LAS PESTAÑAS PUERCO</h1>A simple danger alert—check it out!
</div> -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 row justify-content-center">
                 <img src="{{ asset('/images/logo_PRODATOS.fw.png') }}" width="350" loading="lazy" />
                <div class="card" style="height: 50rem;">
                    <div class="card-header" style="color: #BE3286;font-size:250%;font-family:inter;text-align:center"><b>Inicio de Sesión</b></div>

                    <div class="card-body row justify-content-center mt-4 mx-auto">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="input-group mt-4">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user mt-3"></i></span>
                                <input id="user" type="text" class="form-control @error('user') is-invalid @enderror input-lg" name="user" placeholder="Usuario" value="{{ old('user') }}" required autocomplete="user" autofocus>
                                @error('user')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="input-group mt-4">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror input-lg" name="password" placeholder="Contraseña" required autocomplete="current-password" >
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group ">
                                <div class=" mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg" style="background-color:#029395; width:350px;">
                                        {{ __('Iniciar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
</body>
