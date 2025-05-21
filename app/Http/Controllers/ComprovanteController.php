<?php

namespace App\Http\Controllers;

use App\Models\Comprovante;
use Illuminate\Http\Request;

class ComprovanteController extends Controller
{
    protected $validationRules = [
        'horas' => 'required|numeric',
        'atividade' => 'required|min:3',
    ];

    protected $validationMessages = [
        'horas.required' => 'O campo horas é obigatório',
        'horas.numeric' => 'O campo horas deve ser numerico',
        'atividade.required' => 'O campo atividade é obigatório',
        'horas.numeric' => 'O campo atividade deve conter pelo menos 3 caracteres',
    ];

    public function index()
    {
        $comprovantes = Comprovante::all();
        return view('comprovantes.index')->with('comprovantes', $comprovantes);
    }

    public function create()
    {
        return view('comprovantes.create');
    }
    
    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->validationMessages);

        Comprovante::create($request->all());
        
        return redirect()->route('comprovantes.index')->with('success', 'Comprovante cadastrado com sucesso!');
    }
    
    public function show(string $id)
    {
        $comprovante = Comprovante::find($id);
        if (isset($comprovante)) {
            return view('comprovantes.show')->with('comprovante', $comprovante); 
        }
        return view('comprovantes.index')->with('danger', 'Comprovante não encontrado');
    }
    
    public function edit(string $id)
    {
        $comprovante = Comprovante::find($id);
        if (isset($comprovante)) {
            return view('comprovantes.edit')->with('comprovante', $comprovante);                    
        }
        return view('comprovantes.index')->with('danger', 'Comprovante não encontrado');

    }
    
    public function update(Request $request)
    {
        $comprovante = Comprovante::find($request->id);
        
        if (isset($comprovante)) {
            $request->validate($this->validationRules, $this->validationMessages);

            $comprovante->horas = $request->horas;
            $comprovante->atividade = $request->atividade;

            $comprovante->save();

            return redirect()->route('comprovantes.index')->with('success', 'Comprovante editado com sucesso!');
        }
        return view('comprovantes.index')->with('danger', 'Comprovante não encontrado');
    }
    
    public function destroy(string $id)
    {
        $comprovante = Comprovante::find($id);
        
        if (isset($comprovante)) {
            $comprovante->delete();
            return redirect()->route('comprovantes.index')->with('success', 'Comprovante deletado com sucesso!');
        }
        
        return view('comprovantes.index')->with('danger', 'Comprovante não encontrado');
    }
}
