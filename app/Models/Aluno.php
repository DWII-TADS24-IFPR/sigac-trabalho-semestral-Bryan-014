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

    public function curso() {
        return $this->belongsTo(Curso::class);
    }

    public function turma() {
        return $this->belongsTo(Turma::class);
    }

    public function comprovantes() {
        return $this->hasMany(Comprovante::class, 'aluno_id');
    }

    public function declaracoes() {
        return $this->hasMany(Declaracao::class);
    }
}
