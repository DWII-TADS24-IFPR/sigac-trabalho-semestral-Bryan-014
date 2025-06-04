@extends('layouts.main')

@section('css-resources')
    @vite(['resources/css/reset.css', 'resources/css/components.css', 'resources/css/header.css', 'resources/css/table.css'])
@endsection

@section('header')
    @include('layouts.navbar')   
@endsection

@section('aside-links')
    @include('layouts.aside')   
@endsection

@section('cont-box')
    <x-bread-crumb page="Alunos" subPage="Editar" link="alunos.index"/>
    <form action="{{ route('alunos.update') }}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$aluno->id}}">
        <div class="mt-2 mb-3">
            <div class="wrapper-inputs">
                <div class="primary-input">
                    <div>
                        <input type="text" placeholder=" " name="nome" id="nome" value="{{$aluno->nome}}">
                        <label for="nome">Nome</label>
                    </div>
                    <p id="response-nome">
                        @error('nome')                        
                            {{$message}}
                        @enderror
                    </p>
                </div>
                <div class="primary-input">
                    <div>
                        <input type="text" placeholder=" " name="cpf" id="cpf" value="{{$aluno->cpf}}">
                        <label for="cpf">CPF</label>
                    </div>
                    <p id="response-cpf">
                        @error('cpf')                        
                            {{$message}}
                        @enderror
                    </p>
                </div>
            </div>
            <div>
                <div class="primary-input">
                    <div>
                        <input type="text" placeholder=" " name="email" id="email" value="{{$aluno->email}}">
                        <label for="email">Email</label>
                    </div>
                    <p id="response-email">
                        @error('email')                        
                            {{$message}}
                        @enderror
                    </p>
                </div>
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
            <div class="d-flex justify-content-end gap-2">
                <input class="primary-btn" type="submit" value="Editar">
            </div>
        </div>
    </form>
    <script>
        const turmas_por_curso = @json($turmasPorCurso);
        let curso_select = document.querySelector('#curso');
        let turma_select = document.querySelector('#turma');
        let valid = false;

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
@endsection

@section('js-resources')
    @vite(['resources/js/app.js', 'resources/js/home.js'])
@endsection