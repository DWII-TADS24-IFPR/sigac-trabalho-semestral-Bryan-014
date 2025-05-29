<?php

namespace App\Http\Controllers;

use App\Models\Comprovante;
use App\Models\Curso;

use Illuminate\Http\Request;

class HorasController extends Controller
{
    public function index() {
        $cursos = Curso::with('turmas.alunos.comprovantes')->get();
        $turmasPorCurso = $cursos->map(function($curso) {
            return [
                'curso' => $curso->id,
                'turmas' => $curso->turmas->map(function($turma) {
                    return [
                        'id' => $turma->id,
                        'ano' => $turma->ano,
                        'alunos' => $turma->alunos->map(function($aluno) {
                            $comprovantes = Comprovante::where('aluno_id', $aluno->id + 1)->get();
                            $horas = 0;

                            foreach ($comprovantes as $comprovante) {
                                $horas += $comprovante->horas;
                            }

                            return [
                                'nome' => $aluno->nome,
                                'horas' =>  $horas,
                                'comprovantes' => $comprovantes
                            ];
                        })
                    ];
                })
            ];
        });

        $horasPorTurma = [];
        foreach ($turmasPorCurso as $curso) {
            foreach ($curso['turmas'] as $turma) {
                $horasPorTurma[$turma['id']] = $turma['alunos'];
            }
        }
        return view('declaracoes.horas')->with('cursos', $cursos)->with('turmasPorCurso', $turmasPorCurso)->with('horasPorTurma', $horasPorTurma);
    }
}
