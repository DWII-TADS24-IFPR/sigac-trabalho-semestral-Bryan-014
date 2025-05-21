<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    protected $validationRules = [
        'nome' => 'required|min:3',
        'maximo_horas' => 'required|numeric',
    ];

    protected $validationMessages = [
        'nome.required' => 'O campo nome é obigatório',
        'nome.min:3' => 'O campo nome é deve ter pelo menos 3 caracteres',
        'maximo_horas.required' => 'O campo máximo de horas é obigatório',
        'maximo_horas.min:3' => 'O campo máximo de horas é deve ter pelo menos 3 caracteres',
    ];

    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index')->with('categorias', $categorias);
    }

    public function create()
    {
        return view('categorias.create');
    }
    
    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->validationMessages);

        Categoria::create($request->all());
        
        return redirect()->route('categorias.index')->with('success', 'Categoria cadastrado com sucesso!');
    }
    
    public function show(string $id)
    {
        $categoria = Categoria::find($id);
        if (isset($categoria)) {
            return view('categorias.show')->with('categoria', $categoria);
        }
        return view('categorias.index')->with('danger', 'Categoria não encontrado');
    }
    
    public function edit(string $id)
    {
        $categoria = Categoria::find($id);
        if (isset($categoria)) {
            return view('categorias.edit')->with('categoria', $categoria);                    
        }
        return view('categorias.index')->with('danger', 'Categoria não encontrado');

    }
    
    public function update(Request $request)
    {
        $categoria = Categoria::find($request->id);
        
        if (isset($categoria)) {
            $request->validate($this->validationRules, $this->validationMessages);

            $categoria->nome = $request->nome;
            $categoria->maximo_horas = $request->maximo_horas;

            $categoria->save();

            return redirect()->route('categorias.index')->with('success', 'Catgoria editada com sucesso!');
        }
        return view('categorias.index')->with('danger', 'Categoria não encontrado');
    }
    
    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);
        
        if (isset($categoria)) {
            $categoria->delete();
            return redirect()->route('categorias.index')->with('success', 'Categoria deletada com sucesso!');
        }
        
        return view('categorias.index')->with('danger', 'Categoria não encontrado');
    }
}
