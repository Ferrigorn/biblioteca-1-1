<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    // relació amb user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relació amb llibre
    public function llibre()
    {
        return $this->belongsTo(Llibre::class);
    }
}
