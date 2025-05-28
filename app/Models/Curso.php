<?php

namespace App\Models;

use App\Models\Nivel;
use App\Models\Turma;
use App\Models\Aluno;
use App\Models\Categoria;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';

    protected $fillable = [
        'nome',
        'sigla',
        'total_horas',
        'nivel_id',
        'eixo_id',
    ];

    public function nivel() {
        return $this->belongsTo(Nivel::class);
    }

    public function eixo() {
        return $this->belongsTo(Eixo::class);
    }

    public function turmas() {
        return $this->hasMany(Turma::class);
    }

    public function aluno() {
        return $this->belongsTo(Aluno::class);
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }
}
