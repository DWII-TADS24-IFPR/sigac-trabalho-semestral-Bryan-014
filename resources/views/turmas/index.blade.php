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

    <x-bread-crumb page="Cursos" subPage="Turmas" link="cursos.index"/>
    <div class="mt-2 mb-3">
        <div class="steps">
            <div class="step step-free">
                <a href="{{ route('cursos.edit', $curso_id) }}">
                    <div class="num-step">
                        1
                    </div>
                </a>
                <div class="label-step">
                    Curso
                </div>
            </div>
            <div class="mid-step">
                <div class="point"></div>
                <div class="point"></div>
                <div class="point"></div>
            </div>
            <div class="step step-act">
                <div class="num-step">
                    2
                </div>
                <div class="label-step">
                    Turmas
                </div>
            </div>
        </div>
        <div class="head-table">
            <button type="button" class="primary-btn mt-2" data-bs-toggle="modal" data-bs-target="#createTurma">
                Cadastrar Turma
            </button>
            <div class="modal fade" id="createTurma" tabindex="-1" aria-labelledby="createTurmaLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createTurmaLabel">Cadastrar Turma</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('turmas.store', ['curso_id' => $curso_id]) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <div class="modal-body">
                                    <div class="primary-input">
                                        <div>
                                            <input type="text" placeholder=" " name="ano" id="ano" value="{{old('ano')}}">
                                            <label for="ano">Ano</label>
                                        </div>
                                        <p id="response-ano">
                                            @error('ano')                        
                                                {{$message}}
                                            @enderror
                                        </p>
                                    </div>                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="danger-btn" data-bs-dismiss="modal">fechar</button>
                                    <button type="submit" class="primary-btn">Cadastrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-content mt-2">
            <div class="tbl-row">
                <div class="tbl-head">Ano</div>
                <div class="tbl-head"></div>
            </div>
            @if (count($turmas) > 0) 
                @for ($i = 0; $i < count($turmas); $i++)
                    <div class="tbl-row {{$i % 2 == 0 ? '' : 'row-stripe'}}">
                        <div class="tbl-cont">{{$turmas[$i]->ano}}</div>
                        <div class="tbl-cont center cont-crud">
                            <a class="tbl-btn-crud crud-updt" data-bs-toggle="modal" data-bs-target="#editTurma{{$turmas[$i]->id}}"></a>
                            {{-- href="{{ route('turmas.edit', ['id' => $turmas[$i]->id, 'curso_id' => $curso_id]) }}" --}}
                            <div class="modal fade" id="editTurma{{$turmas[$i]->id}}" tabindex="-1" aria-labelledby="editTurma{{$turmas[$i]}}Label" aria-hidden="true">  
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editTurma{{$turmas[$i]->id}}Label">Editar Turma</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('turmas.update', ['curso_id' => $curso_id]) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="curso_id" value="{{$curso_id}}">
                                            <input type="hidden" name="id" value="{{$turmas[$i]->id}}">
                                            <div class="mb-3">
                                                <div class="modal-body">
                                                    <div class="primary-input">
                                                        <div>
                                                            <input type="text" placeholder=" " name="ano" id="ano" value="{{$turmas[$i]->ano}}">
                                                            <label for="ano">Ano</label>
                                                        </div>
                                                        <p id="response-ano">
                                                            @error('ano')                        
                                                                {{$message}}
                                                            @enderror
                                                        </p>
                                                    </div>                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="danger-btn" data-bs-dismiss="modal">fechar</button>
                                                    <button type="submit" class="primary-btn">Editar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('turmas.destroy', ['id' => $turmas[$i]->id, 'curso_id' => $curso_id]) }}" method="post">
                                @csrf
                                <input class="tbl-btn-crud crud-delt" type="submit" value="">
                            </form>
                        </div>
                    </div>
                @endfor
            @else
                <div class="tbl-row center p-2">
                    Nenhum registro encontrado
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js-resources') 
    @vite(['resources/js/app.js', 'resources/js/home.js'])
@endsection