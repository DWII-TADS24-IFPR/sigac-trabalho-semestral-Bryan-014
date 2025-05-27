<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'nome' => 'Administrador'
        ]);

        User::create([
            'name' => 'Coordenador',
            'email' => 'cord@gmail.com',
            'password' => Hash::make('123cord123'),
            'role_id' => 1
        ]);

        Role::create([
            'nome' => 'Aluno'
        ]);
    }
}
