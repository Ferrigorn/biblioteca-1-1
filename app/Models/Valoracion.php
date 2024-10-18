<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Valoracion extends Model
{
    use HasFactory;

    protected $table = 'valoraciones';

    protected $fillable = ['llibre_id', 'user_id', 'rating'];

    public function llibre()
    {
        return $this->belongsTo(Llibre::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Si tienes una tabla de usuarios
    }
}
