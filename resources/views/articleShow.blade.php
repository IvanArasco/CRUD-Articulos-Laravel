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
    <div class="container mt-5" style="margin: 30px 0 50px 100px">
        <h2> Vista del artículo: {{ $article->title }} </h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categorías</th>
                    <th>Contenido</th>
                    <th>Slug</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->title }}</td>
                    <td>
                        @foreach ($article->categories as $articleCategory)
                        {{ $articleCategory->name}}
                        @endforeach
                    </td>
                    <td> {{ $article->content }} </td>
                    <td> {{ $article->slug }} </td>
                </tr>

            </tbody>
        </table>

    </div>

</body>

</html>