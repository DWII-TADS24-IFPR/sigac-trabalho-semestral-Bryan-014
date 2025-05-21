<?php

namespace App\Models;

use App\Models\Curso;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    protected $table = 'niveis';

    protected $fillable = [
        'nome',
    ];

    public function curso() {
        return $this->belongsTo(Curso::class);
    }
}
