<?php

namespace App\Models;

use App\Models\Aluno;
use App\Models\Comprovante;

use Illuminate\Database\Eloquent\Model;

class Declaracao extends Model
{
    protected $table = 'declaracoes';

    protected $fillable = [
        'hash',
        'data',
        'comprovante_id',
    ];

    public function comprovantes() {
        return $this->hasMany(Comprovante::class);
    }

    public function alunos() {
        return $this->hasMany(Aluno::class);
    }
}
