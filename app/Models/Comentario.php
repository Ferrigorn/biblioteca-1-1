<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    //relacio amb usuaris i llibres
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function llibre()
    {
        return $this->belongsTo(Llibre::class);
    }
}
