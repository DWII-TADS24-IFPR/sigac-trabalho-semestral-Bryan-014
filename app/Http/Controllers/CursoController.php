<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Eixo;
use App\Models\Nivel;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    protected $validationRules = [
        'nome' => 'required|min:3',
        'sigla' => 'required|max:8',
        'total_horas' => 'required|numeric'
    ];

    protected $validationMessages = [
        'nome.required' => 'O campo nome é obigatório',
        'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
        'sigla.required' => 'O campo sigla é obigatório',
        'sigla.max' => 'O campo sigla deve ter no máximo 8 caracteres',
        'total_horas.required' => 'O campo total_horas deve conter pelo menos 3 caracteres',
        'total_horas.numeric' => 'O campo total_horas deve conter pelo menos 3 caracteres',
    ];

    public function index()
    {
        $cursos = Curso::all();
        return view('cursos.index')->with('cursos', $cursos);
    }

    public function create()
    {
        $niveis = Nivel::all();
        $eixos = Eixo::all();
        return view('cursos.create')->with('niveis', $niveis)->with('eixos', $eixos);
    }
    
    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->validationMessages);

        $nome = $request->nome;
        $sigla = $request->sigla;
        $total_horas = $request->total_horas;
        $eixo_id = $request->eixo;
        $nivel_id = $request->nivel;

        $curso = new Curso();
        $curso->nome = $nome;
        $curso->sigla = $sigla;
        $curso->total_horas = $total_horas;
        $curso->eixo_id = $eixo_id;
        $curso->nivel_id = $nivel_id;

        $result = $curso->save();
        
        return redirect()->route('turmas.index', ['curso_id' => $curso->id])->with('success', 'Curso cadastrado com sucesso!');
    }
    
    public function show(string $id)
    {
        $curso = Curso::find($id);
        if (isset($curso)) {            
            $turmas = $curso->turmas;
            return view('cursos.show', ['curso_id' => $id])->with('curso', $curso)->with('turmas', $turmas);    
        }
        return view('cursos.index')->with('danger', 'Curso não encontrado');
    }
    
    public function edit(string $id)
    {
        $curso = Curso::find($id);
        if (isset($curso)) {
            $niveis = Nivel::all();
            return view('cursos.edit')->with('curso', $curso)->with('niveis', $niveis);                    
        }
        return view('cursos.index')->with('danger', 'Curso não encontrado');

    }
    
    public function update(Request $request)
    {
        $curso = Curso::find($request->id);
        
        if (isset($curso)) {
            $request->validate($this->validationRules, $this->validationMessages);

            $curso->nome = $request->nome;
            $curso->sigla = $request->sigla;
            $curso->total_horas = $request->total_horas;

            $curso->save();

            return redirect()->route('cursos.index')->with('success', 'Curso editado com sucesso!');
        }
        return view('categorias.index')->with('danger', 'Curso não encontrado');
    }
    
    public function destroy(string $id)
    {
        $curso = Curso::find($id);
        
        if (isset($curso)) {
            $curso->delete();
            return redirect()->route('cursos.index')->with('success', 'Curso deletado com sucesso!');
        }
        
        return view('cursos.index')->with('danger', 'Curso não encontrado');
    }
}
