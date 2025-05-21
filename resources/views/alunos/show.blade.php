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
    <x-bread-crumb page="Alunos" subPage="Visualizar" link="alunos.index"/>
    <div class="mt-2 mb-3">
        <div class="wrapper-show">
            <p><b>Nome: </b>{{$aluno->nome}}</p>
            <p><b>Email: </b>{{$aluno->email}}</p>
        </div>
        <div class="wrapper-show">
            <p><b>CPF: </b>{{$aluno->cpf}}</p>
        </div>
        <div class="d-flex justify-content-end gap-2">
            <form action="{{ Route('alunos.destroy', ['id' => $aluno->id]) }}" method="post">
                @csrf
                <input class="primary-btn" type="submit" value="Excluir">
            </form>
            <a class="primary-btn" href="{{ Route('alunos.edit', ['id' => $aluno->id]) }}">Editar</a>
        </div>
    </div>
@endsection

@section('js-resources')
    @vite(['resources/js/app.js', 'resources/js/home.js'])
@endsection