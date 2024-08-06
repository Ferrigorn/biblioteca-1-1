<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Llibre extends Model
{
    use HasFactory;

    protected $fillable = [
        'titol',
        'autor',
        'editorial',
        'anyEdicio',
        'genere',
        'ubicacio',
        'idioma',
        'coleccio',
        'portada',
    ];
}
