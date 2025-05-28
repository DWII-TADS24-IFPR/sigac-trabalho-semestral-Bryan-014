<?php

namespace App\Http\Controllers;

use App\Models\Documento;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin () {
        $documentosCount = 0;
        $documentos = Documento::all();

        foreach ($documentos as $documento) {
            if ($documento->status == 0) {
                $documentosCount += 1;
            }
        }

        return view('dashboard')->with('countDoc', $documentosCount);
    }

    public function aluno () {
        return view('dashboard');
    }
}
