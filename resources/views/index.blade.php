<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Listado Artículos</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

</head>

<body>
    <div style="margin: 30px 0 50px 100px">
        @if (Route::has('login'))
        @auth

        <h2> Bienvenid@ {{Auth::user()->name}}</h2>
        <a href="{{ route('article.create') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Crear
            Artículo</a>
        <a href="{{ route('logout') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Cerrar
            sesión</a>
        @else
        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Iniciar Sesión</a>

        @if (Route::has('register'))
        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Crear
            cuenta</a>
        @endif

        @endauth
        @endif

        <div>
            <!-- Comprobamos si hay artículos. Si los hay, los muestra -->
            @if(filled($articles))
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->title }}</td>

                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('article.show', $article->id) }}" method="POST">
                                    <input type="hidden" name="_method" value="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-info">Ver</button>
                                </form>

                                @auth
                                <form action="{{ route('article.edit', $article->id) }}" method="POST">
                                    <input type="hidden" name="_method" value="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Editar</button>
                                </form>

                                <form action="{{ route('carrito.add', $article->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary">Agregar al carrito</button>
                                </form>

                                <form action="{{ route('article.delete', $article->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>

                                @endauth
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $articles->links('pagination::bootstrap-4') }}
            @else
            <h2>No existen artículos.</h2>
            @endif

        </div>
    </div>
</body>

</html>