<?php

namespace App\Http\Controllers;

use App\Models\Declaracao;
use Illuminate\Http\Request;

class DeclaracaoController extends Controller
{
    protected $validationRules = [
        'data' => 'required',
        'hash' => 'required|max:25',
    ];

    protected $validationMessages = [
        'data.required' => 'O campo data é obigatório',
        'hash.required' => 'O campo hash é obigatório',
        'hash.max' => 'O campo data deve conter uma data válida',
    ];

    public function index()
    {
        $declaracoes = declaracao::all();
        return view('declaracoes.index')->with('declaracoes', $declaracoes);
    }

    public function create()
    {
        return view('declaracoes.create');
    }
    
    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->validationMessages);

        Declaracao::create($request->all());
        
        return redirect()->route('declaracoes.index')->with('success', 'Declaração cadastrada com sucesso!');
    }
    
    public function show(string $id)
    {
        $declaracao = declaracao::find($id);
        if (isset($declaracao)) {
            return view('declaracoes.show')->with('declaracao', $declaracao);       
        }
        return view('declaracoes.index')->with('danger', 'Declaração não encontrado');
    }
    
    public function edit(string $id)
    {
        $declaracao = declaracao::find($id);
        if (isset($declaracao)) {
            return view('declaracoes.edit')->with('declaracao', $declaracao);                    
        }
        return view('declaracoes.index')->with('danger', 'Declaração não encontrado');

    }
    
    public function update(Request $request)
    {
        $declaracao = declaracao::find($request->id);
        
        if (isset($declaracao)) {
            $request->validate($this->validationRules, $this->validationMessages);

            $declaracao->hash = $request->hash;
            $declaracao->data = $request->data;

            $declaracao->save();

            return redirect()->route('declaracoes.index')->with('success', 'Declaração atualizada com sucesso!');
        }
        return view('declaracoes.index')->with('danger', 'Declaração não encontrado');
    }
    
    public function destroy(string $id)
    {
        $declaracao = Declaracao::find($id);
        
        if (isset($declaracao)) {
            $declaracao->delete();
            return redirect()->route('declaracoes.index')->with('success', 'Declaração deletadaa com sucesso!');
        }
        
        return view('declaracoes.index')->with('danger', 'Declaração não encontrado');
    }
}
