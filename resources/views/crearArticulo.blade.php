<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Listado Artículos</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

</head>

<body class="antialiased text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6" style="margin-top: 20%">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class=" card">
                    <h2 class="card-header">Creación de un Artículo</h2>

                    <div class="card-body">
                        <form method="POST" action="{{ route('article.create') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"> Título: </label>
                                <div class="col-md-6">
                                    <input id=" title" type="title" class="form-control" name="title"
                                        value="{{ old('title') }}" autocomplete="title" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Categoría:</label>
                                <div style="align-self: center">
                                    <input type="checkbox" name="categorias[]" value=1 {{ in_array(1, old('categorias',
                                        [])) ? 'checked' : '' }}> Noticias
                                    <input type="checkbox" name="categorias[]" value=2 {{ in_array(2, old('categorias',
                                        [])) ? 'checked' : '' }}> Novedades
                                    <input type="checkbox" name="categorias[]" value=3 {{ in_array(3, old('categorias',
                                        [])) ? 'checked' : '' }}> Anuncios
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right"> Contenido: </label>

                                <div class="col-md-6">
                                    <input id="content" type="title" class="form-control" name="content"
                                        value="{{ old('content') }}" autocomplete="content" autofocus>
                                </div>

                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary center"> Enviar nuevo artículo
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>