<?php

namespace App\Models;

use App\Models\Aluno;
use App\Models\Categoria;
use App\Models\Declaracao;

use Illuminate\Database\Eloquent\Model;

class Comprovante extends Model
{
    protected $table = 'comprovantes';

    protected $fillable = [
        'horas',
        'atividade',
        'categoria_id',
        'aluno_id',
    ];

    public function categorias() {
        return $this->hasMany(Categoria::class);
    }

    public function alunos() {
        return $this->hasMany(Aluno::class);
    }

    public function declaracao() {
        return $this->belongsTo(Declaracao::class);
    }
}
