<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    protected $validationRules = [
        'url' => 'required',
        'descricao' => 'required',
        'horas_in' => 'required',
        'status' => 'required',
        'comentario' => 'required',
        'horas_out' => 'required'
    ];

    protected $validationMessages = [
        'url.required' => 'O campo url é obigatório',
        'descricao.required' => 'O campo descricao é obigatório',
        'horas_in.required' => 'O campo horas_in é obigatório',
        'status.required' => 'O campo status é obigatório',
        'comentario.required' => 'O campo comentario é obigatório',
        'horas_out.required' => 'O campo horas_out é obigatório'
    ];

    public function index()
    {
        $documentos = Documento::all();
        return view('documentos.index')->with('documentos', $documentos);
    }

    public function create()
    {
        return view('documentos.create');
    }
    
    public function store(Request $request)
    {
        $request->validate($this->validationRules, $this->validationMessages);

        Documento::create($request->all());
        
        return redirect()->route('documentos.index')->with('success', 'Documento cadastrado com sucesso!');
    }
    
    public function show(string $id)
    {
        $documento = Documento::find($id);
        if (isset($documento)) {
            return view('documentos.show')->with('documento', $documento);  
        }
        return view('documentos.index')->with('danger', 'Documento não encontrado');
    }
    
    public function edit(string $id)
    {
        $documento = Documento::find($id);
        if (isset($documento)) {
            return view('documentos.edit')->with('documento', $documento);                    
        }
        return view('documentos.index')->with('danger', 'Documento não encontrado');
    }
    
    public function update(Request $request)
    {
        $documento = Documento::find($request->id);
        
        if (isset($documento)) {
            $request->validate($this->validationRules, $this->validationMessages);

            $documento->url = $request->url;
            $documento->descricao = $request->descricao;
            $documento->horas_in = $request->horas_in;
            $documento->status = $request->status;
            $documento->comentario = $request->comentario;
            $documento->horas_out = $request->horas_out;

            $documento->save();

            return redirect()->route('documentos.index')->with('success', 'Documento atualizado com sucesso!');
        }
        return view('documentos.index')->with('danger', 'Documento não encontrado');
    }
    
    public function destroy(string $id)
    {
        $documento = Documento::find($id);
        
        if (isset($documento)) {
            $documento->delete();
            return redirect()->route('documentos.index')->with('success', 'Documento deletado com sucesso!');
        }        
        return view('documentos.index')->with('danger', 'Documento não encontrado');
    }
}
