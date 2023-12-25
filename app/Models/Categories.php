<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', // noticias, novedades y anuncios
        'slug',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }


}