<?php

namespace App\Http\Controllers;

use App\Models\Nivel;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    protected $validationRules = [
        'nome' => 'required|max:10',
    ];

    protected $validationMessages = [
        'nome.required' => 'O campo nome é obigatório',
        'nome.max' => 'O campo nome deve ter no máximo 10 caracteres',
    ];

    public function index()
    {
        $niveis = Nivel::all();
        return view('niveis.index')->with('niveis', $niveis);
    }

    public function create()
    {
        return view('niveis.create');
    }
    
    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->validationMessages);

        Nivel::create($request->all());
        
        return redirect()->route('niveis.index')->with('success', 'Nível cadastrado com sucesso!');
    }
    
    public function show(string $id)
    {
        $nivel = nivel::find($id);
        if (isset($nivel)) {
            return view('niveis.show')->with('nivel', $nivel);    
        }
        return redirect()->route('niveis.index')->with('danger', 'Nível não encontrado');
    }
    
    public function edit(string $id)
    {
        $nivel = nivel::find($id);
        if (isset($nivel)) {
            return view('niveis.edit')->with('nivel', $nivel);                    
        }
        return redirect()->route('niveis.index')->with('danger', 'Nível não encontrado');
    }
    
    public function update(Request $request)
    {
        $nivel = nivel::find($request->id);
        
        if (isset($nivel)) {
            $request->validate($this->validationRules, $this->validationMessages);

            $nivel->nome = $request->nome;

            $nivel->save();

            return redirect()->route('niveis.index')->with('success', 'Nível atualizado com sucesso!');
        }
        return redirect()->route('niveis.index')->with('danger', 'Nível não encontrado');
    }
    
    public function destroy(string $id)
    {
        $nivel = nivel::find($id);
        
        if (isset($nivel)) {
            $nivel->delete();
            return redirect()->route('niveis.index')->with('success', 'Nível deletado com sucesso!');
        }
        
        return redirect()->route('niveis.index')->with('danger', 'Nível não encontrado');
    }
}
