<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pessoa;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pessoa::create([
            "nome" => "Bryan Rosa da Silveira",
            "idade" => 21,
            "cpf" => "137.309.219-08",
        ]);
    }
}
