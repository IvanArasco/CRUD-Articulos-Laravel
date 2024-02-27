<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Listado Artículos</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

</head>

<body class="antialiased">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h2 class="card-header">Inicio de Sesión</h2>

                    <div class="card-body">
                        <form method="POST" action="{{ route('iniciarSesion') }}">
                            @csrf

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Correo
                                    Electrónico:</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"> Contraseña:
                                </label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary"> Iniciar Sesión </button>
                                    <a href="{{ route('register') }}"
                                        class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Crear
                                        cuenta</a>
                                </div>
                            </div>
                            <a href="/index" class="btn btn-primary">Volver</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>