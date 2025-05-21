<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    protected $validationRules = [
        'ano' => 'required|numeric',
    ];

    protected $validationMessages = [
        'ano.required' => 'O campo ano é obigatório',
        'ano.numeric' => 'O campo ano deve ser numerico',
    ];

    public function index(Request $request)
    {
        
        $curso_id = $request->route('curso_id');
        
        $curso = Curso::find($curso_id);
        
        $turmas = $curso->turmas;

        return view('turmas.index', ['curso_id' => $curso_id])->with('turmas', $turmas);
    }
    
    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->validationMessages);

        $curso = Curso::find($request->curso_id);

        $curso->turmas()->create(['ano' => $request->ano]);

        return redirect()->route('turmas.index', ['curso_id' => $request->curso_id])->with('success', 'Turma cadastrada com sucesso!');
    }
    
    public function update(Request $request)
    {
        $turma = turma::find($request->id);
        
        if (isset($turma)) {
            $request->validate($this->validationRules, $this->validationMessages);

            $turma->ano = $request->ano;

            $turma->save();

            return redirect()->route('turmas.index', ['curso_id' => $request->curso_id])->with('success', 'Turma atualizada com sucesso!');
        }
        return view('turmas.index')->with('danger', 'Turma não encontrado');
    }
    
    public function destroy(Request $request, string $curso_id, string $id)
    {
       $turma = Turma::where('id', $id)
                  ->where('curso_id', $curso_id)
                  ->first();

        if ($turma) {
            $turma->delete();
            return redirect()->route('turmas.index', ['curso_id' => $curso_id])
                            ->with('success', 'Turma deletada com sucesso!');
        }

        return redirect()->route('turmas.index', ['curso_id' => $curso_id])
                        ->with('danger', 'Turma não encontrada ou não pertence ao curso.');
    }
}
