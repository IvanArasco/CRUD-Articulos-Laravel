<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        $title = $this->faker->sentence;

        return [
            'title' => $title,
            'content' => $this->faker->paragraph,
            'slug' => Str::slug($title), // para que el slug se base en el title
        ];

    }

    public function configure()
    {
        return $this->afterCreating(function (Article $article) {
            $categoryIds = Category::all()->random(2)->pluck('id')->toArray();
            $article->categories()->attach($categoryIds);
        });
    }
}