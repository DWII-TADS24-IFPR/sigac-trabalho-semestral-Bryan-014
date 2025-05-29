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
        'documento_id',
        'categoria_id',
        'aluno_id',
    ];

    public function documento() {
        return $this->belongsTo(Documento::class);
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function aluno() {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    public function declaracao() {
        return $this->belongsTo(Declaracao::class);
    }
}
