<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'id',
        'nome'
    ];

    public function users() {
        return $this->hasMany(Curso::class);
    }
}
