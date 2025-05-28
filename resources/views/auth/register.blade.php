<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIGAC</title>
        @vite(['resources/css/login.css', 'resources/css/components.css', 'resources/css/reset.css'])        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="reg-container">
            <div class="reg-content">
                <div class="register-cont">
                    <form class="form-register" action="{{ route('register') }}" method="post">
                        @csrf
                        <h2>Registro</h2>
                        <div class="inputs">
                            <div class="primary-input">
                                <div>
                                    <input type="text" placeholder=" " name="name" id="name" value='{{old('name')}}'>
                                    <label for="name">Nome</label>
                                </div>
                                <p id="response-name">
                                    @error('name')
                                        {{$message}}
                                    @enderror
                                </p>
                            </div>
                            <div class="primary-input">
                                <div>
                                    <input type="text" placeholder=" " name="cpf" id="cpf" value='{{old('cpf')}}'>
                                    <label for="cpf">CPF</label>
                                </div>
                                <p id="response-cpf">
                                    @error('cpf')
                                        {{$message}}
                                    @enderror
                                </p>
                            </div>
                            <div class="primary-input">
                                <div>
                                    <input type="text" placeholder=" " name="email" id="email" value='{{old('email')}}'>
                                    <label for="email">Email</label>
                                </div>
                                <p id="response-email">
                                    @error('email')
                                        {{$message}}
                                    @enderror
                                </p>
                            </div>
                            <div class="primary-input">
                                <div>
                                    <input type="password" placeholder=" " name="password" id="password" value="{{old('password')}}">                            
                                    <label for="password">Senha</label>
                                </div>
                                <p id="response-password">
                                    @error('password')
                                        {{$message}}
                                    @enderror
                                </p>
                            </div>
                            <div class="primary-input">
                                <div>
                                    <input type="password" placeholder=" " name="password_confirmation" id="password_confirmation" value="{{old('password_confirmation')}}">                            
                                    <label for="password_confirmation">Confirmar Senha</label>
                                </div>
                                <p id="response-password_confirmation">
                                    @error('password_confirmation')
                                        {{$message}}
                                    @enderror
                                </p>
                            </div>
                            <div class="wrapper-inputs">
                                <div class="primary-input">
                                    <div>
                                        <select name="curso" id="curso">
                                            <option value="">Curso</option>
                                            @foreach ($cursos as $curso)
                                                <option value="{{$curso->id}}">{{$curso->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p id="response-curso">
                                        @error('curso')                        
                                            {{$message}}
                                        @enderror
                                    </p>
                                </div>
                                <div class="primary-input">
                                    <div>
                                        <select name="turma" id="turma" disabled>
                                            <option value="">turma</option>
                                        </select>
                                    </div>
                                    <p id="response-turma">
                                        @error('turma')                        
                                            {{$message}}
                                        @enderror
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="sub-btn">
                            <input class="primary-btn" type="submit" value="Registrar">
                        </div>
                    </form>
                </div>
                <div class="info">
                    <h1>SIGAC</h1>
                    <p>Seu sistema de gerenciamento de atividades complementares!</p>
                    <a class="secundary-btn" href="{{ route('login') }}">Login</a>
                </div>                
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let curso_select = document.querySelector('#curso');
        let turma_select = document.querySelector('#turma');
        let valid = false;
        const turmas_por_curso = @json($turmasPorCurso);

        curso_select.addEventListener('change', e => {
            valid = false;
            turma_select.innerHTML = `
            <option value="">turma</option>
            `;
            turmas_por_curso.forEach(tpc => {
                if (curso_select.value == tpc.curso) {
                    tpc.turmas.forEach(turma => {
                        turma_select.innerHTML += `
                        <option value="${turma.id}">${turma.ano}</option>
                        `;                        
                    })
                    valid = true;
                }
            });
            if (valid) {
                turma_select.disabled = false;
            } else {
                turma_select.disabled = true;
            }
        })
    </script>
</html>










{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
