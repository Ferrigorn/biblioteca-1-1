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

    public function valoraciones()
    {
        return $this->hasMany(Valoracion::class);
    }




    // Método para calcular la mediana de las valoraciones
    public function getMedianaValoracionesAttribute()
    {
        $ratings = $this->valoraciones()->pluck('rating')->sort()->values();

        if ($ratings->count() === 0) {
            return null; // No hay valoraciones
        }

        $middle = floor($ratings->count() / 2);

        if ($ratings->count() % 2) {
            // Si el número de valoraciones es impar
            return $ratings[$middle];
        } else {
            // Si el número de valoraciones es par, hacer el promedio de los dos valores centrales
            return ($ratings[$middle - 1] + $ratings[$middle]) / 2;
        }
    }

    // relació amb comentaris
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function usuaris()
    {
        return $this->belongsToMany(User::class, 'llibre_user');
    }
    //Deixar Llibre

    public function deixat()
    {
        return $this->hasOne(LlibreDeixat::class)->latest();
    }
}
