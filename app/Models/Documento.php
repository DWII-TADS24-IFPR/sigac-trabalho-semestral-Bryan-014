<?php

namespace App\Models;

use App\Models\Categoria;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';

    protected $fillable = [
        'url',
        'descricao',
        'horas_in',
        'status',
        'comentario',
        'horas_out',
        'categoria_id',
    ];

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }
}
