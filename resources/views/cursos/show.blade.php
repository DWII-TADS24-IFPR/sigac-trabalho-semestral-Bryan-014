@extends('layouts.app')

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
    <x-bread-crumb page="Cursos" subPage="Visualizar" link="cursos.index"/>
    <div class="mt-2 mb-3">
        <div class="wrapper-show">
            <p><b>Nome: </b>{{$curso->nome}}</p>
            <p><b>Sigla: </b>{{$curso->sigla}}</p>
        </div>
        <div class="wrapper-show">
            <p><b>Total de Horas: </b>{{$curso->total_horas}}</p>
            <p><b>Eixo: </b>{{$curso->eixo->nome}}</p>
            <p><b>Nível: </b>{{$curso->nivel->nome}}</p>
        </div>
        <h3>Turmas</h3>
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
        <div class="d-flex justify-content-end gap-2">
            <form action="{{ route('cursos.destroy', ['id' => $curso->id]) }}" method="post">
                @csrf
                <input class="primary-btn" type="submit" value="Excluir">
            </form>
            <a class="primary-btn" href="{{ route('cursos.edit', ['id' => $curso->id]) }}">Editar</a>
        </div>
    </div>
@endsection

@section('js-resources')
    @vite(['resources/js/app.js', 'resources/js/home.js'])
@endsection