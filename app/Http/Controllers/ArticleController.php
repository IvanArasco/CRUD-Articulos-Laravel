<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function index()
    {
        $carrito = session('carrito', []);
        $articles = Article::paginate(5);

        // Pasamos los artículos a la vista
        return view('index', ['articles' => $articles, 'carrito' => $carrito]);
    }

    public function show($id)
    {
        $article = Article::with('categories')->find($id);

        if (!$article) {
            abort(404);
        }
        return view('articleShow', ['article' => $article]);
    }

    public function showWithSlug($category_name, $slug)
    {

        // recibir el ID de la categoría a traves del nombre pasado como parámetro (por la URL)
        $categoria = Category::where('name', $category_name)->first();

        if ($categoria) {
            $idCategoria = $categoria->id;

            /* mirarlo en la tabla pivot y devolver cada uno de los IDS de artículos que tienen esa categoryID.
            y recibir tan solo el artículo que tiene ese slug. */

            $article = Article::whereHas('categories', function ($query) use ($idCategoria) {
                $query->where('category_id', $idCategoria);
            })->where('slug', $slug)->first();

            if (!$article) {
                abort(404);
            }
            return view('articleShow', ['article' => $article]);
        } else {
            abort(404);
        }

    }

    public function crearArticulo(Request $request)
    {
        // cada uno de los checkboxes marcados. Si hay varias opciones creará registros para cada una.
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'categorias' => 'required',
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->setSlugAttribute($article->title); // formatea el Slug en función de los estándares.

        $article->save();

        $categoriasSeleccionadas = $request->input('categorias', []);

        $article->categories()->attach($categoriasSeleccionadas); // se insertan como un nuevo registro en la tabla intermedia (pivot) 

        return redirect()->route('article.show', ['id' => $article->id]);

    }

    public function editarArticulo($id)
    {
        $article = Article::findOrFail($id);

        return view('editArticulo', ['article' => $article]);
    }
    public function update(Request $request, $id)
    {

        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'categorias' => 'required',
        ]);

        $article->setSlugAttribute($request->title);
        $categoriasSeleccionadas = $request->input('categorias', []);
        $article->categories()->sync($categoriasSeleccionadas);
        $article->update($request->all());

        return redirect('index');
    }
    public function eliminarArticulo($id)
    {
        $article = Article::find($id);
        if ($article) {
            $article->delete();
            return redirect('index');
        } else {
            abort(404);
        }
    }

    public function indexNovedades()
    {
        // realizar la consulta directamente de los que tengan la categoria Novedades
        $articles = Article::whereHas('categories', function ($query) {
            $query->where('category_id', 2);
        })->get();

        // Pasamos los artículos a la vista
        return view('novedades', ['articles' => $articles]);
    }

    public function agregarCarrito(Request $request, $idArticulo)
    {
        $article = Article::findOrFail($idArticulo);

        $carrito = $request->session()->get('carrito', []);

        $carrito[] = [
            'id' => $idArticulo,
            'title' => $article->title,
            'content' => $article->content,
            //'categorias' => $article->categorias(),
            'slug' => $article->slug,
        ];

        $request->session()->put('carrito', $carrito); // actualizamos la variable de sesión

        return redirect('/carrito');

    }

    public function verCarrito(Request $request)
    {
        $carrito = session('carrito', []);
        return view('carrito', ['carrito' => $carrito]);
    }

    public function deleteArticleCarrito(Request $request, $idArticulo)
    {

        $carrito = session('carrito', []);
        unset($carrito[$idArticulo]);

        session(['carrito' => $carrito]);

        return redirect('/carrito');

    }


}