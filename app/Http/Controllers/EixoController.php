<?php

namespace App\Http\Controllers;

use App\Models\Eixo;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;

use Illuminate\Http\Request;

class EixoController extends Controller
{
    protected $validationRules = [
        'nome' => 'required|max:50|min:2',
    ];

    protected $validationMessages = [
        'nome.required' => 'O campo nome é obrigatório',
        'nome.max' => 'O campo nome deve ter no máximo 50 caracteres',
        'nome.min' => 'O campo nome deve ter no mínimo 2 caracteres',
    ];

    public function index()
    {
        View::share('errors', session()->get('errors', new MessageBag()));
        $eixos = Eixo::all();
        return view('eixos.index')->with('eixos', $eixos);
    }

    public function create()
    {
        return view('eixos.create');
    }
    
    public function store(Request $request)
    {
        try {
            $request->validate($this->validationRules, $this->validationMessages);

            $eixo = new Eixo();
            $eixo->nome = $request->nome;

            if ($eixo->save()) {
                return redirect()->route('eixos.index')->with('success', 'Eixo cadastrado com sucesso!')->cookie('debug_session', json_encode(session()->all()), 1);
            } else {
                return back()->with('danger', 'Erro ao salvar eixo.');
            }
        } catch (\Throwable $e) {
            return back()->with('danger', 'Erro: ' . $e->getMessage());
        }
    }
    
    public function show(string $id)
    {
        $eixo = Eixo::find($id);
        if (isset($eixo)) {
            return view('eixos.show')->with('eixo', $eixo);    
        }
        return redirect()->route('eixos.index')->with('danger', 'Eixo não encontrado');
    }
    
    public function edit(string $id)
    {
        $eixo = Eixo::find($id);
        if (isset($eixo)) {
            return view('eixos.edit')->with('eixo', $eixo);                    
        }
        return redirect()->route('eixos.index')->with('danger', 'Eixo não encontrado');
    }
    
    public function update(Request $request)
    {
        $eixo = Eixo::find($request->id);
        
        if (isset($eixo)) {
            $request->validate($this->validationRules, $this->validationMessages);

            $eixo->nome = $request->nome;

            $eixo->save();

            return redirect()->route('eixos.index')->with('success', 'Eixo atualizado com sucesso!');
        }
        return redirect()->route('eixos.index')->with('danger', 'Eixo não encontrado');
    }
    
    public function destroy(string $id)
    {
        $nivel = Eixo::find($id);
        
        if (isset($nivel)) {
            $nivel->delete();
            return redirect()->route('eixos.index')->with('success', 'Eixo deletado com sucesso!');
        }
        
        return redirect()->route('eixos.index')->with('danger', 'Nível não encontrado');
    }
}
