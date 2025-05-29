<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;

use App\Models\Categoria;
use App\Models\Comprovante;
use App\Models\Documento;
use App\Models\Declaracao;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DocumentoController extends Controller
{
    protected $validationRules = [
        'url' => 'required',
        'descricao' => 'required',
        'horas_in' => 'required',
        'status' => 'required',
        'comentario' => 'required',
        'horas_out' => 'required',
        'categoria' => 'required'
    ];

    protected $validationMessages = [
        'url.required' => 'O campo url é obigatório',
        'descricao.required' => 'O campo descricao é obigatório',
        'horas_in.required' => 'O campo horas_in é obigatório',
        'status.required' => 'O campo status é obigatório',
        'comentario.required' => 'O campo comentario é obigatório',
        'horas_out.required' => 'O campo horas_out é obigatório',
        'categoria.required' => 'O campo horas_out é obigatório'
    ];

    public function index()
    {
        $documentos = Documento::all();
        return view('documentos.index')->with('documentos', $documentos);
    }
    
    public function list() {
        $documentos = Documento::where('user_id', Auth::id())->get();
        return view('documentos.index')->with('documentos', $documentos);
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('documentos.create')->with('categorias', $categorias);
    }
    
    public function store(Request $request)
    {
        $url = $request->url;
        $descricao = $request->descricao;
        $horas_in = $request->horas_in;
        $status = 0;
        $comentario = $request->comentario;
        $horas_out = $request->horas_out;
        $categoria_id = $request->categoria;

        $documento = new Documento();
        $documento->url = $url;
        $documento->descricao = $descricao;
        $documento->horas_in = $horas_in;
        $documento->status = $status;
        $documento->comentario = $comentario;
        $documento->horas_out = $horas_out;
        $documento->categoria_id = $categoria_id;
        $documento->user_id = Auth::id();
        
        $documento->save();
        
        return redirect()->route('solicitacao.create')->with('success', 'Documento cadastrado com sucesso!');
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

    public function aprove(string $id)
    {
        $documento = Documento::find($id);
        
        if (isset($documento)) {
            $documento->status = 1;            
            $documento->save();

            $horario1 = Carbon::parse($documento->horas_in);
            $horario2 = Carbon::parse($documento->horas_out);

            $diferencaEmHoras = $horario1->floatDiffInHours($horario2);

            $horas = $diferencaEmHoras;
            $atividade = $documento->descricao;
            $documento_id = $documento->id;
            $categoria_id = $documento->categoria_id;
            $aluno_id = $documento->user_id;

            $comprovante = new Comprovante();
            $comprovante->horas = $horas;
            $comprovante->atividade = $atividade;
            $comprovante->documento_id = $documento_id;
            $comprovante->categoria_id = $categoria_id;
            $comprovante->aluno_id = $aluno_id;

            $comprovante->save();

            var_dump($comprovante);

            Declaracao::create([
                'hash' => Str::uuid(),
                'data' => Carbon::now(),
                'comprovante_id' => $comprovante->id,
            ]);


            return redirect()->route('solicitacoes.index')->with('success', 'Solicitação aprovada com sucesso!');
        }
        return view('solicitacoes.index')->with('danger', 'Documento não encontrado');
    }

    public function demiss(string $id)
    {
        $documento = Documento::find($id);
        
        if (isset($documento)) {
            $documento->status = 2;           

            $documento->save();

            return redirect()->route('solicitacoes.index')->with('success', 'Solicitação recusada com sucesso!');
        }
        return view('solicitacoes.index')->with('danger', 'Documento não encontrado');
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
