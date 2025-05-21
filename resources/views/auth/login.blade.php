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
        <div class="log-container">
            <div class="log-content">
                <div class="info">
                    <h1>SIGAC</h1>
                    <p>Seu sistema de gerenciamento de atividades complementares!</p>
                    <a class="secundary-btn" href="{{ route('register') }}">Registrar-se</a>
                </div>
                <div class="login-cont">
                    <form class="form-login" action="{{ route('login') }}" method="post">
                        @csrf
                        <h2>LOGIN</h2>
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <div class="inputs">
                            <div class="primary-input mb-3">
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
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Manter Conectado') }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="sub-btn">
                            <input class="primary-btn" type="submit" value="Entrar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>