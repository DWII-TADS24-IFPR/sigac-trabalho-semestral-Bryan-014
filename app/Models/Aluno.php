<?php

namespace App\Models;

use App\Models\Comprovante;
use App\Models\Curso;
use App\Models\Declaracao;
use App\Models\Turma;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $table = 'alunos';

    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'senha',
        'user_id',
        'curso_id',
        'turma_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function cursos() {
        return $this->hasMany(Curso::class);
    }

    public function turmas() {
        return $this->hasMany(Turma::class);
    }

    public function comprovante() {
        return $this->belongsTo(Comprovante::class);
    }

    public function declaracao() {
        return $this->belongsTo(Declaracao::class);
    }
}
