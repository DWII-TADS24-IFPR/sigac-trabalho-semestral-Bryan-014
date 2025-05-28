<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

use App\Models\Aluno;
use App\Models\Curso;

class RegisteredUserController extends Controller
{
    protected $validationRules = [
        'name' => 'required|min:3|max:255',
        'email' => 'required|email',
        'cpf' => 'required',
        'curso' => 'required',
        'turma' => 'required'
    ];

    protected $validationMessages = [
        'name.required' => 'O campo nome é obigatório',
        'name.min' => 'O campo nome deve conter ao menos 3 caracteres',
        'email.required' => 'O campo email é obigatório',
        'email.email' => 'O campo email deve conter um email válido',
        'cpf.required' => 'O campo cpf é obrigatório',
        'curso.required' => 'O campo curso é obigatório',
        'turma.required' => 'O campo turma é obrigatório',
    ];

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $cursos = Curso::all();
        $turmasPorCurso = $cursos->map(function($curso) {
            return [
                'curso' => $curso->id,
                'turmas' => $curso->turmas->map(function($turma) {
                    return [
                        'id' => $turma->id,
                        'ano' => $turma->ano
                    ];
                })
            ];
        });
        return view('auth.register')->with('cursos', $cursos)->with('turmasPorCurso', $turmasPorCurso);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2
        ]);

        Aluno::create([
            'nome' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'curso_id' => $request->curso,
            'turma_id' => $request->turma,
            'user_id' => $user->id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('aluno.dashboard', absolute: false));        
    }
}
