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
        @auth
        <h2> Carrito de compra de: {{Auth::user()->name}}</h2>
        @endauth
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($carrito as $article)
                    <tr>
                        <td>{{ $article['id'] }}</td>
                        <td>{{ $article['title'] }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('article.show', $article['id']) }}" method="POST">
                                    <input type="hidden" name="_method" value="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-info">Ver</button>
                                </form>
                                <form action="{{ route('carrito.deleteArticleCarrito', $article['id']) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar del carrito</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <a href="/index" class="btn btn-primary">Volver</a>
        <a href="/index" class="btn btn-info">Pagar</a>
    </div>
</body>

</html>