<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComprovanteController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeclaracaoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\HorasController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\EixoController;
use App\Http\Controllers\TurmaController;
use App\Models\Declaracao;

Route::get('/', function () {
    $user = Auth::user();

    if ($user->role_id == env('ADMIN_ROLE_ID')) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role_id == env('ALUNO_ROLE_ID')) {
        return redirect()->route('aluno.dashboard');
    }
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/documentos/show/{id}', [DocumentoController::class, 'show'])->name('documentos.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'ValidAdmin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');

    Route::get('/alunos', [AlunoController::class, 'index'])->name('alunos.index');
    Route::get('/alunos/create', [AlunoController::class, 'create'])->name('alunos.create');
    Route::get('/alunos/show/{id}', [AlunoController::class, 'show'])->name('alunos.show');
    Route::get('/alunos/edit/{id}', [AlunoController::class, 'edit'])->name('alunos.edit');
    Route::post('/alunos/store', [AlunoController::class, 'store'])->name('alunos.store');
    Route::post('/alunos/update', [AlunoController::class, 'update'])->name('alunos.update');
    Route::post('/alunos/destroy/{id}', [AlunoController::class, 'destroy'])->name('alunos.destroy');
    
    Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
    Route::get('/categorias/show/{id}', [CategoriaController::class, 'show'])->name('categorias.show');
    Route::get('/categorias/edit/{id}', [CategoriaController::class, 'edit'])->name('categorias.edit');
    Route::post('/categorias/store', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::post('/categorias/update', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::post('/categorias/destroy/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

    Route::get('/comprovantes', [ComprovanteController::class, 'index'])->name('comprovantes.index');
    Route::get('/comprovantes/create', [ComprovanteController::class, 'create'])->name('comprovantes.create');
    Route::get('/comprovantes/show/{id}', [ComprovanteController::class, 'show'])->name('comprovantes.show');
    Route::get('/comprovantes/edit/{id}', [ComprovanteController::class, 'edit'])->name('comprovantes.edit');
    Route::post('/comprovantes/store', [ComprovanteController::class, 'store'])->name('comprovantes.store');
    Route::post('/comprovantes/update', [ComprovanteController::class, 'update'])->name('comprovantes.update');
    Route::post('/comprovantes/destroy/{id}', [ComprovanteController::class, 'destroy'])->name('comprovantes.destroy');

    Route::get('/cursos', [CursoController::class, 'index'])->name('cursos.index');
    Route::get('/cursos/create', [CursoController::class, 'create'])->name('cursos.create');
    Route::get('/cursos/show/{id}', [CursoController::class, 'show'])->name('cursos.show');
    Route::get('/cursos/edit/{id}', [CursoController::class, 'edit'])->name('cursos.edit');
    Route::post('/cursos/store', [CursoController::class, 'store'])->name('cursos.store');
    Route::post('/cursos/update', [CursoController::class, 'update'])->name('cursos.update');
    Route::post('/cursos/destroy/{id}', [CursoController::class, 'destroy'])->name('cursos.destroy');

    Route::get('/declaracoes', [DeclaracaoController::class, 'index'])->name('declaracoes.index');
    Route::get('/declaracoes/create', [DeclaracaoController::class, 'create'])->name('declaracoes.create');
    Route::get('/declaracoes/show/{id}', [DeclaracaoController::class, 'show'])->name('declaracoes.show');
    Route::get('/declaracoes/edit/{id}', [DeclaracaoController::class, 'edit'])->name('declaracoes.edit');
    Route::post('/declaracoes/store', [DeclaracaoController::class, 'store'])->name('declaracoes.store');
    Route::post('/declaracoes/update', [DeclaracaoController::class, 'update'])->name('declaracoes.update');
    Route::post('/declaracoes/destroy/{id}', [DeclaracaoController::class, 'destroy'])->name('declaracoes.destroy');    
    
    Route::get('/niveis', [NivelController::class, 'index'])->name('niveis.index');
    Route::get('/niveis/create', [NivelController::class, 'create'])->name('niveis.create');
    Route::get('/niveis/show/{id}', [NivelController::class, 'show'])->name('niveis.show');
    Route::get('/niveis/edit/{id}', [NivelController::class, 'edit'])->name('niveis.edit');
    Route::post('/niveis/store', [NivelController::class, 'store'])->name('niveis.store');
    Route::post('/niveis/update', [NivelController::class, 'update'])->name('niveis.update');
    Route::post('/niveis/destroy/{id}', [NivelController::class, 'destroy'])->name('niveis.destroy');
    
    Route::get('/eixos', [EixoController::class, 'index'])->name('eixos.index');
    Route::get('/eixos/create', [EixoController::class, 'create'])->name('eixos.create');
    Route::get('/eixos/show/{id}', [EixoController::class, 'show'])->name('eixos.show');
    Route::get('/eixos/edit/{id}', [EixoController::class, 'edit'])->name('eixos.edit');
    Route::post('/eixos/store', [EixoController::class, 'store'])->name('eixos.store');
    Route::post('/eixos/update', [EixoController::class, 'update'])->name('eixos.update');
    Route::post('/eixos/destroy/{id}', [EixoController::class, 'destroy'])->name('eixos.destroy');

    Route::get('/turmas/{curso_id}', [TurmaController::class, 'index'])->name('turmas.index');
    Route::get('/turmas/{curso_id}/create', [TurmaController::class, 'create'])->name('turmas.create');
    Route::get('/turmas/{curso_id}/show/{id}', [TurmaController::class, 'show'])->name('turmas.show');
    Route::get('/turmas/{curso_id}/edit/{id}', [TurmaController::class, 'edit'])->name('turmas.edit');
    Route::post('/turmas/{curso_id}/store', [TurmaController::class, 'store'])->name('turmas.store');
    Route::post('/turmas/{curso_id}/update', [TurmaController::class, 'update'])->name('turmas.update');
    Route::post('/turmas/{curso_id}/destroy/{id}', [TurmaController::class, 'destroy'])->name('turmas.destroy');

    Route::get('/solicitacoes', [DocumentoController::class, 'index'])->name('solicitacoes.index');
    Route::post('/documentos/{id}/aprove', [DocumentoController::class, 'aprove'])->name('documentos.aprove');
    Route::post('/documentos/{id}/demiss', [DocumentoController::class, 'demiss'])->name('documentos.demiss');
    Route::get('/horas', [HorasController::class, 'index'])->name('horas.index');
    
});

Route::middleware(['auth', 'ValidAluno'])->group(function () {
    Route::get('/aluno', [DashboardController::class, 'aluno'])->name('aluno.dashboard');

    Route::get('/solicitacao', [DocumentoController::class, 'create'])->name('solicitacao.create');

    Route::get('/documentos', [DocumentoController::class, 'list'])->name('documentos.list');
    Route::post('/documentos/store', [DocumentoController::class, 'store'])->name('documentos.store');

    Route::get('/declaracao/{id}', [DeclaracaoController::class, 'generate'])->name('declaracao.generate');

    // Route::get('/documentos/edit/{id}', [DocumentoController::class, 'edit'])->name('documentos.edit');
    // Route::post('/documentos/update', [DocumentoController::class, 'update'])->name('documentos.update');
    // Route::post('/documentos/destroy/{id}', [DocumentoController::class, 'destroy'])->name('documentos.destroy');
});

require __DIR__.'/auth.php';
