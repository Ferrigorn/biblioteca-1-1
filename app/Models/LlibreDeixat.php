<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LlibreDeixat extends Model
{
    use HasFactory;

    protected $fillable = ['llibre_id', 'a_qui', 'quan'];
    protected $table = 'llibres_deixats';

    public function llibre()
    {
        return $this->belongsTo(Llibre::class);
    }
}
