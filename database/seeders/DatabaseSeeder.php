<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Categoria;
use App\Models\Comprovante;
use App\Models\Curso;
use App\Models\Declaracao;
use App\Models\Documento;
use App\Models\Eixo;
use App\Models\Nivel;
use App\Models\Turma;
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

        Role::create([
            'nome' => 'Aluno'
        ]);

        User::create([
            'name' => 'Coordenador',
            'email' => 'cord@gmail.com',
            'password' => Hash::make('123cord123'),
            'role_id' => 1
        ]);

        Eixo::create([
            'nome' => 'Ambiental'
        ]);

        Eixo::create([
            'nome' => 'Informatica'
        ]);

        Eixo::create([
            'nome' => 'Mecânica'
        ]);

        Eixo::create([
            'nome' => 'Ciências'
        ]);

        Nivel::create([
            'nome' => 'Graduação'
        ]);

        Nivel::create([
            'nome' => 'Técnico'
        ]);
        
        Categoria::create([
            'nome' => 'Cat 1',
            'maximo_horas' => 1
        ]);
        
        Categoria::create([
            'nome' => 'Cat 2',
            'maximo_horas' => 3
        ]);
        
        Categoria::create([
            'nome' => 'Cat 3',
            'maximo_horas' => 5
        ]);
        
        Categoria::create([
            'nome' => 'Cat 4',
            'maximo_horas' => 10
        ]);

        Curso::create([
            'nome' => 'Técnico em Mecânica',
            'sigla' => 'MEC',
            'total_horas' => 150,
            'nivel_id' => 2,
            'eixo_id' => 3,
        ]);

        Turma::create([
            'ano' => '2022',
            'curso_id' => 1
        ]);
        Turma::create([
            'ano' => '2023',
            'curso_id' => 1
        ]);
        Turma::create([
            'ano' => '2024',
            'curso_id' => 1
        ]);
        Turma::create([
            'ano' => '2025',
            'curso_id' => 1
        ]);

        Curso::create([
            'nome' => 'Técnico em Informática',
            'sigla' => 'INFO',
            'total_horas' => 150,
            'nivel_id' => 2,
            'eixo_id' => 2,
        ]);

        Turma::create([
            'ano' => '2022',
            'curso_id' => 2
        ]);
        Turma::create([
            'ano' => '2023',
            'curso_id' => 2
        ]);
        Turma::create([
            'ano' => '2024',
            'curso_id' => 2
        ]);
        Turma::create([
            'ano' => '2025',
            'curso_id' => 2
        ]);

        Curso::create([
            'nome' => 'Técnico em Meio Ambiente',
            'sigla' => 'MAMB',
            'total_horas' => 150,
            'nivel_id' => 2,
            'eixo_id' => 1,
        ]);

        Turma::create([
            'ano' => '2022',
            'curso_id' => 3
        ]);
        Turma::create([
            'ano' => '2023',
            'curso_id' => 3
        ]);
        Turma::create([
            'ano' => '2024',
            'curso_id' => 3
        ]);
        Turma::create([
            'ano' => '2025',
            'curso_id' => 3
        ]);

        Curso::create([
            'nome' => 'Técnico em Produção Cultural',
            'sigla' => 'TCP',
            'total_horas' => 150,
            'nivel_id' => 2,
            'eixo_id' => 4,
        ]);

        Turma::create([
            'ano' => '2022',
            'curso_id' => 4
        ]);
        Turma::create([
            'ano' => '2023',
            'curso_id' => 4
        ]);
        Turma::create([
            'ano' => '2024',
            'curso_id' => 4
        ]);
        Turma::create([
            'ano' => '2025',
            'curso_id' => 4
        ]);

        Curso::create([
            'nome' => 'Tecnologia em Manutenção Industrial',
            'sigla' => 'TMI',
            'total_horas' => 150,
            'nivel_id' => 1,
            'eixo_id' => 3,
        ]);

        Turma::create([
            'ano' => '2022',
            'curso_id' => 5
        ]);
        Turma::create([
            'ano' => '2023',
            'curso_id' => 5
        ]);
        Turma::create([
            'ano' => '2024',
            'curso_id' => 5
        ]);
        Turma::create([
            'ano' => '2025',
            'curso_id' => 5
        ]);

        Curso::create([
            'nome' => 'Licenciatura em Física',
            'sigla' => 'LF',
            'total_horas' => 150,
            'nivel_id' => 1,
            'eixo_id' => 4,
        ]);

        Turma::create([
            'ano' => '2022',
            'curso_id' => 6
        ]);
        Turma::create([
            'ano' => '2023',
            'curso_id' => 6
        ]);
        Turma::create([
            'ano' => '2024',
            'curso_id' => 6
        ]);
        Turma::create([
            'ano' => '2025',
            'curso_id' => 6
        ]);

        Curso::create([
            'nome' => 'Licenciatura em Ciências Sociais',
            'sigla' => 'LCS',
            'total_horas' => 150,
            'nivel_id' => 1,
            'eixo_id' => 4,
        ]);

        Turma::create([
            'ano' => '2022',
            'curso_id' => 7
        ]);
        Turma::create([
            'ano' => '2023',
            'curso_id' => 7
        ]);
        Turma::create([
            'ano' => '2024',
            'curso_id' => 7
        ]);
        Turma::create([
            'ano' => '2025',
            'curso_id' => 7
        ]);

        Curso::create([
            'nome' => 'Tecnologia em Análise e Desenvolvimento de Sistemas',
            'sigla' => 'TADS',
            'total_horas' => 150,
            'nivel_id' => 1,
            'eixo_id' => 2,
        ]);

        Turma::create([
            'ano' => '2022',
            'curso_id' => 8
        ]);

        Turma::create([
            'ano' => '2023',
            'curso_id' => 8
        ]);

        Turma::create([
            'ano' => '2024',
            'curso_id' => 8
        ]);

        Turma::create([
            'ano' => '2025',
            'curso_id' => 8
        ]);

        Curso::create([
            'nome' => 'Tecnologia em Gestão Ambiental',
            'sigla' => 'TGA',
            'total_horas' => 150,
            'nivel_id' => 1,
            'eixo_id' => 1,
        ]);

        Turma::create([
            'ano' => '2022',
            'curso_id' => 9
        ]);

        Turma::create([
            'ano' => '2023',
            'curso_id' => 9
        ]);

        Turma::create([
            'ano' => '2024',
            'curso_id' => 9
        ]);

        Turma::create([
            'ano' => '2025',
            'curso_id' => 9
        ]);
        
        // User::create([
        //     'name' => 'Coordenador',
        //     'email' => 'cord@gmail.com',
        //     'password' => Hash::make('123cord123'),
        //     'role_id' => 1
        // ]);   

        // Aluno::create([
        //     'nome' => '',
        //     'cpf' => '',
        //     'email' => '',
        //     'senha' => '',
        //     'user_id' => '',
        //     'curso_id' => '',
        //     'turma_id' => '',
        // ]);        

        // Documento::create([

        // ]);

        // Comprovante::create([

        // ]);

        // Declaracao::create([

        // ]);
    }
}
